<?php

class Person extends CI_Model {

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
	function get_info($name)
	{
		$this->db->select('id,role');
		$query = $this->db->get_where('person', array('name' => $name));
		return $query->row();
	}
	
	function get_full_name($id)
	{
		$this->db->select('full_name');
		$query = $this->db->get_where('person', array('id' => $id));
		return $query->row();
	}

	
}
?>