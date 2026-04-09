@extends('layouts.app')

@section('content')
  <!-- ======= Hero Section ======= -->
  <section class="hero-section" id="hero">

    <div class="wave">

      <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
            <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z" id="Path"></path>
          </g>
        </g>
      </svg>

    </div>

    <div class="container">
        <div class="row align-items-center">
          <div class="col-12 hero-text-image">
            <div class="row">
              <div class="col-lg-6 text-center text-lg-left">
                <h2 data-aos="fade-right">Not sure about what career to pursue? Unhappy about your current job? </h2>
                <p class="mb-5" data-aos="fade-right" data-aos-delay="100">Sit for our online Career Preference Test assessment and explore career options that are compatible with your interests, skills, values, and personality. Get started and let you career take off !</p>
                <p data-aos="fade-right" data-aos-delay="200" data-aos-offset="-500"><a href="#" class="btn btn-outline-white">Take the Test Now</a></p>
              </div>
              <div class="col-lg-6 iphone-wrap">
                <img src="{{ asset('img/Home-banner-img.png') }}" alt="Image" class="phone-1" data-aos="fade-right">
              </div>
            </div>
          </div>
        </div>
      </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Home Section ======= -->
    {{-- <section class="section pt-4">
      <div class="container">

        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-5" data-aos="fade-up">
            <h2 class="section-heading">Find Your Personality Type</h2>
          </div>
        </div>

        <div class="row mb-5">
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon la la-tools"></span>
              </div>
              <h3 class="mb-3">Realistic </h3>
              <p>Practical individuals value tangible results and direct action.</p>
            </div>
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon la la-microscope"></span>
              </div>
              <h3 class="mb-3">Investigative </h3>
              <p>Analytical thinkers enjoy exploring ideas and solving complex problems.</p>
            </div>
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon la la-palette"></span>
              </div>
              <h3 class="mb-3">Artistic</h3>
              <p>Creative souls express themselves through various forms of art and design.</p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon la la-users"></span>
              </div>
              <h3 class="mb-3">Social</h3>
              <p>Caring people find fulfillment in helping others and building communities.</p>
            </div>
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon la la-lightbulb"></span>
              </div>
              <h3 class="mb-3">Enterprising </h3>
              <p>Ambitious individuals are driven to lead, innovate, and achieve goals.</p>
            </div>
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon la la-glasses"></span>
              </div>
              <h3 class="mb-3">Conventional </h3>
              <p>Organized minds appreciate structure, detail, and established procedures.</p>
            </div>
          </div>
        </div>

      </div>
    </section> --}}

    <section class="section">

      <div class="container">
        <div class="row justify-content-center mb-5" data-aos="fade">
          <div class="col-md-6 mb-5">
            <img src="{{ asset('img/career-assessment-test.jpg') }}" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-6 m-auto">
            <h2 class="mb-4"><span class="prefix-text">About Us</span></h2>
            <p class="mb-4">ark.com.my is wholly owned subsidiary of Ark Publications; a Career Guidance Center, Organizers of Higher Education Exhibitions & Training, and trusted Career Consultants since 1984. We help individuals, students, school-leavers, teachers, career counselors, working adults and parents in making and implementing informed educational and occupational choices which may lead to better social, financial and emotional well-being.

            </p>
          </div>

        </div>
      </div>

    </section>


  </main><!-- End #main -->
@endsection
