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
                    
                        <h1 class="page-header">CREATE NEW LOCATION</h1>
                        <?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '');
echo form_open('create_location/submit', $attributes); ?>

<p>
        <label for="name">Name <span class="required">*</span></label>
        <?php echo form_error('name'); ?>
        <br /><input id="name" type="text" name="name" maxlength="50" value="<?php echo set_value('name'); ?>"  />
</p>

<p>
        <label for="description">Description</label>
	<?php echo form_error('description'); ?>
	<br />
							
	<?php echo form_textarea( array( 'name' => 'description', 'rows' => '5', 'cols' => '80', 'value' => set_value('description') ) )?>
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
