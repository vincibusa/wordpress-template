<?php
// Theme functions will be added here.

function gildedspoon_enqueue_styles() {
    wp_enqueue_style(
        'tailwindcss',
        'https://cdn.tailwindcss.com?plugins=forms,container-queries',
        array(),
        null // No version needed for CDN link without a specific version number
    );
    // If you had a main theme stylesheet (e.g., style.css) to enqueue, you'd do it here too:
    wp_enqueue_style( 'gildedspoon-style', get_stylesheet_uri() );

    // Enqueue main.js
    wp_enqueue_script(
        'gildedspoon-main-js',
        get_template_directory_uri() . '/js/main.js',
        array(), // Dependencies
        null,    // Version
        true     // Load in footer
    );
}
add_action( 'wp_enqueue_scripts', 'gildedspoon_enqueue_styles' );

// Register Booking Custom Post Type
function gildedspoon_register_booking_cpt() {
    $labels = array(
        'name'               => _x( 'Bookings', 'post type general name', 'gildedspoon' ),
        'singular_name'      => _x( 'Booking', 'post type singular name', 'gildedspoon' ),
        'menu_name'          => _x( 'Bookings', 'admin menu', 'gildedspoon' ),
        'name_admin_bar'     => _x( 'Booking', 'add new on admin bar', 'gildedspoon' ),
        'add_new'            => _x( 'Add New', 'booking', 'gildedspoon' ),
        'add_new_item'       => __( 'Add New Booking', 'gildedspoon' ),
        'new_item'           => __( 'New Booking', 'gildedspoon' ),
        'edit_item'          => __( 'Edit Booking', 'gildedspoon' ),
        'view_item'          => __( 'View Booking', 'gildedspoon' ),
        'all_items'          => __( 'All Bookings', 'gildedspoon' ),
        'search_items'       => __( 'Search Bookings', 'gildedspoon' ),
        'parent_item_colon'  => __( 'Parent Bookings:', 'gildedspoon' ),
        'not_found'          => __( 'No bookings found.', 'gildedspoon' ),
        'not_found_in_trash' => __( 'No bookings found in Trash.', 'gildedspoon' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Custom Post Type for restaurant bookings.', 'gildedspoon' ),
        'public'             => true, // Allows UI in admin
        'publicly_queryable' => false, // Individual bookings not viewable on front-end
        'show_ui'            => true, // Show in admin
        'show_in_menu'       => true, // Show in admin menu
        'query_var'          => false, // Not needed if not publicly queryable
        'rewrite'            => false, // No front-end slugs for individual bookings
        'capability_type'    => 'post',
        'has_archive'        => false, // No public archive page of all bookings
        'hierarchical'       => false,
        'menu_position'      => 20, // Position in admin menu (below Pages)
        'supports'           => array( 'title', 'custom-fields' ),
        'menu_icon'          => 'dashicons-calendar-alt', // WordPress Dashicon
        'show_in_rest'       => true // Enable block editor support
    );

    register_post_type( 'booking', $args );

    // Add text domain for translations - good practice
    // Ensure you have a /languages folder in your theme if you plan to add .mo/.po files
    load_theme_textdomain( 'gildedspoon', get_template_directory() . '/languages' );
}
add_action( 'init', 'gildedspoon_register_booking_cpt' );

// Handle Booking Form Submission
function gildedspoon_handle_booking_submission() {
    if ( isset($_POST['submit_booking']) && isset($_POST['booking_nonce_field']) ) {
        if ( ! wp_verify_nonce( $_POST['booking_nonce_field'], 'make_booking_nonce' ) ) {
            wp_redirect(add_query_arg('booking_error', 'nonce_failure', wp_get_referer() . '#booking-modal'));
            exit;
        }

        // Sanitize and validate fields
        $nome     = isset($_POST['booking_nome']) ? sanitize_text_field($_POST['booking_nome']) : '';
        $cognome  = isset($_POST['booking_cognome']) ? sanitize_text_field($_POST['booking_cognome']) : '';
        $email    = isset($_POST['booking_email']) ? sanitize_email($_POST['booking_email']) : '';
        $telefono = isset($_POST['booking_telefono']) ? sanitize_text_field($_POST['booking_telefono']) : '';
        $data     = isset($_POST['booking_data']) ? sanitize_text_field($_POST['booking_data']) : ''; 
        $orario   = isset($_POST['booking_orario']) ? sanitize_text_field($_POST['booking_orario']) : '';
        $note     = isset($_POST['booking_note']) ? sanitize_textarea_field($_POST['booking_note']) : '';

        // Basic validation
        if ( empty($nome) || empty($cognome) || empty($email) || empty($telefono) || empty($data) || empty($orario) ) {
            wp_redirect(add_query_arg('booking_error', 'required_fields', wp_get_referer() . '#booking-modal'));
            exit;
        }
        if ( !is_email( $email ) ) {
            wp_redirect(add_query_arg('booking_error', 'invalid_email', wp_get_referer() . '#booking-modal'));
            exit;
        }

        // Validate date format (Y-m-d)
        $date_format = 'Y-m-d';
        $d = DateTime::createFromFormat($date_format, $data);
        if ( !$d || $d->format($date_format) !== $data ) {
            wp_redirect(add_query_arg('booking_error', 'invalid_date', wp_get_referer() . '#booking-modal'));
            exit;
        }

        // Validate time format (H:i)
        $time_format = 'H:i';
        $t = DateTime::createFromFormat($time_format, $orario);
        if ( !$t || $t->format($time_format) !== $orario ) {
             // Also allow H:i:s if the browser sends it
            $time_format_seconds = 'H:i:s';
            $t_s = DateTime::createFromFormat($time_format_seconds, $orario);
            if (!$t_s || $t_s->format($time_format_seconds) !== $orario) {
                wp_redirect(add_query_arg('booking_error', 'invalid_time', wp_get_referer() . '#booking-modal'));
                exit;
            }
        }


        $post_title = sprintf("Booking for %s %s on %s at %s", $nome, $cognome, $data, $orario);
        $booking_post = array(
            'post_title'   => $post_title,
            'post_type'    => 'booking',
            'post_status'  => 'pending',
        );

        $post_id = wp_insert_post($booking_post);

        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_booking_nome', $nome);
            update_post_meta($post_id, '_booking_cognome', $cognome);
            update_post_meta($post_id, '_booking_email', $email);
            update_post_meta($post_id, '_booking_telefono', $telefono);
            update_post_meta($post_id, '_booking_data', $data);
            update_post_meta($post_id, '_booking_orario', $orario);
            update_post_meta($post_id, '_booking_note', $note);
            update_post_meta($post_id, '_booking_status', 'Pending Confirmation');

            wp_redirect(add_query_arg('booking_success', '1', wp_get_referer() . '#booking-modal'));
            exit;
        } else {
            wp_redirect(add_query_arg('booking_error', 'submission_failed', wp_get_referer() . '#booking-modal'));
            exit;
        }
    }
}
add_action('init', 'gildedspoon_handle_booking_submission');

// Display Booking Feedback
function gildedspoon_display_booking_feedback() {
    $message_html = '';
    if (isset($_GET['booking_success'])) {
        $message_html = '<div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">' . __('Grazie! La tua richiesta di prenotazione è stata inviata.', 'gildedspoon') . '</div>';
    } elseif (isset($_GET['booking_error'])) {
        $error_code = sanitize_key($_GET['booking_error']);
        $error_message = __('Si è verificato un errore. Per favore riprova.', 'gildedspoon'); // Default
        switch ($error_code) {
            case 'nonce_failure':
                $error_message = __('Controllo di sicurezza fallito. Per favore riprova.', 'gildedspoon');
                break;
            case 'required_fields':
                $error_message = __('Per favore compila tutti i campi obbligatori.', 'gildedspoon');
                break;
            case 'invalid_email':
                $error_message = __('Per favore inserisci un indirizzo email valido.', 'gildedspoon');
                break;
            case 'invalid_date':
                $error_message = __('Per favore inserisci un formato data valido (AAAA-MM-GG).', 'gildedspoon');
                break;
            case 'invalid_time':
                $error_message = __('Per favore inserisci un formato orario valido (HH:MM).', 'gildedspoon');
                break;
            case 'submission_failed':
                $error_message = __('Impossibile salvare la prenotazione. Per favore riprova più tardi.', 'gildedspoon');
                break;
        }
        $message_html = '<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">' . esc_html($error_message) . '</div>';
    }

    if ($message_html) {
        echo $message_html;
        // If there's a message (success or error), and we have a hash for the modal, try to show the modal.
        // This helps keep the modal open to see the message.
        if (isset($_GET['booking_success']) || isset($_GET['booking_error'])) {
             echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    if (window.location.hash === '#booking-modal' || true) { // Ensure modal always tries to open if feedback is present
                        const modal = document.getElementById('booking-modal');
                        if (modal && modal.classList.contains('hidden')) {
                           modal.classList.remove('hidden');
                        }
                        // Attempt to clear query args from URL to prevent message re-showing on refresh
                        if (history.replaceState) {
                            const cleanUrl = window.location.protocol + '//' + window.location.host + window.location.pathname + window.location.hash;
                            history.replaceState({ path: cleanUrl }, '', cleanUrl);
                        }
                    }
                });
            </script>";
        }
    }
}
// Note: gildedspoon_display_booking_feedback() is called from footer.php

// Customize Booking CPT Admin Columns
// 1. Define Custom Columns
add_filter( 'manage_booking_posts_columns', 'gildedspoon_set_booking_cpt_columns' );
function gildedspoon_set_booking_cpt_columns($columns) {
    // Default columns: cb, title, date
    // Unset default date, we'll re-add it as 'Submitted On'
    unset( $columns['date'] );

    $new_columns = array();
    $new_columns['cb'] = $columns['cb']; // Checkbox
    $new_columns['title'] = __( 'Booking For', 'gildedspoon' ); // Keep generated title
    $new_columns['booking_details'] = __( 'Customer Details', 'gildedspoon' );
    $new_columns['booking_date_time'] = __( 'Requested Date/Time', 'gildedspoon' );
    $new_columns['booking_status'] = __( 'Status', 'gildedspoon' );
    $new_columns['booking_notes'] = __( 'Notes', 'gildedspoon' );
    $new_columns['date'] = __( 'Submitted On', 'gildedspoon' ); // WordPress default submission date

    return $new_columns;
}

// 2. Populate Custom Columns
add_action( 'manage_booking_posts_custom_column', 'gildedspoon_booking_cpt_custom_column', 10, 2 );
function gildedspoon_booking_cpt_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'booking_details':
            $nome     = get_post_meta( $post_id, '_booking_nome', true );
            $cognome  = get_post_meta( $post_id, '_booking_cognome', true );
            $email    = get_post_meta( $post_id, '_booking_email', true );
            $telefono = get_post_meta( $post_id, '_booking_telefono', true );
            
            echo '<strong>' . esc_html($cognome) . ', ' . esc_html($nome) . '</strong><br/>';
            if ($email) {
                echo 'Email: <a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a><br/>';
            }
            if ($telefono) {
                echo 'Phone: ' . esc_html($telefono);
            }
            break;

        case 'booking_date_time':
            $data   = get_post_meta( $post_id, '_booking_data', true );
            $orario = get_post_meta( $post_id, '_booking_orario', true );
            
            if ($data) {
                $date_obj = DateTime::createFromFormat('Y-m-d', $data);
                echo $date_obj ? esc_html($date_obj->format('d/m/Y')) : esc_html($data); // Display as DD/MM/YYYY
                echo '<br/>';
            }
            if ($orario) {
                 // Browsers might send H:i or H:i:s. WordPress saves what's sent.
                 // We create a DateTime object to reliably format it.
                 $time_obj = date_create($orario); 
                 echo $time_obj ? esc_html(date_format($time_obj, 'H:i')) : esc_html($orario);
            }
            break;

        case 'booking_status':
            $status = get_post_meta( $post_id, '_booking_status', true );
            echo esc_html( $status ? $status : 'N/A' );
            break;

        case 'booking_notes':
            $notes = get_post_meta( $post_id, '_booking_note', true );
            if ( !empty($notes) ) {
                echo esc_html( wp_trim_words( $notes, 10, '...' ) );
            } else {
                echo '—'; // Em dash for no notes
            }
            break;
    }
}

// Meta Box for Booking Details
// 1. Add Meta Box Action
function gildedspoon_add_booking_details_meta_box() {
    add_meta_box(
        'gildedspoon_booking_details', // ID of the meta box
        __('Booking Details', 'gildedspoon'), // Title
        'gildedspoon_booking_details_meta_box_html', // Callback function to render HTML
        'booking', // Custom Post Type slug
        'normal', // Context (normal, side, advanced)
        'high' // Priority
    );
}
add_action('add_meta_boxes_booking', 'gildedspoon_add_booking_details_meta_box');

// 2. Render Meta Box HTML
function gildedspoon_booking_details_meta_box_html($post) {
    wp_nonce_field('booking_details_nonce', 'booking_details_nonce_field');

    $nome = get_post_meta($post->ID, '_booking_nome', true);
    $cognome = get_post_meta($post->ID, '_booking_cognome', true);
    $email = get_post_meta($post->ID, '_booking_email', true);
    $telefono = get_post_meta($post->ID, '_booking_telefono', true);
    $data = get_post_meta($post->ID, '_booking_data', true);
    $orario = get_post_meta($post->ID, '_booking_orario', true);
    $note = get_post_meta($post->ID, '_booking_note', true);
    $status = get_post_meta($post->ID, '_booking_status', true);
    
    $all_statuses = array('Pending Confirmation', 'Confirmed', 'Refused', 'Cancelled');

    // Basic styling for the meta box form
    echo '<style>
        .booking-meta-box-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .booking-meta-box-field { margin-bottom: 15px; }
        .booking-meta-box-field label { display: block; font-weight: bold; margin-bottom: 5px; }
        .booking-meta-box-field input[type="text"],
        .booking-meta-box-field input[type="email"],
        .booking-meta-box-field input[type="tel"],
        .booking-meta-box-field input[type="date"],
        .booking-meta-box-field input[type="time"],
        .booking-meta-box-field select,
        .booking-meta-box-field textarea { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ddd; }
        .booking-meta-box-field.full-width { grid-column: 1 / -1; }
    </style>';

    echo '<div class="booking-meta-box-grid">';

    echo '<div class="booking-meta-box-field"><label for="booking_meta_nome">' . __('Nome', 'gildedspoon') . ':</label><input type="text" id="booking_meta_nome" name="booking_meta_nome" value="' . esc_attr($nome) . '"></div>';
    echo '<div class="booking-meta-box-field"><label for="booking_meta_cognome">' . __('Cognome', 'gildedspoon') . ':</label><input type="text" id="booking_meta_cognome" name="booking_meta_cognome" value="' . esc_attr($cognome) . '"></div>';
    echo '<div class="booking-meta-box-field"><label for="booking_meta_email">' . __('Email', 'gildedspoon') . ':</label><input type="email" id="booking_meta_email" name="booking_meta_email" value="' . esc_attr($email) . '"></div>';
    echo '<div class="booking-meta-box-field"><label for="booking_meta_telefono">' . __('Telefono', 'gildedspoon') . ':</label><input type="tel" id="booking_meta_telefono" name="booking_meta_telefono" value="' . esc_attr($telefono) . '"></div>';
    echo '<div class="booking-meta-box-field"><label for="booking_meta_data">' . __('Data', 'gildedspoon') . ':</label><input type="date" id="booking_meta_data" name="booking_meta_data" value="' . esc_attr($data) . '"></div>';
    echo '<div class="booking-meta-box-field"><label for="booking_meta_orario">' . __('Orario', 'gildedspoon') . ':</label><input type="time" id="booking_meta_orario" name="booking_meta_orario" value="' . esc_attr($orario) . '"></div>';
    
    echo '<div class="booking-meta-box-field full-width"><label for="booking_meta_note">' . __('Note', 'gildedspoon') . ':</label><textarea id="booking_meta_note" name="booking_meta_note" rows="4">' . esc_textarea($note) . '</textarea></div>';
    
    echo '<div class="booking-meta-box-field full-width"><label for="booking_meta_status">' . __('Status', 'gildedspoon') . ':</label>';
    echo '<select name="booking_meta_status" id="booking_meta_status">';
    foreach ($all_statuses as $s) {
        echo '<option value="' . esc_attr($s) . '"' . selected($status, $s, false) . '>' . esc_html($s) . '</option>';
    }
    echo '</select></div>';

    echo '</div>'; // Close grid
}

// 3. Save Meta Box Data
function gildedspoon_save_booking_details_meta($post_id) {
    if (!isset($_POST['booking_details_nonce_field']) || !wp_verify_nonce($_POST['booking_details_nonce_field'], 'booking_details_nonce')) {
        return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    $fields_to_save = array(
        '_booking_nome' => 'booking_meta_nome',
        '_booking_cognome' => 'booking_meta_cognome',
        '_booking_email' => 'booking_meta_email',
        '_booking_telefono' => 'booking_meta_telefono',
        '_booking_data' => 'booking_meta_data',
        '_booking_orario' => 'booking_meta_orario',
        '_booking_note' => 'booking_meta_note',
        '_booking_status' => 'booking_meta_status',
    );

    foreach ($fields_to_save as $meta_key => $post_field_name) {
        if (isset($_POST[$post_field_name])) {
            $value = $_POST[$post_field_name]; // Raw value

            // Sanitize based on field type
            if ($meta_key === '_booking_email') {
                $value = sanitize_email($value);
            } elseif ($meta_key === '_booking_note') {
                $value = sanitize_textarea_field($value);
            } else {
                // For _booking_data, _booking_orario, _booking_status, and names/phone, sanitize_text_field is appropriate.
                // Date/Time formats are not strictly validated here but WordPress saves them as text.
                // The booking form submission already does stricter date/time validation.
                $value = sanitize_text_field($value);
            }
            update_post_meta($post_id, $meta_key, $value);
        }
    }
}
add_action('save_post_booking', 'gildedspoon_save_booking_details_meta');

?>
