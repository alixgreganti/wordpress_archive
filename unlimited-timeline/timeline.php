<?php
/*
Plugin Name: Unlimited Timeline
Plugin URI: https://www.exthemes.net
Description: Responsive Wordpress Timeline plugin
Version: 1.4
Package: Ex 1.0
Author: ExThemes
Author URI: https://www.exthemes.com
License: Commercial
*/

define( 'UN_PATH', plugin_dir_url( __FILE__ ) );

// Make sure we don't expose any info if called directly
if ( !defined('ABSPATH') ){
	die('-1');
}
class EXUN_Timeline{ //
	public function __construct()
    {
		$this->includes();
		if(is_admin()){
			$this->register_plugin_settings();
		}
		add_action( 'after_setup_theme', array(&$this, 'ex_thumbnails_register') );
		add_action( 'after_setup_theme', array(&$this, 'ex_register_bt') );
		add_action( 'admin_enqueue_scripts', array($this, 'timeline_admin_css') );
		add_action( 'wp_enqueue_scripts', array($this, 'frontend_scripts') );
		add_action( 'wp_head', array($this, 'tl_custom_css'), 999 );
		
    }
	function ex_register_bt(){
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
	    	return;
		}
		if ( get_user_option('rich_editing') == 'true' ) {
			add_filter( 'mce_external_plugins', array(&$this, 'ex_reg_plugin'));
			add_filter( 'mce_buttons', array(&$this, 'ex_reg_btn') );
		}
	}
	public function plugin_path() {
		if ( $this->plugin_path ) return $this->plugin_path;
		return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
	}
	function ex_reg_btn($buttons)
	{
		array_push($buttons, 'ex_timeline_bt');
		array_push($buttons, 'ex_timeline_ct_bt');
		return $buttons;
	}

	function ex_reg_plugin($plgs)
	{
		$plgs['ex_timeline_bt'] 		= UN_PATH . 'js/timeline-button.js';
		$plgs['ex_timeline_ct_bt'] 		= UN_PATH . 'js/timeline-button-ct.js';
		return $plgs;
	}
	function register_plugin_settings(){
		global $settings;
		$settings = new EXUN_Timeline_Settings(__FILE__);
		return $settings;
	}
	//thumbnails register
	function ex_thumbnails_register(){
		$tl_thumbsize = get_option('tl_thumbsize');
		$arr_sc = explode("x",$tl_thumbsize);
		if(count($arr_sc) ==2){
			add_image_size('thumb_'.$tl_thumbsize,$arr_sc[0],$arr_sc[1], true);
		}else{
			add_image_size('thumb_9999x368',9999,368, true);
		}
	}
	//inculde
	function includes(){
		require_once( 'inc/class-plugin-settings.php' );
		include_once('timeline-functions.php');
		// Timeline sc
		include('shortcode/timeline-sc.php');
		include('shortcode/timeline-content-sc.php');
	}
	//Custom css
	function tl_custom_css(){
		$tl_main_font = get_option('tl_main_font');
		$tl_heading_font = get_option('tl_heading_font');
		$tl_main_color = get_option('tl_main_color');
		$tl_custom_css = get_option('tl_custom_css');
		$hex = str_replace("#", "", $tl_main_color);
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = $r.','. $g.','.$b;
		?>
		<style type="text/css">
			<?php if($tl_main_font!=''){?>
				.list-timeline{ font-family:<?php echo esc_html($tl_main_font)?>}
			<?php }?>
			<?php if($tl_heading_font!=''){?>
				.list-timeline .timeline-row .heading-title,
				.list-timeline .timeline-item .item-bd .date,
				.list-timeline .event-title a{ font-family:<?php echo esc_html($tl_heading_font)?>}
			<?php }?>
			<?php if($tl_main_color!=''){?>
				.list-timeline.ev-center.diamond .timeline-row .timeline-item .in-ct i.firs, 
				.list-timeline.ev-right.diamond .timeline-row .excicle-icon i.thir, 
				.list-timeline.ev-left.diamond .timeline-row .excicle-icon i.firs, 
				.list-timeline.ev-both-side.diamond .timeline-row:nth-child(odd) .excicle-icon i.firs, 
				.list-timeline.ev-both-side.diamond .timeline-row:nth-child(2n) .excicle-icon i.firs,
				.list-timeline.ev-left .timeline-row .excicle-icon i.firs, .list-timeline.ev-both-side .timeline-row:nth-child(odd) .excicle-icon i.firs, .list-timeline.ev-both-side .timeline-row:nth-child(2n) .excicle-icon i.thir,
				.list-timeline .timeline-item .item-bd .date,
				.list-timeline.ev-right .timeline-row .excicle-icon i.thir,
				.list-timeline .timeline-row .timeline-item .event-title i.firs,
				.list-timeline.ev-center .timeline-row .timeline-item i.firs,
				.list-timeline.ex-background-image .timeline-item .event-title a i:before,
				.list-timeline .event-title i{ color:<?php echo esc_html($tl_main_color)?>;}
				.timeline-row.loadmore a,
				.list-timeline .timeline-item .read-more-bt{ border-color:<?php echo esc_html($tl_main_color)?>}
				.list-timeline.ex-background-image .timeline-row:nth-child(even) .timeline-item .info-details .date,
				.list-timeline.ex-background-image .timeline-row:nth-child(odd) .timeline-item .info-details .date,
				.list-timeline.ev-center.diamond .timeline-row .timeline-item .in-ct i.firs, 
				.list-timeline.ev-right.diamond .timeline-row .excicle-icon i.thir, 
				.list-timeline.ev-left.diamond .timeline-row .excicle-icon i.firs, 
				.list-timeline.ev-both-side.diamond .timeline-row:nth-child(odd) .excicle-icon i.firs, 
				.list-timeline.ev-both-side.diamond .timeline-row:nth-child(2n) .excicle-icon i.firs,
				.list-timeline .timeline-item .read-more-bt:hover,
				.list-timeline.ex-background-image .timeline-item .event-title a i:before,
				.list-timeline.ex-background-image:not(.ev-center) .timeline-item .item-bd .event-title,
				.timeline-row.loadmore a{ background:<?php echo esc_html($tl_main_color)?>}
				.list-timeline.ex-background-image .timeline-row .excicle-icon i{ background:rgba(<?php echo esc_attr($rgb);?>, .25)}
				.list-timeline.ex-background-image .timeline-item .in-ct i:before, .list-timeline.ex-background-image .timeline-item .event-title a i:before,
				.list-timeline.ex-background-image.ev-left .timeline-row .excicle-icon i.firs, 
				.list-timeline.ex-background-image.ev-right .timeline-row .excicle-icon i.thir, .list-timeline.ex-background-image.ev-both-side .timeline-row:nth-child(odd) .excicle-icon i.firs, .list-timeline.ex-background-image.ev-both-side .timeline-row:nth-child(2n) .excicle-icon i.thir{ background:<?php echo esc_html($tl_main_color)?>}
				@media screen and (max-width: 768px) {
					.list-timeline.ex-background-image.ev-both-side .timeline-row:nth-child(2n) .excicle-icon i.thir{background:rgba(<?php echo esc_attr($rgb);?>, .25)}
					.list-timeline.ev-both-side .timeline-row:nth-child(2n) .excicle-icon i.thir{color:rgba(<?php echo esc_attr($rgb);?>, .25)}
					.list-timeline.ex-background-image.ev-both-side .timeline-row .excicle-icon i.firs{background:<?php echo esc_html($tl_main_color)?>}
					.list-timeline.ev-both-side .timeline-row .excicle-icon i.firs:before{ color:<?php echo esc_html($tl_main_color)?>}
				}
				@media screen and (min-width: 768px) {
					.list-timeline.ev-both-side.diamond .timeline-row:nth-child(2n) .excicle-icon i.thir{background:<?php echo esc_html($tl_main_color)?>; color:<?php echo esc_html($tl_main_color)?>;}
				}
			<?php }
			if($tl_custom_css!=''){
				echo exuntl_esc($tl_custom_css);
			}?>
		</style>
		<?php
	}
	/*
	 * Load js and css
	 */
	function timeline_admin_css(){
			// CSS for button styling
			wp_enqueue_style("timeline_admin_style", UN_PATH . '/assets/css/style.css');
	}
	function frontend_scripts(){
		$tl_turnoff_font = get_option('tl_turnoff_font');
		if($tl_turnoff_font!='off'){
			wp_enqueue_style('font-awesome', UN_PATH.'css/font-awesome/css/font-awesome.min.css');
		}
		wp_enqueue_style('unlimited-timeline-css', UN_PATH.'css/style.css');
		wp_enqueue_script( 'ajax-loadmore',plugins_url('/js/ajax.js', __FILE__) , array( 'jquery' ) );
		//google font
		$tl_main_font = get_option('tl_main_font');
		if($tl_main_font){
			wp_enqueue_style( 'tl-google-fonts', '//fonts.googleapis.com/css?family=' . $tl_main_font );
		}
		$js_params = array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) );
		global $wp_query, $wp;
		$js_params['query_vars'] = '1';
		$js_params['current_url'] =  home_url($wp->request);
		wp_localize_script( 'ajax-loadmore', 'loadmore_ajax', $js_params  );
	}
}
$EXUN_Timeline = new EXUN_Timeline();