<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Photograph;
use App\Models\PhotographyCategory;
use App\Models\Profile;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\SkillCategory;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PortfolioAdminController extends Controller
{
    public function dashboard(): View
    {
        $models = collect(config('portfolio.resources'))->mapWithKeys(
            fn (array $resource, string $key): array => [$key => $resource['model']],
        );

        return view('admin.dashboard', [
            'counts' => $models->map(fn (string $model): int => $model::query()->count()),
            'unreadMessages' => ContactMessage::query()->whereNull('read_at')->count(),
            'resources' => config('portfolio.resources'),
        ]);
    }

    public function index(string $resource): View
    {
        $definition = $this->definition($resource);
        $model = $definition['model'];
        $records = $model::query()->orderByDesc('id')->paginate(20);

        return view('admin.index', compact('definition', 'records', 'resource'));
    }

    public function create(string $resource): View
    {
        $definition = $this->definition($resource);
        $entry = new $definition['model'];

        if ($resource === 'photographs') {
            $lastPhotograph = Photograph::query()->latest('id')->first();

            if ($lastPhotograph) {
                $entry->fill($lastPhotograph->only([
                    'photography_category_id',
                    'location',
                    'photographed_year',
                    'camera',
                    'lens',
                    'is_featured',
                    'is_published',
                    'sort_order',
                ]));
            }
        }

        return view('admin.form', [
            'definition' => $definition,
            'entry' => $entry,
            'resource' => $resource,
        ]);
    }

    public function store(Request $request, string $resource): RedirectResponse
    {
        $definition = $this->definition($resource);
        $data = $this->validatedData($request, $definition);

        if ($resource === 'photographs' && is_array($request->file('image_path'))) {
            foreach ($request->file('image_path') as $index => $image) {
                $photoRequest = clone $request;
                $photoRequest->files->set('image_path', $image);
                $photoData = $data;
                unset($photoData['image_path']);
                $photoData['sort_order'] = $data['sort_order'] + $index;
                $this->persist($photoRequest, $resource, $definition, new Photograph, $photoData);
            }

            return to_route('admin.resources.index', $resource)->with('status', count($request->file('image_path')).' photographs uploaded.');
        }

        $entry = new $definition['model'];
        $this->persist($request, $resource, $definition, $entry, $data);

        return to_route('admin.resources.index', $resource)->with('status', $definition['title'].' created.');
    }

    public function edit(string $resource, int $entry): View
    {
        $definition = $this->definition($resource);
        $record = $definition['model']::query()->findOrFail($entry);

        if ($resource === 'projects') {
            $record->load('technologies');
        }

        return view('admin.form', [
            'definition' => $definition,
            'entry' => $record,
            'resource' => $resource,
        ]);
    }

    public function update(Request $request, string $resource, int $entry): RedirectResponse
    {
        $definition = $this->definition($resource);
        $record = $definition['model']::query()->findOrFail($entry);
        $data = $this->validatedData($request, $definition, $record);
        $this->persist($request, $resource, $definition, $record, $data);

        return to_route('admin.resources.index', $resource)->with('status', $definition['title'].' updated.');
    }

    public function destroy(string $resource, int $entry): RedirectResponse
    {
        $definition = $this->definition($resource);
        $definition['model']::query()->findOrFail($entry)->delete();

        return to_route('admin.resources.index', $resource)->with('status', $definition['title'].' deleted.');
    }

    public function editProfile(): View
    {
        return view('admin.profile', [
            'profile' => Profile::query()->findOrFail(1),
            'settings' => SiteSetting::query()->get()->keyBy('key'),
        ]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $profile = Profile::query()->findOrFail(1);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'creative_title_en' => ['nullable', 'string', 'max:255'],
            'intro_en' => ['required', 'string', 'max:5000'],
            'about_en' => ['required', 'string', 'max:5000'],
            'location' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'image', 'max:5120'],
            'settings' => ['nullable', 'array:contact_email,institutional_email,phone,office'],
            'settings.*.en' => ['nullable', 'string', 'max:5000'],
            'settings.contact_email.en' => ['nullable', 'email', 'max:255'],
            'settings.institutional_email.en' => ['nullable', 'email', 'max:255'],
        ]);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->storePublicly('portfolio/profile', 'public');
        }

        foreach (array_keys($request->input('settings', [])) as $key) {
            abort_unless(in_array($key, ['contact_email', 'institutional_email', 'phone', 'office'], true), 422);
        }

        $data['title_bn'] = $data['title_en'];
        $data['creative_title_bn'] = $data['creative_title_en'] ?? null;
        $data['intro_bn'] = $data['intro_en'];
        $data['about_bn'] = $data['about_en'];

        unset($data['settings']);
        $profile->update($data);

        foreach ($request->input('settings', []) as $key => $values) {
            SiteSetting::updateOrCreate(['key' => $key], [
                'value_en' => $values['en'] ?? null,
                'value_bn' => $values['en'] ?? null,
            ]);
        }

        return to_route('admin.profile.edit')->with('status', 'Profile and contact details updated.');
    }

    public function contactMessages(): View
    {
        return view('admin.messages', [
            'messages' => ContactMessage::query()->latest()->paginate(20),
        ]);
    }

    public function showContactMessage(int $message): View
    {
        $message = ContactMessage::query()->findOrFail($message);
        $message->update(['read_at' => $message->read_at ?? now()]);

        return view('admin.message', compact('message'));
    }

    public function destroyContactMessage(int $message): RedirectResponse
    {
        ContactMessage::query()->findOrFail($message)->delete();

        return to_route('admin.messages.index')->with('status', 'Message deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function definition(string $resource): array
    {
        abort_unless(array_key_exists($resource, config('portfolio.resources')), 404);

        return config('portfolio.resources.'.$resource);
    }

    /**
     * @param  array<string, mixed>  $definition
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, array $definition, ?Model $entry = null): array
    {
        $rules = [];

        foreach ($definition['fields'] as $key => $field) {
            $fieldRules = $field['rules'];

            foreach ($fieldRules as $index => $rule) {
                if (is_string($rule) && str_starts_with($rule, 'unique:')) {
                    [$table, $column] = array_pad(explode(',', substr($rule, 7), 2), 2, 'id');
                    $fieldRules[$index] = Rule::unique($table, $column)->ignore($entry?->getKey());
                }
            }

            $rules[$key] = $fieldRules;

            if (isset($field['item_rules'])) {
                $rules[$key.'.*'] = $field['item_rules'];
            }
        }

        if ($definition['model'] === Photograph::class && ! $entry && is_array($request->file('image_path'))) {
            $rules['image_path'] = ['required', 'array', 'min:1', 'max:20'];
            $rules['image_path.*'] = ['required', 'image', 'max:5120'];
        }

        return $request->validate($rules);
    }

    /**
     * @param  array<string, mixed>  $definition
     * @param  array<string, mixed>  $data
     */
    private function persist(Request $request, string $resource, array $definition, Model $entry, array $data): void
    {
        $technologyIds = $data['technology_ids'] ?? [];
        unset($data['technology_ids']);

        if ($resource === 'photography-categories' && ! $entry->exists) {
            $baseSlug = Str::limit(Str::slug($data['name_en']), 240, '') ?: 'category';
            $slug = $baseSlug;
            $suffix = 2;

            while (PhotographyCategory::query()->where('slug', $slug)->exists()) {
                $slug = $baseSlug.'-'.$suffix;
                $suffix++;
            }

            $data['slug'] = $slug;
        }

        foreach ($definition['mirrors'] ?? [] as $target => $source) {
            $data[$target] = $data[$source] ?? null;
        }

        foreach ($definition['fields'] as $key => $field) {
            if ($field['type'] === 'checkbox') {
                $data[$key] = $request->boolean($key);
            }

            if ($field['type'] === 'image' && $request->hasFile($key)) {
                $data[$key] = $request->file($key)->storePublicly('portfolio/'.$resource, 'public');
            }
        }

        $entry->fill($data)->save();

        if ($resource === 'projects') {
            $entry->technologies()->sync($technologyIds);
        }
    }

    /**
     * Resolve explicitly allowed relationship option lists for admin forms.
     *
     * @return array<int|string, string>
     */
    public static function options(string|array $source): array
    {
        if (is_array($source)) {
            return $source;
        }

        return match ($source) {
            'skill-categories' => SkillCategory::query()->orderBy('sort_order')->pluck('name_en', 'id')->all(),
            'technologies' => Technology::query()->orderBy('name')->pluck('name', 'id')->all(),
            'projects' => Project::query()->orderBy('title_en')->pluck('title_en', 'id')->all(),
            'photography-categories' => PhotographyCategory::query()->orderBy('sort_order')->pluck('name_en', 'id')->all(),
            default => [],
        };
    }
}
