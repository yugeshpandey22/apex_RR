$(document).ready(function() {
    // Basic form validation for the enquiry form
    $("form").on("submit", function(e) {
        // Just a placeholder for actual validation or ajax submission
        console.log("Form submitted via custom JS!");
    });

    // Number Counter Animation
    $('.counter').each(function() {
        var $this = $(this),
            countTo = $this.attr('data-target');
        
        $({ countNum: $this.text()}).animate({
            countNum: countTo
        },
        {
            duration: 4000,
            easing: 'swing',
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
                $this.text(this.countNum);
            }
        });
    });

    // Interactive Selector Gallery Logic
    $('.interactive-option').on('mouseenter', function() {
        if (!$(this).hasClass('active')) {
            $('.interactive-option').removeClass('active');
            $(this).addClass('active');
        }
    });
});
