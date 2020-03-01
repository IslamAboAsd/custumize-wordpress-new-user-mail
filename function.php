add_filter( 'wp_new_user_notification_email', 'custom_wp_new_user_notification_email', 10, 3 );

function custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
    $key = get_password_reset_key( $user );
    $message = sprintf(__('Willkommen auf unserer Dokumenten Cloud Lösung,')) . "\r\n\r\n";
    $message .= 'Um Ihr eigenes sicheres Passwort zu setzten, besuchen Sie bitte die folgende Webseite:' . "\r\n\r\n";
    $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login') . "\r\n\r\n";
    $message .= "Danach können Sie Dokumente mit uns austauschen!" . "\r\n\r\n";
    $message .= "Viele Grüße," . "\r\n";
    $message .= "Ihre Kanzlei Kaufmann & Kaufmann" . "\r\n";
    $wp_new_user_notification_email['message'] = $message;

    $wp_new_user_notification_email['headers'] = 'From: <fileshare@km-kanzlei.com>'; 

    return $wp_new_user_notification_email;
}
 
// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return 'kanzlei Kaufmann';
}
 
// Hooking up our functions to WordPress filters 
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );
