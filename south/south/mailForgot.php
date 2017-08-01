<?php
require_once('../../../wp-config.php');
$to = $_POST['email'];
$from = get_option( 'admin_email' );
query_posts(array('post_type'=>'renteluser','meta_key'=>'email','meta_value'=>$_POST['email']));
if (have_posts()) : while (have_posts()) : the_post();
if($_POST['email']==get_field('email')){
$subject="Rental Boat";   
$body = "Rental Boat \n\n\n".
"Password: ".get_field('password')." \n". 
$headers = "From: $from \r\n"; 
$headers .= "Reply-To: $from \r\n";
$mailSuc = mail($to, $subject, $body,$headers);
if($mailSuc){
echo "Password is Sucessufully Send in your Email ID";
}
 } endwhile; endif; ?>