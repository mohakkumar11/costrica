<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
do_action( 'woocommerce_before_cart' );
?>
<div class="container">
<div class="row">
    <h1 class="text-left  element-top-10 element-bottom-10 text-normal normal bold" data-os-animation="none" data-os-animation-delay="0s">
    Create Booking</h1>
    <h3 class="text-left  element-top-10 element-bottom-10 text-normal normal bold" data-os-animation="none" data-os-animation-delay="0s">
    When you are ready to proceed please fill out your details below to confirm your booking.</h3>
</div>
</div>
<div class="container custom-checkout">
<div class="row">

			<div class="col-md-6 custom-order-review widthfifty">
			<?php wc_print_notices(); ?>
				<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
					<?php do_action( 'woocommerce_before_cart_table' ); ?>
				
						<table class="cust_responsicetable shop_table cart table element-bottom-20" cellspacing="0">
							<thead>
								<tr>
									<th class="product-remove">&nbsp;</th>
									<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
									<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
									<th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php do_action( 'woocommerce_before_cart_contents' ); ?>
								<?php
								foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
									$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
									$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

									if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
										?>
										<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

											<td class="product-remove">
												<?php
													echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><i class="icon-cross"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
												?>
											</td>
                                           <td class="product-name">
												<?php
													if ( ! $_product->is_visible() )
														echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
													else
														echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );

													// Meta data
													echo WC()->cart->get_item_data( $cart_item );

													echo " x ";
													if ( $_product->is_sold_individually() ) {
														$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
													} else {
														$product_quantity = woocommerce_quantity_input( array(
															'input_name'  => "cart[{$cart_item_key}][qty]",
															'input_value' => $cart_item['quantity'],
															'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
															'min_value'   => '0'
														), $_product, false );
													}

													echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
												?>
												
											</td>

											<td class="product-price">
												<?php
													echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
												?>
											</td>

											

											<td class="product-subtotal">
												<?php
													echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
												?>
											</td>
										</tr>
										<?php
									}
								}?>
							</tbody>
							<tfoot>

		<tr class="cart-subtotal">
			<th colspan="3"><?php _e( 'Cart Subtotal', 'woocommerce' ); ?></th>
			<td><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons( 'cart' ) as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( $code ); ?>">
				<th><?php _e( 'Coupon:', 'woocommerce' ); ?> <?php echo esc_html( $code ); ?></th>
				<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->tax_display_cart === 'excl' ) : ?>
			<?php if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
			<tr class="order-discount coupon-<?php echo esc_attr( $code ); ?>">
				<th><?php _e( 'Coupon:', 'woocommerce' ); ?> <?php echo esc_html( $code ); ?></th>
				<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="order-total success">
			<th colspan="3"><?php _e( 'Order Total', 'woocommerce' ); ?></th>
			<td><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</tfoot>
						</table>

					
				</form>
			</div>
       
<div class="col-sm-6 custom-checkout-style widthfifty">       
<section class="section section-commerce">
	<div class="container element-top-10 element-bottom-50">

		<?php wc_print_notices(); ?>

		<?php
		do_action( 'woocommerce_before_checkout_form', $checkout ); ?>
		<?php
		// If checkout registration is disabled and not logged in, the user cannot checkout
		if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
			echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
			return;
		}

		// filter hook for include new pages inside the payment method
		$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

		<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">

			<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div class="row col2-set" id="customer_details">

					<div class="col-md-6 col-1">

						<?php do_action( 'woocommerce_checkout_billing' ); ?>

					</div>

					<div class="col-md-6 col-2">

						<?php do_action( 'woocommerce_checkout_shipping' ); ?>

					</div>

				</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<!--<h3 id="order_review_heading" class="element-top-20"><?php _e( 'Your order', 'woocommerce' ); ?></h3>-->

			<?php endif; ?>

			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>


			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			
  
		</form>

		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
		
	</div>
</section>
</div>
</div>
</div>