
 var $=jQuery.noConflict();
 jQuery(document).ready(function($){
    $('#slick-lightbox').slickLightbox();
    $('.image-slide').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,       
        asNavFor: '.slider-nav',
        adaptiveHeight: false
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.image-slide',
        dots: false,
        arrows: false,
        centerMode: true,
        focusOnSelect: true
    });
    $('.lightbox').slickLightbox({
        itemSelector: 'a'
    });
    
});
function initialize() {
    if($('#p-map').data('lat') != '' && $('#p-map').data('lat') != ''){
        console.log($('#p-map').data('lat'));
        var Latlng = new google.maps.LatLng( $('#p-map').data('lat'), $('#p-map').data('long'));
            var mapOptions = {
                zoom: 10,
                center: Latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var pmap = new google.maps.Map(document.getElementById("p-map"), mapOptions);
        }
  }

  function loadScript() {
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=initialize";
    document.body.appendChild(script);
  }

  window.onload = loadScript;
