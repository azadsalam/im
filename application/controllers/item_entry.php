<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_entry extends CI_Controller 
{

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
		$data['id_name_tuples']=$this->get_id_name_tuples();
		$this->load->view('item_entry_view',$data);
	}
	
	function get_id_name_tuples()
	{
		$this->load->model('types');
		return $this->types->get_id_name_tuples();
		
	}
	
	public function submit()
	{
		$this->load->database();
		$this->load->model('item');
		
		$data['id_name_tuples']=$this->get_id_name_tuples();
		$this->form_validation->set_rules('type_id', 'Type', 'required|trim|xss_clean|callback_item_type_exists');			
		//$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean|max_length[50]');			
		$this->form_validation->set_rules('make', 'Make', 'trim|xss_clean|max_length[50]');			
		$this->form_validation->set_rules('description', 'Description', 'trim|xss_clean|max_length[255]');			
		$this->form_validation->set_rules('purchase_date', 'Purchase Date', 'trim|xss_clean');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$this->load->view('item_entry_view',$data);
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model

			
		/*	$this->load->library('id_name_conversion');
			echo 
			$this->id_name_conversion->to_name($this->input->post('type_id'));
		
			return;
			*/
			
			$form_data = array(
					       	'type_id' => set_value('type_id'),
					       	'make' => set_value('make'),
					       	'description' => set_value('description'),
					       	'purchase_date' => set_value('purchase_date')
						);
					
			// run insert model to write data to db
			//print_r($form_data);

			$name = $this->item->SaveForm($form_data);			
			if (isset($name)) // the information has therefore been successfully saved in the db
			{
				//redirect('item_entry/success');   // or whatever logic needs to occur
				$this->success($name);
			}
			else
			{
				echo 'An error occurred saving your information. Please try again later';
			// Or whatever error handling is necessary
			}
		}
		
	}
	
	
	function success($item_name)
	{
		$data['id_name_tuples']=$this->get_id_name_tuples();
		$data['msg'] = "Succesfuly Entered New Item ".$item_name;
		$this->load->view('item_entry_view',$data);
		
	}
	
	function item_type_exists($type_id)
	{
		$data['id_name_tuples']=$this->get_id_name_tuples();
		$this->load->model('types');
		if($this->types->type_id_exists($type_id))
			return TRUE;
		else 
		{	
			$this->form_validation->set_message('item_type_exists',"The Type Does Not Exists!!!Contact Administrator!!");
			return FALSE;
		}
			
	}
}