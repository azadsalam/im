<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items_location extends CI_Controller {

	public $lname;
	public $type_id;
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

		
		$this->load->helper('form');
		$this->form_validation->set_rules('lname', 'Location', 'trim|xss_clean');				
		$this->form_validation->set_rules('type_id','Type','trim|xss_clean');		
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		//$this->lname = NULL;
		//$this->type_id = NULL;
		if ($this->form_validation->run() == TRUE) 
		{
			$this->lname = $this->input->post('lname');
			$this->type_id = $this->input->post('type_id');
		}
		
		
		if(!isset($this->lname) && !isset($this->type_id))
		{
			$this->load->view('items_location_view');
			return;
		}
		//echo $this->lname . ' <-> '.$this->type_id;

//		echo $this->lname;
//		$this->load->view('items_location_view_part1',array('lname'=>$lname));
 		//$data['output']=NULL;
		$output=NULL;
		try
		{
//			if(isset($this->lname))
//			{
				$crud = new grocery_CRUD();
				$crud->set_theme('datatables');
				$crud->set_table('item');
				
				
				$crud->required_fields('type_id','name','lid');
				
				
				if(isset($this->lname) && !empty($this->lname))
				{
					if($this->lname == 'NO_LOCATION')
					{
						$crud->where('lid',NULL);
					}
					else 
					{
						$this->load->model('location');
						$lid = $this->location->get_location_id($this->lname);
						
						$crud->where('lid',$lid);
					}
				}
				
				if(isset($this->type_id) && !empty($this->type_id)) 
					$crud->where('type_id',$this->type_id);
					//$crud->where('type_id',1);
				$crud->unset_add();
			
				//if(get_priviledge_level() != 'admin')
            	
				$crud->unset_edit();
	            $crud->unset_print();
	            
	            $crud->display_as('type_id','Type');
	            $crud->display_as('lid','Location');
	            
				/*$crud->set_primary_key('name');
				$crud->set_subject('Location');
				$crud->field_type('description', 'textarea');
				
				$crud->set_rules('name','Name','trim|required|max_length[50]|xss_clean|alpha_dash||callback_location_exists');
				$crud->set_rules('room_no','Room No','numeric|trim|xss_clean');
				*/
				//$crud->columns('name','description');
	 			//$crud->callback_add_field('name',array($this,'add_name_callback'));
	            $crud->callback_column($this->unique_field_name('lid'),array($this,'blankFormatting'));
	            
				$crud->set_relation('type_id','types','name');
				$crud->set_relation('lid','location','name');
	 			$crud->add_action('Assign Location', '', 'assign_location/from_gc','ui-icon-image');
				
	 			$output = $crud->render();
	 			
	 			$data['output']=$output;
//			}
			
			//print_r($output);
			//$output['location_list']=array(1,2,3);
			

			$this->load->view('items_location_view',$output);
			
		}
		catch(Exception $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
			$this->load->view('items_view',(object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		}
		
		
	}
	
	function unique_field_name($field_name) 
	{
	    return 's'.substr(md5($field_name),0,8); //This s is because is better for a string to begin with a letter and not with a number
    }
	
	function get_lname()
	{
		if(isset($this->lname) && !empty($this->lname))
			return $this->lname;
		else 
			return 'ALL';
	}
	function get_type_name()
	{
		$this->load->model('types');
		
		$type_name= $this->types->get_name($this->type_id);
		
		if(isset($type_name) && !empty($type_name)) return  $type_name;
		else return 'ALL';
		
	}
	
	function get_type_id()
	{
		return $this->type_id;
	}
	function get_locations()
	{
		$this->load->model('location');
		
		$location[''] = 'ALL';
		$location['NO_LOCATION'] = 'NO LOCATION';
		$temp = $this->location->get_locations();
		return array_merge($location,$temp);
		
	}
	function get_types()
	{
		
		$this->load->model('types');
		$types= $this->types->get_id_name_tuples();
		$types['']='ALL';  
		return $types; 
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
	function blankFormatting($value, $row)
	{
		//echo "here";
		if(!isset($value) || empty($value)) 
			return 'NO LOCATION';
		else 
			return $value;	
	}
	/*function add_name_callback()
	{
		
	}*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */