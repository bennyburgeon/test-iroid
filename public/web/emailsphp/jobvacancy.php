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
            $firstname = $_POST['jo-Fname'];
            $lastname = $_POST['jo-Lname'];
            $from = $_POST['jo-mail'];
            $phone = $_POST['jo-phone'];
            $salon = $_POST['jo-salon'];
            $position = $_POST['jo-position'];
            $quali = $_POST['jo-quali'];
            $country = $_POST['jo-country'];
            $exp = $_POST['jo-exp'];
            $eligibility = $_POST['jo-eligibility'];
            $dob = $_POST['jo-dob'];
            $treatment = $_POST['jo-treatment'];
            $pref = $_POST['jo-pref'];
            $message = $_POST['jo-message'];
                
                if (isset($_FILES['jo-attachment'])
                    && $_FILES['jo-attachment']['error'] == UPLOAD_ERR_OK
                ) {
                    $mail->addAttachment($_FILES['jo-attachment']['tmp_name'],
                                         $_FILES['jo-attachment']['name']);
                }
                
                $mail->setFrom('hello@elegancesalons.co.uk');
                $mail->addAddress('hello@elegancesalons.co.uk');
                $mail->isHTML(true);
                $mail->Subject = 'Elegance Salons - Business Opportunity';
        
                $htmlContent = '<img src="https://elegancesalons.co.uk/images/logo.png">
                <h3 style="color:#ecb3a0;">JOB APPLICATION</h3>
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
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Salon</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$salon.'</td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Position</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$position.'</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Qualification</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$quali.'</td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Qualified Country</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$country.'</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Experience after Qualification</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$exp.'</td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Eligibility to work in UK</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$eligibility.'</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Date Of Birth</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$dob.'</td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Treatments you are confident with</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$treatment.'</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Prefered Job</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$pref.'</td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Additional Details</td>
                    <td style="border: 1px solid #ddd;padding: 8px;">'.$message.'</td>
                </tr>
                </table>';
                
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