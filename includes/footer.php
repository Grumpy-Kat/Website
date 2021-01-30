<div class="container-fluid footerSection">
	<div>
		<div class="text">
			<h2>Subscribe to our newsletter!</h2>
			<h3>Stay up-to-date with updates via email.</h3>
		</div>
		<?php
			if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["subscribe"]) && isset($_POST["mailingList"])) {
				try {
					$auth = base64_encode('user:'.getenv("mailchimpKey"));
					$data = json_encode([
						"email_address" => $_POST["mailingList"],
						"status" => "subscribed",
					]);
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, 'https://us7.api.mailchimp.com/3.0/lists/'.getenv("mailchimpListId").'/members/');
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.$auth));
					curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 10);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                                                                  
					$response = curl_exec($ch);
					curl_close($ch);
				} catch(Exception $e) {
					echo $e->getMessage();
				}
			}
		?>
		<form class="container-fluid row mailingListForm" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input class="col-xs-9" type="email" id="mailingList" name="mailingList" placeholder="Email Address" required />
			<button type="submit" name="subscribe" class="col-xs-3 btn btn-dark shineBtn">
				<span class="shine">Subscribe</span>
			</button>
		</form>
		<div class="container row buttons footerButtons">
			<button type="button" class="col-xs-6 btn btn-dark shineBtn iOS">
				<div class="shine"></div>
			</button>
			<button type="button" class="col-xs-6 btn btn-dark shineBtn android">
				<span class="shine"></span>
			</button>
		</div>
		<div class="continer-fluid socialMedia">
			<a class="email" href="mailto:customerservice@technegames.com"></a>
			<a class="twitter" href="https://twitter.com/Techne_Games"></a>
			<a class="instagram" href="https://www.instagram.com/technegames/"></a>
		</div>
		<div class="container-fluid legalLinks">
			<a href="tos">Terms of Service</a>
			<a href="privacy">Privacy Policy</a>
		</div>
	</div>
</div>