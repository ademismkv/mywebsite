<?php
/**
 * Terminal Portfolio functions and definitions
 */

function terminal_portfolio_scripts() {
    wp_enqueue_style( 'terminal-portfolio-style', get_stylesheet_uri() );
    wp_enqueue_script( 'terminal-portfolio-js', get_template_directory_uri() . '/terminal.js', array(), '1.0', true );
    
    // Add nonce for REST API
    wp_localize_script( 'terminal-portfolio-js', 'wpApiSettings', array(
        'root' => esc_url_raw( rest_url() ),
        'nonce' => wp_create_nonce( 'wp_rest' )
    ));
}
add_action( 'wp_enqueue_scripts', 'terminal_portfolio_scripts' );

// Add support for document title
add_theme_support( 'title-tag' );

// Register a navigation menu if needed
function register_terminal_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
    )
  );
}
add_action( 'init', 'register_terminal_menus' );

/**
 * Handle terminal message submissions
 */
function handle_terminal_message(WP_REST_Request $request) {
    $message = $request->get_param('message');
    
    if (empty($message)) {
        return new WP_Error('empty_message', 'Message is empty', array('status' => 400));
    }

    // Simple .env parser
    $env_file = ABSPATH . '.env';
    $waha_url = '';
    $api_key = '';
    $chat_id = '';

    if (file_exists($env_file)) {
        $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '#') === 0) continue;
            
            $parts = explode('=', $line, 2);
            if (count($parts) === 2) {
                $name = trim($parts[0]);
                $value = trim($parts[1]);
                $value = trim($value, '"\''); // Remove surrounding quotes
                if ($name === 'WAHA_URL') $waha_url = $value;
                if ($name === 'WAHA_API_KEY') $api_key = $value;
                if ($name === 'WAHA_CHAT_ID') $chat_id = $value;
            }
        }
    }

    if (empty($waha_url)) {
        return new WP_Error('missing_url', 'WAHA_URL missing in .env', array('status' => 500));
    }
    if (empty($api_key)) {
        return new WP_Error('missing_key', 'WAHA_API_KEY missing in .env', array('status' => 500));
    }
    if (empty($chat_id)) {
        return new WP_Error('missing_chat_id', 'WAHA_CHAT_ID missing in .env', array('status' => 500));
    }

    $response = wp_remote_post($waha_url, array(
        'timeout' => 15, // Increased timeout
        'headers' => array(
            'Content-Type' => 'application/json',
            'X-Api-Key' => $api_key,
        ),
        'body' => json_encode(array(
            'chatId' => $chat_id,
            'text' => $message,
            'session' => 'default'
        )),
    ));

    if (is_wp_error($response)) {
        return new WP_Error('api_error', 'Connection failed: ' . $response->get_error_message(), array('status' => 500));
    }

    $status_code = wp_remote_retrieve_response_code($response);
    if ($status_code !== 200 && $status_code !== 201) {
        $body = wp_remote_retrieve_body($response);
        return new WP_Error('api_error', "WAHA returned error ($status_code): " . $body, array('status' => 500));
    }

    return array('success' => true);
}

add_action('rest_api_init', function () {
    register_rest_route('terminal/v1', '/message', array(
        'methods' => 'POST',
        'callback' => 'handle_terminal_message',
        'permission_callback' => '__return_true', // In production, add security here
    ));
});
