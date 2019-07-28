	<div class="bg-light rounded">
		<div class="border-bottom">
			<div class="container-fluid">
				<h3 class="pt-4 pb-3">Admin Dashboard</h3>
			</div>
		</div>
		<div class="stats">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-3 my-2 text-center">
						<div class="border border-primary rounded" style="height: 120px;">
							<div class="num my-4">
								<?php echo count($this->crud_model->get_tutorials()); ?> <br>
								Tutorials
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 my-2 text-center">
						<div class="border border-success rounded">
							<div class="num my-4">
								<?php echo count($this->crud_model->get_reports()); ?><br>
								Reported Tutorials
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 my-2 text-center">
						<div class="border border-danger rounded">
							<div class="num my-4">
								<?php echo count($this->user_model->get_teachers()); ?><br>
								Teachers
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 my-2 text-center">
						<div class="border border-warning rounded">
							<div class="num my-4">
								<?php echo count($this->user_model->get_students()); ?> <br>
								Students
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>