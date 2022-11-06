<?php
function exun_parse_ct_timeline($atts, $content=''){
	//get parameter
	global $alignment,$class_it,$style,$backgound_parallax;
	$ID = isset($atts['ID']) ? $atts['ID'] : rand(10,9999);
	$heading 		=isset($atts['heading']) ? $atts['heading'] : '';
	$alignment 		=isset($atts['alignment']) ? $atts['alignment'] : 'both-side';
	$timeline_style 		=isset($atts['type']) ? $atts['type'] : get_option('timeline_style');
	$style 		= isset($atts['style']) ? $atts['style'] : 'simple';
	$backgound_parallax 		=isset($atts['backgound_parallax']) ? $atts['backgound_parallax'] : get_option('tl_bgpallarax');
	//display
	ob_start();
	$cl = 'ev-'.$alignment;
	$class_it ='';
	if($alignment=='both-side'){ $class_it = 'ex-md6';}
	echo '
		<div class="custom-timeline list-timeline ex-'.$style.' '.$cl.' '.$timeline_style.' "  style="height:100%;" id="timeline-'.$ID.'">
		<div class="timeline">';
		echo '
			<div class="timeline-row" >';
			echo '
			<h3 class="heading-title">'.$heading.'</h3>
			<div class="timeline-item '.$class_it.' it-o" >
					<div class="date"></div>
					<div>
						<div class="content-ev" >
						<div class="event-title" ><a href="" >';
						if($alignment!='center'){
							echo '<i class="firs fa fa-circle"></i> <i class="seco fa fa-circle"></i> <i class="thir fa fa-circle"></i>';
						}
						echo  '</a></div>
						<div class="event-excerpt" ></div>
						</div>';
						if($alignment =='center'){
							echo '<span class="line"></span>';
								echo '<div class="in-ct"><i class="firs fa fa-circle"></i> <i class="seco fa fa-circle"></i> <i class="thir fa fa-circle"></i></div>';}
						echo '
					</div>
			</div>';
			if($alignment!='center'){
				echo '<span class="line-fix"></span>';
			}
		echo '</div>';
		echo do_shortcode($content);
		echo '</div>';
	echo '</div>';
	//return
	$output_string=ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode( 'timeline_content', 'exun_parse_ct_timeline' );

function exun_parse_ct_timeline_item($atts, $content=''){
	$backgound =isset($atts['background']) ? $atts['background'] : '';
	$link =isset($atts['link']) ? $atts['link'] : '';
	$day =isset($atts['day']) ? $atts['day'] : '';
	$month =isset($atts['month']) ? $atts['month'] : '';
	$year =isset($atts['year']) ? $atts['year'] : '';
	$date_full =isset($atts['date_time']) ? $atts['date_time'] : '';
	$title =isset($atts['title']) ? $atts['title'] : '';
	$tl_viewdetails_text = get_option('tl_viewdetails_text');
	if($tl_viewdetails_text ==''){ $tl_viewdetails_text = 'View Details';}
	global $alignment,$class_it,$style,$backgound_parallax;
	$bg_style = '';
	$image_src = wp_get_attachment_image_src( $backgound,'full' );
	if($style == 'background-image'){
		$bg_style = ' background-image:url('.$image_src[0].');';
	}
	$style_bg ='';	
	if($backgound_parallax=='off'){ $style_bg = "background-attachment: inherit;";}
	if(($year!='')&& ($day!='') && ($month!='')){
		$date_full = $year.'-'.$month.'-'.$day;
		$date_full = new DateTime($date_full);
		$date_format = get_option('date_format');
		$date_full = $date_full->format($date_format);
	}
	ob_start();
			echo '
				<div class="timeline-row" >';
				echo '
				<div class="timeline-item '.$class_it.'" >';
					echo  '
					<div class="item-bd" style="'.$bg_style.' '.$style_bg.'">
					<div class="bg-inner">';
						
						echo '
						<div class="info-details">';
							if($alignment=='center' && $style=='background-image'){
								echo '<div class="al-center" style="'.$bg_style.' '.$style_bg.'">';
							}
							if($style=='background-image' && ($day!='') && ($month!='')){
								echo '<div class="date">';
									if($day!=''){
										echo '<div class="day">'.esc_attr($day).'</div>';
									}if($month!=''){
										echo '<div class="month">'.esc_attr($month).'</div>';
									}if($year!=''){
										echo '<div class="year" style="display:none">'.esc_attr($year).'</div>';
									}
								echo '	
								</div><div class="clear"></div>';
							}
							echo '
							<div class="content-ev" >';
								if($style!='background-image' && $date_full!=''){
										echo '<div class="date">'.$date_full.'</div>';
								}
								if($title!=''){
								echo '
									<div class="event-title" ><a href="'.esc_url($link).'" >'.esc_attr($title).'</a></div>';
								}
								if($style != 'background-image' && isset($image_src[0]) && $image_src[0]!=''){
									echo  '<div class="thumb-item"><img src="'.$image_src[0].'" alt="'.esc_attr($title).'"></div>';
								}
								echo  '
								<div class="meta-item">';
									if($style =='background-image'  && $date_full!=''){
											echo '<span class="full-date"><i class="fa fa-calendar"></i> '.$date_full.'</span>';
									}
									echo'
								</div>';
								echo  '
								<div class="event-excerpt" >'.$content.'</div>';
								if($link!=''){
									echo '
									<div class="read-more-bt">
										<a href="'.esc_url($link).'" >'.$tl_viewdetails_text.' <i class="fa fa-angle-double-right"></i>
										</a>
									</div>';
								}
								echo '
							</div>';
							if($alignment=='center' && $style=='background-image'){
								echo '</div>';
							}
							if($alignment =='center'){
								echo '<span class="line"></span>';
								echo '<div class="in-ct"><i class="firs fa fa-circle"></i> <i class="seco fa fa-circle"></i> <i class="thir fa fa-circle"></i></div>';}
							echo '
						</div>
						</div>
					</div>
				</div>';
				if($alignment!='center'){
					echo '<span class="line-fix"></span> 
					<span class="excicle-icon" >
					 <i class="firs fa fa-circle"></i>
					 <i class="seco fa fa-circle"></i>
					 <i class="thir fa fa-circle"></i>
					</span>';
				}
				echo '
				</div>';
	//return
	$output_string=ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode( 'timeline_content_item', 'exun_parse_ct_timeline_item' );

//Visual Composer
add_action( 'after_setup_theme', 'exun_reg_timeline_content' );
function exun_reg_timeline_content(){
	if(function_exists('vc_map')){
		//parent
		vc_map( array(
			"name" => esc_html__("Timeline Content", "exthemes"),
			"base" => "timeline_content",
			"as_parent" => array('only' => 'timeline_content_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-timeline",
			"params" => array(
				// add params same as with any other content element
				array(
					"admin_label" => true,
					"type" => "textfield",
					"heading" => esc_html__("Heading", "exthemes"),
					"param_name" => "heading",
					"value" => "",
					"description" => esc_html__("", 'exthemes'),
				  ),
				  array(
				  	 "admin_label" => true,
					 "type" => "dropdown",
					 "class" => "",
					 "heading" => esc_html__("Style", "exthemes"),
					 "param_name" => "style",
					 "value" => array(
						esc_html__('Simple', 'exthemes') => '',
						esc_html__('Simple border', 'exthemes') => 'simple-border',
						esc_html__('Simple border no arrow', 'exthemes') => 'simple-border-no',
						esc_html__('Background image', 'exthemes') => 'background-image',
					 ),
					 "description" => esc_html__('Choose style','exthemes')
				  ),
				   array(
				   	 "admin_label" => true,
					 "type" => "dropdown",
					 "class" => "",
					 "heading" => esc_html__("Alignment", "exthemes"),
					 "param_name" => "alignment",
					 "value" => array(
						esc_html__('Both Alignment', 'exthemes') => 'both-side',
						esc_html__('Left Alignment', 'exthemes') => 'left',
						esc_html__('Right Alignment', 'exthemes') => 'right',
						esc_html__('Center Alignment', 'exthemes') => 'center',
					 ),
					 "description" => esc_html__('Choose style','exthemes')
				  ),
			),
			"js_view" => 'VcColumnView'
		) );
		
		//child
		vc_map( array(
			"name" => esc_html__("Timeline Item", "exthemes"),
			"base" => "timeline_content_item",
			"content_element" => true,
			"as_child" => array('only' => 'timeline_content_item'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"icon" => "icon-testimonial-item",
			"params" => array(
				array(
					"admin_label" => true,
					"type" => "textfield",
					"heading" => esc_html__("Title", "exthemes"),
					"param_name" => "title",
					"value" => "",
					"description" => '',
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Background", "exthemes"),
					"param_name" => "background",
					"value" => "",
					"description" => esc_html__("", "exthemes"),
				  ),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Content", "exthemes"),
					"param_name" => "content",
					"value" => "",
					"description" => '',
				),
				array(
					"admin_label" => true,
					"type" => "textfield",
					"heading" => esc_html__("Date time", "exthemes"),
					"param_name" => "date_time",
					"value" => "",
					"description" => '',
				),
				array(
					"admin_label" => true,
					"type" => "textfield",
					"heading" => esc_html__("Link view more", "exthemes"),
					"param_name" => "link",
					"value" => "",
					"description" => '',
				),
			)
		) );
		
	}
	if(class_exists('WPBakeryShortCode') && class_exists('WPBakeryShortCodesContainer')){
	class WPBakeryShortCode_timeline_content extends WPBakeryShortCodesContainer{}
	class WPBakeryShortCode_timeline_content_item extends WPBakeryShortCode{}
	}
}