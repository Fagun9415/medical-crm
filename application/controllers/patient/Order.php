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
	public function lab_order_alert()
	{	
		if ($this->session->userdata('logged_in_patient')) 
		{	
			$token = $this->session->userdata('logged_in_patient')['token'];	
			$patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

			$parameters = array('patientId' => $patient_id);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/getPatientProfileById",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $user = $result_array->data;
		    $status = $result_array->status;


		    if ($status == 200) 
		    {	
		    	$data['user'] = $user;	
				$this->load->view('backend/patient/template/header');
				$this->load->view('backend/patient/order/active_lab_order',$data);
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

	public function fetch_lab_order_alert()
	{	
		if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];	
			$patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

			$parameters = array('patientId' => $patient_id);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/getPrescribeLabOrdersList",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $order = $result_array->data;
		    $status = $result_array->status;

            if (!empty($order)) 
            {
            	$data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                   	
                   	$encounter = $row->encounter;
                    $encounter_id = my_encrypt($encounter->id);
                    $doctor = $row->doctor;
                    $labTests = $row->labTests;

                    if ($encounter->paymentPending==false) 
                    {
                    	$pstatus = 'Paid';

                        if ($labTests[0]->labStatus == "prescribe") 
                        {
                           $a = '<a href=" '.base_url('patient/Order/add_lab_order/').$encounter_id.'">
                                    <span class="user-name">Dr. '.ucwords($doctor->name).'</span><br>
                                    <span>'.$doctor->hospitalName.' Hospital</span></a>';

                            $action = '<a href=" '.base_url('patient/Order/add_lab_order/').$encounter_id.'" class="btn btn-primary">Order Now</a>';        
                        }
                        else
                        {    
                            $a = '<a href=" '.base_url('patient/Order/active_lab_order_detail/').$encounter_id.'">
                                    <span class="user-name">Dr. '.ucwords($doctor->name).'</span><br>
                                    <span>'.$doctor->hospitalName.' Hospital</span></a>';
                            $action = '<a href=" '.base_url('patient/Order/active_lab_order_detail/').$encounter_id.'" class="btn btn-dark">View Order</a>';        
                        }   

                    }
                    else
                    {
                    	$pstatus = 'Pending &nbsp;&nbsp; <button type="button" class="btn btn-primary">Pay Now</button>';
                    	$a = '<a href="javascript:void(0)">
                                    <span class="user-name">Dr. '.ucwords($doctor->name).'</span><br>
                                    <span>'.$doctor->hospitalName.' Hospital</span></a>';
                        $action = '';            
                    }


                    if ($labTests[0]->labStatus == "prescribe") 
                    {
                        $rstatus = '<button type="button" class="btn btn-primary btn-sm">Prescribed</button>';
                    }
                    elseif ($labTests[0]->labStatus == "pending") 
                    {
                        $rstatus = '<button type="button" class="btn btn-secondary btn-sm">Pending</button>';
                    }
                    elseif ($labTests[0]->labStatus == "processing") 
                    {
                        $rstatus = '<button type="button" class="btn btn-success btn-sm">Processing</button>';
                    }
                    else
                    {
                        $rstatus = '';
                    }

                    if (($row->paymentStatusOfOrder == "pending") && ($labTests[0]->labStatus == "processing"))  
                    {
                        $payment_status = '<button type="button" class="btn btn-info btn-sm">Pay Now</button>';
                    }
                    else
                    {
                        $payment_status = '';    
                    }    


                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = $row->totalReports; 
                    $sub_array[] = '(+'.$doctor->doctorPhoneCode.') '.$doctor->doctorPhoneNo;
                    $sub_array[] = date('d M Y',strtotime($encounter->encounterDate));
                    $sub_array[] = $rstatus.$payment_status;
                    $sub_array[] = $pstatus;
                    $sub_array[] = $action;

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
            redirect('patient/Auth/logout', 'refresh');
        }	
	}

    public function onprocess_lab_order_alert()
	{	
		if ($this->session->userdata('logged_in_patient')) 
		{	
			$token = $this->session->userdata('logged_in_patient')['token'];	
			$patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

			$parameters = array('patientId' => $patient_id);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/getPatientProfileById",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $user = $result_array->data;
		    $status = $result_array->status;


		    if ($status == 200) 
		    {	
		    	$data['user'] = $user;	
				$this->load->view('backend/patient/template/header');
				$this->load->view('backend/patient/order/onprocess_lab_order_alert',$data);
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

    public function onprocess_fetch_lab_order_alert()
	{	
		if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];	
			$patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

			$parameters = array('patientId' => $patient_id);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/getLabOrdersList",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $order = $result_array->data;
		    $status = $result_array->status;

            if (!empty($order)) 
            {
            	$data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                   	
                   

                    $labOrder = $row->labOrder;
                    $labOrder_id = my_encrypt($labOrder->id);
                    $lab = $row->lab;
                    $encounter = $row->encounter;
                    $doctor = $row->doctor;
                    $labTests = $row->labTests;

                    $dinfo = '<a href=" '.base_url('patient/Order/onprocess_lab_order_detail/').$labOrder_id.'">
                    <span class="user-name">Dr. '.ucwords($doctor->name).'</span><br>
                    <span>'.$doctor->hospitalName.' Hospital</span><br><span>('.$doctor->doctorPhoneCode.') '.$doctor->doctorPhoneNo.' </span></a>';
   

                    $linfo = '<a href=" '.base_url('patient/Order/onprocess_lab_order_detail/').$labOrder_id.'">
                    <span class="user-name">'.ucwords($lab->name).'</span><br>
                    <span>('.$lab->labPhoneCode1.') '.$lab->labPhoneNo1.' </span></a>';

                    $action = '<a href=" '.base_url('patient/Order/onprocess_lab_order_detail/').$labOrder_id.'" class="btn btn-dark">View</a>';         

                    

                    if ($labOrder->paymentStatus== 'pending' ) 
                    {
                    	$pstatus = 'Pending';
                        
                    }
                    elseif ($labOrder->paymentStatus== 'processing' )
                    {
                    	$pstatus = 'Processing &nbsp;&nbsp; <button type="button" class="btn btn-primary">Pay Now</button>';           
                    }else
                    {
                        $pstatus = 'Completed';
                    }

                    
                    if ($labOrder->orderStatus == "pending") 
                    {
                        $rstatus = '<button type="button" class="btn btn-secondary btn-sm">Pending</button>';
                        $action .= '&nbsp;&nbsp; <a href=" '.base_url('patient/Order/cancel_lab_order/').$labOrder_id.'" class="btn btn-dark">Cancel</a>';
                    }
                    elseif ($labOrder->orderStatus == "processing") 
                    {
                        $rstatus = '<button type="button" class="btn btn-success btn-sm">Processing</button>';
                    }
                    else
                    {
                        $rstatus = '';
                    }


                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $dinfo;
                    $sub_array[] = $row->totalReports; 
                    $sub_array[] = $linfo ;
                    $sub_array[] = date('d M Y',strtotime($labOrder->orderDate));
                    $sub_array[] = $rstatus.$payment_status;
                    $sub_array[] = $pstatus;
                    $sub_array[] = $action;

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
            redirect('patient/Auth/logout', 'refresh');
        }	
	}

    public function cancel_lab_order($labOrder_id)
	{	
		if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];	
            $laborderid = my_decrypt($labOrder_id);
			
			$parameters = array('labOrderId' => $laborderid);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/cancelLabOrder",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $order = $result_array->data;
		    $status = $result_array->status;

            if ($status == 200) 
		    {	
		    	redirect('patient/Order/onprocess_lab_order_alert', 'refresh');
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

    public function onprocess_lab_order_detail($labOrder_id)
    {  
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];    
            $labOrderid = my_decrypt($labOrder_id);
            $parameters = array('labOrderId' => $labOrderid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/detailActiveLabOrderAlert",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['encounter_id'] = $encounter_id;
                $data['details'] = $details;
                $this->load->view('backend/patient/template/header');
                $this->load->view('backend/patient/order/onprocess_lab_order_detail',$data);
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

	public function pharmacy_order_alert()
	{
		if ($this->session->userdata('logged_in_patient')) 
		{	
			$token = $this->session->userdata('logged_in_patient')['token'];	
			$patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

			$parameters = array('patientId' => $patient_id);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/getPatientProfileById",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $user = $result_array->data;
		    $status = $result_array->status;


		    if ($status == 200) 
		    {	
			    $data['user'] = $user;	
				$this->load->view('backend/patient/template/header');
				$this->load->view('backend/patient/order/active_pharmacy_order',$data);
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

	public function fetch_pharmacy_order_alert()
	{	
		if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];	
			$patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

			$parameters = array('patientId' => $patient_id);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/getPrescribePharmacyOrdersList",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $order = $result_array->data;
		    $status = $result_array->status;

            if (!empty($order)) 
            {
            	$data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                   	
                   	$encounter = $row->encounter;
                    $encounter_id = my_encrypt($encounter->id);
                    $doctor = $row->doctor;

                    $medicines  = $row->medicines; 

                    if ($encounter->paymentPending==false) 
                    {
                    	$pstatus = 'Paid';
                    	   $a = '<a href=" '.base_url('patient/Order/add_pharmacy_order/').$encounter_id.'">
                                    <span class="user-name">Dr. '.ucwords($doctor->name).'</span><br>
                                    <span>'.$doctor->hospitalName.' Hospital</span></a>';

                            $action = '<a href=" '.base_url('patient/Order/add_pharmacy_order/').$encounter_id.'" class="btn btn-primary">Order Now</a>';        
                        
                    }
                    else
                    {
                    	$pstatus = 'Pending &nbsp;&nbsp; <button type="button" class="btn btn-primary">Pay Now</button>';
                    	$a = '<a href="javascript:void(0)">
                                    <span class="user-name">Dr. '.ucwords($doctor->name).'</span><br>
                                    <span>'.$doctor->hospitalName.' Hospital</span></a>';
                        $action = '';            
                    }


                    if ($medicines[0]->medicineOrderStatus == "prescribe") 
                    {
                        $ostatus = '<button type="button" class="btn btn-primary btn-sm">Prescribed</button>';
                    }
                    elseif ($medicines[0]->medicineOrderStatus == "pending") 
                    {
                       $ostatus = '<button type="button" class="btn btn-secondary btn-sm">Pending</button>';
                    }
                    elseif ($medicines[0]->medicineOrderStatus == "processing") 
                    {
                       $ostatus = '<button type="button" class="btn btn-success btn-sm">Processing</button>';
                    }
                    else
                    {
                        $ostatus = '';
                    }
                    


                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = $row->totalMedicines; 
                    $sub_array[] = '(+'.$doctor->doctorPhoneCode.') '.$doctor->doctorPhoneNo;
                    $sub_array[] = date('d M Y',strtotime($encounter->encounterDate));
                    $sub_array[] = $ostatus.$payment_status;
                    $sub_array[] = $pstatus;
                    $sub_array[] = $action;
                    

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
            redirect('patient/Auth/logout', 'refresh');
        }	
	}

	public function onprocess_pharmacy_order_alert()
	{
		if ($this->session->userdata('logged_in_patient')) 
		{	
			$token = $this->session->userdata('logged_in_patient')['token'];	
			$patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

			$parameters = array('patientId' => $patient_id);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/getPatientProfileById",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $user = $result_array->data;
		    $status = $result_array->status;


		    if ($status == 200) 
		    {	
			    $data['user'] = $user;	
				$this->load->view('backend/patient/template/header');
				$this->load->view('backend/patient/order/onprocess_pharmacy_order_alert',$data);
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

    public function fetch_onprocess_pharmacy_order_alert()
	{	
		if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];	
			$patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

			$parameters = array('patientId' => $patient_id);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/getPharmacyOrdersList",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $order = $result_array->data;
		    $status = $result_array->status;
            
            
            if (!empty($order)) 
            {
            	$data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                   	
                   	
                    $pharmacyorder = $row->pharmacyorder;
                    $pharmacyorder_id = my_encrypt($pharmacyorder->id);

                    $encounter = $row->encounter;
                    $doctor = $row->doctor;
                    $medicines  = $row->medicines; 
                    $pharmacy  = $row->pharmacy; 

                    $dinfo = '<a href=" '.base_url('patient/Order/onprocess_pharmacy_order_detail/').$pharmacyorder_id.'">
                                    <span class="user-name">Dr. '.ucwords($doctor->name).'</span><br>
                                    <span>'.$doctor->hospitalName.' Hospital</span><br><span>('.$doctor->doctorPhoneCode.') '.$doctor->doctorPhoneNo.' </span></a>';
                   

                    $pinfo = '<a href=" '.base_url('patient/Order/onprocess_pharmacy_order_detail/').$pharmacyorder_id.'">
                                    <span class="user-name">'.ucwords($pharmacy->name).'</span><br>
                                    <span>('.$pharmacy->pharmacyPhoneCode1.') '.$pharmacy->pharmacyPhoneNo1.' </span></a>';
                                    
                    $action = '<a href=" '.base_url('patient/Order/onprocess_pharmacy_order_detail/').$pharmacyorder_id.'" class="btn btn-dark">View</a>'; 
                                    
                    if ($pharmacyorder->paymentStatus=='pending') 
                    {
                    	$pstatus = 'Pending';
                    }
                    elseif($pharmacyorder->paymentStatus=='processing'){
                        $pstatus = 'Processing &nbsp;&nbsp; <button type="button" class="btn btn-primary">Pay Now</button>';
                    }
                    else
                    {
                        $pstatus = 'Completed';
                    }


                    if ($pharmacyorder->orderStatus == "pending") 
                    {
                       $ostatus = '<button type="button" class="btn btn-secondary btn-sm">Pending</button>';
                       $action .= '&nbsp;&nbsp; <a href=" '.base_url('patient/Order/cancel_pharmacy_order/').$pharmacyorder_id.'" class="btn btn-dark">Cancel</a>';

                    }
                    elseif ($pharmacyorder->orderStatus  == "processing") 
                    {
                       $ostatus = '<button type="button" class="btn btn-success btn-sm">Processing</button>';
                    }
                    else
                    {
                        $ostatus = '';
                    }


                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $dinfo;
                    $sub_array[] = $row->totalMedicines; 
                    $sub_array[] = $pinfo;
                    $sub_array[] = date('d M Y',strtotime($encounter->encounterDate));
                    $sub_array[] = $ostatus.$payment_status;
                    $sub_array[] = $pstatus;
                    $sub_array[] = $action;
                    

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
            redirect('patient/Auth/logout', 'refresh');
        }	
	}

    public function cancel_pharmacy_order($pharmacyorder_id)
	{	
		if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];	
            $pharmacyorderid = my_decrypt($pharmacyorder_id);
			
			$parameters = array('pharmacyOrderId' => $pharmacyorderid);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/cancelPharmacyOrder",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $order = $result_array->data;
		    $status = $result_array->status;

            if ($status == 200) 
		    {	
		    	redirect('patient/Order/onprocess_pharmacy_order_alert', 'refresh');
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

    public function onprocess_pharmacy_order_detail($pharmacyorder_id)
    {  
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];    
            $pharmacyorderid = my_decrypt($pharmacyorder_id);
            $parameters = array('pharmacyOrderId' => $pharmacyorderid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/detailActivePharmacyOrderAlert",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
           // print_r($details);exit;
            $status = $result_array->status;
            

            if ($status == 200) 
            {   
                $data['encounter_id'] = $encounter_id;
                $data['details'] = $details;  

                /*print_r($data['details']); exit();*/
                $this->load->view('backend/patient/template/header');
                $this->load->view('backend/patient/order/onprocess_pharmacy_order_detail',$data);
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

	public function active_doctor_order()
	{	
		if ($this->session->userdata('logged_in_patient')) 
		{	
			$token = $this->session->userdata('logged_in_patient')['token'];
			$patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

			$parameters = array('patientId' => $patient_id);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/getPatientProfileById",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $user = $result_array->data;
		    $status = $result_array->status;


		    if ($status == 200) 
		    {	
		    	$data['user'] = $user;
				$this->load->view('backend/patient/template/header');
				$this->load->view('backend/patient/order/active_doctor_order',$data);
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

	public function fetch_active_doctor_order()
	{	
		if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];	
			$patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

			$parameters = array('patientId' => $patient_id);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/getActiveDoctorOrdersForFamilyPatient",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $order = $result_array->data;
		    $status = $result_array->status;

            if (!empty($order)) 
            {
            	$data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                   
                    $encounter_id = my_encrypt($row->id);
                    $doctor = $row->doctor;

                    if ($row->paymentPending==false) 
                    {
                    	$pstatus = 'Paid';
                    	$a = '<a href=" '.base_url('patient/Order/doctor_encounter_detail/').$encounter_id.'">
                                    <span class="user-name">Dr. '.ucwords($doctor->name).'</span><br>
                                    <span>'.$doctor->hospitalName.' Hospital</span></a>';
                        $action = '<a href=" '.base_url('patient/Order/doctor_encounter_detail/').$encounter_id.'" class="btn btn-dark">View Order</a>';            

                    }
                    else
                    {
                    	$pstatus = 'Pending &nbsp;&nbsp; <button type="button" class="btn btn-primary">Pay Now</button>';
                    	$a = '<a href="javascript:void(0)">
                                    <span class="user-name">Dr. '.ucwords($doctor->name).'</span><br>
                                    <span>'.$doctor->hospitalName.' Hospital</span></a>';
                        $action = '';            
                    }	

                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = ucwords($doctor->doctorSpeciality);
                    $sub_array[] = ucwords(substr($row->chiefComplaint, 0, 20));
                    $sub_array[] = '(+'.$doctor->doctorPhoneCode.') '.$doctor->doctorPhoneNo;
                    $sub_array[] = $pstatus;
                    $sub_array[] = date('d M Y',strtotime($row->encounterDate));
                    $sub_array[] = $action;
                    

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
            redirect('patient/Auth/logout', 'refresh');
        }	
	}

    public function doctor_encounter_detail($encounter_id)
    {   
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];
            
            $encounter_id = my_decrypt($encounter_id);
            $patient_id = $this->session->userdata('logged_in_patient')['patient_id'];
            $parameters = array('encounterId' => $encounter_id,"familyPatientId"=>$patient_id);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/getEncounterWithFullDetailForPatient",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['details'] = $details;
                $this->load->view('backend/patient/template/header');
                $this->load->view('backend/patient/order/doctor_encounter_detail',$data);
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

	public function past_doctor_order()
	{	
		if ($this->session->userdata('logged_in_patient')) 
		{	
			$token = $this->session->userdata('logged_in_patient')['token'];
			$patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

			$parameters = array('patientId' => $patient_id);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/getPatientProfileById",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $user = $result_array->data;
		    $status = $result_array->status;


		    if ($status == 200) 
		    {	
		    	$data['user'] = $user;	
				$this->load->view('backend/patient/template/header');
				$this->load->view('backend/patient/order/past_doctor_order',$data);
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

	public function fetch_past_doctor_order()
	{	
		if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];	
			$patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

			$parameters = array('patientId' => $patient_id);
		    $json_param = json_encode($parameters);
		    $header = ["authorization: Bearer " . $token, "content-type: application/json"];
		    $result = methodPost("api/patient/getPastDoctorOrdersForFamilyPatient",$header,$json_param);
		    
		    $result_array = json_decode($result);
		    $order = $result_array->data;
		    $status = $result_array->status;

            if (!empty($order)) 
            {
            	$data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                   
                    $encounter_id = my_encrypt($row->id);
                    $doctor = $row->doctor;

                    if ($row->paymentPending==false) 
                    {
                    	$pstatus = 'Paid';
                    	$a = '<a href=" '.base_url('patient/Order/past_doctor_encounter_detail/').$encounter_id.'">
                                    <span class="user-name">Dr. '.ucwords($doctor->name).'</span><br>
                                    <span>'.$doctor->hospitalName.' Hospital</span></a>';
                        $action = '<a href=" '.base_url('patient/Order/doctor_encounter_detail/').$encounter_id.'" class="btn btn-dark">View Order</a>';            
                    }
                    else
                    {
                    	$pstatus = 'Pending &nbsp;&nbsp; <button type="button" class="btn btn-primary">Pay Now</button>';
                    	$a = '<a href="javascript:void(0)">
                                    <span class="user-name">Dr. '.ucwords($doctor->name).'</span><br>
                                    <span>'.$doctor->hospitalName.' Hospital</span></a>';
                        $action = '';            
                    }	

                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $a;
                    $sub_array[] = ucwords($doctor->doctorSpeciality);
                    $sub_array[] = ucwords(substr($row->chiefComplaint, 0, 20));
                    $sub_array[] = '(+'.$doctor->doctorPhoneCode.') '.$doctor->doctorPhoneNo;
                    $sub_array[] = $pstatus;
                    $sub_array[] = date('d M Y',strtotime($row->encounterDate));
                    $sub_array[] = '<a href=" '.base_url('patient/Order/past_doctor_encounter_detail/').$encounter_id.'" class="btn btn-dark">View Order</a>';

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
            redirect('patient/Auth/logout', 'refresh');
        }	
	}

    public function past_doctor_encounter_detail($encounter_id)
    {   
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];
            
            $encounter_id = my_decrypt($encounter_id);
            $patient_id = $this->session->userdata('logged_in_patient')['patient_id'];
            $parameters = array('encounterId' => $encounter_id,"familyPatientId"=>$patient_id);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/getEncounterWithFullDetailForPatient",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['details'] = $details;
                $this->load->view('backend/patient/template/header');
                $this->load->view('backend/patient/order/past_doctor_encounter_detail',$data);
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

	public function past_pharmacy_order()
	{  
    	if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];
            $patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

            $parameters = array('patientId' => $patient_id);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/getPatientProfileById",$header,$json_param);
            
            $result_array = json_decode($result);
            $user = $result_array->data;
            $status = $result_array->status;


            if ($status == 200) 
            {   
                $data['user'] = $user;
        		$this->load->view('backend/patient/template/header');
        		$this->load->view('backend/patient/order/past_pharmacy_order',$data);
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

    public function fetch_past_pharmacy_order()
    {   
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];    
            $patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

            $parameters = array('patientId' => $patient_id);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/getPastPharmacyOrdersList",$header,$json_param);
            
            $result_array = json_decode($result);
            $order = $result_array->data;
            $status = $result_array->status;

            if (!empty($order)) 
            {
                $data = [];

                $i = 1;
                foreach ($order as $key => $row) {

                    $pharmacyorder = $row->pharmacyorder;
                    $pharmacyorder_id = my_encrypt($pharmacyorder->id);

                    $encounter = $row->encounter;
                    $doctor = $row->doctor;
                    $medicines  = $row->medicines; 
                    $pharmacy  = $row->pharmacy; 

                    
                        $pstatus = ucwords($pharmacyorder->orderStatus);

                        $dinfo = '<a href=" '.base_url('patient/Order/pharmacy_order_detail/').$pharmacyorder_id.'">
                        <span class="user-name">Dr. '.ucwords($doctor->name).'</span><br>
                        <span>'.$doctor->hospitalName.' Hospital</span><br><span>('.$doctor->doctorPhoneCode.') '.$doctor->doctorPhoneNo.' </span></a>';
       

                        $pinfo = '<a href=" '.base_url('patient/Order/pharmacy_order_detail/').$pharmacyorder_id.'">
                        <span class="user-name">'.ucwords($pharmacy->name).'</span><br>
                        <span>('.$pharmacy->pharmacyPhoneCode1.') '.$pharmacy->pharmacyPhoneNo1.' </span></a>';
                        
                        $action = '<a href=" '.base_url('patient/Order/pharmacy_order_detail/').$pharmacyorder_id.'" class="btn btn-dark">View</a>'; 

                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $dinfo;
                    $sub_array[] = $row->totalMedicines; 
                    $sub_array[] = $pinfo;
                    $sub_array[] = date('d M Y',strtotime($pharmacyorder->orderDate));
                    $sub_array[] = $pstatus;
                    $sub_array[] = $action;

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
            redirect('patient/Auth/logout', 'refresh');
        }   
    }

	public function past_lab_order()
	{  
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];
            $patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

            $parameters = array('patientId' => $patient_id);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/getPatientProfileById",$header,$json_param);
            
            $result_array = json_decode($result);
            $user = $result_array->data;
            $status = $result_array->status;


            if ($status == 200) 
            {   
                $data['user'] = $user;	
        		$this->load->view('backend/patient/template/header');
        		$this->load->view('backend/patient/order/past_lab_order',$data);
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

    public function fetch_past_lab_order()
    {   
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];    
            $patient_id = $this->session->userdata('logged_in_patient')['patient_id'];

            $parameters = array('patientId' => $patient_id);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/getPastLabOrdersList",$header,$json_param);
            
            $result_array = json_decode($result);
            $order = $result_array->data;
            $status = $result_array->status;

            if (!empty($order)) 
            {
                $data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                    
                    $labOrder = $row->labOrder;
                    $labOrder_id = my_encrypt($labOrder->id);
                    $lab = $row->lab;
                    $encounter = $row->encounter;
                    $doctor = $row->doctor;
                    $labTests = $row->labTests;

                    $dinfo = '<a href=" '.base_url('patient/Order/lab_order_detail/').$labOrder_id.'">
                    <span class="user-name">Dr. '.ucwords($doctor->name).'</span><br>
                    <span>'.$doctor->hospitalName.' Hospital</span><br><span>('.$doctor->doctorPhoneCode.') '.$doctor->doctorPhoneNo.' </span></a>';
   

                    $linfo = '<a href=" '.base_url('patient/Order/lab_order_detail/').$labOrder_id.'">
                    <span class="user-name">'.ucwords($lab->name).'</span><br>
                    <span>('.$lab->labPhoneCode1.') '.$lab->labPhoneNo1.' </span></a>';

                    $pstatus = ucwords($labOrder->orderStatus);
                    
                    $action = '<a href=" '.base_url('patient/Order/lab_order_detail/').$labOrder_id.'" class="btn btn-dark">View</a>'; 

                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $dinfo;
                    $sub_array[] = $row->totalReports; 
                    $sub_array[] = $linfo;
                    $sub_array[] = date('d M Y',strtotime($labOrder->orderDate));
                    $sub_array[] = $pstatus;
                    $sub_array[] = $action;

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
            redirect('patient/Auth/logout', 'refresh');
        }   
    }

	public function add_lab_order($encounter_id)
	{  
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];	
            $encounterid = my_decrypt($encounter_id);
            $parameters = array('encounterId' => $encounterid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/detailPrescribeLabOrderAlert",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['encounter_id'] = $encounter_id;
                $data['details'] = $details->labTests;
        		$this->load->view('backend/patient/template/header');
        		$this->load->view('backend/patient/order/add_lab_order',$data);
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

    public function fetch_nearby_labs()
    {  
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];    
            $pincode = $_POST['pincode'];
            $parameters = array('pincode' => $pincode);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/findNearByLabs",$header,$json_param);
            $result_array = json_decode($result);
            $labs = $result_array->data;
            $status = $result_array->status;
                
            if ($status == 200) 
            {
                $datas['labs'] = $labs;
                $output = $this->load->view('backend/patient/ajax/ajax_lab_address_list',$datas,true);
            }
            else
            {
                $output = 'no';
            }
            $data['address_list'] = $output;
            echo json_encode($data);  
        } 
        else 
        {
            redirect('patient/Auth/logout', 'refresh');
        }    
    }

    function add_save_lab_order()
    {
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];
            $patient_id = $this->session->userdata('logged_in_patient')['patient_id'];
            $encounterId = my_decrypt($_POST['encounterId']);
            $labId = $_POST['labId'];
            $labOrderMode = $_POST['labOrderMode'];
            $orderAddressLine1 = $_POST['orderAddressLine1'];
            $orderAddressLine2 = $_POST['orderAddressLine2'];
            $landmark = $_POST['landmark'];
            $pincode = $_POST['pincode'];
            $orderDate = $_POST['orderDate'];
            $encounterLabId = $_POST['encounterLabId'];
            
            for ($i=0; $i < count($encounterLabId); $i++) { 
                  
                $explode = explode('_',$encounterLabId[$i]);

                $labTest[] = array(
                    'encounterLabId' => $explode[0], 
                    'labTestName' => $explode[1],
                    
                ); 
            }
            
            $data_value = array(
            'patientId' => $patient_id,    
            'encounterId' => $encounterId,
            'labId' => $labId,
            'labOrderMode' => $labOrderMode,
            'orderAddressLine1' => $orderAddressLine1,
            'orderAddressLine2' => $orderAddressLine2,
            'landmark' => $landmark,
            'pincode' => $pincode,
            'orderDate' => $orderDate,
            'labTest' => $labTest
            );

            

            $formdata = json_encode($data_value);
            
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result1 = methodPost('api/patient/orderLabOrderAlert', $header, $formdata);
            $result_array1 = json_decode($result1);
            $error = $result_array1->error;
            $message = $result_array1->message;
            $status = $result_array1->status;


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
            redirect('patient/Auth/logout', 'refresh');
        }
    }

    public function pharmacy_order_detail($order_id)
    {  
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];    
            $orderid = my_decrypt($order_id);
            $parameters = array('pharmacyOrderId' => $orderid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/detailPastPharmacyOrderAlert",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['details'] = $details;
                $this->load->view('backend/patient/template/header');
                $this->load->view('backend/patient/order/pharmacy_order_detail',$data);
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

    public function lab_order_detail($labOrder_id)
    {  
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];    
            $labOrderid = my_decrypt($labOrder_id);
            $parameters = array('labOrderId' => $labOrderid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/detailPastLabOrderAlert",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['details'] = $details;

                $this->load->view('backend/patient/template/header');
                $this->load->view('backend/patient/order/lab_order_detail',$data);
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

	public function add_pharmacy_order($encounter_id)
	{  
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];    
            $encounterid = my_decrypt($encounter_id);
            $parameters = array('encounterId' => $encounterid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/detailPrescribePharmacyOrderAlert",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['encounter_id'] = $encounter_id;
                $data['details'] = $details;  
                $this->load->view('backend/patient/template/header');
	            $this->load->view('backend/patient/order/add_pharmacy_order',$data);
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

    public function fetch_nearby_pharmacy()
    {  
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];    
            $pincode = $_POST['pincode'];
            $parameters = array('pincode' => $pincode);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/findNearByPharmacy",$header,$json_param);
            $result_array = json_decode($result);
            $labs = $result_array->data;
            $status = $result_array->status;

                
            if ($status == 200) 
            {
                $datas['labs'] = $labs;
                $output = $this->load->view('backend/patient/ajax/ajax_pharmacy_address_list',$datas,true);
            }
            else
            {
                $output = 'no';
            }
            $data['address_list'] = $output;
            echo json_encode($data);  
        } 
        else 
        {
            redirect('patient/Auth/logout', 'refresh');
        }    
    }

    function add_save_pharmacy_order()
    {
        if ($this->session->userdata('logged_in_patient')) 
        {   
            
            $token = $this->session->userdata('logged_in_patient')['token'];
            $patient_id = $this->session->userdata('logged_in_patient')['patient_id'];
            $encounterId = my_decrypt($_POST['encounterId']);
            $pharmacyId = $_POST['pharmacyId'];
            $pharmacyOrderMode = $_POST['pharmacyOrderMode'];
            $orderAddressLine1 = $_POST['orderAddressLine1'];
            $orderAddressLine2 = $_POST['orderAddressLine2'];
            $landmark = $_POST['landmark'];
            $pincode = $_POST['pincode'];
            $orderDate = $_POST['orderDate'];
            $drugName = $_POST['drugName'];
            $morning = $_POST['morning'];
            $afternoon = $_POST['afternoon'];
            $evening = $_POST['evening'];
            $night = $_POST['night'];
            $comment = $_POST['comment'];
            $noOfDays = $_POST['noOfDays'];
            $qty = $_POST['qty'];
            $encounterMedicinesId = $_POST['encounterMedicinesId'];
            if (!empty($encounterMedicinesId)) {
                foreach ($encounterMedicinesId as $key => $selected) {
                    $medicinesDetail[] = array(
                        'encounterMedicinesId' => $encounterMedicinesId[$key],
                        'drugName' => $drugName[$selected],
                        'morning' => $morning[$selected],
                        'afternoon' => $afternoon[$selected],
                        'evening' => $evening[$selected],
                        'night' => $night[$selected],
                        'comment' => $comment[$selected],
                        'noOfDays' => $noOfDays[$selected],
                        'qty' => $qty[$selected]
                    );
                }
               
                
            }

            $data_value = array(
            'patientId' => $patient_id,    
            'encounterId' => $encounterId,
            'pharmacyId' => $pharmacyId,
            'pharmacyOrderMode' => $pharmacyOrderMode,
            'orderAddressLine1' => $orderAddressLine1,
            'orderAddressLine2' => $orderAddressLine2,
            'landmark' => $landmark,
            'pincode' => $pincode,
            'orderDate' => $orderDate,
            'medicinesDetail' => $medicinesDetail
            );
            $formdata = json_encode($data_value);

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result1 = methodPost('api/patient/orderPharmacyOrderAlert', $header, $formdata);
            
            $result_array1 = json_decode($result1);
            
            $error = $result_array1->error;
            $message = $result_array1->message;
            $status = $result_array1->status;
            

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
            redirect('patient/Auth/logout', 'refresh');
        }
    }

}