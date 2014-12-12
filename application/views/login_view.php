<?php $this->load->view('segments/head')?>
<?php $this->load->view('segments/navigation')?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                     <p><?php if(isset($msg))echo $msg;?></p>
                        <h1 class="page-header">LOG IN</h1>
                         <?php // Change the css classes to suit your needs    

							$attributes = array('class' => '', 'id' => '');
							echo form_open('login/submit', $attributes); ?>
							
							<p>
							        <label for="name">UserName <span class="required">*</span></label>
							        <?php echo form_error('name')."<br/>"; ?>
							        <input id="name" type="text" name="name" maxlength="50" value="<?php echo set_value('name'); ?>"  />
							</p>
							<p>
							        <label for="pass">Password <span class="required">*</span></label>
							        <?php echo form_error('pass')."<br/>"; ?>
							        <input id="pass" type="password" name="pass" maxlength="50" value="<?php echo set_value('name'); ?>"  />
							</p>
														
							<p>
							        <?php echo form_submit( 'submit', 'Submit'); ?>
							</p>
                        
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


<?php $this->load->view('segments/footer')?>
