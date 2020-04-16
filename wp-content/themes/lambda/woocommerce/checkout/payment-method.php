<?php
/**
 * Output a single payment method
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<li class="payment_method_<?php echo $gateway->id; ?>">
	<input id="payment_method_<?php echo $gateway->id; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />

	<label for="payment_method_<?php echo $gateway->id; ?>">
		<?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?>
	</label>
	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment_box payment_method_<?php echo $gateway->id; ?>" <?php if ( ! $gateway->chosen ) : ?>style="display:none;"<?php endif; ?>>
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</li>
<li class="cf-policy"><p>Liability;  Costa Rica Vacationing (CRVacationing) is solely a Travel Agency. We do not personally operate any of the Hotels, Villas, Transport or Tours and can accept no liability based on negligence. We have hand selected our partners with a great amount of care so that you have the best experience in a safe environment. In the event of extreme weather, road conditions, cancelled flights etc. CRVacationing reserves the right to make substitutions to tours and hotels. In the event that CRVacationing should be found liable for any loss or damage that is connected to any wrong doing on our part we will never exceed the total amount paid by the client for the services sold or the amount of $500 – whichever is the greater amount.  CRVacationing highly recommends the purchase of travel insurance for your stay to cover unforeseen circumstances and to protect your investment.  We are happy to make recommendations and assist with those quotes.</p><p>Cancellations; Most tour operators vary but a minimum of 3 days is advised.</p><p>This price does not include departure taxes, visas, customary end of trip gratuities for your tour manager, driver, local guides, hotel housekeepers, cruise ship, wait staff, and any incidental charges. <br></p></li>


