<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $companyname = $_POST['companyname'];
        $phonenumber = $_POST['phonenumber'];
        $date = $_POST['date'];
        $location = $_POST['location'];
        $message = $_POST['message'];
        $about = $_POST['about'];
        $wholeBody ="";

        $wholeBody .= "From: " . $name. "<br>";
        $wholeBody .= "Email: " . $email . "<br>";
        $wholeBody .= "Company Name: " . $companyname . "<br>";
        $wholeBody .= "Phone Number: " . $phonenumber . "<br>";
        $wholeBody .= "Event Date: " . $date. "<br>";
        $wholeBody .= "Location: " . $location . "<br>";
        $wholeBody .= "Event Type: " . $message . "<br>";
        $wholeBody .= "Budget/Offer For Artist: " . $about ;

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "events.tagit@gmail.com";
        $mail->Password = 'KamogeloKgari2.';
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; //tls

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress("Kamogelo.s.Kgari@gmail.com");
        $mail->Subject = $companyname;
        $mail->Body = $wholeBody;

        if ($mail->send()) {
            $status = "success";
            $response = "Your Message is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));
    }
?>
