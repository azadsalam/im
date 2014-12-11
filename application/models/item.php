<?php

class Item extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------

      /** 
       * function SaveForm()
       *
       * insert form data
       * @param $form_data - array
       * @return Bool - TRUE or FALSE
       */

	function SaveForm($form_data)
	{
		$this->db->insert('item', $form_data);
		
		
		if ($this->db->affected_rows() == '1')
		{
			$id = $this->db->insert_id();			
			$type_id =  $form_data['type_id'];
			$this->load->library('id_name_conversion');
		 
			$name = $this->id_name_conversion->to_name($id,$type_id);
			$data= array('name' => $name);
			$this->db->where('id',$id);
			$this->db->update('item',$data);
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	/*function itemsInLocation($locationId)
	{
		$this->db->select('id','type_id','');
	}*/
	
	/*function getItem($id)
	{ 
		
	}*/
}
?>