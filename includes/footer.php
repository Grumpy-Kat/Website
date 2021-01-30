<div class="container-fluid footerSection">
	<div>
		<div class="text">
			<h2>Subscribe to our newsletter!</h2>
			<h3>Stay up-to-date with updates via email.</h3>
		</div>
		<?php
			if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["subscribe"]) && isset($_POST["mailingList"])) {
				try {
					$postData = json_encode([
						"email_address" => $_POST["mailingList"],
						"status" => "subscribed",
					]);
					echo $_POST["mailingList"];
					$request = curl_init('https://us7.api.mailchimp.com/3.0/lists/'.getenv("mailchimpListId").'/members/');
					curl_setopt_array(
						$request,
						[
							CURLOPT_USERPWD => getenv("mailchimpKey"),
							CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_POST => true,
							CURLOPT_SSL_VERIFYPEER => false,
							CURLOPT_POSTFIELDS => $postData
						]
					);
					echo getenv("mailchimpListId");
					echo getenv("mailchimpKey");
					$response = curl_exec($request);
					$httpCode = curl_getinfo($request, CURLINFO_HTTP_CODE);
					echo "<p>response recieved</p>";
					echo $httpCode;
					curl_close($request);
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
			<a class="twitter" href="#"></a>
			<a class="email" href="#"></a>
			<a class="instagram" href="#"></a>
		</div>
		<div class="container-fluid legalLinks">
			<a href="tos">Terms of Service</a>
			<a href="privacy">Privacy Policy</a>
		</div>
	</div>
</div>