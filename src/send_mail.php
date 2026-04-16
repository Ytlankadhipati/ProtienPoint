<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // ✅ Get form data safely
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $product = $_POST['product'] ?? '';
    $goal = $_POST['goal'] ?? '';
    $experience = $_POST['experience'] ?? '';
    $message = $_POST['message'] ?? '';

    // ❗ Basic validation
    if (empty($name) || empty($email)) {
        die("Invalid form submission");
    }

    // ✅ SMTP Setup
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rishuawasthi1020@gmail.com';
    $mail->Password = 'htap fiym gpuh wwap'; // app password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // ✅ IMPORTANT FIX (avoid Gmail errors)
    $mail->setFrom('rishuawasthi1020@gmail.com', 'Protein Point');
    $mail->addReplyTo($email, $name);

    $mail->addAddress('rishuawasthi1020@gmail.com');

    // ✅ Subject
    $mail->Subject = "New Inquiry from $name";

    // ✅ HTML Email (Professional)
    $mail->isHTML(true);

    $mail->Body = "
    <div style='font-family: Arial, sans-serif; max-width:600px; margin:auto; border:1px solid #ddd; border-radius:10px; overflow:hidden;'>

      <div style='background:#000; color:#fff; padding:15px; text-align:center;'>
        <h2 style='margin:0;'>💪 Protein Point Inquiry</h2>
      </div>

      <div style='padding:20px;'>

        <h3>Customer Details</h3>

        <table style='width:100%; border-collapse:collapse;'>

          <tr>
            <td style='padding:8px; font-weight:bold;'>Name:</td>
            <td style='padding:8px;'>$name</td>
          </tr>

          <tr style='background:#f9f9f9;'>
            <td style='padding:8px; font-weight:bold;'>Email:</td>
            <td style='padding:8px;'>
              <a href='mailto:$email'>$email</a>
            </td>
          </tr>

          <tr>
            <td style='padding:8px; font-weight:bold;'>Phone:</td>
            <td style='padding:8px;'>$phone</td>
          </tr>

          <tr style='background:#f9f9f9;'>
            <td style='padding:8px; font-weight:bold;'>Product:</td>
            <td style='padding:8px;'>$product</td>
          </tr>

          <tr>
            <td style='padding:8px; font-weight:bold;'>Goal:</td>
            <td style='padding:8px;'>$goal</td>
          </tr>

          <tr style='background:#f9f9f9;'>
            <td style='padding:8px; font-weight:bold;'>Experience:</td>
            <td style='padding:8px;'>$experience</td>
          </tr>

        </table>

        <h3 style='margin-top:20px;'>Message</h3>
        <div style='background:#f4f4f4; padding:15px; border-radius:5px;'>
          $message
        </div>

      </div>

      <div style='background:#eee; padding:10px; text-align:center; font-size:12px;'>
        This message was sent from your website
      </div>

    </div>
    ";

    // ✅ Fallback (plain text)
    $mail->AltBody = "New Inquiry from $name\nEmail: $email\nMessage: $message";

    // ✅ Send
    $mail->send();

    // ✅ Redirect (clean UX)
    header("Location: index.html");
    exit;

} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
?>