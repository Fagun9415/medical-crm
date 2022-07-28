<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lab  extends CI_Controller {

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
	public function verified_lab()
	{	
		if ($this->session->userdata('logged_in_admin')) 
		{
			$this->load->view('backend/admin/template/header');
			$this->load->view('backend/admin/lab/verified_lab');
			$this->load->view('backend/admin/template/footer');
		} 
		else 
		{
            redirect('admin/Auth/logout', 'refresh');
        }	
	}

    public function verified_lab_detail($lab_id)
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];   
            $labid = my_decrypt($lab_id);
            $parameters = array('labId' => $labid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/detailOfApprovedLab",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['details'] = $details; 
                $this->load->view('backend/admin/template/header');
                $this->load->view('backend/admin/lab/verified_lab_detail',$data);
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

	public function fetch_verified_lab()
	{	
		if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];	
			
			$result = methodGet("api/admin/getApprovedLabListForAdmin",$token);
		    
		    $result_array = json_decode($result);
		    $lab = $result_array->data;
		    $status = $result_array->status;

            if (!empty($lab)) 
            {
            	$data = [];

                $i = 1;
                foreach ($lab as $key => $row) {
                   	
                   	$lab_id = my_encrypt($row->id);
                    
                	$a = '<a href=" '.base_url('admin/Lab/verified_lab_detail/').$lab_id.'">
                                <h2 class="table-avatar">
                                                    <span class="user-name">'.ucwords($row->name).'<br>'.$row->email.'</span>
                                                </h2></a>';

                    
                    if ($row->isActive == true) 
                    {
                       $status ='<button type="button" class="btn btn-rounded btn-success status" id="'.$lab_id.'">Active</button>';
                    }
                    else
                    {                            
                     	$status ='<button type="button" class="btn btn-rounded btn-danger status" id="'.$lab_id.'">Inactive</button>';    
                 	}

                    if ($row->labPhoneNo2 != '') 
                    {
                        $phone2 = '<br> ('.$row->labPhoneCode2.')'.$row->labPhoneNo2;
                    }
                    else
                     {
                        $phone2 = '';
                     }   

                                                    
                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = '('.$row->labPhoneCode1.') '.$row->labPhoneNo1.$phone2;
                    $sub_array[] = $row->address;
                    $sub_array[] = $status;
                    $sub_array[] = '<a href=" '.base_url('admin/Lab/verified_lab_detail/').$lab_id.'" class="btn btn-dark">View Details</a>';
                    

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
            $labId = my_decrypt($_POST['id']);
            $parameters = array('labId' => $labId);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/changeStatusLabByAdmin",$header,$json_param);
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

    

    public function unverified_lab()
	{	
		if ($this->session->userdata('logged_in_admin')) 
		{
			$this->load->view('backend/admin/template/header');
			$this->load->view('backend/admin/lab/unverified_lab');
			$this->load->view('backend/admin/template/footer');
		} 
		else 
		{
            redirect('admin/Auth/logout', 'refresh');
        }	
	}

    public function unverified_lab_detail($lab_id)
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];   
            $labid = my_decrypt($lab_id);
            $parameters = array('labId' => $labid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/detailForApprovementForLab",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['details'] = $details; 
                $this->load->view('backend/admin/template/header');
                $this->load->view('backend/admin/lab/unverified_lab_detail',$data);
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

	public function fetch_unverified_lab()
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];  
            
            $result = methodGet("api/admin/requestForApprovementListForLab",$token);
            
            $result_array = json_decode($result);
            $lab = $result_array->data;
            $status = $result_array->status;

            if (!empty($lab)) 
            {
                $data = [];

                $i = 1;
                foreach ($lab as $key => $row) {
                    
                    $lab_id = my_encrypt($row->id);
                    
                    $a = '<a href=" '.base_url('admin/Lab/unverified_lab_detail/').$lab_id.'">
                                <h2 class="table-avatar">
                                                    <span class="user-name">'.ucwords($row->name).'<br>'.$row->email.'</span>
                                                </h2></a>';

                    
                    if ($row->isApproved == true) 
                    {
                       $status ='';
                    }
                    else
                    {                            
                        $status ='<button type="button" class="btn btn-rounded btn-primary status" id="'.$lab_id.'">Verify</button>';    
                    }

                    if ($row->labPhoneNo2 != '') 
                    {
                        $phone2 = '<br> ('.$row->labPhoneCode2.')'.$row->labPhoneNo2;
                    }
                    else
                     {
                        $phone2 = '';
                     }   

                                                    
                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = '('.$row->labPhoneCode1.') '.$row->labPhoneNo1.$phone2;
                    $sub_array[] = $row->address;
                    $sub_array[] = $status.'<a href=" '.base_url('admin/Lab/unverified_lab_detail/').$lab_id.'" class="btn btn-dark" style="margin-left:10px;">View Details</a>';
                    

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

	public function verify_lab()
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];   
            $labId = my_decrypt($_POST['id']);
            $parameters = array('labId' => $labId);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/approveLabByAdmin",$header,$json_param);
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