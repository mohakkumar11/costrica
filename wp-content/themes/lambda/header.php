<?php
/**
 * Displays the head section of the theme
 *
 * @package Lambda
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2015 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.27.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
       
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="google-site-verification" content="GYSha32sMOainkGvLZFz1dTRsMkAHSfzir14mhaAX6s" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" /><?php

        $site_icon_id = get_option('site_icon');
        if ($site_icon_id === '0' || $site_icon_id === false) {
            oxy_favicons();
        }

        wp_head(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88366406-1', 'auto');
  ga('send', 'pageview');

</script>

<script id="_agile_min_js" async type="text/javascript" src="https://crving.agilecrm.com/stats/min/agile-min.js"> </script>
<script type="text/javascript" >
var Agile_API = Agile_API || {}; Agile_API.on_after_load = function(){
_agile.set_account('7pk4i1o4vadslcjg61790va75e', 'crving');
_agile.track_page_view();
_agile_execute_web_rules();};
</script>
<script src="https://www.google.com/recaptcha/api.js"></script>

 <!-- Facebook Pixel Code -->

<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f.fbq)f.fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '624572361300638');
fbq('track', 'PageView');
</script>

<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=624572361300638&ev=PageView&noscript=1" /></noscript>

<!-- End Facebook Pixel Code -->

<!-- Hotjar Tracking Code for https://costaricavacationing.com -->
<script>
   /* (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1438132,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');*/
</script>

<!-- Global site tag (gtag.js) - Google Ads: 860859224 -->

<script async src="https://www.googletagmanager.com/gtag/js?id=AW-860859224"></script>

<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'AW-860859224');
</script>
		<script>
			$.noConflict();
</script>
<style>
.woocommerce .blockUI.blockOverlay {
position: relative !important;
display: none !important;
}
</style>
    </head>
    <body <?php body_class(); ?>>
        <div class="pace-overlay"></div>
        <?php oxy_create_nav_header(); ?>
        <div id="content" role="main">
          
			
            