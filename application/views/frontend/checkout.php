<?php
 $user = $this->user_model->get_students($this->session->userdata('student_email'));
?>
<!--Start Breadcrumbs -->
<div class="fables-light-gary-background">
    <div class="container"> 
        <nav aria-label="breadcrumb">
          <ol class="fables-breadcrumb breadcrumb px-0 py-3">
            <li class="breadcrumb-item"><a href="#" class="fables-second-text-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Store Grid List</li>
          </ol>
        </nav> 
    </div>
</div>
<!-- /End Breadcrumbs -->
<div class="container">
	<?php
	include('flash.php');
	?>
</div>

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-7">
					<form action="<?php echo base_url('admin/placeOrder'); ?>" method="post">	
						
					 
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="name"  value="<?php if($user) echo $user->name; ?>" placeholder="Full Name" required>
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" value="<?php if($user) echo $user->email; ?>" placeholder="Email" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" value="<?php if($user) echo $user->address; ?>" placeholder="Address" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" value="<?php if($user) echo $user->city; ?>" placeholder="City" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" value="<?php if($user) echo $user->country; ?>" placeholder="Country" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip" value="<?php if($user) echo $user->zip; ?>" placeholder="ZIP Code">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="phone" value
								="<?php if($user) echo $user->phone; ?>" placeholder="Telephone" required>
							</div>
							</div>
						<!-- /Billing Details -->

					

						<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" name="comment" placeholder="Order Notes"></textarea>
						</div>
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
								<?php
								foreach($this->cart->contents() as $items)
									{
								?>
								<div class="order-col">
									<div>
										<?php  echo $items["name"].'<strong> ('.$items["qty"].')</strong> '; ?>
									</div>
									<div>Rs <?php  echo $items["price"] ?></div>
									</div>
								<?php
							}
								?>

								
								
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">Rs <?php  echo $this->cart->total(); ?></strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							
							
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms" name="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="">terms & conditions</a>
							</label>
						</div>                     
                            <button class="primary-btn order-submit">Place order</button>
					</div>
				</form>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->