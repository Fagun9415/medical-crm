<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient  extends CI_Controller {

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
	public function patient_list()
	{	
		if ($this->session->userdata('logged_in_admin')) 
		{
			$this->load->view('backend/admin/template/header');
			$this->load->view('backend/admin/patient/patient_list');
			$this->load->view('backend/admin/template/footer');
		} 
		else 
		{
            redirect('admin/Auth/logout', 'refresh');
        }	
	}

    public function patient_family_list($patient_id)
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];   
            $patientid = my_decrypt($patient_id);
            $parameters = array('phoneNo' => $patientid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/getPatientsByMobileToGetAllRelationForAdmin",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['families'] = $details;
                $this->load->view('backend/admin/template/header');
                $this->load->view('backend/admin/patient/patient_family_list',$data);
                $this->load->view('backend/admin/template/footer');
            }
            else
            {
                $data['error'] = $error;
                $this->load->view('error', $data);
            }    
        } 
        else 
        {
            redirect('admin/Auth/logout', 'refresh');
        }    
    }

	public function fetch_patient_list()
	{	
		if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];	
			
			$result = methodGet("api/admin/getAllPrimaryPatients",$token);
		    
		    $result_array = json_decode($result);
		    $patient = $result_array->data;
		    $status = $result_array->status;

            if (!empty($patient)) 
            {
            	$data = [];

                $i = 1;
                foreach ($patient as $key => $row) {
                   	
                   	$patient_id = my_encrypt($row->phoneNo);


                    $dateOfBirth = date('d-m-Y',strtotime($row->birthDate));
                    $today = date("Y-m-d");
                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
                    $age = $diff->format('%y');
                    
                	$a = '<a href="javascript:void(0)">
                                <h2 class="table-avatar">
                                                    <span class="user-name">'.ucwords($row->name).'<br>'.$row->email.'</span>
                                                </h2></a>';


                                                    
                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = '('.$row->phoneCode.') '.$row->phoneNo;
                    $sub_array[] = $age.' yrs';
                    $sub_array[] = ucwords($row->gender);
                    $sub_array[] = '<a href=" '.base_url('admin/Patient/patient_family_list/').$patient_id.'" class="btn btn-dark">View Relations</a>';
                    

                    $data[] = $sub_array;

                 $i++;
                }

                $output = [
                    "data" => $data,
                ];
            }
            else
            {
            	$output = [
                    "data" => [],
                ];
            }	
            echo json_encode($output);
		} 
        else 
        {
            redirect('admin/Auth/logout', 'refresh');
        }	
	}

	public function patient_detail($patient_id)
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];   
            $patientid = my_decrypt($patient_id);
            $parameters = array('patientId' => $patientid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/detailOfPatient",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            $parameters1 = array('patientId' => $patientid);
            $json_param1 = json_encode($parameters1);
            $header1 = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result1 = methodPost("api/admin/detailOfPatientListForEncounter",$header1,$json_param1);
            $result_array1 = json_decode($result1);
            $details1 = $result_array1->data;
            $status1 = $result_array1->status;

            $parameters2 = array('patientId' => $patientid);
            $json_param2 = json_encode($parameters2);
            $header2 = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result2 = methodPost("api/admin/detailOfPatientListForLab",$header2,$json_param2);
            $result_array2 = json_decode($result2);
            $details2 = $result_array2->data;
            $status2 = $result_array2->status;

            $parameters3 = array('patientId' => $patientid);
            $json_param3 = json_encode($parameters3);
            $header3 = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result3 = methodPost("api/admin/detailOfPatientListForPharmacy",$header3,$json_param3);
            $result_array3 = json_decode($result3);
            $details3 = $result_array3->data;
            $status3 = $result_array3->status;

            if ($status == 200 && $status1 == 200 && $status2 == 200 && $status3 == 200) 
            {   
                $data['details'] = $details;
                $data['encounters'] = $details1;
                $data['labs'] = $details2;
                $data['pharmacies'] = $details3; 
                $this->load->view('backend/admin/template/header');
                $this->load->view('backend/admin/patient/patient_detail',$data);
                $this->load->view('backend/admin/template/footer');
            }
            else
            {
                $data['error'] = $error;
                $this->load->view('error', $data);
            }    
        } 
        else 
        {
            redirect('admin/Auth/logout', 'refresh');
        }    
    }

	


	
}