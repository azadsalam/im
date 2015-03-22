<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unassigned_items extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	
		$this->load->helper('auth_helper');
		redirect_if_not_logged_in();
		
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
		
		
		
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('item');
			$crud->required_fields('type_id','name','lid');
			
			
			$crud->where('lid',NULL);
			$crud->unset_add();

			//if(get_priviledge_level() != 'admin')
            $crud->unset_edit();
            
            
            $crud->display_as('type_id','Type');
            //$crud->display_as('lname','Location');
            
            
			/*$crud->set_primary_key('name');
			$crud->set_subject('Location');
			$crud->field_type('description', 'textarea');
			
			$crud->set_rules('name','Name','trim|required|max_length[50]|xss_clean|alpha_dash||callback_location_exists');
			$crud->set_rules('room_no','Room No','numeric|trim|xss_clean');
			*/
			//$crud->columns('name','description');
 			//$crud->callback_add_field('name',array($this,'add_name_callback'));
			
            
			$crud->set_relation('type_id','types','name');
			//$crud->set_relation('lname','location','name');
 
            $crud->columns('name','type_id','make','purchase_date','lid','description');
 			
 			$crud->add_action('Assign Location', '', 'assign_location/from_gc','ui-icon-image');
 			
			$output = $crud->render();

			$this->load->view('unassigned_items_view',$output);
			
		}
		catch(Exception $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
			$this->load->view('items_view',(object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
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
	
	

	/*function add_name_callback()
	{
		
	}*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */