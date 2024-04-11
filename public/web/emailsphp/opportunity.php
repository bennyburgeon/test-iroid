<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    
    if(isset($_POST["send"])){
        $mail = new PHPMailer(true);
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hello@elegancesalons.co.uk';
        $mail->Password = 'velisctubogyxtck';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        if(isset($_POST['g-recaptcha-response'])){
        	$secretkey = "6LfzS34iAAAAACpYu0L0FSiBMx78SmP_bQQLwgXh";
        	$ip = $_SERVER['REMOTE_ADDR'];
        	$response = $_POST['g-recaptcha-response'];
        	$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$ip";
        	$fire = file_get_contents($url);
        	$data = json_decode($fire);
        	if($data->success==true){
                $firstname = $_POST['bu-Fname'];
                $lastname = $_POST['bu-Lname'];
                $from = $_POST['bu-mail'];
                $phone = $_POST['bu-phone'];
                $company = $_POST['bu-company'];
                $position = $_POST['bu-position'];
                $opportunity = $_POST['bu-opportunity'];
                $message = $_POST['bu-message'];
                
                if (isset($_FILES['bu-attachment'])
                    && $_FILES['bu-attachment']['error'] == UPLOAD_ERR_OK
                ) {
                    $mail->addAttachment($_FILES['bu-attachment']['tmp_name'],
                                         $_FILES['bu-attachment']['name']);
                }
                
                $mail->setFrom('hello@elegancesalons.co.uk');
                $mail->addAddress('hello@elegancesalons.co.uk');
                $mail->isHTML(true);
                $mail->Subject = 'Elegance Salons - Business Opportunity';
        
                $htmlContent = '<img src="https://elegancesalons.co.uk/images/logo.png">
                <h3 style="color:#ecb3a0;">BUSINESS OPPORTUNITY</h3>
                <table style="font-family: Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%;">
                <tr>
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">First Name</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$firstname.'</td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Last Name</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$lastname.'</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Email</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$from.'</td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Phone</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$phone.'</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Company</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$company.'</td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Position</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$position.'</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Opportunity</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$opportunity.'</td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Message</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$message.'</td>
                </tr>
                </table';
                
                $mail->Body =  $htmlContent;
                
                $mail->send();
                header('Location: https://elegancesalons.co.uk/thank-you.html');
        		
        	}else{
        		echo "Please check captcha";
        	}
        }
        else{
        	echo "reCaptcha error";
        }
    }
?>