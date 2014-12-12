<?php $this->load->view('segments/head')?>
<?php $this->load->view('segments/navigation')?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Request New Location for This Item</h1>

                        <h2>
                        
                        <?php if(isset($msg))
                    			echo $msg;
                    	?> 
                        </h2>
                        
                        <?php if(isset($data))
                        	{
                        	
								?>
    						<table class="table">
    						<tr> 
    							<td>Name</td>
    							<td><?php echo $data['name']; ?></td>
    						</tr>
    						<tr> 
    							<td>Type</td>
    							<td><?php echo $data['type_name']; ?></td>
    						</tr>
    						<tr>
    							<td>Make</td>
    							<td><?php echo $data['make']; ?></td>
    						</tr>
    						<tr>
    							<td>Description</td>
    							<td><?php echo $data['description']; ?></td>
    						</tr>
    						<tr>
    							<td>Purchase Date</td>
    							<td><?php echo $data['purchase_date']; ?></td>
    						</tr>
    						 <tr>
    							<td>Current Location</td>
    							<td><?php echo $data['lname']; ?></td>
    						</tr>

    						 <tr>
    							<td>Request New Location</td>
    							<td>
  		                        <?php 
			                        $attributes = array('class' => '', 'id' => '');
									echo form_open('assign_location/assign_request', $attributes); ?>
									
									<p>
									        <!--<label for='new_location'>New Location <span class="required"></span></label>
									        --><?php echo form_error('new_location'); 
									        ?>
									       
									        <?php $options = $locations;	
									        echo form_hidden('item_id',$data['id']);					
									        echo form_hidden('old_location',$data['lname']);
						        			
									        echo form_dropdown('new_location', $options, set_value('new_location'))?>
						
			    
									</p>                                             
									                        						
									<p>
									        <?php echo form_submit( 'submit', 'Submit'); ?>
									</p>
									
									<?php echo form_close(); ?>
			    							
	    						</td>
	    					</tr>
		    						
    						
    						</table>
    						<?php 
	                        }
                        ?>
                        

						
						
						
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


<?php $this->load->view('segments/footer')?>
