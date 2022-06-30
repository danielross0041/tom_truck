
/*********************
    Testimonial Slider
  *********************/
$('.testi-slider').slick({
  infinite: true,
  arrows: false,
  slidesToShow: 3,
  slidesToScroll: 3
});










/*********************
    Range Slider
  *********************/
let slider = document.getElementById("rangeSlider");
let outputEl = document.querySelector(".range-slider__value");

function decimalSeparator(number) {
  return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// outputEl.textContent = `${initialValue} €`;
outputEl.textContent = `${decimalSeparator(slider.value)} $`; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slider.oninput = function () {
  outputEl.textContent = `${decimalSeparator(this.value)} $`;
};


$(document).ready(function() {  
  /*********************
    Thumbnails slider
  *********************/
  // Change the main image whenever a thumbnail button is activated
  $('.thumbnails-slider').on('init', function(e, slider) {
    $(slider.$slides.find('.thumbnail-button')).each(function(index) {
      $(this).on('click', function() {
        // Move aria-current="true" to this button
        $(slider.$slides.find('.thumbnail-button').removeAttr('aria-current'));
        $(this).attr('aria-current', true);

        // Change the main image to match this thumbnail button
        var index = $(this).closest('.slick-slide').data('slick-index');
        $('.main-image-slider').slick('slickGoTo', index);
      });
    });
  });
  
  // Initialize the slider
  $('.thumbnails-slider').slick({
    vertical: true,
    slidesToShow: 4,
    infinite: false,
    instructionsText: 'This carousel contains a column of small thumbnails. Selecting a thumbnail will change the main image in the carousel that follows. Use the Previous and Next buttons to cycle through all the thumbnails, use Enter to select.',
    regionLabel: 'thumbnails carousel'
  });
  
  
  /********************
    Main image slider
  *********************/
  $('.main-image-slider').slick({
    slidesToShow: 1,
    draggable: false,
    instructionsText: 'This carousel shows one large product image at a time. Use the Previous and Next buttons to move between images, or use the preceding thumbnails carousel to select a specific image to display here.',
    regionLabel: 'main image carousel',
  });
  
    // Update the thumbnail slider when the user changes the main slider directly.
    $('.main-image-slider').on('beforeChange', function(e, slider, currentSlide, nextSlide) {
      // Remove aria-current from the last selected thumbnail image button
      $('.thumbnails-slider .thumbnail-button[aria-current="true"]').removeAttr('aria-current');
      
      // Select the thumbnail image button that goes with this main image. Most importantly, this updates Slick's internal state to be consistent with the visual change.
      $('.thumbnails-slider').slick('slickGoTo', nextSlide);

      // Add aria-current="true" to the correct thumbnail image button to convey to screen readers that it's active.
      $('.thumbnails-slider .thumbnail-button:eq(' + nextSlide + ')').attr('aria-current', true);
    }); 
});