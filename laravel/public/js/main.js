/**
 * Template Name: SoftLand - v2.1.0
 * Template URL: https://bootstrapmade.com/softland-bootstrap-app-landing-page-template/
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */
(function ($) {
    'use strict';

    $(document).ready(function () {
        //
        //     // Back to top button
        $(window).scroll(function () {
            if ($(this).scrollTop() > 0) {
                $('.back-to-top').fadeIn('slow');
            } else {
                $('.back-to-top').fadeOut('slow');
            }
        });
        $('.back-to-top').click(function () {
            $('html, body').animate(
                {
                    scrollTop: 0,
                },
                1500,
                'easeInOutExpo'
            );
            return false;
        });
        //
        //     var currentTab = 0;
        //     $('.submitBtn').hide();
        //
        //     setTimeout(function () {
        //         showTab(currentTab);
        //
        //         function showTab(n) {
        //             var x = document.getElementsByClassName('tab');
        //             if (x.length > 0) x[n].style.display = 'block';
        //         }
        //
        //         $('.nextBtn').on('click', function (e) {
        //             e.preventDefault();
        //             //   var form = document.getElementById('testsubmit');
        //             //   if (form.valid)
        //             var x = document.getElementsByClassName('tab');
        //             if (!validateForm()) return false;
        //             x[currentTab].style.display = 'none';
        //             currentTab = currentTab + 1;
        //             if (currentTab == x.length - 1) {
        //                 $('.nextBtn').hide();
        //                 $('.submitBtn').show();
        //                 // return false;
        //             }
        //             // Otherwise, display the correct tab:
        //             showTab(currentTab);
        //         });
        //
        //         function nextPrev(n) {
        //             // This function will figure out which tab to display
        //             var x = document.getElementsByClassName('tab');
        //             // Exit the function if any field in the current tab is invalid:
        //             if (n == 1 && !validateForm()) return false;
        //             // Hide the current tab:
        //             x[currentTab].style.display = 'none';
        //             // Increase or decrease the current tab by 1:
        //             currentTab = currentTab + n;
        //             // if you have reached the end of the form...
        //             if (currentTab >= x.length) {
        //                 // ... the form gets submitted:
        //                 document.getElementById('regForm').submit();
        //                 return false;
        //             }
        //             // Otherwise, display the correct tab:
        //             showTab(currentTab);
        //         }
        //
        //         function validateForm() {
        //             // This function deals with validation of the form fields
        //             var x,
        //                 y,
        //                 i,
        //                 valid = true;
        //             x = document.getElementsByClassName('tab');
        //             y = x[currentTab].getElementsByClassName('radio-btn');
        //             // A loop that checks every input field in the current tab:
        //             for (i = 0; i < (y.length); i++) {
        //                 // test[0][0]['student_id']
        //                 // If a field is empty...
        //                 console.log(y[i].value)
        //                 if (y[i].value == '') {
        //                     // add an "invalid" class to the field:
        //                     y[i].className += ' invalid';
        //                     // and set the current valid status to false
        //                     valid = false;
        //                 }
        //             }
        //             // If the valid status is true, mark the step as finished and valid:
        //             if (valid) {
        //                 document.getElementsByClassName('step')[currentTab].className +=
        //                     ' finish';
        //             }
        //             return valid; // return the valid status
        //         }
        //
        //         function fixStepIndicator(n) {
        //             // This function removes the "active" class of all steps...
        //             var i,
        //                 x = document.getElementsByClassName('step');
        //             for (i = 0; i < x.length; i++) {
        //                 x[i].className = x[i].className.replace(' active', '');
        //             }
        //             //... and adds the "active" class on the current step:
        //             x[n].className += ' active';
        //         }
        //     }, 1500);
        var siteMenuClone = function () {
            $('.js-clone-nav').each(function () {
                var $this = $(this);
                $this
                    .clone()
                    .attr('class', 'site-nav-wrap')
                    .appendTo('.site-mobile-menu-body');
            });
            setTimeout(function () {
                var counter = 0;
                $('.site-mobile-menu .has-children').each(function () {
                    var $this = $(this);
                    $this.prepend('<span class="arrow-collapse collapsed">');
                    $this.find('.arrow-collapse').attr({
                        'data-toggle': 'collapse',
                        'data-target': '#collapseItem' + counter,
                    });
                    $this.find('> ul').attr({
                        class: 'collapse',
                        id: 'collapseItem' + counter,
                    });
                    counter++;
                });
            }, 1000);
            $('body').on('click', '.arrow-collapse', function (e) {
                var $this = $(this);
                if ($this.closest('li').find('.collapse').hasClass('show')) {
                    $this.removeClass('active');
                } else {
                    $this.addClass('active');
                }
                e.preventDefault();
            });
            $(window).resize(function () {
                var $this = $(this),
                    w = $this.width();
                if (w > 768) {
                    if ($('body').hasClass('offcanvas-menu')) {
                        $('body').removeClass('offcanvas-menu');
                    }
                }
            });
            $('body').on('click', '.js-menu-toggle', function (e) {
                var $this = $(this);
                e.preventDefault();
                if ($('body').hasClass('offcanvas-menu')) {
                    $('body').removeClass('offcanvas-menu');
                    $('body').find('.js-menu-toggle').removeClass('active');
                } else {
                    $('body').addClass('offcanvas-menu');
                    $('body').find('.js-menu-toggle').addClass('active');
                }
            });
            // click outisde offcanvas
            $(document).mouseup(function (e) {
                var container = $('.site-mobile-menu');
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    if ($('body').hasClass('offcanvas-menu')) {
                        $('body').removeClass('offcanvas-menu');
                        $('body').find('.js-menu-toggle').removeClass('active');
                    }
                }
            });
        };
        siteMenuClone();
        var siteScroll = function () {
            $(window).scroll(function () {
                var st = $(this).scrollTop();
                if (st > 100) {
                    $('.js-sticky-header').addClass('shrink');
                } else {
                    $('.js-sticky-header').removeClass('shrink');
                }
            });
        };
        siteScroll();
        var siteSticky = function () {
            $('.js-sticky-header').sticky({
                topSpacing: 0,
            });
        };
        siteSticky();
        var siteOwlCarousel = function () {
            if ($(document).hasClass('.testimonial-carousel')) {
                $('.testimonial-carousel').owlCarousel({
                    center: true,
                    items: 1,
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    smartSpeed: 1000,
                });
            }
        };
        siteOwlCarousel();
        //
        $(window).on('load', function () {
            AOS.init({
                easing: 'ease',
                duration: 1000,
                once: true,
            });

            var id = localStorage.getItem('id');
            // document.getElementById('id').value = id;
            // var res = document.getElementById('res').value;
            // if (!res) {
            //     document.cancelledPayment.submit();
            // }
        });

        // Wizard logic moved to index.blade.php for reliability
    })

})(jQuery);
