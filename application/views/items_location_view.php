<?php $this->load->view('segments/head')?>
<?php $this->load->view('segments/navigation')?>
 <div id="page-wrapper">                        
 <h3>Show Items</h3>
<?php  
echo form_open('items_location');

$CI =& get_instance();
$options = $CI->get_locations();

echo form_dropdown('lname', $options, 'large');
echo form_submit('mysubmit', 'See Items under this location!!');
echo form_close();


?>



<?php  if(isset($output))
 print_r($output); ?>
</div> 


<?php //$this->load->view('segments/footer')?>
