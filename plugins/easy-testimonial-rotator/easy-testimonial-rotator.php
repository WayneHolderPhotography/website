<?php
/*
* Plugin Name: Easy Testimonial Rotator
* Plugin URI:https://www.i13websolution.com/wordpress-best-testimonials-slider-plugin.html
* Author URI:https://www.i13websolution.com/wordpress-best-testimonials-slider-plugin.html
* Description:This is beautiful responsive testimonial slider plugin for WordPress.Add any number of testimonial from admin panel.
* Author:I Thirteen Web Solution 
* Version:1.0.1
* Text Domain:easy-testimonial-rotator
* Domain Path:/languages
*/
if(!class_exists('etr_i13_captcha_img')){
     $classPath=dirname(__FILE__).'/class/etr_i13_captcha_img.php';
     $classPath=str_replace("\\","/", $classPath);
     require_once "$classPath";
}
    
    add_action('admin_menu', 'etr_add_best_testimonial_slider_admin_menu');
    register_activation_hook(__FILE__,'etr_install_best_testimonial_slider');
    add_action('wp_enqueue_scripts', 'etr_best_testimonial_slider_load_styles_and_js');
    add_shortcode('print_best_testimonial_slider', 'etr_print_best_testimonial_slider_func' );
    add_shortcode('print_best_testimonial_form', 'etr_print_best_testimonial_form_func' );
    add_filter('widget_text', 'do_shortcode');
    add_action ( 'admin_notices', 'etr_best_testimonial_slider_admin_notices' );
    add_action('plugins_loaded', 'etr_load_lang_for_best_testimonial');
    add_action('wp_ajax_etr_get_grav_avtar', 'etr_get_grav_avtar_callback');
    add_action('wp_ajax_nopriv_etr_get_grav_avtar', 'etr_get_grav_avtar_callback');
    add_action('wp_ajax_etr_get_new_captcha', 'etr_get_new_captcha_callback');
    add_action('wp_ajax_nopriv_etr_get_new_captcha', 'etr_get_new_captcha_callback');
    add_action('wp_ajax_etr_save_testimonial', 'etr_save_testimonial_callback');
    add_action('wp_ajax_nopriv_etr_save_testimonial', 'etr_save_testimonial_callback');
    
    function etr_save_testimonial_callback(){
       
       global $wpdb;
       $etr_i13_captcha_img=new etr_i13_captcha_img();
       
        if (isset($_POST) and is_array($_POST) and isset($_POST['tnonce'])) {

          $retrieved_nonce = '';

          if (isset($_POST['tnonce']) and $_POST['tnonce'] != '') {

              $retrieved_nonce = $_POST['tnonce'];
          }
          if (!wp_verify_nonce($retrieved_nonce, 'SubmitNonce')) {


              wp_die('Security check fail');
          }
          
          if(isset($_POST['form_id']) and (int) $_POST['form_id']>0){
              
             $settings_main=get_option('best_testimonial_options'); 
             $settings_main['id']=1;
             $settings=get_option( 'i13_default_form_options' );
             $formId=1;

           
             if(is_array($settings_main)){

                  
                  $errors=array(); 
                 
                    $auth_name='';
                    if(isset($_POST['auth_name'])){
                        $auth_name=trim($_POST['auth_name']);
                    }
                    if($settings['show_author_name'] and $settings['is_author_name_field_required']){

                        if(trim($auth_name)=='' or $auth_name==NULL){

                            $errors['auth_name_'.$formId]=$settings['required_field_error_msg'];

                        }
                    }

                    $auth_desn='';
                     if(isset($_POST['auth_desn'])){
                        $auth_desn=trim($_POST['auth_desn']);
                    }
                    if($settings['show_author_des'] and $settings['is_author_designation_field_required']){

                        if(trim($auth_desn)=='' or $auth_desn==NULL){

                            $errors['auth_desn_'.$formId]=$settings['required_field_error_msg'];

                        }
                    }

                    $auth_email='';
                    if(isset($_POST['auth_email'])){
                        $auth_email=trim($_POST['auth_email']);
                    }
                    if($settings['show_author_email'] and $settings['is_author_email_field_required']){

                        if(trim($auth_email)=='' or $auth_email==NULL){

                            $errors['auth_email_'.$formId]=$settings['required_field_error_msg'];

                        }else{
                               if (filter_var($auth_email, FILTER_VALIDATE_EMAIL) === false) {

                                   $errors['auth_email_'.$formId]=$settings['invalid_email_field_error_msg'];
                               }     
                        }
                    }
                    else if($settings['show_author_email'] and !$settings['is_author_email_field_required']){


                        if(trim($auth_email)!='' or $auth_email!=NULL){

                             if (filter_var($auth_email, FILTER_VALIDATE_EMAIL) === false) {

                                   $errors['auth_email_'.$formId]=$settings['invalid_email_field_error_msg'];
                               }   

                        }

                   }
                   
                 
                   $HdnMediaGrevEmail='';
                    if(isset($_POST['HdnMediaGrevEmail'])){
                        $HdnMediaGrevEmail=trim($_POST['HdnMediaGrevEmail']);
                    }
                    if($settings['show_photo_upload'] and $settings['photo_upload_field_required']){

                        if(trim($HdnMediaGrevEmail)=='' or $HdnMediaGrevEmail==NULL){

                            $errors['HdnMediaGrevEmail_'.$formId]=$settings['required_field_error_msg'];

                        }else{
                               if (filter_var($HdnMediaGrevEmail, FILTER_VALIDATE_EMAIL) === false) {

                                   $errors['HdnMediaGrevEmail_'.$formId]=$settings['invalid_email_field_error_msg'];
                               }      
                        }
                    }
                    else if($settings['show_photo_upload'] and !$settings['photo_upload_field_required']){


                        if(trim($HdnMediaGrevEmail)!='' or $HdnMediaGrevEmail!=NULL){

                             if (filter_var($HdnMediaGrevEmail, FILTER_VALIDATE_EMAIL) === false) {

                                   $errors['HdnMediaGrevEmail_'.$formId]=$settings['invalid_email_field_error_msg'];
                               }  

                        }

                   }
                   
                    $testimonial='';
                    if(isset($_POST['testimonial'])){
                        $testimonial=trim($_POST['testimonial']);
                    }
                    if(trim($testimonial)=='' or $testimonial==NULL){

                            $errors['testimonial_'.$formId]=$settings['required_field_error_msg'];

                    }
                   
                   $captcha='';
                   $cpatcha_name='';
                    if(isset($_POST['captcha'])){
                        $captcha=trim($_POST['captcha']);
                    }
                    if(isset($_POST['cpatcha_name'])){
                        $cpatcha_name=trim($_POST['cpatcha_name']);
                    }
                    if($settings['show_captcha']){
                        
                        if(trim($captcha)=='' or $captcha==NULL or trim($cpatcha_name)=='' or $cpatcha_name==NULL){

                            $errors['cpatcha_'.$formId]=$settings['required_field_error_msg'];

                        }else{
                            
                               if (!$etr_i13_captcha_img->etr_verifyCaptcha($cpatcha_name,$captcha)) {

                                   $errors['cpatcha_'.$formId]=$settings['invalid_captcha'];
                               }      
                        }
                        
                    }
                 
                 if(sizeof($errors)>0){
                     
                     $result=array('result'=>array('fields_error'=>$errors));
                     echo json_encode($result);
                     die;
                     
                 }else{
                     
                            $auth_name=trim(htmlentities(strip_tags($auth_name),ENT_QUOTES));
                            $auth_desn=trim(htmlentities(strip_tags($auth_desn),ENT_QUOTES));
                            $auth_email=trim(htmlentities(strip_tags($auth_email),ENT_QUOTES));
                            $testimonial=trim(htmlentities(strip_tags($testimonial),ENT_QUOTES));
                            $gravatar_email=trim(htmlentities(strip_tags($HdnMediaGrevEmail),ENT_QUOTES));
                            $slider_id=(int)trim(htmlentities(strip_tags($formId),ENT_QUOTES));
                            
                            if($settings['auto_approve_testimonial'])
                                 $status=1;
                            else
                                $status=0;
                            
                            $createdOn=date('Y-m-d h:i:s');
                            if(function_exists('date_i18n')){

                                    $createdon=date_i18n('Y-m-d'.' '.get_option('time_format') ,false,false);
                                    if(get_option('time_format')=='H:i')
                                        $createdon=date('Y-m-d H:i:s',strtotime($createdOn));
                                    else   
                                        $createdon=date('Y-m-d h:i:s',strtotime($createdOn));

                             }

                            $table_name = $wpdb->prefix . "b_testimo_slide";
                          
                            
                             $wpdb->query( $wpdb->prepare("
                                            INSERT INTO $table_name
                                            ( testimonial,auth_name,auth_desn,auth_email,createdon,gravatar_email,status)
                                            VALUES ( '%s','%s','%s','%s','%s','%s',%d)", 
                                    array(
                                            stripslashes_deep($testimonial), 
                                            stripslashes_deep($auth_name), 
                                            stripslashes_deep($auth_desn),
                                            stripslashes_deep($auth_email),
                                            $createdOn,
                                            stripslashes_deep($gravatar_email),
                                            $status
                                        
                                    ) 
                            ) );
                             
                            
                            $newTestimonial_id=0; 
                            if(isset($wpdb->insert_id)){
                                $newTestimonial_id=$wpdb->insert_id;
                            }
                            
                            
                            if($newTestimonial_id>0){
                                
                                if($settings['notify_admin_new_testimonial']){
                                    
                                        $email_subject=stripslashes_deep($settings['email_subject']);
                                        $email_From_name=stripslashes_deep($settings['email_From_name']);
                                        $email_From=stripslashes_deep($settings['email_From']);
                                        $email_to=stripslashes_deep($settings['email_to']);
                                        $email_body=stripslashes_deep($settings['email_body']);
                                        
                                        $adminData=get_user_by('email',get_option('admin_email'));
                                        $admin_name='';
                                        if(is_object($adminData)){
                                         $admin_name= $adminData->user_nicename;  
                                            
                                        }
                                        $testimonial_moderate_edit_link_plain=admin_url()."admin.php?page=best_testimonial_slider_testimonial_management&action=addedit&id=$newTestimonial_id";
                                        $testimonial_moderate_edit_link_html='<a href="'.$testimonial_moderate_edit_link_plain.'">Edit Testimonial</a>';
                                        
                                        $email_body=  str_replace('[admin_name]', $admin_name, $email_body);
                                        $email_body=  str_replace('[admin_email]', get_option('admin_email'), $email_body);
                                        $email_body=  str_replace('[testimonial_moderate_edit_link_plain]', $testimonial_moderate_edit_link_plain, $email_body);
                                        $email_body=  str_replace('[testimonial_moderate_edit_link_html]', $testimonial_moderate_edit_link_html, $email_body);
                                        $email_body=  str_replace('[sitename]', get_bloginfo( 'name' ), $email_body);
                                        
                                        $charSet=get_bloginfo('charset');
                                        
                                        $mailheaders='';
                                        //$mailheaders .= "X-Priority: 1\n";
                                        $mailheaders .= "Content-Type: text/html; charset=\"UTF-8\"\n";
                                        $mailheaders .= "From: $email_From_name <$email_From>" . "\r\n";
                                        //$mailheaders .= "Bcc: $emailTo" . "\r\n";
                                        $message='<html><head></head><body>'.$email_body.'</body></html>';
                                        $Rreturns=wp_mail($email_to, $email_subject, $message, $mailheaders);
                                     
                                }
                                
                                
                                $resetFormsFields=array();
                                
                                $uploads = wp_upload_dir();
                                $baseurl=$uploads['baseurl'];
                                $baseurl.='/easy-testimonial-rotator/';
                                $captchaImgName=$etr_i13_captcha_img->etr_generateI13Captcha();
                                $captchaRefreshed=array('cpatcha_name'=>$captchaImgName,'captcha_url'=>$baseurl.$captchaImgName.'.jpeg');
                                foreach($_POST as $k => $v){
                                    
                                    if($k!='tnonce' and $k!='action' and $k!='form_id')
                                        $resetFormsFields[$k.'_'.$slider_id]='';
                                    
                                }
                                
                                $result=array('result'=>array('success'=>$settings['success_msg'],'resetFormsFields'=>$resetFormsFields,'captchaRefreshed'=>$captchaRefreshed));
                                echo json_encode($result);
                                die;
                            }
                            else{
                                
                                $uploads = wp_upload_dir();
                                $baseurl=$uploads['baseurl'];
                                $baseurl.='/easy-testimonial-rotator/';
                                $captchaImgName=$etr_i13_captcha_img->etr_generateI13Captcha();
                                $captchaRefreshed=array('cpatcha_name'=>$captchaImgName,'captcha_url'=>$baseurl.$captchaImgName.'.jpeg');
                                
                                $result=array('result'=>array('error'=>$settings['error_msg'],'captchaRefreshed'=>$captchaRefreshed));
                                echo json_encode($result);
                                die;
                                
                            }
                            
                     
                 }   
                
             }
             else{
                  $result=array('result'=>array('error'=>'Does not found such form'));
                  echo json_encode($result);
                  die;
             }
              
          }
          
          
          die;
        }
        die;
        
    }
    
    function etr_get_new_captcha_callback(){
        
        if (isset($_POST) and is_array($_POST) and isset($_POST['vNonce'])) {

          $retrieved_nonce = '';
          $etr_i13_captcha_img=new etr_i13_captcha_img();

          if (isset($_POST['vNonce']) and $_POST['vNonce'] != '') {

              $retrieved_nonce = $_POST['vNonce'];
          }
          if (!wp_verify_nonce($retrieved_nonce, 'vNonce')) {


              wp_die('Security check fail');
          }

          if (isset($_POST['oldcaptcha']) and $_POST['oldcaptcha'] != '') {
              $oldCaptcha=trim($_POST['oldcaptcha']);
              $etr_i13_captcha_img->etr_removeByName($oldCaptcha);
          }
          
          $uploads = wp_upload_dir();
          $baseurl=$uploads['baseurl'];
          $baseurl.='/easy-testimonial-rotator/';
          $captchaImgName=$etr_i13_captcha_img->etr_generateI13Captcha();
          $return=array('cpatcha_name'=>$captchaImgName,'captcha_url'=>$baseurl.$captchaImgName.'.jpeg');
          echo json_encode($return);
          die;
      }
      die;

   }
    
    function etr_get_grav_avtar_callback(){
        
            if (isset($_POST) and is_array($_POST) and isset($_POST['email'])) {

              $retrieved_nonce = '';

              if (isset($_POST['vNonce']) and $_POST['vNonce'] != '') {

                  $retrieved_nonce = $_POST['vNonce'];
              }
              if (!wp_verify_nonce($retrieved_nonce, 'vNonce')) {


                  wp_die('Security check fail');
              }

              $email=trim($_POST['email']);
              $email=md5($email);
              $url="https://www.gravatar.com/avatar/$email?s=200";

              echo $url;
              die;
          }
          die;

       }
    
    function etr_load_lang_for_best_testimonial() {
            
            load_plugin_textdomain( 'easy-testimonial-rotator', false, basename( dirname( __FILE__ ) ) . '/languages/' );
    }

    function etr_best_testimonial_slider_load_styles_and_js(){
         if (!is_admin()) {                                                       
             
            wp_enqueue_style( 'best-testimonial-bx', plugins_url('/css/best-testimonial-bx.css', __FILE__) );
            wp_enqueue_style( 'best-testimonial-bx-cols-css', plugins_url('/css/best-testimonial-bx-cols-css.css', __FILE__) );
            wp_enqueue_script('jquery'); 
            wp_enqueue_script('best-testimonial-slider',plugins_url('/js/best-testimonial-slider.js', __FILE__));
           
            
         }  
      }
      
    function etr_best_testimonial_slider_admin_notices() {
         
      if (is_plugin_active ( 'easy-testimonial-rotator/easy-testimonial-rotator.php' )) {
		
		$uploads = wp_upload_dir ();
		$baseDir = $uploads ['basedir'];
		$baseDir = str_replace ( "\\", "/", $baseDir );
		$pathToImagesFolder = $baseDir . '/easy-testimonial-rotator';
		
		if (file_exists ( $pathToImagesFolder ) and is_dir ( $pathToImagesFolder )) {
			
			if (! is_writable ( $pathToImagesFolder )) {
				echo "<div class='updated'><p>Easy Testimonial Rotator is active but does not have write permission on</p><p><b>" . $pathToImagesFolder . "</b> directory.Please allow write permission.</p></div> ";
			}
		} else {
			
			wp_mkdir_p ( $pathToImagesFolder );
			@file_put_contents ( $pathToImagesFolder."/index.php","" );
			if (! file_exists ( $pathToImagesFolder ) and ! is_dir ( $pathToImagesFolder )) {
				echo "<div class='updated'><p>Easy Testimonial Rotator is active but plugin does not have permission to create directory</p><p><b>" . $pathToImagesFolder . "</b> .Please create easy-testimonial-rotator directory inside upload directory and allow write permission.</p></div> ";
			}
		}
	}
    }    
    
    function etr_install_best_testimonial_slider(){
        
           global $wpdb;
           $table_name = $wpdb->prefix . "b_testimo_slide";
           
                  $sql = "CREATE TABLE " . $table_name . " (
                          `id` int(10)  NOT NULL AUTO_INCREMENT,
                          `testimonial` text  NOT NULL,
                          `image_name` varchar(500)  NOT NULL,
                          `auth_name` varchar(500)  DEFAULT NULL,
                          `auth_desn` varchar(500)  DEFAULT NULL,
                          `auth_email` varchar(500)  DEFAULT NULL,
                          `createdon` datetime NOT NULL,
                          `gravatar_email` varchar(200)  DEFAULT NULL,
                          `status` tinyint(1) NOT NULL DEFAULT '0',
                           PRIMARY KEY (`id`)
                );
                
                                 
                ";
               require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
               dbDelta($sql);
               
               $uploads = wp_upload_dir ();
               $baseDir = $uploads ['basedir'];
               $baseDir = str_replace ( "\\", "/", $baseDir );
               $pathToImagesFolder = $baseDir . '/easy-testimonial-rotator';
               @file_put_contents ( $pathToImagesFolder."/index.php","" );
                wp_mkdir_p ( $pathToImagesFolder );
              
                $settings_slider=array();
                $settings_slider['auto']=null;
                $settings_slider['is_circular_slider']=1;
                $settings_slider['speed']=1000;
                $settings_slider['pause']=10000;
                $settings_slider['box_border_color']="#FFFFFF";
                $settings_slider['box_border_size']=5;
                $settings_slider['box_shadow_color']="#FFFFFF";
                $settings_slider['slider_back_color']="#FFFFFF";
                $settings_slider['is_adaptive_height']=1;
                $settings_slider['show_arrows']=1;
                $settings_slider['show_author_name']=1;
                $settings_slider['show_author_des']=1;
                $settings_slider['show_pagination']=1;
                $settings_slider['touch_enabled']=1;
                $settings_slider['resize_images']=1;

                 
                if( !get_option( 'best_testimonial_options' ) ) {

                      update_option('best_testimonial_options',$settings_slider);
                }
                  
                $settings=array();
                $settings['show_captcha']=1;
                $settings['show_author_name']=1;
                $settings['show_author_des']=1;
                $settings['show_author_email']=1;
                $settings['show_photo_upload']=1;
                $settings['is_author_name_field_required']=1;
                $settings['is_author_designation_field_required']=1;
                $settings['is_author_email_field_required']=1;
                $settings['photo_upload_field_required']=1;

                $settings['testimonial_label']='Testimonial';
                $settings['author_name_label']='Author Name';
                $settings['author_designation_lable']="Author Designation";
                $settings['author_photo_label']='Upload Author Photo';
                $settings['author_photo_link_label']='Click here to use gravatar.com photo avatar';
                $settings['author_email_label']='Author Email';
                $settings['testimonial_order_label']='Testimonial Order';
                $settings['captcha_label']='Enter Captcha';
                $settings['new_captcha_label']='Get New Captcha';
                $settings['status_label']='Status';
                $settings['submit_label']='Submit';
                $settings['required_field_error_msg']="This field is required.";
                $settings['invalid_email_field_error_msg']="Please enter a valid email.";
                $settings['invalid_photo_field_error_msg']="Please upload valid file. Only .jpg,.jpeg,.png extensions are allowed.";
                $settings['invalid_captcha']="Invalid captcha code.";
                $settings['success_msg']="New testimonial submitted successfully.Admin will mordred soon.";
                $settings['error_msg']="An error occurred while submitting testimonial.";
                $settings['auto_approve_testimonial']=0;
                $settings['notify_admin_new_testimonial']=1;
                $settings['email_subject']='New testimonial received';
                $settings['email_From_name']=get_bloginfo( 'name' );
                $settings['email_From']=  get_option( 'admin_email' );
                $settings['email_to']=  get_option( 'admin_email' );
                $settings['email_body']="Hello [admin_name],
                                        <br class='blank' />
                                        You have just received new testimonial, You can check it by visiting here [testimonial_moderate_edit_link_html]
                                        <br class='blank' />
                                        Thanks &amp; Regards
                                        <br class='blank' />
                                        [sitename]";

                  if( !get_option( 'i13_default_form_options' ) ) {

                        update_option('i13_default_form_options',$settings);
                    }
                
               
     } 
    
    
    
   
    function etr_add_best_testimonial_slider_admin_menu(){
        
        $hook_suffix_r_t_s=add_menu_page( __( 'Easy Testimonial Rotator','easy-testimonial-rotator'), __( 'Easy Testimonial Rotator','easy-testimonial-rotator'), 'administrator', 'best_testimonial_slider', 'etr_best_testimonial_slider_admin_options' );
        $hook_suffix_r_t_s=add_submenu_page( 'best_testimonial_slider', __( 'Slider Settings','easy-testimonial-rotator'), __( 'Slider Settings','easy-testimonial-rotator' ),'administrator', 'best_testimonial_slider', 'etr_best_testimonial_slider_admin_options' );
        $hook_suffix_r_t_s_1=add_submenu_page( 'best_testimonial_slider', __( 'Form Settings','easy-testimonial-rotator'), __( 'Form Settings','easy-testimonial-rotator' ),'administrator', 'best_testimonial_slider_form_settings', 'etr_best_testimonial_slider_forms' );
        $hook_suffix_r_t_s_2=add_submenu_page( 'best_testimonial_slider', __( 'Manage Testimonials','easy-testimonial-rotator'), __( 'Manage Testimonials','easy-testimonial-rotator'),'administrator', 'best_testimonial_slider_testimonial_management', 'etr_best_testimonial_management' );
        $hook_suffix_r_t_s_3=add_submenu_page( 'best_testimonial_slider', __( 'Preview Slider','easy-testimonial-rotator'), __( 'Preview Slider','easy-testimonial-rotator'),'administrator', 'best_testimonial_slider_preview', 'etr_best_testimonial_preview_admin' );
        
        add_action( 'load-' . $hook_suffix_r_t_s ,   'etr_best_testimonial_slider_admin_init' );
        add_action( 'load-' . $hook_suffix_r_t_s_1 , 'etr_best_testimonial_slider_admin_init' );
        add_action( 'load-' . $hook_suffix_r_t_s_2 , 'etr_best_testimonial_slider_admin_init' );
        add_action( 'load-' . $hook_suffix_r_t_s_3 , 'etr_best_testimonial_slider_admin_init' );
        
    }
    
    function etr_best_testimonial_slider_admin_init(){
      
      $url = plugin_dir_url(__FILE__);  
      wp_enqueue_script('jquery.validate', $url.'js/jquery.validate.js' );  
      wp_enqueue_script('best-testimonial-slider', $url.'js/best-testimonial-slider.js' );  
      wp_enqueue_style( 'admin-css-responsive', plugins_url('/css/admin-css-responsive.css', __FILE__) );
      wp_enqueue_style('best-testimonial-bx-cols-css',$url.'css/best-testimonial-bx-cols-css.css');
      wp_enqueue_style('best-testimonial-bx',$url.'css/best-testimonial-bx.css');
      etr_best_testimonial_slider_admin_scripts_init();
      
    }
    
    
   function etr_best_testimonial_slider_forms(){
      
       $url = plugin_dir_url(__FILE__);
       
       if(isset($_POST['btnsave'])){
          
                  

            if ( !check_admin_referer( 'action_image_add_edit','add_edit_image_nonce')){

               wp_die('Security check fail'); 
             }
            
            global $wpdb;
            
            if(isset($_POST['btnsave'])){
                
               $_POST = stripslashes_deep( $_POST );
                 
                $settings=array(
                    
                    'show_captcha'=>$_POST['show_captcha'],
                    'show_author_name'=>$_POST['show_author_name'],
                    'show_author_des'=>$_POST['show_author_des'],
                    'show_author_email'=>$_POST['show_author_email'],
                    'show_photo_upload'=>$_POST['show_photo_upload'],
                    'is_author_name_field_required'=>$_POST['is_author_name_field_required'],
                    'is_author_designation_field_required'=>$_POST['is_author_designation_field_required'],
                    'is_author_email_field_required'=>$_POST['is_author_email_field_required'],
                    'photo_upload_field_required'=>$_POST['photo_upload_field_required'],
                    'testimonial_label'=>$_POST['testimonial_label'],
                    'author_name_label'=>$_POST['author_name_label'],
                    'author_designation_lable'=>$_POST['author_designation_lable'],
                    'author_photo_label'=>$_POST['author_photo_label'],
                     'author_photo_link_label'=>$_POST['author_photo_link_label'],
                     'author_email_label'=>$_POST['author_email_label'],
                    'captcha_label'=>$_POST['captcha_label'],
                    'new_captcha_label'=>$_POST['new_captcha_label'],
                    'status_label'=>$_POST['status_label'],
                    'submit_label'=>$_POST['submit_label'],
                    'required_field_error_msg'=>$_POST['required_field_error_msg'],
                    'invalid_email_field_error_msg'=>$_POST['invalid_email_field_error_msg'],
                    'invalid_photo_field_error_msg'=>$_POST['invalid_photo_field_error_msg'],
                    'invalid_captcha'=>$_POST['invalid_captcha'],
                    'success_msg'=>$_POST['success_msg'],
                    'error_msg'=>$_POST['error_msg'],
                    'auto_approve_testimonial'=>$_POST['auto_approve_testimonial'],
                    'notify_admin_new_testimonial'=>$_POST['notify_admin_new_testimonial'],
                    'email_subject'=>$_POST['email_subject'],
                    'email_From_name'=>$_POST['email_From_name'],
                    'email_From'=>$_POST['email_From'],
                    'email_to'=>$_POST['email_to'],
                    'email_body'=>$_POST['email_body'],
           
                    
                    
                );  
                
                $settings=update_option( 'i13_default_form_options',$settings );                                   
            
                $best_testimonial_slider_messages=array();
                $best_testimonial_slider_messages['type']='succ';
                $best_testimonial_slider_messages['message']= __('Form settings updated successfully.','easy-testimonial-rotator');
                update_option('best_testimonial_slider_messages', $best_testimonial_slider_messages);
                   
            }
            
            $location='admin.php?page=best_testimonial_slider_form_settings';
            echo "<script type='text/javascript'> location.href='$location';</script>";
            exit;
         
     }  
     
     $settings=get_option( 'i13_default_form_options' );
      
?>
<div style="width: 100%;">  
            <div style="float:left;width:100%;">
                <div class="wrap">
                    <table><tr><td><a href="https://twitter.com/FreeAdsPost" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false">Follow @FreeAdsPost</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></td>
                        <td>
                            <a target="_blank" title="Donate" href="http://www.i13websolution.com/donate-wordpress_image_thumbnail.php">
                                <img id="help us for free plugin" height="30" width="90" src="<?php echo plugins_url( 'images/paypaldonate.jpg', __FILE__ ) ;?>" border="0" alt="help us for free plugin" title="help us for free plugin">
                            </a>
                        </td>
                        </tr>
                    </table>
                 <span><h3 style="color: blue;"><a target="_blank" href="https://www.i13websolution.com/wordpress-best-testimonials-slider-plugin.html">UPGRADE TO PRO VERSION</a></h3></span>
                   <div id="post-body-content" >
                                    
  
                  <?php
                   
                    $messages=get_option('best_testimonial_slider_messages'); 
                    $type='';
                    $message='';
                    if(isset($messages['type']) and $messages['type']!=""){

                       $type=$messages['type'];
                       $message=$messages['message'];
                       
                       update_option('best_testimonial_slider_messages', array());     

                    }  
                    if($type=='err'){ echo "<div class='errMsg'>"; echo $message; echo "</div>";}
                    else if($type=='succ'){ echo "<div class='succMsg'>"; echo $message; echo "</div>";}
                    ?>  
                   <h2><?php echo __('Form Settings','easy-testimonial-rotator');?></h2>
                    
                    <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-2">
                            
                            <div id="post-body-content">
                                <form method="post" action="" id="scrollersettiings" name="scrollersettiings" >
                                 
                                   <fieldset class="fieldsetAdmin">
                                            <legend><?php echo __('Form Settings','easy-testimonial-rotator');?></legend> 
                                    <div class="stuffbox" id="namediv" style="width:100%;">
                                        
                                        <table cellspacing="0" class="form-list" cellpadding="10">
                                            <tbody>
                                                
                                                <tr>
                                                    <td class="label">
                                                        <label for="show_author_name"><?php echo __('Show Author Name Field ?','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <select id="show_author_name" name="show_author_name" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_author_name']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_author_name']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                <tr id="tr_is_author_name_field_required" style="display:none">
                                                    <td class="label">
                                                        <label for="is_author_name_field_required"><?php echo __('Author Name Field Is Required Field ?','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <select id="is_author_name_field_required" name="is_author_name_field_required" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['is_author_name_field_required']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['is_author_name_field_required']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="label">
                                                        <label for="show_author_des"><?php echo __('Show Author Designation Field ?','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <select id="show_author_des" name="show_author_des" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_author_des']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_author_des']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                <tr id="tr_is_author_designation_field_required" style="display:none">
                                                    <td class="label">
                                                        <label for="is_author_des_field_required"><?php echo __('Author Designation Field Is Required Field ?','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <select id="is_author_designation_field_required" name="is_author_designation_field_required" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['is_author_designation_field_required']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['is_author_designation_field_required']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="label">
                                                        <label for="show_author_email"><?php echo __('Show Author Email Field ?','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <select id="show_author_email" name="show_author_email" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_author_email']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_author_email']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                <tr id="tr_is_author_email_field_required">
                                                    <td class="label">
                                                        <label for="is_author_email_field_required"><?php echo __('Author Email Field Is Required Field ?','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <select id="is_author_email_field_required" name="is_author_email_field_required" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['is_author_email_field_required']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['is_author_email_field_required']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="label">
                                                        <label for="show_captcha"><?php echo __('Protect Front-end Form with Captcha ?','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <select id="show_captcha" name="show_captcha" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_captcha']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_captcha']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td class="label">
                                                        <label for="show_photo_upload"><?php echo __('Show Photo Upload ? ','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                        <br/>
                                                        <div style="font-size: 10px;font-weight: bold;margin-left: 10px;margin-top: 10px;">Note:- On front-end only gravatar.com Photo is allowed.</div>
                                                    </td>
                                                    <td class="value">
                                                        <select id="show_photo_upload" name="show_photo_upload" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_photo_upload']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_photo_upload']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                <tr id="tr_photo_upload_field_required">
                                                    <td class="label">
                                                        <label for="photo_upload_field_required"><?php echo __('Photo Field Is Required Field ?','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <select id="photo_upload_field_required" name="photo_upload_field_required" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['photo_upload_field_required']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['photo_upload_field_required']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                        </table>
                                    </div>
                                   </fieldset>         
                                  <fieldset class="fieldsetAdmin">
                                            <legend><?php echo __('Messages & Label Settings','easy-testimonial-rotator');?></legend>  
                                    <div class="stuffbox" id="namediv" style="width:100%;">
                                        
                                        <table cellspacing="0" class="form-list" cellpadding="10">
                                            <tbody>
                                                <tr>
                                                    <td class="label">
                                                        <label for="testimonial_label"><?php echo __('Testimonial Label','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <input id="testimonial_label" value="<?php echo $settings['testimonial_label']; ?>" name="testimonial_label"  class="input-text" type="text" />           
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td class="label">
                                                        <label for="author_name_label"><?php echo __('Author Name Label','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <input id="author_name_label" value="<?php echo $settings['author_name_label']; ?>" name="author_name_label"  class="input-text" type="text" />            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="author_designation_lable"><?php echo __('Author Designation Label','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <input id="author_designation_lable" value="<?php echo $settings['author_designation_lable']; ?>" name="author_designation_lable"  class="input-text" type="text" />            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="author_photo_label"><?php echo __('Author Photo Label','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <input id="author_photo_label" value="<?php echo $settings['author_photo_label']; ?>" name="author_photo_label"  class="input-text" type="text" />            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="author_photo_link_label"><?php echo __('Author Photo Link Label','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <input id="author_photo_link_label" value="<?php echo $settings['author_photo_link_label']; ?>" name="author_photo_link_label"  class="input-text" type="text" />            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 
                                                 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="author_email_label"><?php echo __('Author Email Label','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <input id="author_email_label" value="<?php echo $settings['author_email_label']; ?>" name="author_email_label"  class="input-text" type="text" />            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 
                                                 
                                                 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="captcha_label"><?php echo __('Captcha Label','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <input id="captcha_label" value="<?php echo $settings['captcha_label']; ?>" name="captcha_label"  class="input-text" type="text" />            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="new_captcha_label"><?php echo __('New Captcha Label','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <input id="new_captcha_label" value="<?php echo $settings['new_captcha_label']; ?>" name="new_captcha_label"  class="input-text" type="text" />            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="status_label"><?php echo __('Status Label','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <input id="status_label" value="<?php echo $settings['status_label']; ?>" name="status_label"  class="input-text" type="text" />            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="submit_label"><?php echo __('Submit Label','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <input id="submit_label" value="<?php echo $settings['submit_label']; ?>" name="submit_label"  class="input-text" type="text" />            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="required_field_error_msg"><?php echo __('Required Field Error Message','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <textarea cols="50" id="required_field_error_msg"  name="required_field_error_msg"  class="input-text" type="text" ><?php echo $settings['required_field_error_msg']; ?></textarea>            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 
                                                 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="invalid_email_field_error_msg"><?php echo __('Invalid Email Field Error Message','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <textarea cols="50" id="invalid_email_field_error_msg"  name="invalid_email_field_error_msg"  class="input-text" type="text" ><?php echo $settings['invalid_email_field_error_msg']; ?></textarea>            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="invalid_photo_field_error_msg"><?php echo __('Invalid Photo Field Error Message','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <textarea cols="50" id="invalid_photo_field_error_msg"  name="invalid_photo_field_error_msg"  class="input-text" type="text" ><?php echo $settings['invalid_photo_field_error_msg']; ?></textarea> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="invalid_captcha"><?php echo __('Invalid Captcha Message','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <textarea cols="50" id="invalid_captcha"  name="invalid_captcha"  class="input-text" type="text" ><?php echo $settings['invalid_captcha']; ?></textarea> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="success_msg"><?php echo __('Success Message','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <textarea cols="50" id="success_msg"  name="success_msg"  class="input-text" type="text" ><?php echo $settings['success_msg']; ?></textarea> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="error_msg"><?php echo __('Error Message','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <textarea cols="50" id="error_msg"  name="error_msg"  class="input-text" type="text" ><?php echo $settings['error_msg']; ?></textarea> 
                                                       <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 
                                                <tr>
                                                    <td class="label">
                                                        
                                                        <?php wp_nonce_field('action_image_add_edit','add_edit_image_nonce'); ?>
                                                      
                                                    </td>
                                                    <td class="value">
                                                        <?php if(isset($_GET['id']) and $_GET['id']>0){ ?> 
                                                            <input type="hidden" name="sliderid" id="sliderid" value="<?php echo $_GET['id'];?>" />
                                                            <?php
                                                            } 
                                                        ?>  
                                                       
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>                                    
                                    </div>
                                  </fieldset>
                                    <fieldset class="fieldsetAdmin">
                                            <legend><?php echo __('Testimonial moderation & email settings','easy-testimonial-rotator');?></legend> 
                                    <div class="stuffbox" id="namediv" style="width:100%;">
                                        <style>
                                            #namediv input {
                                                    width: auto;
                                                }
                                        </style>    
                                        <table cellspacing="0" class="form-list-email" cellpadding="10">
                                            <tbody>
                                                
                                                <tr>
                                                    <td class="label">
                                                        <label for="auto_approve_testimonial"><?php echo __('Auto Approve Testimonial ?','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <select id="auto_approve_testimonial" name="auto_approve_testimonial" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['auto_approve_testimonial']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['auto_approve_testimonial']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label">
                                                        <label for="notify_admin_new_testimonial"><?php echo __('Notify Admin For New Testimonial Received','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                         <select id="notify_admin_new_testimonial" name="notify_admin_new_testimonial" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['notify_admin_new_testimonial']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['notify_admin_new_testimonial']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                <tr id="tr_email_subject">
                                                    <td class="label">
                                                        <label for="email_subject"><?php echo __('Email Subject','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <input style="width:450px" id="email_subject" value="<?php echo $settings['email_subject']; ?>" name="email_subject"  class="input-text" type="text" />            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                <tr id="tr_email_From_name">
                                                    <td class="label">
                                                        <label for="email_From_name"><?php echo __('Email From Name','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <input style="width:450px" id="email_From_name" value="<?php echo $settings['email_From_name']; ?>" name="email_From_name"  class="input-text" type="text" />            
                                                        <div style="clear:both">(ex. admin)</div>
                                                        <div class="error_label"></div> 
                                                         
                                                    </td>
                                                </tr>
                                                <tr id="tr_email_From">
                                                    <td class="label">
                                                        <label for="email_From"><?php echo __('Email From','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <input style="width:450px" id="email_From" value="<?php echo $settings['email_From']; ?>" name="email_From"  class="input-text" type="text" />            
                                                        <div style="clear:both">(ex. admin@yoursite.com)</div>
                                                        <div class="error_label"></div> 
                                                         
                                                    </td>
                                                </tr>
                                                <tr id="tr_email_to">
                                                    <td class="label">
                                                        <label for="email_to"><?php echo __('Email To','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <input style="width:450px" id="email_to" value="<?php echo $settings['email_to']; ?>" name="email_to"  class="input-text" type="text" />            
                                                        <div style="clear:both">(ex. admin@yoursite.com)</div>
                                                        <div class="error_label"></div> 
                                                         
                                                    </td>
                                                </tr>
                                                <tr id="tr_email_body">
                                                    <td class="label">
                                                        <label for="email_body"><?php echo __('Email Body','easy-testimonial-rotator');?> <span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <div class="wrap">
                                                        <?php
                                                           // wp_editor('',"email_body", array('textarea_rows'=>12, 'editor_class'=>'ckeditor'));
                                                        wp_editor( $settings['email_body'], 'email_body' );
  
                                                        ?> 
                                                            
                                                         <input type="hidden" name="editor_val" id="editor_val" /> 
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                        <br/>you can use [admin_name],[admin_email],[testimonial_moderate_edit_link_plain],<br/> [testimonial_moderate_edit_link_html] <br/> [sitename] place holder into email content 
                                                         </div>
                                                    </td>
                                                </tr>
                                        </table>
                                    </div>
                                    </fieldset>        
                                     <input type="submit"  name="btnsave" id="btnsave" value="<?php echo __('Save Changes','easy-testimonial-rotator');?>" class="button-primary" />&nbsp;
                                     <input type="button" name="cancle" id="cancle" value="<?php echo __('Cancel','easy-testimonial-rotator');?>" class="button-primary" onclick="location.href='admin.php?page=best_testimonial_slider'" />
  
                                </form>
                                <script type="text/javascript">

                                    var $n = jQuery.noConflict();
                                    
                                      
                                   
                                    $n(document).ready(function() {
                                            
                                       $n.validator.addMethod("chkCont", function(value, element) {
                                            
                                              
                                               
                                              if($n("#notify_admin_new_testimonial").val()=='1'){
                                                var editorcontent=tinyMCE.get('email_body').getContent();
                                                
                                                if (editorcontent.length){
                                                  return true;
                                                }
                                                else{
                                                   return false;
                                                }
                                           }
                                           else{
                                               
                                               return false;
                                           }

                                          },
                                               "Please enter email content"
                                       );
                               
                                        $n( "#show_author_name" ).change(function() {

                                                if($n("#show_author_name").val()=="1"){

                                                     $n("#tr_is_author_name_field_required").show();

                                                 }
                                                 else{

                                                     $n("#tr_is_author_name_field_required").hide();

                                                 }

                                              });

                                               $n( "#show_author_des" ).change(function() {

                                                 if($n("#show_author_des").val()=="1"){

                                                     $n("#tr_is_author_designation_field_required").show();

                                                 }
                                                 else{

                                                     $n("#tr_is_author_designation_field_required").hide();

                                                 }

                                              });


                                               $n( "#show_author_email" ).change(function() {

                                                 if($n("#show_author_email").val()=="1"){

                                                     $n("#tr_is_author_email_field_required").show();

                                                 }
                                                 else{

                                                     $n("#tr_is_author_email_field_required").hide();

                                                 }

                                              });


                                               $n( "#show_photo_upload" ).change(function() {

                                                 if($n("#show_photo_upload").val()=="1"){

                                                     $n("#tr_photo_upload_field_required").show();

                                                 }
                                                 else{

                                                     $n("#tr_photo_upload_field_required").hide();

                                                 }

                                              });

                                               
                                            $n( "#show_author_name" ).trigger('change');
                                            $n( "#show_author_des" ).trigger('change');
                                            $n( "#show_author_email" ).trigger('change');
                                            $n( "#show_photo_upload" ).trigger('change');
                                            
                                            
                                            
                                            $n.validator.setDefaults({ 
                                                ignore: [],
                                                // any other default options and/or rules
                                            });
                                            
                                            $n("#scrollersettiings").validate({
                                                    rules: {
                                                        show_author_name: {
                                                            required:true
                                                            
                                                        }, 
                                                        is_author_name_field_required: {
                                                            required:true
                                                            
                                                        }, 
                                                        show_author_des: {
                                                            required:true
                                                            
                                                        }, 
                                                        is_author_designation_field_required: {
                                                            required:true
                                                            
                                                        }, 
                                                        show_author_email: {
                                                            required:true
                                                            
                                                        }, 
                                                        is_author_email_field_required: {
                                                            required:true
                                                            
                                                        }, 
                                                       
                                                        show_captcha: {
                                                            required:true
                                                            
                                                        }, 
                                                        show_photo_upload: {
                                                            required:true
                                                            
                                                        }, 
                                                        photo_upload_field_required: {
                                                            required:true
                                                            
                                                        }, 
                                                        testimonial_label: {
                                                            required:true,
                                                            maxlength:200
                                                        }, 
                                                        author_name_label: {
                                                            required:true,
                                                            maxlength:200
                                                        
                                                        }, 
                                                        author_designation_lable: {
                                                            required:true,
                                                            maxlength:200
                                                        
                                                        }, 
                                                        author_photo_label: {
                                                            required:true,
                                                            maxlength:200
                                                        
                                                        }, 
                                                        author_photo_link_label: {
                                                            required:true,
                                                            maxlength:200
                                                        
                                                        }, 
                                                        author_email_label: {
                                                            required:true,
                                                            maxlength:200
                                                        },
                                                        captcha_label: {
                                                            required:true,
                                                            maxlength:200
                                                        },
                                                        new_captcha_label: {
                                                            required:true,
                                                            maxlength:200
                                                        },
                                                        status_label: {
                                                            required:true,
                                                            maxlength:200
                                                        },
                                                        submit_label: {
                                                            required:true,
                                                            maxlength:200
                                                        },
                                                        required_field_error_msg: {
                                                            required:true,
                                                            maxlength:1000
                                                        },
                                                        invalid_email_field_error_msg: {
                                                            required:true,
                                                            maxlength:1000
                                                        },
                                                        invalid_photo_field_error_msg: {
                                                            required:true,
                                                            maxlength:1000
                                                        },
                                                        invalid_captcha: {
                                                            required:true,
                                                            maxlength:1000
                                                        },
                                                        success_msg: {
                                                            required:true,
                                                            maxlength:1000
                                                        },
                                                         error_msg: {
                                                            required:true,
                                                            maxlength:1000
                                                        },
                                                         auto_approve_testimonial: {
                                                            required:true,
                                                            maxlength:10
                                                        },
                                                         notify_admin_new_testimonial: {
                                                            required:true,
                                                            maxlength:10
                                                        },
                                                        email_subject: {
                                                             required: function(element) {
                                                                return $n("#notify_admin_new_testimonial").val()=='1';
                                                              },
                                                             maxlength:200
                                                        },
                                                         email_From_name: {
                                                             required: function(element) {
                                                                return $n("#notify_admin_new_testimonial").val()=='1';
                                                              },
                                                             maxlength:200
                                                        },
                                                         email_From: {
                                                             required: function(element) {
                                                                return $n("#notify_admin_new_testimonial").val()=='1';
                                                              },
                                                             maxlength:200,
                                                             email:true
                                                        },
                                                         email_to: {
                                                             required: function(element) {
                                                                return $n("#notify_admin_new_testimonial").val()=='1';
                                                              },
                                                             maxlength:200,
                                                             email:true
                                                        },
                                                         editor_val: {
                                                            
                                                            chkCont: true
                                                         }
                                                         
                                                     

                                                    },
                                                    errorClass: "image_error",
                                                    errorPlacement: function(error, element) {
                                                        $n(element).closest('td').find('.error_label').html(error);


                                                    } 


                                            });
                                            
                                            $n( "#notify_admin_new_testimonial" ).change(function() {

                                                 if($n("#notify_admin_new_testimonial").val()=="1"){

                                                  
                                               

                                                     $n("#tr_email_subject").show();
                                                     $n("#tr_email_From_name").show();
                                                     $n("#tr_email_From").show();
                                                     $n("#tr_email_to").show();
                                                     $n("#tr_email_body").show();
                                                     
                                                   
                                                        $n("#email_body-tmce").trigger('click');
                                                        
                                                        $n("#editor_val").rules('add', {
                                                            chkCont: true
                                                        });

                                                        $n("#email_subject").rules('add', {
                                                            required: function(element) {
                                                                return $n("#notify_admin_new_testimonial").val()=='1';
                                                                },
                                                                maxlength:200
                                                        });

                                                        $n("#email_From_name").rules('add', {
                                                            required: function(element) {
                                                                return $n("#notify_admin_new_testimonial").val()=='1';
                                                                },
                                                                maxlength:200
                                                        });

                                                        $n("#email_From").rules('add', {
                                                            required: function(element) {
                                                                return $n("#notify_admin_new_testimonial").val()=='1';
                                                                },
                                                                maxlength:200,
                                                                email:true
                                                        });


                                                        $n("#email_to").rules('add', {
                                                            required: function(element) {
                                                                return $n("#notify_admin_new_testimonial").val()=='1';
                                                                },
                                                                maxlength:200,
                                                                email:true
                                                        });
                                                   


                                                 }
                                                 else{

                                                        $n("#tr_email_subject").hide();
                                                        $n("#tr_email_From_name").hide();
                                                        $n("#tr_email_From").hide();
                                                        $n("#tr_email_to").hide();
                                                        $n("#tr_email_body").hide();
                                                     
                                                          $n('#email_subject').rules('remove', 'required'); 
                                                          $n("#editor_val").rules('remove', 'chkCont');
                                                          $n("#email_subject").rules('remove', 'required');
                                                          $n("#email_From_name").rules('remove', 'required');
                                                          $n("#email_From").rules('remove', 'required');
                                                          $n("#email_From").rules('remove', 'email');
                                                          $n("#email_to").rules('remove', 'required');
                                                          $n("#email_to").rules('remove', 'email');


                                                 }

                                              });
                                              
                                           $n( "#notify_admin_new_testimonial" ).trigger('change');   
                                              
                                    });

                                </script> 
                                </div>   
                            <div id="postbox-container-1" class="postbox-container" > 

                            <div class="postbox"> 
                                <h3 class="hndle"><span></span>Access All Themes In One Price</h3> 
                                <div class="inside">
                                    <center><a href="http://www.elegantthemes.com/affiliates/idevaffiliate.php?id=11715_0_1_10" target="_blank"><img border="0" src="<?php echo plugins_url( 'images/300x250.gif', __FILE__ );?>" width="250" height="250"></a></center>

                                    <div style="margin:10px 5px">

                                    </div>
                                </div></div>
                            <div class="postbox"> 
                                <h3 class="hndle"><span></span>Best WordPress Themes</h3> 

                                <div class="inside">
                                     <center><a href="https://mythemeshop.com/?ref=nik_gandhi007" target="_blank"><img src="<?php echo plugins_url( 'images/300x250.png', __FILE__ );?>" width="250" height="250" border="0"></a></center>
                                    <div style="margin:10px 5px">
                                    </div>
                                </div></div>

                        </div>    
                          </div>
                                  
                        </div>
                    
                    </div>  
                    
                </div>      
            </div>
    <div class="clear"></div></div>
    <?php
   } 
   function etr_best_testimonial_slider_admin_options(){
 
   $action='addedit';
      if(isset($_GET['action']) and $_GET['action']!=''){
        
         $action=trim($_GET['action']);       
      }                    
     if(strtolower($action)==strtolower('addedit')){
     
       $url = plugin_dir_url(__FILE__);
       
       if(isset($_POST['btnsave'])){
          
                  

            if ( !check_admin_referer( 'action_image_add_edit','add_edit_image_nonce')){

               wp_die('Security check fail'); 
            }
            
        
            $auto=trim(htmlentities(strip_tags($_POST['auto']),ENT_QUOTES));
            $is_circular_slider=trim(htmlentities(strip_tags($_POST['is_circular_slider']),ENT_QUOTES));
            $speed=trim(htmlentities(strip_tags($_POST['speed']),ENT_QUOTES));
            $pause=trim(htmlentities(strip_tags($_POST['pause']),ENT_QUOTES));
            $box_border_color=trim(htmlentities(strip_tags($_POST['box_border_color']),ENT_QUOTES));
            $box_border_size=trim(htmlentities(strip_tags($_POST['box_border_size']),ENT_QUOTES));
            $box_shadow_color=trim(htmlentities(strip_tags($_POST['box_shadow_color']),ENT_QUOTES));
            $slider_back_color=trim(htmlentities(strip_tags($_POST['slider_back_color']),ENT_QUOTES));
            $is_adaptive_height=trim(htmlentities(strip_tags($_POST['is_adaptive_height']),ENT_QUOTES));
            $show_arrows=trim(htmlentities(strip_tags($_POST['show_arrows']),ENT_QUOTES));
            $show_author_name=trim(htmlentities(strip_tags($_POST['show_author_name']),ENT_QUOTES));
            $show_author_des=trim(htmlentities(strip_tags($_POST['show_author_des']),ENT_QUOTES));
            $show_pagination=trim(htmlentities(strip_tags($_POST['show_pagination']),ENT_QUOTES));
            $touch_enabled=trim(htmlentities(strip_tags($_POST['touch_enabled']),ENT_QUOTES));
            $resize_images=trim(htmlentities(strip_tags($_POST['resize_images']),ENT_QUOTES));

          
            $options=array();
            $options['auto']=$auto;  
            $options['is_circular_slider']=$is_circular_slider;  
            $options['speed']=$speed;  
            $options['pause']=$pause;  
            $options['box_border_color']=$box_border_color;  
            $options['box_border_size']=$box_border_size;  
            $options['box_shadow_color']=$box_shadow_color;  
            $options['slider_back_color']=$slider_back_color;  
            $options['is_adaptive_height']=$is_adaptive_height;  
            $options['show_arrows']=$show_arrows;  
            $options['show_author_name']=$show_author_name;  
            $options['show_author_des']=$show_author_des;  
            $options['show_pagination']=$show_pagination;  
            $options['touch_enabled']=$touch_enabled;  
            $options['resize_images']=$resize_images;  
         
            $settings=update_option('best_testimonial_options',$options); 
            
            $best_testimonial_slider_messages=array();
            $best_testimonial_slider_messages['type']='succ';
            $best_testimonial_slider_messages['message']='Slider settings updated successfully.';
            update_option('best_testimonial_slider_messages', $best_testimonial_slider_messages);
            
            $location='admin.php?page=best_testimonial_slider';
            echo "<script type='text/javascript'> location.href='$location';</script>";
            exit;
         
     }  
     
     
         $settings=get_option('best_testimonial_options'); 
         if(!is_array($settings)){
     
                
                $settings=array();
                $settings['auto']=null;
                $settings['is_circular_slider']=1;
                $settings['speed']=1000;
                $settings['pause']=10000;
                $settings['box_border_color']="#FFFFFF";
                $settings['box_border_size']=5;
                $settings['box_shadow_color']="#FFFFFF";
                $settings['slider_back_color']="#FFFFFF";
                $settings['is_adaptive_height']=1;
                $settings['show_arrows']=1;
                $settings['show_author_name']=1;
                $settings['show_author_des']=1;
                $settings['show_pagination']=1;
                $settings['touch_enabled']=1;
                $settings['resize_images']=1;
          
          }
       
    
    // var_dump((int)$settings['auto']);die;  
      
?>
<div style="width: 100%;">  
            <div style="float:left;width:100%;">
                <div class="wrap">
                    <table><tr><td><a href="https://twitter.com/FreeAdsPost" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false">Follow @FreeAdsPost</a>
                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></td>
                                    <td>
                                        <a target="_blank" title="Donate" href="http://www.i13websolution.com/donate-wordpress_image_thumbnail.php">
                                            <img id="help us for free plugin" height="30" width="90" src="<?php echo plugins_url( 'images/paypaldonate.jpg', __FILE__ ) ;?>" border="0" alt="help us for free plugin" title="help us for free plugin">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                             <span><h3 style="color: blue;"><a target="_blank" href="https://www.i13websolution.com/wordpress-best-testimonials-slider-plugin.html">UPGRADE TO PRO VERSION</a></h3></span> 
                   <?php
                   
                    $messages=get_option('best_testimonial_slider_messages'); 
                    $type='';
                    $message='';
                    if(isset($messages['type']) and $messages['type']!=""){

                       $type=$messages['type'];
                       $message=$messages['message'];
                       
                       update_option('best_testimonial_slider_messages', array());     

                    }  
                    if($type=='err'){ echo "<div class='errMsg'>"; echo $message; echo "</div>";}
                    else if($type=='succ'){ echo "<div class='succMsg'>"; echo $message; echo "</div>";}
                    ?>
                   <h2><?php echo __('Slider Settings','easy-testimonial-rotator');?></h2>
                    <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-2">
                            <div id="post-body-content" >
                                <form method="post" action="" id="scrollersettiings" name="scrollersettiings" >
                                    <div class="stuffbox" id="namediv" style="width:100%;">
                                        <h3><label for="link_name">Settings</label></h3>
                                        <table cellspacing="0" class="form-list" cellpadding="10">
                                            <tbody>
                                               
                                                 <tr>
                                                    <td class="label">
                                                        <label for="auto"><?php echo __('Auto Slide ?','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <select id="auto" name="auto" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['auto']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['auto']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select>            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                
                                                 <tr>
                                                    <td class="label">
                                                        <label for="is_circular_slider"><?php echo __('Is Circular Slider ?','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <select id="is_circular_slider" name="is_circular_slider" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['is_circular_slider']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['is_circular_slider']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select>            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr> 
                                                 
                                                 <tr>
                                                    <td class="label">
                                                        <label for="speed"><?php echo __('Speed','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <input id="speed" value="<?php echo $settings['speed']; ?>" name="speed"  class="input-text" type="text"  style="width:80px" />            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td class="label">
                                                        <label for="pause"><?php echo __('Pause','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <input id="pause" value="<?php echo $settings['pause']; ?>" name="pause"  class="input-text" type="text"  style="width:80px" />            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label">
                                                        <label for="box_border_color"><?php echo __('Box Border Color','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <input id="box_border_color" value="<?php echo $settings['box_border_color']; ?>" name="box_border_color"  class="input-text" type="text"  style="width:100px" />            
                                                        <div style="clear:both"></div>
                                                        <div class='error_label'></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label">
                                                        <label for="box_border_size"><?php echo __('Box Border Size','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <input id="box_border_size" value="<?php echo $settings['box_border_size']; ?>" name="box_border_size"  class="input-text" type="text"  style="width:100px" />            
                                                        <div style="clear:both"></div>
                                                        <div class='error_label'></div>
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td class="label">
                                                        <label for="box_shadow_color"><?php echo __('Box Shadow Color','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <input id="box_shadow_color" value="<?php echo $settings['box_shadow_color']; ?>" name="box_shadow_color"  class="input-text" type="text"  style="width:100px" />            
                                                        <div style="clear:both"></div>
                                                        <div class='error_label'></div>
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td class="label">
                                                        <label for="slider_back_color"><?php echo __('Slider Backgroud Color','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <input id="slider_back_color" value="<?php echo $settings['slider_back_color']; ?>" name="slider_back_color"  class="input-text" type="text"  style="width:100px" />            
                                                        <div style="clear:both"></div>
                                                        <div class='error_label'></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label">
                                                        <label for="is_adaptive_height"><?php echo __('Is Adaptive Height','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <select id="is_adaptive_height" name="is_adaptive_height" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['is_adaptive_height']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['is_adaptive_height']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select>            
                                                        <div style="clear:both"></div>
                                                       <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label">
                                                        <label for="show_author_name"><?php echo __('Show Author Name ?','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <select id="show_author_name" name="show_author_name" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_author_name']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_author_name']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select>            
                                                        <div style="clear:both"></div>
                                                       <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                 <tr id="show_author_des">
                                                    <td class="label">
                                                        <label for="show_author_des"><?php echo __('Show Author Designation ?','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <select id="show_author_des" name="show_author_des" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_author_des']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_author_des']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select>            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label">
                                                        <label for="show_arrows"><?php echo __('Show Arrows','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <select id="show_arrows" name="show_arrows" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_arrows']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_arrows']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select>            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td class="label">
                                                        <label for="show_pagination"><?php echo __('Show Pagination ?','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <select id="show_pagination" name="show_pagination" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_pagination']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['show_pagination']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select>            
                                                        <div style="clear:both"></div>
                                                        <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                 
                                                <tr>
                                                    <td class="label">
                                                        <label for="touch_enabled"><?php echo __('Touch Enabled ?','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <select id="touch_enabled" name="touch_enabled" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['touch_enabled']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['touch_enabled']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select>            
                                                        <div style="clear:both"></div>
                                                       <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                               <tr>
                                                    <td class="label">
                                                        <label for="resize_images"><?php echo __('Resize Images ?','easy-testimonial-rotator');?><span class="required">*</span></label>
                                                    </td>
                                                    <td class="value">
                                                        <select id="resize_images" name="resize_images" class="select">
                                                            <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['resize_images']=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Yes','easy-testimonial-rotator');?></option>
                                                            <option <?php if($settings['resize_images']=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('No','easy-testimonial-rotator');?></option>
                                                        </select>            
                                                        <div style="clear:both"></div>
                                                       <div class="error_label"></div> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label">
                                                        
                                                        <?php wp_nonce_field('action_image_add_edit','add_edit_image_nonce'); ?>
                                                        <input type="submit"  name="btnsave" id="btnsave" value="<?php echo __('Save Changes','easy-testimonial-rotator');?>" class="button-primary" />    

                                                    </td>
                                                    <td class="value">
                                                        <?php if(isset($_GET['id']) and $_GET['id']>0){ ?> 
                                                            <input type="hidden" name="sliderid" id="sliderid" value="<?php echo $_GET['id'];?>" />
                                                            <?php
                                                            } 
                                                        ?>  
                                                        <input type="button" name="cancle" id="cancle" value="<?php echo __('Cancel','easy-testimonial-rotator');?>" class="button-primary" onclick="location.href='admin.php?page=best_testimonial_slider'" />

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>                                    
                                    </div>

                                </form>
                                <script type="text/javascript">

                                    var $n = jQuery.noConflict();
                                    $n(document).ready(function() {
                                            
                                            $n('#box_border_color').wpColorPicker();
                                            $n('#box_shadow_color').wpColorPicker();
                                            $n('#slider_back_color').wpColorPicker();
                                            
                                             $n('#box_border_size').spinner({
                                                min: 0,
                                                max: 40,
                                                step: 1
                                            });
                                            
                                         
                                            $n.validator.setDefaults({ 
                                                ignore: [],
                                                // any other default options and/or rules
                                            });
                                            $n("#scrollersettiings").validate({
                                                    rules: {
                                                        auto: {
                                                            required:true,
                                                            number:true,
                                                            maxlength:1
                                                        },
                                                        is_circular_slider: {
                                                            required:true,
                                                            number:true,
                                                            maxlength:1
                                                        }
                                                        ,speed: {
                                                            required:true,
                                                            digits:true,
                                                            maxlength:11
                                                        }
                                                        ,pause: {
                                                            required:true,
                                                            digits:true,
                                                            maxlength:11
                                                        },
                                                         box_border_color: {
                                                            required:true, 
                                                             maxlength:10
                                                        }
                                                        ,box_shadow_color: {
                                                            required:true, 
                                                             maxlength:10
                                                        },
                                                        box_border_size:{
                                                            required:true,
                                                            number:true,
                                                            maxlength:2
                                                        },
                                                        slider_back_color: {
                                                            required:true, 
                                                             maxlength:10
                                                        },
                                                        is_adaptive_height:{
                                                            required:true,  
                                                            digits:true,
                                                            maxlength:1

                                                        },
                                                        show_arrows:{
                                                            required:true,  
                                                            digits:true,
                                                            maxlength:1

                                                        }
                                                        ,touch_enabled:{
                                                            required:true,
                                                            digits:true,
                                                            maxlength:1  
                                                        },
                                                        resize_images:{
                                                            required:true,
                                                            digits:true,
                                                            maxlength:1  
                                                        }
                                                        
                                                     

                                                    },
                                                    errorClass: "image_error",
                                                    errorPlacement: function(error, element) {
                                                        $n(element).closest('td').find('.error_label').html(error);


                                                    } 


                                            })
                                    });

                                </script> 

                            </div>
                            <div id="postbox-container-1" class="postbox-container" > 

                            <div class="postbox"> 
                                <h3 class="hndle"><span></span>Access All Themes In One Price</h3> 
                                <div class="inside">
                                    <center><a href="http://www.elegantthemes.com/affiliates/idevaffiliate.php?id=11715_0_1_10" target="_blank"><img border="0" src="<?php echo plugins_url( 'images/300x250.gif', __FILE__ );?>" width="250" height="250"></a></center>

                                    <div style="margin:10px 5px">

                                    </div>
                                </div></div>
                            <div class="postbox"> 
                                <h3 class="hndle"><span></span>Best WordPress Themes</h3> 

                                <div class="inside">
                                     <center><a href="https://mythemeshop.com/?ref=nik_gandhi007" target="_blank"><img src="<?php echo plugins_url( 'images/300x250.png', __FILE__ );?>" width="250" height="250" border="0"></a></center>
                                    <div style="margin:10px 5px">
                                    </div>
                                </div></div>

                        </div> 
                        </div>
                    </div>  
                </div>      
            </div>
    <div class="clear"></div></div>
<?php
      }
    
   } 
   
   function etr_best_testimonial_management(){
    
      $action='gridview';
      global $wpdb;
      
      if(isset($_GET['action']) and $_GET['action']!=''){
         
   
         $action=trim($_GET['action']);
       }
       
      if(strtolower($action)==strtolower('gridview')){ 
      
          
          $wpcurrentdir=dirname(__FILE__);
          $wpcurrentdir=str_replace("\\","/",$wpcurrentdir);
          
      
   ?> 
    <div class="wrap">
           <table><tr><td><a href="https://twitter.com/FreeAdsPost" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false">Follow @FreeAdsPost</a>
                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></td>
                                    <td>
                                        <a target="_blank" title="Donate" href="http://www.i13websolution.com/donate-wordpress_image_thumbnail.php">
                                            <img id="help us for free plugin" height="30" width="90" src="<?php echo plugins_url( 'images/paypaldonate.jpg', __FILE__ ) ;?>" border="0" alt="help us for free plugin" title="help us for free plugin">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                             <span><h3 style="color: blue;"><a target="_blank" href="https://www.i13websolution.com/wordpress-best-testimonials-slider-plugin.html">UPGRADE TO PRO VERSION</a></h3></span>  
          <!--[if !IE]><!-->
          <style type="text/css">
              @media only screen and (max-width: 800px) {

                  /* Force table to not be like tables anymore */
                  #no-more-tables table, 
                  #no-more-tables thead, 
                  #no-more-tables tbody, 
                  #no-more-tables th, 
                  #no-more-tables td, 
                  #no-more-tables tr { 
                      display: block; 

                  }

                  /* Hide table headers (but not display: none;, for accessibility) */
                  #no-more-tables thead tr { 
                      position: absolute;
                      top: -9999px;
                      left: -9999px;
                  }

                  #no-more-tables tr { border: 1px solid #ccc; }

                  #no-more-tables td { 
                      /* Behave  like a "row" */
                      border: none;
                      border-bottom: 1px solid #eee; 
                      position: relative;
                      padding-left: 50%; 
                      white-space: normal;
                      text-align:left;      
                  }

                  #no-more-tables td:before { 
                      /* Now like a table header */
                      position: absolute;
                      /* Top/left values mimic padding */
                      top: 6px;
                      left: 6px;
                      width: 45%; 
                      padding-right: 10px; 
                      white-space: nowrap;
                      text-align:left;
                      font-weight: bold;
                  }

                  /*
                  Label the data
                  */
                  #no-more-tables td:before { content: attr(data-title); }
              }
          </style>
          <!--<![endif]-->
          <style type="text/css">
          .pagination {
            clear:both;
            padding:20px 0;
            position:relative;
            font-size:11px;
            line-height:13px;
            }
             
            .pagination span, .pagination a {
            display:block;
            float:left;
            margin: 2px 2px 2px 0;
            padding:6px 9px 5px 9px;
            text-decoration:none;
            width:auto;
            color:#fff;
            background: #555;
            }
             
            .pagination a:hover{
            color:#fff;
            background: #3279BB;
            }
             
            .pagination .current{
            padding:6px 9px 5px 9px;
            background: #3279BB;
            color:#fff;
            }
        </style>
        <?php 
             
             $messages=get_option('best_testimonial_slider_messages'); 
             $type='';
             $message='';
             if(isset($messages['type']) and $messages['type']!=""){
             
                $type=$messages['type'];
                $message=$messages['message'];
                
             }  
             
  
             if($type=='err'){ echo "<div class='errMsg'>"; echo $message; echo "</div>";}
             else if($type=='succ'){ echo "<div class='succMsg'>"; echo $message; echo "</div>";}
             
             
             update_option('best_testimonial_slider_messages', array());  
             
             $uploads = wp_upload_dir ();
             $baseDir = $uploads ['basedir'];
             $baseDir = str_replace ( "\\", "/", $baseDir );

             $baseurl=$uploads['baseurl'];
             $baseurl.='/easy-testimonial-rotator/';
             $pathToImagesFolder = $baseDir . '/easy-testimonial-rotator';
        ?>
       <div style="width: 100%;">  
        <div style="float:left;width:100%;" >
        <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
        <h2><?php echo __('Testimonials','easy-testimonial-rotator');?> <a class="button add-new-h2" href="admin.php?page=best_testimonial_slider_testimonial_management&action=addedit"><?php echo __('Add New','easy-testimonial-rotator');?></a> </h2>
        <br/>    
        <form method="POST" action="admin.php?page=best_testimonial_slider_testimonial_management&action=deleteselected"  id="posts-filter">
              <div class="alignleft actions">
                <select name="action_upper" id="action_upper">
                    <option selected="selected" value="-1"><?php echo __('Bulk Actions','easy-testimonial-rotator');?></option>
                    <option value="delete">delete</option>
                </select>
                <input type="submit" value="<?php echo __('Apply','easy-testimonial-rotator');?>" class="button-secondary action" id="deleteselected" name="deleteselected" onclick="return confirmDelete_bulk(document.getElementById('action_upper'));" />
            </div>
         <br class="clear">
        <?php 
        
          
          global $wpdb;
          $settings=get_option('best_testimonial_options'); 
          if(!is_array($settings)){
              
             
             $best_testimonial_slider_messages=array();
             $best_testimonial_slider_messages['type']='err';
             $best_testimonial_slider_messages['message']= __('No such slider found','easy-testimonial-rotator');
             update_option('best_testimonial_slider_messages', $best_testimonial_slider_messages);
             $location='admin.php?page=best_testimonial_slider';
             echo "<script type='text/javascript'> location.href='$location';</script>";
             exit;
     
          }
          
          
          $query="SELECT * FROM ".$wpdb->prefix."b_testimo_slide order by createdon desc";
          $rows=$wpdb->get_results($query,'ARRAY_A');
          $rowCount=sizeof($rows);
          
        ?>
       <br/>
        <div id="no-more-tables">
            <table cellspacing="0" id="gridTbl" class="table-bordered table-striped table-condensed cf" style="">
            <thead>
            
               <tr>
                 <th style="" class="manage-column column-cb check-column" scope="col"><input type="checkbox" /></th>
                 <th style=""  scope="col"><?php echo __('Id','easy-testimonial-rotator');?></th>
                 <th style=""  scope="col"><?php echo __('Author Name','easy-testimonial-rotator');?></th>
                 <th style=""  scope="col"><span><?php echo __('Testimonial','easy-testimonial-rotator');?></span></th>
                 <th style=""  scope="col"><span></span></th>
                 <th style=""   scope="col"><span><?php echo __('Submitted On','easy-testimonial-rotator');?></span></th>
                 <th style=""   scope="col"><span><?php echo __('Status','easy-testimonial-rotator');?></span></th>
                 <th style=""  scope="col"><span><?php echo __('Edit','easy-testimonial-rotator');?></span></th>
                 <th style=""  scope="col"><span><?php echo __('Delete','easy-testimonial-rotator');?></span></th>
              </tr>   
              
              </thead>
            <tbody id="the-list">
                <?php

                    if(count($rows) > 0){

                        global $wp_rewrite;
                        $rows_per_page = 20;

                        $current = (isset($_GET['paged'])) ? ((int)$_GET['paged']) : 1;
                        $pagination_args = array(
                            'base' => @add_query_arg('paged','%#%'),
                            'format' => '',
                            'total' => ceil(sizeof($rows)/$rows_per_page),
                            'current' => $current,
                            'show_all' => false,
                            'type' => 'plain',
                        );


                        $start = ($current - 1) * $rows_per_page;
                        $end = $start + $rows_per_page;
                        $end = (sizeof($rows) < $end) ? sizeof($rows) : $end;

                        $paged=1;
                        if(isset($_GET['paged']) and (int) $_GET['paged'] >0){

                            $paged=(int) $_GET['paged'];

                        }
                        $delRecNonce=wp_create_nonce('delete_image');
                        for ($i=$start;$i < $end ;++$i ) {

                            $row = $rows[$i];
                           
                            $id=$row['id'];
                            $editlink="admin.php?page=best_testimonial_slider_testimonial_management&action=addedit&id=$id&paged=$paged";
                            $deletelink="admin.php?page=best_testimonial_slider_testimonial_management&action=delete&id=$id&nonce=$delRecNonce";
                           
                            if($row['image_name']!='' or $row['image_name']!=null){

                                //$outputimg = $baseurl.$row['image_name'];

                                 $imagename=$row['image_name'];
                                 $imageUploadTo=$pathToImagesFolder.'/'.$imagename;
                                 $imageUploadTo=str_replace("\\","/",$imageUploadTo);
                                 $pathinfo=pathinfo($imageUploadTo);
                                 $filenamewithoutextension=$pathinfo['filename'];
                                 $imageheight=300;
                                 $imagewidth=300;
                                 $outputimg="";

                                 
                                 $outputimgmain = $baseurl.$row['image_name']; 
                                 if($settings['resize_images']==0){

                                     $outputimgmain = $baseurl.$row['image_name']; 

                                 }
                                 else{

                                       $imagetoCheck=$pathToImagesFolder.'/'.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                       $imagetoCheckSmall=$pathToImagesFolder.'/'.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.strtolower($pathinfo['extension']);

                                       
                                     if(file_exists($imagetoCheck)){
                                         $outputimgmain = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];

                                     }
                                     else if(file_exists($imagetoCheckSmall)){
                                         $outputimgmain = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.strtolower($pathinfo['extension']);
                                     }
                                     else{

                                         
                                         if(function_exists('wp_get_image_editor')){


                                             $image = wp_get_image_editor($pathToImagesFolder."/".$row['image_name']); 
                                             if ( ! is_wp_error( $image ) ) {
                                                 $image->resize( $imagewidth, $imageheight, true );
                                                 $image->save( $imagetoCheck );
                                                 //$outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];

                                                 if(file_exists($imagetoCheck)){
                                                     $outputimgmain = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                 }
                                                 else if(file_exists($imagetoCheckSmall)){
                                                     $outputimgmain = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.strtolower($pathinfo['extension']);
                                                 }
                                             }
                                             else{
                                                 $outputimgmain = $baseurl.$row['image_name'];
                                             }     

                                         }
                                         else if(function_exists('image_resize')){

                                             $return=image_resize($pathToImagesFolder."/".$row['image_name'],$imagewidth,$imageheight) ;
                                             if ( ! is_wp_error( $return ) ) {

                                                 $isrenamed=rename($return,$imagetoCheck);
                                                 if($isrenamed){
                                                     //$outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];  

                                                       if(file_exists($imagetoCheck)){
                                                             $outputimgmain = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                         }
                                                         else if(file_exists($imagetoCheckSmall)){
                                                             $outputimgmain = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.strtolower($pathinfo['extension']);
                                                         }


                                                 }
                                                 else{
                                                     $outputimgmain = $baseurl.$row['image_name']; 
                                                 } 
                                             }
                                             else{
                                                 $outputimgmain = $baseurl.$row['image_name'];
                                             }  
                                         }
                                         else{

                                             $outputimgmain = $baseurl.$row['image_name'];
                                         }  

                                         //$url = plugin_dir_url(__FILE__)."imagestoscroll/".$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];

                                     } 
                                 }

                            }
                            else if($row['gravatar_email']!='' and $row['gravatar_email']!=null){
                
                                $email=md5($row['gravatar_email']);
                                $outputimgmain="https://www.gravatar.com/avatar/$email?s=200";     
                             }
                            else{
                                
                                $outputimgmain=plugins_url( 'images/no_photo.png', __FILE__ ) ;
                            }
                            
                            if($row['status']==1)
                                $status_val=__('Published','easy-testimonial-rotator');
                            else
                               $status_val=__('Draft','easy-testimonial-rotator');  
                        ?>
                         <tr valign="top" class="alternate author-self status-publish format-default iedit" id="post-113">
                            <td  data-title="<?php echo __('Select Record','easy-testimonial-rotator');?>" class="alignCenter check-column" ><input type="checkbox" value="<?php echo $row['id'] ?>" name="thumbnails[]" /></td>
                            <td  data-title="<?php echo __('Id','easy-testimonial-rotator');?>" class="alignCenter" ><?php echo $row['id']; ?></td>
                            <td  data-title="<?php echo __('Author Name','easy-testimonial-rotator');?>" class="alignCenter" ><?php echo $row['auth_name']; ?></td>
                            <td  data-title="<?php echo __('Testimonial','easy-testimonial-rotator');?>" class="alignCenter"><strong><?php echo $row['testimonial']; ?></strong></td>  
                            <td  data-title="<?php echo __('Image','easy-testimonial-rotator');?>" class="alignCenter">
                              <img src="<?php echo $outputimgmain;?>" style="width:50px" height="50px"/>
                            </td> 
                            <td   data-title="<?php echo __('Submitted On','easy-testimonial-rotator');?>" class="alignCenter"><?php echo $row['createdon'] ?></td>
                            <td   data-title="<?php echo __('Status','easy-testimonial-rotator');?>" class="alignCenter"><strong><?php echo $status_val;?></strong></td>  
                            <td   data-title="<?php echo __('Edit','easy-testimonial-rotator');?>" class="alignCenter"><strong><a href='<?php echo $editlink; ?>' title="edit">Edit</a></strong></td>  
                            <td   data-title="<?php echo __('Delete','easy-testimonial-rotator');?>" class="alignCenter"><strong><a href='<?php echo $deletelink; ?>' onclick="return confirmDelete();"  title="delete">Delete</a> </strong></td>  
                       </tr>
                        <?php 
                        } 
                    }
                    else{
                    ?>

                  <tr valign="top"  id="">
                            <td colspan="10" data-title="No Record" align="center"><strong><?php echo __('No Testimonials Found','easy-testimonial-rotator');?></strong></td>  
                   </tr>
                    <?php 
                    } 
                ?>      
            </tbody>
        </table>
        </div>
  <?php
    if(sizeof($rows)>0){
     echo "<div class='pagination' style='padding-top:10px'>";
     echo paginate_links($pagination_args);
     echo "</div>";
    }
  ?>
    <br/>
    <div class="alignleft actions">
        <select name="action" id="action_bottom">
            <option selected="selected" value="-1"><?php echo __('Bulk Actions','easy-testimonial-rotator');?></option>
            <option value="delete"><?php echo __('delete','easy-testimonial-rotator');?></option>
        </select>
        
        <?php wp_nonce_field('action_settings_mass_delete','mass_delete_nonce'); ?>
        <input type="submit" value="<?php echo __('Apply','easy-testimonial-rotator');?>" class="button-secondary action" id="deleteselected" name="deleteselected"  onclick="return confirmDelete_bulk(document.getElementById('action_bottom'));"/>
    </div>

    </form>
        <script type="text/JavaScript">

            function  confirmDelete(){
            var agree=confirm("<?php echo __('Are you sure you want to delete this testimonial ?','easy-testimonial-rotator');?>");
            if (agree)
                 return true ;
            else
                 return false;
        }
        
        function  confirmDelete_bulk(elemnt){
            var topval=document.getElementById("action_bottom").value;
            var bottomVal=document.getElementById("action_upper").value;
             var $n = jQuery.noConflict();  
             if(elemnt.value.toString()=='-1'){

                 return;
             }
                if($n('[name="thumbnails[]"]:checked').length > 0){

                    if(topval=='delete' || bottomVal=='delete'){


                        var agree=confirm("<?php echo __('Are you sure you want to delete selected testimonials.','easy-testimonial-rotator');?>");
                        if (agree)
                            return true ;
                        else
                            return false;
                    }
                   }else{

                       alert('<?php echo __('Please select atleast one record to delete.','easy-testimonial-rotator');?>');
                       return false;
                   }
        }
     </script>

        <br class="clear">
        </div>
        <div style="clear: both;"></div>
        <?php $url = plugin_dir_url(__FILE__);  ?>
      </div>  
    </div>  

    <h3><?php echo __('To print this slider into WordPress Post/Page use below code','easy-testimonial-rotator');?></h3>
    <input type="text" value='[print_best_testimonial_slider] ' style="width: 400px;height: 30px" onclick="this.focus();this.select()" />
    <div class="clear"></div>
    <h3><?php echo __('To print this slider into WordPress theme/template PHP files use below code','easy-testimonial-rotator');?></h3>
    <?php
        $shortcode='[print_best_testimonial_slider]';
    ?>
    <input type="text" value="&lt;?php echo do_shortcode('<?php echo htmlentities($shortcode, ENT_QUOTES); ?>'); ?&gt;" style="width: 400px;height: 30px" onclick="this.focus();this.select()" />
       
    <div class="clear"></div>
    
    <h3><?php echo __('To print form for this slider into WordPress Post/Page use below code','easy-testimonial-rotator');?></h3>
    <input type="text" value='[print_best_testimonial_form ] ' style="width: 400px;height: 30px" onclick="this.focus();this.select()" />
    <div class="clear"></div>
    <h3><?php echo __('To print form for this slider into WordPress theme/template PHP files use below code','easy-testimonial-rotator');?></h3>
    <?php
        $shortcode='[print_best_testimonial_form]';
    ?>
    <input type="text" value="&lt;?php echo do_shortcode('<?php echo htmlentities($shortcode, ENT_QUOTES); ?>'); ?&gt;" style="width: 400px;height: 30px" onclick="this.focus();this.select()" />
    <div class="clear"></div>
<?php 
  }   
  else if(strtolower($action)==strtolower('addedit')){
      $url = plugin_dir_url(__FILE__);
      $paged=1;
      if(isset($_POST['paged'])){
         $paged=(int)(trim(htmlentities(strip_tags($_GET['paged']),ENT_QUOTES)));
      }
    ?>
    <?php        
    if(isset($_POST['btnsave'])){
       
      
       if ( !check_admin_referer( 'action_image_add_edit','add_edit_image_nonce')){

            wp_die('Security check fail'); 
        }
        
       $uploads = wp_upload_dir();
       $baseDir = $uploads ['basedir'];
       $baseDir = str_replace ( "\\", "/", $baseDir );
       $pathToImagesFolder = $baseDir . '/easy-testimonial-rotator'; 
       //edit save
       
        $testimonial='';
        if(isset($_POST['testimonial']) and $_POST['testimonial']!=''){
            $testimonial=trim(htmlentities(strip_tags($_POST['testimonial']),ENT_QUOTES));
        }
        $auth_name='';
         if(isset($_POST['auth_name']) and $_POST['auth_name']!=''){

            $auth_name=trim(htmlentities(strip_tags($_POST['auth_name']),ENT_QUOTES));
        }
        $auth_desn='';
         if(isset($_POST['auth_desn']) and $_POST['auth_desn']!=''){

            $auth_desn=trim(htmlentities(strip_tags($_POST['auth_desn']),ENT_QUOTES));
        }

        $auth_email='';
         if(isset($_POST['auth_email']) and $_POST['auth_email']!=''){

            $auth_email=trim(htmlentities(strip_tags($_POST['auth_email']),ENT_QUOTES));
        }

       $gravatar_email='';
         if(isset($_POST['HdnMediaGrevEmail']) and $_POST['HdnMediaGrevEmail']!=''){

           $gravatar_email=trim(htmlentities(strip_tags($_POST['HdnMediaGrevEmail']),ENT_QUOTES));

        }

       $status=0;
        if(isset($_POST['status']) and $_POST['status']!=''){

           $status=(int)trim(htmlentities(strip_tags($_POST['status']),ENT_QUOTES));

        }

       if(isset($_POST['imageid'])){
       
              
            //add new
                $imageid=(int) trim(htmlentities(strip_tags($_POST['imageid']),ENT_QUOTES));
                $location="admin.php?page=best_testimonial_slider_testimonial_management&paged=$paged";
                 
                $imagename="";
                if(isset($_POST['HdnMediaSelection']) and trim($_POST['HdnMediaSelection'])!=''){
                        
                         $postThumbnailID=(int) trim(htmlentities(strip_tags($_POST['HdnMediaSelection']),ENT_QUOTES));
                         $photoMeta = wp_get_attachment_metadata( $postThumbnailID );
                         if(is_array($photoMeta) and isset($photoMeta['file'])) {
                             
                                 $fileName=$photoMeta['file'];
                                 $phyPath=ABSPATH;
                                 $phyPath=str_replace("\\","/",$phyPath);
                               
                                 $pathArray=pathinfo($fileName);
                               
                                 $imagename=$pathArray['basename'];
                               
                                 $upload_dir_n = wp_upload_dir(); 
                                 $upload_dir_n=$upload_dir_n['basedir'];
                                 $fileUrl=$upload_dir_n.'/'.$fileName;
                                 $fileUrl=str_replace("\\","/",$fileUrl);
                               
                                 $wpcurrentdir=dirname(__FILE__);
                                 $wpcurrentdir=str_replace("\\","/",$wpcurrentdir);
                                 $imageUploadTo=$pathToImagesFolder.'/'.$imagename;
                                       
                                @copy($fileUrl, $imageUploadTo);
                                           
                         }
                        
                    }
                     
                        try{
                              if($imagename!=""){
                                  
                                         $query = "update ".$wpdb->prefix."b_testimo_slide set testimonial='$testimonial',image_name='$imagename',gravatar_email='',
                                              auth_name='$auth_name',auth_desn='$auth_desn',auth_email='$auth_email',status=$status where id=$imageid";
                               
                                }
                                else if($gravatar_email!=null and $gravatar_email!=''){
                                    
                                    
                                  $query = "update ".$wpdb->prefix."b_testimo_slide set testimonial='$testimonial',
                                              auth_name='$auth_name',auth_desn='$auth_desn',auth_email='$auth_email',image_name='',gravatar_email='$gravatar_email',status=$status where id=$imageid";
                                 
                                    
                                }
                                else{
                                    
                                    $query = "update ".$wpdb->prefix."b_testimo_slide set testimonial='$testimonial',
                                              auth_name='$auth_name',auth_desn='$auth_desn',auth_email='$auth_email',status=$status where id=$imageid";
                                    
                                }
                                $wpdb->query($query); 
                               
                                 $best_testimonial_slider_messages=array();
                                 $best_testimonial_slider_messages['type']='succ';
                                 $best_testimonial_slider_messages['message']= __('Testimonial updated successfully.','easy-testimonial-rotator');
                                 update_option('best_testimonial_slider_messages', $best_testimonial_slider_messages);

             
                         }
                       catch(Exception $e){
                       
                              $best_testimonial_slider_messages=array();
                              $best_testimonial_slider_messages['type']='err';
                              $best_testimonial_slider_messages['message']=__('Error while updating testimonial.','easy-testimonial-rotator');
                              update_option('best_testimonial_slider_messages', $best_testimonial_slider_messages);
                        }  
                
              
              echo "<script type='text/javascript'> location.href='$location';</script>";
              exit;
       }
      else{
      
             //add new
                
                $location="admin.php?page=best_testimonial_slider_testimonial_management&paged=$paged";
               
                $createdOn=date('Y-m-d h:i:s');
                $imagename='';
                if(function_exists('date_i18n')){
                    
                    $createdOn=date_i18n('Y-m-d'.' '.get_option('time_format') ,false,false);
                    if(get_option('time_format')=='H:i')
                        $createdOn=date('Y-m-d H:i:s',strtotime($createdOn));
                    else   
                        $createdOn=date('Y-m-d h:i:s',strtotime($createdOn));
                }
               
                
                try{

                             if(isset($_POST['HdnMediaSelection']) and trim($_POST['HdnMediaSelection'])!=''){

                                    $postThumbnailID=(int) htmlentities(strip_tags($_POST['HdnMediaSelection']),ENT_QUOTES);
                                    $photoMeta = wp_get_attachment_metadata( $postThumbnailID );

                                    if(is_array($photoMeta) and isset($photoMeta['file'])) {

                                        $fileName=$photoMeta['file'];
                                        $phyPath=ABSPATH;
                                        $phyPath=str_replace("\\","/",$phyPath);

                                        $pathArray=pathinfo($fileName);

                                        $imagename=$pathArray['basename'];

                                        $upload_dir_n = wp_upload_dir(); 
                                        $upload_dir_n=$upload_dir_n['basedir'];
                                        $fileUrl=$upload_dir_n.'/'.$fileName;
                                        $fileUrl=str_replace("\\","/",$fileUrl);
                                        $imageUploadTo=$pathToImagesFolder.'/'.$imagename;

                                        @copy($fileUrl, $imageUploadTo);

                                    }

                            }

                            $query = "INSERT INTO ".$wpdb->prefix."b_testimo_slide (testimonial, image_name,auth_name,auth_desn,auth_email,createdon,gravatar_email,status) 
                                     VALUES ('$testimonial','$imagename','$auth_name','$auth_desn','$auth_email','$createdOn','$gravatar_email',$status)";



                            $wpdb->query($query); 

                            $best_testimonial_slider_messages=array();
                            $best_testimonial_slider_messages['type']='succ';
                            $best_testimonial_slider_messages['message']=__('New testimonial added successfully.','easy-testimonial-rotator');
                            update_option('best_testimonial_slider_messages', $best_testimonial_slider_messages);


                    }
                  catch(Exception $e){

                         $best_testimonial_slider_messages=array();
                         $best_testimonial_slider_messages['type']='err';
                         $best_testimonial_slider_messages['message']=__('Error while adding testimonial.','easy-testimonial-rotator');
                         update_option('best_testimonial_slider_messages', $best_testimonial_slider_messages);
                   }  
                     
                       
                
                echo "<script type='text/javascript'> location.href='$location';</script>";          
                exit;
            
       } 
        
    }
   else{ 
       
        $uploads = wp_upload_dir ();
        $baseurl=$uploads['baseurl'];
        $baseurl.='/easy-testimonial-rotator/';
        
  ?>
     <div style="width: 100%;">  
        <div style="float:left;width:100%;" >
            <div class="wrap">
             <table><tr><td><a href="https://twitter.com/FreeAdsPost" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false">Follow @FreeAdsPost</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></td>
                        <td>
                            <a target="_blank" title="Donate" href="http://www.i13websolution.com/donate-wordpress_image_thumbnail.php">
                                <img id="help us for free plugin" height="30" width="90" src="<?php echo plugins_url( 'images/paypaldonate.jpg', __FILE__ ) ;?>" border="0" alt="help us for free plugin" title="help us for free plugin">
                            </a>
                        </td>
                        </tr>
                    </table>
                 <span><h3 style="color: blue;"><a target="_blank" href="https://www.i13websolution.com/wordpress-best-testimonials-slider-plugin.html">UPGRADE TO PRO VERSION</a></h3></span>
                      
          <?php if(isset($_GET['id']) and (int) $_GET['id']>0)
          { 
               
                
                $id= htmlentities(strip_tags($_GET['id']),ENT_QUOTES);
                
                $query="SELECT * FROM ".$wpdb->prefix."b_testimo_slide WHERE id=$id" ;
                
                $myrow  = $wpdb->get_row($query);
                
                if(is_object($myrow)){
                
                  $testimonial=$myrow->testimonial;
                  $auth_name=$myrow->auth_name;
                  $auth_desn=$myrow->auth_desn;
                  $image_name=$myrow->image_name;
                  $auth_email=$myrow->auth_email;
                  $gravatar_email=$myrow->gravatar_email;
                  $status=$myrow->status;
                  
                }   
              
          ?>
            <h2><?php echo __('Update Testimonial','easy-testimonial-rotator');?></h2>
          <?php }else{ 
                  
                  $testimonial='';
                  $auth_name='';
                  $auth_desn='';
                  $image_name='';
                  $auth_email='';
                  $gravatar_email='';
                  $status='';
           
          
          ?>
          <h2><?php echo __('Add Testimonial','easy-testimonial-rotator');?> </h2>
          <?php } ?>
           <?php
                $settings=get_option('best_testimonial_options'); 
                $settings_fields=get_option( 'i13_default_form_options' );
                
            ?>    
           <?php
          
            $imgUrl='';
            if($image_name!='' and $image_name!=null){
                
                $imgUrl=$baseurl . $image_name;
            }
            else if($gravatar_email!='' and $gravatar_email!=null){
                
                     $email=md5($gravatar_email);
                     $imgUrl="https://www.gravatar.com/avatar/$email?s=200";     
            }
           $vNonce = wp_create_nonce('vNonce');
          ?>
            <br/>
            <div id="poststuff">
              <div id="post-body" class="metabox-holder columns-2">
                <div id="post-body-content">
                  <form method="post" action="" id="addimage" name="addimage" enctype="multipart/form-data" >
                      
                    <?php if($settings_fields['show_author_name']):?>
                        <div class="stuffbox" id="namediv" style="width:100%;">
                         <h3><label for="auth_name"><?php echo $settings_fields['author_name_label'];?>
                              <?php if($settings_fields['is_author_name_field_required']):?>
                                 <span class="required">*</span>
                              <?php endif;?>  
                             </label></h3>
                            <div class="inside">
                                <input type="text" id="auth_name"  name="auth_name" value="<?php echo $auth_name;?>" style="width:300px">
                                 <div style="clear:both"></div>
                                 <div></div>
                                 <div style="clear:both"></div>

                             </div>
                         </div>
                      <?php endif;?>
                      <?php if($settings_fields['show_author_des']):?>
                        <div class="stuffbox" id="namediv" style="width:100%;">
                         <h3><label for="auth_desn"><?php echo $settings_fields['author_designation_lable'];?>
                             <?php if($settings_fields['is_author_designation_field_required']):?>
                                 <span class="required">*</span>
                              <?php endif;?> 
                             </label></h3>
                            <div class="inside">
                                <input type="text" id="auth_desn"  name="auth_desn" value="<?php echo $auth_desn;?>" style="width:300px">
                                 <div style="clear:both"></div>
                                 <div></div>
                                 <div style="clear:both"></div>

                             </div>
                         </div>
                      <?php endif;?>
                       <?php if($settings_fields['show_author_email']):?>
                         <div class="stuffbox" id="namediv" style="width:100%;">
                         <h3><label for="auth_website"><?php echo $settings_fields['author_email_label'];?>
                             <?php if($settings_fields['is_author_email_field_required']):?>
                                 <span class="required">*</span>
                              <?php endif;?> 
                             </label></h3>
                            <div class="inside">
                                <input type="text" id="auth_email" class=""   size="30" name="auth_email" value="<?php echo $auth_email; ?>">
                                 <div style="clear:both"></div>
                                 <div></div>
                                 <div style="clear:both"></div>

                             </div>
                        </div>
                      <?php endif;?>
                      <?php if($settings_fields['show_photo_upload']):?>
                      
                         <div class="stuffbox" id="namediv" style="width:100%;">
                         <h3><label for="link_name"><?php echo $settings_fields['author_photo_label'];?>
                             <?php if($settings_fields['photo_upload_field_required']):?>
                                 <span class="required">*</span>
                              <?php endif;?>
                             </label></h3>
                         <div class="inside" id="fileuploaddiv">
                              <?php if ($imgUrl != "") { ?>
                                    <div>
                                            <b><?php echo __('Current Image :','easy-testimonial-rotator');?></b>
                                            <br/>
                                            <img id="img_disp" name="img_disp"
                                                    src="<?php echo $imgUrl; ?>" />
                                    </div>
                            <?php }else{ ?>      
                                        <img
                                            src="<?php echo plugins_url('/images/no-img.png', __FILE__); ?>"
                                            id="img_disp" name="img_disp" />

                                 <?php } ?>    
                             <div class="uploader">
                              <br/>
                                <a href="javascript:;" class="niks_media" id="myMediaUploader"><b><?php echo __('Click here to upload author photo','easy-testimonial-rotator');?></b></a>
                                <br/>
                                <b style="padding-left:50px"><?php echo __("OR",'easy-testimonial-rotator');?></b><br/>
                                <table><tr><td><a style="vertical-align: top;" href="javascript:;" class="niks_gav" id="niks_gav"><b><?php echo $settings_fields['author_photo_link_label'];?></b></a>&nbsp;&nbsp;<img id="gav_loader" class="gav_loader" style="display:none" src="<?php echo plugins_url( 'images/ajax-loader.gif', __FILE__ );?>"  /></td></tr></table>
                                <input id="HdnMediaSelection" name="HdnMediaSelection" type="hidden" value="<?php echo $image_name;?>" />
                                <input id="HdnMediaGrevEmail" name="HdnMediaGrevEmail" type="hidden" value="<?php echo $gravatar_email;?>" />
                                 <div style="clear:both"></div>
                                 <div></div>
                                 <div style="clear:both"></div>
                              <br/>
                            </div>  
                            <?php if(etr_best_testimonial_slider_get_wp_version()>=3.5){ ?>
                              <script>
                            var $n = jQuery.noConflict();  
                            
                            
                            $n( "#niks_gav" ).click(function() {
                               var email_gav = prompt("<?php echo __("Please enter your gravatar.com email",'easy-testimonial-rotator');?>", "");
                               if($n.trim(email_gav)!='' && email_gav!=null){
                                   
                                           $n("#gav_loader").show(); 
                                           var data_grav = {
                                                        'action': 'etr_get_grav_avtar',
                                                        'email': $n.trim(email_gav),
                                                        'vNonce':'<?php echo $vNonce; ?>'
                                                };
                                                $n.post(ajaxurl, data_grav, function(data) {
                                                    
                                                      $n("#HdnMediaGrevEmail").val($n.trim(email_gav)); 
                                                      $n("#HdnMediaSelection").val(''); 
                                                      $n("#img_disp").attr('src', data);
                                                      $n("#gav_loader").hide();
                                               
                                                });


                                        
                                   
                               }
                               
                             });
                            $n(document).ready(function() {
                                   //uploading files variable
                                   var custom_file_frame;
                                   $n("#myMediaUploader").click(function(event) {
                                      event.preventDefault();
                                      //If the frame already exists, reopen it
                                      if (typeof(custom_file_frame)!=="undefined") {
                                         custom_file_frame.close();
                                      }
                                 
                                      //Create WP media frame.
                                      custom_file_frame = wp.media.frames.customHeader = wp.media({
                                         //Title of media manager frame
                                         title: "<?php echo __('WP Media Uploader','easy-testimonial-rotator');?>",
                                         library: {
                                            type: 'image'
                                         },
                                         button: {
                                            //Button text
                                            text: "<?php echo __('Set Image','easy-testimonial-rotator');?>"
                                         },
                                         //Do not allow multiple files, if you want multiple, set true
                                         multiple: false
                                      });
                                 
                                      //callback for selected image
                                      custom_file_frame.on('select', function() {
                                         
                                          var attachment = custom_file_frame.state().get('selection').first().toJSON();
                                          
                                           var validExtensions=new Array();
                                            validExtensions[0]='jpg';
                                            validExtensions[1]='jpeg';
                                            validExtensions[2]='png';
                                            validExtensions[3]='gif';
                                           
                                                        
                                            var inarr=parseInt($n.inArray( attachment.subtype, validExtensions));
                                
                                            if(inarr>0 && attachment.type.toLowerCase()=='image' ){
                                                
                                                 
                                                
                                                if(attachment.id!=''){
                                                    $n("#HdnMediaSelection").val(attachment.id); 
                                                    $n("#HdnMediaGrevEmail").val(''); 
                                                      $n("#img_disp").attr('src', attachment.url);
                                                }   
                                                
                                            }  
                                            else{
                                                
                                                alert("<?php echo $settings_fields['invalid_photo_field_error_msg'];?>");
                                            }  
                                             //do something with attachment variable, for example attachment.filename
                                             //Object:
                                             //attachment.alt - image alt
                                             //attachment.author - author id
                                             //attachment.caption
                                             //attachment.dateFormatted - date of image uploaded
                                             //attachment.description
                                             //attachment.editLink - edit link of media
                                             //attachment.filename
                                             //attachment.height
                                             //attachment.icon - don't know WTF?))
                                             //attachment.id - id of attachment
                                             //attachment.link - public link of attachment, for example ""http://site.com/?attachment_id=115""
                                             //attachment.menuOrder
                                             //attachment.mime - mime type, for example image/jpeg"
                                             //attachment.name - name of attachment file, for example "my-image"
                                             //attachment.status - usual is "inherit"
                                             //attachment.subtype - "jpeg" if is "jpg"
                                             //attachment.title
                                             //attachment.type - "image"
                                             //attachment.uploadedTo
                                             //attachment.url - http url of image, for example "http://site.com/wp-content/uploads/2012/12/my-image.jpg"
                                             //attachment.width
                                      });
                                 
                                      //Open modal
                                      custom_file_frame.open();
                                   });
                                })
                            </script>
                            <?php } ?> 
                         </div>
                       </div>
                     <?php endif;?>
                       <div class="stuffbox" id="namediv" style="width:100%;">
                         <h3><label for="testimonial"><?php echo $settings_fields['testimonial_label'];?><span class="required">*</span></label></h3>
                        <div class="inside">
                             <textarea cols="90" class="" style="width:100%;" rows="3" id="testimonial" name="testimonial"><?php echo $testimonial;?></textarea>
                             <div style="clear:both"></div>
                             <div></div>
                             <div style="clear:both"></div>
                            <p>
                         </div>
                        </div>
                      <div class="stuffbox" id="namediv" style="width:100%;">
                         <h3><label for="status"><?php echo $settings_fields['status_label'];?><span class="required">*</span></label></h3>
                        <div class="inside">
                             <select id="status" name="status" class="select">
                                <option value=""><?php echo __('Select','easy-testimonial-rotator');?></option>
                                <option <?php if($status=='1'):?> selected="selected" <?php endif;?>  value="1" ><?php echo __('Published','easy-testimonial-rotator');?></option>
                                <option <?php if($status=='0'):?> selected="selected" <?php endif;?>  value="0"><?php echo __('Draft','easy-testimonial-rotator');?></option>
                            </select>   
                             <div style="clear:both"></div>
                             <div></div>
                             <div style="clear:both"></div>
                            <p>
                         </div>
                        </div>
                       <?php if(isset($_GET['id']) and $_GET['id']>0){ ?> 
                           <input type="hidden" name="imageid" id="imageid" value="<?php echo $_GET['id'];?>">
                       <?php }?>
                       <?php wp_nonce_field('action_image_add_edit','add_edit_image_nonce'); ?>    
                       <input type="submit"  name="btnsave" id="btnsave" value="<?php echo __('Save Changes','easy-testimonial-rotator');?>" class="button-primary">&nbsp;&nbsp;<input type="button" name="cancle" id="cancle" value="Cancel" class="button-primary" onclick="location.href='admin.php?page=best_testimonial_slider_testimonial_management'">
                                  
                 </form> 
                  <script type="text/javascript">
                  
                     var $n = jQuery.noConflict();  
                     
                     $n.validator.setDefaults({ 
                            ignore: []
                           
                        });
                     $n.validator.addMethod("checkImgUpload", function(value, element) {
                            
                            if($n.trim($n("#HdnMediaSelection").val())=='' && $n.trim($n("#HdnMediaGrevEmail").val())==''){
                                
                                return false;
                            }
                            else{
                                
                                return true;
                            }
                            
                        }, "<?php echo $settings_fields['required_field_error_msg'];?>");

                     $n(document).ready(function() {
                     
                        $n("#addimage").validate({
                            rules: {
                                    testimonial: {
                                      required:true, 
                                      maxlength: 500
                                    },
                                    auth_name: {
                                      maxlength: 500,
                                      <?php if($settings_fields['show_author_name'] and $settings_fields['is_author_name_field_required']):?>
                                       required:true
                                       <?php else: ?>
                                        required:false   
                                     <?php endif;?>  
                                    },
                                    auth_desn: {
                                       maxlength: 500,
                                       <?php if($settings_fields['show_author_des'] and $settings_fields['is_author_designation_field_required']):?>
                                       required:true
                                       <?php else: ?>
                                        required:false   
                                      <?php endif;?> 
                                    },
                                    auth_email: {
                                      email:true,  
                                      maxlength: 500,
                                      <?php if($settings_fields['show_author_email'] and $settings_fields['is_author_email_field_required']):?>
                                       required:true
                                       <?php else: ?>
                                        required:false   
                                      <?php endif;?>  
                                     
                                    },
                                    status:{
                                      required:true
                                    },
                                    HdnMediaGrevEmail:{
                                       <?php if($settings_fields['show_photo_upload'] and $settings_fields['photo_upload_field_required']):?>
                                          checkImgUpload : true 
                                       <?php else: ?>
                                           checkImgUpload : false 
                                       <?php endif;?>    
                                           
                                    }        
                               },
                                 messages: {
                                     
                                     testimonial: {
                                       required:"<?php echo $settings_fields['required_field_error_msg'];?>"
                                      },
                                     auth_name: {
                                       required:"<?php echo $settings_fields['required_field_error_msg'];?>"
                                      },
                                     status: {
                                       required:"<?php echo $settings_fields['required_field_error_msg'];?>"
                                       
                                      },
                                     auth_email: {
                                       required:"<?php echo $settings_fields['required_field_error_msg'];?>",
                                       email:"<?php echo $settings_fields['invalid_email_field_error_msg'];?>"
                                      }
                                 },
                                 errorClass: "image_error",
                                 errorPlacement: function(error, element) {
                                 error.appendTo( element.next().next().next());
                             } 
                             

                        })
                    });
                  
                  function validateFile(){

                        var $n = jQuery.noConflict();  
                        if($n('#currImg').length>0 || $n.trim($n("#HdnMediaSelection").val())!="" ){
                            return true;
                        }
                        else
                            {
                            $n("#err_daynamic").remove();
                            $n("#myMediaUploader").after('<br/><label class="image_error" id="err_daynamic">Please select file.</label>');
                            return false;  
                        } 

                    }
                
                </script> 

                </div>
                <div id="postbox-container-1" class="postbox-container" > 

                            <div class="postbox"> 
                                <h3 class="hndle"><span></span>Access All Themes In One Price</h3> 
                                <div class="inside">
                                    <center><a href="http://www.elegantthemes.com/affiliates/idevaffiliate.php?id=11715_0_1_10" target="_blank"><img border="0" src="<?php echo plugins_url( 'images/300x250.gif', __FILE__ );?>" width="250" height="250"></a></center>

                                    <div style="margin:10px 5px">

                                    </div>
                                </div></div>
                            <div class="postbox"> 
                                <h3 class="hndle"><span></span>Best WordPress Themes</h3> 

                                <div class="inside">
                                     <center><a href="https://mythemeshop.com/?ref=nik_gandhi007" target="_blank"><img src="<?php echo plugins_url( 'images/300x250.png', __FILE__ );?>" width="250" height="250" border="0"></a></center>
                                    <div style="margin:10px 5px">
                                    </div>
                                </div></div>

                   </div>  
          </div>
        </div>  
     </div>      
         </div>
    <?php 
    } 
  }  
  else if(strtolower($action)==strtolower('delete')){
  
      
       $retrieved_nonce = '';
            
        if(isset($_GET['nonce']) and $_GET['nonce']!=''){

            $retrieved_nonce=$_GET['nonce'];

        }
        if (!wp_verify_nonce($retrieved_nonce, 'delete_image' ) ){


            wp_die('Security check fail'); 
        }

       $uploads = wp_upload_dir ();
       $baseDir = $uploads ['basedir'];
       $baseDir = str_replace ( "\\", "/", $baseDir );
       $pathToImagesFolder = $baseDir . '/easy-testimonial-rotator';
        
       
       
        $location="admin.php?page=best_testimonial_slider_testimonial_management";
        $deleteId=(int)$_GET['id'];
                
                try{
                         
                    
                        $query="SELECT * FROM ".$wpdb->prefix."b_testimo_slide WHERE id=$deleteId";
                        $myrow  = $wpdb->get_row($query);
                                    
                        if(is_object($myrow)){
                            
                            $image_name=$myrow->image_name;
                            //$imagename=$_FILES["image_name"]["name"];
                            $imagetoDel=$pathToImagesFolder.'/'.$image_name;
                            @unlink($imagetoDel);
                                        
                             $query = "delete from  ".$wpdb->prefix."b_testimo_slide where id=$deleteId";
                             $wpdb->query($query); 
                           
                             $best_testimonial_slider_messages=array();
                             $best_testimonial_slider_messages['type']='succ';
                             $best_testimonial_slider_messages['message']=__('Image deleted successfully.','easy-testimonial-rotator');
                             update_option('best_testimonial_slider_messages', $best_testimonial_slider_messages);
                        }    

     
                 }
               catch(Exception $e){
               
                      $best_testimonial_slider_messages=array();
                      $best_testimonial_slider_messages['type']='err';
                      $best_testimonial_slider_messages['message']=__('Error while deleting image.','easy-testimonial-rotator');
                      update_option('best_testimonial_slider_messages', $best_testimonial_slider_messages);
                }  
                          
          
          echo "<script type='text/javascript'> location.href='$location';</script>";
          exit;
              
  }  
  else if(strtolower($action)==strtolower('deleteselected')){
      
       if(!check_admin_referer('action_settings_mass_delete','mass_delete_nonce')){
               
            wp_die('Security check fail'); 
        }
        $uploads = wp_upload_dir ();
        $baseDir = $uploads ['basedir'];
        $baseDir = str_replace ( "\\", "/", $baseDir );
        $pathToImagesFolder = $baseDir . '/easy-testimonial-rotator';
       
           
            $location="admin.php?page=best_testimonial_slider_testimonial_management";
    
           if(isset($_POST) and isset($_POST['deleteselected']) and  ( $_POST['action']=='delete' or $_POST['action_upper']=='delete')){
          
                if(sizeof($_POST['thumbnails']) >0){
                
                        $deleteto=$_POST['thumbnails'];
                        $implode=implode(',',$deleteto);   
                        
                        try{
                                
                               foreach($deleteto as $img){ 
                                   
                                    $query="SELECT * FROM ".$wpdb->prefix."b_testimo_slide WHERE id=$img";
                                    $myrow  = $wpdb->get_row($query);
                                    
                                    if(is_object($myrow)){
                                        
                                        $image_name=$myrow->image_name;
                                        //$imagename=$_FILES["image_name"]["name"];
                                        $imagetoDel=$pathToImagesFolder.'/'.$image_name;
                                        @unlink($imagetoDel);
                                     
                                        $query = "delete from  ".$wpdb->prefix."b_testimo_slide where id=$img";
                                        $wpdb->query($query); 
                                   
                                        $best_testimonial_slider_messages=array();
                                        $best_testimonial_slider_messages['type']='succ';
                                        $best_testimonial_slider_messages['message']=__('selected images deleted successfully.','easy-testimonial-rotator');
                                        update_option('best_testimonial_slider_messages', $best_testimonial_slider_messages);
                                   }
                                  
                             }
             
                         }
                       catch(Exception $e){
                       
                              $best_testimonial_slider_messages=array();
                              $best_testimonial_slider_messages['type']='err';
                              $best_testimonial_slider_messages['message']=__('Error while deleting image.','easy-testimonial-rotator');
                              update_option('best_testimonial_slider_messages', $best_testimonial_slider_messages);
                        }  
                              
                       
                       echo "<script type='text/javascript'> location.href='$location';</script>";
                       exit;
                
                }
                else{
                
                    
                    echo "<script type='text/javascript'> location.href='$location';</script>";   
                    exit;
                }
            
           }
           else{
                 
                 echo "<script type='text/javascript'> location.href='$location';</script>";      
                 exit;
           }
     
      }      
    
  } 
  
function etr_best_testimonial_preview_admin(){
        
           global $wpdb;
           $settings=get_option('best_testimonial_options');           
           $settings['style']='style 1';
           $rand_Numb=uniqid('quotes_slider');
           $rand_Num_td=uniqid('divSliderMain');
           $rand_var_name=uniqid('rand_');
      
        
           $uploads = wp_upload_dir();
           $baseDir = $uploads ['basedir'];
           $baseDir = str_replace ( "\\", "/", $baseDir );

           $baseurl=$uploads['baseurl'];
           $baseurl.='/easy-testimonial-rotator/';
           $pathToImagesFolder = $baseDir . '/easy-testimonial-rotator';
           
     ?>      
    
       <?php
            $wpcurrentdir=dirname(__FILE__);
            $wpcurrentdir=str_replace("\\","/",$wpcurrentdir);
        ?>
       <div style="width: 100%;">  
            <h2><?php echo __('Preview Slider','easy-testimonial-rotator');?></h2>
            <div style="float:left;width:100%;">
                <div class="wrap">
               
                <?php if(is_array($settings)){?>
                <div id="poststuff">
                  <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                     <?php if($settings['style']=='style 1'): ?>  
                      
                        <div class="class_fulldiv style1">
                            
                             <style type='text/css' >
                                 
                                #<?php echo $rand_Num_td;?> .bx-wrapper .bx-viewport{left:auto;padding: 0px;padding-bottom:10px} 
                                #<?php echo $rand_Num_td;?> .bx-wrapper .bx-viewport {
                                    background: none repeat scroll 0 0 <?php echo $settings['slider_back_color']; ?> ;

                                  }
                                   #<?php echo $rand_Num_td;?> .bx-wrapper {

                                      border: <?php echo $settings['box_border_size'];?>px solid <?php echo $settings['box_border_color'];?>;
                                      box-shadow: 0 0 5px <?php echo $settings['box_shadow_color'];?>;
                                  }
                                   #<?php echo $rand_Num_td;?>  .bx-wrapper .bx-prev {

                                        background: rgba(0, 0, 0, 0) url("<?php echo plugins_url( 'images/controls.png', __FILE__ ); ?>") no-repeat scroll -1px -31px;
                                        left: 0;
                                        <?php if($settings['show_arrows']):?>
                                        display:block;
                                        <?php endif;?>
                                    }

                                     #<?php echo $rand_Num_td;?>  .bx-wrapper .bx-next {
                                        background: rgba(0, 0, 0, 0) url("<?php echo plugins_url( 'images/controls.png', __FILE__ ); ?>") no-repeat scroll -42px -31px;
                                        right: 0;
                                         <?php if($settings['show_arrows']):?>
                                        display:block ;
                                        <?php endif;?>
                                    }

                                     #<?php echo $rand_Num_td;?> .bx-wrapper .bx-next:hover,  #<?php echo $rand_Num_td;?> .bx-wrapper .bx-next:focus {
                                          background-position: -42px 0 ;
                                     }
                                     #<?php echo $rand_Num_td;?> .bx-wrapper .bx-prev:hover, #<?php echo $rand_Num_td;?> .bx-wrapper .bx-prev:focus {
                                        background-position: -1px 0 ;
                                      }
                                </style>
                            <div class="childDiv_style1" id="<?php echo $rand_Num_td;?>">  
                               
                                <div class="bxsliderx rowcust" >
                                    
                                   <?php  $query="SELECT * FROM ".$wpdb->prefix."b_testimo_slide where  status=1 order by createdon desc";
                                        $rows=$wpdb->get_results($query,'ARRAY_A');
                                        $randOmeAlbName=uniqid('slider_');
                                        if(count($rows) > 0){
                                            
                                            ?>
                                            <?php foreach($rows as $row):?>
                                            <?php
                                             if($row['image_name']!='' or $row['image_name']!=null){

                                                    //$outputimg = $baseurl.$row['image_name'];

                                                     $imagename=$row['image_name'];
                                                     $imageUploadTo=$pathToImagesFolder.'/'.$imagename;
                                                     $imageUploadTo=str_replace("\\","/",$imageUploadTo);
                                                     $pathinfo=pathinfo($imageUploadTo);
                                                     $filenamewithoutextension=$pathinfo['filename'];
                                                     $imageheight=300;
                                                     $imagewidth=300;
                                                     $outputimg="";


                                                     $outputimg = $baseurl.$row['image_name']; 
                                                     if($settings['resize_images']==0){

                                                         $outputimg = $baseurl.$row['image_name']; 

                                                     }
                                                     else{

                                                           $imagetoCheck=$pathToImagesFolder.'/'.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                           $imagetoCheckSmall=$pathToImagesFolder.'/'.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.strtolower($pathinfo['extension']);


                                                         if(file_exists($imagetoCheck)){
                                                             $outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];

                                                         }
                                                         else if(file_exists($imagetoCheckSmall)){
                                                             $outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.strtolower($pathinfo['extension']);
                                                         }
                                                         else{


                                                             if(function_exists('wp_get_image_editor')){


                                                                 $image = wp_get_image_editor($pathToImagesFolder."/".$row['image_name']); 
                                                                 if ( ! is_wp_error( $image ) ) {
                                                                     $image->resize( $imagewidth, $imageheight, true );
                                                                     $image->save( $imagetoCheck );
                                                                     //$outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];

                                                                     if(file_exists($imagetoCheck)){
                                                                         $outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                                     }
                                                                     else if(file_exists($imagetoCheckSmall)){
                                                                         $outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.strtolower($pathinfo['extension']);
                                                                     }
                                                                 }
                                                                 else{
                                                                     $outputimg = $baseurl.$row['image_name'];
                                                                 }     

                                                             }
                                                             else if(function_exists('image_resize')){

                                                                 $return=image_resize($pathToImagesFolder."/".$row['image_name'],$imagewidth,$imageheight) ;
                                                                 if ( ! is_wp_error( $return ) ) {

                                                                     $isrenamed=rename($return,$imagetoCheck);
                                                                     if($isrenamed){
                                                                         //$outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];  

                                                                           if(file_exists($imagetoCheck)){
                                                                                 $outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                                             }
                                                                             else if(file_exists($imagetoCheckSmall)){
                                                                                 $outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.strtolower($pathinfo['extension']);
                                                                             }


                                                                     }
                                                                     else{
                                                                         $outputimg = $baseurl.$row['image_name']; 
                                                                     } 
                                                                 }
                                                                 else{
                                                                     $outputimg = $baseurl.$row['image_name'];
                                                                 }  
                                                             }
                                                             else{

                                                                 $outputimg = $baseurl.$row['image_name'];
                                                             }  

                                                             //$url = plugin_dir_url(__FILE__)."imagestoscroll/".$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];

                                                         } 
                                                     }

                                                }
                                                else if($row['gravatar_email']!='' and $row['gravatar_email']!=null){

                                                    $email=md5($row['gravatar_email']);
                                                    $outputimg="https://www.gravatar.com/avatar/$email?s=200";     
                                                 }
                                                else{

                                                    $outputimg=plugins_url( 'images/no_photo.png', __FILE__ ) ;
                                                }
                                             ?>
                                            <div class="setMargin">

                                                <div class="rowupdate margin_Quotes">


                                                    <div class="colupdate-sm-12 setmargin"  >
                                                        <div class="setfloat floatLeft">
                                                            <img class="imgupdate-circle imgupdate-circle-img" src="<?php echo $outputimg;?>" style="">
                                                        </div> 
                                                        <blockquote class="open_close">

                                                            <span class="quotes_content">
                                                              <?php echo $row['testimonial'];?>   
                                                            </span>
                                                            
                                                            <?php if($settings['show_author_name'] and trim($row['auth_name'])!=''):?> 
                                                                <span class="author_name"><?php echo $row['auth_name'];?></span>
                                                            <?php endif;?>     
                                                            <?php if($settings['show_author_des'] and trim($row['auth_desn'])!=''):?> 
                                                                 <span class="author_position"><?php echo $row['auth_desn'];?></span>
                                                            <?php endif;?>
                                                                 
                                                        </blockquote>


                                                    </div>
                                                </div>



                                            </div>
                                            <?php endforeach;?>
                                    <?php }?>
                                </div>
                            </div>
                            <script type="text/javascript">
                               var $n = jQuery.noConflict(); 
                                $n(document).ready(function () {
                                        
                                    var sliderwidth=$n("#<?php echo $rand_Num_td;?>").width();
                                    if(sliderwidth<=699){

                                        $n('.style1 #<?php echo $rand_Num_td;?> div.bxsliderx.rowcust div div.rowupdate.margin_Quotes div.colupdate-sm-12.setmargin .setfloat').removeClass('floatLeft');
                                    }

                                    var timer;
                                    var width = $n(window).width();
                                    $n(window).bind('resize', function(){
                                        if($n(window).width() != width){

                                            width = $n(window).width();
                                            timer && clearTimeout(timer);
                                            timer = setTimeout(resizecall, 100);

                                        }   
                                    });

                                    function resizecall(){

                                        var sliderwidth=$n("#<?php echo $rand_Num_td;?>").width();
                                        if(sliderwidth<=699){

                                            $n('.style1 #<?php echo $rand_Num_td;?> div.bxsliderx.rowcust div div.rowupdate.margin_Quotes div.colupdate-sm-12.setmargin .setfloat').removeClass('floatLeft');
                                          
                                             $n('.style1 #<?php echo $rand_Num_td;?> div.bx-wrapper div.bx-viewport').css('height','auto');
                                         
                                          

                                        }else{

                                            $n('.style1 #<?php echo $rand_Num_td;?> div.bxsliderx.rowcust div div.rowupdate.margin_Quotes div.colupdate-sm-12.setmargin .setfloat').addClass('floatLeft');
                                              
                                            $n('.style1 #<?php echo $rand_Num_td;?> div.bx-wrapper div.bx-viewport').css('height','auto');

                                                   

                                            
                                        }

                                    }

                                    var sld_<?php echo $rand_Num_td;?> = $n('#<?php echo $rand_Num_td;?> .bxsliderx').bxSliderx({
                                        slideMargin: 100,
                                        auto: <?php echo ($settings['auto'])==1 ? 'true' : 'false'; ?>,
                                        infiniteLoop: <?php echo ($settings['is_circular_slider'])==1 ? 'true' : 'false'; ?>,
                                        minSlides: 1,
                                        maxSlides: 1,
                                        moveSlides: 1,
                                        speed: <?php echo $settings['speed']; ?>,
                                        pause: <?php echo $settings['pause']; ?>,
                                        adaptiveHeight: <?php echo ($settings['is_adaptive_height'])==1 ? 'true' : 'false'; ?>,
                                        controls: <?php echo ($settings['show_arrows'])==1 ? 'true' : 'false'; ?>,
                                        pager: <?php echo ($settings['show_pagination'])==1 ? 'true' : 'false'; ?>,
                                        touchEnabled: <?php echo ($settings['touch_enabled'])==1 ? 'true' : 'false'; ?>
                                        
                                    });
                                });
                            </script>
                        </div> 
                    
                       <?php endif;?>
                     
                 </div>
            </div>  
          <?php }?>
         </div>      
    </div>   
   </div>             
    <div class="clear"></div>
   </div>
     <h3><?php echo __('To print this slider into WordPress Post/Page use below code','easy-testimonial-rotator');?></h3>
    <input type="text" value='[print_best_testimonial_slider] ' style="width: 400px;height: 30px" onclick="this.focus();this.select()" />
    <div class="clear"></div>
    <h3><?php echo __('To print this slider into WordPress theme/template PHP files use below code','easy-testimonial-rotator');?></h3>
    <?php
        $shortcode='[print_best_testimonial_slider]';
    ?>
    <input type="text" value="&lt;?php echo do_shortcode('<?php echo htmlentities($shortcode, ENT_QUOTES); ?>'); ?&gt;" style="width: 400px;height: 30px" onclick="this.focus();this.select()" />
       
    <div class="clear"></div>
    
    <h3><?php echo __('To print form for this slider into WordPress Post/Page use below code','easy-testimonial-rotator');?></h3>
    <input type="text" value='[print_best_testimonial_form ] ' style="width: 400px;height: 30px" onclick="this.focus();this.select()" />
    <div class="clear"></div>
    <h3><?php echo __('To print form for this slider into WordPress theme/template PHP files use below code','easy-testimonial-rotator');?></h3>
    <?php
        $shortcode='[print_best_testimonial_form]';
    ?>
    <input type="text" value="&lt;?php echo do_shortcode('<?php echo htmlentities($shortcode, ENT_QUOTES); ?>'); ?&gt;" style="width: 400px;height: 30px" onclick="this.focus();this.select()" />
    <div class="clear"></div>
    
<?php       
   }    
   
function etr_print_best_testimonial_form_func($atts){

    global $wpdb;
    $settings_main=get_option('best_testimonial_options'); 
    $settings_main['id']=1;
    $settings=get_option( 'i13_default_form_options' );
    
    $uploads = wp_upload_dir();
    $baseurl=$uploads['baseurl'];
    $baseurl.='/easy-testimonial-rotator/';
    $baseDir=$uploads['basedir'];
    $baseDir=str_replace("\\","/",$baseDir);
    $pathToImagesFolder=$baseDir.'/easy-testimonial-rotator';
    $randNo=  uniqid('rate_');
    $vNonce = wp_create_nonce('vNonce');
    $submitNonce = wp_create_nonce('SubmitNonce');
    $etr_i13_captcha_img=new etr_i13_captcha_img();
    $captchaImgName=$etr_i13_captcha_img->etr_generateI13Captcha();
 
 //$res=$i13_captcha_img->etr_verifyCaptcha('i13_cap_5758d902eb069','yhhhgh');

    ob_start(); 
     
    ?>  
        <form id="testimonial-form-<?php echo $settings_main['id'];?>" class="testimonial-form"  method="post">
         <div style="display:none" class="success" id="success_<?php echo $settings_main['id'];?>" ><?php echo $settings['success_msg'];?></div>
         <div style="display:none" class="error" id="error_<?php echo $settings_main['id'];?>" ><?php echo $settings['error_msg'];?></div>
         <?php if($settings['show_author_name']):?>  
            <div>
                <span><?php echo $settings['author_name_label'];?> <?php if($settings['is_author_name_field_required']):?> <span class="required">*</span><?php endif;?></span>
                <input  type="text"  name="auth_name" id="auth_name_<?php echo $settings_main['id'];?>">
                <label id="error_auth_name_<?php echo $settings_main['id'];?>" for="auth_name_<?php echo $settings_main['id'];?>"  class="image_error error_<?php echo $settings_main['id'];?>"></label>

            </div>
         <?php endif; ?>
         <?php if($settings['show_author_des']):?>     
            <div>
                <span><?php echo $settings['author_designation_lable'];?> <?php if($settings['is_author_designation_field_required']):?> <span class="required">*</span><?php endif;?></span>
               <input  type="text"   name="auth_desn" id="auth_desn_<?php echo $settings_main['id'];?>">
               <label id="error_auth_desn_<?php echo $settings_main['id'];?>" for="auth_desn_<?php echo $settings_main['id'];?>"  class="image_error error_<?php echo $settings_main['id'];?>"></label>

            </div>
         <?php endif;?>   
          <?php if($settings['show_author_email']):?>    
            <div>
                    
                <span><?php echo $settings['author_email_label'];?> <?php if($settings['is_author_email_field_required']):?> <span class="required">*</span><?php endif;?></span>
                <input  type="text"  name="auth_email" id="auth_email_<?php echo $settings_main['id'];?>">
                <label id="error_auth_email_<?php echo $settings_main['id'];?>" for="auth_email_<?php echo $settings_main['id'];?>"  class="image_error error_<?php echo $settings_main['id'];?>"></label>

            </div>
           <?php endif;?> 
          <?php if($settings['show_photo_upload']):?>
            <div>
                   
                            <span><?php echo $settings['author_photo_label'];?><?php if($settings['photo_upload_field_required']):?> <span class="required">*</span><?php endif;?></span>
                            <img src="<?php echo plugins_url('/images/no-img.png', __FILE__); ?>" id="img_disp_<?php echo $settings_main['id'];?>" class="auth_photo" />
                            <a style="vertical-align: auto;" href="javascript:;" class="form_link_label" id="niks_gav_<?php echo $settings_main['id'];?>"><b><?php echo __("Click here to use gravatar.com's avtar",'easy-testimonial-rotator');?></b></a>&nbsp;&nbsp;<img id="gav_loader_<?php echo $settings_main['id'];?>" class="gav_loader_<?php echo $settings_main['id'];?>" style="display:none" src="<?php echo plugins_url( 'images/ajax-loader.gif', __FILE__ );?>"  />
                            <input id="HdnMediaGrevEmail_<?php echo $settings_main['id'];?>" name="HdnMediaGrevEmail" type="hidden" value="" />
                            <label id="error_HdnMediaGrevEmail_<?php echo $settings_main['id'];?>" for="HdnMediaGrevEmail_<?php echo $settings_main['id'];?>"  class="image_error error_<?php echo $settings_main['id'];?>"></label>
                            <script>
                            var $n = jQuery.noConflict();    
                            $n( "#niks_gav_<?php echo $settings_main['id'];?>" ).click(function() {
                               var email_gav_<?php echo $settings_main['id'];?> = prompt("<?php echo __("Please enter your gravatar.com email",'easy-testimonial-rotator');?>", "");
                               if($n.trim(email_gav_<?php echo $settings_main['id'];?>)!='' && email_gav_<?php echo $settings_main['id'];?>!=null){
                                   
                                           $n("#gav_loader_<?php echo $settings_main['id'];?>").show(); 
                                           var data_grav = {
                                                        'action': 'etr_get_grav_avtar',
                                                        'email': $n.trim(email_gav_<?php echo $settings_main['id'];?>),
                                                        'vNonce':'<?php echo $vNonce; ?>'
                                                };
                                                $n.post('<?php echo admin_url('admin-ajax.php'); ?>', data_grav, function(data) {
                                                    
                                                      $n("#HdnMediaGrevEmail_<?php echo $settings_main['id'];?>").val($n.trim(email_gav_<?php echo $settings_main['id'];?>)); 
                                                      $n("#img_disp_<?php echo $settings_main['id'];?>").attr('src', data);
                                                      $n("#gav_loader_<?php echo $settings_main['id'];?>").hide();
                                               
                                                });


                                        
                                   
                               }
                               
                             });
                            
                          </script>   
                  
            </div>
            <?php endif;?>
             <div>
                <span><?php echo $settings['testimonial_label'];?> <span class="required">*</span></span>
                <textarea name="testimonial" id="testimonial_<?php echo  $settings_main['id'];?>"  ></textarea>
                <label id="error_testimonial_<?php echo $settings_main['id'];?>" for="testimonial_<?php echo $settings_main['id'];?>"  class="image_error error_<?php echo $settings_main['id'];?>"></label>

		</div>
             <?php if($settings['show_captcha']):?>
            <?php ?>
             <div>
                 <div class="cpatchadiv">
                        
                    <span><img id="captcha_img_<?php echo  $settings_main['id'];?>" name="captcha_img_<?php echo  $settings_main['id'];?>" src="<?php echo $baseurl.$captchaImgName.'.jpeg';?>"/></span>
                    <input class="captchaFiled" placeholder="<?php echo $settings['captcha_label'];?>"  type="text"   name="captcha" id="captcha_<?php echo $settings_main['id'];?>">
                    <img  id="reload_captcha_<?php echo  $settings_main['id'];?>" class="reload_captcha" title="<?php echo $settings['new_captcha_label'];?>"  src="<?php echo plugins_url('/images/reload_captcha.png', __FILE__); ?>" />
                    <input type="hidden" name="cpatcha_name" id="cpatcha_name_<?php echo  $settings_main['id'];?>" value="<?php echo $captchaImgName;?>" />

                 </div> 
                 <label id="error_cpatcha_<?php echo $settings_main['id'];?>" for="captcha_img_<?php echo $settings_main['id'];?>"  class="image_error error_<?php echo $settings_main['id'];?>"></label>
                 <script>
                     var $n = jQuery.noConflict();
                      $n( "#reload_captcha_<?php echo  $settings_main['id'];?>" ).click(function() {
                       
                        var data_captcha = {
                                        'action': 'etr_get_new_captcha',
                                        'vNonce':'<?php echo $vNonce; ?>',
                                        'oldcaptcha':$n('#cpatcha_name_<?php echo  $settings_main['id'];?>').val()
                                };
                                
                                $n.ajax({

                                    url :'<?php echo admin_url('admin-ajax.php'); ?>',

                                    type:'post',

                                    dataType : "json",

                                    data: data_captcha,

                                    success:function(data) {
                                       
                                      $n("#cpatcha_name_<?php echo  $settings_main['id'];?>").val(data.cpatcha_name);
                                      $n("#captcha_img_<?php echo  $settings_main['id'];?>").attr('src',data.captcha_url);
                                    },

                                    error: function() {alert('error'); }

                                    });
                                    
                               
                      });
                 </script>
            </div>
            
            <?php endif;?>
         <div class="btn_submit_testimonial_form">
                <input type="hidden" value="<?php echo $submitNonce;?>" name="tnonce"  id="tnonce_<?php echo  $settings_main['id'];?>" />
                <input type="hidden" value="etr_save_testimonial" name="action" id="action" />
                <input type="hidden" value="<?php echo  $settings_main['id'];?>" name="form_id" id="form_id_<?php echo  $settings_main['id'];?>" />
                <button name="submit_<?php echo  $settings_main['id'];?>" type="button" id="submit_<?php echo  $settings_main['id'];?>" class="submit"><?php echo $settings['submit_label'];?></button>&nbsp;<img src="<?php echo plugins_url('/images/ajax-loader-2.gif', __FILE__);?>"  id="ajax_loader_<?php echo  $settings_main['id'];?>" style="display:none"  />
                <script>
                    var $n = jQuery.noConflict();
                      $n( "#submit_<?php echo  $settings_main['id'];?>" ).click(function() {
                       
                        $n('#success_<?php echo $settings_main['id'];?>').hide();
                         $n('#error_<?php echo $settings_main['id'];?>').hide();
                         $n('#ajax_loader_<?php echo $settings_main['id'];?>').show();
                         
                          var str = $n( "#testimonial-form-<?php echo  $settings_main['id'];?>" ).serialize();
           
                                
                                $n.ajax({

                                    url :'<?php echo admin_url('admin-ajax.php'); ?>',

                                    type:'post',

                                    dataType : "json",

                                    data: str,

                                    success:function(data) {
                                        
                                         $n('#ajax_loader_<?php echo $settings_main['id'];?>').hide();
                                         $n(".error_<?php echo $settings_main['id'];?>").html('');
                                         
                                        if(data.result.hasOwnProperty('fields_error')){
                                            var flag=true;
                                            var first_element='';
                                            $n.each(data.result.fields_error, function(i, item) {
                                                if(flag==true){
                                                    flag=false;
                                                    first_element="error_"+i;
                                                }
                                                $n("#error_"+i).html(item);
                                            });
                                            
                                            var replaceEle=first_element.replace("error_", "");
                                            $n("#"+replaceEle).focus();
                                            
                                             $n('html, body').animate({
                                                   scrollTop: $n('#'+first_element).offset().top-150
                                              }, 500);
                                               
                                            
                                            
                                         }
                                         else if(data.result.hasOwnProperty('error')){
                                           
                                           if(data.result.hasOwnProperty('captchaRefreshed')){
                                                
                                                   
                                                $n("#cpatcha_name_<?php echo  $settings_main['id'];?>").val(data.result.captchaRefreshed.cpatcha_name);
                                                $n("#captcha_img_<?php echo  $settings_main['id'];?>").attr('src',data.result.captchaRefreshed.captcha_url);
                                                
                                            }
                                            
                                             $n('#error_<?php echo $settings_main['id'];?>').show();
                                                $n('html, body').animate({
                                                   scrollTop: $n('#error_<?php echo $settings_main['id'];?>').offset().top-100
                                               }, 500);
                                               
                                             $n("#captcha_<?php echo $settings_main['id'];?>").val('');  
                                           
                                           
                                         }
                                         else if(data.result.hasOwnProperty('success')){
                                            
                                            if(data.result.hasOwnProperty('resetFormsFields')){
                                                
                                                 $n.each(data.result.resetFormsFields, function(i, item) {
                                                    
                                                    $n("#"+i).val('');
                                                    
                                                });
                                                
                                                <?php if($settings['show_photo_upload']):?>
                                                    var no_img= '<?php echo plugins_url('/images/no-img.png', __FILE__); ?>';
                                                    $n("#img_disp_<?php echo $settings_main['id'];?>").attr('src',no_img);
                                                <?php endif;?>        
                                                
                                            }
                                            if(data.result.hasOwnProperty('captchaRefreshed')){
                                                
                                                   
                                                $n("#cpatcha_name_<?php echo  $settings_main['id'];?>").val(data.result.captchaRefreshed.cpatcha_name);
                                                $n("#captcha_img_<?php echo  $settings_main['id'];?>").attr('src',data.result.captchaRefreshed.captcha_url);
                                                
                                            }
                                                $n("#<?php echo $randNo;?>").html('');
                                               
                                            
                                                 $n('#success_<?php echo $settings_main['id'];?>').show();
                                                 $n('html, body').animate({
                                                    scrollTop: $n('#success_<?php echo $settings_main['id'];?>').offset().top-100
                                                }, 500);
                                             
                                         }
                                    
                                    },

                                    error: function() {
                                                        alert('error'); 
                                                        $n('#ajax_loader_<?php echo $settings_main['id'];?>').hide(); 
                                                    }

                                       
                                        
                                    });
                                    
                               
                      });
                 </script>
            </div>
   </form>

<?php 

 $output = ob_get_clean();
 return $output;
       
}   
function etr_print_best_testimonial_slider_func($atts){
       
       global $wpdb;
       $rand_Numb=uniqid('thumnail_slider');
       $rand_Num_td=uniqid('divSliderMain');
       $settings=get_option('best_testimonial_options');           
       $settings['style']='style 1';
           
       $rand_var_name=uniqid('rand_');
       $wpcurrentdir=dirname(__FILE__);
       $wpcurrentdir=str_replace("\\","/",$wpcurrentdir);
       
       
       $uploads = wp_upload_dir();
       $baseurl=$uploads['baseurl'];
       $baseurl.='/easy-testimonial-rotator/';
       $baseDir=$uploads['basedir'];
       $baseDir=str_replace("\\","/",$baseDir);
       $pathToImagesFolder=$baseDir.'/easy-testimonial-rotator';
       ob_start(); 
       
 ?>      
        <?php $url = plugin_dir_url(__FILE__);  ?>
        <?php if($settings['style']=='style 1'): ?>  
                      
            <div class="class_fulldiv style1">

                 <style type='text/css' >

                    #<?php echo $rand_Num_td;?> .bx-wrapper .bx-viewport{left:auto;padding: 0px;padding-bottom:10px} 
                    #<?php echo $rand_Num_td;?> .bx-wrapper .bx-viewport {
                        background: none repeat scroll 0 0 <?php echo $settings['slider_back_color']; ?> ;

                      }
                       #<?php echo $rand_Num_td;?> .bx-wrapper {

                          border: <?php echo $settings['box_border_size'];?>px solid <?php echo $settings['box_border_color'];?>;
                          box-shadow: 0 0 5px <?php echo $settings['box_shadow_color'];?>;
                      }
                       #<?php echo $rand_Num_td;?>  .bx-wrapper .bx-prev {

                            background: rgba(0, 0, 0, 0) url("<?php echo plugins_url( 'images/controls.png', __FILE__ ); ?>") no-repeat scroll -1px -31px ;
                            left: 0;
                             <?php if($settings['show_arrows']):?>
                             display:block ;
                            <?php endif;?>
                        }

                         #<?php echo $rand_Num_td;?>  .bx-wrapper .bx-next {
                            background: rgba(0, 0, 0, 0) url("<?php echo plugins_url( 'images/controls.png', __FILE__ ); ?>") no-repeat scroll -42px -31px ;
                            right: 0;
                             <?php if($settings['show_arrows']):?>
                             display:block ;
                            <?php endif;?>
                        }

                         #<?php echo $rand_Num_td;?> .bx-wrapper .bx-next:hover,  #<?php echo $rand_Num_td;?> .bx-wrapper .bx-next:focus {
                              background-position: -42px 0 ;
                         }
                         #<?php echo $rand_Num_td;?> .bx-wrapper .bx-prev:hover, #<?php echo $rand_Num_td;?> .bx-wrapper .bx-prev:focus {
                            background-position: -1px 0 ;
                          }
                          
                    </style>
                <div class="childDiv_style1" id="<?php echo $rand_Num_td;?>">  

                    <div class="bxsliderx rowcust" >

                       <?php  $query="SELECT * FROM ".$wpdb->prefix."b_testimo_slide where  status=1 order by createdon desc";
                            $rows=$wpdb->get_results($query,'ARRAY_A');
                            $randOmeAlbName=uniqid('slider_');
                            if(count($rows) > 0){

                                ?>
                                <?php foreach($rows as $row):?>
                                <?php
                                 if($row['image_name']!='' or $row['image_name']!=null){

                                            //$outputimg = $baseurl.$row['image_name'];

                                             $imagename=$row['image_name'];
                                             $imageUploadTo=$pathToImagesFolder.'/'.$imagename;
                                             $imageUploadTo=str_replace("\\","/",$imageUploadTo);
                                             $pathinfo=pathinfo($imageUploadTo);
                                             $filenamewithoutextension=$pathinfo['filename'];
                                             $imageheight=300;
                                             $imagewidth=300;
                                             $outputimg="";


                                             $outputimg = $baseurl.$row['image_name']; 
                                             if($settings['resize_images']==0){

                                                 $outputimg = $baseurl.$row['image_name']; 

                                             }
                                             else{

                                                   $imagetoCheck=$pathToImagesFolder.'/'.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                   $imagetoCheckSmall=$pathToImagesFolder.'/'.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.strtolower($pathinfo['extension']);


                                                 if(file_exists($imagetoCheck)){
                                                     $outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];

                                                 }
                                                 else if(file_exists($imagetoCheckSmall)){
                                                     $outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.strtolower($pathinfo['extension']);
                                                 }
                                                 else{


                                                     if(function_exists('wp_get_image_editor')){


                                                         $image = wp_get_image_editor($pathToImagesFolder."/".$row['image_name']); 
                                                         if ( ! is_wp_error( $image ) ) {
                                                             $image->resize( $imagewidth, $imageheight, true );
                                                             $image->save( $imagetoCheck );
                                                             //$outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];

                                                             if(file_exists($imagetoCheck)){
                                                                 $outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                             }
                                                             else if(file_exists($imagetoCheckSmall)){
                                                                 $outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.strtolower($pathinfo['extension']);
                                                             }
                                                         }
                                                         else{
                                                             $outputimg = $baseurl.$row['image_name'];
                                                         }     

                                                     }
                                                     else if(function_exists('image_resize')){

                                                         $return=image_resize($pathToImagesFolder."/".$row['image_name'],$imagewidth,$imageheight) ;
                                                         if ( ! is_wp_error( $return ) ) {

                                                             $isrenamed=rename($return,$imagetoCheck);
                                                             if($isrenamed){
                                                                 //$outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];  

                                                                   if(file_exists($imagetoCheck)){
                                                                         $outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];
                                                                     }
                                                                     else if(file_exists($imagetoCheckSmall)){
                                                                         $outputimg = $baseurl.$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.strtolower($pathinfo['extension']);
                                                                     }


                                                             }
                                                             else{
                                                                 $outputimg = $baseurl.$row['image_name']; 
                                                             } 
                                                         }
                                                         else{
                                                             $outputimg = $baseurl.$row['image_name'];
                                                         }  
                                                     }
                                                     else{

                                                         $outputimg = $baseurl.$row['image_name'];
                                                     }  

                                                     //$url = plugin_dir_url(__FILE__)."imagestoscroll/".$filenamewithoutextension.'_'.$imageheight.'_'.$imagewidth.'.'.$pathinfo['extension'];

                                                 } 
                                             }

                                      }
                                    else if($row['gravatar_email']!='' and $row['gravatar_email']!=null){

                                        $email=md5($row['gravatar_email']);
                                        $outputimg="https://www.gravatar.com/avatar/$email?s=200";     
                                     }
                                    else{

                                        $outputimg=plugins_url( 'images/no_photo.png', __FILE__ ) ;
                                    }
                                 ?>
                                <div class="setMargin">

                                    <div class="rowupdate margin_Quotes">


                                        <div class="colupdate-sm-12 setmargin"  >
                                            <div class="setfloat floatLeft">
                                                <img class="imgupdate-circle imgupdate-circle-img" src="<?php echo $outputimg;?>" style="">
                                            </div> 
                                            <blockquote class="open_close">

                                                <div class="quotes_content">
                                                  <?php echo trim($row['testimonial']);?>   
                                                </div>

                                                <?php if($settings['show_author_name'] and trim($row['auth_name'])!=''):?> 
                                                     <span class="author_name"><?php echo $row['auth_name'];?></span>
                                                <?php endif;?>     
                                                <?php if($settings['show_author_des'] and trim($row['auth_desn'])!=''):?> 
                                                     <span class="author_position"><?php echo $row['auth_desn'];?></span>
                                                <?php endif;?>

                                            </blockquote>


                                        </div>
                                    </div>



                                </div>
                                <?php endforeach;?>
                        <?php }?>
                    </div>
                </div>
                <script type="text/javascript">
                   var $n = jQuery.noConflict(); 
                    $n(document).ready(function () {

                        var sliderwidth=$n("#<?php echo $rand_Num_td;?>").width();
                        if(sliderwidth<=699){

                            $n('.style1 #<?php echo $rand_Num_td;?> div.bxsliderx.rowcust div div.rowupdate.margin_Quotes div.colupdate-sm-12.setmargin .setfloat').removeClass('floatLeft');
                        }

                        var timer;
                        var width = $n(window).width();
                        $n(window).bind('resize', function(){
                            if($n(window).width() != width){

                                width = $n(window).width();
                                timer && clearTimeout(timer);
                                timer = setTimeout(resizecall, 100);

                            }   
                        });

                        function resizecall(){

                            var sliderwidth=$n("#<?php echo $rand_Num_td;?>").width();
                            if(sliderwidth<=699){

                                $n('.style1 #<?php echo $rand_Num_td;?> div.bxsliderx.rowcust div div.rowupdate.margin_Quotes div.colupdate-sm-12.setmargin .setfloat').removeClass('floatLeft');

                                 $n('.style1 #<?php echo $rand_Num_td;?> div.bx-wrapper div.bx-viewport').css('height','auto');



                            }else{

                                $n('.style1 #<?php echo $rand_Num_td;?> div.bxsliderx.rowcust div div.rowupdate.margin_Quotes div.colupdate-sm-12.setmargin .setfloat').addClass('floatLeft');

                                $n('.style1 #<?php echo $rand_Num_td;?> div.bx-wrapper div.bx-viewport').css('height','auto');




                            }

                        }

                        var sld_<?php echo $rand_Num_td;?> = $n('#<?php echo $rand_Num_td;?> .bxsliderx').bxSliderx({
                            slideMargin: 100,
                            auto: <?php echo ($settings['auto'])==1 ? 'true' : 'false'; ?>,
                            infiniteLoop: <?php echo ($settings['is_circular_slider'])==1 ? 'true' : 'false'; ?>,
                            minSlides: 1,
                            maxSlides: 1,
                            moveSlides: 1,
                            speed: <?php echo $settings['speed']; ?>,
                            pause: <?php echo $settings['pause']; ?>,
                            adaptiveHeight: <?php echo ($settings['is_adaptive_height'])==1 ? 'true' : 'false'; ?>,
                            controls: <?php echo ($settings['show_arrows'])==1 ? 'true' : 'false'; ?>,
                            pager: <?php echo ($settings['show_pagination'])==1 ? 'true' : 'false'; ?>,
                            touchEnabled: <?php echo ($settings['touch_enabled'])==1 ? 'true' : 'false'; ?>

                        });
                    });
                </script>
                  
            </div> 
                    
<?php endif;?>
<?php
       $output = ob_get_clean();
       return $output;
 }   
  
 function etr_best_testimonial_slider_get_wp_version() {
     
   global $wp_version;
   return $wp_version;
}
 

function etr_best_testimonial_slider_is_plugin_page() {
    
   $server_uri = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
   
   foreach (array('best_testimonial_slider_testimonial_management','best_testimonial_slider') as $allowURI) {
       
       if(stristr($server_uri, $allowURI)) return true;
   }
   
   return false;
}

function etr_best_testimonial_slider_admin_scripts_init() {
    
   if(etr_best_testimonial_slider_is_plugin_page()) {
      //double check for WordPress version and function exists
      if(function_exists('wp_enqueue_media') && version_compare(etr_best_testimonial_slider_get_wp_version(), '3.5', '>=')) {
         //call for new media manager
         wp_enqueue_media();
      }
      wp_enqueue_style('media');
       wp_enqueue_style( 'wp-color-picker' );
      wp_enqueue_script( 'wp-color-picker' );
      
      wp_enqueue_script( 'jquery-ui-spinner');
      

      
   }
} 
?>