<?php

// Địa chỉ email người nhận
$to_email = "hoatq4@fpt.edu.vn";

// Tiêu đề email
$subject = "Test email using PHP";

// Nội dung email
$message = "This is a test email sent from PHP.";

// Địa chỉ email người gửi
$from_email = "hoatq4@fpt.edu.vn";

// Tiêu đề email được gửi
$headers = "From: $from_email";

// Gửi email
if (mail($to_email, $subject, $message, $headers)) {
    echo "Email sent successfully to $to_email";
} else {
    echo "Email sending failed...";
}
