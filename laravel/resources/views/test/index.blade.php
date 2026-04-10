@extends('layouts.app')

@section('content')
<section class="section" style="padding-top: 100px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="multisteps-form">
                    <!-- Progress Bar -->
                    <div class="row">
                        <div class="col-12 col-lg-10 ml-auto mr-auto mb-4">
                            <div class="multisteps-form__progress">
                                @php
                                    $chunkSize = 12;
                                    $chunks = $questions->chunk($chunkSize);
                                @endphp
                                @foreach($chunks as $pageIndex => $chunk)
                                    <button class="multisteps-form__progress-btn {{ $pageIndex == 0 ? 'js-active' : '' }}" type="button" title="Page {{ $pageIndex + 1 }}">
                                        Page {{ $pageIndex + 1 }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Form Panels -->
                    <div class="row">
                        <div class="col-12 col-lg-10 m-auto">
                            <form class="multisteps-form__form" action="{{ route('test.submit') }}" method="POST" style="height: auto;">
                                @csrf
                                <input type="hidden" name="email" value="{{ request()->get('email') }}">
                                <input type="hidden" name="uniqueid" value="{{ $uid }}">

                                @foreach($chunks as $pageIndex => $chunk)
                                    <div class="multisteps-form__panel shadow p-4 rounded bg-white {{ $pageIndex == 0 ? 'js-active' : '' }}" data-animation="scaleIn">
                                        <h3 class="multisteps-form__title mb-4">Questions {{ $loop->iteration }} ({{ $chunk->count() }} items)</h3>
                                        
                                        <div class="multisteps-form__content">
                                            @foreach($chunk as $question)
                                                <div class="form-group mb-4 question-card border-bottom pb-3"> <!-- Added question-card class for JS validation -->
                                                    <label class="d-block mb-2 font-weight-bold text-dark">{{ $question->question_text }}</label>
                                                    <div class="d-flex align-items-center">
                                                        <div class="custom-control custom-radio mr-4">
                                                            <input type="radio" id="q{{ $question->id }}_yes" name="test[{{ $pageIndex }}][{{ $question->id }}][answer]" value="yes" class="custom-control-input">
                                                            <label class="custom-control-label" for="q{{ $question->id }}_yes">
                                                                <span class="text-success"><i class="icofont-thumbs-up"></i> Like / Suka</span>
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="q{{ $question->id }}_no" name="test[{{ $pageIndex }}][{{ $question->id }}][answer]" value="no" class="custom-control-input">
                                                            <label class="custom-control-label" for="q{{ $question->id }}_no">
                                                                <span class="text-danger"><i class="icofont-thumbs-down"></i> Dislike / Tidak Suka</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="test[{{ $pageIndex }}][{{ $question->id }}][type]" value="{{ $question->personalitytype }}">
                                                </div>
                                            @endforeach

                                            <div class="button-row d-flex mt-4">
                                                @if(!$loop->first)
                                                    <button class="btn btn-outline-secondary ml-auto js-btn-prev" type="button" title="Prev">Previous</button>
                                                @endif
                                                
                                                @if($loop->last)
                                                    <button class="btn btn-success ml-auto" type="submit" title="Submit">Submit Test</button>
                                                @else
                                                    <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
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
        </div>
    </div>
</section>

@endsection

@section('script')
<style>
    /* Styling overrides to ensure visibility */
    .multisteps-form__progress {
        position: relative;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 0;
        width: 100%;
        margin: 0 auto;
        padding-top: 20px;
    }
    .multisteps-form__progress::before {
        content: '';
        position: absolute;
        top: 10px;
        left: 16px;
        right: 16px;
        height: 2px;
        background-color: #d9e2ec;
        z-index: 1;
    }
    .multisteps-form__progress-btn {
        position: relative;
        flex: 1 1 0;
        min-width: 0;
        height: 24px;
        padding: 0;
        margin: 0;
        border: 0;
        background: transparent;
        color: transparent;
        text-indent: -9999px;
        overflow: hidden;
        outline: none !important;
        cursor: pointer;
        z-index: 2;
    }
    .multisteps-form__progress-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        width: 20px;
        height: 20px;
        border: 2px solid #9aa5b1;
        border-radius: 50%;
        background-color: #fff;
        transform: translateX(-50%);
        box-sizing: border-box;
        transition: transform 0.15s linear, background-color 0.15s linear, border-color 0.15s linear;
    }
    .multisteps-form__progress-btn.js-active::before {
        border-color: #007bff;
        background-color: #007bff;
        transform: translateX(-50%) scale(1.15);
    }
    .multisteps-form__form {
        position: relative;
    }
    .multisteps-form__panel {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 0;
        opacity: 0;
        visibility: hidden;
    }
    .multisteps-form__panel.js-active {
        height: auto;
        opacity: 1;
        visibility: visible;
        position: relative; /* Fix for footer overlap */
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const DOMstrings = {
        stepsBtnClass: 'multisteps-form__progress-btn',
        stepsBtns: document.querySelectorAll('.multisteps-form__progress-btn'),
        stepsBar: document.querySelector('.multisteps-form__progress'),
        stepsForm: document.querySelector('.multisteps-form__form'),
        stepFormPanelClass: 'multisteps-form__panel',
        stepFormPanels: document.querySelectorAll('.multisteps-form__panel'),
        stepPrevBtnClass: 'js-btn-prev',
        stepNextBtnClass: 'js-btn-next'
    };

    const removeClasses = (elemSet, className) => {
        elemSet.forEach(elem => {
            elem.classList.remove(className);
        });
    };

    const setActiveStep = activeStepNum => {
        removeClasses(DOMstrings.stepsBtns, 'js-active');
        DOMstrings.stepsBtns.forEach((elem, index) => {
            if (index <= activeStepNum) {
                elem.classList.add('js-active');
            }
        });
    };

    const getActivePanel = () => {
        let activePanel;
        DOMstrings.stepFormPanels.forEach(elem => {
            if (elem.classList.contains('js-active')) {
                activePanel = elem;
            }
        });
        return activePanel;
    };

    const setActivePanel = activePanelNum => {
        removeClasses(DOMstrings.stepFormPanels, 'js-active');
        DOMstrings.stepFormPanels.forEach((elem, index) => {
            if (index === activePanelNum) {
                elem.classList.add('js-active');
                setFormHeight(elem);
            }
        });
    };

    const setFormHeight = (activePanel) => {
        if (!activePanel) activePanel = getActivePanel();
        if (activePanel && DOMstrings.stepsForm) {
            DOMstrings.stepsForm.style.height = activePanel.offsetHeight + 'px';
        }
    };

    const logDebug = (msg) => {
        let debugDiv = document.getElementById('wizard-debug');
        if (!debugDiv) {
            debugDiv = document.createElement('div');
            debugDiv.id = 'wizard-debug';
            debugDiv.style = 'position:fixed;bottom:10px;right:10px;background:rgba(0,0,0,0.8);color:white;padding:10px;z-index:9999;font-size:12px;max-width:300px;border-radius:5px;';
            document.body.appendChild(debugDiv);
        }
        debugDiv.innerText = msg;
        console.log('Wizard Debug:', msg);
    };

    // Initial setup
    logDebug('Wizard script loaded and ready');
    setTimeout(() => setFormHeight(), 500);

    // Prevent direct clicks on dots if not answered
    if (DOMstrings.stepsBar) {
        DOMstrings.stepsBar.addEventListener('click', e => {
            const eventTarget = e.target;
            if (!eventTarget.classList.contains(DOMstrings.stepsBtnClass)) return;

            const activePanel = getActivePanel();
            if (!activePanel) return;

            const totalQuestions = activePanel.querySelectorAll('.question-card').length;
            const answeredQuestions = activePanel.querySelectorAll('input[type="radio"]:checked').length;

            if (answeredQuestions < totalQuestions) {
                alert('Please answer all questions on this page first.');
                return;
            }

            const activeStepNum = Array.from(DOMstrings.stepsBtns).indexOf(eventTarget);
            setActiveStep(activeStepNum);
            setActivePanel(activeStepNum);
        });
    }

    // Prev/Next buttons
    if (DOMstrings.stepsForm) {
        DOMstrings.stepsForm.addEventListener('click', e => {
            const eventTarget = e.target;
            let btn = eventTarget.closest('.' + DOMstrings.stepPrevBtnClass + ', .' + DOMstrings.stepNextBtnClass);
            
            if (!btn) return;
            e.preventDefault();

            const activePanel = getActivePanel();
            if (!activePanel) {
                logDebug('Error: Active panel not found during click');
                return;
            }

            let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);

            if (btn.classList.contains(DOMstrings.stepPrevBtnClass)) {
                activePanelNum--;
            } else {
                const totalQuestions = activePanel.querySelectorAll('.question-card').length;
                const answeredQuestions = activePanel.querySelectorAll('input[type="radio"]:checked').length;
                
                logDebug('Step ' + (activePanelNum + 1) + ': Answered ' + answeredQuestions + '/' + totalQuestions);

                if (answeredQuestions < totalQuestions) {
                    alert('Please answer all questions before proceeding.');
                    return;
                }
                activePanelNum++;
            }

            if (activePanelNum >= 0 && activePanelNum < DOMstrings.stepFormPanels.length) {
                setActiveStep(activePanelNum);
                setActivePanel(activePanelNum);
                window.scrollTo(0, 0);
            }
        });
    }

    window.addEventListener('resize', () => setFormHeight());
});
</script>
@endsection
