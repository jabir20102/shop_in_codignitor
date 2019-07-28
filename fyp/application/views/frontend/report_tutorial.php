<div class="mt-3 py-4" style="background-color: #e9e9e9;">
	<div class="container">
		<h1 style="font-weight: lighter; font-size: 2.8rem;">Report - <?php echo $tutorial->title; ?></h1>
	</div>
</div>


<div class="container my-5">
	<form action="<?php echo base_url('student/report-tutorial/'.$tutorial->id.'/submit'); ?>" method="post" class="w-50">
		<div class="<?php echo $this->session->flashdata('class');?>" role="alert">
	 		<?php print_r($this->session->flashdata('error')); ?>
		</div>

		<div class="form-group">
			<label for="report">Reason to Report</label>
			<textarea id="report" class="form-control" name="report" required></textarea>
		</div>

		<button class="btn btn-primary">Report This Tutorial</button>
	</form>
	
</div>