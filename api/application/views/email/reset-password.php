<!DOCTYPE html>
<html lang="en">
<body style="padding: 40px 0px; background: #d8d8d8;">
	<div style="width: 70%; margin:0 auto; background: #ffffff;padding: 40px 40px;">
		<img src="<?= base_url('../assets/web/images/brand-logo/') . $logo; ?>" alt="<?= $app; ?>">
		<p style="font-family: Arial;">
			Hi <?= $name; ?>, <br><br>
			A password reset for your account was requested. <br><br>
			Please click the button below to change your password. <br><br>
			Note that this link is valid for one time use. After the usage limit has expired, you will have to resubmit the request for a password reset.
		</p>
		<a href="<?= $url; ?>" target="_blank" style="display: inline-block; background-color: #2b65e2; color: #ffffff; padding: 20px 15px;text-decoration: none; font-size: 18px;font-family: Arial;">Change Your Password</a>
		<p style="font-size: 13px;color: #d8d8d8;">
			<?= $address; ?>
		</p>
	</div>
</body>
</html>