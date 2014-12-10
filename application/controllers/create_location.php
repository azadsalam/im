<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_location extends CI_Controller {

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
		$this->load->view('create_location');
	}
	
	function submit()
	{			
		$this->load->model('location');
		$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean|max_length[50]|callback_location_exists');			
		$this->form_validation->set_rules('description', 'Description', 'trim|xss_clean|max_length[255]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$this->load->view('create_location');
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
					       	'name' => set_value('name'),
					       	'description' => set_value('description')
						);
					
			// run insert model to write data to db
		
			if ($this->location->SaveForm($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('create_location/success');   // or whatever logic needs to occur
			}
			else
			{
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
		}
	}
	function success()
	{
			echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
	}
	
	function location_exists($location)
	{
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */