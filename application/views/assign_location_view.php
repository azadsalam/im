<?php $this->load->view('segments/head')?>
<?php $this->load->view('segments/navigation')?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                       <?php if(isset($msg))
                    			echo $msg;
                    	?>
                        <h1 class="page-header">Request Assignment of Item to a location</h1>
                        
                       
                        <?php 
                        
                        $attributes = array('class' => '', 'id' => '');
						echo form_open('assign_location/find_item', $attributes); ?>
						
						<p>
						        <label for='name'>Item Name <span class="required">*</span></label>
						        <?php echo form_error('name'); ?>
						       <br /><input id="name" type="text" name="name" maxlength="14" value="<?php echo set_value('name'); ?>"  />
    
						</p>                                             
						                        						
						<p>
						        <?php echo form_submit( 'submit', 'Submit'); ?>
						</p>
						
						<?php echo form_close(); ?>
						
						
						
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


<?php $this->load->view('segments/footer')?>
