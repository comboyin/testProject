

var indexAction = function () {
	return {
		init : function () {
			// == == == == == == == == == == begin Edit user session == == == == == == == == == == == == == == == == == == == == ==
			
						
			$(document).on( 'click' ,'a.edit_info',function(e){
				e.preventDefault();
				productPrices = $(this).parents('.row')[0];
				valueText =  $.trim( $( 'span.product-vars span' , productPrices).html() );
				// hidden name and button save
				$( 'span.product-vars span' , productPrices).css( 'display','none' );
				$( 'a.edit_info' , productPrices).css( 'display','none' );
				// show input
				$( 'span.product-vars input' , productPrices).css( 'display','inline' );
				$( 'span.product-vars input' , productPrices).attr( 'value', valueText );
				// show button save and cancel
				$( 'span.saveCancelInfo' , productPrices).css( 'display','inline' );
				
			});
			
			$(document).on( 'click' ,'a.Cancel_info',function(e){
				e.preventDefault();
				productPrices = $(this).parents('.row')[0];
				
				// show name and button save
				$( 'span.product-vars span' , productPrices).css( 'display','inline' );
				$( 'a.edit_info' , productPrices).css( 'display','inline' );
				// hidden input
				$( 'span.product-vars input' , productPrices).css( 'display','none' );
				// hidden button save and cancel
				$( 'span.saveCancelInfo' , productPrices).css( 'display','none' );
				
			});
			
			// == == == == == == == == == == end Edit user session == == == == == == == == == == == == == == == == == == == == == 			
		}

	};
}();


jQuery(document).ready(function () {
	indexAction.init();
});