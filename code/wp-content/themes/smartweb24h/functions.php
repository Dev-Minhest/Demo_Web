<?php
/**
 * supershop functions and definitions
 *
 * @version 1.0
 *
 * @date 12.08.2015
 */

load_theme_textdomain( 'supershop', get_template_directory() . '/languages' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

require_once( trailingslashit( get_template_directory() ). '/7upframe/index.php' );
add_action('woocommerce_settings_api_form_fields_cod','sv_cod_woocommerce_update_options_payment_gateways_cod_fun');
if(!function_exists('sv_cod_woocommerce_update_options_payment_gateways_cod_fun')){
	function sv_cod_woocommerce_update_options_payment_gateways_cod_fun($form_fields)
	{
		global $woocommerce;
		$form_fields['enable_deposit'] = array(
								'title'			=> esc_html__('Enable Deposit','supershop'),
								'type'			=> 'checkbox',
								'default'		=> '0',
								'desc_tip'		=> '0',
							);
		$form_fields['deposit_value'] = array(
								'title'			=> esc_html__('Deposit Value','supershop'),
								'type'			=> 'text',
								'default'		=> '0',
								'desc_tip'		=> '0',
							);
		$form_fields['deposit_type'] = array(
								'title'			=> esc_html__('Deposit type','supershop'),
								'type'			=> 'select',
								'description'	=> esc_html__('Deposit either amount or percentage of cart amount','supershop'),
								'default'		=> '0',
								'desc_tip'		=> '0',
								'options'       => array('amount'=>esc_html__('Price','supershop'),'percentage'=>esc_html__('Percentage(%)','supershop'))
							);
		return $form_fields;
	}
}
if(!function_exists('sv_cod_add_payment_gateway_extra_charges_row')){
	function sv_cod_add_payment_gateway_extra_charges_row(){
		global $woocommerce;
		?>
		<tr class="payment-extra-deposit">
			<th><?php printf(esc_html__('Deposit','supershop'));?></th>
			<td><?php 
				echo woocommerce_price($woocommerce->cart->deposit_value);
			?></td>
		</tr>
		<tr class="payment-extra-deposit">
			<th><?php printf(esc_html__('Balance','supershop'));?></th>
			<td><?php 
				echo woocommerce_price($woocommerce->cart->deposit_balance);
			?></td>
		</tr>
		<?php
	}
}

add_action('wp_head','sv_cod_wp_header', 99 );
if(!function_exists('sv_cod_wp_header')){
	function sv_cod_wp_header()
	{
	?>
	<script>
	 	jQuery(document).ready(function($){
			jQuery(document.body).on('change', 'input[name="payment_method"]', function() {
				jQuery('body').trigger('update_checkout');
			});
	 	});
	</script>
	<?php
	}
}
add_action( 'woocommerce_calculate_totals', 'adv_cod_calculate_totals', 9, 1 );
if(!function_exists('adv_cod_calculate_totals')){
	function adv_cod_calculate_totals( $totals ) {		
		$available_gateways = WC()->payment_gateways->get_available_payment_gateways();
		$current_gateway = WC()->session->chosen_payment_method;
		if($current_gateway=='cod'){
			$current_gateways_detail = $available_gateways[$current_gateway];		
			$enable_deposit = $current_gateways_detail->settings['enable_deposit'];
			$deposit_value = $current_gateways_detail->settings['deposit_value'];
			$deposit_type = $current_gateways_detail->settings['deposit_type'];
			if($enable_deposit == 'yes'){
				global $woocommerce;
				$total = $woocommerce->cart->subtotal;
				$items_cart = WC()->cart->get_cart_contents_count();
				if($deposit_type == 'percentage') $deposit = round(($total*$deposit_value)/100,0);
				else $deposit = $items_cart*$deposit_value;	
				$balance = $total-$deposit;
				$woocommerce->cart->deposit_total = $total;
				$woocommerce->cart->deposit_value = $deposit;
				$woocommerce->cart->deposit_balance = $balance;
				$totals->cart_contents_total = $deposit;
				add_action( 'woocommerce_review_order_before_order_total', 'sv_cod_add_payment_gateway_extra_charges_row');
				add_action( 'woocommerce_cart_totals_before_order_total', 'sv_cod_add_payment_gateway_extra_charges_row');
			}
		}
		return $totals;
	}
}
add_filter('woocommerce_get_order_item_totals','sv_order_item_totals');
if(!function_exists('sv_order_item_totals')){
	function sv_order_item_totals($total_rows){
		$cart_subtotal = $total_rows['cart_subtotal']['value'];
		$order_total = $total_rows['order_total']['value'];
		if($cart_subtotal != $order_total){
			$cart_subtotal = str_replace('<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#8369;</span>', '', $cart_subtotal);
			$cart_subtotal = str_replace('</span>', '', $cart_subtotal);
			$order_total = str_replace('<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#8369;</span>', '', $order_total);
			$order_total = str_replace('</span>', '', $order_total);
			$total_rows['price_balance'] = 	array(
				'label' => esc_html__("Balance:","supershop"),
	      		'value' => woocommerce_price($cart_subtotal-$order_total)
				);
		}
		return $total_rows;
	}
}

add_action( 'woocommerce_admin_order_totals_after_total', 'sv_admin_order_totals_after_total' );
if(!function_exists('sv_admin_order_totals_after_total')){
	function sv_admin_order_totals_after_total($order_id){
		$order = new WC_Order($order_id);
		$total = $order->get_total();
		$subtotal = $order->get_subtotal();
		if($total != $subtotal){
			$balance = $subtotal-$total;?>
			<tr>
				<td class="label"><?php esc_html_e("Balance","supershop"); ?>:</td>
				<td>
				</td>
				<td class="total"><?php echo woocommerce_price( $balance ); ?></td>
			</tr>
			<?php
		}
	}
}

function devvn_wc_custom_get_price_html( $price, $product ) {
    if ( $product->get_price() == 0 or $product->get_price() == 1) {
        if ( $product->is_on_sale() && $product->get_regular_price() ) {
            $regular_price = wc_get_price_to_display( $product, array( 'qty' => 1, 'price' => $product->get_regular_price() ) );
 
            $price = wc_format_price_range( $regular_price, __( 'Free!', 'woocommerce' ) );
        } else {
            $price = '<span class="woocommerce-Price-amount amount">' . __( 'Giá: Liên hệ', 'woocommerce' ) . '</span>';
        }
    }
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'devvn_wc_custom_get_price_html', 10, 2 );