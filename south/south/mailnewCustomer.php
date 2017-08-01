<?php
require_once('../../../wp-config.php');
$to = get_option( 'admin_email' );
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];			
$Watercraft = $_POST['Watercraft'];
$RentalDate= $_POST['RentalDate'];
$RentalTime = $_POST['RentalTime'];
$ReturnDate = $_POST['ReturnDate'];
$ReturnTime = $_POST['ReturnTime'];
$RentalAmount = $_POST['RentalAmount'];
$Accessories = $_POST['Accessories'];
$DamageWaiver = $_POST['DamageWaiver'];
$SalesTax = $_POST['SalesTax'];
$GrandTotal = $_POST['GrandTotal'];
$boatID = $_POST['boatID'];



$subject="Rental Boat Information";   
$body = "Rental Boat Information \n\n\n".
"Naam: ".$_POST['name']." \n".
"E-mail:".$_POST['email']." \n".
"Phone:".$phone." \n".
"Departure Date:".$RentalDate." \n".
"Time:".$RentalTime." \n".
"Address:".$address." \n".
"Watercraft:".$Watercraft." \n".
"RentalAmount:".$RentalAmount." \n".
"Accessories:".$Accessories." \n".
"DamageWaiver:".$DamageWaiver." \n".
"SalesTax:".$SalesTax." \n".
"GrandTotal:".$GrandTotal." \n".
$email=$_POST[email]; 
$headers = "From: $email \r\n"; 
$headers .= "Reply-To: $email \r\n";
$mailSuc = mail($to, $subject, $body,$headers);
if($mailSuc){
echo "Thanks You We will call Soon";
}
$my_post = array(
  'post_title'    => $name,
  'post_type'     => 'customer',
);

// Insert the post into the database
$post_id = wp_insert_post($my_post);
add_post_meta($post_id, 'email_id', $_POST['email'], true);
add_post_meta($post_id, 'watercraft', $Watercraft, true);
add_post_meta($post_id, 'rental_date', $RentalDate, true);
add_post_meta($post_id, 'rental_time', $RentalTime, true);
add_post_meta($post_id, 'rental_amount', $RentalAmount, true);
add_post_meta($post_id, 'accessories', $Accessories, true);
add_post_meta($post_id, 'damage_waiver', $DamageWaiver, true);
add_post_meta($post_id, 'sales_tax', $SalesTax, true);
add_post_meta($post_id, 'grand_total', $GrandTotal, true);
add_post_meta($post_id, 'rental_boat', $boatID, true);
?>