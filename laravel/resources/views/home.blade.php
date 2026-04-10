@extends('layouts.app')

@section('content')

  <main id="main">
      
        <!-- ======= Hero Section ======= -->
      <section class="section pt-5">
        <div class="container">
          <div class="row py-5 align-items-center">
                <div class="col-lg-6 pr-lg-5 text-center text-lg-left">
                  <h2 class="mb-3">How to Choose a Career That Suits You Best</h2>
                  <p class="mb-3" style="font-size: 20px;">
                        Career Preference is an online career test that helps you explore career options that are compatible with your interests, skills, values and personality by answering
                        some simple questions online.
                        <br><br>
                        You tend to enjoy your job and be successful at it when you choose a career that matches your interest. Let’s get started!
                  </p>
                  <a href="{{ route('registration.index') }}" class="btn btn-primary">Start Career Test</a>
                  
                </div>
                <div class="col-lg-6">
                  <img
                    src="{{ $banner ? asset('storage/banner/'.$banner) : asset('storage/banner/uafltSXFdbDipkV2isBUuyl7UuAKiz4IiHW3QoZk.png') }}?v=20260410-3"
                    alt="Hero image"
                    class="img-fluid">
                </div>
          </div>
        </div>
    
      </section><!-- End Hero -->

    <section class="section">

      <div class="container">
        <div class="row justify-content-center align-items-center mb-5">
          <div class="col-md-6 mb-5">
            <img src="{{ asset('img/home/Hollands_Hexagon_Image_copy.png') }}" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-6 m-auto">
            <h2 class="mb-4">About Career Preference</h2>
            <p class="mb-4">
                The Career Preference Test is based on Dr John
                Holland's theory on career choices. The theory suggests that
                people prefer jobs where they can be around others who are
                like them. They search for environments that will let them
                use their skills and abilities, and express their attitudes and
                values, while taking on problems and roles that they enjoy.
                <br><br>
                According to the theory most people can be classified into
                six personality types: Realistic, Investigative, Artistic, Social,
                Enterprising, and Conventional (commonly abbreviated with
                the acronym RIASEC). Each type is characterized by the
                individual's interests, preferred activities, beliefs, abilities,
                values, and characteristics.
                <br><br>
                Based on the test scores, the system will generate a three-letter
                code (Holland Code) that is made up of an individual's three
                dominant personality types out of six possible choices and
                suggest a list of careers that match those codes.
                
            </p>
          </div>

        </div>
      </div>

    </section> 
    <section class="section">
      <div class="container">
        <div class="row align-items-center justify-content-center">
           <h2 class="mb-5">Personality Types</h2>
        </div>
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="mb-4">
                    <h4>REALISTIC (DOERS)</h4>
                    <p>People who have athletic or mechanical ability, prefer to work with objects, machines, tools, plants, animals or to be outdoors</p>
                </div>
                <div class="mb-4">
                    <h4>CONVENTIONAL (ORGANIZERS)</h4>
                    <p>People who like to work with data, have clerical or numerical ability, carrying things out in detail, or following through on others’ instructions.</p>
                </div>
                <div class="mb-4">
                    <h4>ENTERPRISING (PERSUADERS)</h4>
                    <p>People who like to work with people, influencing, persuading, performing, leading / managing for organizational or economic goal.</p>
                </div>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('img/home/Personality-Types.png') }}" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-4">
                <div class="mb-4">
                    <h4>INVESTIGATIVE (THINKERS)</h4>
                    <p>People who like to observe, learn, investigate, analyze, evaluate or solve problems.</p>
                </div>
                <div class="mb-4">
                    <h4>ARTISTIC (CREATORS)</h4>
                    <p>People who have artistic, innovating or intuitional abilities, like to work in unstructured situations using their imagination or creativity.</p>
                </div>
                <div class="mb-4">
                    <h4>SOCIAL (HELPERS)</h4>
                    <p>People who like to work with people, to inform, enlighten, help, train, develop or cure them, or are skilled with words.</p>
                </div>
            </div>
        </div>
      </div>
    </section>
    
    
    <section class="section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 mr-auto">
            <h2 class="mb-4">Who can take the test?</h2>
            <h4>Students, Working Adults & Career Counsellors</h4>
            <p class="mb-4">
                
                Career Preference is a valuable tool in helping students find
                potential career pathways that naturally align with them, based
                on their interests.
                <br><br>
                Career consultants can also use the tool to provide career
                guidance services based on clients’ test results and match them
                with courses and institutions of higher learning.
                <br><br>
                The tool is also suitable for working adults who are not
                satisfied with their current job and would like to make a
                mid-career switch or explore other career options available to
                them.
            
            </p>
           
          </div>
          <div class="col-md-6 text-center">
            <img src="{{ asset('img/home/concept-of-importance-of-work-place-for-employees-in-business.png') }}" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-5 ml-auto order-2">
            <h2 class="mb-4">Are you hiring the right candidate for the job?</h2>
            <h4>HR Professionals & Recruiters</h4>
            <p class="mb-4">
                As a HR Professional or Recruiter, you could use this as a
pre-employment test for job candidates. Employees are generally
more satisfied when they are doing work they like or are good at.
So, this is a good way to see if a candidate is the right
personality type for the job on offer.                
            </p>

          </div>
          <div class="col-md-6">
            <img src="{{ asset('img/home/team-building-importance-in-business-success.png') }}" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </section>

    <!-- ======= CTA Section ======= -->
     <section class="section cta-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-9 mr-auto text-center text-md-left mb-5 mb-md-0">
            <h3 class="text-white">The test only takes about 15 minutes to
                complete and you will receive a comprehensive list of
                careers that might be a good match for you.</h3>
          </div>
          <div class="col-md-3 text-center text-md-right">
            <p> <a href="{{ route('registration.index') }}" class="btn"><span class="icofont-ui-play mr-3"></span>Start Career Test</a></p>
          </div>
        </div>
      </div>
    </section><!-- End CTA Section -->


    <!-- ======= Testimonials Section ======= -->
    <!-- <section class="section border-top border-bottom">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-4">
            <h2 class="section-heading">Review From Our Users</h2>
          </div>
        </div>
        <div class="row justify-content-center text-center">
          <div class="col-md-7">
            <div class="owl-carousel testimonial-carousel">
              <div class="review text-center">
                <p class="stars">
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star muted"></span>
                </p>
                <h3>Excellent App!</h3>
                <blockquote>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea delectus pariatur, numquam
                    aperiam dolore nam optio dolorem facilis itaque voluptatum recusandae deleniti minus animi,
                    provident voluptates consectetur maiores quos.</p>
                </blockquote>

                <p class="review-user">
                  <img src="img/person_1.jpg" alt="Image" class="img-fluid rounded-circle mb-3">
                  <span class="d-block">
                    <span class="text-black">Jean Doe</span>, &mdash; App User
                  </span>
                </p>

              </div>

              <div class="review text-center">
                <p class="stars">
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star muted"></span>
                </p>
                <h3>This App is easy to use!</h3>
                <blockquote>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea delectus pariatur, numquam
                    aperiam dolore nam optio dolorem facilis itaque voluptatum recusandae deleniti minus animi,
                    provident voluptates consectetur maiores quos.</p>
                </blockquote>

                <p class="review-user">
                  <img src="{{ asset('img/person_2.jpg') }}" alt="Image" class="img-fluid rounded-circle mb-3">
                  <span class="d-block">
                    <span class="text-black">Johan Smith</span>, &mdash; App User
                  </span>
                </p>

              </div>

              <div class="review text-center">
                <p class="stars">
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star"></span>
                  <span class="icofont-star muted"></span>
                </p>
                <h3>Awesome functionality!</h3>
                <blockquote>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea delectus pariatur, numquam
                    aperiam dolore nam optio dolorem facilis itaque voluptatum recusandae deleniti minus animi,
                    provident voluptates consectetur maiores quos.</p>
                </blockquote>

                <p class="review-user">
                  <img src="{{ asset('img/person_3.jpg') }}" alt="Image" class="img-fluid rounded-circle mb-3">
                  <span class="d-block">
                    <span class="text-black">Jean Thunberg</span>, &mdash; App User
                  </span>
                </p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <!-- End Testimonials Section -->

    <!-- ======= Blog Posts Section ======= -->
    <!-- <section class="section border-top border-bottom pb-5">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-4">
            <h2 class="section-heading">Blog Posts</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="post-entry">
              <a href="blog-single.html" class="d-block mb-4">
                <img src="{{ asset('img/img_1.jpg') }}" alt="Image" class="img-fluid">
              </a>
              <div class="post-text">
                <span class="post-meta">December 13, 2019 &bullet; By <a href="#">Admin</a></span>
                <h3><a href="#">Chrome now alerts you when someone steals your password</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, optio.</p>
                <p><a href="#" class="readmore">Read more</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="post-entry">
              <a href="blog-single.html" class="d-block mb-4">
                <img src="{{ asset('img/img_2.jpg') }}" alt="Image" class="img-fluid">
              </a>
              <div class="post-text">
                <span class="post-meta">December 13, 2019 &bullet; By <a href="#">Admin</a></span>
                <h3><a href="#">Chrome now alerts you when someone steals your password</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, optio.</p>
                <p><a href="#" class="readmore">Read more</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="post-entry">
              <a href="blog-single.html" class="d-block mb-4">
                <img src="{{ asset('img/img_3.jpg') }}" alt="Image" class="img-fluid">
              </a>
              <div class="post-text">
                <span class="post-meta">December 13, 2019 &bullet; By <a href="#">Admin</a></span>
                <h3><a href="#">Chrome now alerts you when someone steals your password</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, optio.</p>
                <p><a href="#" class="readmore">Read more</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!-- End Blog Posts Section -->


  </main><!-- End #main -->
@endsection
