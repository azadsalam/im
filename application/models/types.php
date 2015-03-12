<?php

class Types extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function get_id_name_tuples()
	{
		$this->db->select('id,name');
		
		$q = $this->db->get('types');
		
		//	print_r($q->result());
		
		foreach( $q->result() as $row)
		{
			$data[$row->id] = $row->name;
		}
		//print_r($data);
		return $data;
	}
	
	function type_id_exists($type_id)
	{
		
		
		$this->db->where('id',$type_id);
		$query = $this->db->get('types');
		
		if($query->num_rows() == 1)
		{
			return TRUE;
		}
		else
			return FALSE;
		
	}
	function get_code($id)
	{
		$this->db->select('code');
		$this->db->where('id',$id);
		$q = $this->db->get('types');
		return $q->row()->code;
	}
	
	function get_name($id)
	{
		$this->db->select('name');
		$this->db->where('id',$id);
		$q = $this->db->get('types');
		
		if($q->num_rows>0)return $q->row()->name;
		else return NULL;
	}
	function get_count($id)
	{
		$this->db->select('count');
		$this->db->where('id',$id);
		$q = $this->db->get('types');
		return $q->row()->count;
	}
	function increment_count($id)
	{
		$this->db->set('count', 'count+1', FALSE);
		$this->db->where('id', $id);
		$this->db->update('types');
	}
}
?>