<?php
 /**
  * Plugin Name: Rates
  * Plugin URI: https://yasrab.site/
  * Description: Rates
  * Version: The Plugin's Version Number, e.g.: 1.0
  * Author: Yasrab
  * Author URI: https://yasrab.site/
  * License: A "Slug" license name e.g. GPL2
  * Copyright Yasrab.
  * This file contains the Slider
  * used by Gravity forms
  * included by client scripts.
  *
  * @author Yasrab
  * @version 3.09
  * @package
  *
  * Change History:
  */
 wp_enqueue_style( 'css-file177', plugins_url() . '/pricing/css/style_price.css', array(),  true );
 function rates_tax_caro() {
  $labels = array(
   'name'               => _x( 'Rates', 'post type general name' ),
   'singular_name'      => _x( 'Rates', 'post type singular name' ),
   'add_new'            => _x( 'Add New', 'Rates' ),
   'add_new_item'       => __( 'Add Rate' ),
   'edit_item'          => __( 'Edit Rate' ),
   'new_item'           => __( 'New Rate' ),
   'all_items'          => __( 'All Rates' ),
   'view_item'          => __( 'View Rates' ),
   'search_items'       => __( 'Search Rates' ),
   'not_found'          => __( 'Rates not found' ),
   'not_found_in_trash' => __( 'No Rates found in the Trash' ), 
   'parent_item_colon'  => '',
   'menu_name'          => 'Rates'
  );
  $args = array(
   'labels'        => $labels,
   'description'   => 'Rates',
   'public'        => true,
   'menu_position' => 6,
   'supports'      => array( 'title','editor','thumbnail'),  
   'has_archive'   => true,
  );
  register_post_type( 'rates', $args ); 
 }
 add_action( 'init', 'rates_tax_caro' );
 add_action( 'add_meta_boxes', 'myplugin_add_custom_box_caro' );
add_action( 'add_meta_boxes', 'myplugin_add_custom_box_caro2' );
 function myplugin_add_custom_box_caro() {
     $screens = array( 'rates' );
     foreach ( $screens as $screen ) {
         add_meta_box(
             'myplugin_box_id',            // Unique ID
             'More Rates Options',      // Box title
             'myplugin_inner_custom_box_caro',  // Content callback
              $screen                      // post type
         );
     }
 }
 function myplugin_add_custom_box_caro2() {
     $screens = array( 'rates' );
     foreach ( $screens as $screen ) {
         add_meta_box(
             'myplugin_box_id2',            // Unique ID
             'More Weight Options',      // Box title
             'myplugin_inner_custom_box_caro2',  // Content callback
              $screen                      // post type
         );
     }
 }
 function myplugin_inner_custom_box_caro( $post ) {
 	
	$value_caro = get_post_meta( $post->ID, '_linkcaro', true );
 	$value1_caro = get_post_meta( $post->ID, '_belowcaro', true );
 	
?>
<div style="width:100%">
   <label for="myplugin_field"> GRADE 40 </label>
    <input type="text" name="below_caro" value="<?php echo $value_caro; ?>" /> (<span style="color:#f00">Price should be i.e77000 not like 7,0000</span>)
</div>
<div style="width:100%">
   <label for="myplugin_field"> GRADE 60 </label>
    <input type="text" name="link_caro" value="<?php echo $value1_caro; ?>" /> (<span style="color:#f00">Price should be i.e77000 not like 7,0000</span>)
</div>
 <?php
 }
function myplugin_inner_custom_box_caro2( $post ) {
	$value_caro_sw = get_post_meta( $post->ID, '_sdweight', true );
 	$value1_caro_mm = get_post_meta( $post->ID, '_mmsize', true );
	$value1_caro_kg = get_post_meta( $post->ID, '_kg', true );
?>
    <label for="myplugin_field" style="font-size:10px;"> Standard weight in kg/ft. </label>
    <input type="text" name="sdweight" value="<?php echo $value_caro_sw; ?>" />
    <label for="myplugin_field" style="font-size:10px;"> Size in mm </label>
    <input type="text" name="mmsize" value="<?php echo $value1_caro_mm; ?>" />
    <label for="myplugin_field" style="font-size:10px;"> Standard weight in kg/ft. </label>
    <input type="text" name="kg" value="<?php echo $value1_caro_kg; ?>" />
 <?php
 }
 add_action( 'save_post', 'myplugin_save_postdata_caro' );
 add_action( 'save_post', 'myplugin_save_postdata_caro2' );
 function myplugin_save_postdata_caro( $post_id ) {
     if ( array_key_exists('link_caro', $_POST ) ) {
         update_post_meta( $post_id,
            '_linkcaro',
             $_POST['link_caro']
         );
		 update_post_meta( $post_id,
            '_belowcaro',
             $_POST['below_caro']
         );
     }
 }
function myplugin_save_postdata_caro2( $post_id ) {
     if ( array_key_exists('link_caro', $_POST ) ) {
         update_post_meta( $post_id,
            '_sdweight',
             $_POST['sdweight']
         );
 		update_post_meta( $post_id,
            '_mmsize',
             $_POST['mmsize']
         );
 	
		 update_post_meta( $post_id,
            '_kg',
             $_POST['kg']
         );
     }
 }
 function wpslr_admin_actions2() {  
 } 
 function myplugin_deactivate2(){
 }
 function wpslr_admin_register2()
 {
	  ob_start();
$args_slides_caro = array ('post_type' =>'rates','order'=>'DESC', 'paged' => $paged, 'posts_per_page' =>-1 );
    	$all_slides_caro = new WP_Query( $args_slides_caro );
 ?>
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr><th>Size</th><th>Grade 60</th><th>Grade 40</th></tr>
            <?php 
			foreach($all_slides_caro->posts  as $slide_caro){
			$below_data_caro = get_post_meta( $slide_caro->ID, '_belowcaro' );
			$link_data_caro = get_post_meta( $slide_caro->ID, '_linkcaro' );
            ?>
            <tr>
            <td><?php echo $slide_caro->post_title; ?></td>
            <td><?php echo $link_data_caro[0]; ?></td>
            <td><?php echo $below_data_caro[0]; ?></td>
            </tr>
            <?php } ?>
         </table>
			<ul>
            <li style="list-style:disc"> All Rates are in Pak Rupees per ton</li>
            <li style="list-style:disc">Loading unloading and carriage to be charged at actual.</li>
            </ul>
 <?php 
 return ob_get_clean();
 }
 function wpslr_admin_register3()
 {
	  ob_start();
 $args_slides_caro2 = array ('post_type' =>'rates','order'=>'DESC', 'paged' => $paged, 'posts_per_page' =>-1 );
 $all_slides_caro2 = new WP_Query( $args_slides_caro2 );
 ?>
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr><th>Size in inches</th><th>Standard Weight in kg/ft</th><th>Size in MM</th><th>Standard Weight in kg/ft</th></tr>
            <?php 
			foreach($all_slides_caro2->posts  as $slide_caro2){
			$below_data_caro2 = get_post_meta( $slide_caro2->ID, '_sdweight' );
			$link_data_caro2 = get_post_meta( $slide_caro2->ID, '_mmsize' );
			$link_data_caro3 = get_post_meta( $slide_caro2->ID, '_kg' );
            ?>
            <tr>
            <td><?php echo $slide_caro2->post_title; ?></td>
            <td><?php echo $link_data_caro2[0]; ?></td>
            <td><?php echo $below_data_caro2[0]; ?></td>
            <td><?php echo $link_data_caro3[0]; ?></td>
            </tr>
            <?php } ?>
         </table>
 <?php 
 return ob_get_clean();
 }
 function wpslr_admin_register_calc()
 {
	  ob_start();
function my_javascriptsss_1222() {
 ?>
 <script type="text/javascript" src="<?php echo plugins_url();?>/pricing/js/jquery.chained.min.js"></script>	
	<script type="text/javascript">
		jQuery(document).ready(function($){
	  jQuery("#sizeinmm").chained("#vendor");
	});
	
	jQuery( "#sizeinmm" ).change(function() {
		jQuery("#requi").val("");
		if(jQuery("#vendor").val()=="" || jQuery("#sizeinmm").val()=="")
	{
		jQuery("#requi").attr("disabled", 'disabled');
		
	}
		else{jQuery("#requi").removeAttr("disabled", 'disabled');}
		
	});
	jQuery( "#vendor" ).change(function() {
										
		jQuery("#requi").val("");		
		
	});
	if(jQuery("#vendor").val()=="" || jQuery("#sizeinmm").val()=="")
	{
		jQuery("#requi").attr("disabled", 'disabled');
	}
	jQuery( "#requi" ).keyup(function() {
	
  	var amount	=	jQuery("#requi").val();
	var weight	=	jQuery("#sizeinmm").val();
	var total	=	Math.round(parseFloat(amount)*parseFloat(weight))+" kg";
	jQuery("#weight_res").html("");
	jQuery("#weight_res").html(total);
	if(jQuery( "#requi" ).val()==''){jQuery("#weight_res").html("<span style='color:#f00;font-size:12px;'>Please type length</span>");}
	});				
	</script>
  <?php }
 add_action( 'wp_footer', 'my_javascriptsss_1222' );
 			
$args_slides_caro3 = array ('post_type' =>'rates','order'=>'DESC', 'paged' => $paged, 'posts_per_page' =>-1 );
    	$all_slides_caro3 = new WP_Query( $args_slides_caro3 );
 ?>
             <?php 
			foreach($all_slides_caro3->posts  as $slide_caro3){
			$below_data_caro3 = get_post_meta( $slide_caro3->ID, '_sdweight' );
			
            
            $arr[]	=	"<option value='$slide_caro3->post_title'>".$slide_caro3->post_title."</option>";
            $arr2[]	=	"<option value='$below_data_caro3[0]' class='$slide_caro3->post_title'>".$below_data_caro3[0]."</option>"; 
            
             } 
			?>
            
            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">            
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Size</label>
                    <select name="vendor" id="vendor">
                        <option value="">---Please select---</option>
                        <?php for($i=0;$i<count($arr);$i++){
                        echo $arr[$i];
                        }?>
                    </select>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 cs"><label>Length req. in kg/ft</label><input type="number" id="requi" name="requi" placeholder="Length req. in kg/ft" /></div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 cs"><label>Standard Weight in kg/ft</label>
                    <select name="sizeinmm" id="sizeinmm"><?php
                    for($k=0;$k<count($arr2);$k++){
                        echo $arr2[$k];
                    }?>
                    </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            	<div class="row">
                	<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mg"><label>Total weight.</label><div id="weight_res"></div>                
                </div>
               	</div>
            </div>
            </div>
 <?php
 return ob_get_clean();
 }
 function wpslr_admin_register_calc2()
 {
	 ob_start();
function myfile_29() {
 ?>
 	<script type="text/javascript" src="<?php echo plugins_url();?>/pricing/js/jquery.chained.min.js"></script>
	<script type="text/javascript">
	function ins1000Sep(val){
	  val = val.split(".");
	  val[0] = val[0].split("").reverse().join("");
	  val[0] = val[0].replace(/(\d{3})/g,"$1,");
	  val[0] = val[0].split("").reverse().join("");
	  val[0] = val[0].indexOf(",")==0?val[0].substring(1):val[0];
	  return val.join(".");
}
function rem1000Sep(val){
  return val.replace(/,/g,"");
}
function formatNum(val){
  val = Math.round(val*100)/100;
  val = (""+val).indexOf(".")>-1 ? val + "00" : val + ".00";
  var dec = val.indexOf(".");
  return dec == val.length-3 || dec == 0 ? val : val.substring(0,dec+3);
}
		jQuery(document).ready(function($){
	  jQuery("#sizeinmm2").chained("#vendor2");
	});
	
	jQuery( "#sizeinmm2" ).change(function() {
		jQuery("#requi2").val("");
		if(jQuery("#vendor2").val()=="" || jQuery("#sizeinmm2").val()=="")
	{
		jQuery("#requi2").attr("disabled", 'disabled');
		
	}
		else{jQuery("#requi2").removeAttr("disabled", 'disabled');}
		
	});
	jQuery( "#vendor2" ).change(function() {
										
		jQuery("#requi2").val("");	
		jQuery("#weight_res2").html("");
		jQuery("#ton").html("");	
		jQuery("#tprice").html("");
		jQuery("#loading-price").html("");
		jQuery("#unloading-price").html("");
		
		
	});
	if(jQuery("#vendor2").val()=="" || jQuery("#sizeinmm2").val()=="")
	{
		jQuery("#requi2").attr("disabled", 'disabled');
		jQuery("#weight_res2").html("");		
		jQuery("#ton").html("");
		jQuery("#tprice").html("");
		jQuery("#loading-price").html("");
		jQuery("#unloading-price").html("");
		
		
	}
	jQuery( "#requi2" ).keyup(function() {
	
  	var amount2	=	jQuery("#requi2").val();
	var weight2	=	jQuery("#sizeinmm2").val();
	var total2	=	ins1000Sep(formatNum(Math.round(parseInt(amount2)*parseInt(weight2))/1000))+" PKR";
	jQuery("#weight_res2").html("");
	jQuery("#weight_res2").html(total2);
	jQuery("#ton").html("");
	jQuery("#ton").html((parseFloat(amount2)/1000).toFixed(2)+" Per ton");
	jQuery("#loading-price").html("");
	var closediv = "</div>";
	var tp = parseFloat(amount2*300)/1000;
	jQuery("#loading-price").html("<label>Loading Charge @ 300RS PMT</label><div style='float:right'>"+ins1000Sep(formatNum((parseFloat(amount2)*300).toFixed(2)/1000))+"PKR"+closediv);
	jQuery("#unloading-price").html("<label>Unloading Charge @ 100RS PMT</label><div style='float:right'>"+ins1000Sep(formatNum((parseFloat(amount2)*100).toFixed(2)/1000))+"PKR"+closediv);
	var trpice1 = tp;
	var trpice2	=	parseInt(amount2)*parseInt(weight2)/1000;
	var trpice3	=	parseFloat(amount2*100)/1000;
	var tprices=	ins1000Sep(formatNum(parseInt(trpice2)+parseInt(trpice1)+parseInt(trpice3)));
	jQuery("#tprice").html("<label>Total Price</label><div style='float:right'>"+tprices+" PKR"+closediv);
	
	
	if(jQuery( "#requi2" ).val()==''){jQuery("#weight_res2").html("<span style='color:#f00;font-size:12px;'>Please type length</span>");}
	});				
	</script>
  <?php }
 add_action( 'wp_footer', 'myfile_29' );
 			
$args_slides_caro3 = array ('post_type' =>'rates','order'=>'DESC', 'paged' => $paged, 'posts_per_page' =>-1 );
    	$all_slides_caro3 = new WP_Query( $args_slides_caro3 );
 ?>
             <?php 
			foreach($all_slides_caro3->posts  as $slide_caro3){
			$below_data_caro3 = get_post_meta( $slide_caro3->ID, '_linkcaro' );
			$below_data_caro4 = get_post_meta( $slide_caro3->ID, '_belowcaro' );
			
            
            $arr[]	=	"<option value='$slide_caro3->post_title'>".$slide_caro3->post_title."</option>";
            $arr2[]	=	"<option value='$below_data_caro3[0]' class='$slide_caro3->post_title'>GRADE 40</option>"; 
            $arr3[]	=	"<option value='$below_data_caro4[0]' class='$slide_caro3->post_title'>GRADE 60</option>";
			
             }
			 $merge	=	array_merge($arr3, $arr2);
			?>
            
            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">            
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Size:</label>
                    <select name="vendor2" id="vendor2">
                    <option value="">---Please select---</option>
                    <?php
                     for($i=0;$i<count($arr);$i++)
                     {
                        echo $arr[$i];
                     }
                     ?>
                     </select>
                     </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 cs"><label>Length req. in kg/ft:</label><input type="number" id="requi2" name="requi2" placeholder="Length req. in kg/ft" /><div id="ton"></div></div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 cs">
                        <label>Standard Weight in kg/ft</label><select name="sizeinmm2" id="sizeinmm2">
                    
                    <?php
                     for($k=0;$k<count($merge);$k++)
                     {
                        echo $merge[$k];
                     }
                     ?>
                     </select>
                     </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            	<div class="row">
	                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mg"><label>Price</label><div id="weight_res2" style="float:right"></div><div id="loading-price"></div><div id="unloading-price"></div><div id="tprice"></div></div>
                </div>
            </div>
            
            </div>
			 <?php
 return ob_get_clean();
 }
 register_deactivation_hook( __FILE__, 'myplugin_deactivate2' ); //hook called on deactivation
 add_action('admin_menu', 'wpslr_admin_actions2'); //While activating plugin
 add_shortcode('rates_chart', 'wpslr_admin_register2'); //Short code
 add_shortcode('weight_chart', 'wpslr_admin_register3'); //Short code
 add_shortcode('weight_calc', 'wpslr_admin_register_calc'); //Short code
 add_shortcode('price_calc', 'wpslr_admin_register_calc2'); //Short code
 add_filter('widget_text', 'do_shortcode');
?>