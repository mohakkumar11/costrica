<?php
if ( function_exists('add_shortcode_param')){
	add_shortcode_param('iw_icon' , 'iw_icon_render_param' );
	add_shortcode_param('iw_number' , 'iw_number_render_param' );
}
// create icon style attribute
if(!function_exists("iw_icon_render_param")){
	function iw_icon_render_param($settings, $value)
	{
		$dependency = vc_generate_dependencies_attributes($settings);
		$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
		$type = isset($settings['type']) ? $settings['type'] : '';
		$class = isset($settings['class']) ? $settings['class'] : '';
		$icons = array('no-icon','android','apple','bitbucket','bitbucket-square','bitcoin','btc','css3','dribbble','dropbox','facebook','facebook-square','flickr','foursquare','github','github-alt','github-square','gittip','google-plus','google-plus-square','html5','instagram','linkedin','linkedin-square','linux','maxcdn','pagelines','pinterest','pinterest-square','renren','skype','stack-exchange','stack-overflow','trello','tumblr','tumblr-square','twitter','twitter-square','vimeo-square','vk','weibo','windows','xing','xing-square','youtube','youtube-play','youtube-square','arrows-alt','backward','compress','eject','expand','fast-backward','fast-forward','forward','pause','play','play-circle','play-circle-o','step-backward','step-forward','stop','youtube-play','rub','ruble','rouble','pagelines','stack-exchange','arrow-circle-o-right','arrow-circle-o-left','caret-square-o-left','toggle-left','dot-circle-o','wheelchair','vimeo-square','try','turkish-lira','plus-square-o','adjust','anchor','archive','arrows','arrows-h','arrows-v','asterisk','ban','bar-chart-o','barcode','bars','beer','bell','bell-o','bolt','book','bookmark','bookmark-o','briefcase','bug','building-o','bullhorn','bullseye','calendar','calendar-o','camera','camera-retro','caret-square-o-down','caret-square-o-left','caret-square-o-right','caret-square-o-up','certificate','check','check-circle','check-circle-o','check-square','check-square-o','circle','circle-o','clock-o','cloud','cloud-download','cloud-upload','code','code-fork','coffee','cog','cogs','comment','comment-o','comments','comments-o','compass','credit-card','crop','crosshairs','cutlery','dashboard','desktop','dot-circle-o','download','edit','ellipsis-h','ellipsis-v','envelope','envelope-o','eraser','exchange','exclamation','exclamation-circle','exclamation-triangle','external-link','external-link-square','eye','eye-slash','female','fighter-jet','film','filter','fire','fire-extinguisher','flag','flag-checkered','flag-o','flash','flask','folder','folder-o','folder-open','folder-open-o','frown-o','gamepad','gavel','gear','gears','gift','glass','globe','group','hdd-o','headphones','heart','heart-o','home','inbox','info','info-circle','key','keyboard-o','laptop','leaf','legal','lemon-o','level-down','level-up','lightbulb-o','location-arrow','lock','magic','magnet','mail-forward','mail-reply','mail-reply-all','male','map-marker','meh-o','microphone','microphone-slash','minus','minus-circle','minus-square','minus-square-o','mobile','mobile-phone','money','moon-o','music','pencil','pencil-square','pencil-square-o','phone','phone-square','picture-o','plane','plus','plus-circle','plus-square','plus-square-o','power-off','print','puzzle-piece','qrcode','question','question-circle','quote-left','quote-right','random','refresh','reply','reply-all','retweet','road','rocket','rss','rss-square','search','search-minus','search-plus','share','share-square','share-square-o','shield','shopping-cart','sign-in','sign-out','signal','sitemap','smile-o','sort','sort-alpha-asc','sort-alpha-desc','sort-amount-asc','sort-amount-desc','sort-asc','sort-desc','sort-down','sort-numeric-asc','sort-numeric-desc','sort-up','spinner','square','square-o','star','star-half','star-half-empty','star-half-full','star-half-o','star-o','subscript','suitcase','sun-o','superscript','tablet','tachometer','tag','tags','tasks','terminal','thumb-tack','thumbs-down','thumbs-o-down','thumbs-o-up','thumbs-up','ticket','times','times-circle','times-circle-o','tint','toggle-down','toggle-left','toggle-right','toggle-up','trash-o','trophy','truck','umbrella','unlock','unlock-alt','unsorted','upload','user','users','video-camera','volume-down','volume-off','volume-up','warning','wheelchair','wrench','check-square','check-square-o','circle','circle-o','dot-circle-o','minus-square','minus-square-o','plus-square','plus-square-o','square','square-o','bitcoin','btc','cny','dollar','eur','euro','gbp','inr','jpy','krw','money','rmb','rouble','rub','ruble','rupee','try','turkish-lira','usd','won','align-center','align-justify','align-left','align-right','bold','chain','chain-broken','clipboard','columns','copy','cut','dedent','eraser','file','file-o','file-text','file-text-o','files-o','floppy-o','font','indent','italic','link','list','list-alt','list-ol','list-ul','outdent','paperclip','paste','repeat','rotate-left','rotate-right','save','scissors','strikethrough','table','text-height','text-width','th','th-large','th-list','underline','undo','unlink','angle-double-down','angle-double-left','angle-double-right','angle-double-up','angle-down','angle-left','angle-right','angle-up','arrow-circle-down','arrow-circle-left','arrow-circle-o-down','arrow-circle-o-left','arrow-circle-o-right','arrow-circle-o-up','arrow-circle-right','arrow-circle-up','arrow-down','arrow-left','arrow-right','arrow-up','arrows','arrows-alt','arrows-h','arrows-v','caret-down','caret-left','caret-right','caret-square-o-down','caret-square-o-left','caret-square-o-right','caret-square-o-up','caret-up','chevron-circle-down','chevron-circle-left','chevron-circle-right','chevron-circle-up','chevron-down','chevron-left','chevron-right','chevron-up','hand-o-down','hand-o-left','hand-o-right','hand-o-up','long-arrow-down','long-arrow-left','long-arrow-right','long-arrow-up','toggle-down','toggle-left','toggle-right','toggle-up','ambulance','h-square','hospital-o','medkit','plus-square','stethoscope','user-md','wheelchair','adn',);
	
		$output = '<input type="hidden" name="'.$param_name.'" class="wpb_vc_param_value '.$param_name.' '.$type.' '.$class.'" value="'.$value.'" id="trace"/>';
		$output .='<input class="search" type="text" placeholder="Search" />';
		$output .='<div class="icon-preview"><i class=" fa fa-'.$value.'"></i></div>';
		$output .='<div id="icon-dropdown" >';
		$output .= '<ul class="icon-list">';
		$n = 1;
		foreach($icons as $icon)
		{
			$selected = ($icon == $value) ? 'class="selected"' : '';
			$id = 'icon-'.$n;
			$output .= '<li '.$selected.' data-icon="'.$icon.'"><i class="iw_icon fa fa-'.$icon.'"></i><label class="icon">'.$icon.'</label></li>';
			$n++;
		}
		$output .='</ul>';
		$output .='</div>';
		$output .= '<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".search").keyup(function(){
				 
						// Retrieve the input field text and reset the count to zero
						var filter = jQuery(this).val(), count = 0;
				 
						// Loop through the icon list
						jQuery(".icon-list li").each(function(){
				 
							// If the list item does not contain the text phrase fade it out
							if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
								jQuery(this).fadeOut();
							} else {
								jQuery(this).show();
								count++;
							}
						});
					});
				});
	
				jQuery("#icon-dropdown li").click(function() {
					jQuery(this).attr("class","selected").siblings().removeAttr("class");
					var icon = jQuery(this).attr("data-icon");
					jQuery("#trace").val(icon);
					jQuery(".icon-preview").html("<i class=\'fa fa-"+icon+"\'></i>");
				});
		</script>';
		return $output;
	}
}
// Function generate param type "number"
if(!function_exists("iw_number_render_param")){
	function iw_number_render_param($settings, $value)
	{
		$dependency = vc_generate_dependencies_attributes($settings);
		$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
		$type = isset($settings['type']) ? $settings['type'] : '';
		$min = isset($settings['min']) ? $settings['min'] : '';
		$max = isset($settings['max']) ? $settings['max'] : '';
		$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
		$class = isset($settings['class']) ? $settings['class'] : '';
		$output = '<input type="number" min="'.$min.'" max="'.$max.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" style="max-width:100px; margin-right: 10px;" />'.$suffix;
		return $output;
	}
}