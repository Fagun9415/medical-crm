<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard  extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {	
        	$token = $this->session->userdata('logged_in_doctor')['token'];	

	        $result = methodGet('api/doctors/countDashboardForDoctor',$token);
	        $requestlist = json_decode($result);

	        $counts = $requestlist->data;
	        $status = $requestlist->status;

	        if ($status == 200) 
	        {	
	        	$data['counts'] = $counts;	        
	        	$this->load->view('backend/doctor/template/header');
				$this->load->view('backend/doctor/template/dashboard',$data);
				$this->load->view('backend/doctor/template/footer');
			}
			else
			{
				$data['error'] = $error;
                $this->load->view('error', $data);
			}	
		} 
        else 
        {
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}
}