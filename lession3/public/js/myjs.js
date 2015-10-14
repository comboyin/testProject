function stringHtmlError(errorArray){
	// data error
	htmlError = '<div class="alert alert-error">';
	$.each(errorArray,function(k,v){
		htmlError += v + "</br>";
	});
	htmlError += '</div>';
	return htmlError;
}

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}


//create html error alert
// error = array.
function generateHtmlAlertError(error){
	var htmlError = " ";
	htmlError += '<div class="alert alert-error">';
	htmlError += '<strong>Error! </strong>';
	$.each(error,function(keyName,valueName){
		htmlError += '<div class="item">';
		htmlError += '<p>';
		htmlError += '<strong>'+keyName+'</strong>';
		htmlError += '</p>';
		htmlError += '<ul>';

		$.each(valueName,function(keyError,valueError){
			if(typeof(valueError) == 'object'){
				htmlError += '<p>';
    			htmlError += '<strong>'+keyError+'</strong>';
    			htmlError += '</p>';
				$.each(valueError,function(keyListImage,valueListImage){
					htmlError += '<li>';
    				htmlError += valueListImage;
    				htmlError += '</li>';
				});
			}else{
				htmlError += '<li>';
				htmlError += valueError;
				htmlError += '</li>';
			}
		});
		htmlError += '</ul>';
	});
	htmlError += '</div>';
	return htmlError;
}

var max_chars = 2;

$(document).on('keydown', 'input[name="quantity"]', function(e){

    if ($(this).val().length >= 2) {
        $(this).val($(this).val().substr(0, max_chars));
    }
});

$(document).on('keyup', 'input[name="quantity"]', function(e){

    if ($(this).val().length >= 2) {

        $(this).val($(this).val().substr(0, max_chars));

    }
});

var myjs = function () {
	return {
		init : function () {
			var flag = 0;
			var idProduct;
			var idProduct_InputNumber;

			updateTableOrderProduct();
			reCreateCaptcha();

			var dialogListOrder = $('#dialog-list-orderproduct').dialog({
				 autoOpen: false,
			      width: 700,
			      modal: true
			});

			$('.search a').click(function(e){
				if( flag == 0){
					$('.container-search').css('display','inline-table');
					flag = 1;
				}else if( flag == 1 ){
					$('.container-search').css('display','none');
					flag = 0;
				}

			});

			$('button.close-search').click(function(e){
				e.preventDefault();
				$('.container-search').css('display','none');
				flag = 0;
			});

			$( '.container-button-show button' ).click(function(){

				$( '.container-button-show button' ).css( 'display' , 'none' );
				$( '.container-cart' ).css( 'display', 'inline' );
			});

			$( 'button.close-cart' ).click( function(){
				$( '.container-button-show button' ).css( 'display' , 'inline' );
				$( '.container-cart' ).css( 'display', 'none' );
			});

			function showCart(){
				$( '.container-button-show button' ).css( 'display' , 'none' );
				$( '.container-cart' ).css( 'display', 'inline' );
			}

			function closeCart(){
				$( '.container-button-show button' ).css( 'display' , 'inline' );
				$( '.container-cart' ).css( 'display', 'none' );
			}

/*====================BEGIN ADD ORDER PRODUCT=========================================================================== */
			$("button.add-order-product").click(function(e){
				e.preventDefault();
				element = $(this).parents('div.info')[0];

				idProduct = $(element).attr( 'idproduct' );

				fd = new FormData();
				fd.append("idproduct",idProduct);
				$.ajax({
			        url: 'index.php?rt=fronend/cart/checkOrderProduct',
			        type: 'POST',
			        data: fd,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	/*
			    		 * TH01: not exist in database 0
			    		 * TH02: not exist in cart     1
			    		 * TH03: exist in cart         2
			    		 * */
			        	var error = data.error;
			        	if( error == 0 ){

			        		dalert.alert(stringHtmlError(['Mã sản phẩm không tồn tại.']),'Error');
			        		showCart();
			        		updateTableOrderProduct();

			        	}else if( error == 1 ){
			        		// add orderproduct
			        		addOrderProduct(1);
			        		showCart();


			        	}else if( error == 2 ){
			        		dalert.confirm("Sản phẩm đã tồn tại trong giỏ hàng <br/>Bạn có muốn tăng số lượng thêm 1.","Xác nhận !",function(result){
			                    if(result){
			                    	addOrderProduct(1);
			                    	showCart();

			                    }
			                    else{

			                    }
			                });
			        	}

			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			        	var error = ['ERRORS: ' + textStatus];
			            // Handle errors here
			        	dalert.alert(stringHtmlError(error),'Error');
			        }
			    });
			});

			function addOrderProduct(quality){

				$.ajax({
			        url: 'index.php?rt=fronend/cart/addCart/'+idProduct + '/' + quality ,
			        type: 'GET',
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	// success
			        	if( data.error == null ){
			        		updateTableOrderProduct();
			        	}else{
			        		//error
			        		dalert.alert(stringHtmlError(['Mã sản phẩm không tồn tại.']),'Error');
			        		showCart();
			        		updateTableOrderProduct();
			        	}
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			        	var error = ['ERRORS: ' + textStatus];
			            // Handle errors here
			        	dalert.alert(stringHtmlError(error),'Error');
			        }
			    });
			}
/*====================END ADD ORDER PRODUCT=========================================================================== */

			// update table orderproduct
			function updateTableOrderProduct(){
				$.ajax({
			        url: 'index.php?rt=fronend/cart/getTableCart',
			        type: 'GET',
			        cache: false,
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	$( 'tbody.cart-table' ).html( data );
			        	 updatePriceOrder();
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			        	$( 'tbody.cart-table' ).html( data );
			        	var error = ['ERRORS: ' + textStatus];
			            // Handle errors here
			        	dalert.alert(stringHtmlError(error),'Error');
			        }
			    });
			}
/*====================BEGIN DELETE ODER=========================================================================== */
			$(document).on('click','.OrderProduct_Delete',function(){
				element = $(this).parents('tr')[0];

				idProduct = $(element).attr('idproduct');

				dalert.confirm("Bạn có chắc chăn.","Xác nhận !",function(result){
		            if(result){
						deleteOrderProduct(idProduct);
		            }
		            else{
		            }
		        });

			});

			function deleteOrderProduct( $idProduct ){

				fd = new FormData();
				fd.append('idProduct',$idProduct);

				$.ajax({
			        url: 'index.php?rt=fronend/cart/deleteOrderProductInOrder',
			        type: 'POST',
			        data: fd,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	// success
			        	if( data.error == null ){
			        		updateTableOrderProduct();

			        		dalert.alert(["Xóa thành công."],'Thông báo');
			        	}else{
			        		dalert.alert(stringHtmlError(data.error),'Lỗi');
			        		updateTableOrderProduct();
			        	}
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {

			        	var error = ['ERRORS: ' + textStatus];
			            // Handle errors here
			        	dalert.alert(stringHtmlError(error),'Error');
			        }
			    });


			}
/*====================END DELETE ODER=========================================================================== */

/*====================BEGIN EDIT QUALITY=========================================================================== */
			$('.cart-table').on('focus','input[type="number"]',function(){
				idProduct_InputNumber =  $($(this).parents('tr')[0]).attr('idproduct') ;

			});

			$('.cart-table').on('keyup mouseup','input[type="number"]',function(){
				row = $(this).parents('tr')[0];
				quality = $('input[type="number"]',row).val();
				idProduct = $(row).attr('idproduct');
				editQuality( quality,idProduct );
			});

			function editQuality( quality, idProduct ){
				fd = new FormData();

				fd.append('quality',quality);
				fd.append('idProduct',idProduct);

				$.ajax({
			        url: 'index.php?rt=fronend/cart/editQualityOderProduct',
			        type: 'POST',
			        data: fd,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	// success
			        	if( data.error == null ){
			        		updateTotalPrice(idProduct);
			        		updatePriceOrder();
			        	}else{
			        		dalert.alert(stringHtmlError(data.error),'Lỗi');
			        	}
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {

			        	var error = ['ERRORS: ' + textStatus];
			            // Handle errors here
			        	dalert.alert(stringHtmlError(error),'Error');
			        }
			    });
			}

			function updateTotalPrice( idProduct ){
				fd = new FormData();
				fd.append('idproduct',idProduct);
				$.ajax({
			        url: 'index.php?rt=fronend/cart/getItemOrderProduct',
			        type: 'POST',
			        data: fd,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	totalprice = data.totalprice;
			        	selectorTotalPrice = 'tr[idproduct="'+idProduct_InputNumber+'"] td';
		        		$($(selectorTotalPrice)[3]).html(totalprice);
		        		updatePriceOrder();
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {

			        	var error = ['ERRORS: ' + textStatus];
			            // Handle errors here
			        	dalert.alert(stringHtmlError(error),'Error');
			        }
			    });
			}
/*====================END EDIT QUALITY=========================================================================== */

			function updatePriceOrder(){
				$.ajax({
			        url: 'index.php?rt=fronend/cart/totalOrderPrice',
			        type: 'GET',
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	totalorderprice = data.totalorderprice;
			        	$('span.cart_sum').html(totalorderprice);
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			        	var error = ['ERRORS: ' + textStatus];
			            // Handle errors here
			        	dalert.alert(stringHtmlError(error),'Error');
			        }
			    });
			}


/*====================BEGIN ORDER=========================================================================== */

			$('button.order').click(function(){


				dalert.confirm("Bạn có chắc chắn gởi đơn hàng này. ? ","Xác nhận !",function(result){
		            if(result){
		            	order();
		            }
		            else{

		            }
		        });

			});

			function order(){
				///
				$('button.order').css('display','none');
				$('button.order-loading').css('display','inline');
				///
				name    = $.trim( $('input[name="cart_name"]').val()   );
				phone   = $.trim( $('input[name="cart_phone"]').val()  );
				captcha = $.trim( $('input[name="cart_captch"]').val() );
				email   = $.trim( $('input[name="cart_email"]').val()  );

				fd = new FormData();

				fd.append('name'   , name);
				fd.append('phone'  , phone);
				fd.append('captcha', captcha);
				fd.append('email'  , email);

				$.ajax({
			        url: 'index.php?rt=fronend/cart/order',
			        type: 'POST',
			        cache: false,
			        data : fd,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	//success
			        	if( data.error == null ){
			        		dalert.alert("Bạn đã gởi đơn hàng thành công. <br/>" +
			        						"Một mẫu đơn hàng được gởi tới mail của ban.",'Thành công.');
			        		cleanFormOrder();
			        		updateTableOrderProduct();
			        	}

			        	else{
			        		// captcha
			        		if( typeof(data.error.captcha) != 'undefined' ){
			        			reCreateCaptcha();
			        			dalert.alert(stringHtmlError(data.error.captcha),'Lỗi');
			        		}else{
			        			reCreateCaptcha();
			        			dalert.alert(generateHtmlAlertError(data.error),'Lỗi');
			        		}
			        	}

			        	///
						$('button.order').css('display','inline');
						$('button.order-loading').css('display','none');
						///
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			        	var error = ['ERRORS: ' + textStatus];
			        	dalert.alert(stringHtmlError(error),'Error');
			        }
			    });
			}





/*====================END ORDER========================================================================== */

			function cleanFormOrder(){
				$('input[name="cart_name"]').val('');
				$('input[name="cart_phone"]').val('');
				$('input[name="cart_captch"]').val('');
				$('input[name="cart_email"]').val('');
				reCreateCaptcha();
			}

			function resetImgCaptcha(){
				$.ajax({
			        url: 'index.php?rt=fronend/cart/getCaptcha',
			        type: 'GET',
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	$('img.captcha').attr('src',data.image_src);
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			        	var error = ['ERRORS: ' + textStatus];
			        	dalert.alert(stringHtmlError(error),'Error');
			        }
			    });
			}

			function reCreateCaptcha(){
				$.ajax({
			        url: 'index.php?rt=fronend/cart/createCaptcha',
			        type: 'GET',
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	$('img.captcha').attr('src',data.image_src);
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			        	var error = ['ERRORS: ' + textStatus];
			        	dalert.alert(stringHtmlError(error),'Error');
			        }
			    });
			}

			$('div.reset_capcha').click(function(){
				reCreateCaptcha();
			});
		}

	};
}();


jQuery(document).ready(function () {
	myjs.init();
});