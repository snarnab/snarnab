<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\FreelanceProfile;
use App\Models\MusicItem;
use App\Models\Photograph;
use App\Models\PhotographyCategory;
use App\Models\Profile;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function home(): View
    {
        return view('home', [
            'profile' => Profile::query()->first(),
            'skills' => SkillCategory::query()->with('skills')->orderBy('sort_order')->get(),
            'projects' => Project::query()->with('technologies')->where('is_published', true)->orderBy('sort_order')->orderByDesc('id')->get(),
            'experiences' => Experience::query()->orderBy('sort_order')->orderByDesc('started_at')->get(),
            'educations' => Education::query()->orderBy('sort_order')->orderByDesc('graduated_year')->get(),
            'freelanceProfiles' => FreelanceProfile::query()->where('is_published', true)->orderBy('sort_order')->get(),
            'musicItems' => MusicItem::query()->where('is_published', true)->orderBy('sort_order')->get(),
            'socialLinks' => SocialLink::query()->orderBy('sort_order')->get(),
            'settings' => SiteSetting::query()->get()->toBase()->keyBy('key'),
        ]);
    }

    public function about(): View
    {
        return view('pages.about', [
            'profile' => Profile::query()->first(),
            'experiences' => Experience::query()->orderBy('sort_order')->orderByDesc('started_at')->get(),
            'educations' => Education::query()->orderBy('sort_order')->orderByDesc('graduated_year')->get(),
            'socialLinks' => SocialLink::query()->orderBy('sort_order')->get(),
            'settings' => SiteSetting::query()->get()->toBase()->keyBy('key'),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact', [
            'settings' => SiteSetting::query()->get()->toBase()->keyBy('key'),
            'socialLinks' => SocialLink::query()->orderBy('sort_order')->get(),
        ]);
    }

    public function projects(): View
    {
        return view('pages.projects', [
            'projects' => Project::query()->with('technologies')->where('is_published', true)->orderBy('sort_order')->orderByDesc('id')->paginate(12),
        ]);
    }

    public function project(string $slug): View
    {
        $project = Project::query()
            ->with(['technologies', 'images'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('pages.project', compact('project'));
    }

    public function music(): View
    {
        return view('pages.music', [
            'musicItems' => MusicItem::query()->where('is_published', true)->orderBy('sort_order')->paginate(12),
        ]);
    }

    public function photography(?string $slug = null): View
    {
        $categories = PhotographyCategory::query()->with(['photographs' => function ($query): void {
            $query->where('is_published', true)->orderBy('sort_order');
        }])->orderBy('sort_order')->get();
        $category = $slug
            ? $categories->firstWhere('slug', $slug)
            : null;

        abort_if($slug && ! $category, 404);

        $photographs = Photograph::query()
            ->with('category')
            ->where('is_published', true)
            ->when($category, fn ($query) => $query->where('photography_category_id', $category->id))
            ->orderBy('sort_order')
            ->paginate(18);

        return view('pages.photography', compact('categories', 'category', 'photographs'));
    }

    public function sitemap(): Response
    {
        return response()->view('sitemap', [
            'projects' => Project::query()->where('is_published', true)->get(['slug', 'updated_at']),
            'categories' => PhotographyCategory::query()->get(['slug', 'updated_at']),
        ])->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
