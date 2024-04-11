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
                $firstname = $_POST['re-Fname'];
				$lastname = $_POST['re-Lname'];
				$email = $_POST['re-mail'];
				$phone = $_POST['re-phone'];
				$salon = $_POST['re-salon'];
				$treatment = $_POST['re-treatment'];
				$oldDate = $_POST['re-Odate'];
				$oldTime = $_POST['re-Otime'];
				$oldPeriod = $_POST['re-OtimePeriod'];
				$newDate = $_POST['re-Ndate'];
				$newTime = $_POST['re-Ntime'];
				$newPeriod = $_POST['re-NtimePeriod'];
				$message = $_POST['re-message'];
                
                $mail->setFrom('hello@elegancesalons.co.uk');
                $mail->addAddress('hello@elegancesalons.co.uk');
                $mail->isHTML(true);
                $mail->Subject = 'Elegance Salons - Reschedule Booking';
        
                $htmlContent = '<img src="https://elegancesalons.co.uk/images/logo.png">
				<h3 style="color:#ecb3a0;">RESCHEDULE BOOKING REQUEST</h3>
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
					<td style="border: 1px solid #ddd;padding: 8px;">'.$email.'</td>
				</tr>
				<tr style="background-color: #f2f2f2;">
					<td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Phone</td>
					<td style="border: 1px solid #ddd;padding: 8px;">'.$phone.'</td>
				</tr>
				<tr>
					<td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Booked Salon</td>
					<td style="border: 1px solid #ddd;padding: 8px;">'.$salon.'</td>
				</tr>
				<tr style="background-color: #f2f2f2;">
					<td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Booked Treatment</td>
					<td style="border: 1px solid #ddd;padding: 8px;">'.$treatment.'</td>
				</tr>
				<tr>
					<td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Existing Date</td>
					<td style="border: 1px solid #ddd;padding: 8px;">'.$oldDate.'</td>
				</tr>
				<tr style="background-color: #f2f2f2;">
					<td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Existing Time</td>
					<td style="border: 1px solid #ddd;padding: 8px;">'.$oldTime.$oldPeriod.'</td>
				</tr>
				<tr>
					<td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">New Date</td>
					<td style="border: 1px solid #ddd;padding: 8px;">'.$newDate.'</td>
				</tr>
				<tr style="background-color: #f2f2f2;">
					<td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">New Time</td>
					<td style="border: 1px solid #ddd;padding: 8px;">'.$newTime.$newPeriod.'</td>
				</tr>
				<tr>
					<td style="border: 1px solid #ddd;padding: 8px;font-weight: bold;">Message</td>
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