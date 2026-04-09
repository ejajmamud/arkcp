@extends('layouts.app')

@section('content')

<main id="main">


    <section class="section">
      <div class="container pt-5">
        
        <div class="row">
          <div class="col-md-5 ml-auto pt-5 order-2">
            <ul class="list-unstyled">
              <li class="mb-3">
                <div class="row">
                  <div class="col-2 feature-1">
                      <span class="icon las la-home"></span>
                  </div>
                  <div class="col-10 my-auto">
                    <strong class="d-block mb-1">Address</strong>
                    <span><b>Ark Publications</b><br>
                        (SA0275053-X)<br>
                        P.O Box 219,<br> 41916 Klang,
                        Selangor, <br>Malaysia.

                        </span>
                  </div>
                </div>

              </li>
              <li class="mb-3">
                <div class="row">
                  <div class="col-2 feature-1">
                      <span class="icon la la-envelope"></span>
                  </div>
                  <div class="col-10 my-auto">
                    <strong class="d-block mb-1">Email</strong>
                    <span><a href="mailto:enquiry@ark.com.my">enquiry@ark.com.my</a></span>
                  </div>
                </div>

              </li>
              <li class="mb-5">
                <div class="row">
                    <!--<img src="{{ asset('img/home/business-lady-do-multi-tasking.png') }}" class="img-fluid" />-->
                </div>
              </li>
            </ul>
          </div>

          <div class="col-md-6 mb-5 mb-md-0">
              <h2>Contact Us</h2>
             <p class="mb-4">Please get in touch with us if you have any questions or feedback about the test. </p>
            <form action="{{ route('contactsubmit') }}" method="post" role="form" class="php-email-form">
                @csrf
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  @if ($errors->has('name'))
                                       <div class="error">
                                             {{ $errors->first('name') }}
                                       </div>
                                    @endif
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Please enter a valid email" />
                  @if ($errors->has('email'))
                                       <div class="error">
                                             {{ $errors->first('email') }}
                                       </div>
                                    @endif
                  <div class="validate"></div>
                </div>
                <div class="col-md-12 form-group">
                  <label for="name">Subject</label>
                  <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  @if ($errors->has('subject'))
                                       <div class="error">
                                             {{ $errors->first('subject') }}
                                       </div>
                                    @endif
                  <div class="validate"></div>
                </div>
                <div class="col-md-12 form-group">
                  <label for="name">Message</label>
                  <textarea class="form-control" name="message" cols="30" rows="10" data-rule="required" data-msg="Please write something for us"></textarea>
                  @if ($errors->has('message'))
                                       <div class="error">
                                             {{ $errors->first('message') }}
                                       </div>
                                    @endif
                  <div class="validate"></div>
                </div>

                <div class="col-md-12 mb-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>

                <div class="offset-2 col-md-8 form-group">
                  <input type="submit" class="btn btn-primary btn-form d-block w-100" value="Send Message">
                </div>
              </div>

            </form>
          </div>

        </div>
      </div>
    </section>

    <section class="section cta-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-7 mr-auto text-center text-md-left mb-5 mb-md-0">
            <h2>Find A Career That Matches Your Personality</h2>
          </div>
          <div class="col-md-5 text-center text-md-right">
            <p> <a href="{{ url('registration') }}" class="btn"><span class="icofont-ui-play mr-3"></span>Start The Test</a></p>
          </div>
        </div>
      </div>
    </section><!-- End CTA Section -->

  </main><!-- End #main -->
@endsection
