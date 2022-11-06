// JavaScript Document
;(function($){
	'use strict';
	(function() {
	    tinymce.PluginManager.add('ex_timeline_ct_bt', function(editor, url) {
			editor.addButton('ex_timeline_ct_bt', {
				text: '',
				tooltip: 'Timeline Content',
				id: 'ex_timeline_ct_bt_id',
				icon: 'icon-timeline',
				onclick: function() {
					// Open window
					editor.windowManager.open({
						title: 'Timeline Content',
						body: [
							{type: 'textbox', name: 'number', label: 'Number of Timeline'},
							{type: 'textbox', name: 'heading', label: 'Heading'},
							{type: 'listbox',
								name: 'style',
								label: 'Style',
								'values': [
									{text: 'Simple', value: 'simple'},
									{text: 'Simple border', value: 'simple-border'},
									{text: 'Simple border no arrow', value: 'simple-border-no'},
									{text: 'Background image', value: 'background-image'},
								]
							},
							{type: 'listbox',
								name: 'alignment',
								label: 'Alignment',
								'values': [
									{text: 'Both Alignment', value: 'both-side'},
									{text: 'Left Alignment', value: 'left'},
									{text: 'Right Alignment', value: 'right'},
									{text: 'Center Alignment', value: 'center'},
								]
							},
						],
						onsubmit: function(e) {
							var uID =  Math.floor((Math.random()*100)+1);
							var number = e.data.number?e.data.number:2;
							var shortcode_output ='[timeline_content heading="'+e.data.heading+'" style="'+e.data.style+'"  alignment="'+e.data.alignment+'"]';
							for(i=0; i<number; i++){
								shortcode_output +='[timeline_content_item title="Timeline item" sub_title="sub title" background="" date_time="" link="#" ]This is my timeline item content [/timeline_content_item]';
							}
							shortcode_output +='[/timeline_content]';
							// Insert content when the window form is submitted
							editor.insertContent(shortcode_output+'<br class="nc"/>');
						}
					});
				}
			});
		});
	})();
}(jQuery));