<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Id_name_conversion
{
	public function __construct()
	{
	    $this->CI = &get_instance();
	}
	public function to_name($id, $type_id)
	{
		$this->CI->load->model('types');
		$code  = $this->CI->types->get_code($type_id);
		$this->CI->types->increment_count($type_id);
		$count = $this->CI->types->get_count($type_id);
		
		//$this->CI->load->model('item');
		//$code = $this->CI->item->get_max_name($type_id);
		
		$name = $code.$count;
		//echo $name; 
		return $name;
	}
	
}