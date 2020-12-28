<?php

// Save Product Hook //
add_action('wp_ajax_nopriv_addproductformdata','addproductformdata');

add_action('wp_ajax_addproductformdata','addproductformdata');

    function addproductformdata(){
		
		$post = array(
        'post_excerpt' => sanitize_text_field($_POST["product-desc"]),
        'post_status'  => 'pending',
        'post_title'   => sanitize_text_field($_POST["product-title"]),
        'post_type'    => "product",
    );
    
    
    //Create post
    $post_id = wp_insert_post( $post, true );
	update_post_meta($post_id, '_regular_price', sanitize_text_field($_POST["product-price"]));
	update_post_meta($post_id, '_price', sanitize_text_field($_POST["product-price"]));	
	update_post_meta($post_id, '_sku', sanitize_text_field($_POST["product-sku"]));
	update_post_meta($post_id, '_slug', sanitize_text_field($_POST["product-slug"]));
	update_post_meta($post_id, '_product_added_user_email', sanitize_text_field($_POST["product-email"]));
	update_post_meta($post_id, '_sale_price', sanitize_text_field($_POST["product-sales-price"]));	
	update_post_meta( $post_id, '_visibility', 'visible' );
	update_post_meta( $post_id, '_stock_status', 'instock');
	update_post_meta( $post_id, 'total_sales', '0');
	update_post_meta( $post_id, '_downloadable', 'yes');
	update_post_meta( $post_id, '_virtual', 'yes');
	update_post_meta( $post_id, '_featured', "yes" );
	update_post_meta( $post_id, '_weight', sanitize_text_field($_POST["product-weight"]) );
	update_post_meta( $post_id, '_length', sanitize_text_field($_POST["product-length"]) );
	update_post_meta( $post_id, '_width', sanitize_text_field($_POST["product-width"]));
	update_post_meta( $post_id, '_height', sanitize_text_field($_POST["product-height"]));
	update_post_meta( $post_id, '_color', sanitize_text_field($_POST["product-color"]));
	update_post_meta( $post_id, '_product_attributes', array());
	update_post_meta( $post_id, '_sold_individually', "" );
	update_post_meta( $post_id, '_manage_stock', "no" );
	update_post_meta( $post_id, '_backorders', "no" );
	update_post_meta( $post_id, '_stock', "" );
	update_post_meta( $post_id, '_product_image_gallery', sanitize_text_field($_POST["product-image-gallery"]));

	

	if(isset($_POST['product-aft-url']) && !$_POST['product-aft-url']=="")
		{
			update_post_meta($post_id, '_product_url' , sanitize_text_field($_POST['product-aft-url']));
            update_post_meta($post_id, '_button_text' , 'Buy Now');
            wp_set_object_terms ($post_id, 'external', 'product_type');
            wp_set_object_terms( $post_id, 8, 'product_type', true );
		}

	if ( ! empty( $_FILES['product-image-gallery'] )  ) {
        $files = $_FILES['product-image-gallery'];
        foreach ($files['name'] as $key => $value){
            if ($files['name'][$key]){
                $file = array(
                'name' => $files['name'][$key],
                'type' => $files['type'][$key],
                'tmp_name' => $files['tmp_name'][$key],
                'error' => $files['error'][$key],
                'size' => $files['size'][$key]
                );
            }
            $_FILES = array("product-image-gallery" => $file);
            $i=1;
                foreach ($_FILES as $file => $array) {
                      if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) __return_false();
                        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
                        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
                        $attachment_id = media_handle_upload($file, $post_id);
                        $vv .= $attachment_id . ",";
                        $i++;
                }
                update_post_meta($post_id, '_product_image_gallery', sanitize_text_field($_POST["product-image-gallery"]));
        }
    }
    
		
	if ( $_FILES ) {
			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');
			require_once(ABSPATH . "wp-admin" . '/includes/media.php');
			$file_handler = 'file_';
			$attach_id = media_handle_upload($file_handler, $post_id );
			update_post_meta( $post_id, '_thumbnail_id', $attach_id);
		}

        die();
    }
    
// Add Product Ajax
function myscript() {
?>
		<script type="text/javascript">
		  jQuery(document).ready(function($){
			
			//save product ajax request
										
			jQuery("#addproduct").click(function() {
					var $this = jQuery(this);
				  /*Getting Input values in jQuery varibales*/
					var formGroupProductTitle = $("#formGroupProductTitle").val();
					var formGroupProductPrice = $("#formGroupProductPrice").val();
					var formGroupProductEmail = $("#formGroupProductEmail").val();
					var formGroupProductDesc = $("#formGroupProductDesc").val();
					var formGroupProductSalesPrice = $("#formGroupProductSalesPrice").val();
					var formGroupProductslug = $("#formGroupProductslug").val();
					var a = 0;
					var b = 0;
					var c = 0;
					var d = 0
					var e = 0;
					var f = 0;
					var g = 0;
					var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					if(jQuery("#gridCheck1").is(":checked")) {
						
						var basicurl = $("#basic-url").val();
						if(basicurl == "")
						{
						$("#basic-url").css("border", "2px solid red");
						g++;
						}
						else
						{
						$("#basic-url").removeAttr("style");
						g=0;
						}
					}
					else
					{
						g=0;
						$("#basic-url").removeAttr("style");
					}
					
					;
					/*Validation Check*/
					if(formGroupProductTitle == "")
					{
					$("#formGroupProductTitle").css("border", "2px solid red");
					a++;
					}
					else
					{
					$("#formGroupProductTitle").removeAttr("style");
					a=0;
					}
					if(formGroupProductPrice == "")
					{
					$("#formGroupProductPrice").css("border", "2px solid red");
					b++
					}
					else
					{
					$("#formGroupProductPrice").removeAttr("style");
					b=0;
					}
					if(formGroupProductEmail == "" || !regex.test(formGroupProductEmail))
					{
					$("#formGroupProductEmail").css("border", "2px solid red");
					c++
					}
					else
					{
					$("#formGroupProductEmail").removeAttr("style");
					c=0;
					}
					if(formGroupProductDesc == "")
					{
					$("#formGroupProductDesc").css("border", "2px solid red");
					d++
					}
					else
					{
					$("#formGroupProductDesc").removeAttr("style");
					d=0;
					}
					if(formGroupProductSalesPrice == "")
					{
					$("#formGroupProductSalesPrice").css("border", "2px solid red");
					e++
					}
					else
					{
					$("#formGroupProductSalesPrice").removeAttr("style");
					e=0;
					}
					if(formGroupProductslug == "")
					{
					$("#formGroupProductslug").css("border", "2px solid red");
					f++
					}
					else
					{
					$("#formGroupProductslug").removeAttr("style");
					f=0;
					}
					if(a == 0 && b == 0 && c == 0 && d == 0 && e == 0 && f == 0 && g == 0 ) 
					{
						//Button Loader
						var loadingText = 'Adding Product...';
						if ($(this).html() !== loadingText) {
						  $this.data('original-text', $(this).html());
						  $this.html(loadingText);
						  $this.prop('disabled', true);
						}
					 /* Act on the event */
					  var fd = new FormData();
						var file_data = jQuery('input[type=file]')[0].files[0];
							fd.append("file_", file_data);
						var other_data = jQuery('#addproductform').serializeArray();
						jQuery.each(other_data,function(key,input){
							fd.append(input.name,input.value);
						});
						fd.append("action", "addproductformdata");
					  
					  jQuery.ajax({
						 url: "<?php echo admin_url("admin-ajax.php"); ?>",
						 type: "POST",
						 contentType: false,
						 processData: false,
						 data: fd,
						 success: function (response) {
							 //Get Ajax request response
							 //console.log(response)
							 var targetOffset = jQuery('.formdiv').offset().top + (-20);
							 jQuery('html, body').animate({scrollTop: targetOffset}, 1000);
							 jQuery("#addproductform")[0].reset();
							 jQuery("#blah").hide();
							 jQuery(".alert-success").show();
							 setTimeout(function(){ jQuery(".alert-success").hide(); $this.html($this.data('original-text')); $this.prop('disabled', false);}, 3000);
							 
						 },
						 error: function (response) {
						  console.log(response)
						 }
					 });
					}
					else
					{
						var targetOffset = jQuery('.formdiv').offset().top;
					    jQuery('html, body').animate({scrollTop: targetOffset}, 1000);
						return false;
					}
				});
			
		});
		</script>
<?php
}
add_action( 'wp_footer', 'myscript' );