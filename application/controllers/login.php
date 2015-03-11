<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$pid = $this->session->userdata('pid');
		
/*		if($pid!=false)
		{
			//logged in 
		}
*/		
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
		$this->load->view('login_view');
	}
	function submit()
	{
		$this->form_validation->set_rules('name', 'Username', 'required|trim|xss_clean|max_length[50]');			
		$this->form_validation->set_rules('pass', 'Password', 'required|trim|xss_clean|max_length[255]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$this->load->view('login_view');
		}
		else // passed validation proceed to post success logic
		{
			
			
			$username = $this->input->post('name');
			$password = $this->input->post('pass');
			$un=$username;
			
			
			$this->load->library('Radius');
			$ip_radius_server="172.16.101.11";
			$shared_secret="testing123*cse";
			$radius = new Radius($ip_radius_server, $shared_secret);
			$result = $radius->AccessRequest($username, $password);
			//print_r($result);
			
			
			if($result)
			{
				$this->session->set_userdata('username',$un);
				$this->session->set_userdata('priviledge','admin');
				$this->session->set_userdata('pid',1);
				
				$data['message']="Welcome ".$un;
				$this->load->view('success',$data);
			}
			else if($un=='user' && $pass=='RSAS')
			{
				$this->session->set_userdata('username',$un);
				$this->session->set_userdata('priviledge','user');
				$this->session->set_userdata('pid',2);
				$data['message']="Welcome ".$un;
				$this->load->view('success',$data);
			}
			else 
			{
				$data['msg'] = "INCORRECT CREDENTIALS";
				$this->load->view('login_view',$data);
			}
		}
	}
	
	function logout()
	{
		$array_items = array('username' => '', 'priviledge' => '','pid' => '');
		$this->session->unset_userdata($array_items);
		$data['msg'] = "You Have been logged out";
		$this->load->view('login_view',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */