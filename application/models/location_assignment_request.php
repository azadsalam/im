<?php

class Location_assignment_request extends CI_Model {

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

	function insert($form_data)
	{
		$this->db->insert('location_assignment_request', $form_data);
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
	function get_all()
	{
		$q = $this->db->get('location_assignment_request');
		return $q->result_array();
	}

	function get_pending()
	{
		$this->db->where('status','Pending');
		$q = $this->db->get('location_assignment_request');
		return $q->result_array();
	}
	
	function approve($id)
	{
		$this->db->where('id',$id);
		$this->db->set('status','Approved');
		$q = $this->db->update('location_assignment_request');
		
		//print_r($q);
		if($this->db->affected_rows()==1)
		{
			return TRUE;
		}
		else
			return FALSE;
	}
	
	function decline($id)
	{
		$this->db->where('id',$id);
		$this->db->set('status','Declined');
		$q = $this->db->update('location_assignment_request');
		
		//print_r($q);
		if($this->db->affected_rows()==1)
		{
			return TRUE;
		}
		else
			return FALSE;
	}
	
	function decline_all_pending($item_id)
	{
		$this->db->where('item_id',$item_id);
		$this->db->where('status','Pending');
		
		$this->db->set('status','Declined');
		$q = $this->db->update('location_assignment_request');
		
	}
	function get_row($id)
	{
		$this->db->where('id',$id);
		$q = $this->db->get('location_assignment_request');
		
		if($q->num_rows()>0)
			return $q->row_array();
		else
		return NULL;
	}
}
?>