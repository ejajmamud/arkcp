@extends('layouts.app')

@section('content')
    <section class="section pb-2 overflow-hidden">
        @if(!$questions)
            <div class="container pt-5" style="min-height: 500px">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h1 class="mb-4">You have already completed the test.</h1>
                        <a href="https://cptest.ark.com.my/registration" class="btn btn-primary aos-init aos-animate">
                            Click here to take the test again
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="container pt-5">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <h2>Career Assessment</h2>
                                <p class="mb-4 px-2">
                                    Select the "Like" box next to the activities you would like to do. Select "Dislike"
                                    box next to activities you dislike doing or would be indifferent (neutral) to.<br>
                                    This test takes approximately 10 mins to complete. There are no wrong answers!<br><br>
                                    A personalized report and suggested careers will be generated once you complete this test.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="multisteps-form">
                    <!--progress bar-->
                    <div class="row">
                        <div class="col-12 col-lg-8 ml-auto mr-auto mb-4">
                            <div class="multisteps-form__progress">
                                @for($i = 1; $i <= 8; $i++)
                                    <button class="multisteps-form__progress-btn js-progress-btn {{$i == 1 ? 'js-active' : ''}}" 
                                            type="button" data-step="{{$i}}" title="Section {{$i}}"></button>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <!--form panels-->
                    <div class="row">
                        <div class="col-12 col-lg-8 m-auto">
                            <form class="multisteps-form__form" method="post" action="{{ route('test.submit') }}" id="testsubmit">
                                @csrf
                                <input type="hidden" name="email" value="{{ request()->get('email') }}">
                                <input type="hidden" name="uniqueid" value="{{ $uid }}">
                                <input type="hidden" name="current_step" id="current_step" value="1">

                                @php
                                    // Split questions into 8 parts (approximately 15 per page)
                                    $questionsPerPage = ceil(count($questions) / 8);
                                    $chunkedQuestions = array_chunk($questions->toArray(), $questionsPerPage);
                                @endphp

                                @foreach($chunkedQuestions as $page => $pageQuestions)
                                <!-- Form panel {{$page + 1}} -->
                                <div class="multisteps-form__panel shadow p-4 rounded bg-white {{$page == 0 ? 'js-active' : ''}}" data-step="{{$page + 1}}">
                                    <div class="multisteps-form__content">
                                        <div class="row mb-3">
                                            <div class="col-9 col-sm-9">
                                                <h5>Activity (Section {{$page + 1}} of 8)</h5>
                                            </div>
                                            <div class="col-3 col-sm-3">
                                                <div class="row">
                                                    <div class="col-6 text-center">
                                                        <span class="radio-head">Like</span>
                                                    </div>
                                                    <div class="col-6 text-center">
                                                        <span class="radio-head">Dislike</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @foreach($pageQuestions as $index => $question)
                                            @php 
                                                $globalIndex = ($page * $questionsPerPage) + $index;
                                            @endphp
                                            <div class="row mb-3">
                                                <div class="col-9 col-sm-9">
                                                    <label>{{ $question['question_text'] }}</label>
                                                    <input type="hidden" name="test[{{$globalIndex}}][uid]" value="{{ $uid }}">
                                                    <input type="hidden" name="test[{{$globalIndex}}][email]" value="{{ request()->get('email') }}">
                                                    <input type="hidden" name="test[{{$globalIndex}}][type]" value="{{ $question['personalitytype'] }}">
                                                    <input type="hidden" name="test[{{$globalIndex}}][question]" value="{{ $question['question_text'] }}">
                                                </div>
                                                <div class="col-3 col-sm-3">
                                                    <div class="row">
                                                        <div class="col-6 text-center">
                                                            <input class="form-check-input" type="radio" 
                                                                   name="test[{{$globalIndex}}][answer]" value="yes" required>
                                                        </div>
                                                        <div class="col-6 text-center">
                                                            <input class="form-check-input" type="radio" 
                                                                   name="test[{{$globalIndex}}][answer]" value="no">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="button-row d-flex mt-4">
                                            @if($page > 0)
                                                <button class="btn btn-secondary js-btn-prev" type="button">Previous</button>
                                            @endif

                                            @if($page < count($chunkedQuestions) - 1)
                                                <button class="btn btn-primary ml-auto js-btn-next" type="button">Next</button>
                                            @else
                                                <button class="btn btn-success ml-auto" type="submit">Submit Test</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection

@section('script')
    <!-- Script for time limitation of exam -->
    <script type="text/javascript">
        // Timeout after 10 minutes (600000ms)
        setTimeout(function() {
            alert('Time Out');
            document.getElementById("testsubmit").submit();
        }, 600000);
        
        // Multistep form functionality
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.multisteps-form__form');
            const panels = document.querySelectorAll('.multisteps-form__panel');
            const progressBtns = document.querySelectorAll('.js-progress-btn');
            const currentStepInput = document.getElementById('current_step');
            
            let currentStep = 1;

            // Next button click handler
            document.querySelectorAll('.js-btn-next').forEach(btn => {
                btn.addEventListener('click', function() {
                    // Validate current step before proceeding
                    const currentPanel = document.querySelector(`.multisteps-form__panel[data-step="${currentStep}"]`);
                    const requiredRadios = currentPanel.querySelectorAll('input[type="radio"][required]');
                    let allAnswered = true;
                    
                    requiredRadios.forEach(radio => {
                        const name = radio.getAttribute('name');
                        if (!document.querySelector(`input[name="${name}"]:checked`)) {
                            allAnswered = false;
                        }
                    });
                    
                    if (!allAnswered) {
                        alert('Please answer all questions before proceeding.');
                        return;
                    }

                    // Proceed to next step
                    goToStep(currentStep + 1);
                });
            });
            
            // Previous button click handler
            document.querySelectorAll('.js-btn-prev').forEach(btn => {
                btn.addEventListener('click', function() {
                    goToStep(currentStep - 1);
                });
            });
            
            // Progress button click handler
            progressBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const step = parseInt(this.getAttribute('data-step'));
                    if (step < currentStep) {
                        goToStep(step);
                    }
                });
            });
            
            function goToStep(step) {
                // Hide current panel
                document.querySelector(`.multisteps-form__panel[data-step="${currentStep}"]`).classList.remove('js-active');
                document.querySelector(`.multisteps-form__progress-btn[data-step="${currentStep}"]`).classList.remove('js-active');
                
                // Show new panel
                document.querySelector(`.multisteps-form__panel[data-step="${step}"]`).classList.add('js-active');
                document.querySelector(`.multisteps-form__progress-btn[data-step="${step}"]`).classList.add('js-active');
                
                // Update current step
                currentStep = step;
                currentStepInput.value = currentStep;
                
                // Scroll to top of form
                form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    </script>
    
    <style>
        .multisteps-form__progress {
            display: flex;
            justify-content: space-between;
            margin: 0 auto;
            padding: 0;
            position: relative;
            max-width: 600px;
        }

        .multisteps-form__progress:before {
            content: '';
            display: block;
            height: 2px;
            width: 100%;
            background-color: #e9ecef;
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            z-index: 1;
        }

        .multisteps-form__progress-btn {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: #e9ecef;
            border: none;
            position: relative;
            z-index: 2;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0;
        }

        .multisteps-form__progress-btn.js-active {
            background-color: #007bff;
            transform: scale(1.2);
        }

        .multisteps-form__progress-btn.js-active ~ .multisteps-form__progress:before {
            background-color: #007bff;
        }

        .multisteps-form__panel {
            display: none;
        }

        .multisteps-form__panel.js-active {
            display: block;
        }

        .radio-head {
            font-weight: bold;
            font-size: 0.9rem;
        }

        .button-row {
            margin-top: 2rem;
        }

        .btn-secondary {
            margin-right: 10px;
        }
    </style>
@endsection
