<?php $this->load->view('segments/head')?>
<?php $this->load->view('segments/navigation')?>
 <div id="page-wrapper">                        
 <h3> 
 <?php 
 $CI =& get_instance();
 $lname = $CI->get_lname();
 $type_id = $CI->get_type_id();
 $type_name = $CI->get_type_name();
 
 if(isset($output))
 {
 	echo "Showing Type: ".$type_name;
 	if(isset($lname) && !empty($lname)) echo " from Location: ". $lname;
 }
 else 
 {
 	echo "Select Type and Location";
 }
 ?>
 </h3>
<?php  
//echo form_open('items_location',array('method'=>'get'));
echo form_open('items_summary',"class='form-inline'");
$CI =& get_instance();
$locations = $CI->get_locations();
//print_r($locations);
$types = $CI ->get_types();
//print_r($types);
echo "<div class=\"form-group\">";
echo '<label for="type_id">Type</label> '.form_dropdown('type_id', $types, $type_id);
echo "</div>";
echo " <div class=\"form-group\">";
echo '  <label for="lname">Location</label> '.form_dropdown('lname', $locations, $lname);
echo "</div> ";
echo form_submit('mysubmit', 'Show Items',"class ='btn btn-success'");
echo form_close();
?>




<?php //$this->load->view('segments/footer')?>
