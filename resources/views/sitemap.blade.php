{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach(['home', 'about', 'contact', 'projects.index', 'freelancing', 'music.index', 'photography.index'] as $routeName)
        <url><loc>{{ route($routeName) }}</loc></url>
    @endforeach
    @foreach($projects as $project)
        <url><loc>{{ route('projects.show', $project->slug) }}</loc><lastmod>{{ $project->updated_at->toAtomString() }}</lastmod></url>
    @endforeach
    @foreach($categories as $category)
        <url><loc>{{ route('photography.category', $category->slug) }}</loc><lastmod>{{ $category->updated_at->toAtomString() }}</lastmod></url>
    @endforeach
</urlset>
