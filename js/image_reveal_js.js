(function($) {
    'use strict';

    var ImageReveal = function($scope, $) {
        var $imageReveal = $scope.find('.xp-image-reveal.has-reveal');
        
        if (!$imageReveal.length) {
            return;
        }

        // Set up Intersection Observer for reveal animation
        var observerOptions = {
            threshold: 0.2,
            rootMargin: '0px'
        };

        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting && !entry.target.classList.contains('revealed')) {
                    var $element = $(entry.target);
                    var duration = $element.data('reveal-duration') || 1000;
                    var delay = $element.data('reveal-delay') || 0;

                    // Set CSS custom property for duration
                    $element.css('--reveal-duration', (duration / 1000) + 's');

                    setTimeout(function() {
                        $element.addClass('revealed');
                    }, delay);

                    // Unobserve after animation
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe each reveal element
        $imageReveal.each(function() {
            observer.observe(this);
        });
    };

    // Run on Elementor frontend init
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/iimage-reveal.default', ImageReveal);
    });

})(jQuery);
