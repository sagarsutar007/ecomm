<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Setup your ecommerce store! - <?= PROVIDERNAME; ?></title>

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
    	h1,h2,h3,h4,h5,h6 {
    		font-family: 'Montserrat', sans-serif;
    	}
    	div, p, span, li {
    		font-family: 'Poppins', sans-serif;
    	}
    	section {
    		padding: 20px 0px 0px 0px;
    	}

    	.text-small, label {
    		font-size: smaller;
    	}
    </style>
</head>
<body>
	<div class="wrapper">
		<section id="setup">
		    <div class="container-fluid">
		    	<div class="row">
		    		<div class="col-12">
		    			<a class="ps-5" href="<?= base_url(); ?>">
				    		<img src="<?= PROVIDERLOGO; ?>" alt="logo" style="height:30px; width: auto;">
				    	</a>
				    	<div class="d-flex align-items-center flex-column justify-content-center" style="height: 80vh;">
	    					<div class="text-primary"><i class="bi bi-cart-check" style="font-size: 50px;"></i> </div>
	    					<h1> Setup successful! </h1>
	    					<p class="text-muted text-center">You will find an email with information of your installation. <br> Please verify email before login to see the dashboard. <br> If you need any assistance feel free to reach us.</p>
	    					<div>
	    						<a href="<?= PROVIDERURL . "/contact"; ?>" class="btn btn-dark">Contact us!</a>
		    					<a href="<?= base_url("dashboard/login"); ?>" class="btn btn-primary">Login</a>
	    					</div>
	    				</div>
		    		</div>
		    	</div>
		    </div>
		</section>
	</div>			
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>