<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Types extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

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

		
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('types');
			$crud->set_subject('Type');
			$crud->display_as('pid','Parent Type');
			//$crud->required_fields('city');
			$crud->required_fields('name','code');
			$crud->set_rules('code','Code','trim|required|min_length[2]|max_length[4]|xss_clean');
			$crud->set_rules('name','Name','trim|required|max_length[30]|xss_clean');
			$crud->set_rules('description','Description','trim|xss_clean');
			$crud->set_relation('pid','types','name');
			
			$crud->columns('name','code','description','pid');
			//$crud->columns('id','name','code','count','description','pid');
 			//$crud->callback_add_field('name',array($this,'add_name_callback'));
			$crud->add_fields('name','code','description','pid');
			
			$crud->unset_read('count');
			$crud->unset_edit();
 			$output = $crud->render();

			$this->load->view('types_view',$output);
			
		}
		catch(Exception $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
			$this->load->view('types_view',(object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		}
		
	}
	/*function add_name_callback()
	{
		
	}*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */