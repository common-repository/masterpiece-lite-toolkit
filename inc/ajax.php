<?php 
    if (!function_exists('masterpiece_toolkit_ajax_set_view_count')) {

        function masterpiece_toolkit_ajax_set_view_count() {
            check_ajax_referer('masterpiece_toolkit_set_view_count', 'wpnonce');

            if (!empty($_POST['post_id'])) {
                $post_id = (int) $_POST['post_id'];
                $data['count'] = masterpiece_toolkit_set_view_count($post_id);
                echo json_encode($data);
            }
            die();
        }

        add_action('wp_ajax_masterpiece_toolkit_set_view_count', 'masterpiece_toolkit_ajax_set_view_count');
        add_action('wp_ajax_nopriv_masterpiece_toolkit_set_view_count', 'masterpiece_toolkit_ajax_set_view_count');
    }

    if (!function_exists('masterpiece_toolkit_plus_send_contact_widget')) {

        function masterpiece_toolkit_plus_send_contact_widget() {

            if ( ! check_ajax_referer('masterpiece_toolkit_plus_send_contact_widget', 'ajax_nonce_masterpiece_toolkit_plus_send_contact_widget', false) ) {
                die( esc_html__('Oops! errors occured.', 'masterpiece-lite-toolkit') );
            }

            foreach ($_POST as $key => $value) {
                if (ini_get('magic_quotes_gpc')) {
                    $_POST[$key] = stripslashes($_POST[$key]);
                }
                $_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
            }

            $name    = sanitize_user( $_POST["name"] );
            $email   = sanitize_email( $_POST["email"] );
            $message = esc_html( $_POST["message"] );

            $message_body = "Name: {$name}" . PHP_EOL. "Message: {$message}";

            $to = get_bloginfo('admin_email');

            if ( isset( $_POST["subject"] ) && $_POST["subject"] != '' ) {
                $subject = 'Contact Form: '.$name.' - '.sanitize_title( $_POST['subject'] );
            } else {
                $subject = "Contact Form: $name";
            }

            $headers[] = 'From: ' . $name . ' <' . $email . '>';
            $headers[] = 'Cc: ' . $name . ' <' . $email . '>';

            $result = esc_html__('Oops! errors occured.', 'masterpiece-lite-toolkit');

            if (wp_mail($to, $subject, $message_body, $headers)) {
                $result = esc_html__('Success! Your email has been sent.', 'masterpiece-lite-toolkit');
            }

            echo json_encode($result);
            die();
        }

        add_action('wp_ajax_masterpiece_toolkit_plus_send_contact_widget', 'masterpiece_toolkit_plus_send_contact_widget');
        add_action('wp_ajax_nopriv_masterpiece_toolkit_plus_send_contact_widget', 'masterpiece_toolkit_plus_send_contact_widget');
    }