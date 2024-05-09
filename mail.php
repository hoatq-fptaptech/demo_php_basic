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

// Địa chỉ máy chủ SMTP của Gmail
$smtp_server = 'smtp.gmail.com';

// Cổng SMTP của Gmail
$smtp_port = 587;

// Tài khoản Gmail của bạn
$smtp_username = 'hoatq4@fpt.edu.vn';

// Mật khẩu ứng dụng (không phải mật khẩu tài khoản Gmail)
$smtp_password = 'qhnzfxbzlstiowjv';

// Kết nối tới máy chủ SMTP của Gmail
$smtp_conn = fsockopen($smtp_server, $smtp_port, $errno, $errstr, 30);

if (!$smtp_conn) {
    echo "Failed to connect to SMTP server";
} else {
    // Đọc phản hồi từ máy chủ SMTP
    $response = fgets($smtp_conn, 4096);
    
    // Gửi lệnh EHLO để bắt đầu phiên làm việc
    fputs($smtp_conn, "EHLO $smtp_server\r\n");
    $response = fgets($smtp_conn, 4096);
    
    // Xác thực với máy chủ SMTP bằng tài khoản và mật khẩu ứng dụng
    fputs($smtp_conn, "AUTH LOGIN\r\n");
    $response = fgets($smtp_conn, 4096);

    fputs($smtp_conn, base64_encode($smtp_username) . "\r\n");
    $response = fgets($smtp_conn, 4096);
    
    fputs($smtp_conn, base64_encode($smtp_password) . "\r\n");
    $response = fgets($smtp_conn, 4096);

    // Gửi email
    fputs($smtp_conn, "MAIL FROM: <$from_email>\r\n");
    $response = fgets($smtp_conn, 4096);
    
    fputs($smtp_conn, "RCPT TO: <$to_email>\r\n");
    $response = fgets($smtp_conn, 4096);
    
    fputs($smtp_conn, "DATA\r\n");
    $response = fgets($smtp_conn, 4096);
    
    fputs($smtp_conn, "Subject: $subject\r\n");
    fputs($smtp_conn, "From: $from_email\r\n");
    fputs($smtp_conn, "To: $to_email\r\n");
    fputs($smtp_conn, "\r\n");
    fputs($smtp_conn, "$message\r\n");
    fputs($smtp_conn, ".\r\n");
    $response = fgets($smtp_conn, 4096);
    
    // Đóng kết nối
    fputs($smtp_conn, "QUIT\r\n");
    fclose($smtp_conn);

    echo $response;
}
