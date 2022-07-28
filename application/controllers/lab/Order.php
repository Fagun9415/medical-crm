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
		if ($this->session->userdata('logged_in_lab')) 
		{
			$this->load->view('backend/lab/template/header');
			$this->load->view('backend/lab/order/schedule_patient');
			$this->load->view('backend/lab/template/footer');
		} 
		else 
		{
            redirect('lab/Auth/logout', 'refresh');
        }	
	}

	public function fetch_schedule_patient()
	{	
		if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];	
			
			$result = methodGet("api/lab/getScheduleOrders",$token);
		    
		    $result_array = json_decode($result);
		    $order = $result_array->data;
		    $status = $result_array->status;

            if (!empty($order)) 
            {
            	$data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                   	
                   	$labOrder = $row->labOrder;
                    $order_id = my_encrypt($labOrder->id);
                    $doctor = $row->doctor;
                    $patient = $row->patient;

                	$a = '<a href=" '.base_url('lab/Order/view_order/').$order_id.'">
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
                    $sub_array[] = ucwords($labOrder->orderStatus);
                    $sub_array[] = date('d M Y',strtotime($labOrder->orderDate));
                    $sub_array[] = '<a href=" '.base_url('lab/Order/view_order/').$order_id.'" class="btn btn-dark">View Order</a>';
                    

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
            redirect('lab/Auth/logout', 'refresh');
        }	
	}

    public function view_order($order_id)
    {   
        if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];   
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
            redirect('lab/Auth/logout', 'refresh');
        }    
    }

    public function change_payment_status()
    {   
        if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];   
            $labOrderId = my_decrypt($_POST['labOrderId']);
            $paymentAmount = $_POST['paymentAmount'];
            $paymentMode = $_POST['paymentMode'];
            $parameters = array('labOrderId' => $labOrderId,'paymentAmount'=>$paymentAmount,'paymentMode'=>$paymentMode);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/lab/paymentStatusByLab",$header,$json_param);
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
            redirect('lab/Auth/logout', 'refresh');
        }
    }

    public function payment_pending_patient()
    {   
        if ($this->session->userdata('logged_in_lab')) 
        {
            $this->load->view('backend/lab/template/header');
            $this->load->view('backend/lab/order/payment_pending_patient');
            $this->load->view('backend/lab/template/footer');
        } 
        else 
        {
            redirect('lab/Auth/logout', 'refresh');
        }   
    }

    public function fetch_payment_pending_patient()
    {   
        if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];    
            
            $result = methodGet("api/lab/getPaymentPendingOrders",$token);
            
            $result_array = json_decode($result);
            $order = $result_array->data;
            $status = $result_array->status;

            if (!empty($order)) 
            {
                $data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                    
                    $labOrder = $row->labOrder;
                    $order_id = my_encrypt($labOrder->id);
                    $doctor = $row->doctor;
                    $patient = $row->patient;

                    $a = '<a href=" '.base_url('lab/Order/view_payment_pending_patient_order/').$order_id.'">
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
                    $sub_array[] = ucwords($labOrder->orderStatus);
                    $sub_array[] = date('d M Y',strtotime($labOrder->orderDate));
                    $sub_array[] = '<a href=" '.base_url('lab/Order/view_payment_pending_patient_order/').$order_id.'" class="btn btn-dark">View Order</a>';
                    

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
            redirect('lab/Auth/logout', 'refresh');
        }   
    }

    public function view_payment_pending_patient_order($order_id)
    {   
        if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];   
            $orderid = my_decrypt($order_id); 
            $parameters = array('labOrderId' => $orderid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/lab/detailOfPaymentPendingOrders",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;


            if ($status == 200) 
            {   
                $data['details'] = $details; 
                $this->load->view('backend/lab/template/header');
                $this->load->view('backend/lab/order/view_payment_pending_patient_order',$data);
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
            redirect('lab/Auth/logout', 'refresh');
        }    
    }


    public function change_order_status()
    {   
        if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];   
            $labOrderId = my_decrypt($_POST['labOrderId']);
            $parameters = array('labOrderId' => $labOrderId);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/lab/orderStatusByLab",$header,$json_param);
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
            redirect('lab/Auth/logout', 'refresh');
        }
    }

	public function pending_patient()
	{	
		if ($this->session->userdata('logged_in_lab')) 
		{	
			$this->load->view('backend/lab/template/header');
			$this->load->view('backend/lab/order/pending_patient');
			$this->load->view('backend/lab/template/footer');	
		} 
		else 
		{
            redirect('lab/Auth/logout', 'refresh');
        }
	}

	public function fetch_pending_patient()
	{	
		if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];	
			
			$result = methodGet("api/lab/getProcessedOrders",$token);
		    
		    $result_array = json_decode($result);
		    $order = $result_array->data;
		    $status = $result_array->status;

            if (!empty($order)) 
            {
            	$data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                   	
                   	$labOrder = $row->labOrder;
                    $order_id = my_encrypt($labOrder->id);
                    $doctor = $row->doctor;
                    $patient = $row->patient;

                	$a = '<a href=" '.base_url('lab/Order/view_pending_order/').$order_id.'">
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
                    $sub_array[] = ucwords($labOrder->orderStatus);
                    $sub_array[] = date('d M Y',strtotime($labOrder->orderDate));
                    $sub_array[] = '<a href=" '.base_url('lab/Order/view_pending_order/').$order_id.'" class="btn btn-dark">View Order</a>';
                    

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
            redirect('lab/Auth/logout', 'refresh');
        }	
	}

    public function view_pending_order($order_id)
    {   
        if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];   
            $orderid = my_decrypt($order_id);
            $parameters = array('labOrderId' => $orderid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/lab/detailOfProcessedOrders",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['details'] = $details; 
                $this->load->view('backend/lab/template/header');
                $this->load->view('backend/lab/order/view_pending_order',$data);
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
            redirect('lab/Auth/logout', 'refresh');
        }    
    }

	public function complete_patient()
	{	
		if ($this->session->userdata('logged_in_lab')) 
		{	
			$this->load->view('backend/lab/template/header');
			$this->load->view('backend/lab/order/complete_patient');
			$this->load->view('backend/lab/template/footer');	
		} 
		else 
		{
            redirect('lab/Auth/logout', 'refresh');
        }
	}

	public function fetch_complete_patient()
	{	
		if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];	
			
			$result = methodGet("api/lab/getPastOrders",$token);
		    
		    $result_array = json_decode($result);
		    $order = $result_array->data;
		    $status = $result_array->status;

            if (!empty($order)) 
            {
            	$data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                   	
                   	$labOrder = $row->labOrder;
                    $order_id = my_encrypt($labOrder->id);
                    $doctor = $row->doctor;
                    $patient = $row->patient;

                	$a = '<a href=" '.base_url('lab/Order/view_complete_order/').$order_id.'">
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
                    $sub_array[] = ucwords($labOrder->orderStatus);
                    $sub_array[] = date('d M Y',strtotime($labOrder->orderDate));
                    $sub_array[] = '<a href=" '.base_url('lab/Order/view_complete_order/').$order_id.'" class="btn btn-dark">View Order</a>';

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
            redirect('lab/Auth/logout', 'refresh');
        }	
	}

    public function view_complete_order($order_id)
    {   
        if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];   
            $orderid = my_decrypt($order_id);
            $parameters = array('labOrderId' => $orderid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/lab/detailOfPastOrders",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['details'] = $details; 
                $this->load->view('backend/lab/template/header');
                $this->load->view('backend/lab/order/view_complete_order',$data);
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
            redirect('lab/Auth/logout', 'refresh');
        }    
    }

    public function upload_report()
    {   
        if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];   
            $labOrderDetailId = my_decrypt($_POST['lab_order_id']);
            $file = new CURLFile($_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']);

            $parameters = array('labOrderDetailId' => $labOrderDetailId,'file' => $file);
            $json_param = $parameters;
            $header = ["authorization: Bearer " . $token];
            $result = methodPost("api/lab/labReportUpload",$header,$json_param);
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
            redirect('lab/Auth/logout', 'refresh');
        }
    }


	
}