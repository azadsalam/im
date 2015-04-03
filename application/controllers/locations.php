<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locations extends CI_Controller {
	
	public $floor="ALL";
	public $state=-1;
	
	public function __construct()
	{
		
		parent::__construct();

		$this->load->helper(array('dompdf', 'file'));
		
		$this->load->helper('auth_helper');

	
		//echo $pid." ".$priviledge;
		if(!is_admin_or_super_admin())
		{
			//logged in
			redirect('login'); 
		}
		
		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('form');
		$this->form_validation->set_rules('floor', 'Level', 'trim|xss_clean');				
		
	
		if ($this->form_validation->run() == TRUE) 
		{
			$this->floor = $this->input->post('floor');
		}
		
		try
		{
			$crud = new grocery_CRUD();
			$this->state = $crud->gimme();
			$crud->set_theme('datatables');
			$crud->set_table('location');
			//$crud->set_primary_key('name');
			$crud->set_subject('Location');
			$crud->field_type('description', 'textarea');
			
			//echo $crud->gimme() ."<br/>ASSA<br/>";
				
			
			//$crud->required_fields('name');
			$crud->set_rules('name','Name','trim|required|max_length[50]|xss_clean');
			$crud->set_rules('room_no','Room No','numeric|trim|xss_clean');
			$crud->set_rules('description','Description','trim|xss_clean');
			$crud->set_rules('floor','Level','trim|xss_clean');
			
			$crud->columns('name','room_no','floor','description');
 			
			$crud->display_as('floor','Level');
			if($this->floor != "ALL")
			{
				if($this->floor == "NULL") $crud->where('floor',NULL);
				else	$crud->where('floor',$this->floor);
			}
			//$crud->like('room_no','5','after');
			//$crud->callback_add_field('name',array($this,'add_name_callback'));
			
			$crud->unset_print();
 			$output = $crud->render();

			$this->load->view('locations_view',$output);
			
		}
		catch(Exception $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
			$this->load->view('locations_view',(object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		}
		
	}
	function location_exists($location)
	{
		$this->load->model('location');
		if($this->location->location_exists($location))
		{
			$this->form_validation->set_message('location_exists', 'This location already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	function get_floors()
	{
		$this->load->model('location');
		$raw = $this->location->get_floors();
		
		$data['ALL'] = "All";
		foreach($raw as $key=>$value)
		{
			if(empty($value))$data["NULL"] = "No Value";
			else $data["".$key] = $value;
		}
		return $data;
	}
	function get_floor()
	{
		return $this->floor;
	}
	function get_state()
	{
		return $this->state;
	}
	/*function add_name_callback()
	{
		
	}*/
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */