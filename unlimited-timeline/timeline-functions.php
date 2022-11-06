<?php
if(!function_exists('exun_tlquery')){
	function exun_tlquery($posttype, $date_st, $count, $page, $order, $orderby, $meta_key, $texonomy, $cat, $tag, $ids, $exclude, $meta_startdt, $meta_enddt){
		if($ids!=''){ //specify IDs
			$ids = explode(",", $ids);
			$args = array(
				'post_type' => $posttype,
				'posts_per_page' => $count,
				'post_status' => 'publish',
				'post__in' =>  $ids,
				'order' => $order,
				'orderby' => $orderby,
				'meta_key' => $meta_key,
				'ignore_sticky_posts' => 1,
			);
		}elseif($ids==''){
			$args = array(
				'post_type' => $posttype,
				'posts_per_page' => $count,
				'post_status' => 'publish',
				'tag' => $tag,
				'order' => $order,
				'orderby' => $orderby,
				'meta_key' => $meta_key,
				'post__not_in' => $exclude,
				'ignore_sticky_posts' => 1,
			);
			if(!is_array($cat) && $texonomy =='') {
				$cats = explode(",",$cat);
				if(is_numeric($cats[0])){
					$args['category__in'] = $cats;
				}else{			 
					$args['category_name'] = $cat;
				}
			}elseif(count($cat) > 0 && $texonomy ==''){
				$args['category__in'] = $cat;
			}
			
			
			if($date_st){
				$date_st = date('m/d/Y', strtotime($date_st));
			}

			if($texonomy !='' && $tag!=''){
				$tags = explode(",",$tag);
				if(is_numeric($tags[0])){$field_tag = 'term_id'; }
				else{ $field_tag = 'slug'; }
				if(count($tags)>1){
					  $texo = array(
						  'relation' => 'OR',
					  );
					  foreach($tags as $iterm) {
						  $texo[] = 
							  array(
								  'taxonomy' => $texonomy,
								  'field' => $field_tag,
								  'terms' => $iterm,
							  );
					  }
				  }else{
					  $texo = array(
						  array(
								  'taxonomy' => $texonomy,
								  'field' => $field_tag,
								  'terms' => $tags,
							  )
					  );
				}
			}
			//cats
			if($texonomy !='' && $cat!=''){
				$cats = explode(",",$cat);
				if(is_numeric($cats[0])){$field = 'term_id'; }
				else{ $field = 'slug'; }
				if(count($cats)>1){
					  $texo = array(
						  'relation' => 'OR',
					  );
					  foreach($cats as $iterm) {
						  $texo[] = 
							  array(
								  'taxonomy' => $texonomy,
								  'field' => $field,
								  'terms' => $iterm,
							  );
					  }
				  }else{
					  $texo = array(
						  array(
								  'taxonomy' => $texonomy,
								  'field' => $field,
								  'terms' => $cats,
							  )
					  );
				}
			}
			if(isset($texo)){
				$args += array('tax_query' => $texo);
			}
			
			if($meta_startdt){
				$args['date_query']['after'] = $meta_startdt;
			}
			if($meta_enddt){
				$args['date_query']['before'] = $meta_enddt;
			}
			
			if($date_st!=''){
				$time_now = strtotime($date_st);
			}else{
				$time_now =  strtotime("now");
			}
			$time_now =  strtotime("now");
			if($posttype=='tribe_events'){
				if($type=='upcoming'){
					$args['eventDisplay'] = 'upcoming';
				}elseif($type=='recent'){
					$args['eventDisplay'] = 'past';
				}elseif($type=='custom'){
					if($start_date){
						$args['start_date'] = $start_date;
					}
					if($end_date){
						$args['end_date'] = $end_date;
					}
				}
			}elseif($meta_startdt !=''){
				if($orderby=='upcoming'){
					if($order==''){$order='ASC';}
					$args += array('meta_key' => $meta_startdt, 'meta_value' => $time_now, 'meta_compare' => '>','orderby' => 'meta_value_num', 'order' => $order);
				}elseif($orderby=='recent'){
					if($order==''){$order='DESC';}
					$args += array('meta_key' => $meta_startdt, 'meta_value' => $time_now, 'meta_compare' => '<','orderby' => 'meta_value_num', 'order' => $order);
				}
			}
		}	
		if(isset($page) && $page!=''){
			$args['paged'] = $page;
		}
		//echo "<pre>";
		//print_r($args);exit;
		return $args;
	}
}
if(!function_exists('exun_tlsocial_share')){
	function exun_tlsocial_share( $id = false){
		$id = get_the_ID();
		$tl_share_button = get_option('tl_share_button');
		ob_start();
		if(is_array($tl_share_button) && !empty($tl_share_button)){
			?>
			<ul class="social-share-timeline">
				<?php if(in_array('fb', $tl_share_button)){ ?>
					<li class="facebook">
						<a class="trasition-all" title="<?php esc_html_e('Share on Facebook','exthemes');?>" href="#" target="_blank" rel="nofollow" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+'<?php echo urlencode(get_permalink($id)); ?>','facebook-share-dialog','width=626,height=436');return false;"><i class="fa fa-facebook"></i>
						</a>
					</li>
				<?php }
	
				if(in_array('tw', $tl_share_button)){ ?>
					<li class="twitter">
						<a class="trasition-all" href="#" title="<?php esc_html_e('Share on Twitter','exthemes');?>" rel="nofollow" target="_blank" onclick="window.open('http://twitter.com/share?text=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>&amp;url=<?php echo urlencode(get_permalink($id)); ?>','twitter-share-dialog','width=626,height=436');return false;"><i class="fa fa-twitter"></i>
						</a>
					</li>
				<?php }
	
				if(in_array('li', $tl_share_button)){ ?>
						<li class="linkedin">
							<a class="trasition-all" href="#" title="<?php esc_html_e('Share on LinkedIn','exthemes');?>" rel="nofollow" target="_blank" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink($id)); ?>&amp;title=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>&amp;source=<?php echo urlencode(get_bloginfo('name')); ?>','linkedin-share-dialog','width=626,height=436');return false;"><i class="fa fa-linkedin"></i>
							</a>
						</li>
				<?php }
	
				if(in_array('tb', $tl_share_button)){ ?>
					<li class="tumblr">
					   <a class="trasition-all" href="#" title="<?php esc_html_e('Share on Tumblr','exthemes');?>" rel="nofollow" target="_blank" onclick="window.open('http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink($id)); ?>&amp;name=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>','tumblr-share-dialog','width=626,height=436');return false;"><i class="fa fa-tumblr"></i>
					   </a>
					</li>
				<?php }
	
				if(in_array('gg', $tl_share_button)){ ?>
					 <li class="google-plus">
						<a class="trasition-all" href="#" title="<?php esc_html_e('Share on Google Plus','exthemes');?>" rel="nofollow" target="_blank" onclick="window.open('https://plus.google.com/share?url=<?php echo urlencode(get_permalink($id)); ?>','googleplus-share-dialog','width=626,height=436');return false;"><i class="fa fa-google-plus"></i>
						</a>
					 </li>
				 <?php }
	
				 if(in_array('pin', $tl_share_button)){ ?>
					 <li class="pinterest">
						<a class="trasition-all" href="#" title="<?php esc_html_e('Pin this','exthemes');?>" rel="nofollow" target="_blank" onclick="window.open('//pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($id)) ?>&amp;media=<?php echo urlencode(wp_get_attachment_url( get_post_thumbnail_id($id))); ?>&amp;description=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>','pin-share-dialog','width=626,height=436');return false;"><i class="fa fa-pinterest"></i>
						</a>
					 </li>
				 <?php }
				 
				 if(in_array('vk', $tl_share_button)){ ?>
					 <li class="vk">
						<a class="trasition-all" href="#" title="<?php esc_html_e('Share on VK','exthemes');?>" rel="nofollow" target="_blank" onclick="window.open('//vkontakte.ru/share.php?url=<?php echo urlencode(get_permalink(get_the_ID())); ?>','vk-share-dialog','width=626,height=436');return false;"><i class="fa fa-vk"></i>
						</a>
					 </li>
				 <?php }
	
				 if(in_array('em', $tl_share_button)){ ?>
					<li class="email">
						<a class="trasition-all" href="mailto:?subject=<?php echo urlencode(html_entity_decode(get_the_title($id), ENT_COMPAT, 'UTF-8')); ?>&amp;body=<?php echo urlencode(get_permalink($id)) ?>" title="<?php esc_html_e('Email this','exthemes');?>"><i class="fa fa-envelope"></i>
						</a>
					</li>
				<?php }?>
			</ul>
			<?php
		}
		$output_string = ob_get_contents();
		ob_end_clean();
		return $output_string;
	}
}
add_action( 'wp_ajax_ex_loadmore_timeline', 'exun_tl_ajaxloadmore_timeline' );
add_action( 'wp_ajax_nopriv_ex_loadmore_timeline', 'exun_tl_ajaxloadmore_timeline' );
function exun_tl_ajaxloadmore_timeline(){
	$atts = json_decode( stripslashes( $_POST['param_shortcode'] ), true );
	$posttype 		= isset($atts['post_type']) ? $atts['post_type'] : 'post';
	$alignment 		=isset($atts['alignment']) ? $atts['alignment'] : 'both-side';
	$type 		=isset($atts['type']) ? $atts['type'] : '';
	$style 		=isset($atts['style']) ? $atts['style'] : 'simple';
	$count 		= isset($atts['count']) ? $atts['count'] : '6';
	$per_page 		= isset($atts['posts_per_page']) ? $atts['posts_per_page'] : '';
	$backgound_parallax 		=isset($atts['backgound_parallax']) ? $atts['backgound_parallax'] : '';
	$hide_thumb 	= isset($atts['hide_thumb']) ? $atts['hide_thumb'] : '';
	$hide_share 	= isset($atts['hide_share']) ? $atts['hide_share'] : '';
	$time_since 	= isset($atts['time_since']) ? $atts['time_since'] : '';
	
	$hide_date 	= isset($atts['hide_date']) ? $atts['hide_date'] : '';
	$hide_time 	= isset($atts['hide_time']) ? $atts['hide_time'] : '';
	$meta_date 	= isset($atts['meta_date']) ? $atts['meta_date'] : '';
	$page = $_POST['page'];
	$param_query = json_decode( stripslashes( $_POST['param_query'] ), true );
	$end_it_nb ='';
	if($page!=''){ 
		$param_query['paged'] = $page;
		$count_check = $page*$per_page;
		if(($count_check > $count) && (($count_check - $count)< $per_page)){$end_it_nb = $count - (($page - 1)*$per_page);}
		else if(($count_check > $count)) {die;}
	}
	$style_bg ='';	
	if($backgound_parallax=='off'){ $style_bg = "background-attachment: inherit;";}
	$tl_thumbname = 'thumb_9999x368';
	$tl_thumbsize = get_option('tl_thumbsize');
	$arr_sc = explode("x",$tl_thumbsize);
	if(count($arr_sc) ==2){
		$tl_thumbname = 'thumb_'.$tl_thumbsize;
	}
	$class_it ='';
	if($alignment=='both-side'){ $class_it = 'ex-md6';}
	$the_query = new WP_Query( $param_query );
	$it = $the_query->post_count;
	$tl_load_icon = get_option('tl_load_icon');
	if($tl_load_icon ==''){ $tl_load_icon = 'fa-retweet';}
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
	if($the_query->have_posts()){
		$i =0;
		$pt_ctdate = get_option('tl_ctdate_posttypes');	
		while($the_query->have_posts()){ $the_query->the_post();
			$i++;
			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'thumbname' );
			$bg_style ='';
			if($style == 'background-image'){
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
				<div class="timeline-item '.esc_attr($class_it).' '.esc_attr($end_it_nb).'" >';
					echo  '
					<div class="item-bd" style="'.esc_attr($bg_style).' '.esc_attr($style_bg).'">
					<div class="bg-inner">';
						echo '
						<div class="info-details">';
							if($alignment=='center' && $style=='background-image'){
								echo '<div class="al-center" style="'.esc_attr($bg_style).' '.esc_attr($style_bg).'">';
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
								if($style!='background-image'){
									if(is_array($pt_ctdate) && !empty($pt_ctdate) && in_array( get_post_type(),$pt_ctdate)){
										echo '<div class="date">'.get_post_meta(get_the_ID(),'extl_ctdate',true).'</div>';
									}else{
										if(($posttype=='' || $posttype=='post') && $time_since =='1' && $hide_date!='1'){
											echo '<div class="date">'.human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' '.$tl_timeago_text.'</div>';
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
								<div class="event-title" ><a href="'.esc_url(get_permalink()).'" >';
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
												echo '<span class="full-date"><i class="fa fa-calendar"></i> '.human_time_diff( get_the_time('U'), current_time('timestamp') ) .  ' '.$tl_timeago_text.'</span>';
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
									<span class="author"><i class="fa fa-user"></i> '.wp_kses_post($tl_by_text).''.get_the_author_link().'</span>';
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
								echo  '
								<div class="event-excerpt" >'.wp_kses_post(get_the_excerpt()).'</div>';
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
				if($end_it_nb!='' && $end_it_nb == $i){break;}
			}
			echo '<div class="timeline-row empty" ></div>';	
	}
	$html = ob_get_clean();
	echo  $html;
	die;
}
function exuntl_esc($content,$escape=false){
	if(isset($escape) && $escape == true){
		$content = wp_kses_post($content);
	}
	return $content;
}