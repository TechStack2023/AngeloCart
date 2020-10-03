function get_unpaid_orders() {
    global $wpdb;

    $unpaid_orders = $wpdb->get_col( $wpdb->prepare( "
        SELECT posts.ID
        FROM {$wpdb->posts} AS posts
        WHERE posts.post_status = 'wc-on-hold'
        AND posts.post_date < %s
    ", date( 'Y-m-d H:i:s', strtotime('-1 minute') ) ) );

    return $unpaid_orders;
}

add_action( 'woocommerce_cancel_unpaid_submitted', 'cancel_unpaid_orders' );
function cancel_unpaid_orders() {
    $unpaid_orders = get_unpaid_orders();

    if ( $unpaid_orders ) {
        foreach ( $unpaid_orders as $unpaid_order ) {
            $order = wc_get_order( $unpaid_order );
            $cancel_order = true;

            foreach  ( $order->get_items() as $item_key => $item_values) {
                $manage_stock = get_post_meta( $item_values, '_manage_stock', true );
                if ( $manage_stock == "yes" ) {
                    $payment_method = $order->get_payment_method();
                    if ( $payment_method == "bacs" ) {
                        $cancel_order = false;
                    }
                }
            }
            if ( $cancel_order == true ) {
                $order -> update_status( 'cancelled', __( 'The order was cancelled due to no payment from customer.', 'woocommerce') );
            }
        }
    }
}
