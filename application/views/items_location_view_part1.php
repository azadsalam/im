<?php $this->load->view('segments/head')?>
<?php $this->load->view('segments/navigation')?>
 <div id="page-wrapper">                        
 <h3>Show Items
 <?php 
 $CI =& get_instance();
 $lname = $CI->get_lname();
 if(isset($lname)) echo "of ". $lname;
 ?>
 </h3>
<?php  
//echo form_open('items_location',array('method'=>'get'));
echo form_open('items_location');
//$CI =& get_instance();
$options = $CI->get_locations();

echo form_dropdown('lname', $options, 'large');
echo form_submit('mysubmit', 'See Items under this location!!');
echo form_close();
?>