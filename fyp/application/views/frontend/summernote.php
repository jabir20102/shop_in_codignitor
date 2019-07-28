<div class="container">
	<form class="my-5" action="<?php echo base_url('summercode'); ?>" method="post">
		<div class="form-group">
			<label for="summernote">Enter Any Thing</label>
			<textarea id="summernote" name="summercode" class="form-control" placeholder="hello"></textarea>
		</div>
		
		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
	</form>

	<?php
		$config['base_url'] = 'http://localhost/fyp/summernote/';
		$config['total_rows'] = 200;
		$config['per_page'] = 20;
		$config['uri_segment'] = 2;

		$this->pagination->initialize($config);

		echo $this->pagination->create_links();
	?>
</div>

