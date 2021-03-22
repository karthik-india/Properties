var $=jQuery.noConflict();
jQuery(document).ready(function($){
    equalheight('.sameheight');
    var itemReveal = Isotope.Item.prototype.reveal;
    Isotope.Item.prototype.reveal = function() {
    itemReveal.apply( this, arguments );
    $( this.element ).removeClass('isotope-hidden');
    };

    var itemHide = Isotope.Item.prototype.hide;
    Isotope.Item.prototype.hide = function() {
    itemHide.apply( this, arguments );
    $( this.element ).addClass('isotope-hidden');
    };
    // var $grid = $('.pl-search-result').isotope({
    //     itemSelector: '.property-item',
    //     layoutMode: 'fitRows',
    //     getSortData: {
    //       name: '.name',
    //       number: '.price-f parseInt',
    //       weight: function( itemElem ) {
    //         var weight = $( itemElem ).find('.weight').text();
    //         return parseFloat( weight.replace( /[\(\)]/g, '') );
    //       }
    //     }
    //   });
    //   $('.bedrooms-field').on('change',function(){          
    //      $grid.isotope({ filter: $(this).val() }); 
    //   });
    $(window).resize(function() {
        equalheight('.sameheight');
    });
    $('.property-item').on('click', function(e){
        e.preventDefault();
        var item_url = $(this).data('href');
        console.log(item_url);
        window.location.href = item_url;
        return;
    });
});
equalheight = function(container){

    var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = new Array(),
        $el,
        topPosition = 0;
    $(container).each(function() {
  
      $el = $(this);
      $($el).height('auto')
      topPostion = $el.position().top;
  
      if (currentRowStart != topPostion) {
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
          rowDivs[currentDiv].height(currentTallest);
        }
        rowDivs.length = 0; // empty the array
        currentRowStart = topPostion;
        currentTallest = $el.outerHeight();
        rowDivs.push($el);
      } else {
        rowDivs.push($el);
        currentTallest = (currentTallest < $el.outerHeight()) ? ($el.outerHeight()) : (currentTallest);
      }
      for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
        rowDivs[currentDiv].height(currentTallest);
      }
    });
  }
