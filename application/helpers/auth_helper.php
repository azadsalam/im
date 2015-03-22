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
    
    function is_admin_or_super_admin()
    {
    	if(!is_logged_in()) return false;
        $CI = &get_instance();
		$pid = $CI->session->userdata('pid');
		$pri = $CI->session->userdata('priviledge');
		if($pri=='admin' || $pri == 'superadmin') return true;
		
		else return false;
    }
}