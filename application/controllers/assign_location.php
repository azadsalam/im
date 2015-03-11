<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assign_location extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('auth_helper');
		redirect_if_not_logged_in();
		//echo $pid;
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
		//$this->load->model('item');
		//echo $this->item->getItemIdByName('AC0000000011');
		$this->load->view('assign_location_view');
	}
	
	function assign_request()
	{
		$this->form_validation->set_rules('new_location', 'Location', 'required|trim|xss_clean|max_length[50]|callback_location_exists');
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
		
		//echo $this->input->post('new_location');
		
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$this->load->view('assign_location_view');
		}
		else // passed validation proceed to post success logic
		{

			$this->load->model('location');
			$data['item_id'] = $this->input->post('item_id');
			$data['pid'] = $this->session->userdata('pid');
			$old_location = $this->input->post('old_location');
			
			if($old_location=='Unassigned')$old_location=NULL;
			else $old_location =  $this->location->get_location_id($this->input->post('old_location'));
			$data['old_location'] = $old_location;
			
			$data['new_location'] = $this->location->get_location_id($this->input->post('new_location'));
			$data['status'] = 'Pending';
			
			$this->load->model('location_assignment_request');
			if($this->location_assignment_request->insert($data))
			{
				//echo "SUCCESSSSSSSS!!!!!!!!!!!!!!!!";
				$data['msg'] = "Request Sent to Administrator!";
				//redirect('unassigned_items');
				$this->load->view('assign_location_view',$data);	
			}
			else 
			{
				
				//redirect('unassigned_items');
				$data['msg'] = "An unexpected error occured! Please Try Again After Sometime";
				$this->load->view('assign_location_view',$data);
			}
		}
	}
	
	function from_gc()
	{
		$item_id = $this->uri->segment(3,0);
		$this->load->model('item');
		$name = $this->item->get_name($item_id);
		$this->show_location_assign_view($name);
		
		//echo $name;
	}
	
	function find_item()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean|max_length[50]|callback_item_exists');
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
		
		
		
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$this->load->view('assign_location_view');
		}
		else // passed validation proceed to post success logic
		{
			$name= $this->input->post('name');
			$this->show_location_assign_view($name);
			//print_r($data);
			//echo $name;
		}
	}
	
	function show_location_assign_view($name)
	{
		$this->load->database();
		$this->load->model('item');
		$this->load->model('types');
		
		//$id = $this->item->getItemIdByName($name);
		
		$info = $this->item->getAllByName($name);
		
		$type_id = $info['type_id'];
		$typeName = $this->types->get_name($type_id);			
		$info['type_name'] = $typeName;

		$this->load->model('location');
		
		//print_r($info);
		if(!isset($info['lid']) || $info['lid']==NULL)
		{
			$info['lname']='Unassigned';
		}
		else
		{
			$info['lname'] = $this->location->get_location_name($info['lid']);
		}
	
		$data['locations']  = $this->location->get_locations();
		
		$data['data'] = $info;
		
		$this->load->view('assign_location_view2',$data);
		
	}
	
	function item_exists($name)
	{
		$this->load->database();
		$this->load->model('item');
		$id = $this->item->getItemIdByName($name);
		
		if(isset($id))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('item_exists',"The Item Does Not Exist!!");
			return FALSE;
		}
	}
	function location_exists($location)
	{
		$this->load->model('location');
		if($this->location->location_exists($location))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('location_exists', 'This location does not exist');		
			return FALSE;
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */