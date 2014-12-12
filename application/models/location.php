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
	

	
}
?>