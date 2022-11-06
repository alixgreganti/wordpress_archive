<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class EXUN_Timeline_Settings {
    private $dir;
	private $file;
	private $assets_dir;
	private $assets_url;
	private $settings_base;
	private $settings;

	public function __construct( $file ) {
		$this->file = $file;
		$this->dir = dirname( $this->file );
		$this->assets_dir = trailingslashit( $this->dir ) . 'assets';
		$this->assets_url = esc_url( trailingslashit( plugins_url( '/assets/', $this->file ) ) );
		$this->settings_base = '';

		// Initialise settings
		add_action( 'admin_init', array( $this, 'init' ) );

		// Register plugin settings
		add_action( 'admin_init' , array( $this, 'register_settings' ) );

		// Add settings page to menu
		add_action( 'admin_menu' , array( $this, 'add_menu_item' ) );

		// Add settings link to plugins page
		add_filter( 'plugin_action_links_' . plugin_basename( $this->file ) , array( $this, 'add_settings_link' ) );
	}

	/**
	 * Initialise settings
	 * @return void
	 */
	public function init() {
		$this->settings = $this->settings_fields();
	}

	/**
	 * Add settings page to admin menu
	 * @return void
	 */
	public function add_menu_item() {
		$page = add_menu_page( esc_html__( 'Timeline Settings', 'exthemes' ) , esc_html__( 'Timeline Settings', 'exthemes' ) , 'manage_options' , 'exthemes' ,  array( $this, 'settings_page' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'settings_assets' ) );
	}

	/**
	 * Load settings JS & CSS
	 * @return void
	 */
	public function settings_assets() {

		// We're including the farbtastic script & styles here because they're needed for the colour picker
		// If you're not including a colour picker field then you can leave these calls out as well as the farbtastic dependency for the wpt-admin-js script below
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_script( 'farbtastic' );
	
		// We're including the WP media scripts here because they're needed for the image upload field
		// If you're not including an image upload then you can leave this function call out
		wp_enqueue_media();
		wp_enqueue_style('admin-timeline-css', $this->assets_url . 'css/style.css');
		wp_register_script( 'wpt-admin-js', $this->assets_url . 'js/settings.js', array( 'farbtastic', 'jquery' ), '1.0.0' );
		wp_enqueue_script( 'wpt-admin-js' );
	}

	/**
	 * Add settings link to plugin list table
	 * @param  array $links Existing links
	 * @return array 		Modified links
	 */
	public function add_settings_link( $links ) {
		$settings_link = '<a href="options-general.php?page=plugin_settings">' . esc_html__( 'Settings', 'exthemes' ) . '</a>';
  		array_push( $links, $settings_link );
  		return $links;
	}

	/**
	 * Build settings fields
	 * @return array Fields to be displayed on settings page
	 */
	private function settings_fields() {
		$output = 'objects';
		$args = array(
		   'public'   => true,
		);
		$post_types = get_post_types( $args, $output );
		$listpt = array();
		$listpt['wp-timeline'] = esc_html__( 'Timelines', 'wp-timeline' );
		foreach ( $post_types  as $post_type ) {
			if($post_type->name!='attachment' && $post_type->name!='elementor_library' && $post_type->name!='wp-timeline'){
				$listpt[$post_type->name] = $post_type->label;
			}
		}
		$settings['standard'] = array(
			'title'					=> esc_html__( 'General Settings', 'exthemes' ),
			'description'			=> esc_html__( '', 'exthemes' ),
			'fields'				=> array(
				array(
					'id' 			=> 'timeline_style',
					'label'			=> esc_html__( 'Style', 'exthemes' ),
					'description'	=> esc_html__( 'Select Style of timeline', 'exthemes' ),
					'type'			=> 'select',
					'options'		=> array( 'modern' => esc_html__( 'Modern', 'exthemes' ), 'classic' => esc_html__( 'Classic', 'exthemes' ), 'diamond' => esc_html__( 'Diamond', 'exthemes' )),
					'default'		=> 'modern'
				),
				array(
					'id' 			=> 'tl_main_color',
					'label'			=> esc_html__( 'Main color', 'exthemes' ),
					'description'	=> esc_html__( 'Choose main color of timeline', 'exthemes' ),
					'type'			=> 'color',
					'default'		=> '#FD8F03'
				),
				array(
					'id' 			=> 'tl_main_font',
					'label'			=> esc_html__( 'Main Font Family' , 'exthemes' ),
					'description'	=> esc_html__( 'Enter font-family name here. Google Fonts are supported. For example, if you choose "Source Code Pro" (https://www.google.com/fonts/)', 'exthemes' ),
					'type'			=> 'text',
					'default'		=> '',
					'placeholder'	=> esc_html__( 'Font name', 'exthemes' )
				),
				array(
					'id' 			=> 'tl_heading_font',
					'label'			=> esc_html__( 'Heading Font Family' , 'exthemes' ),
					'description'	=> esc_html__( 'Enter font-family name here. Google Fonts are supported. For example, if you choose "Source Code Pro" (https://www.google.com/fonts/)', 'exthemes' ),
					'type'			=> 'text',
					'default'		=> '',
					'placeholder'	=> esc_html__( 'Font name', 'exthemes' )
				),
				array(
					'id' 			=> 'tl_number_exceprt',
					'label'			=> esc_html__( 'Number of excerpt' , 'exthemes' ),
					'description'	=> esc_html__( 'Enter number', 'exthemes' ),
					'type'			=> 'text',
					'default'		=> '',
					'placeholder'	=> esc_html__( '', 'exthemes' )
				),
				array(
					'id' 			=> 'tl_load_icon',
					'label'			=> esc_html__( 'Load more icon' , 'exthemes' ),
					'description'	=> esc_html__( 'Font Awesome Icon (ex: fa-cog) (http://fortawesome.github.io/Font-Awesome/icons/)', 'exthemes' ),
					'type'			=> 'text',
					'default'		=> '',
					'placeholder'	=> esc_html__( 'Icon name', 'exthemes' )
				),
				array(
					'id' 			=> 'tl_turnoff_font',
					'label'			=> esc_html__( 'Turn off Font Awesome', 'exthemes' ),
					'description'	=> esc_html__( "Turn off loading plugin's Font Awesome. Check if your theme has already loaded this library", 'exthemes' ),
					'type'			=> 'checkbox',
					'default'		=> ''
				),
				array(
					'id' 			=> 'tl_bgpallarax',
					'label'			=> esc_html__( 'Background pallarax', 'exthemes' ),
					'description'	=> esc_html__( '', 'exthemes' ),
					'type'			=> 'radio',
					'options'		=> array( 'on' => esc_html__( 'On','exthemes'), 'off' => esc_html__( 'Off','exthemes')),
					'default'		=> 'on'
				),
				array(
					'id' 			=> 'tl_custom_css',
					'label'			=> esc_html__( 'Custom Css' , 'exthemes' ),
					'description'	=> esc_html__( 'Enter CSS code', 'exthemes' ),
					'type'			=> 'textarea',
					'default'		=> '',
					'placeholder'	=> esc_html__( 'Custom Css', 'exthemes' )
				),
				array(
					'id' 			=> 'tl_thumbsize',
					'label'			=> esc_html__( 'Thumbnails size', 'exthemes' ),
					'description'	=> esc_html__( '', 'exthemes' ),
					'type'			=> 'text',
					'default'		=> '',
					'placeholder'	=> esc_html__( 'Enter Thumbnails size, ex: 9999x580', 'exthemes' )
				),
				array(
					'id' 			=> 'tl_share_button',
					'label'			=> esc_html__( 'Sharing', 'exthemes' ),
					'description'	=> esc_html__( '', 'exthemes' ),
					'type'			=> 'checkbox_multi',
					'options'		=> array( 'fb' => esc_html__( 'Show Facebook Share Button','exthemes'), 'tw' => esc_html__( 'Show Twitter Share Button','exthemes'), 'li' => esc_html__( 'Show LinkedIn Share Button','exthemes'), 'tb' => esc_html__( 'Show Tumblr Share Button','exthemes'), 'gg' => esc_html__( 'Show Google+ Share Button ','exthemes'), 'pin' => esc_html__( 'Show Pinterest Pin Button','exthemes'), 'vk' => esc_html__( 'Show VK Share Button','exthemes'), 'em' => esc_html__( 'Show Email Button','exthemes') ),
					'default'		=> array()
				),
				array(
					'id' 			=> 'tl_ctdate_posttypes',
					'label'			=> esc_html__( 'Custom date field', 'exthemes' ),
					'description'	=> esc_html__( 'Select Posttypes to enable custom date field', 'exthemes' ),
					'type'			=> 'checkbox_multi',
					'options'		=> $listpt,
					'default'		=> array()
				),
			)
		);
		$settings['extra'] = array(
			'title'					=> esc_html__( 'Translate text', 'exthemes' ),
			'description'			=> esc_html__( '', 'exthemes' ),
			'fields'				=> array(
				array(
					'id' 			=> 'tl_load_text',
					'label'			=> esc_html__( 'Load more' , 'exthemes' ),
					'description'	=> esc_html__( '', 'exthemes' ),
					'type'			=> 'text',
					'default'		=> '',
					'placeholder'	=> esc_html__( '', 'exthemes' )
				),
				array(
					'id' 			=> 'tl_viewdetails_text',
					'label'			=> esc_html__( 'View details' , 'exthemes' ),
					'description'	=> esc_html__( '', 'exthemes' ),
					'type'			=> 'text',
					'default'		=> '',
					'placeholder'	=> esc_html__( '', 'exthemes' )
				),
				array(
					'id' 			=> 'tl_timeago_text',
					'label'			=> esc_html__( 'Ago' , 'exthemes' ),
					'description'	=> esc_html__( '', 'exthemes' ),
					'type'			=> 'text',
					'default'		=> '',
					'placeholder'	=> esc_html__( '', 'exthemes' )
				),
				array(
					'id' 			=> 'tl_comment_text',
					'label'			=> esc_html__( 'Comment' , 'exthemes' ),
					'description'	=> esc_html__( '', 'exthemes' ),
					'type'			=> 'text',
					'default'		=> '',
					'placeholder'	=> esc_html__( '', 'exthemes' )
				),
				array(
					'id' 			=> 'tl_by_text',
					'label'			=> esc_html__( 'By' , 'exthemes' ),
					'description'	=> esc_html__( '', 'exthemes' ),
					'type'			=> 'text',
					'default'		=> '',
					'placeholder'	=> esc_html__( '', 'exthemes' )
				),
			)
		);

		$settings = apply_filters( 'plugin_settings_fields', $settings );

		return $settings;
	}

	/**
	 * Register plugin settings
	 * @return void
	 */
	public function register_settings() {
		if( is_array( $this->settings ) ) {
			foreach( $this->settings as $section => $data ) {

				// Add section to page
				add_settings_section( $section, $data['title'], array( $this, 'settings_section' ), 'plugin_settings' );

				foreach( $data['fields'] as $field ) {

					// Validation callback for field
					$validation = '';
					if( isset( $field['callback'] ) ) {
						$validation = $field['callback'];
					}

					// Register field
					$option_name = $this->settings_base . $field['id'];
					register_setting( 'plugin_settings', $option_name, $validation );

					// Add field to page
					add_settings_field( $field['id'], $field['label'], array( $this, 'display_field' ), 'plugin_settings', $section, array( 'field' => $field ) );
				}
			}
		}
	}

	public function settings_section( $section ) {
		$html = '<p> ' . $this->settings[ $section['id'] ]['description'] . '</p>' . "\n";
		echo wp_kses_post($html);
	}

	/**
	 * Generate HTML for displaying fields
	 * @param  array $args Field data
	 * @return void
	 */
	public function display_field( $args ) {

		$field = $args['field'];

		$html = '';

		$option_name = $this->settings_base . $field['id'];
		$option = get_option( $option_name );

		$data = '';
		if( isset( $field['default'] ) ) {
			$data = $field['default'];
			if( $option ) {
				$data = $option;
			}
		}

		switch( $field['type'] ) {

			case 'text':
			case 'password':
			case 'number':
				$html .= '<input id="' . esc_attr( $field['id'] ) . '" type="' . $field['type'] . '" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value="' . $data . '"/>' . "\n";
			break;

			case 'text_secret':
				$html .= '<input id="' . esc_attr( $field['id'] ) . '" type="text" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value=""/>' . "\n";
			break;

			case 'textarea':
				$html .= '<textarea id="' . esc_attr( $field['id'] ) . '" rows="5" cols="50" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '">' . $data . '</textarea><br/>'. "\n";
			break;

			case 'checkbox':
				$checked = '';
				if( $option && 'on' == $option ){
					$checked = 'checked="checked"';
				}
				$html .= '<input id="' . esc_attr( $field['id'] ) . '" type="' . $field['type'] . '" name="' . esc_attr( $option_name ) . '" ' . $checked . '/>' . "\n";
			break;

			case 'checkbox_multi':
				foreach( $field['options'] as $k => $v ) {
					$checked = false;
					if( in_array( $k, $data ) ) {
						$checked = true;
					}
					$html .= '<label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="checkbox" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '[]" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label> ';
				}
			break;

			case 'radio':
				foreach( $field['options'] as $k => $v ) {
					$checked = false;
					if( $k == $data ) {
						$checked = true;
					}
					$html .= '<label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="radio" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label> ';
				}
			break;

			case 'select':
				$html .= '<select name="' . esc_attr( $option_name ) . '" id="' . esc_attr( $field['id'] ) . '">';
				foreach( $field['options'] as $k => $v ) {
					$selected = false;
					if( $k == $data ) {
						$selected = true;
					}
					$html .= '<option ' . selected( $selected, true, false ) . ' value="' . esc_attr( $k ) . '">' . $v . '</option>';
				}
				$html .= '</select> ';
			break;

			case 'select_multi':
				$html .= '<select name="' . esc_attr( $option_name ) . '[]" id="' . esc_attr( $field['id'] ) . '" multiple="multiple">';
				foreach( $field['options'] as $k => $v ) {
					$selected = false;
					if( in_array( $k, $data ) ) {
						$selected = true;
					}
					$html .= '<option ' . selected( $selected, true, false ) . ' value="' . esc_attr( $k ) . '" />' . $v . '</label> ';
				}
				$html .= '</select> ';
			break;

			case 'image':
				$image_thumb = '';
				if( $data ) {
					$image_thumb = wp_get_attachment_thumb_url( $data );
				}
				$html .= '<img id="' . esc_attr($option_name) . '_preview" class="image_preview" src="' . esc_url($image_thumb) . '" /><br/>' . "\n";
				$html .= '<input id="' . esc_attr($option_name) . '_button" type="button" data-uploader_title="' . esc_html__( 'Upload an image' , 'exthemes' ) . '" data-uploader_button_text="' . esc_html__( 'Use image' , 'exthemes' ) . '" class="image_upload_button button" value="'. esc_html__( 'Upload new image' , 'exthemes' ) . '" />' . "\n";
				$html .= '<input id="' . esc_attr($option_name) . '_delete" type="button" class="image_delete_button button" value="'. esc_html__( 'Remove image' , 'exthemes' ) . '" />' . "\n";
				$html .= '<input id="' . esc_attr($option_name) . '" class="image_data_field" type="hidden" name="' . esc_attr($option_name) . '" value="' . esc_attr($data) . '"/><br/>' . "\n";
			break;

			case 'color':
				?><div class="color-picker" style="position:relative;">
			        <input type="text" name="<?php esc_attr_e( $option_name ); ?>" class="color" value="<?php esc_attr_e( $data ); ?>" />
			        <div style="position:absolute;background:#FFF;z-index:99;border-radius:100%;" class="colorpicker"></div>
			    </div>
			    <?php
			break;

		}

		switch( $field['type'] ) {

			case 'checkbox_multi':
			case 'radio':
			case 'select_multi':
				$html .= '<br/><span class="description">' . exuntl_esc($field['description'],true) . '</span>';
			break;

			default:
				$html .= '<label for="' . esc_attr( $field['id'] ) . '"><span class="description">' . exuntl_esc($field['description'],true) . '</span></label>' . "\n";
			break;
		}

		echo exuntl_esc($html);
	}

	/**
	 * Validate individual settings field
	 * @param  string $data Inputted value
	 * @return string       Validated value
	 */
	public function validate_field( $data ) {
		if( $data && strlen( $data ) > 0 && $data != '' ) {
			$data = urlencode( strtolower( str_replace( ' ' , '-' , $data ) ) );
		}
		return exuntl_esc($data);
	}

	/**
	 * Load settings page content
	 * @return void
	 */
	public function settings_page() {

		// Build page HTML
		$html = '<div class="wrap" id="ex_plugin_settings">' . "\n";
			$html .= '<h2>' . esc_html__( 'Timeline Settings' , 'exthemes' ) . '</h2>' . "\n";
			$html .= '<form method="post" action="options.php" enctype="multipart/form-data">' . "\n";

				// Setup navigation
				$html .= '<div class="clear"></div>' . "\n";

				// Get settings fields
				ob_start();
				settings_fields( 'plugin_settings' );
				do_settings_sections( 'plugin_settings' );
				$html .= ob_get_clean();

				$html .= '<p class="submit">' . "\n";
					$html .= '<input name="Submit" type="submit" class="button-primary" value="' . esc_attr( esc_html__( 'Save Settings' , 'exthemes' ) ) . '" />' . "\n";
				$html .= '</p>' . "\n";
			$html .= '</form>' . "\n";
		$html .= '</div>' . "\n";

		echo exuntl_esc($html);
	}

}

//Register Meta box
add_action('add_meta_boxes',function (){
	$post_type = get_option('tl_ctdate_posttypes');
	if(is_array($post_type) && !empty ($post_type)){
	    add_meta_box('extl-meta',esc_html__('Custom date','exthemes'),'extl_meta_field_cb',$post_type,'side','high');
	}
});
//Meta callback function
function extl_meta_field_cb($post){
    $cs_meta_val=get_post_meta($post->ID);?>
    <input type="text" style="width:100%;" name="extl_ctdate" value="<?php if( isset ( $cs_meta_val['extl_ctdate'])) echo esc_attr($cs_meta_val['extl_ctdate'][0]) ?>" >
    <?php  
}
//save meta value with save post hook
add_action('save_post',function($post_id){
    if(isset($_POST['extl_ctdate'])){
        update_post_meta($post_id,'extl_ctdate',$_POST['extl_ctdate']);
    }
});
