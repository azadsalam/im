<?php

class Location extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------

      /** 
       * function SaveForm()
       *
       * insert form data - the location must not be already present
       * @param $form_data - array
       * @return Bool - TRUE or FALSE
       */

	function SaveForm($form_data)
	{
//		print_r($form_data);
		
		$this->db->insert('location', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	function location_exists($location)
	{
		
		$this->db->where('name',$location);
		$query = $this->db->get('location');	    
	    if ($query->num_rows() > 0)
	    {
	        return true;
	    }
	    else{
	        return false;
	    }	
	}
	
	function get_locations()
	{
		$this->db->select('name');
		$q = $this->db->get('location');
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
				$data[$row->name] = $row->name;
			}
			return $data;
		}
		else return NULL;
	
	}
	
	function get_floors()
	{
		$this->db->select('floor');
		$this->db->distinct();
		$this->db->order_by('floor','asc');
		//$this->db->where("floor IS NOT NULL");
		$q = $this->db->get('location');
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
				$data[$row->floor] = $row->floor;
			}
			return $data;
			
		}
		else return NULL;
		
	}
	
	function get_location_id($name)
	{
		$this->db->select('id');
		$query = $this->db->get_where('location', array('name' => $name));
		return $query->row()->id;
	}
	function get_location_name($id)
	{
		$this->db->select('name');
		$q = $this->db->get_where('location',array('id' => $id));
		return $q->row()->name;
	}

	
}
?>