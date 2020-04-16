<?php
/**
 * Tempalte mail checkout
 *
 * @author  aweteam
 * @package awebooking/apb-template/Emails
 * @version 1.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$config_email = get_option( 'apb_mail_pending' );
if ( ! empty( $config_email['text'] ) ) {
	echo '<p>' . esc_html( $config_email['text'] ) . '</p>';
}
?>
 <!-- ITEM -->
<div style="border-bottom: 1px solid #e4e4e4; padding: 20px 20px 15px;" class="apb-room-selected_item">
	<h6 style="color: #333333; display: inline-block; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;">
		<?php esc_html_e( 'Check in', 'awebooking' ); ?>
	</h6>

	<span style="display: inline-block; font-size: 12px; line-height: 1.428em; vertical-align: middle;" class="apb-option">
		<?php echo esc_html( date( get_option( 'date_format' ), strtotime( $item['from'] ) ) ); ?>
	</span>

	<h6 style="color: #333333; display: inline-block; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;">
		<?php esc_html_e( 'Check out', 'awebooking' ); ?>
	</h6>

	<span style="display: inline-block; font-size: 12px; line-height: 1.428em; vertical-align: middle;" class="apb-option">
		<?php echo esc_html( date( get_option( 'date_format' ), strtotime( $item['to'] ) ) ); ?>
	</span>

	<h6 style="color: #333333; display: inline-block; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;">
		<?php printf( esc_html__( 'Room %s', 'awebooking' ), absint( $room_num ) ); ?>
	</h6>
	<span style="display: inline-block; font-size: 12px; line-height: 1.428em; vertical-align: middle;" class="apb-option">
		<?php printf( esc_html__( '%s Adult', 'awebooking' ), absint( $item['adult'] ) ); ?>, <?php printf( esc_html__( '%s Child', 'awebooking' ), absint( $item['child'] ) ) ?>
	</span>
	<div class="apb-room-seleted_name has-package">
		<h2 style="color: #1e63a0; display: block; font-family: &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 16px 0 8px; text-align: left;"><?php echo esc_html( $room->post_title ); ?></h2>
	</div>
	<div style="border-top: 1px solid #e4e4e4; margin-top: 15px; padding-top: 5px;" class="apb-room-seleted_package">
		<h6 style="color: #333333; display: inline-block; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;"><?php esc_html_e( 'Price/Night', 'awebooking' ); ?></h6>
		<ul style="list-style: outside none none; margin-bottom: 0; margin-top: 5px; padding-bottom: 2px; padding-left: 0;">
			<?php
			$info_price_day = AWE_function::get_pricing_of_days( $item['from'], $item['to'], $room_type_id );
			foreach ( $info_price_day as $month => $list_day ) {
				foreach ( $list_day as $day => $price_day ) {
					?>
					<li style="color: #333333; font-size: 12px; overflow: hidden;">
						<span class="apb-room-seleted_date"><?php echo date( get_option( 'date_format' ), strtotime( $month . '/' . $day . '/' . date( 'Y' ) ) ); ?></span>
						<span class="apb-amount" style="float: right; font-weight: bold; text-transform: uppercase;"><?php echo AWE_function::apb_price( $price_day ); ?></span>
					</li>
					<?php
				}
			}
			?>
		</ul>

		<?php if ( ! empty( $extra_adult ) || ! empty( $extra_child ) ) : ?>
			<ul style="list-style: outside none none; margin-bottom: 0; margin-top: 5px; padding-bottom: 2px; padding-left: 0;">
				<li style="color: #333333; font-size: 12px; overflow: hidden;">
					<?php
					if ( is_array( $extra_adult ) ) {
						foreach ( $extra_adult as $item_extra_adult ) {
							if ( $item['adult'] == $item_extra_adult['number'] ) {
								?>
								<span class="apb-room-seleted_date">
									<?php printf( esc_html__( '%s Adult', 'awebooking' ), absint( $item_extra_adult['number'] ) ); ?>
									+
									<?php printf( esc_html__( '%s/night', 'awebooking' ), wp_kses_post( AWE_function::apb_price( $item_extra_adult['price'] ) ) ); ?>
								</span>
								<span style="float: right; font-weight: bold; text-transform: uppercase;" class="apb-amount" class="apb-amount"><?php echo AWE_function::apb_price( $item_extra_adult['price'] ) ?> × <?php echo absint( count( $range_date ) - 1 ); ?></span>
								<?php
							}
						}
					}
					?>
				</li>

				<li style="color: #333333; font-size: 12px; overflow: hidden;">
					<?php
					if ( is_array( $extra_child ) ) {
						foreach ( $extra_child as $item_extra_child ) {
							if ( $item['child'] == $item_extra_child['number'] ) {
								?>
								<span class="apb-room-seleted_date">
									<?php printf( esc_html__( '%s Child', 'awebooking' ), absint( $item_extra_child['number'] ) ); ?>
									+
									<?php printf( esc_html__( '%s/night', 'awebooking' ), wp_kses_post( AWE_function::apb_price( $item_extra_child['price'] ) ) ); ?>
								</span>
								<span style="float: right; font-weight: bold; text-transform: uppercase;" class="apb-amount"><?php echo AWE_function::apb_price( $item_extra_child['price'] ) ?> × <?php echo absint( count( $range_date ) - 1 ) ?></span>
								<?php
							}
						}
					}
					?>
				</li>
			</ul>
		<?php endif ?>

		<?php if ( ! empty( $item['package_data'] ) ) : ?>
			<h6 style="color: #333333; display: inline-block; font-size: 14px; font-weight: bold; line-height: 1.428em; margin: 0 10px 0 0; text-transform: uppercase;"><?php esc_html_e( 'Package', 'awebooking' ); ?></h6>
			<ul style="list-style: outside none none; margin-bottom: 0; margin-top: 5px; padding-bottom: 2px; padding-left: 0;">
				<?php
				foreach ( $item['package_data'] as $info_package ) :
					$getPackage = AWE_function::get_room_option( $room_type_id, 'apb_room_type' );
					foreach ( $getPackage as $item_package ) {
						if ( $item_package->id == $info_package['package_id'] ) {
							?>
							<li style="color: #333333; font-size: 12px; overflow: hidden;">
								<span class="apb-room-seleted_date"><?php echo esc_html( $item_package->option_name ); ?></span>
								<span class="apb-amount" style="float: right; font-weight: bold; text-transform: uppercase;">
									<?php
									if ( $item_package->revision_id ) {
										echo wp_kses_post( AWE_function::apb_price( $item_package->option_value ) . ' x ' . ( count( $range_date ) - 1 ) );
									} else {
										echo wp_kses_post( AWE_function::apb_price( $item_package->option_value ) . ' x ' . $info_package['total'] );
									}
									?>
								</span>
							</li>
							<?php
						}
					}
				endforeach;
				?>
			</ul>
		<?php endif; ?>

		<ul style="list-style: outside none none; margin-bottom: 0; margin-top: 5px; padding-bottom: 2px; padding-left: 0;">
			<li style="color: #333333; font-size: 12px; overflow: hidden;">
				<?php
				if ( ! empty( $item['sale_info'] ) ) {
					if ( 'sub' == $item['sale_info']['sale_type'] ) {
						echo '<span class="apb-room-seleted_date">' . esc_html__( 'Sale', 'awebooking' ) . '</span><span style="float: right; font-weight: bold; text-transform: uppercase;" class="apb-amount"> ' . AWE_function::get_symbol_of_sale( $item['sale_info']['sale_type'] ) . AWE_function::apb_price( $item['sale_info']['amount'] ) . '</span>';
					} else {
						echo '<span class="apb-room-seleted_date">' . esc_html__( 'Sale', 'awebooking' ) . '</span><span style="float: right; font-weight: bold; text-transform: uppercase;" class="apb-amount">  -'.AWE_function::get_symbol_of_sale( $item['sale_info']['sale_type'] ) . $item['sale_info']['amount'] . '</span>';
					}
				}
				?>
			</li>
		</ul>

	</div>
	<div class="apb-room-seleted_total-room" style="color:#333333;font-size:14px;font-weight:bold;border-top: 1px solid #e4e4e4;padding-top: 15px;">
		<?php esc_html_e( 'Total Room', 'awebooking' ); ?><?php echo esc_attr( $room_num ); ?><span class="apb-amount" style="color:#46598b;float:right;font-weight:bold;"><?php echo wp_kses_post( AWE_function::apb_price( $price ) ); ?></span>
	</div>
</div>
<!-- END / ITEM -->
