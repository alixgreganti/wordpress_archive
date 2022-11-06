;(function($){
	'use strict';
	jQuery(document).ready(function($) {
		//subscribe ajax
		$('.loadmore-timeline').on('click', this, function() {
			var id_crsc  		= $(this).data('id');
			var n_page = $('#'+id_crsc+' input[name=num_page_uu]').val();
			$('#'+id_crsc+' .loadmore-timeline').addClass("loading");
			$('#'+id_crsc+' .loadmore-timeline i').addClass("fa-spin");
			var param_query  		= $('#'+id_crsc+' input[name=param_query]').val();
			var page  		= $('#'+id_crsc+' input[name=current_page]').val();
			var num_page  		= $('#'+id_crsc+' input[name=num_page]').val();
			var param_shortcode  		= $('#'+id_crsc+' input[name=param_shortcode]').val();
				var param = {
					action: 'ex_loadmore_timeline',
					param_query: param_query,
					page: page*1+1,
					param_shortcode: param_shortcode,
				};
				$.ajax({
					type: "post",
					url: loadmore_ajax.ajaxurl,
					dataType: 'html',
					data: (param),
					success: function(data){
						if(data != '0')
						{
							n_page = n_page*1+1;
							$('#'+id_crsc+' input[name=num_page_uu]').val(n_page)
							if(data == ''){ 
								$('#'+id_crsc+' .loadmore-timeline').remove();
								$('#'+id_crsc+' .timeline-row.empty').remove();
							}
							else{
								$('#'+id_crsc+' input[name=current_page]').val(page*1+1);
								$('#'+id_crsc+' .loadmore-timeline').removeClass("loading");
								$('#'+id_crsc+' .loadmore-timeline i').removeClass("fa-spin");
								$('#'+id_crsc+' .timeline-row.empty').remove();
								$('#'+id_crsc+' .timeline').append(data);
							}
							if(n_page == num_page){
								$('#'+id_crsc+' .loadmore-timeline').remove();
								$('#'+id_crsc+' .timeline-row.empty').remove();
							}
						}else{$('.timeline-row.loadmore').html('error');}
					}
				});
		});

	});
}(jQuery));