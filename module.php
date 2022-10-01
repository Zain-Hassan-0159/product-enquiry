<?php
// load basic classes
namespace WeDevs\DokanPro\Modules\ProductEnquiry;



class widget_pri extends Module{
    function __construct() {
        add_action( 'wp_ajax_dokan_product_enquiry', array( $this, 'send_email' ) );
        add_action( 'wp_ajax_nopriv_dokan_product_enquiry', array( $this, 'send_email' ) );
    }

    function send_email() {
        if ( ! isset( $_POST['dokan_product_enquiry_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['dokan_product_enquiry_nonce'] ) ), 'dokan_product_enquiry' ) ) {
            wp_send_json_error( __( 'Nonce verification failed!', 'dokan' ) );
        }

        $url             = isset( $_POST['url'] ) ? esc_url_raw( wp_unslash( $_POST['url'] ) ) : '';
        $phone            = isset( $_POST['phone'] ) ?  wp_unslash( $_POST['phone'] )  : '';
        $codePostal            = isset( $_POST['code_postal'] ) ?  wp_unslash( $_POST['code_postal'] )  : '';
        $pays            = isset( $_POST['author_pays'] ) ?  sanitize_textarea_field(wp_unslash( $_POST['author_pays'] ))  : '';
        $message1         = isset( $_POST['enq_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['enq_message'] ) ) : '';
        $product_id      = isset( $_POST['enquiry_id'] ) ? absint( wp_unslash( $_POST['enquiry_id'] ) ) : 0;
        $vendor_id       = isset( $_POST['seller_id'] ) ? absint( wp_unslash( $_POST['seller_id'] ) ) : 0;
        $recaptcha_token = isset( $_POST['dokan_product_enquiry_recaptcha_token'] ) ? wp_unslash( $_POST['dokan_product_enquiry_recaptcha_token'] ) : ''; // phpcs:ignore
        $message = $message1 . "<br>" . $phone;

        if ( ! empty( $url ) ) {
            wp_send_json_error( __( 'Boo ya!', 'dokan' ) );
        }

        if ( is_user_logged_in() ) {
            $sender         = wp_get_current_user();
            $customer_name  = $sender->display_name;
            $customer_email = $sender->user_email;
        } else {
            $customer_name  = isset( $_POST['author'] ) ? sanitize_text_field( wp_unslash( $_POST['author'] ) ) : '';
            $customer_email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
        }

        if ( empty( $customer_name ) ) {
            wp_send_json_error( __( 'Customer name cannot be empty!', 'dokan' ) );
        }

        if ( empty( $customer_email ) ) {
            wp_send_json_error( __( 'Customer email cannot be empty!', 'dokan' ) );
        }

        if ( empty( $message ) ) {
            wp_send_json_error( __( 'Message cannot be empty!', 'dokan' ) );
        }

        // no seller found
        $vendor = dokan()->vendor->get( $vendor_id );
        if ( ! $vendor || is_wp_error( $vendor ) ) {
            wp_send_json_error( __( 'Something went wrong!', 'dokan' ) );
        }

        // no product found
        $product = wc_get_product( $product_id );
        if ( ! $product ) {
            wp_send_json_error( __( 'Something went wrong!', 'dokan' ) );
        }

        // Validate recaptcha if site key and secret key exist.
        if ( dokan_get_recaptcha_site_and_secret_keys( true ) ) {
            $recaptcha_keys     = dokan_get_recaptcha_site_and_secret_keys();
            $recaptcha_validate = dokan_handle_recaptcha_validation( 'dokan_product_enquiry_recaptcha', $recaptcha_token, $recaptcha_keys['secret_key'] );

            if ( empty( $recaptcha_validate ) ) {
                wp_send_json_error( __( 'reCAPTCHA verification failed!', 'dokan' ) );
            }
        }

        // Email arguments.
        $email_args = array(
            $vendor,
            $product,
            dokan_get_client_ip(),
            $this->get_user_agent(),
            $customer_name,
            $customer_email,
            $message,
        );

        //To Save The Message In Custom Post Type
        $new_post = array(
            'post_title'    => $product->name,
            'post_status'   => 'publish',           // Choose: publish, preview, future, draft, etc.
            'post_type' => 'product_enquiry_data'  //'post',page' or use a custom post type if you want to
        );

        $pid = wp_insert_post($new_post);
        update_post_meta($pid , 'slide_one', $customer_name);
        update_post_meta($pid , 'slide_two', $customer_email);
        update_post_meta($pid , 'slide_three', $phone );
        update_post_meta($pid , 'slide_five', $codePostal );
        update_post_meta($pid , 'slide_six', $pays );
        update_post_meta($pid , 'slide_four', $message1);

        do_action_ref_array( 'dokan_send_enquiry_email', $email_args );

        $success = sprintf( '<div class="alert alert-success">%s</div>', __( 'Email sent successfully!', 'dokan' ) );
        wp_send_json_success( $success );
    }
}

new widget_pri;




