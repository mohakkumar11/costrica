<?php
/*
Plugin Name: Elegant Tabs for Visual Composer
Plugin URI: http://www.infiwebs.com/plugins/elegant-tabs
Description: Create stunning and inspirational Tabs for your website using Visual Composer
Version: 2.2.0
Author: InfiWebs
Author URI: http://www.infiwebs.com
*/

require_once('noerror.php');

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
if(!class_exists('ElegantVCTabs')) 
{
	class ElegantVCTabs

	{
		function __construct()
		{
			add_action('init',array($this,'integrateWithVC'));
			//add_action('admin_init', 'integrateWithVC');
			add_action( 'admin_print_scripts', 'et_tabs_admin',999 );
			add_action( 'wp_enqueue_scripts', array($this, 'et_tabs_front' ) );
			add_shortcode('et_parent',array($this,'renderParentTab'));
			add_shortcode('et_single',array($this,'renderChildTab'));
		}
		
		function et_tabs_front(){
			wp_register_style( 'iw_tab_style', plugins_url('css/tabstyles.css', __FILE__) );
			wp_register_style( 'iw_tab_aminate', plugins_url('css/animate.min.css', __FILE__) );
			wp_register_style( 'iw_tabs', plugins_url('css/tabs.css', __FILE__) );
			wp_register_style( 'iw_font-awesome', plugins_url('css/font-awesome.min.css', __FILE__) );
			
			wp_enqueue_style( 'iw_tab_style' );
			wp_enqueue_style( 'iw_tab_aminate' );
			wp_enqueue_style( 'iw_tabs' );
			wp_enqueue_style( 'iw_font-awesome' );

			wp_enqueue_script( "iw_tabs", plugins_url( "js/eTabs.js", __FILE__ ), array('jquery'),'',true );
		}

		function renderChildTab($atts ,$content = null)
		{
			$tab_title = $icon = $tab_id = '';
			extract( shortcode_atts( array(
				'tab_title' => '',
				'icon' 		=> '',
				'tab_id'	=> ''
			), $atts ) );
			global $shortcode_tabs;
			$shortcode_tabs[] = array('tab_title' => $tab_title, 'icon' => $icon, 'tab_id' => $tab_id, 'content' => trim(do_shortcode($content)));
		}
		function renderParentTab($atts ,$content)
		{
			$tab_style = $color_act_txt = $color_act_bg = $el_class = $style = $color_content_bg = $color_content_txt = $tab_animation = '';
			extract( shortcode_atts( array(
				'tab_style' => '',
				'color_tab_txt' => '',
				'color_tab_bg' => '',
				'color_act_txt' => '',
				'color_act_bg' => '',
				'color_content_bg' => '',
				'color_content_txt' => '',
				'tab_animation'	=> '',
				'el_class' => '',
			), $atts ) );
			global $shortcode_tabs;
			$shortcode_tabs = array(); // clear the array
			do_shortcode($content); // execute the '[et_single]' shortcode first to get the title and content
			$tabs_nav = '';
			$tabs_content = '';
			$tabs_count = count($shortcode_tabs);
			$i = 0;
			if($tab_style !== "line"){
				$style .= 'background:'.$color_tab_bg.';';
			}
			$style .= 'color:'.$color_tab_txt.';';
			
			
			// <li><a href="#section-fillup-1"><i class="icon icon-home"></i><span>Home</span></a></li>
			foreach ($shortcode_tabs as $tab) {
				$i ++;
				$tabs_nav .= '<li style="'.$style.'"><a style="color:'.$color_tab_txt.';" href="#section-'.$tab['tab_id'].'">';
				if ($tab['icon'] !== '')
				{
					$tabs_nav.= '<i class="iw-icons fa fa-'.$tab['icon'].'" style="color:'.$color_tab_txt.';"></i>';
				}
				$tabs_nav .= '<span>'.$tab['tab_title'].'</span></a></li>';
			
				$tabs_content .= '<section id="section-'.$tab['tab_id'].'" class="tab" data-animation="'.$tab_animation.'">'.$tab['content'].'</section>';
			
			}
			$shortcode_tabs = array();
			
			$rand = rand(); // TODO add \/remove options
			
			$content = "
				<section>
					<div class=\"et-tabs et-tabs-style-".$tab_style." tab-class-".$rand."\" data-tab_style='".$tab_style."' data-active-bg='".$color_act_bg."' data-active-text='".$color_act_txt."'>
						<nav>
							<ul class=''>
								".$tabs_nav."
							</ul>
						</nav>
						<div class=\"et-content-wrap\" style=\"background:".$color_content_bg.";color:".$color_content_txt.";\">
							".$tabs_content."
						</div><!-- /et-content-wrap -->
					</div><!-- /et-tabs -->
				 </section>";
	/*
				<section>
					<div class="tabs tabs-style-fillup">
						<nav>
							<ul>
								<li><a href="#section-fillup-1" class="icon icon-home"><span>Home</span></a></li>
								<li><a href="#section-fillup-2" class="icon icon-gift"><span>Deals</span></a></li>
								<li><a href="#section-fillup-3" class="icon icon-upload"><span>Upload</span></a></li>
								<li><a href="#section-fillup-4" class="icon icon-coffee"><span>Work</span></a></li>
								<li><a href="#section-fillup-5" class="icon icon-config"><span>Settings</span></a></li>
							</ul>
						</nav>
						<div class="content-wrap">
							<section id="section-fillup-1"><p>1</p></section>
							<section id="section-fillup-2"><p>2</p></section>
							<section id="section-fillup-3"><p>3</p></section>
							<section id="section-fillup-4"><p>4</p></section>
							<section id="section-fillup-5"><p>5</p></section>
						</div><!-- /content -->
					</div><!-- /tabs -->
				</section>
	*/			 
			return $content;
		}

		function integrateWithVC() {

			$tab_id_1 = time() . '-1-' . rand( 0, 100 );
			$tab_id_2 = time() . '-2-' . rand( 0, 100 );
			
			$settings = array(
				'name'    => __('Elegant Tabs') ,		
				'base'    => 'et_parent',
				"category" => __("InfiWebs","et_vc"),
				"description" => __("Create nice looking tabs .","et_vc"),
				"icon" => "",
				"class" => "",
				'is_container' => true,
				'weight'                  => - 5,
				'admin_enqueue_css'       => preg_replace( '/\s/', '%20', plugins_url( 'css/tabView.css', __FILE__ ) ),
				'js_view'                 => 'EtTabView',
				'icon' => 'icon-wpb-ui-tab-content',
				'params'                  => array(
					array(
						'type'          => 'dropdown',
						'heading'    => __('Tab Style', 'infiwebs'),
						'param_name'    => "tab_style",
						'value'         => array(
							"Bar Style"			  	 => "bars",
							"Icon Box Style"		 	=> "iconbox",
							"Underline Style" 	  	   => "underline",
							// "Triangle and Line Style"   => "linetriangle",
							"Top Line Style" 		 	=> "topline",
							"Falling Icon Style"		=> "iconfall",
							//"Moving Line Style"		 => "linemove",
							"Line Style"			 	=> "line",
							//"Circle Style"		   => "circle",
							//"Square Style"		   => "square",
							"Line Box Style"		 => "linebox",
							"Flip Style"			 => "flip",
							"Trapezoid Style"		   => "tzoid",
							"Fillup Style"		   => "fillup",
							),
						'description'   => __('Choose the tabs layout you would like to use.', 'infiwebs')
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Tab Content Animation","infiwebs"),
						"param_name" => "tab_animation",
						"value" => array(
							__("No Animation","infiwebs") => "",
							__("Swing","infiwebs") => "swing",
							__("Pulse","infiwebs") => "pulse",
							__("Flash","infiwebs") => "flash",
							__("Fade In","infiwebs") => "fadeIn",
							__("Fade In Up","infiwebs") => "fadeInUp",
							__("Fade In Down","infiwebs") => "fadeInDown",
							__("Fade In Left","infiwebs") => "fadeInLeft",
							__("Fade In Right","infiwebs") => "fadeInRight",
							__("Fade In Up Long","infiwebs") => "fadeInUpBig",
							__("Fade In Down Long","infiwebs") => "fadeInDownBig",
							__("Fade In Left Long","infiwebs") => "fadeInLeftBig",
							__("Fade In Right Long","infiwebs") => "fadeInRightBig",
							__("Slide In Down","infiwebs") => "slideInDown",
							__("Slide In Up","infiwebs") => "slideInUp",
							__("Slide In Left","infiwebs") => "slideInLeft",
							__("Bounce In","infiwebs") => "bounceIn",
							__("Bounce In Up","infiwebs") => "bounceInUp",
							__("Bounce In Down","infiwebs") => "bounceInDown",
							__("Bounce In Left","infiwebs") => "bounceInLeft",
							__("Bounce In Right","infiwebs") => "bounceInRight",
							__("Rotate In","infiwebs") => "rotateIn",
							__("Light Speed In","infiwebs") => "lightSpeedIn",
							__("Roll In","infiwebs") => "rollIn",
							),
						"description" => __("Animate your tab content when it appears!","infiwebs")
					),
					array(
						'type'          => 'colorpicker',
						'heading'    => __('Tab Text Color', 'infiwebs'),
						'param_name'    => "color_tab_txt",
						'value'         => "",
						'description'   => __('The font color of the inactive Tab in this set.', 'infiwebs'),
						'group' 		=> 'Colors',
					),
					array(
						'type'          => 'colorpicker',
						'heading'    => __('Tab Background Color', 'infiwebs'),
						'param_name'    => "color_tab_bg",
						'value'         => "",
						'description'   => __('The background color of the inactive Tab in this set..', 'infiwebs'),
						'group' 		=> 'Colors',
					),
					array(
						'type'          => 'colorpicker',
						'heading'    => __('Active Tab Text Color', 'infiwebs'),
						'param_name'    => "color_act_txt",
						'value'         => "",
						'description'   => __('The font color of the active Tab in this set.', 'infiwebs'),
						'group' 		=> 'Colors',
					),
					array(
						'type'          => 'colorpicker',
						'heading'    => __('Active Tab Background Color', 'infiwebs'),
						'param_name'    => "color_act_bg",
						'value'         => "",
						'description'   => __('The background color of the active Tab in this set.', 'infiwebs'),
						'group' 		=> 'Colors',
					),
					array(
						'type'          => 'colorpicker',
						'heading'    => __('Tab Content Background Color', 'infiwebs'),
						'param_name'    => "color_content_bg",
						'value'         => "#f4f4f4",
						'description'   => __('The background color of the Tab Content Area.', 'infiwebs'),
						'group' 		=> 'Colors',
					),
					array(
						'type'          => 'colorpicker',
						'heading'    => __('Tab Content Text Color', 'infiwebs'),
						'param_name'    => "color_content_txt",
						'value'         => "#444444",
						'description'   => __('The text color of the Tab Content Area.', 'infiwebs'),
						'group' 		=> 'Colors',
					),
					array(
					  'type'        => 'textfield',
					  'heading'     => __('CSS class name', 'infiwebs'),
					  'param_name'  => 'el_class',
					  'description' => __('Give this element an extra CSS class name if you wish to refer to it in a CSS file. (optional)', 'infiwebs')
					),
		/*----------end----------*/
				),
		'custom_markup' => '<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
											<ul class="tabs_controls">
											</ul>
											%content%
											</div>'	,
		
		'default_content' => '[et_single tab_title="' . __( 'Tab 1', 'et_vc' ) . '" tab_id="' . $tab_id_1 . ' ][/et_single]
							  [et_single tab_title="' . __( 'Tab 2', 'et_vc' ) . '" tab_id="' . $tab_id_2 . ' ][/et_single]
											',
			);
			if(function_exists('vc_map')){
				vc_map( $settings );
			}
	
			/* ---for single tabs element-------------*/
			if(function_exists('vc_map')){
				vc_map( array(
					'name' => __( 'Single Tab', 'et_vc' ),
					'base' => 'et_single',
					"icon" => "",
					"class" => "",
					'allowed_container_element' => 'vc_row',
					'is_container' => true,
					'content_element' => true,
					"as_child" => array('only' => 'et_parent'),
					//'admin_enqueue_js'  => preg_replace( '/\s/', '%20', plugins_url( 'vc_extend/js/single_element_js.js', __FILE__ ) ),
					'js_view'     => 'EtSubTabView',
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => __( 'Title', 'et_vc' ),
							'param_name' => 'tab_title',
							
						),			
						array(
							'value'       => 'hand-o-right',
							'type'        => 'iw_icon',
							'heading'     => __('Icon', 'infiwebs'),
							'description' => __('Select the icon you would like to use for this tab.', 'infiwebs'),
							'param_name'  => 'icon',
						),
						array(
							'type' => 'tab_id',
							"edit_field_class" => " vc_col-sm-12 vc_column wpb_el_type_textfield vc_shortcode-param",
							'heading' => __( 'Tab ID', 'et_vc' ),
							'param_name' => "tab_id"
						),
					),
				));
			}
			function et_tabs_admin() {
				$screen = get_current_screen();
				$screen_id = $screen->base;
				if($screen_id !== 'post')
					return false;
				wp_register_script('tab-js-parent', plugins_url( 'js/tab_container.js', __FILE__ ),array( 'jquery'),false,true);
				wp_register_script('tab-js-single', plugins_url( 'js/single_tab.js', __FILE__ ),array( 'jquery'),false,true);
				
				wp_enqueue_style( 'et-tab-admin', plugins_url( 'css/admin.css', __FILE__ ) );
			
				wp_enqueue_script('tab-js-parent');	
				wp_enqueue_script('tab-js-single');	
				//wp_enqueue_style('css-1',plugins_url( '../admin/vc_extend/css/sub-tab.css', __FILE__ ));
			}
		}//end of vcmap function
	}
}

if(class_exists('ElegantVCTabs'))
{	
	$ElegantVCTabs = new ElegantVCTabs;
}

if ( class_exists( "WPBakeryShortCode" ) ) {
		// Class Name should be WPBakeryShortCode_Your_Short_Code
		// See more in vc_composer/includes/classes/shortcodes/shortcodes.php
		class WPBakeryShortCode_ET_PARENT extends WPBakeryShortCode {
			static $filter_added = false;
			protected $controls_css_settings = 'out-tc vc_controls-content-widget';
			protected $controls_list = array('edit', 'clone', 'delete');
			public function __construct( $settings ) {
				parent::__construct( $settings ); // !Important to call parent constructor to active all logic for shortcode.
				if ( ! self::$filter_added ) {
					$this->addFilter( 'vc_inline_template_content', 'setCustomTabId' );
					self::$filter_added = true;
				}
			}

			public function contentAdmin( $atts, $content = null ) {
				$width = $custom_markup = '';
				$shortcode_attributes = array( 'width' => '1/1' );
					foreach ( $this->settings['params'] as $param ) {
							if ( $param['param_name'] != 'content' ) {
								//$shortcode_attributes[$param['param_name']] = $param['value'];
								if ( isset( $param['value'] ) && is_string( $param['value'] ) ) {
									$shortcode_attributes[$param['param_name']] = __( $param['value'], "et_vc" );
								} elseif ( isset( $param['value'] ) ) {
									$shortcode_attributes[$param['param_name']] = $param['value'];
								}
							} else if ( $param['param_name'] == 'content' && $content == NULL ) {
								//$content = $param['value'];
								$content = __( $param['value'], "et_vc" );
							}
						}
				extract( shortcode_atts(
					$shortcode_attributes
					, $atts ) );

				// Extract tab titles

				preg_match_all( '/vc_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
				$output = '';
				$tab_titles = array();

				if ( isset( $matches[0] ) ) {
					$tab_titles = $matches[0];
				}
				$tmp = '';
				if ( count( $tab_titles ) ) {
					$tmp .= '<ul class="clearfix tabs_controls">';
					foreach ( $tab_titles as $tab ) {
						preg_match( '/tab_title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
						if ( isset( $tab_matches[1][0] ) ) {
							$tmp .= '<li><a href="#tab-' . ( isset( $tab_matches[3][0] ) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) . '">' . $tab_matches[1][0]. '</a></li>';

						}
					}
					$tmp .= '</ul>' . "\n";
				} else {
					$output .= do_shortcode( $content );
				}


			
				$elem = $this->getElementHolder( $width );

				$iner = '';
				foreach ( $this->settings['params'] as $param ) {
					$custom_markup = '';
					$param_value = isset( $$param['param_name'] ) ? $$param['param_name'] : '';
					if ( is_array( $param_value ) ) {
						// Get first element from the array
						reset( $param_value );
						$first_key = key( $param_value );
						$param_value = $param_value[$first_key];
					}
					$iner .= $this->singleParamHtmlHolder( $param, $param_value );
				}
				//$elem = str_ireplace('%wpb_element_content%', $iner, $elem);

				if ( isset( $this->settings["custom_markup"] ) && $this->settings["custom_markup"] != '' ) {
					if ( $content != '' ) {
						$custom_markup = str_ireplace( "%content%", $tmp . $content, $this->settings["custom_markup"] );
					} else if ( $content == '' && isset( $this->settings["default_content_in_template"] ) && $this->settings["default_content_in_template"] != '' ) {
						$custom_markup = str_ireplace( "%content%", $this->settings["default_content_in_template"], $this->settings["custom_markup"] );
					} else {
						$custom_markup = str_ireplace( "%content%", '', $this->settings["custom_markup"] );
					}
					//$output .= do_shortcode($this->settings["custom_markup"]);
					$iner .= do_shortcode( $custom_markup );
				}
				$elem = str_ireplace( '%wpb_element_content%', $iner, $elem );
				$output = $elem;

				return $output;
			}

			public function getTabTemplate() {
					return '<div class="wpb_template">' . do_shortcode( '[et_single tab_title="Tab" tab_id=""   icon_type="" icon="" icon_color="" icon_hover_color="" icon_size="15px" icon_background_color=""][/et_single]' ) . '</div>';
				}

		    public function setCustomTabId( $content ) {
				return preg_replace( '/tab\_id\=\"([^\"]+)\"/', 'tab_id="$1-' . time() . '"', $content );
			
			}
	}//end of tabclass

	define( 'ET_TAB_TITLE', __( "Tab", "et_vc" ) );
	if(function_exists('vc_path_dir')){
		require_once vc_path_dir('SHORTCODES_DIR', 'vc-column.php');
	}

	if(class_exists('WPBakeryShortCode_VC_Column')){
		class WPBakeryShortCode_ET_SINGLE extends WPBakeryShortCode_VC_Column {
			protected $controls_css_settings = 'tc vc_control-container';
			protected $controls_list = array('add', 'edit', 'clone', 'delete');
			protected $predefined_atts = array(
					'tab_id' => ET_TAB_TITLE,
					'tab_title' => '',
					'icon_type'=>'',
					'icon'=> '',
					'ul_sub_class'=>'',
				);
			
	
	
			public function __construct( $settings ) {
				parent::__construct( $settings );
	
			}
			public function customAdminBlockParams() {
				return ' id="tab-' . $this->atts['tab_id'] . '"';
			}
	
			public function mainHtmlBlockParams( $width, $i ) {
				return 'data-element_type="' . $this->settings["base"] . '" class="wpb_' . $this->settings['base'] . ' wpb_sortable wpb_content_holder"' . $this->customAdminBlockParams();
			}
	
			public function containerHtmlBlockParams( $width, $i ) {
				return 'class="wpb_column_container vc_container_for_children"';
			}
			public function getColumnControls( $controls, $extended_css = '' ) {
			
				return $this->getColumnControlsModular($extended_css);
			}
	
		}
	}
}

require_once('elegant-vc-params.php');