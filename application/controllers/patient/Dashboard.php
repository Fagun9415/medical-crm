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
		if ($this->session->userdata('logged_in_patient')) 
		{	
			$token = $this->session->userdata('logged_in_patient')['token'];
			$patient_id = $this->session->userdata('logged_in_patient')['patient_id'];	
			
			$parameters = array('patientId' => $patient_id);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodGetwithparm("api/patient/countDashboardForPatient",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {	
            	$data['counts'] = $details;
				$this->load->view('backend/patient/template/header');
				$this->load->view('backend/patient/template/dashboard',$data);
				$this->load->view('backend/patient/template/footer');
			}    
            else
            {
                $data['error'] = $error;
                $this->load->view('error', $data);
            }
		} 
		else 
		{
            redirect('patient/Auth/logout', 'refresh');
        }	
	}

	public function family_list()
	{	
		if ($this->session->userdata('logged_in_patient')) 
		{	
			$token = $this->session->userdata('logged_in_patient')['token'];

	        $result = methodGet('api/patient/getPatientsByMobile', $token);
	        $requestlist = json_decode($result);

	        $encounter = $requestlist->data;
	        $status = $requestlist->status;

	        if ($status == 200) 
	        {	
	        	$data['families'] = $encounter;	
	         
				$this->load->view('backend/patient/template/header');
				$this->load->view('backend/patient/template/family_list',$data);
				$this->load->view('backend/patient/template/footer');
			}
			else
			{
				$data['error'] = $error;
                $this->load->view('error', $data);
			}		
		} 
		else 
		{
            redirect('patient/Auth/logout', 'refresh');
        }	
	}


	public function setsession()
	{	
		if ($this->session->userdata('logged_in_patient')) 
		{	
			$patient_id = $_POST['id'];

			$token = $this->session->userdata('logged_in_patient')['token'];
			$patientid = my_decrypt($patient_id);

			$result1 = methodGet("api/patient/profile",$token);
            $result_array1 = json_decode($result1);
            $clientdata = $result_array1->user;

            $sess_array = array(
                    'token' => $token,
                    'profile' => $clientdata,
                    'patient_id' => $patientid
                );

            $this->session->set_userdata('logged_in_patient', $sess_array);

			echo true;		
			
		} 
		else 
		{
            redirect('patient/Auth/logout', 'refresh');
        }	
	}

	public function add_patient_relation()
	{	
		if ($this->session->userdata('logged_in_patient')) 
        {	
        	$token = $this->session->userdata('logged_in_patient')['token'];
        	$birthDate = $_POST['birthDate'];
        	$gender = $_POST['gender'];
        	$role = $_POST['role'];
        	$name = $_POST['name'];

				$data_value = array(
				'name' => $name,
				'birthDate' => $birthDate,
				'gender' => $gender,
				'role' => $role
				);
			
			$final_data = json_encode($data_value);

			$header = ["authorization: Bearer " . $token, "content-type: application/json"];
			$result = methodPost('api/patient/addFamilyPatientByPrimaryPatient', $header, $final_data);
	        $result_array = json_decode($result);

	        
	        $error = $result_array->error;
	        $message = $result_array->message;
	        $status = $result_array->status;

	        if ($status == 200) 
	        {
	            $data['status'] = "success";
	            $data['message'] = $message;
	        } else {
	            $data['status'] = "unsuccess";
	            $data['message'] = $message;
	        }
	        echo json_encode($data);	
		} 
        else 
        {
            redirect('patient/Auth/logout', 'refresh');
        }	
	}



}