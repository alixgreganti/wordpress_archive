<?php
function exuntl_parse_timeline_func($atts, $content){
	$ID = isset($atts['ID']) ? $atts['ID'] : rand(10,9999);
	$heading 		=isset($atts['heading']) ? $atts['heading'] : '';
	$alignment 		=isset($atts['alignment']) ? $atts['alignment'] : 'both-side';
	$posttype 		= isset($atts['post_type']) ? $atts['post_type'] : 'post';
	$timeline_style 		=isset($atts['type']) ? $atts['type'] : get_option('timeline_style');
	$style 		=isset($atts['style']) ? $atts['style'] : 'simple';
	$backgound_parallax 		=isset($atts['backgound_parallax']) ? $atts['backgound_parallax'] : get_option('tl_bgpallarax');
	$date_st 	= isset($atts['date']) ? $atts['date'] : '';
	$count 		= isset($atts['count']) ? $atts['count'] : '6';
	$per_page 		= isset($atts['posts_per_page']) ? $atts['posts_per_page'] : '';
	$order 	= isset($atts['order']) ? $atts['order'] : '';
	$orderby 	= isset($atts['orderby']) ? $atts['orderby'] : '';
	$meta_key 	= isset($atts['meta_key']) ? $atts['meta_key'] : '';
	$taxonomy 		= isset($atts['taxonomy']) ? $atts['taxonomy'] : '';
	if($taxonomy==''){
		$taxonomy 		= isset($atts['texonomy']) ? $atts['texonomy'] : '';
	}
	$cat 		=isset($atts['cat']) ? $atts['cat'] : '';
	$tag 	= isset($atts['tag']) ? $atts['tag'] : '';
	$ids 		= isset($atts['ids']) ? $atts['ids'] : '';
	$exclude 	= isset($atts['exclude']) ? $atts['exclude'] : '';
	$ignore 	= isset($atts['ignore']) ? $atts['ignore'] : '';
	$meta_startdt 	= isset($atts['start_date']) ? $atts['start_date'] : '';
	$meta_enddt 	= isset($atts['end_date']) ? $atts['end_date'] : '';
	$hide_thumb 	= isset($atts['hide_thumb']) ? $atts['hide_thumb'] : '';
	$hide_share 	= isset($atts['hide_share']) ? $atts['hide_share'] : '';
	$hide_date 	= isset($atts['hide_date']) ? $atts['hide_date'] : '';
	$hide_time 	= isset($atts['hide_time']) ? $atts['hide_time'] : '';
	$time_since 	= isset($atts['time_since']) ? $atts['time_since'] : '';
	$meta_date 	= isset($atts['meta_date']) ? $atts['meta_date'] : '';
	if($per_page =="" || ($per_page > $count && $count!='-1')){$per_page = $count;}
	$page ='';
	$args = exun_tlquery($posttype, $date_st, $per_page, $page, $order, $orderby, $meta_key, $taxonomy, $cat, $tag, $ids, $exclude, $meta_startdt, $meta_enddt);	
	$cl = 'ev-'.$alignment;
	$tl_load_text = get_option('tl_load_text');
	if($tl_load_text ==''){ $tl_load_text = 'Load More';}
	$tl_viewdetails_text = get_option('tl_viewdetails_text');
	if($tl_viewdetails_text ==''){ $tl_viewdetails_text = 'View Details';}
	$tl_timeago_text = get_option('tl_timeago_text');
	if($tl_timeago_text ==''){ $tl_timeago_text = 'ago';}
	$tl_comment_text = get_option('tl_comment_text');
	if($tl_comment_text ==''){ $tl_comment_text = ' Comments';}
	$tl_by_text = get_option('tl_by_text');
	if($tl_by_text ==''){ $tl_by_text = 'By ';}
	ob_start();
	$class_it ='';
	if($alignment=='both-side'){ $class_it = 'ex-md6';}
	echo '
		<div class="list-timeline ex-'.esc_attr($style.' '.$cl.' '.$timeline_style).' "  style="height:100%;" id="timeline-'.esc_attr($ID).'">';?>
		<div class="timeline">
    <?php
	$style_bg ='';	
	if($backgound_parallax=='off'){ $style_bg = "background-attachment: inherit;";}
	$tl_thumbname = 'thumb_9999x368';
	$tl_thumbsize = get_option('tl_thumbsize');
	$arr_sc = explode("x",$tl_thumbsize);
	if(count($arr_sc) ==2){
		$tl_thumbname = 'thumb_'.$tl_thumbsize;
	}
	$tl_number_exceprt = get_option('tl_number_exceprt');
	$the_query = new WP_Query( $args );
	$it = $the_query->found_posts;
	if($it > $count && $count!='-1'){ $it = $count;}
	elseif($it < $count && $count=='-1'){ $count = $it;}
	$num_pg = floor($it/$per_page);
	if($the_query->have_posts()){
			echo '
				<div class="timeline-row" >
				<h3 class="heading-title">'.wp_kses_post($heading).'</h3>
				<div class="timeline-item '.esc_attr($class_it).' it-o" >
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
								echo '
								<span class="line"></span>
								<div class="in-ct"><i class="firs fa fa-circle"></i> <i class="seco fa fa-circle"></i> <i class="thir fa fa-circle"></i></div>';}
							echo '
						</div>
				</div>';
				if($alignment!='center'){
					echo '<span class="line-fix"></span>';
				}
				echo '</div>';
		$pt_ctdate = get_option('tl_ctdate_posttypes');		
		while($the_query->have_posts()){ $the_query->the_post();
			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
			$bg_style = '';
			if($style == 'background-image' && isset($image_src[0])){
				$bg_style = ' background-image:url('.$image_src[0].');';
			}
			if($posttype!='event'){
				$cate_name = get_the_category_list(', ', '', '');
				$tag_name = get_the_tag_list(esc_html__('Tags: ','exthemes'), ', ', '');
				$date_id = get_the_date( get_option( 'date_format' ) );
				$time_id = get_the_date( get_option( 'time_format' ) );
				if($meta_date!=''){
					$date_id = get_post_meta(get_the_ID(),$meta_date, true );
				}
			}else{
				$startdate = get_post_meta(get_the_ID(),'startdate_date', true );
				$starttime = get_post_meta(get_the_ID(),'starttime_time', true );
				if($startdate){
					$date_id = date(get_option( 'date_format' ), strtotime($startdate));
					$time_id = date(get_option( 'time_format' ), strtotime($starttime));
				}
			}
			echo '
				<div class="timeline-row" >
				<div class="timeline-item '.esc_attr($class_it).'" >';
					echo  '
					<div class="item-bd" style="'.esc_attr($bg_style.' '.$style_bg).'">
					<div class="bg-inner">';
						
						echo '
						<div class="info-details">';
							if($alignment=='center' && $style=='background-image'){
								echo '<div class="al-center" style="'.esc_attr($bg_style.' '.$style_bg).'">';
							}
							if($style=='background-image' && $hide_date!='1'){
								if(is_array($pt_ctdate) && !empty($pt_ctdate) && in_array( get_post_type(),$pt_ctdate)){
									echo '<div class="date ct-date">';
										echo '<div class="month">'.wp_kses_post(get_post_meta(get_the_ID(),'extl_ctdate',true)).'</div>';
									echo '</div>';
								}else{							
									echo '
									<div class="date">
									<div class="day">'.date_i18n( 'd', strtotime( $date_id ) ).'</div>
									<div class="month">'.date_i18n( 'M', strtotime( $date_id ) ).'</div>
									</div>';
								}
								echo '
								<div class="clear"></div>';
							}
							echo '
							<div class="content-ev" >';
								if($style!='background-image' && $hide_date!='1'){
									if(is_array($pt_ctdate) && !empty($pt_ctdate) && in_array( get_post_type(),$pt_ctdate)){
										echo '<div class="date">'.wp_kses_post(get_post_meta(get_the_ID(),'extl_ctdate',true)).'</div>';
									}else{
										if(($posttype=='' || $posttype=='post') && $time_since =='1'){
											echo '<div class="date">'.wp_kses_post(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' '.$tl_timeago_text).'</div>';
										}else{
											$dt_cl ='';
											if($hide_time!='1' && $hide_date!='1'){$dt_cl = 'time-date';}
											echo '<div class="date '.esc_attr($dt_cl).'">';
											if($hide_date!='1'){ 
												echo esc_html($date_id);
											}if($hide_time!='1'){
												echo ' - '.esc_html($time_id);
											}
											echo '</div>';
										}
									}
								}
								echo '
								<div class="event-title" ><a href="'.get_permalink().'" >';
								echo  get_the_title().'</a></div>';
								if(($hide_thumb == '1' && $style != 'background-image') && has_post_thumbnail()){
									echo  '<div class="thumb-item">'.get_the_post_thumbnail(get_the_ID(),$tl_thumbname).'</div>';
								}
								echo  '
								<div class="meta-item">';
									if($style =='background-image' && $hide_date!='1'){
										if(is_array($pt_ctdate) && !empty($pt_ctdate) && in_array( get_post_type(),$pt_ctdate)){
											echo '<span class="full-date"><i class="fa fa-calendar"></i>'.wp_kses_post(get_post_meta(get_the_ID(),'extl_ctdate',true)).'</span>';
										}else{
											if(($posttype=='' || $posttype=='post') && $time_since =='1'){
												echo '
												<span class="full-date"><i class="fa fa-calendar"></i> '.human_time_diff( get_the_time('U'), current_time('timestamp') ) .  ' '.$tl_timeago_text.'</span>';
											}elseif($hide_date!='1' || $hide_time!='1' ){
												echo '<span class="full-date"><i class="fa fa-calendar"></i> ';
												if($hide_date!='1'){ 
													echo esc_html($date_id);
												}if($hide_time!='1'){
													echo  ' - '.esc_html($time_id);
												}
												echo '</span>';
											}
										}
									}
									echo'
									<span class="author"><i class="fa fa-user"></i> '.$tl_by_text.''.get_the_author_link().'</span>';
									if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ){	
									echo '
									<span class="comment"><a href="'.esc_url(get_comments_link()).'"><i class="fa fa-comments"></i> '.wp_kses_post(get_comments_number(get_the_ID()).$tl_comment_text).'</a></span>';
									}
									if($cate_name!=''){
										echo '
										<span class="category" style="display:none"><i class="fa fa-folder-open"></i> '.wp_kses_post($cate_name).'</span>';
									}
									echo '
									<span class="tag" style="display:none"><i class="fa fa-tags"></i> '.wp_kses_post($tag_name).'</span>
									
								</div>';
								$excerpt = get_the_excerpt();
								if($tl_number_exceprt!='' && is_numeric($tl_number_exceprt)){
									$excerpt = wp_trim_words(get_the_excerpt(),$tl_number_exceprt);
								}
								echo  '
								<div class="event-excerpt" >'.wp_kses_post($excerpt).'</div>';
								if($hide_share!='1'){
									echo  exun_tlsocial_share();
								}
								echo '
								<div class="read-more-bt"><a href="'.esc_url(get_permalink()).'" >'.wp_kses_post($tl_viewdetails_text).' <i class="fa fa-angle-double-right"></i></a></div>
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
				echo '</div>';
			}
			if($per_page<$count){
				echo '<div class="timeline-row empty" ></div>';
			}
	}
	echo'</div>';
	if($per_page<$count){
		echo '
			  <div class="timeline-row loadmore" >
			  <input type="hidden"  name="id_timeline" value="timeline-'.esc_attr($ID).'">
			  <input type="hidden"  name="num_page" value="'.esc_attr($num_pg).'">
			  <input type="hidden"  name="num_page_uu" value="0">
			  <input type="hidden"  name="current_page" value="1">
			  <input type="hidden"  name="param_query" value="'.esc_attr(str_replace('\/', '/', json_encode($args))).'">
			  <input type="hidden" id="param_shortcode" name="param_shortcode" value="'.esc_attr(str_replace('\/', '/', json_encode($atts))).'">
			  <a  href="javascript:void(0)" class="loadmore-timeline" data-id="timeline-'.esc_attr($ID).'">
					<span class="load-tltext">'.wp_kses_post($tl_load_text).'</span><span></span>&nbsp;<span></span>&nbsp;<span></span>
			  </a>';
		echo'</div>';
	}
	echo '
	</div>
	';	
	wp_reset_postdata();
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;

}
add_shortcode( 'unlimited-timeline', 'exuntl_parse_timeline_func' );

add_action( 'after_setup_theme', 'exuntl_reg_vc',999 );
function exuntl_reg_vc(){
	if(function_exists('vc_map')){
	vc_map( array(
	   "name" => esc_html__("Timeline", "exthemes"),
	   "base" => "unlimited-timeline",
	   "class" => "",
	   "icon" => "icon-timeline",
	   "controls" => "full",
	   "category" => esc_html__('Content'),
	   "params" => array(
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
			 "type" => "textfield",
			 "heading" => esc_html__("Post Type", "exthemes"),
			 "param_name" => "post_type",
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
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("IDs", "exthemes"),
			"param_name" => "ids",
			"value" => "",
			"description" => esc_html__("Specify post IDs to retrieve", "exthemes"),
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Start Date", "exthemes"),
			"param_name" => "start_date",
			"value" => "",
			"description" => esc_html__("month/day/year", "exthemes"),
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("End Date", "exthemes"),
			"param_name" => "end_date",
			"value" => "",
			"description" => esc_html__("month/day/year", "exthemes"),
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Count", "exthemes"),
			"param_name" => "count",
			"value" => "",
			"description" => esc_html__("Number of posts", 'exthemes'),
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Posts per page", "exthemes"),
			"param_name" => "posts_per_page",
			"value" => "",
			"description" => esc_html__("Number items per page", 'exthemes'),
		  ),

		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Exclude ", "exthemes"),
			"param_name" => "exclude ",
			"value" => "",
			"description" => esc_html__("list of ignore IDs", "exthemes"),
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Category", "exthemes"),
			"param_name" => "cat",
			"value" => "",
			"description" => esc_html__("List of cat ID (or slug), separated by a comma", "exthemes"),
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Tags", "exthemes"),
			"param_name" => "tag",
			"value" => "",
			"description" => esc_html__("list of tags, separated by a comma", "exthemes"),
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Custom Texonomy", "exthemes"),
			"param_name" => "taxonomy",
			"value" => "",
			"description" => esc_html__("Name of custom taxonomy", "exthemes"),
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Order", 'exthemes'),
			 "param_name" => "order",
			 "value" => array(
			 	esc_html__('DESC', 'exthemes') => 'DESC',
				esc_html__('ASC', 'exthemes') => 'ASC',
			 ),
			 "description" => ''
		  ),
		  array(
		  	 "admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Order by", 'exthemes'),
			 "param_name" => "orderby",
			 "value" => array(
			 	esc_html__('Date', 'exthemes') => 'date',
				esc_html__('ID', 'exthemes') => 'ID',
				esc_html__('Author', 'exthemes') => 'author',
			 	esc_html__('Title', 'exthemes') => 'title',
				esc_html__('Name', 'exthemes') => 'name',
				esc_html__('Modified', 'exthemes') => 'modified',
			 	esc_html__('Parent', 'exthemes') => 'parent',
				esc_html__('Random', 'exthemes') => 'rand',
				esc_html__('Comment count', 'exthemes') => 'comment_count',
				esc_html__('Menu order', 'exthemes') => 'menu_order',
				esc_html__('Meta value', 'exthemes') => 'meta_value',
				esc_html__('Meta value num', 'exthemes') => 'meta_value_num',
				esc_html__('Post__in', 'exthemes') => 'post__in',
				esc_html__('None', 'exthemes') => 'none',
			 ),
			 "description" => ''
		  ),
		  array(
		  	 "admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Hide thumbnails", 'exthemes'),
			 "param_name" => "hide_thumb",
			 "value" => array(
			 	esc_html__('Yes', 'exthemes') => '',
				esc_html__('No', 'exthemes') => '1',
			 ),
			 "description" => ''
		  ),
		  array(
		  	 "admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Hide share button", 'exthemes'),
			 "param_name" => "hide_share",
			 "value" => array(
			 	esc_html__('No', 'exthemes') => '',
				esc_html__('Yes', 'exthemes') => '1',
			 ),
			 "description" => ''
		  ),
		  array(
		  	 "admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Time since", 'exthemes'),
			 "param_name" => "time_since",
			 "value" => array(
			 	esc_html__('No', 'exthemes') => '',
				esc_html__('Yes', 'exthemes') => '1',
			 ),
			 "description" => ''
		  ),
		  array(
		  	 "admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Hide Date", 'exthemes'),
			 "param_name" => "hide_date",
			 "value" => array(
			 	esc_html__('No', 'exthemes') => '',
				esc_html__('Yes', 'exthemes') => '1',
			 ),
			 "description" => ''
		  ),
		  array(
		  	 "admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Hide Time on Date", 'exthemes'),
			 "param_name" => "hide_time",
			 "value" => array(
			 	esc_html__('No', 'exthemes') => '',
				esc_html__('Yes', 'exthemes') => '1',
			 ),
			 "description" => ''
		  ),
	   )
	));
	}
}