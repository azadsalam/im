<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Process_relocation_request extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$pid = $this->session->userdata('pid');
		$priviledge = $this->session->userdata('priviledge');
		//echo $priviledge;
		if($pid==false || $priviledge != 'admin')
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
		foreach ($res as &$row)
		{
			//$pid = $row['pid'];
			$item_id = $row['item_id'];
			$row['item_name'] = $this->item->get_name($item_id);
			
			if(!isset($row['old_location']))
				$row['old_location'] = 'Unassigned';
		}
		
		$this->load->library('table');
		$data['data']= $res;
		$this->load->view('process_relocation_request_view',$data);
				
//		print_r($res);
	}
	
	function approve()
	{
		$request_id = $this->input->post('request_id');	
		//echo $request_id;
		
		$this->load->model('location_assignment_request');
		$this->load->model('item');
		
		
		$row = $this->location_assignment_request->get_row($request_id);
		
		//print_r($row);
		
		$success = $this->item->set_location($row['item_id'],$row['new_location']);
		
		//if($success)
		//{
			if($this->location_assignment_request->approve($request_id))
			{
				$this->location_assignment_request->decline_all_pending($row['item_id']);
				$this->index();
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