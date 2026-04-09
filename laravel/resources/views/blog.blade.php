@extends('layouts.app')

@section('content')


  <main id="main">

    <!-- ======= Blog Section ======= -->
    <section class="hero-section inner-page">
      <div class="wave">

        <svg width="1920px" height="265px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
              <path
                d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z"
                id="Path"></path>
            </g>
          </g>
        </svg>

      </div>

      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="row justify-content-center">
              <div class="col-md-7 text-center hero-text">
                <h1 data-aos="fade-up" data-aos-delay="">Blog Posts</h1>
                <p class="mb-5" data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet, consectetur
                  adipisicing elit.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

    <section class="section">
      <div class="container">
        <div class="row mb-5">
          @if (!$posts->count())
            <div class="col-md-12">
              <h3 class="text-info">There is no post till now. Login and write a new post now!!!</h3>
            </div>
          @else
            @foreach($posts as $post)
              <div class="col-md-4">
                <div class="post-entry">
                  <a href="{{ url('/' . $post->slug) }}" class="d-block mb-4">
                    <img src="{{ asset('storage/blogassets/' . $post->file ?? '') }}" alt="Image" class="img-fluid">
                  </a>
                  <div class="post-text">
                    <span class="post-meta">{{ $post->created_at->format('M d,Y \a\t h:i a') }} &bullet; By <a
                        href="{{ url('/user/' . $post->author_id)}}">Admin</a></span>
                    <h3><a href="{{ url('/' . $post->slug) }}">{{ $post->title }}</a></h3>
                    <p>
                      {!! Str::limit($post->body, $limit = 100, $end = '....... <a href=' . url("/" . $post->slug) . '  class="readmore">Read More</a>') !!}
                    </p>
                  </div>
                </div>
              </div>
            @endforeach
            {!! $posts->render() !!}
          @endif

        </div>

        <div class="row">
          <div class="col-12 text-center">
            <span class="p-3 active text-primary">1</span>
            <a href="#" class="p-3">2</a>
            <a href="#" class="p-3">3</a>
            <a href="#" class="p-3">4</a>
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