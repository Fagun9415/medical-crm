<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor  extends CI_Controller {

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
	public function verified_doctor()
	{	
		if ($this->session->userdata('logged_in_admin')) 
		{
			$this->load->view('backend/admin/template/header');
			$this->load->view('backend/admin/doctor/verified_doctor');
			$this->load->view('backend/admin/template/footer');
		} 
		else 
		{
            redirect('admin/Auth/logout', 'refresh');
        }	
	}

    public function verified_doctor_detail($doctor_id)
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];   
            $doctorid = my_decrypt($doctor_id);
            $parameters = array('doctorId' => $doctorid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/detailOfApprovedDoctors",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['details'] = $details; 
                $this->load->view('backend/admin/template/header');
                $this->load->view('backend/admin/doctor/verified_doctor_detail',$data);
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

	public function fetch_verified_doctor()
	{	
		if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];	
			
			$result = methodGet("api/admin/getApprovedDoctorsListForAdmin",$token);
		    
		    $result_array = json_decode($result);
		    $doctor = $result_array->data;
		    $status = $result_array->status;

            if (!empty($doctor)) 
            {
            	$data = [];

                $i = 1;
                foreach ($doctor as $key => $row) {
                   	
                   	$doctor_id = my_encrypt($row->id);
                    
                	$a = '<a href=" '.base_url('admin/Doctor/verified_doctor_detail/').$doctor_id.'">
                                <h2 class="table-avatar">
                                                    <span class="user-name">'.ucwords($row->name).'<br>'.$row->email.'</span>
                                                </h2></a>';

                    
                    if ($row->isActive == true) 
                    {
                       $status ='<button type="button" class="btn btn-rounded btn-success status" id="'.$doctor_id.'">Active</button>';
                    }
                    else
                    {                            
                     	$status ='<button type="button" class="btn btn-rounded btn-danger status" id="'.$doctor_id.'">Inactive</button>';    
                 	}                                
                                                    
                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = '('.$row->doctorPhoneCode.') '.$row->doctorPhoneNo;
                    $sub_array[] = ucwords($row->doctorSpeciality);
                    $sub_array[] = '<a href="javascript:void(0)">
                                	<h2 class="table-avatar">
                                                    <span class="user-name">'.ucwords($row->hospitalName).'<br> ('.$row->hospitalPhoneCode.') '.$row->hospitalPhoneNo.'</span>
                                                </h2></a>';                            
                    $sub_array[] = $status;
                    $sub_array[] = '<a href=" '.base_url('admin/Doctor/verified_doctor_detail/').$doctor_id.'" class="btn btn-dark">View Details</a>';
                    

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

	public function change_status()
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];   
            $doctorId = my_decrypt($_POST['id']);
            $parameters = array('doctorId' => $doctorId);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/changeStatusDoctorByAdmin",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;
            $message = $result_array->message;


            if ($status == 200) 
            {
                $data['status'] = "success";
                $data['message'] = $message;
            } 
            else 
            {
                $data['status'] = "unsuccess";
                $data['message'] = $message;
            }
            echo json_encode($data);  
        } 
        else 
        {
            redirect('admin/Auth/logout', 'refresh');
        }
    }

    public function unverified_doctor()
	{	
		if ($this->session->userdata('logged_in_admin')) 
		{
			$this->load->view('backend/admin/template/header');
			$this->load->view('backend/admin/doctor/unverified_doctor');
			$this->load->view('backend/admin/template/footer');
		} 
		else 
		{
            redirect('admin/Auth/logout', 'refresh');
        }	
	}

    public function unverified_doctor_detail($doctor_id)
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];   
            $doctorid = my_decrypt($doctor_id);
            $parameters = array('doctorId' => $doctorid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/detailForApprovementForDoctor",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['details'] = $details; 
                $this->load->view('backend/admin/template/header');
                $this->load->view('backend/admin/doctor/unverified_doctor_detail',$data);
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

	public function fetch_unverified_doctor()
	{	
		if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];	
			
			$result = methodGet("api/admin/requestForApprovementListForDoctor",$token);
		    
		    $result_array = json_decode($result);
		    $doctor = $result_array->data;
		    $status = $result_array->status;

            if (!empty($doctor)) 
            {
            	$data = [];

                $i = 1;
                foreach ($doctor as $key => $row) {
                   	
                   	$doctor_id = my_encrypt($row->id);
                    
                	$a = '<a href=" '.base_url('admin/Doctor/unverified_doctor_detail/').$doctor_id.'">
                                <h2 class="table-avatar">
                                                    <span class="user-name">'.ucwords($row->name).'<br>'.$row->email.'</span>
                                                </h2></a>';

                    
                    if ($row->isApproved == true) 
                    {
                       $status ='';
                    }
                    else
                    {                            
                     	$status ='<button type="button" class="btn btn-rounded btn-primary status" id="'.$doctor_id.'">Verify</button>';    
                 	}                                
                                                    
                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = '('.$row->doctorPhoneCode.') '.$row->doctorPhoneNo;
                    $sub_array[] = ucwords($row->doctorSpeciality);
                    $sub_array[] = '<a href="javascript:void(0)">
                                	<h2 class="table-avatar">
                                                    <span class="user-name">'.ucwords($row->hospitalName).'<br> ('.$row->hospitalPhoneCode.') '.$row->hospitalPhoneNo.'</span>
                                                </h2></a>';
                    $sub_array[] = $status.'<a href=" '.base_url('admin/Doctor/unverified_doctor_detail/').$doctor_id.'" class="btn btn-dark" style="margin-left:10px;">View Details</a>';
                    

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

	public function verify_doctor()
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];   
            $doctorId = my_decrypt($_POST['id']);
            $parameters = array('doctorId' => $doctorId);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/approveDoctorByAdmin",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;
            $message = $result_array->message;


            if ($status == 200) 
            {
                $data['status'] = "success";
                $data['message'] = $message;
            } 
            else 
            {
                $data['status'] = "unsuccess";
                $data['message'] = $message;
            }
            echo json_encode($data);  
        } 
        else 
        {
            redirect('admin/Auth/logout', 'refresh');
        }
    }

	


	
}