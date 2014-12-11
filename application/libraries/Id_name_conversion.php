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
		$code = $this->CI->types->get_code($type_id);
		$name = $code.str_pad($id, 10, '0',STR_PAD_LEFT);
		//echo $name; 
		return $name;
	}
	
}