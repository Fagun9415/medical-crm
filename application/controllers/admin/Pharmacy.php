<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacy  extends CI_Controller {

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
	public function verified_pharmacy()
	{	
		if ($this->session->userdata('logged_in_admin')) 
		{
			$this->load->view('backend/admin/template/header');
			$this->load->view('backend/admin/pharmacy/verified_pharmacy');
			$this->load->view('backend/admin/template/footer');
		} 
		else 
		{
            redirect('admin/Auth/logout', 'refresh');
        }	
	}

    public function verified_pharmacy_detail($pharmacy_id)
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];   
            $pharmacyid = my_decrypt($pharmacy_id);
            $parameters = array('pharmacyId' => $pharmacyid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/detailOfApprovedPharmacy",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['details'] = $details;
                $this->load->view('backend/admin/template/header');
                $this->load->view('backend/admin/pharmacy/verified_pharmacy_detail',$data);
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

	public function fetch_verified_pharmacy()
	{	
		if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];	
			
			$result = methodGet("api/admin/getApprovedPharmacyListForAdmin",$token);
		    
		    $result_array = json_decode($result);
		    $pharmacy = $result_array->data;
		    $status = $result_array->status;

            if (!empty($pharmacy)) 
            {
            	$data = [];

                $i = 1;
                foreach ($pharmacy as $key => $row) {
                   	
                   	$pharmacy_id = my_encrypt($row->id);
                    
                	$a = '<a href=" '.base_url('admin/Pharmacy/verified_pharmacy_detail/').$pharmacy_id.'">
                                <h2 class="table-avatar">
                                                    <span class="user-name">'.ucwords($row->name).'<br>'.$row->email.'</span>
                                                </h2></a>';

                    
                    if ($row->isActive == true) 
                    {
                       $status ='<button type="button" class="btn btn-rounded btn-success status" id="'.$pharmacy_id.'">Active</button>';
                    }
                    else
                    {                            
                     	$status ='<button type="button" class="btn btn-rounded btn-danger status" id="'.$pharmacy_id.'">Inactive</button>';    
                 	}

                    if ($row->pharmacyPhoneNo2 != '') 
                    {
                        $phone2 = '<br> ('.$row->pharmacyPhoneCode2.')'.$row->pharmacyPhoneNo2;
                    }
                    else
                     {
                        $phone2 = '';
                     }   

                                                    
                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = '('.$row->pharmacyPhoneCode1.') '.$row->pharmacyPhoneNo1.$phone2;
                    $sub_array[] = $row->address;
                    $sub_array[] = $status;
                    $sub_array[] = '<a href=" '.base_url('admin/Pharmacy/verified_pharmacy_detail/').$pharmacy_id.'" class="btn btn-dark">View Details</a>';
                    

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
            $pharmacyId = my_decrypt($_POST['id']);
            $parameters = array('pharmacyId' => $pharmacyId);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/changeStatusPharmacyByAdmin",$header,$json_param);
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

    public function view_order($order_id)
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];   
            $orderid = my_decrypt($order_id);
            $parameters = array('labOrderId' => $orderid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/lab/detailOfScheduleOrders",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['details'] = $details; 
                $this->load->view('backend/lab/template/header');
                $this->load->view('backend/lab/order/view_order',$data);
                $this->load->view('backend/lab/template/footer');
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

    public function unverified_pharmacy()
	{	
		if ($this->session->userdata('logged_in_admin')) 
		{
			$this->load->view('backend/admin/template/header');
			$this->load->view('backend/admin/pharmacy/unverified_pharmacy');
			$this->load->view('backend/admin/template/footer');
		} 
		else 
		{
            redirect('admin/Auth/logout', 'refresh');
        }	
	}

    public function unverified_pharmacy_detail($pharmacy_id)
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];   
            $pharmacyid = my_decrypt($pharmacy_id);
            $parameters = array('pharmacyId' => $pharmacyid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/detailForApprovementForPharmacy",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['details'] = $details; 
                $this->load->view('backend/admin/template/header');
                $this->load->view('backend/admin/pharmacy/unverified_pharmacy_detail',$data);
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

	public function fetch_unverified_pharmacy()
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];  
            
            $result = methodGet("api/admin/requestForApprovementListForPharmacy",$token);
            
            $result_array = json_decode($result);
            $pharmacy = $result_array->data;
            $status = $result_array->status;

            if (!empty($pharmacy)) 
            {
                $data = [];

                $i = 1;
                foreach ($pharmacy as $key => $row) {
                    
                    $pharmacy_id = my_encrypt($row->id);
                    
                    $a = '<a href=" '.base_url('admin/Pharmacy/unverified_pharmacy_detail/').$pharmacy_id.'">
                                <h2 class="table-avatar">
                                                    <span class="user-name">'.ucwords($row->name).'<br>'.$row->email.'</span>
                                                </h2></a>';

                    
                    if ($row->isApproved == true) 
                    {
                       $status ='';
                    }
                    else
                    {                            
                        $status ='<button type="button" class="btn btn-rounded btn-primary status" id="'.$pharmacy_id.'">Verify</button>';    
                    }

                    if ($row->pharmacyPhoneNo2 != '') 
                    {
                        $phone2 = '<br> ('.$row->pharmacyPhoneCode2.')'.$row->pharmacyPhoneNo2;
                    }
                    else
                     {
                        $phone2 = '';
                     }   

                                                    
                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = '('.$row->pharmacyPhoneCode1.') '.$row->pharmacyPhoneNo1.$phone2;
                    $sub_array[] = $row->address;
                    $sub_array[] = $status.'<a href=" '.base_url('admin/Pharmacy/unverified_pharmacy_detail/').$pharmacy_id.'" class="btn btn-dark" style="margin-left:10px;">View Details</a>';
                    

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

	public function verify_pharmacy()
    {   
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];   
            $pharmacyId = my_decrypt($_POST['id']);
            $parameters = array('pharmacyId' => $pharmacyId);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/admin/approvePharmacyByAdmin",$header,$json_param);
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