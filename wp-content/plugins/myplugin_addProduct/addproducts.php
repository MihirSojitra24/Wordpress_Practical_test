<?php
	/*
	Plugin Name: Frontend Add Product Form
	Plugin URI: 
	Description: With the help of this plugin, user can upload the woocommerce products from frontend.
	Version: 2.0.0
	Author: Mihir Sojitra
	*/
	
	define( 'Mihir_Woo_Products', '2.0.0' );
	define( 'Mihir_Woo_Products_PLUGIN_DIR' , plugin_dir_path( __FILE__ ));
	require_once( Mihir_Woo_Products_PLUGIN_DIR . 'functions.php' );
		
	
	function themihir_woo_scripts_load() {
		///////////////////////////////////////
		/** Add styles and scripts **/
		wp_register_script('mihir_bootstrap_js', plugins_url('dist/bootstrap.min.js', __FILE__), '', filemtime( plugin_dir_path( __FILE__ ) . 'dist/bootstrap.min.js' ));
		
		wp_register_style( 'mihir_bootstrap_css', plugins_url('dist/bootstrap.min.css', __FILE__), '', filemtime( plugin_dir_path( __FILE__ ) . 'dist/bootstrap.min.css' ));
		wp_enqueue_style('mihir_bootstrap_css');
		wp_enqueue_script('jquery'); //wp code jquery
		wp_enqueue_script('mihir_bootstrap_js');
		
	}
	add_action( 'wp_enqueue_scripts', 'themihir_woo_scripts_load' );
  ///////////////////////////////////////
			
		//Frontend Add Product Form //
		function themihiraddproductform(){ 
		$html = '<div class="container formdiv">
				<div class="alert alert-success alert-dismissible" style="display:none;">
				  <strong>Success!</strong>Product added successfully. Admin will contact you soon.
				</div>
				  <h3 class="display-4 text-center">Add Product</h3>
				  <blockquote class="blockquote text-center">
				  <footer class="blockquote-footer">You can add your product from below form.</footer>
				  </blockquote>
					<form id="addproductform" method="post" action="" enctype="multipart/form-data">
					  <div class="form-group">
						<label for="formGroupExampleInput">Product Title</label>
						<input type="text" name="product-title" class="form-control" id="formGroupProductTitle" placeholder="Product Title">
					  </div>
					  <div class="form-group">
						<label for="formGroupExampleInput">Product Slug</label>
						<input type="text" name="product-slug" class="form-control" id="formGroupProductslug" placeholder="Product Slug">
					  </div>
					  <div class="form-group">
						<label for="formGroupExampleInput">SKU</label>
						<input type="text" name="product-sku" class="form-control" id="formGroupProductSKU" placeholder="Product SKU">
						<small id="emailHelp" class="form-text text-muted">Stock keep unit.</small>
					  </div>
					  <div class="input-group mb-3">
						<div class="input-group-prepend">
						  <span class="input-group-text">Regular Price in $</span>
						</div>
						<input type="number" name="product-price" class="form-control" aria-label="Amount (to the nearest dollar)" id="formGroupProductPrice">
					  </div>
					  <div class="input-group mb-3">
						<div class="input-group-prepend">
						  <span class="input-group-text">Sales Price in $</span>
						</div>
						<input type="number" name="product-sales-price" class="form-control" aria-label="Amount (to the nearest dollar)" id="formGroupProductSalesPrice">
					  </div>
					  <div class="form-group">
						<label for="formGroupProductEmail">Email address</label>
						<input type="text" name="product-email" class="form-control" id="formGroupProductEmail" aria-describedby="emailHelp" placeholder="abc@gmail.com">
						<small id="emailHelp" class="form-text text-muted">Admin will contact you after approval of your product.</small>
					  </div>
					  <div class="form-group">
						<label for="formGroupProductDesc">Product Desciption</label>
						<textarea class="form-control" name="product-desc" id="formGroupProductDesc" rows="6" placeholder="Product Short Desciption"></textarea>
					  </div>
					  <div class="form-group">
					  	<label for="inputGroupFile01">Upload Product Picture (jpg/png)</label>
					  	<input type="file" name="product-image" class="form-control" id="inputGroupFile01">
					  </div>
					  <div class="form-group">
					  	<label for="muti_files">Upload Product Picture (jpg/png)</label>
					  	<input type="file" name="product-image-gallery" multiple="multiple" class="form-control" id="muti_files">
					  </div>
					  <div class="form-group">
					  	<label for="formGroupProductVariationAssignment">Variable Attributes Product Weight</label>
					  	<input type="number" name="product-weight" class="form-control" id="formGroupProductWeight">
					  </div>
					  <div class="form-group">
					  	<label for="formGroupProductLength">Variable Attributes Product length</label>
					  	<input type="number" name="product-length" class="form-control" id="formGroupProductLength">
					  </div>
					  <div class="form-group">
					  	<label for="formGroupProductwidth">Variable Attributes Product width</label>
					  	<input type="number" name="product-width" class="form-control" id="formGroupProductwidth">
					  </div>
					  <div class="form-group">
					  	<label for="formGroupProductwidth">Variable Attributes Product height</label>
					  	<input type="number" name="product-height" class="form-control" id="formGroupProductheight">
					  </div>
					  <div class="form-group">
					  	<label for="formGroupProductwidth">Variable Attributes Product color</label>
					  	<input type="color" name="product-color" class="form-control" id="formGroupProductcolor">
					  </div>
					  <button type="button" class="btn btn-primary" id="addproduct">Submit</button>
					</form>
				  </div>';
				  $html .='<script type="text/javascript">
							
							//show upload image
							function readURL(input) {
								if (input.files && input.files[0]) {
								var reader = new FileReader();

								reader.onload = function(e) {
								jQuery("#blah").attr("src", e.target.result);
								jQuery("#blah").css("display", "block").show();
								}

								reader.readAsDataURL(input.files[0]);
								}
								}

								jQuery("#inputGroupFile01").change(function() {
									var val = jQuery(this).val();
									switch(val.substring(val.lastIndexOf(".") + 1).toLowerCase()){
										case "jpeg": case "jpg": case "png":
										    readURL(this);
											break;
										default:
											jQuery(this).val("");
											// error message here
											alert("Only JPEG and PNG file types are allowed");
											break;
									}
								});
								
							});
						  </script>';
				  
				  return $html;
				  
		}
		add_shortcode( 'ProductForm', 'themihiraddproductform' );
		/** END  **/
		
		// Display Fields Wordpress Dashboard Product Page
		add_action('woocommerce_product_options_general_product_data', 'themihir_product_custom_fields');

		function themihir_product_custom_fields()
		{
			global $woocommerce, $post;
			echo '<div class="themihir_product_custom_fields">';
			// Custom Product Text Field
			woocommerce_wp_text_input(
				array(
					'id' => '_product_added_user_email',
					'placeholder' => 'Product Added User Email',
					'label' => __('Product Added User Email', 'woocommerce'),
					'desc_tip' => 'true'
				)
			);
			echo '</div>';
		}
		if ( ! empty( $_FILES['muti_files'] )  ) {
            $files = $_FILES['muti_files'];
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
                $_FILES = array("muti_files" => $file);
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
                    update_post_meta($post_id, '_product_image_gallery',  $vv);
            }
        }