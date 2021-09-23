<!DOCTYPE html>
<html lang="en-US">
	<head>
		<?php include __DIR__ . "/../includes/head.html"; ?>
		<link rel="stylesheet" href="/styles/contact.css">
	</head>
	<body>
		<?php
			use PHPMailer\PHPMailer\PHPMailer;
			use PHPMailer\PHPMailer\Exception;
			require __DIR__ . '/../includes/PHPMailer/src/Exception.php';
			require __DIR__ . '/../includes/PHPMailer/src/PHPMailer.php';
			require __DIR__ . '/../includes/PHPMailer/src/SMTP.php';
			
			if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
				$sourceEmail = "customerservice@technegames.com";
				$emailSubject = "";
				$emailBody = "<div>";
				$emailBodyAlt = "";
				$name = "";
				if(isset($_POST["name"])) {
					$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
					$emailSubject .= $name.":";
					$emailBody .= "<div><p>Name: ".$name."</p></div>";
					$emailBodyAlt .= "Name: ".$name." | ";
				}
				$email = "";
				if(isset($_POST["email"])) {
					$email = str_replace(array("\r", "\n", "%0a", "%0d"), "", $_POST["email"]);
					$email = filter_var($email, FILTER_VALIDATE_EMAIL);
					$emailBody .= "<div><p>Email: ".$email."</p></div>";
					$emailBodyAlt .= "Email: ".$email." | ";
				}
				$type = "";
				if(isset($_POST["type"])) {
					$type = ucfirst(filter_var($_POST["type"], FILTER_SANITIZE_STRING));
					$emailSubject .= " ".$type;
					$emailBody .= "<div><p>Type: ".$type."</p></div>";
					$emailBodyAlt .= "Type: ".$type." | ";
				}
				$message = "";
				if(isset($_POST["message"])) {
					$message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
					$emailBody .= "<div><p>Message: ".$message."</p></div>";
					$emailBodyAlt .= "Message: ".$message;
				}
				$emailBody .= "</div>";
				
				try {
					//settings
					$mail1 = new PHPMailer();
					$mail1->isSMTP();
					$mail1->CharSet = 'UTF-8';
					$mail1->Host = "smtp.gmail.com";
					$mail1->Port = 587;
					$mail1->SMTPDebug = 3;
					$mail1->SMTPAuth = true;
					$mail1->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
					$mail1->Username = $sourceEmail;
					$mail1->Password = getenv('emailPassword');
					//Content
					$mail1->setFrom($email, $name);
					$mail1->addAddress($sourceEmail, "Customer Service at TechneGames");
					$mail1->isHTML(true);
					$mail1->Subject = $emailSubject;
					$mail1->Body = $emailBody;
					$mail1->AltBody = $emailBodyAlt;
					echo 'here 1'
					if(!$mail1->send()) {
						echo $mail1->ErrorInfo;
					}
					echo 'here 2'
					
					//send confirmation
					$emailSubject = "Your email was recieved.";
					$emailBody = "<div><p>Thank you for contacting us about GlamKit, ".$name.". You will get a reply as soon as possible.</p></div>";
					$emailBodyAlt = "Thank you for contacting us about GlamKit, ".$name.". You will get a reply as soon as possible.";
					
					//settings
					$mail2 = new PHPMailer();
					$mail2->isSMTP();
					$mail2->CharSet = 'UTF-8';
					$mail2->Host = "smtp.gmail.com";
					$mail2->Port = 587;
					$mail2->SMTPDebug = 3s;
					$mail2->SMTPAuth = true;
					$mail2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
					$mail2->Username = $sourceEmail;
					$mail2->Password = getenv('emailPassword');
					//Content
					$mail2->setFrom($sourceEmail, "Customer Service at TechneGames");
					$mail2->addAddress($email, $name);
					$mail2->isHTML(true);
					$mail2->Subject = $emailSubject;
					$mail2->Body = $emailBody;
					$mail2->AltBody = $emailBodyAlt;
					echo 'here 3'
					if(!$mail2->send()) {
						echo $mail2->ErrorInfo;
					}
					echo 'here 4'
				} catch(Exception $e) {
					echo $e
					$error = "There was an error. Your message must likely did not go through. $e";
				}
			}
		?>
		<?php include __DIR__ . "/../includes/navbar.php"; ?>
		<!--main contact form-->
		<form class="container-fluid contactForm" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
			<h2>Contact</h2>
			<div class="input filled">
				<label for="type">Reason for Message</label>
				<?php if(!isset($_GET["type"])) { $_GET["type"] = "feature"; } ?>
				<select name="type" id="type" required>
					<option value="feature" <?php if($_GET["type"] == "feature") { echo "selected"; } ?>>Request a Feature</option>
					<option value="bug" <?php if($_GET["type"] == "bug") { echo "selected"; } ?>>Report a Bug</option>
					<option value="press" <?php if($_GET["type"] == "press") { echo "selected"; } ?>>Press</option></option>
					<option value="other <?php if($_GET["type"] == "other") { echo "selected"; } ?>">Other</option>
				</select>
			</div>
			<div class="input">
				<label for="name">Your Name</label>
				<input type="text" name="name" id="name" pattern="[A-Z\sa-z]{2,35}" required />
			</div>
			<div class="input">
				<label for="email">Your Email</label>
				<input type="email" name="email" id="email" required />
			</div>
			<div class="input">
				<label for="message">Message</label>
				<textarea name="message" id="message" required></textarea>
			</div>
			<button type="submit" name="submit" class="btn-dark shineBtn">
				<span class="shine">Send</span>
			</button>
			<p class="errorText"><?php if(isset($error)) { echo $error; } ?></p>
		</form>
		<!--JavaScript/JQuery for contact form-->
		<script>
			//if user typed something, placeholder text remains label
			//otherwise, label returns to placeholder text
			$("form input, form textarea, form select").on(
				"blur",
				function() {
					let $input = $(this).closest(".input");
					if(this.value && this.value != "") {
						$input.addClass("filled");
					} else {
						$input.removeClass("filled");
					}
				}
			);
			//moves placeholder text to label
			$("form input, form textarea, form select").on(
				"focus",
				function() {
					let $input = $(this).closest(".input");
					$input.addClass("filled");
				}
			);
			//resizes textarea to needed height when typing
			$("form textarea").on(
				"input",
				function() {
					this.style.height = "5px";
					this.style.height = (this.scrollHeight + 1) + "px";
				}
			);
		</script>
		<?php include __DIR__ . "/../includes/footer.php" ?>
	</body>
</html>
