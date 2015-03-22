<?php $this->load->view('segments/head')?>
<?php $this->load->view('segments/navigation')?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Pending Relocation Requests</h1>
                        

                        <table class="table">
							<thead>
								<th>Item</th>
								<th>Requestee</th>
								<th>Current Location</th>
								<th>Requested New Location</th>
								<th>Status</th>
								<th></th>
								<th></th>
							</thead>
							
							<?php 
							//print_r($data);
							foreach ($data as $row)
							{
								?>
								<tr>
								<td><?php echo $row['item_name'];?></td>
								<td><?php echo $row['full_name'];?></td>
								<td><?php echo $row['old_location'];?></td>
								<td><?php echo $row['new_location'];?></td>
								<td><?php echo $row['status'];?></td>
								
								<td>
								<?php 
								//$attributes = array('class' => 'btn btn-success');
								echo form_open('process_relocation_request/approve');
								echo form_hidden('request_id',$row['id']);
								echo form_submit('submit','Approve',"class = 'btn btn-success'");
								echo form_close();
								?>
								</td>

								<td>
								<?php 
								//$attributes = array('class' => 'btn btn-success');
								echo form_open('process_relocation_request/decline');
								echo form_hidden('request_id',$row['id']);
								echo form_submit('submit','Decline',"class = 'btn btn-danger'");
								echo form_close();
								?>
								</td>
								</tr>
								<?php 
							}
							?>
	
						</table>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


<?php $this->load->view('segments/footer')?>
