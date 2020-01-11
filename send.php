<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if(isset($_POST['email']) && isset($_POST['subject'])  && isset($_POST['name']) && isset($_POST['body'])){
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $name = $_POST['name'];
        $body = $_POST['body'];

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Setting
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Username = "info@lategosolar.co.zw";
        $mail->Password = "lategosolar@@11";
        $mail->Host = 'sgvip1.noc401.com';
        $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email);
        $mail->addAddress("info@lategosolar.co.zw");
        $mail->addReplyTo($email);
        $mail->Subject = $subject;
        $mail->Body = "<h2>Client Name</h2><br><br>" . $name . "<br><br><br><h2>Client Message</h2><br><br>" .$body;

        if($mail->send()){
            $res = "success";
        }else{
            $res = "Something is wrong : <br><br>" . $mail->ErrorInfo;
        }
        exit(json_encode(array("res" => $res)));
    }
?>