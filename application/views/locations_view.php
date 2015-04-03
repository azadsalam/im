<?php $this->load->view('segments/head')?>
<?php $this->load->view('segments/navigation')?>
 <div id="page-wrapper">                        
 
 
 <?php 
 $CI =& get_instance();
 $state = $CI->get_state();
 if($state==1)
 {
 	 $floor= $CI->get_floor();
	 if($floor=="ALL") echo "<h3>Manage Locations</h3>";
	 else if ($floor=="NULL") echo "<h3>Manage Locations with no level assigned</h3>";
	 else echo "<h3>Manage Locations of Level $floor</h3>";	
	 
	 echo  form_open('locations/index');
	 //print_r($CI->get_floors());
	 echo form_label("Level ");echo " ";
	 echo form_dropdown('floor',$CI->get_floors()); echo " ";
	 echo form_submit('mysumbit','Filter',"class ='btn btn-success'"); 
	 echo form_close();
 }
 
 ?>
 
 <!-- <div class="alert alert-danger" role="alert">No spaces are allowed in location name</div>  -->
        
                     	<?php echo $output; ?>
                </div> 


<?php //$this->load->view('segments/footer')?>
