<?php $this->load->view('segments/head')?>
<?php $this->load->view('segments/navigation')?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>
                        
                        <?php if(isset($msg))
                    			echo $msg;
                    	?> 
                        </h2>
                        
                        <h1 class="page-header">Enter New Purchased Item</h1>
                        
                        <?php 
                        $attributes = array('class' => '', 'id' => '');
						echo form_open('item_entry/submit', $attributes); ?>
						
						<p>
						        <label for='type_id'>Type <span class="required">*</span></label>
						        <?php echo form_error('type_id'); ?>
						        
						        <?php // Change the values in this array to populate your dropdown as required ?>
						        <?php $options = $id_name_tuples; ?>
						
						        <br /><?php echo form_dropdown('type_id', $options, set_value('type_id'))?>
						</p>                                             
						                        
						<!--
						<p>
						        <label for="name">Name <span class="required">*</span></label>
						        <?php echo form_error('name'); ?>
						        <br /><input id="name" type="text" name="name" maxlength="50" value="<?php echo set_value('name'); ?>"  />
						</p>
						-->
						<p>
						        <label for="make">Make</label>
						        <?php echo form_error('make'); ?>
						        <br /><input id="make" type="text" name="make" maxlength="50" value="<?php echo set_value('make'); ?>"  />
						</p>
						
						<p>
						        <label for="description">Description</label>
							<?php echo form_error('description'); ?>
							<br />
													
							<?php echo form_textarea( array( 'name' => 'description', 'rows' => '5', 'cols' => '80', 'value' => set_value('description') ) )?>
						</p>
						<p>
						        <label for="purchase_date">Purchase Date (YYYY-MM-DD)</label>
						        <?php echo form_error('purchase_date'); ?>
						        <br /><input id="purchase_date" type="text" name="purchase_date" value="<?php echo set_value('purchase_date'); ?>"  />
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
