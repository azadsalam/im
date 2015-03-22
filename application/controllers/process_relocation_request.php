<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Process_relocation_request extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('auth_helper');
	
		//echo $pid." ".$priviledge;
		if(!is_admin_or_super_admin())
		{
			//logged in
			redirect('login'); 
		}
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
		
		$this->load->model('location_assignment_request');
		$res= $this->location_assignment_request->get_pending();
		
		$this->load->model('item');
		$this->load->model('location');
		$this->load->model('person');		
		
		foreach ($res as &$row)
		{
			//print_r($row);
			//echo "<br/>";
			
			$pid = $row['pid'];
			$name = $this->person->get_full_name($pid)->full_name;
			
			$row['full_name'] = $name;
			$item_id = $row['item_id'];
			$row['item_name'] = $this->item->get_name($item_id);
			
			if(!isset($row['old_location']))$row['old_location'] = 'Unassigned';
			else $row['old_location'] = $this->location->get_location_name($row['old_location']);
			
			$row['new_location'] = $this->location->get_location_name($row['new_location']);
		}
		
		$this->load->library('table');
		$data['data']= $res;
		$this->load->view('process_relocation_request_view',$data);
				
//		print_r($res);
	}
	
	function approve()
	{
		$request_id = $this->input->post('request_id');	
		if(!isset($request_id) || $request_id==NULL)
		{
			redirect('process_relocation_request');	
		}
		
		//echo 'hello'.$request_id;
		
		$this->load->model('location_assignment_request');
		$this->load->model('item');
		//$this->load->model('location');
		
		
		$row = $this->location_assignment_request->get_row($request_id);
		
		//print_r($row);
		
		
		$success = $this->item->set_location($row['item_id'],$row['new_location']);
		
		//if($success)
		//{
		if($this->location_assignment_request->approve($request_id))
		{
			$this->location_assignment_request->decline_all_pending($row['item_id']);
			//$this->index();
			redirect('process_relocation_request');	
		}
		else 
			$this->load->view('failure');
		
		/*else
		{
		    echo "here2";
	//		$this->load->view('failure');
		}*/
		
	}
	
	function decline()
	{
		$request_id = $this->input->post('request_id');	
		//echo $request_id;
		
		$this->load->model('location_assignment_request');

		
		if($this->location_assignment_request->decline($request_id))
		{
			$this->index();
		}
		else 
				$this->load->view('failure');
		
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */