<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order  extends CI_Controller {

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
	public function schedule_patient()
	{	
		if ($this->session->userdata('logged_in_pharmacy')) 
		{
			$this->load->view('backend/pharmacy/template/header');
			$this->load->view('backend/pharmacy/order/schedule_patient');
			$this->load->view('backend/pharmacy/template/footer');
		} 
		else 
		{
            redirect('pharmacy/Auth/logout', 'refresh');
        }	
	}

	public function fetch_schedule_patient()
	{	
		if ($this->session->userdata('logged_in_pharmacy')) 
        {   
            $token = $this->session->userdata('logged_in_pharmacy')['token'];	
			
			$result = methodGet("api/pharmacy/getScheduleOrders",$token);
		    
		    $result_array = json_decode($result);
		    $order = $result_array->data;
		    $status = $result_array->status;

            if (!empty($order)) 
            {
            	$data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                   	
                   	$pharmacyOrder = $row->pharmacyOrder;
                    $order_id = my_encrypt($pharmacyOrder->id);
                    $doctor = $row->doctor;
                    $patient = $row->patient;

                	$a = '<a href=" '.base_url('pharmacy/Order/view_order/').$order_id.'">
                                <h2 class="table-avatar">
                                                    <span class="user-name">'.ucwords($patient->name).'<br>'.$patient->email.'</span>
                                                </h2></a>';                      

                    if ($doctor->name == '') 
                    {
                       $dr ='';
                    }
                    else
                    {                            
                        $dr = '<span class="user-name">Dr. '.ucwords($doctor->name).' (
                                                    '.ucwords($doctor->doctorSpeciality).')</span><br>
                                                    <span class="user-name">'.$doctor->hospitalName.'</span>&nbsp;
                                                    <span>(+'.$doctor->doctorPhoneCode.')  '.$doctor->doctorPhoneNo.'</span>';                            
                    }                             

                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = '('.$patient->phoneCode.') '.$patient->phoneNo;
                    $sub_array[] = $dr;
                    $sub_array[] = ucwords($pharmacyOrder->orderStatus);
                    $sub_array[] = date('d M Y',strtotime($pharmacyOrder->orderDate));
                    $sub_array[] = '<a href=" '.base_url('pharmacy/Order/view_order/').$order_id.'" class="btn btn-dark">View Order</a>';

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
            redirect('pharmacy/Auth/logout', 'refresh');
        }	
	}

    public function view_order($order_id)
    {   
        if ($this->session->userdata('logged_in_pharmacy')) 
        {   
            $token = $this->session->userdata('logged_in_pharmacy')['token'];   
            $orderid = my_decrypt($order_id);
            $parameters = array('pharmacyOrderId' => $orderid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/pharmacy/detailOfScheduleOrders",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;


            if ($status == 200) 
            {   
                $data['details'] = $details;
                $this->load->view('backend/pharmacy/template/header');
                $this->load->view('backend/pharmacy/order/view_order',$data);
                $this->load->view('backend/pharmacy/template/footer');
            }
            else
            {
                $data['error'] = $error;
                $this->load->view('error', $data);
            }    
        } 
        else 
        {
            redirect('pharmacy/Auth/logout', 'refresh');
        }
    }

    public function change_payment_status()
    {   
        if ($this->session->userdata('logged_in_pharmacy')) 
        {   
            $token = $this->session->userdata('logged_in_pharmacy')['token'];   
            $pharmacyOrderId = my_decrypt($_POST['pharmacyOrderId']);
            $paymentAmount = $_POST['paymentAmount'];
            $paymentMode = $_POST['paymentMode'];
            $parameters = array('pharmacyOrderId' => $pharmacyOrderId,'paymentAmount' => $paymentAmount,'paymentMode' => $paymentMode);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/pharmacy/paymentStatusByPharmacy",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

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
            redirect('pharmacy/Auth/logout', 'refresh');
        }
    }

    public function payment_pending_patient()
    {   
        if ($this->session->userdata('logged_in_pharmacy')) 
        {
            $this->load->view('backend/pharmacy/template/header');
            $this->load->view('backend/pharmacy/order/payment_pending_patient');
            $this->load->view('backend/pharmacy/template/footer');
        } 
        else 
        {
            redirect('pharmacy/Auth/logout', 'refresh');
        }   
    }

    public function fetch_payment_pending_patient()
    {   
        if ($this->session->userdata('logged_in_pharmacy')) 
        {   
            $token = $this->session->userdata('logged_in_pharmacy')['token'];   
            
            $result = methodGet("api/pharmacy/getPaymentPendingOrders",$token);
            
            $result_array = json_decode($result);
            $order = $result_array->data;
            $status = $result_array->status;

            if (!empty($order)) 
            {
                $data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                    
                    $pharmacyOrder = $row->pharmacyOrder;
                    $order_id = my_encrypt($pharmacyOrder->id);
                    $doctor = $row->doctor;
                    $patient = $row->patient;

                    $a = '<a href=" '.base_url('pharmacy/Order/view_payment_pending_order/').$order_id.'">
                                <h2 class="table-avatar">
                                                    <span class="user-name">'.ucwords($patient->name).'<br>'.$patient->email.'</span>
                                                </h2></a>';                      

                    if ($doctor->name == '') 
                    {
                       $dr ='';
                    }
                    else
                    {                            
                        $dr = '<span class="user-name">Dr. '.ucwords($doctor->name).' (
                                                    '.ucwords($doctor->doctorSpeciality).')</span><br>
                                                    <span class="user-name">'.$doctor->hospitalName.'</span>&nbsp;
                                                    <span>(+'.$doctor->doctorPhoneCode.')  '.$doctor->doctorPhoneNo.'</span>';                            
                    }                             

                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = '('.$patient->phoneCode.') '.$patient->phoneNo;
                    $sub_array[] = $dr;
                    $sub_array[] = ucwords($pharmacyOrder->orderStatus);
                    $sub_array[] = date('d M Y',strtotime($pharmacyOrder->orderDate));
                    $sub_array[] = '<a href=" '.base_url('pharmacy/Order/view_payment_pending_order/').$order_id.'" class="btn btn-dark">View Order</a>';

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
            redirect('pharmacy/Auth/logout', 'refresh');
        }   
    }

    public function view_payment_pending_order($order_id)
    {   
        if ($this->session->userdata('logged_in_pharmacy')) 
        {   
            $token = $this->session->userdata('logged_in_pharmacy')['token'];   
            $orderid = my_decrypt($order_id);
            $parameters = array('pharmacyOrderId' => $orderid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/pharmacy/detailOfPaymentPendingOrders",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;


            if ($status == 200) 
            {   
                $data['details'] = $details;  
                $this->load->view('backend/pharmacy/template/header');
                $this->load->view('backend/pharmacy/order/view_payment_pending_order',$data);
                $this->load->view('backend/pharmacy/template/footer');
            }
            else
            {
                $data['error'] = $error;
                $this->load->view('error', $data);
            }    
        } 
        else 
        {
            redirect('pharmacy/Auth/logout', 'refresh');
        }    
    }

    public function change_order_status()
    {   
        if ($this->session->userdata('logged_in_pharmacy')) 
        {   
            $token = $this->session->userdata('logged_in_pharmacy')['token'];   
            $pharmacyOrderId = my_decrypt($_POST['pharmacyOrderId']);
            $parameters = array('pharmacyOrderId' => $pharmacyOrderId);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/pharmacy/orderStatusByPharmacy",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

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
            redirect('pharmacy/Auth/logout', 'refresh');
        }
    }


	public function complete_patient()
	{	
		if ($this->session->userdata('logged_in_pharmacy')) 
		{	
			$this->load->view('backend/pharmacy/template/header');
			$this->load->view('backend/pharmacy/order/complete_patient');
			$this->load->view('backend/pharmacy/template/footer');	
		} 
		else 
		{
            redirect('pharmacy/Auth/logout', 'refresh');
        }
	}

	public function fetch_complete_patient()
	{	
		if ($this->session->userdata('logged_in_pharmacy')) 
        {   
            $token = $this->session->userdata('logged_in_pharmacy')['token'];	
			
			$result = methodGet("api/pharmacy/getPastOrders",$token);
		    
		    $result_array = json_decode($result);
		    $order = $result_array->data;
		    $status = $result_array->status;

            if (!empty($order)) 
            {
            	$data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                   	
                   	$pharmacyOrder = $row->pharmacyOrder;
                    $order_id = my_encrypt($pharmacyOrder->id);
                    $doctor = $row->doctor;
                    $patient = $row->patient;

                	$a = '<a href=" '.base_url('pharmacy/Order/view_complete_order/').$order_id.'">
                                <h2 class="table-avatar">
                                                    <span class="user-name">'.ucwords($patient->name).'<br>'.$patient->email.'</span>
                                                </h2></a>';                           

                    if ($doctor->name == '') 
                    {
                       $dr ='';
                    }
                    else
                    {                            
                        $dr = '<span class="user-name">Dr. '.ucwords($doctor->name).' (
                                                    '.ucwords($doctor->doctorSpeciality).')</span><br>
                                                    <span class="user-name">'.$doctor->hospitalName.'</span>&nbsp;
                                                    <span>(+'.$doctor->doctorPhoneCode.')  '.$doctor->doctorPhoneNo.'</span>';                            
                    }                             

                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = '('.$patient->phoneCode.') '.$patient->phoneNo;
                    $sub_array[] = $dr;
                    $sub_array[] = ucwords($pharmacyOrder->orderStatus);
                    $sub_array[] = date('d M Y',strtotime($pharmacyOrder->orderDate));
                    $sub_array[] = '<a href=" '.base_url('pharmacy/Order/view_complete_order/').$order_id.'" class="btn btn-dark">View Order</a>';
                    

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
            redirect('pharmacy/Auth/logout', 'refresh');
        }	
	}

    public function view_complete_order($order_id)
    {   
        if ($this->session->userdata('logged_in_pharmacy')) 
        {   
            $token = $this->session->userdata('logged_in_pharmacy')['token'];   
            $orderid = my_decrypt($order_id);
            $parameters = array('pharmacyOrderId' => $orderid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/pharmacy/detailOfPastOrders",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;


            if ($status == 200) 
            {   
                $data['details'] = $details;  
                $this->load->view('backend/pharmacy/template/header');
                $this->load->view('backend/pharmacy/order/view_complete_order',$data);
                $this->load->view('backend/pharmacy/template/footer');
            }
            else
            {
                $data['error'] = $error;
                $this->load->view('error', $data);
            }    
        } 
        else 
        {
            redirect('pharmacy/Auth/logout', 'refresh');
        }    
    }


	
}