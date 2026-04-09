@extends('layouts.app')

@section('content')

<main id="main">

    <!-- ======= Single Blog Section ======= -->
    <section class="hero-section inner-page">
      <div class="wave">

        <svg width="1920px" height="265px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
              <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z" id="Path"></path>
            </g>
          </g>
        </svg>

      </div>

      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">
            <div class="row justify-content-center">
              <div class="col-md-10 text-center hero-text">
                <h1 data-aos="fade-up" data-aos-delay="" style="color:white;">{{ $post->title }}</h1>
                <p class="mb-5" data-aos="fade-up" data-aos-delay="100">{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

    <section class="site-section mb-4">
      <div class="container">
        <div class="row">
          <div class="col-md-8 blog-content">
            @if($post)
                <div>
                    {!! $post->body !!}
                </div>
                <div>
                    <h2>Leave a comment</h2>
                </div>
                @if(Auth::guest())
                    <p>Login to Comment</p>
                @else
                    <div class="panel-body">
                    <form method="post" action="/comment/add">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="on_post" value="{{ $post->id }}">
                        <input type="hidden" name="slug" value="{{ $post->slug }}">
                        <div class="form-group">
                        <textarea required="required" placeholder="Enter comment here" name = "body" class="form-control"></textarea>
                        </div>
                        <input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
                    </form>
                    </div>
                @endif
                <div>
                    @if($comments)
                    <ul style="list-style: none; padding: 0">
                    @foreach($comments as $comment)
                        <li class="panel-body">
                        <div class="list-group">
                            <div class="list-group-item">
                            <h3>{{ $comment->author->name }}</h3>
                            <p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                            </div>
                            <div class="list-group-item">
                            <p>{{ $comment->body }}</p>
                            </div>
                        </div>
                        </li>
                    @endforeach
                    </ul>
                    @endif
                </div>
                @else
                404 error
                @endif
          </div>
          <div class="col-md-4 sidebar">
            <div class="sidebar-box">
              <img src="{{asset('img/online-test.jpg')}}" alt="Image placeholder" class="img-fluid mb-4">
              <h3>About Career Test</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
              <p><a href="#" class="btn btn-primary btn-sm">Take Career Test Now</a></p>
            </div>


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
