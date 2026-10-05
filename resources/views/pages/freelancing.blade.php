@extends('layouts.app')
@section('title', 'Freelancing')
@section('description', 'Explore Sakib Nihal Arnab’s freelance web development, design, and digital services on Freelancer and Fiverr.')
@section('content')
<section class="container section freelance-page">
    <div class="section-heading"><h2>Freelance profiles</h2><p>Explore his work and discuss your project.</p></div>
    <div class="freelance-cards">
        @forelse($freelanceProfiles as $freelance)
            <article class="card">
                <p class="eyebrow">{{ $freelance->platform }}</p>
                <h2>{{ $freelance->service_en }}</h2>
                @if($freelance->details_en)<p>{{ $freelance->details_en }}</p>@endif
                <a class="button secondary" href="{{ $freelance->profile_url }}" target="_blank" rel="noopener noreferrer">View {{ $freelance->platform }} profile ↗</a>
            </article>
        @empty
            <p>Freelance profile details will be added soon.</p>
        @endforelse
    </div>

    @if($freelanceProfiles->contains('platform', 'Freelancer.com'))
        <section class="freelance-detail" id="freelancer" aria-labelledby="freelancer-heading">
            <p class="eyebrow">FREELANCER · {{ '@SNArnab' }}</p>
            <h2 id="freelancer-heading">Web Designer &amp; Developer, WordPress Expert</h2>
            <p>Sakib Nihal Arnab is a Computer Science &amp; Engineering graduate based in Bangladesh. He supports businesses with web design and development, graphic design, digital marketing, and data entry.</p>
            <p>Member since February 9, 2020 · Listed hourly rate: $3 USD / hour.</p>
            <dl class="freelance-stats">
                <div><dt>Profile rating</dt><dd>5.0 / 5</dd></div>
                <div><dt>Client reviews</dt><dd>22</dd></div>
                <div><dt>On time</dt><dd>99%</dd></div>
                <div><dt>On budget</dt><dd>98%</dd></div>
                <div><dt>Accept rate</dt><dd>100%</dd></div>
                <div><dt>Repeat hire rate</dt><dd>10%</dd></div>
            </dl>
            <p class="muted">Updated October 5, 2026 from his Freelancer profile. Visit the <a href="{{ $freelanceProfiles->firstWhere('platform', 'Freelancer.com')->profile_url }}" target="_blank" rel="noopener noreferrer">original profile</a> for current rates, figures, and client reviews.</p>
            <h3>Professional services</h3>
            <div class="freelance-cards">
                <article class="card"><h3>Web design &amp; development</h3><p>WordPress, PHP, and Laravel websites, with a focus on practical business needs.</p></article>
                <article class="card"><h3>Graphic design &amp; photo editing</h3><p>Logo and label design, business cards, banners, flyers, brochures, certificates, and invitations. Photo services include background removal or replacement, wedding image editing, portrait retouching, image manipulation, photo retouching, and image optimization for the web.</p></article>
                <article class="card"><h3>Data entry &amp; research</h3><p>Data entry, web research, lead generation, and product listing support.</p></article>
                <article class="card"><h3>Digital marketing</h3><p>Keyword research, social media marketing, and Facebook marketing support.</p></article>
            </div>
            <h3>Portfolio highlights</h3>
            <div class="freelance-cards">
                <article class="card"><h3>Research &amp; marketing</h3><p>Spreadsheet-based Facebook marketing research and SEO backlink research.</p></article>
                <article class="card"><h3>Logo &amp; club design</h3><p>Club artwork, including a BAUET Welfare Club design and a Bangladesh-themed graphic.</p></article>
                <article class="card"><h3>Lead generation</h3><p>Organized lead information in spreadsheets, including names, addresses, postal codes, and countries.</p></article>
                <article class="card"><h3>Product descriptions</h3><p>Product listing content with descriptions, features, and metadata, including a smartwatch example.</p></article>
            </div>
            <p>Explore his Freelancer profile to see the original artwork, portfolio images, and complete project details.</p>
            <h3>Professional expertise</h3>
            <p>His profile lists more than six years of experience across web design, graphics, digital marketing, and data entry, including over seven years with graphic design tools such as Photoshop, Lightroom, and Illustrator. He brings a CSE background and experience across different project types.</p>
            <h3>Client feedback</h3>
            <p>20 client reviews in their original wording, with ratings and project details. The Freelancer profile lists 22 reviews in total.</p>
            <div class="review-controls" aria-label="Review controls">
                <button type="button" class="button secondary small" data-review-previous aria-label="Previous review">← Previous</button>
                <button type="button" class="button secondary small" data-review-pause aria-pressed="false">Pause</button>
                <button type="button" class="button secondary small" data-review-next aria-label="Next review">Next →</button>
            </div>
            <div class="freelance-cards review-carousel" id="freelancer-reviews" tabindex="0" role="region" aria-label="Freelancer client reviews">
                @foreach(collect(config('freelancer-reviews'))->sortByDesc('rating') as $review)
                    <article class="card review-card">
                        <div class="review-rating"><span aria-hidden="true">★</span><strong>{{ $review['rating'] }}<small> / 5</small></strong><span class="review-source">Freelancer</span></div>
                        <blockquote class="review-comment">{{ $review['comment'] }}</blockquote>
                        <h3 class="review-project">{{ $review['project'] }}</h3>
                        <div class="review-client"><span class="review-avatar" aria-hidden="true">{{ mb_substr($review['name'], 0, 1) }}</span><div><strong>{{ $review['name'] }}</strong>@if($review['country'])<span>{{ $review['country'] }}</span>@endif</div><span class="review-value">{{ $review['price'] }}</span></div>
                    </article>
                @endforeach
            </div>
            <a class="button secondary" href="{{ $freelanceProfiles->firstWhere('platform', 'Freelancer.com')->profile_url }}" target="_blank" rel="noopener noreferrer">Explore portfolio &amp; client reviews ↗</a>
        </section>
    @endif
    @if($freelanceProfiles->contains('platform', 'Fiverr'))
        <section class="freelance-detail" id="fiverr" aria-labelledby="fiverr-heading">
            <p class="eyebrow">FIVERR · {{ '@s_n_arnab' }}</p>
            <h2 id="fiverr-heading">Social Media Promoter and Graphics Designer</h2>
            <p>Sakib Nihal Arnab is a Computer Science &amp; Engineering graduate based in Bangladesh. His Fiverr services cover web design and development, graphic design, data entry, web research, and social media marketing.</p>
            <p>On Fiverr since January 2020.</p>
            <dl class="freelance-stats">
                <div><dt>Profile rating</dt><dd>4.9 / 5</dd></div>
                <div><dt>Client reviews</dt><dd>63</dd></div>
                <div><dt>Completed orders</dt><dd>110+</dd></div>
                <div><dt>On-time delivery</dt><dd>100%</dd></div>
                <div><dt>Unique clients</dt><dd>49</dd></div>
                <div><dt>Seller level</dt><dd>Level 2</dd></div>
            </dl>
            <p class="muted">Updated October 5, 2026 from his public Fiverr profile and dashboard. Analytics shows 110 completed orders, while Manage Orders shows 111.</p>
            <h3>Skills &amp; services</h3>
            <div class="freelance-cards">
                <article class="card"><h3>Graphic design &amp; photography</h3><p>Logo design, certificates, flyers, brochures, business cards, banners, ID cards, and T-shirt designs. Photo services include background removal or replacement, wedding image editing, portrait retouching, and image optimization for the web. Tools: Adobe Photoshop, Illustrator, and Lightroom.</p></article>
                <article class="card"><h3>Web &amp; social media</h3><p>Custom-coded websites, WordPress websites, web application development, and social media marketing.</p></article>
                <article class="card"><h3>Data &amp; document support</h3><p>Data entry, lead generation, web research, typing, and Microsoft Word.</p></article>
                <article class="card"><h3>Audio &amp; photography</h3><p>Audacity audio editing and photography are also listed among his Fiverr profile skills.</p></article>
            </div>
            <h3>Languages</h3>
            <dl class="freelance-stats">
                <div><dt>English</dt><dd>Fluent</dd></div>
                <div><dt>Bengali</dt><dd>Native / Bilingual</dd></div>
                <div><dt>Hindi</dt><dd>Conversational</dd></div>
            </dl>
            <h3>Education</h3>
            <ul>
                <li>Government Laboratory High School, Rajshahi — Secondary School Certificate (SSC), 2012.</li>
                <li>Rajshahi Collegiate School &amp; College — Higher Secondary School Certificate (HSC), 2014.</li>
                <li>Bangladesh Army University of Engineering &amp; Technology — B.Sc. in Computer Science, 2019.</li>
            </ul>
            <h3>Client relationships &amp; feedback</h3>
            <div class="freelance-cards">
                <article class="card">
                    <h3>Repeat client relationships</h3>
                    <p>He has worked with 49 unique clients on Fiverr. The order history also shows clients returning for multiple projects, including completed orders throughout March and April 2021.</p>
                </article>
                <article class="card">
                    <h3>Positive order feedback</h3>
                    <p>Several completed orders received five-star reviews, including orders delivered on March 10, March 11, March 14, March 23, April 9, April 15, April 16, and May 6, 2021.</p>
                </article>
            </div>
            <p>Explore his Fiverr profile for available gigs and discuss the requirements for your next project.</p>
            <h3>Fiverr client reviews</h3>
            <p>Client feedback in its original wording, with ratings and review dates.</p>
            <div class="review-controls" aria-label="Fiverr review controls">
                <button type="button" class="button secondary small" data-review-previous aria-label="Previous Fiverr review">← Previous</button>
                <button type="button" class="button secondary small" data-review-pause aria-pressed="false">Pause</button>
                <button type="button" class="button secondary small" data-review-next aria-label="Next Fiverr review">Next →</button>
            </div>
            <div class="freelance-cards review-carousel" id="fiverr-reviews" tabindex="0" role="region" aria-label="Fiverr client reviews">
                @foreach(collect(config('fiverr-reviews'))->sortByDesc('rating') as $review)
                    <article class="card review-card">
                        <div class="review-rating"><span aria-hidden="true">★</span><strong>{{ $review['rating'] }}<small> / 5</small></strong><span class="review-source">Fiverr</span></div>
                        <blockquote class="review-comment">{{ $review['comment'] }}</blockquote>
                        <p class="review-project">Instagram promotion · {{ $review['date'] }}</p>
                        <div class="review-client"><span class="review-avatar" aria-hidden="true">{{ strtoupper(mb_substr($review['name'], 0, 1)) }}</span><div><strong>{{ $review['name'] }}</strong></div><span class="review-value">{{ $review['price'] }}</span></div>
                    </article>
                @endforeach
            </div>
            <a class="button secondary" href="{{ $freelanceProfiles->firstWhere('platform', 'Fiverr')->profile_url }}" target="_blank" rel="noopener noreferrer">Hire Sakib on Fiverr ↗</a>
        </section>
    @endif
    <section class="freelance-detail">
        <h2>Have a project in mind?</h2>
        <p>Share your requirements, timeline, and expected deliverables. Contact Sakib Nihal Arnab here or through his marketplace profiles.</p>
        <a class="button" href="{{ route('contact') }}">Discuss your project</a>
    </section>
</section>
<script src="{{ asset('js/freelance-reviews.js') }}?v={{ filemtime(public_path('js/freelance-reviews.js')) }}" defer></script>
@endsection
