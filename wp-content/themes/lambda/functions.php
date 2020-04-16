<?php
/**
 * Main functions file
 *
 * @package Lambda
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2015 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.27.0
 */

// create defines
define('THEME_NAME', 'Lambda');
define('THEME_SHORT', 'lambda');

define('OXY_THEME_DIR', get_template_directory() . '/');
define('OXY_THEME_URI', get_template_directory_uri() . '/');

// include extra theme specific code
include OXY_THEME_DIR . 'inc/frontend.php';
include OXY_THEME_DIR . 'inc/woocommerce.php';
include OXY_THEME_DIR . 'vendor/oxygenna/oxygenna-framework/inc/OxygennaTheme.php';
include OXY_THEME_DIR . 'vendor/oxygenna/oxygenna-mega-menu/oxygenna-mega-menu.php';

global $oxy_theme;
$oxy_theme = new OxygennaTheme(
    array(
        'text_domain'       => 'lambda-td',
        'admin_text_domain' => 'lambda-admin-td',
        'min_wp_ver'        => '3.4',
        'widgets' => array(
            'OxyWidgetTwitter' => 'OxyWidgetTwitter.php',
            'OxyWidgetSocial'  => 'OxyWidgetSocial.php',
            'OxyWidgetWPML'    => 'OxyWidgetWPML.php',
        ),
        'shortcodes' => false,
    )
);

include OXY_THEME_DIR . 'inc/custom-posts.php';
include OXY_THEME_DIR . 'inc/options/shortcodes/shortcodes.php';
include OXY_THEME_DIR . 'inc/options/widgets/default_overrides.php';

if (is_admin()) {
    include OXY_THEME_DIR . 'inc/backend.php';
    include OXY_THEME_DIR . 'inc/options/shortcodes/create-shortcode-options.php';
    include OXY_THEME_DIR . 'inc/theme-metaboxes.php';
    include OXY_THEME_DIR . 'inc/visual-composer-extend.php';
    include OXY_THEME_DIR . 'inc/install-plugins.php';
    include OXY_THEME_DIR . 'inc/one-click-import.php';
    include OXY_THEME_DIR . 'vendor/oxygenna/oxygenna-one-click/inc/OxygennaOneClick.php';
    include OXY_THEME_DIR . 'vendor/oxygenna/oxygenna-typography/oxygenna-typography.php';
}
include OXY_THEME_DIR . 'inc/visual-composer.php';

include OXY_THEME_DIR . 'vendor/oxygenna/oxygenna-stacks/oxygenna-stacks.php';

// MOVE THIS FUNCTION INTO THEME SWITCHER
function oxy_check_for_blog_switcher($name)
{
    if (isset($_GET['blogstyle'])) {
        $name = $_GET['blogstyle'];
    }
    return $name;
}
add_filter('oxy_blog_type', 'oxy_check_for_blog_switcher');
add_theme_support( 'post-thumbnails' );

function bbloomer_redirect_checkout_add_cart( $url ) {
    $url = get_permalink( get_option( 'woocommerce_checkout_page_id' ) ); 
    return $url;
}
 
add_filter( 'woocommerce_add_to_cart_redirect', 'bbloomer_redirect_checkout_add_cart' );

// add accepted checkbox after payment
add_action( 'woocommerce_review_order_before_submit', 'add_privacy_checkbox', 9 );
function add_privacy_checkbox() {
woocommerce_form_field( 'privacy_policy', array(
'type' => 'checkbox',
'class' => array('form-row privacy'),
'label_class' => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
'input_class' => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
'required' => true,
'label' => 'I\'ve read and agreed to the Terms of Service',
));
}
add_action( 'woocommerce_checkout_process', 'privacy_checkbox_error_message' );
function privacy_checkbox_error_message() {
if ( ! (int) isset( $_POST['privacy_policy'] ) ) {
wc_add_notice( __( 'You have to agreed to the Terms of Service.' ), 'error' );
}
}
// empty cart to redirect shop page
add_action("template_redirect", 'redirection_function');
function redirection_function(){
    global $woocommerce;
    if( is_cart() && WC()->cart->cart_contents_count == 0){
        wp_safe_redirect( get_permalink( woocommerce_get_page_id( 'shop' ) ) );
    }
}

add_action( 'wp_enqueue_scripts', 'tthq_add_custom_fa_css' );

function tthq_add_custom_fa_css() {
wp_enqueue_style( 'custom-fa', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css' );
}
/*------------------code to remove required fields-----------*/


add_filter('woocommerce_checkout_fields' , 'custom_override_ckeckout_fields');
function custom_override_ckeckout_fields($fields){
    //$fields['billing']['billing_first_name']['required']=false;
    //$fields['billing']['billing_last_name']['required']=false;
    //$fields['billing']['billing_email']['required']=false;
    //$fields['billing']['billing_phone']['required']=false;
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    return $fields;
}


// add 5.5 % to the woccomerce product except some of product id
/*function return_custom_price($price, $product) {
global $post, $blog_id;
$pro_id = $post->ID;
$exist_arry = array(3400,3373,3371,3368,3356,3345,3339,3333,3325,3324,3321,3318,3314,3306,3305,3302,3300,3294,3292,3289,3281,3277,3275,3274,3266,3264,3262,3259,3255,3253,3235,3231,3228,3222,3218,3196,3189,3185,3176,3171,3168,3161,3151,3146,3137,3131,3119,2919);
if(!in_array($pro_id, $exist_arry)) { 
$price = $price+($price*5.5)/100;
return $price;
} else {
return $price;
}
}
add_filter("woocommerce_get_price", "return_custom_price", 10, 2);*/

