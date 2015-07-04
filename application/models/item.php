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
			
			return $name;
		}
		
		return NULL;
	}
	
        
	/*function itemsInLocation($locationId)
	{
		$this->db->select('id','type_id','');
	}*/
	
	function getItemIdByName($name)
	{ 
		$this->db->select('id');
		$this->db->where('name',$name);
		$q = $this->db->get('item');
		
		if($q->num_rows()>0)
		{
			return $q->row()->id;
		}
		else
			return NULL;
	}
	
	function getAllByName($name)
	{
		//$this->db->select('id','name');
		$this->db->where('name',$name);
		$q = $this->db->get('item');
		
		//print_r ($q);
		//print_r ($q->result());
		
		//echo $q->num_rows();
		if($q->num_rows()>0)
		{
			return $q->row_array();
			//print_r($data);
		}
		else return NULL;
	}
	
	function get_name($id)
	{
		$this->db->select('name');
		$this->db->where('id',$id);
		$q = $this->db->get('item');
		
		if($q->num_rows()>0)
			return $q->row()->name;
	    else 
			return NULL; 
	}
	function set_location_by_name($id,$location)
	{	
		$this->db->where('id',$id);
		$this->db->set('lname',$location);
		$q = $this->db->update('item');
		if($this->db->affected_rows()==1)
			return TRUE;
		else 
			return FALSE;
	}
	
	function set_location($id,$lid)
	{	
		$this->db->where('id',$id);
		$this->db->set('lid',$lid);
		$q = $this->db->update('item');
		if($this->db->affected_rows()==1)
			return TRUE;
		else 
			return FALSE;
	}
	
}
?>