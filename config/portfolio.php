<?php

use App\Models\Education;
use App\Models\Experience;
use App\Models\FreelanceProfile;
use App\Models\MusicItem;
use App\Models\Photograph;
use App\Models\PhotographyCategory;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use App\Models\Technology;

return [
    'resources' => [
        'experiences' => [
            'title' => 'Experience',
            'model' => Experience::class,
            'mirrors' => ['title_bn' => 'title_en', 'organization_bn' => 'organization_en', 'details_bn' => 'details_en'],
            'columns' => ['title_en', 'organization_en', 'started_at'],
            'fields' => [
                'title_en' => ['label' => 'Title (English)', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'organization_en' => ['label' => 'Organization (English)', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'location' => ['label' => 'Location', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'employment_type' => ['label' => 'Type', 'type' => 'select', 'options' => ['employment' => 'Employment', 'freelance' => 'Freelance'], 'rules' => ['required', 'in:employment,freelance']],
                'started_at' => ['label' => 'Start date', 'type' => 'date', 'rules' => ['nullable', 'date']],
                'ended_at' => ['label' => 'End date', 'type' => 'date', 'rules' => ['nullable', 'date', 'after_or_equal:started_at']],
                'is_current' => ['label' => 'Current role', 'type' => 'checkbox', 'rules' => ['nullable', 'boolean']],
                'details_en' => ['label' => 'Details (English)', 'type' => 'textarea', 'rules' => ['nullable', 'string', 'max:5000']],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0', 'max:65535']],
            ],
        ],
        'education' => [
            'title' => 'Education',
            'model' => Education::class,
            'mirrors' => ['degree_bn' => 'degree_en', 'institution_bn' => 'institution_en', 'details_bn' => 'details_en'],
            'columns' => ['degree_en', 'institution_en', 'graduated_year'],
            'fields' => [
                'degree_en' => ['label' => 'Degree (English)', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'institution_en' => ['label' => 'Institution (English)', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'field_of_study' => ['label' => 'Field of study', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'started_year' => ['label' => 'Start year', 'type' => 'number', 'rules' => ['nullable', 'integer', 'between:1950,2100']],
                'graduated_year' => ['label' => 'Graduation year', 'type' => 'number', 'rules' => ['nullable', 'integer', 'between:1950,2100']],
                'details_en' => ['label' => 'Details (English)', 'type' => 'textarea', 'rules' => ['nullable', 'string', 'max:5000']],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0', 'max:65535']],
            ],
        ],
        'skill-categories' => [
            'title' => 'Skill categories',
            'model' => SkillCategory::class,
            'mirrors' => ['name_bn' => 'name_en'],
            'columns' => ['name_en', 'sort_order'],
            'fields' => [
                'name_en' => ['label' => 'Name (English)', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0', 'max:65535']],
            ],
        ],
        'skills' => [
            'title' => 'Skills',
            'model' => Skill::class,
            'columns' => ['name', 'skill_category_id', 'sort_order'],
            'fields' => [
                'name' => ['label' => 'Skill', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'skill_category_id' => ['label' => 'Category', 'type' => 'select', 'options' => 'skill-categories', 'rules' => ['required', 'exists:skill_categories,id']],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0', 'max:65535']],
            ],
        ],
        'projects' => [
            'title' => 'Projects',
            'model' => Project::class,
            'mirrors' => ['title_bn' => 'title_en', 'summary_bn' => 'summary_en', 'problem_bn' => 'problem_en', 'solution_bn' => 'solution_en', 'outcome_bn' => 'outcome_en'],
            'columns' => ['title_en', 'category', 'development_year'],
            'fields' => [
                'slug' => ['label' => 'URL slug', 'type' => 'text', 'rules' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:projects,slug']],
                'title_en' => ['label' => 'Title (English)', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'category' => ['label' => 'Category', 'type' => 'select', 'options' => ['web' => 'Web', 'software' => 'Software', 'mobile' => 'Mobile', 'other' => 'Other'], 'rules' => ['required', 'in:web,software,mobile,other']],
                'organization' => ['label' => 'Organization', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'role' => ['label' => 'Role', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'summary_en' => ['label' => 'Summary (English)', 'type' => 'textarea', 'rules' => ['required', 'string', 'max:5000']],
                'problem_en' => ['label' => 'Problem (English)', 'type' => 'textarea', 'rules' => ['nullable', 'string', 'max:5000']],
                'solution_en' => ['label' => 'Solution (English)', 'type' => 'textarea', 'rules' => ['nullable', 'string', 'max:5000']],
                'outcome_en' => ['label' => 'Outcome (English)', 'type' => 'textarea', 'rules' => ['nullable', 'string', 'max:5000']],
                'development_year' => ['label' => 'Year', 'type' => 'number', 'rules' => ['nullable', 'integer', 'between:1950,2100']],
                'status' => ['label' => 'Status', 'type' => 'text', 'rules' => ['required', 'string', 'max:100']],
                'cover_path' => ['label' => 'Cover image', 'type' => 'image', 'rules' => ['nullable', 'image', 'max:5120']],
                'live_url' => ['label' => 'Live URL', 'type' => 'url', 'rules' => ['nullable', 'url', 'max:2048']],
                'source_url' => ['label' => 'Source URL', 'type' => 'url', 'rules' => ['nullable', 'url', 'max:2048']],
                'is_published' => ['label' => 'Published', 'type' => 'checkbox', 'rules' => ['nullable', 'boolean']],
                'is_featured' => ['label' => 'Featured', 'type' => 'checkbox', 'rules' => ['nullable', 'boolean']],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0', 'max:65535']],
                'technology_ids' => ['label' => 'Technologies', 'type' => 'multiselect', 'options' => 'technologies', 'rules' => ['nullable', 'array'], 'item_rules' => ['integer', 'distinct', 'exists:technologies,id']],
            ],
        ],
        'technologies' => [
            'title' => 'Technologies',
            'model' => Technology::class,
            'columns' => ['name'],
            'fields' => [
                'name' => ['label' => 'Technology', 'type' => 'text', 'rules' => ['required', 'string', 'max:255', 'unique:technologies,name']],
            ],
        ],
        'project-images' => [
            'title' => 'Project images',
            'model' => ProjectImage::class,
            'mirrors' => ['alt_bn' => 'alt_en'],
            'columns' => ['project_id', 'alt_en', 'sort_order'],
            'fields' => [
                'project_id' => ['label' => 'Project', 'type' => 'select', 'options' => 'projects', 'rules' => ['required', 'exists:projects,id']],
                'image_path' => ['label' => 'Image', 'type' => 'image', 'rules' => ['required', 'image', 'max:5120']],
                'alt_en' => ['label' => 'Image alt (English)', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0', 'max:65535']],
            ],
        ],
        'freelance-profiles' => [
            'title' => 'Freelance profiles',
            'model' => FreelanceProfile::class,
            'mirrors' => ['service_bn' => 'service_en', 'details_bn' => 'details_en'],
            'columns' => ['platform', 'service_en', 'is_published'],
            'fields' => [
                'platform' => ['label' => 'Platform', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'profile_url' => ['label' => 'Profile URL', 'type' => 'url', 'rules' => ['required', 'url', 'max:2048']],
                'service_en' => ['label' => 'Service (English)', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'details_en' => ['label' => 'Details (English)', 'type' => 'textarea', 'rules' => ['nullable', 'string', 'max:5000']],
                'is_published' => ['label' => 'Published', 'type' => 'checkbox', 'rules' => ['nullable', 'boolean']],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0', 'max:65535']],
            ],
        ],
        'music' => [
            'title' => 'Music',
            'model' => MusicItem::class,
            'mirrors' => ['title_bn' => 'title_en', 'description_bn' => 'description_en'],
            'columns' => ['title_en', 'is_featured', 'is_published'],
            'fields' => [
                'title_en' => ['label' => 'Title (English)', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'description_en' => ['label' => 'Description (English)', 'type' => 'textarea', 'rules' => ['nullable', 'string', 'max:5000']],
                'youtube_url' => ['label' => 'YouTube URL', 'type' => 'url', 'rules' => ['nullable', 'url', 'max:2048']],
                'facebook_url' => ['label' => 'Facebook URL', 'type' => 'url', 'rules' => ['nullable', 'url', 'max:2048']],
                'image_path' => ['label' => 'Image', 'type' => 'image', 'rules' => ['nullable', 'image', 'max:5120']],
                'is_featured' => ['label' => 'Featured', 'type' => 'checkbox', 'rules' => ['nullable', 'boolean']],
                'is_published' => ['label' => 'Published', 'type' => 'checkbox', 'rules' => ['nullable', 'boolean']],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0', 'max:65535']],
            ],
        ],
        'photography-categories' => [
            'title' => 'Photography categories',
            'model' => PhotographyCategory::class,
            'mirrors' => ['name_bn' => 'name_en'],
            'columns' => ['name_en', 'slug', 'sort_order'],
            'fields' => [
                'slug' => ['label' => 'URL slug', 'type' => 'text', 'rules' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:photography_categories,slug']],
                'name_en' => ['label' => 'Name (English)', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0', 'max:65535']],
            ],
        ],
        'photographs' => [
            'title' => 'Photographs',
            'model' => Photograph::class,
            'columns' => ['title_en', 'location', 'is_published'],
            'fields' => [
                'photography_category_id' => ['label' => 'Category', 'type' => 'select', 'options' => 'photography-categories', 'rules' => ['nullable', 'exists:photography_categories,id']],
                'title_en' => ['label' => 'Title (English)', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'image_path' => ['label' => 'Image', 'type' => 'image', 'rules' => ['required', 'image', 'max:5120']],
                'location' => ['label' => 'Location', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'photographed_year' => ['label' => 'Year', 'type' => 'number', 'rules' => ['nullable', 'integer', 'between:1950,2100']],
                'story_en' => ['label' => 'Story (English)', 'type' => 'textarea', 'rules' => ['nullable', 'string', 'max:5000']],
                'camera' => ['label' => 'Camera', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'lens' => ['label' => 'Lens', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'is_featured' => ['label' => 'Featured', 'type' => 'checkbox', 'rules' => ['nullable', 'boolean']],
                'is_published' => ['label' => 'Published', 'type' => 'checkbox', 'rules' => ['nullable', 'boolean']],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0', 'max:65535']],
            ],
        ],
        'social-links' => [
            'title' => 'Social links',
            'model' => SocialLink::class,
            'columns' => ['platform', 'label', 'url'],
            'fields' => [
                'platform' => ['label' => 'Platform', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
                'label' => ['label' => 'Label', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
                'url' => ['label' => 'URL', 'type' => 'url', 'rules' => ['required', 'url', 'max:2048']],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => ['required', 'integer', 'min:0', 'max:65535']],
            ],
        ],
        'site-settings' => [
            'title' => 'Site settings',
            'model' => SiteSetting::class,
            'mirrors' => ['value_bn' => 'value_en'],
            'columns' => ['key', 'value_en'],
            'fields' => [
                'key' => ['label' => 'Key', 'type' => 'text', 'rules' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:site_settings,key']],
                'value_en' => ['label' => 'Value (English)', 'type' => 'textarea', 'rules' => ['nullable', 'string', 'max:5000']],
            ],
        ],
    ],
];
