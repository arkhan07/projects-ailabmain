@extends('layouts.default')
@push('title', get_phrase('Home'))
@push('meta')@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/landingpage/css/globals.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/landingpage/css/styleguide.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/landingpage/css/style.css') }}" />
    <style>
        .landingpage-content {
            margin-top: -20px;
        }
    </style>
@endpush

@section('content')
@php
    $landingpage_settings = get_homepage_settings('landingpage', true) ?? [];

    // Hero Section
    $hero_title = $landingpage_settings['hero_title'] ?? '1001 Pioneer AI';
    $hero_subtitle = $landingpage_settings['hero_subtitle'] ?? 'Not Public. Built Quietly.';
    $hero_description = $landingpage_settings['hero_description'] ?? 'Halaman ini tidak dibuat untuk semua orang.';
    $hero_image = $landingpage_settings['hero_image'] ?? 'frontend/landingpage/img/image-1-dekstop.png';

    // Spotlight Section
    $spotlight_logos = [
        ['image' => $landingpage_settings['spotlight_logo_1'] ?? 'frontend/landingpage/img/tribun.png', 'alt' => $landingpage_settings['spotlight_logo_1_alt'] ?? 'Tribunnews'],
        ['image' => $landingpage_settings['spotlight_logo_2'] ?? 'frontend/landingpage/img/suara.png', 'alt' => $landingpage_settings['spotlight_logo_2_alt'] ?? 'Suara.com'],
        ['image' => $landingpage_settings['spotlight_logo_3'] ?? 'frontend/landingpage/img/tvone.png', 'alt' => $landingpage_settings['spotlight_logo_3_alt'] ?? 'tvOne'],
        ['image' => $landingpage_settings['spotlight_logo_4'] ?? 'frontend/landingpage/img/metro.png', 'alt' => $landingpage_settings['spotlight_logo_4_alt'] ?? 'Metro TV News'],
    ];

    // About AI Section
    $about_title = $landingpage_settings['about_title'] ?? 'Tentang AI (yang jarang dibahas)';
    $about_intro = $landingpage_settings['about_intro'] ?? 'Hari ini semua orang bisa belajar AI.';
    $about_list_title = $landingpage_settings['about_list_title'] ?? 'Tapi hanya sedikit yang:';
    $about_features = $landingpage_settings['about_features'] ?? ['Benar-benar membangun sesuatu', 'Mengubah AI menjadi leverage nyata'];
    $about_closing = $landingpage_settings['about_closing'] ?? 'Masalahnya bukan kurang pengetahuan.';

    // What Section
    $what_title = $landingpage_settings['what_title'] ?? 'Apa Itu 1001 AI Pioneers?';
    $what_intro = $landingpage_settings['what_intro'] ?? '1001 AI Pioneers adalah sebuah ekosistem tertutup';
    $what_list_title = $landingpage_settings['what_list_title'] ?? 'Tapi untuk:';
    $what_features = $landingpage_settings['what_features'] ?? ['Membangun produk dan use-case nyata'];
    $what_closing = $landingpage_settings['what_closing'] ?? 'Di sini, reputasi tidak dibangun dari opini.';

    // Why Different Section
    $why_title = $landingpage_settings['why_title'] ?? 'Kenapa Terasa Berbeda?';
    $why_list_title = $landingpage_settings['why_list_title'] ?? 'Karena:';
    $why_features = $landingpage_settings['why_features'] ?? ['Tidak semua akses dibuka sekaligus'];
    $why_closing = $landingpage_settings['why_closing'] ?? 'Sebagian orang masuk, lalu pergi.';

    // Access/Pricing Section
    $access_title = $landingpage_settings['access_title'] ?? 'Akses';
    $access_subtitle = $landingpage_settings['access_subtitle'] ?? 'Program ini berjalan dengan sistem berlangganan sederhana.';
    $pricing = $landingpage_settings['pricing'] ?? 'Rp 199.000';
    $pricing_period = $landingpage_settings['pricing_period'] ?? 'Per bulan';
    $pricing_note = $landingpage_settings['pricing_note'] ?? 'Tanpa kontrak jangka panjang.';
    $pricing_disclaimer = $landingpage_settings['pricing_disclaimer'] ?? '*Halaman ini tidak selalu tersedia untuk publik*';

    // CTA Links
    $cta_button_text = $landingpage_settings['cta_button_text'] ?? 'Masuk Ke 1001 Ai Pioneer';
    $cta_button_link = $landingpage_settings['cta_button_link'] ?? route('courses');

    // Section Visibility
    $show_spotlight = $landingpage_settings['show_spotlight'] ?? true;
    $show_about = $landingpage_settings['show_about'] ?? true;
    $show_what = $landingpage_settings['show_what'] ?? true;
    $show_why = $landingpage_settings['show_why'] ?? true;
    $show_pricing = $landingpage_settings['show_pricing'] ?? true;
@endphp

<div class="landingpage-content">
    <!-- Hero Section -->
    <section class="hero-section" id="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title animate-fade-up">{{ $hero_title }}</h1>
                <p class="hero-subtitle animate-fade-up delay-1">{{ $hero_subtitle }}</p>
                <div class="hero-description animate-fade-up delay-2">
                    {!! nl2br(e($hero_description)) !!}
                </div>
            </div>
        </div>
        <div class="hero-image animate-fade-in delay-3">
            <img src="{{ asset($hero_image) }}" alt="AI Pioneer Community Hero Image" />
        </div>
    </section>

    <!-- Spotlight Section -->
    @if($show_spotlight)
    <section class="spotlight-section" id="spotlight">
        <div class="spotlight-container">
            <h2 class="spotlight-title animate-on-scroll">Spotlight Ai Pioneer Community</h2>

            <!-- Desktop Logo Grid -->
            <div class="spotlight-logos-grid animate-on-scroll">
                @foreach($spotlight_logos as $logo)
                <div class="logo-item">
                    <img src="{{ asset($logo['image']) }}" alt="{{ $logo['alt'] }}" />
                </div>
                @endforeach
            </div>

            <!-- Mobile Logo Slider -->
            <div class="spotlight-slider animate-on-scroll">
                <div class="slider-track">
                    @foreach($spotlight_logos as $logo)
                    <div class="slider-item">
                        <img src="{{ asset($logo['image']) }}" alt="{{ $logo['alt'] }}" />
                    </div>
                    @endforeach
                </div>
                <div class="slider-dots">
                    @foreach($spotlight_logos as $index => $logo)
                    <span class="dot {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}"></span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Tentang AI Section -->
    @if($show_about)
    <section class="about-section" id="manifesto">
        <div class="about-container">
            <h2 class="section-title cyan animate-on-scroll">{{ $about_title }}</h2>
            <div class="section-content animate-on-scroll">
                <p class="intro-text">{!! nl2br(e($about_intro)) !!}</p>
                <div class="list-block">
                    <p class="list-title">{{ $about_list_title }}</p>
                    <ul class="feature-list">
                        @foreach($about_features as $feature)
                        <li><span class="bullet"></span><span>{{ $feature }}</span></li>
                        @endforeach
                    </ul>
                </div>
                <p class="closing-text">{!! nl2br(e($about_closing)) !!}</p>
            </div>
        </div>
    </section>
    @endif

    <!-- Apa Itu Section -->
    @if($show_what)
    <section class="what-section">
        <div class="what-container">
            <h2 class="section-title dark animate-on-scroll">{{ $what_title }}</h2>
            <div class="section-content animate-on-scroll">
                <p class="intro-text dark">{!! nl2br(e($what_intro)) !!}</p>
                <div class="list-block">
                    <p class="list-title dark">{{ $what_list_title }}</p>
                    <ul class="feature-list dark">
                        @foreach($what_features as $feature)
                        <li><span class="bullet"></span><span>{{ $feature }}</span></li>
                        @endforeach
                    </ul>
                </div>
                <p class="closing-text dark">{!! nl2br(e($what_closing)) !!}</p>
            </div>
        </div>
    </section>
    @endif

    <!-- Kenapa Berbeda Section -->
    @if($show_why)
    <section class="different-section">
        <div class="different-container">
            <h2 class="section-title cyan animate-on-scroll">{{ $why_title }}</h2>
            <div class="section-content animate-on-scroll">
                <div class="list-block">
                    <p class="list-title">{{ $why_list_title }}</p>
                    <ul class="feature-list">
                        @foreach($why_features as $feature)
                        <li><span class="bullet"></span><span>{{ $feature }}</span></li>
                        @endforeach
                    </ul>
                </div>
                <p class="closing-text">{!! nl2br(e($why_closing)) !!}</p>
            </div>
        </div>
    </section>
    @endif

    <!-- Akses Section -->
    @if($show_pricing)
    <section class="access-section" id="signup">
        <div class="access-container">
            <h2 class="section-title dark animate-on-scroll">{{ $access_title }}</h2>
            <p class="access-subtitle animate-on-scroll">{{ $access_subtitle }}</p>

            <div class="pricing-card animate-on-scroll">
                <p class="price">{{ $pricing }}</p>
                <div class="price-details">
                    <span>{{ $pricing_period }}</span>
                    <span class="dot"></span>
                    <span>Akses terbatas</span>
                </div>
            </div>

            <p class="access-note animate-on-scroll">
                {!! nl2br(e($pricing_note)) !!}
            </p>

            <a href="{{ $cta_button_link }}" class="btn-cta animate-on-scroll">
                <span class="btn-text">{{ $cta_button_text }}</span>
                <span class="btn-icon">
                    <img src="{{ asset('frontend/landingpage/img/image.svg') }}" alt="" class="arrow-icon" />
                </span>
            </a>

            <p class="disclaimer animate-on-scroll">{{ $pricing_disclaimer }}</p>
        </div>
    </section>
    @endif
</div>

@push('js')
<script>
    // Scroll Animation Observer
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });

    // Mobile Spotlight Slider
    const sliderTrack = document.querySelector('.slider-track');
    const sliderDots = document.querySelectorAll('.slider-dots .dot');
    const totalSlides = {{ count($spotlight_logos) }};
    let currentSlide = 0;
    let autoSlideInterval;

    function goToSlide(index) {
        currentSlide = index;
        if (sliderTrack) {
            sliderTrack.style.transform = `translateX(-${currentSlide * 100}%)`;
        }
        sliderDots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentSlide);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        goToSlide(currentSlide);
    }

    function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, 3000);
    }

    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    sliderDots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            stopAutoSlide();
            goToSlide(index);
            startAutoSlide();
        });
    });

    let touchStartX = 0;
    let touchEndX = 0;

    if (sliderTrack) {
        sliderTrack.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
            stopAutoSlide();
        });

        sliderTrack.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (diff > swipeThreshold) {
                currentSlide = Math.min(currentSlide + 1, totalSlides - 1);
                goToSlide(currentSlide);
            } else if (diff < -swipeThreshold) {
                currentSlide = Math.max(currentSlide - 1, 0);
                goToSlide(currentSlide);
            }
            startAutoSlide();
        });
    }

    startAutoSlide();
</script>
@endpush
@endsection
