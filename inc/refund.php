<?php
add_action( 'maart_customize_register', function( $manager ) {
	$manager->add_setting( [
		'type'      => 'dropdown-pages',
		'name'      => 'refund_page_id',
		'label'     => __( 'Refund page', 'wcboost' ),
		'default'   => '',
		'section'   => 'wcboost',
		'separator' => 'before',
	] );

	$manager->add_setting( [
		'type'        => 'number',
		'name'        => 'refund_period',
		'label'       => __( 'Refund period (days)', 'wcboost' ),
		'description' => __( 'Set to "0" to disable refund, "-1" to always allow refunds.', 'wcboost' ),
		'default'     => 14,
		'section'     => 'wcboost',
		'separator'   => 'after',
	] );
} );

add_action( 'woocommerce_order_details_after_customer_details', function( $order ) {
	if ( 'completed' !== $order->get_status() ) {
		return;
	}

	$refund_page_id = get_theme_mod( 'refund_page_id' );

	if ( ! $refund_page_id ) {
		return;
	}

	$refund_page_url = get_permalink( $refund_page_id );
	$refund_period   = intval( get_theme_mod( 'refund_period', 14 ) );
	$completed_date  = $order->get_date_completed();
	$diff            = $completed_date->diff( new DateTime( 'now' ) )->format( '%a' );
	$diff            = intval( $diff );

	if ( $refund_period === 0 ) {
		return; // Disable refund.
	}
	?>
	<section class="request-refund">
		<h2 class="woocommerce-column__title">Refund</h2>
		<p>
		We value your feedback and satisfaction. If you are not happy with your purchase, please let us know what went wrong and how we can improve our product or service. We are always ready to assist you and offer you the best solution. You can contact us by email via this <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact form</a>, or chat anytime.
		</p>
		<?php if ( $refund_period > 0 && $refund_period < $diff ) : ?>
			<p style="font-style: italic;">
			We are sorry to inform you that your purchase is out of the refund period. According to our refund policy, you can only request a refund within <?php echo $refund_period; ?> days of your purchase date. Unfortunately, we cannot process your refund request at this time. We apologize for any inconvenience this may cause you.
			</p>
		<?php else : ?>
			<p>
			If you still want to request a refund, please use the button below and we will process it as soon as possible.
			</p>
			<form action="<?php echo esc_url( $refund_page_url ); ?>" method="post">
				<input type="hidden" name="order_id" value="<?php echo $order->get_id(); ?>" />
				<input type="hidden" name="action" value="refund" />
				<?php wp_nonce_field( 'wcboost-refund-' . $order->get_id() ); ?>
				<button type="submit" class="button button--outline"><?php esc_html_e( 'Request refund', 'wcboost' ); ?></button>
			</form>
		<?php endif; ?>
	</section>
	<?php
}, 99 );

// Make the refund page private.
add_action( 'template_redirect', function() {
	$refund_page_id = get_theme_mod( 'refund_page_id' );

	if ( ! $refund_page_id || ! is_page( $refund_page_id ) ) {
		return;
	}

	if ( current_user_can( 'administrator' ) ) {
		return;
	}

	if ( empty( $_POST['_wpnonce'] ) || empty( $_POST['action'] ) || empty( $_POST['order_id'] ) ) {
		wp_redirect( home_url() );
		exit();
	}

	$order_id = $_POST['order_id'] ?? -1;

	if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'wcboost-refund-' . $order_id ) ) {
		$message = 'Invalid request! Please try again.';

		if ( wp_get_referer() ) {
			$message .= '<p><a href="' . wp_get_referer() . '">Go back</a></p>';
		}

		wp_die( $message );
		exit();
	}
} );
