<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function redirect_if_not_logged_in()
    {
		
		$CI = &get_instance();
		$pid = $CI->session->userdata('pid');
		if($pid == false)
		{
			redirect('login');
		}
    }   
    
    function is_logged_in()
    {
    	$CI = &get_instance();
		$pid = $CI->session->userdata('pid');
		return $pid;	
	}
    function get_priviledge_level()
    {
    	$CI = &get_instance();
		return $CI->session->userdata('priviledge');
    }
}