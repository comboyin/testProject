function postAndRedirect(url, postData) {
	var postFormStr = "<form method='POST' action='" + url + "'>\n";
	for ( var key in postData) {
		if (postData.hasOwnProperty(key)) {
			postFormStr += "<input type='hidden' name='" + key + "' value='"
					+ postData[key] + "'></input>";
		}
	}
	postFormStr += "</form>";
	var formElement = $(postFormStr);
	$('body').append(formElement);
	$(formElement).submit();
}

function getAndRedirect(url, postData) {
	var postFormStr = "<form method='GET' action='" + url + "'>\n";
	for ( var key in postData) {
		if (postData.hasOwnProperty(key)) {
			postFormStr += "<input type='hidden' name='" + key + "' value='"
					+ postData[key] + "'></input>";
		}
	}
	postFormStr += "</form>";
	var formElement = $(postFormStr);
	$('body').append(formElement);
	$(formElement).submit();
}


function baseUrl (url){
	var baseFolder = '/'+window.location.pathname.split( '/' )[1]+'/';
	return baseFolder+url;
}

//
function stringHtmlError(errorArray){
	// data error
	htmlError = '<div class="alert alert-error">';
	$.each(errorArray,function(k,v){
		htmlError += v + "</br>";
	});
	htmlError += '</div>';
	return htmlError;
}

// create html error alert
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

var productmanager = function () {

	return {

		init : function () {

			var rowEdit = null;

			// dialog add new product.
			dialogAddProduct = $( "#dialog-add-product" ).dialog({
			      autoOpen: false,
			      width: 700,
			      modal: true
			    });

			// dialog edit list image.
			dialogEditListImage = $("#dialog-list-img-product").dialog({
					autoOpen: false,
					minWidth : 1000,
					modal: true
				});



			// clean form add new product
			function cleanFormAddProduct(){
				// display button
				$('input[name="submit_addproduct"]').css('display','inline');
				$('input[name="submit_updateproduct"]').css('display','none');

				$('img.image-link').css("display",'none');
				$('tr.list-image').css('display','table-row');
				$('input[name="name"]').val('');
        		$('input[name="price"]').val('');
        		$('select[name="category"]').val('');
        		$('input[name="new"]').prop('checked', false);
        		$('input[name="best"]').prop('checked', false);
        		$( '#ui-id-1' ).html('Add new product');
        		$('div.error_product').html('');

			}

// =========================================== BEGIN ADD NEW PRODUCT =============================================================================
			// click button add.
			$("button.add-product").click(function(){
				cleanFormAddProduct();
				dialogAddProduct.dialog( "open" );
			});

			// event click button add.
			$('input[name="submit_addproduct"]').click(addNewProduct);

			// function add new product from event click button add
			function addNewProduct(){

				$(".progress-loading").css("display",'inline-block');
				$('input[name="submit_addproduct"]').css("display",'none');

				var _name = $('input[name="name"]').val();
				var _price = $('input[name="price"]').val();
				var _hot = $('input[name="hot"]').is(':checked') ? 1 : 0;
				var _best = $('input[name="best"]').is(':checked') ? 1 : 0;
				var _category = $('select[name="category"]').val();

				fd = new FormData();
				fd.append("name",_name);
				fd.append("price",_price);
				fd.append("hot",_hot);
				fd.append("best",_best);
				fd.append("category",_category);
				// image
				fd.append("image", $('input[name="image"]')[0].files[0] );

				// list image
				var listImage = $('input[name="listImage[]"]')[0].files;

				$.each($('input[name="listImage[]"]'),function(key,value){
					var files = value.files;
					$.each(files,function(keyF,valueF){
						fd.append("listImage[]",valueF);
					});
				});


				$.ajax({
			        url: 'index.php?rt=backend/product/addNewProduct',
			        type: 'POST',
			        data: fd,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	console.log(data);
			        	$(".progress-loading").css("display",'none');
						$('input[name="submit_addproduct"]').css("display",'inline-block');
			        	var htmlError = '';
			        	// error
			        	if(data.error != null){
			        		htmlError = generateHtmlAlertError(data.error);
			        		$("div.error_product").html(htmlError);
			        	}else{

			        		dalert.alert("Add new product success.","Success",function callbackMe(){
			        			$("div.error_product").html('');
				        		getAndRedirect('index.php',{
				        			rt : "backend/product/index"
				        		});
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

				}
// ========================== END ADD NEW PRODUCT ============================================================================================== //

// ========================== BEGIN EDIT LIST IMAGE ============================================================================================== //
				// event click button list image
				$("button.list-image").on("click",function(){
					// get id product in row.
					row = $(this).parents('tr')[0];
					rowEdit = row;
					_id = $('td',row)[0].innerHTML;

					getListProductImg(_id);
				});

				function getListProductImg(idProduct){
					$('div.error_product_img').html('');
					// ajax get image.
					$.ajax({
				        url: 'index.php?rt=backend/product/getProductImg/'+idProduct,
				        type: 'GET',
				        cache: false,
				        dataType: 'json',
				        processData: false, // Don't process the files
				        success: function(data, textStatus, jqXHR)
				        {

				        	// success if error == null
				        	if(data.error == null){
				        		$("table.dialog-product-img tbody").html(data.htmlListImg);
				        		dialogEditListImage.dialog( "open" );
				        	}else if(data.error != null){
				        		$("table.dialog-product-img tbody").html('');
				        		dialogEditListImage.dialog( "open" );
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
// ========================== END EDIT LIST IMAGE ============================================================================================== //

// ========================== BEGIN EDIT PRODUCT ============================================================================================== //
				// event click button update
				$('input[name="submit_updateproduct"]').click(function(){
					dalert.confirm("Are You Sure?","Confirm !",function(result){
			            if(result){
			            	updateProduct();
			            }
			            else{

			            }
			        });
				});

				// function add new product from event click button add
				function updateProduct(){

					$(".progress-loading").css("display",'inline-block');
					$('input[name="submit_updateproduct"]').css("display",'none');

					var _name = $('input[name="name"]').val();
					var _price = $('input[name="price"]').val();
					var _hot = $('input[name="hot"]').is(':checked') ? 1 : 0;
					var _best = $('input[name="best"]').is(':checked') ? 1 : 0;
					var _category = $('select[name="category"]').val();
					var _id = $('td',rowEdit)[0].innerHTML;

					fd = new FormData();
					fd.append("id",_id);
					fd.append("name",_name);
					fd.append("price",_price);
					fd.append("hot",_hot);
					fd.append("best",_best);
					fd.append("category",_category);
					// image
					fd.append("image", $('input[name="image"]')[0].files[0] );

					$.ajax({
				        url: 'index.php?rt=backend/product/updateProduct',
				        type: 'POST',
				        data: fd,
				        cache: false,
				        dataType: 'json',
				        processData: false, // Don't process the files
				        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				        success: function(data, textStatus, jqXHR)
				        {
				        	$(".progress-loading").css("display",'none');
							$('input[name="submit_updateproduct"]').css("display",'inline-block');
				        	var htmlError = '';
				        	// error
				        	if(data.error != null){
				        		htmlError = generateHtmlAlertError(data.error);
				        		$("div.error_product").html(htmlError);
				        	}else{
				        		// success

				        		dalert.alert("Update product success.","Success",function callbackMe(){
				        			window.location.reload();
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
					}

				// event click button edit
				$("button.edit-product").on('click',function(){
					// get id product in row.
					row = $(this).parents('tr')[0];
					rowEdit = row;
					_id = $('td',row)[0].innerHTML;
					$( '#ui-id-1' ).html('Update product');
					// ajax get image.
					$.ajax({
				        url: 'index.php?rt=backend/product/getProduct/'+_id,
				        type: 'GET',
				        cache: false,
				        dataType: 'json',
				        processData: false, // Don't process the files
				        contentType: false,
				        success: function(data, textStatus, jqXHR)
				        {
				        	// success if error == null
				        	if(data.error == null){
				        		product = data.product;
				        		name = product.name;
				        		price = product.price;
				        		category = product.category_id;
				        		best = product.best;
				        		hot = product.hot;
				        		image_link = product.image_link;


				        		$('input[name="name"]').val(name);
				        		$('input[name="price"]').val(price);
				        		$('select[name="category"]').val(category);
				        		if( hot == 1){
				        			$('input[name="hot"]').prop('checked', true); // Checks it

				        		}else if( hot == 0 ){
				        			$('input[name="hot"]').prop('checked', false); // Checks it
				        		}

				        		if( best == 1){
				        			$('input[name="best"]').prop('checked', true); // Checks it

				        		}else if( best == 0 ){
				        			$('input[name="best"]').prop('checked', false); // Checks it
				        		}

				        		$('div.error_product').html('');
				        		// display button
								$('input[name="submit_addproduct"]').css('display','none');
								$('input[name="submit_updateproduct"]').css('display','inline');
				        		$('tr.list-image').css('display','none');
				        		$("img.image-link").attr("src",baseUrl('uploads/'+image_link));
				        		$("img.image-link").css("display",'inline');
				        		$('input[name="submit_addproduct"]').val('Update');

				        		dialogAddProduct.dialog('open');


				        	}else if(data.error != null){
				        		// data error
				        		htmlError = '<div class="alert alert-error">';
				        		$.each(data.error,function(k,v){
				        			htmlError += v + "</br>";
				        		});
				        		htmlError += '</div>';
				        		dalert.alert(htmlError,'Error');
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
// ========================== END EDIT PRODUCT ============================================================================================== //


// ========================== BEGIN DELETE PRODUCT ============================================================================================== //
				$("button.delete-product").on('click',function(){
					// get id product in row.
					row = $(this).parents('tr')[0];
					rowEdit = row;


					dalert.confirm("Are You Sure?","Confirm !",function(result){
			            if(result){
			            	deleteProduct();
			            }
			            else{

			            }
			        });
				});

				function deleteProduct(){
					_id = $('td',rowEdit)[0].innerHTML;
					data = new FormData();
					data.append('id',_id);

					$.ajax({
						url: 'index.php?rt=backend/product/deleteProduct',
				        type: 'POST',
				        data: data,
				        cache: false,
				        dataType: 'json',
				        processData: false, // Don't process the files
				        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				        success: function(data, textStatus, jqXHR)
				        {
				        	// success if error == null
				        	if(data.error == null){
				        		dalert.alert("Delete product success.","Success",function callbackMe(){
				        			window.location.reload();
				                });
				        	}else if(data.error != null){
				        		// data error
				        		htmlError = '<div class="alert alert-error">';
				        		$.each(data.error,function(k,v){
				        			htmlError += v + "</br>";
				        		});
				        		htmlError += '</div>';
				        		dalert.alert(htmlError,'Error');
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
// ========================== BEGIN DELETE PRODUCT ============================================================================================== //

// ========================== BEGIN DELETE PRODUCT IMG ============================================================================================== //
				// delete product
				$(document).on('click','.button-delete-productimg',function(){

					div = $(this).parents('div')[0];
					idimg = $('img',div).attr('idimg');
					idProduct = $('td',rowEdit)[0].innerHTML;

			        dalert.confirm("Are You Sure?","Confirm !",function(result){
			            if(result){
			            	deleteProductImg(idimg,idProduct);
			            }
			            else{

			            }
			        });

				});

				function deleteProductImg(idProductImg, idProduct){
					url = 'index.php?rt=backend/product/deleteProductimg/' + idProductImg;
					data = {
						idimg : idimg
					};
					$.ajax({
						url: url,
				        type: 'POST',
				        data: data,
				        cache: false,
				        dataType: 'json',
				        processData: false,
				        contentType: false,
				        success: function(json, textStatus, jqXHR)
				        {
				        	console.log(json);
				        	// success
							if(json.error == null){
								// reload list product img
								getListProductImg(idProduct);
							}else if(json.error != null){
								// error
								dalert.alert(stringHtmlError(json.error),'Error');
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

// ========================== END DELETE PRODUCT IMG ============================================================================================== //

// ========================== BEGIN ADD NEW PRODUCT IMG ============================================================================================== //
				$('input[name="submit_addproductimg"]').click(function(){
					idProduct = $('td',rowEdit)[0].innerHTML;
					fd = new FormData();

					fd.append('idproduct',idProduct);

					// list image
					var listImage = $('input[name="listProductImage[]"]')[0].files;

					$.each($('input[name="listProductImage[]"]'),function(key,value){
						var files = value.files;
						$.each(files,function(keyF,valueF){
							fd.append("listProductImage[]",valueF);
						});
					});

					$.ajax({
				        url: 'index.php?rt=backend/product/addNewProductImg',
				        type: 'POST',
				        data: fd,
				        cache: false,
				        dataType: 'json',
				        processData: false, // Don't process the files
				        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				        success: function(data, textStatus, jqXHR)
				        {
				        	// error if != null
				        	if(data.error != null){

				        		$("div.error_product_img").html(generateHtmlAlertError(data.error));
				        	}else{

				        		dalert.alert("Add image product success.","Success",function callbackMe(){
				        			// remove image.
					        		$( 'input[name="listProductImage[]"]' ).MultiFile( 'reset' );

					        		// success
					        		$("div.error_product_img").html('');
					        		getListProductImg(idProduct);
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


// ========================== BEGIN ADD NEW PRODUCT IMG ============================================================================================== //
		}

	};
}();


var accountmanager = function () {

	return {

		init : function () {

			var rowEdit = null;

			// dialog add new account.
			dialogAddAccount = $( "#dialog-add-account" ).dialog({
			      autoOpen: false,
			      width: 700,
			      modal: true
			    });

			// dialog change password
			dialogChangePass = $( "#dialog-change-password" ).dialog({
			      autoOpen: false,
			      width: 700,
			      modal: true
			    });

			$( 'input[name="birthday"]' ).datepicker({
				dateFormat: "yy-mm-dd"
			});

			function cleanFormAddAccount(){

				$( 'input[name="submit_updateaccount"]' ).css('display' , 'none');
				$( 'input[name="submit_addaccount"]' ).css('display' , 'inline');
				$( 'tr.password' ).css('display','table-row');
				$( 'tr.repassword' ).css('display','table-row');
				$( 'input[name="username"]' ).val('');
				$( 'input[name="firstname"]' ).val('');
				$( 'input[name="lastname"]' ).val('');
				$( 'input[name="password"]' ).val('');
				$( 'input[name="repassword"]' ).val('');
				$( 'input[name="birthday"]' ).val('');
				$( 'input[name="gender"]' ).prop('checked','true')
				$( 'input[name="address"]' ).val('');

				$( 'img.avatar' ).css( 'display', 'none' );
				$('div.error_account').html('');
			}

			function cleanFormUpdateAccount(){

				$( 'input[name="submit_updateaccount"]' ).css('display' , 'inline');
				$( 'input[name="submit_addaccount"]' ).css('display' , 'none');

				$( 'tr.password' ).css('display','none');
				$( 'tr.repassword' ).css('display','none');

				$( 'input[name="username"]' ).val('');
				$( 'input[name="firstname"]' ).val('');
				$( 'input[name="lastname"]' ).val('');
				$( 'input[name="password"]' ).val('');
				$( 'input[name="repassword"]' ).val('');
				$( 'input[name="birthday"]' ).val('');

				$( 'input[name="address"]' ).val('');

				$('div.error_account').html('');

			}


// =========================================== BEGIN ADD NEW ACCOUNT =============================================================================
			// click button add.
			$("button.add-account").click(function(){
				cleanFormAddAccount();
				dialogAddAccount.dialog( "open" );
			});

			// event click button add.
			$('input[name="submit_addaccount"]').click(addNewAccount);

			// function add new product from event click button add
			function addNewAccount(){

				$(".progress-loading").css("display",'inline-block');
				$('input[name="submit_addaccount"]').css("display",'none');

				var _username = $.trim( $('input[name="username"]').val() ) ;
				var _firstname = $.trim( $('input[name="firstname"]').val() ) ;
				var _lastname = $.trim( $('input[name="lastname"]').val() ) ;
				var _birthday = $.trim( $('input[name="birthday"]').val() ) ;
				var _gender = $.trim( $('input[name="gender"]:checked').val() ) ;
				var _address = $.trim( $('input[name="address"]').val() ) ;
				var _password = $.trim( $('input[name="password"]').val() ) ;
				var _repassword = $.trim( $('input[name="repassword"]').val() ) ;

				fd = new FormData();
				fd.append("username",_username);
				fd.append("firstname",_firstname);
				fd.append("lastname",_lastname);
				fd.append("birthday",_birthday);
				fd.append("gender",_gender);
				fd.append("address",_address);
				fd.append("password",_password);
				fd.append("repassword",_repassword);
				// image
				fd.append("avatar", $('input[name="avatar"]')[0].files[0] );

				$.ajax({
			        url: 'index.php?rt=backend/account/addNewAccount',
			        type: 'POST',
			        data: fd,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {

			        	$(".progress-loading").css("display",'none');
						$('input[name="submit_addaccount"]').css("display",'inline-block');
			        	var htmlError = '';
			        	// error
			        	if(data.error != null){

			        		htmlError = generateHtmlAlertError(data.error);
			        		$("div.error_account").html(htmlError);

			        	}else{

			        		dalert.alert("Add new account success.","Success",function callbackMe(){
			        			$("div.error_account").html('');
				        		getAndRedirect('index.php',{
				        			rt : "backend/account/index"
				        		});
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

				}
// ========================== END ADD NEW ACCOUNT ============================================================================================== //

// ========================== BEGIN EDIT ACCOUNT ============================================================================================== //
			// event click button update
			$('input[name="submit_updateaccount"]').click(function(){
				dalert.confirm("Are You Sure?","Confirm !",function(result){
		            if(result){
		            	updateAccount();
		            }
		            else{

		            }
		        });
			});

			// function add new product from event click button add
			function updateAccount(){

				_idaccount = $('td',rowEdit)[0].innerHTML;

				$(".progress-loading").css("display",'inline-block');
				$('input[name="submit_updateaccount"]').css("display",'none');

				var _username = $.trim( $('input[name="username"]').val() ) ;
				var _firstname = $.trim( $('input[name="firstname"]').val() ) ;
				var _lastname = $.trim( $('input[name="lastname"]').val() ) ;
				var _birthday = $.trim( $('input[name="birthday"]').val() ) ;
				var _gender = $.trim( $('input[name="gender"]:checked').val() ) ;
				var _address = $.trim( $('input[name="address"]').val() ) ;

				fd = new FormData();
				fd.append("username",_username);
				fd.append("firstname",_firstname);
				fd.append("lastname",_lastname);
				fd.append("birthday",_birthday);
				fd.append("gender",_gender);
				fd.append("address",_address);
				fd.append("idaccount",_idaccount);
				// image
				fd.append("avatar", $('input[name="avatar"]')[0].files[0] );

				$.ajax({
			        url: 'index.php?rt=backend/account/updateAccount',
			        type: 'POST',
			        data: fd,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	$(".progress-loading").css("display",'none');
						$('input[name="submit_updateaccount"]').css("display",'inline-block');
			        	var htmlError = '';
			        	// error
			        	if(data.error != null){
			        		htmlError = generateHtmlAlertError(data.error);
			        		$("div.error_account").html(htmlError);
			        	}else{
			        		// success
			        		dalert.alert("Edit account success.","Success",function callbackMe(){
			        			window.location.reload();
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
				}

			// event click button edit
			$("button.edit-account").on('click',function(){
				// get id account in row.
				row = $(this).parents('tr')[0];
				rowEdit = row;
				_id = $('td',row)[0].innerHTML;
				cleanFormUpdateAccount();

				$.ajax({
			        url: 'index.php?rt=backend/account/getAccount/'+_id,
			        type: 'GET',
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false,
			        success: function(data, textStatus, jqXHR)
			        {
			        	// success if error == null
			        	if(data.error == null){

			        		account = data.account;
			        		username = account.username;
			        		firstname = account.firstname;
			        		lastname = account.lastname;
			        		address = account.address;
			        		gender = account.gender;
			        		avatar = account.avatar;
			        		birthday = account.birthday;

			        		$('input[name="username"]').val(username);
			        		$('input[name="firstname"]').val(firstname);
			        		$('input[name="lastname"]').val(lastname);
			        		if( gender == 1){
			        			$('input:radio[name=gender]')[0].checked = true;
			        		}else if( gender == 0 ){
			        			$('input:radio[name=gender]')[1].checked = true;
			        		}
			        		$( 'input[name="address"]' ).val( address );
			        		$( 'img.avatar' ).attr( 'src' , avatar );
			        		$( 'img.avatar' ).css( 'display' , 'inline' )
			        		$( 'input[name="birthday"]' ).val( birthday );

			        		dialogAddAccount.dialog('open');
			        	}else if(data.error != null){
			        		// data error
			        		htmlError = '<div class="alert alert-error">';
			        		$.each(data.error,function(k,v){
			        			htmlError += v + "</br>";
			        		});
			        		htmlError += '</div>';
			        		dalert.alert(htmlError,'Error');
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
//========================== END EDIT ACCOUNT ============================================================================================== //

//========================== BEGIN CHANGE PASS ACCOUNT ============================================================================================== //
			$( 'input[name="submit_changepass"]' ).click(function(){

				var _id = $('td',rowEdit)[0].innerHTML;
				var newpassword = $( 'input[name="newpassword"]' ).val();
				var renewpassword = $( 'input[name="renewpassword"]' ).val();

				fd = new FormData();
				fd.append("idaccount",_id);
				fd.append("newpassword",newpassword);
				fd.append("renewpassword",renewpassword);

				$.ajax({
			        url: 'index.php?rt=backend/account/changePassword',
			        type: 'POST',
			        data: fd,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false,
			        success: function(data, textStatus, jqXHR)
			        {
			        	// success if error == null
			        	if(data.error == null){
			        		dalert.alert("Change password success","Success",function callbackMe(){
			        			dialogChangePass.dialog( 'close' );
			                });

			        	}else if(data.error != null){
			        		// data error
			        		htmlError = generateHtmlAlertError(data.error);
			        		$("div.error_account").html(htmlError);
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

			$( 'button.change-pass' ).click( function(){
				// get id account in row.
				row = $(this).parents('tr')[0];
				rowEdit = row;
				_id = $('td',row)[0].innerHTML;

				$( 'span.change-username' ).html( '' );
				$( 'input[name="newpassword"]' ).val( '' );
				$( 'input[name="renewpassword"]' ).val( '' );

				$.ajax({
			        url: 'index.php?rt=backend/account/getAccount/'+_id,
			        type: 'GET',
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false,
			        success: function(data, textStatus, jqXHR)
			        {
			        	// success if error == null
			        	if(data.error == null){
			        		account = data.account;
			        		username = account.username;
			        		$( 'span.change-username' ).html( username );
			        		dialogChangePass.dialog('open');
			        	}else if(data.error != null){
			        		// data error
			        		htmlError = '<div class="alert alert-error">';
			        		$.each(data.error,function(k,v){
			        			htmlError += v + "</br>";
			        		});
			        		htmlError += '</div>';
			        		dalert.alert(htmlError,'Error');
			        	}
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			        	var error = ['ERRORS: ' + textStatus];
			            // Handle errors here
			        	dalert.alert(stringHtmlError(error),'Error');
			        }
			    });


			} );
//========================== END CHANGE PASS ACCOUNT ============================================================================================== //

//========================== BEGIN DELETE PASS ACCOUNT ============================================================================================== //
			$( 'button.delete-account' ).click(function(){
				row = $(this).parents('tr')[0];
				rowEdit = row;
				_id = $('td',row)[0].innerHTML;

				// get id product in row.
				row = $(this).parents('tr')[0];
				rowEdit = row;


				dalert.confirm("Are You Sure?","Confirm !",function(result){
		            if(result){

		            	deleteAccount();

		            }
		            else{

		            }
		        });
			});

			function deleteAccount(){

				_id = $('td',rowEdit)[0].innerHTML;
				data = new FormData();
				data.append('id',_id);

				$.ajax({
					url: 'index.php?rt=backend/account/deleteAccount',
			        type: 'POST',
			        data: data,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	// success if error == null
			        	if(data.error == null){
			        		dalert.alert("Delete account success.","Success",function callbackMe(){
			        			window.location.reload();
			                });

			        	}else if(data.error != null){
			        		// data error
			        		htmlError = '<div class="alert alert-error">';
			        		$.each(data.error,function(k,v){
			        			htmlError += v + "</br>";
			        		});
			        		htmlError += '</div>';
			        		dalert.alert(htmlError,'Error');
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

		}

	};
}();

/* =======================  ==================================================*/
var cartmanager = function () {

	return {

		init : function () {
			dialogOrderProduct = $('#dialog-list-orderproduct').dialog({
				 autoOpen: false,
			      width  : 700,
			      modal  : true
			});

			$(".content-table table td").click(function(){
				idOrder = $( 'td' ,$(this).parents( 'tr' )[0] )[0].innerHTML;
				loadDialogOderProduct(idOrder);
			});

			function loadDialogOderProduct( $idOrder ){
				url = "index.php?rt=backend/cart/loadListOrderProduct/" + $idOrder;

				$.ajax({
					url: url,
			        type: 'GET',
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	// success if error == null
			        	if(data.error == null){

			        		html = data.html;
			        		$( '#dialog-list-orderproduct .border-style' ).html( html );
			        		dialogOrderProduct.dialog( 'open' );

			        	}else if(data.error != null){
			        		// data error
			        		htmlError = stringHtmlError( data.error );
			        		dalert.alert(htmlError,'Error');
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
		}

	};
}();

