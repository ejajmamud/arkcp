@extends('layouts.app')

@section('content')

  <main id="main">

    <!-- ======= Single Blog Section ======= -->
    <!--<section class="hero-section inner-page">-->
    <!--  <div class="wave">-->

    <!--    <svg width="1920px" height="285px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">-->
    <!--      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
    <!--        <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">-->
    <!--          <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z" id="Path"></path>-->
    <!--        </g>-->
    <!--      </g>-->
    <!--    </svg>-->

    <!--  </div>-->

    <!--  <div class="container">-->
    <!--    <div class="row align-items-center">-->
    <!--      <div class="col-12">-->
    <!--        <div class="row justify-content-center">-->
    <!--          <div class="col-md-10 text-center hero-text">-->

    <!--          </div>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->

    <!--</section>-->

    <section class="site-section mb-4 pt-5">
      <div class="container pt-5">
        <div class="row py-4">
          <div class="col-md-4 sidebar">
            <div class="sidebar-box" style="background: #f2f2f2;padding: 30px 35px;">
              <img src="{{asset('img/home/concept-of-importance-of-work-place-for-employees-in-business.png')}}"
                alt="Image placeholder" class="img-fluid mb-4">
              <h3>About Career Preference</h3>
              <p>Careerpreference.com is an initiative of Ark Publications; a career guidance resources publisher,
                organizers of higher education exhibitions & training, and trusted career consultants based in Kuala
                Lumpur Malaysia since 1984. </p>
              <p><a href="{{ url('registration') }}" class="btn btn-primary btn-sm">Take Career Test Now</a></p>
            </div>


          </div>
          <div class="col-md-8 blog-content">

            <h1>{{ $post->title }}</h1>
            <p class="mb-5" style="font-size: 14px;line-height: 26px;padding-top: 8px;">
              {{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a
                href="{{ url('/user/' . $post->author_id)}}">{{ $post->author->name }}</a></p>
            <img src="{{ asset('storage/blogassets/' . $post->file ?? '') }}" alt="Image" class="img-fluid py-4"
              style="width: 100%;max-height: 450px;object-fit: cover;">
            @if($post)
              <div>
                {!! $post->body !!}
              </div>
            @else
              404 error
            @endif
          </div>

        </div>
      </div>
    </section>

    <!-- ======= CTA Section ======= -->
    <section class="section cta-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 mr-auto text-center text-md-left mb-5 mb-md-0">
            <h2>Find A Perfect Career Fits Your Personality </h2>
          </div>
          <div class="col-md-5 text-center text-md-right">
            <p> <a href="#" class="btn"><span class="icofont-ui-play mr-3"></span>Start The Test</a></p>
          </div>
        </div>
      </div>
    </section><!-- End CTA Section -->

  </main><!-- End #main -->

@endsection