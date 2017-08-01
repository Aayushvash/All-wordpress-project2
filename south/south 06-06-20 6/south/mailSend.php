<?php
require_once('../../../wp-config.php');
$to = get_option( 'admin_email' );
$subject="Rental Boat Information";   
$body = "Rental Boat Information \n\n\n".

"Naam: ".$_POST['name']." \n".
"E-mail:".$_POST['email']." \n".
"Departure Date:".$_POST['phone']." \n".
"Time:".$_POST['password']." \n".
"address:".$_POST['address']." \n".
$email=$_POST[email]; 
$headers = "From: $email \r\n"; 
$headers .= "Reply-To: $email \r\n";
$mailSuc = mail($to, $subject, $body,$headers);
if($mailSuc){
echo "Thanks Your are sucessufully Register Now you can Login!";
}
$my_post = array(
  'post_title'    => $_POST['name'],
  'post_type'     => 'renteluser',
  'post_status' => 'publish',
);

// Insert the post into the database
$post_id = wp_insert_post($my_post);
add_post_meta($post_id, 'email', $_POST['email'], true);
add_post_meta($post_id, 'phone', $_POST['phone'], true);
add_post_meta($post_id, 'password', $_POST['password'], true);
add_post_meta($post_id, 'address', $_POST['address'], true);
?>