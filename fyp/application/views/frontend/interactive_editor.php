<div class="mt-3 interactive-tutorial">
	<div class="row mx-0 h-100">
		<div class="col-md-4 h-100 px-0" style="border-right: solid 3px #e9e9e9;">
			<div class="title pt-2" style="background-color: #e9e9e9; height: 50px;">
				<h3 class="ml-3">Instructions</h3>
			</div>
			<div class="p-2 instructions">
				<div>
					<h2 class="text-center"><?php echo $lesson->title; ?></h2>
					<div class="row mx-0">
						<div class="col-xs-12">
							<?php echo $lesson->instructions;?>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="col-md-5 h-100 px-0" style="border-right: solid 3px #e9e9e9;">
			<div class="title pt-2" style="background-color: #e9e9e9; height: 50px;">
				<h3 class="d-inline-block ml-3">Editor</h3>
				<button class="btn btn-success float-right mr-3 run-code-btn">Run Code</button>
			</div>
			<div id="editor" class="editor h-100">
			</div>
		</div>
		<div class="col-md-3 h-100 px-0">
			<div class="title pt-2" style="background-color: #e9e9e9; height: 50px;">
				<h3 class="ml-3">Results</h3>
			</div>
			<div class="results">
				<iframe id="results" class="h-100 w-100"></iframe>
			</div>
		</div>
	</div>
</div>