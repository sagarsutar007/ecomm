<!DOCTYPE html>
<html lang="en">
<body style="padding: 40px 0px; background: #d8d8d8;">
	<div style="width: 70%; margin:0 auto; background: #ffffff;padding: 40px 40px;">
		<img src="<?= base_url('../assets/web/images/brand-logo/') . $logo; ?>" alt="<?= $app; ?>">
		<p style="font-family: Arial;">
			Hi <?= $name; ?>, <br><br>
			A password has been changed recently. <br><br>
			Please report an issue if you've not changed your password. <br><br>
		</p>
		<p style="font-size: 13px;color: #d8d8d8;">
			<?= $address; ?>
		</p>
	</div>
</body>
</html>