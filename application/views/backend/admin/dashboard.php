<div class="container">
	<div class="row">
		<div class="col mx-auto bg-light rounded">
			<div class="border-bottom">
				<div class="container-fluid">
					<h3 class="pt-4 pb-3">Dashboard</h3>
				</div>
			</div>
			
			<div class="row">
				
				

					<div class="col-sm-6 col-md-3 my-2 text-center">
						<div class="border border-warning rounded">
							<div class="num my-4">
								
								<?php echo count($this->crud_model->get_comments());
								 ?> <br>
								Unpproved Comments
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 my-2 text-center">
						<div class="border border-warning rounded">
							<div class="num my-4">
								<?php
								 echo count($this->user_model->get_students());
								  ?> <br>
								Orders
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 my-2 text-center">
						<div class="border border-primary rounded">
							<div class="num my-4">
								<?php echo count($this->crud_model->get_products()); ?> <br>
								Products
							</div>
						</div>
					</div>
					
				
					
				
			</div> <!-- end row div -->
		</div><!-- end col -->
	</div> <!-- end row -->
</div> <!-- end container -->