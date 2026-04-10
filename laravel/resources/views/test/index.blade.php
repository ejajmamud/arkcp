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
                                        <span class="multisteps-form__progress-dot" aria-hidden="true"></span>
                                        <span class="multisteps-form__progress-label">Page {{ $pageIndex + 1 }}</span>
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

@section('page_styles')
<style>
    /* Keep the wizard visuals stable even when older global CSS is cached on production. */
    .multisteps-form .multisteps-form__progress {
        position: relative;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 0;
        width: 100%;
        margin: 0 auto;
        padding: 10px 0 0;
        --steps-count: 1;
        --progress-width: 0%;
        --line-offset: calc((100% / var(--steps-count)) / 2);
    }
    .multisteps-form .multisteps-form__progress::before {
        content: '';
        position: absolute;
        top: 22px;
        left: var(--line-offset);
        right: var(--line-offset);
        height: 4px;
        background: #d9e2ec;
        border-radius: 999px;
        z-index: 1;
    }
    .multisteps-form .multisteps-form__progress::after {
        content: '';
        position: absolute;
        top: 22px;
        left: var(--line-offset);
        width: var(--progress-width);
        height: 4px;
        background: linear-gradient(90deg, #227dc7 0%, #0b617e 100%);
        border-radius: 999px;
        z-index: 1;
        transition: width 0.2s ease;
    }
    .multisteps-form .multisteps-form__progress-btn {
        position: relative;
        flex: 1 1 0;
        min-width: 0;
        min-height: 68px;
        padding: 0 2px;
        margin: 0;
        border: 0;
        background: transparent;
        color: #7b8794;
        font-size: 12px;
        font-weight: 700;
        line-height: 1.2;
        text-align: center;
        outline: none !important;
        cursor: pointer;
        z-index: 2;
        transition: color 0.15s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        appearance: none;
        -webkit-appearance: none;
        box-shadow: none !important;
        border-radius: 0;
    }
    .multisteps-form .multisteps-form__progress-btn::before {
        content: none !important;
        display: none !important;
    }
    .multisteps-form .multisteps-form__progress-btn::after {
        content: none !important;
        display: none !important;
    }
    .multisteps-form .multisteps-form__progress-dot {
        display: block;
        width: 24px;
        height: 24px;
        border: 3px solid #9aa5b1;
        border-radius: 50%;
        background-color: #fff;
        box-sizing: border-box;
        transition: transform 0.15s linear, background-color 0.15s linear, border-color 0.15s linear;
        position: relative;
        z-index: 2;
        box-shadow: 0 0 0 6px #fff;
    }
    .multisteps-form .multisteps-form__progress-label {
        display: block;
        max-width: 100%;
        white-space: nowrap;
        text-align: center;
        position: relative;
        z-index: 2;
    }
    .multisteps-form .multisteps-form__progress-btn:hover .multisteps-form__progress-dot {
        border-color: #227dc7;
    }
    .multisteps-form .multisteps-form__progress-btn.js-active {
        color: #0b617e;
    }
    .multisteps-form .multisteps-form__progress-btn.js-complete {
        color: #0b617e;
    }
    .multisteps-form .multisteps-form__progress-btn.js-complete .multisteps-form__progress-dot {
        border-color: #227dc7;
        background-color: #227dc7;
    }
    .multisteps-form .multisteps-form__progress-btn.js-active .multisteps-form__progress-dot {
        border-color: #227dc7;
        background-color: #227dc7;
        transform: scale(1.15);
    }
    .multisteps-form .multisteps-form__progress-btn:focus,
    .multisteps-form .multisteps-form__progress-btn:active {
        outline: none !important;
        box-shadow: none !important;
    }
    .multisteps-form .multisteps-form__form {
        position: relative;
    }
    .multisteps-form .multisteps-form__panel {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 0;
        opacity: 0;
        visibility: hidden;
    }
    .multisteps-form .multisteps-form__panel.js-active {
        height: auto;
        opacity: 1;
        visibility: visible;
        position: relative;
    }
    @media (max-width: 767.98px) {
        .multisteps-form .multisteps-form__progress {
            padding-left: 0;
            padding-right: 0;
        }
        .multisteps-form .multisteps-form__progress::before,
        .multisteps-form .multisteps-form__progress::after {
            top: 18px;
            height: 3px;
        }
        .multisteps-form .multisteps-form__progress-btn {
            min-height: 42px;
            gap: 0;
        }
        .multisteps-form .multisteps-form__progress-label {
            display: none;
        }
        .multisteps-form .multisteps-form__progress-dot {
            width: 20px;
            height: 20px;
            border-width: 2px;
        }
    }
</style>
@endsection

@section('script')

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

    if (DOMstrings.stepsBar) {
        DOMstrings.stepsBar.style.setProperty('--steps-count', Math.max(DOMstrings.stepsBtns.length, 1));
    }

    const removeClasses = (elemSet, className) => {
        elemSet.forEach(elem => {
            elem.classList.remove(className);
        });
    };

    const setActiveStep = activeStepNum => {
        removeClasses(DOMstrings.stepsBtns, 'js-active');
        removeClasses(DOMstrings.stepsBtns, 'js-complete');
        DOMstrings.stepsBtns.forEach((elem, index) => {
            if (index < activeStepNum) {
                elem.classList.add('js-complete');
            }
            if (index === activeStepNum) {
                elem.classList.add('js-active');
            }
        });
        if (DOMstrings.stepsBar) {
            const totalSteps = Math.max(DOMstrings.stepsBtns.length - 1, 1);
            const progressRatio = activeStepNum / totalSteps;
            DOMstrings.stepsBar.style.setProperty(
                '--progress-width',
                'calc((100% - (100% / var(--steps-count))) * ' + progressRatio + ')'
            );
        }
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

    // Initial setup
    setActiveStep(0);
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
                return;
            }

            let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);

            if (btn.classList.contains(DOMstrings.stepPrevBtnClass)) {
                activePanelNum--;
            } else {
                const totalQuestions = activePanel.querySelectorAll('.question-card').length;
                const answeredQuestions = activePanel.querySelectorAll('input[type="radio"]:checked').length;

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
