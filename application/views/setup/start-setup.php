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
		    		<!-- <div class="col-12 text-center">
		    			<a class="navbar-brand" href="<?= base_url(); ?>">
				    		<img src="<?= PROVIDERLOGO; ?>" alt="logo" style="max-height:50px; width: auto;">
				    	</a>
		    		</div> -->
		    		<?php if($user){ ?>
		    		<div class="col-12">
		    			<a class="ps-5" href="<?= base_url(); ?>">
				    		<img src="<?= PROVIDERLOGO; ?>" alt="logo" style="height:30px; width: auto;">
				    	</a>
				    	<div class="d-flex align-items-center flex-column justify-content-center" style="height: 80vh;">
	    					<div class="text-primary"><i class="bi bi-cart-check" style="font-size: 50px;"></i> </div>
	    					<h1> Setup was successful! </h1>
	    					<p class="text-muted">If you need any assistance feel free to reach us.</p>
	    					<div>
	    						<a href="<?= PROVIDERURL . "/contact"; ?>" class="btn btn-dark">Contact us!</a>
		    					<a href="<?= base_url("dashboard/login"); ?>" class="btn btn-primary">Login</a>
	    					</div>
	    				</div>
		    		</div>
		    		<?php } else { ?>
	    			<div class="col-lg-6 pt-4">
	    				<a class="ps-5" href="<?= base_url(); ?>">
				    		<img src="<?= PROVIDERLOGO; ?>" alt="logo" style="height:30px; width: auto;">
				    	</a>
	    				<div class="d-flex align-items-center" style="height: 80vh;">
	    					<div class="px-5">
		    					<div class="text-danger"><i class="bi bi-cart-check fs-3"></i> Get started </div>
		    					<h1> Create your own e-commerce store in seconds! </h1>
		    					<p class="fs-4"> Start your online shop with our powerful platform loaded with features that makes online shopping easy and convinient. </p>
		    					<p class="text-muted">Got queries or want to know more about product demo, reach us! </p>
		    					<a href="<?= PROVIDERURL . "/contact"; ?>" class="btn btn-primary">Contact us!</a>
	    					</div>
	    				</div>
	    			</div>
		    		<div class="col-lg-6">
		    			<div class="card my-4">
		    				<div class="card-header">
					    		<h6 class="card-title"><span class="text-primary"> <i class="bi bi-shop-window"></i> Create your online shop</span> now!</h6>
		    				</div>
		    				<div class="card-body">
		    					<form action="" method="post" enctype="multipart/form-data">
		    						<div class="form-group mb-3">
		    							<label>Name</label>
		    							<input type="text" name="name" class="form-control" value="<?= set_value('name'); ?>" required>
		    						</div>
		    						<?= form_error('name'); ?>
		    						<div class="row">
		    							<div class="col-sm-6">
		    								<div class="form-group mb-3">
				    							<label>Phone</label>
				    							<input type="number" name="phone" class="form-control" value="<?= set_value('phone'); ?>" maxlength="10" minlength="10" required>
				    						</div>
				    						<?= form_error('phone'); ?>
		    							</div>
		    							<div class="col-sm-6">
		    								<div class="form-group mb-3">
				    							<label>Email</label>
				    							<input type="email" name="email" class="form-control" value="<?= set_value('email'); ?>" required>
				    						</div>
				    						<?= form_error('email'); ?>
		    							</div>
		    						</div>
		    						<div class="row">
		    							<div class="col-sm-6">
		    								<div class="form-group mb-3">
				    							<label>Password</label>
				    							<input type="password" name="password" class="form-control" minlength="8" required>
				    						</div>
		    							</div>
		    							<div class="col-sm-6">
		    								<div class="form-group mb-3">
				    							<label>Confirm Password</label>
				    							<input type="password" name="passconf" class="form-control" minlength="8" required>
				    						</div>
		    							</div>
		    						</div>
		    						<hr>
		    						<div class="row">
		    							<div class="col-sm-6">
		    								<div class="form-group mb-3">
				    							<label>Store Name</label>
				    							<input type="text" name="store_name" class="form-control" value="<?= set_value('store_name'); ?>" required>
				    						</div>
				    						<?= form_error('store_name'); ?>
		    							</div>
		    							<div class="col-sm-6">
		    								<div class="form-group mb-3">
				    							<label>Store Logo</label>
				    							<input type="file" name="store_logo" class="form-control">
				    						</div>
		    							</div>
		    						</div>
		    						<div class="form-group mb-3">
		    							<label>Store Address</label>
		    							<input type="text" name="store_addr" class="form-control" value="<?= set_value('store_addr'); ?>" required>
		    						</div>
		    						<?= form_error('store_addr'); ?>
		    						<div class="row">
		    							<div class="col-sm-4">
		    								<div class="form-group mb-3">
				    							<label>City</label>
				    							<input type="text" name="store_city" class="form-control" value="<?= set_value('store_city'); ?>" required>
				    						</div>
				    						<?= form_error('store_city'); ?>
		    							</div>
		    							<div class="col-sm-4">
		    								<div class="form-group mb-3">
				    							<label>State</label>
				    							<input type="text" name="store_state" class="form-control" value="<?= set_value('store_state'); ?>" required>
				    						</div>
				    						<?= form_error('store_state'); ?>
		    							</div>
		    							<div class="col-sm-4">
		    								<div class="form-group mb-3">
				    							<label>Pin</label>
				    							<input type="number" name="store_pincode" class="form-control" value="<?= set_value('store_pincode'); ?>" required>
				    						</div>
				    						<?= form_error('store_pincode'); ?>
		    							</div>
		    						</div>
		    						<div class="row">
		    							<div class="col-sm-6">
		    								<div class="text-danger text-small mt-3">Please notice all fields are required!</div>
		    							</div>
		    							<div class="col-sm-6 text-end">
		    								<button class="btn btn-default" type="reset">Clear</button>
			    							<button class="btn btn-primary" type="submit">Proceed <i class="bi bi-arrow-right"></i></button>
		    							</div>
		    						</div>
		    					</form>

		    				</div>
		    			</div>
		    		</div>
		    		<?php } ?>
		    	</div>
		    </div>
		</section>
	</div>			
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>