<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("repeat","no-repeat","repeat-x","repeat-y");
		$body_pos 			= array("0% 0%","top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		$body_size 		    = array("auto","100px 100px","75px 75px","10px 150px","200px","50%","100% 100%","cover","contain");
        $body_attachment 	= array("scroll","fixed","local");

		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> "General Options",
						"type" 		=> "heading",
                        "icon"		=> ADMIN_IMAGES . "icon-home.png"
				);
				
$of_options[] = array( 	"name" 		=> "Upload Standard Logo",
						"desc" 		=> "Please insert your logo.",
						"id" 		=> "media_logo_upload",
						// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
						"std" 		=> "",
						"mod"		=> "min",
						"type" 		=> "media"
				);

$of_options[] = array( 	"name" 		=> "Upload Standard Favicon",
						"desc" 		=> "Please insert your favicon 16x16 icon.",
						"id" 		=> "media_favicon_upload",
						// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
						"std" 		=> "",
						"mod"		=> "min",
						"type" 		=> "media"
				);

$of_options[] = array( 	"name" 		=> "Use Boxed Layout?",
						"desc" 		=> "Switch ON/OFF",
						"id" 		=> "switch_boxed_layout",
						"std" 		=> 0,
						"type" 		=> "switch"
				);   
					
$of_options[] = array( 	"name" 		=> "Use Background Pattern?",
						"desc" 		=> "Select a background pattern for boxed layout.",
						"id" 		=> "background_pattern",
						"std" 		=> $bg_images_url."bg0.png",
						"type" 		=> "tiles",
						"options" 	=> $bg_images,
				);

$of_options[] = array( 	"name" 		=> "Use Background Image?",
						"desc" 		=> "Upload a background image for boxed layout.",
						"id" 		=> "background_image",
						// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
						"std" 		=> "",
						"mod"		=> "min",
						"type" 		=> "media"
				);

$of_options[] = array( 	"name" 		=> "Background Repeat?",
						"desc" 		=> "Select an option.",
						"id" 		=> "background_repeat",
						"std" 		=> "repeat",
						"type" 		=> "select",
						"options" 	=> $body_repeat
				);

$of_options[] = array( 	"name" 		=> "Background Position?",
						"desc" 		=> "Select an option.",
						"id" 		=> "background_position",
						"std" 		=> "0% 0%",
						"type" 		=> "select",
						"options" 	=> $body_pos
				);

$of_options[] = array( 	"name" 		=> "Background Size?",
						"desc" 		=> "Select an option.",
						"id" 		=> "background_size",
						"std" 		=> "auto",
						"type" 		=> "select",
						"options" 	=> $body_size
				);

$of_options[] = array( 	"name" 		=> "Background Attachment?",
						"desc" 		=> "Select an option.",
						"id" 		=> "background_attachment",
						"std" 		=> "scroll",
						"type" 		=> "select",
						"options" 	=> $body_attachment
				);

$of_options[] = array( 	"name" 		=> "Styling Options",
						"type" 		=> "heading"
				);
				
$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( 	"name" 		=> "Use Predefined Color Skin?",
						"desc" 		=> "Select a color skin.",
						"id" 		=> "predefind_skin",
						"std" 		=> "#2ecc71",
						"type" 		=> "images",
						"options" 	=> array(
											'#2ecc71' 	=> $url . 'Untitled-1.png',
											'#3498db' 	=> $url . 'Untitled-2.png',
                                            '#f1c40f' 	=> $url . 'Untitled-3.png',
                                            '#e67e22' 	=> $url . 'Untitled-4.png',
                                            '#16a085' 	=> $url . 'Untitled-5.png'
										)
				);

$of_options[] = array( 	"name" 		=> "Use Custom Color Skin?",
						"desc" 		=> "Pick a color skin for the theme (default: none).",
						"id" 		=> "color_skin",
						"std" 		=> "",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Show Style Switcher?",
						"desc" 		=> "Switch ON/OFF",
						"id" 		=> "switch_style_switcher",
						"std" 		=> 0,
						"type" 		=> "switch"
				); 
				
$of_options[] = array( 	"name" 		=> "Use Custom CSS?",
						"desc" 		=> "Quickly add some CSS to your theme by adding it to this block.",
						"id" 		=> "custom_css",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
				
$of_options[] = array( 	"name" 		=> "Additional Options",
						"type" 		=> "heading",
                        "icon"		=> ADMIN_IMAGES . "icon-settings.png"
				);

$of_options[] = array( 	"name" 		=> "Use the affix header?",
						"desc" 		=> "Switch ON/OFF",
						"id" 		=> "switch_affix_header",
						"std" 		=> 0,
						"type" 		=> "switch"
				); 	
                
$of_options[] = array( 	"name" 		=> "Show scrool to top?",
						"desc" 		=> "Switch ON/OFF",
						"id" 		=> "switch_scroll_top",
						"std" 		=> 0,
						"type" 		=> "switch"
				); 				
				
$of_options[] = array( 	"name" 		=> "Tracking Code",
						"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
						"id" 		=> "google_analytics",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
				
$of_options[] = array( 	"name" 		=> "Footer Text",
						"desc" 		=> "You can use the following shortcodes in your footer text: [rt_blog_title] [rt_the_year] [rt_wp_link]",
						"id" 		=> "footer_text",
						"std" 		=> "[rt_blog_title] @ [rt_the_year]. All Rights Reserved. [rt_wp_link] !",
						"type" 		=> "textarea"
				);
				
				
// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
