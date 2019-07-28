<div  class="<?php echo $this->session->flashdata('class');?>" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <strong><?php print_r($this->session->flashdata('error')); ?></strong>
</div>