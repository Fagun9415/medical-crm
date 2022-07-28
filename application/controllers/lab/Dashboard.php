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
		if ($this->session->userdata('logged_in_lab')) 
		{	
			$token = $this->session->userdata('logged_in_lab')['token'];	

	        $result = methodGet('api/lab/countDashboardForLab',$token);
	        $requestlist = json_decode($result);

	        $counts = $requestlist->data;
	        $status = $requestlist->status;

	        if ($status == 200) 
	        {	
	        	$data['counts'] = $counts;
				$this->load->view('backend/lab/template/header');
				$this->load->view('backend/lab/template/dashboard',$data);
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

	public function add_walkin_order()
	{	
		if ($this->session->userdata('logged_in_lab')) 
		{	
			$token = $this->session->userdata('logged_in_lab')['token'];		
        	$this->load->view('backend/lab/template/header');
			$this->load->view('backend/lab/template/add_walkin_order');
			$this->load->view('backend/lab/template/footer');
		} 
		else 
		{
            redirect('lab/Auth/logout', 'refresh');
        }	   
	}

	public function search_schedule_order()
	{	
		if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];	
			$mobileNo = $_POST['mobileNo'];

			$data_value = [
                'phoneNo' => $mobileNo
            ];

            $formdata = json_encode($data_value);

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPost('api/lab/findEncounterByPatientPhoneNoForLab', $header, $formdata);
            $requestlist = json_decode($result);

            $patient = $requestlist->data;

            if (!empty($patient)) 
            {
            	$data['status'] = "success";
                $data['mobileno'] = my_encrypt($mobileNo);
            }
            else
            {
            	$data['status'] = "unsuccess";
                $data['message'] = "No order exist on this ".$mobileNo." number";
            }	
            echo json_encode($data);
		} 
        else 
        {
            redirect('lab/Auth/logout', 'refresh');
        }	
	}

	public function schedule_order_list($mobileno)
	{	
		if ($this->session->userdata('logged_in_lab')) 
		{	
			$token = $this->session->userdata('logged_in_lab')['token'];		
			$data['mobile_no'] = $mobileno; 
			$this->load->view('backend/lab/template/header');
			$this->load->view('backend/lab/template/schedule_order_list',$data);
			$this->load->view('backend/lab/template/footer');

		} 
        else 
        {
            redirect('lab/Auth/logout', 'refresh');
        }
	}

	public function fetch_schedule_order()
	{	
		if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];	
			$mobileNo = my_decrypt($_POST['mobileno']);

			$data_value = [
                'phoneNo' => $mobileNo
            ];

            $formdata = json_encode($data_value);

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPost('api/lab/findEncounterByPatientPhoneNoForLab', $header, $formdata);
            $requestlist = json_decode($result);

            $order = $requestlist->data;


            if (!empty($order)) 
            {
            	$data = [];

                $i = 1;
                foreach ($order as $key => $row) {
                   	
                   	
                    $order_id = my_encrypt($row->id);
                    $doctor = $row->doctor;
                    $patient = $row->patient;
                    $patient_id = my_encrypt($patient->id);


                	$a = '<a href=" '.base_url('lab/Dashboard/add_order/').$order_id.'/'.$patient_id.'">
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
                    $sub_array[] = date('d M Y',strtotime($row->createdAt));
                    $sub_array[] = '<a href=" '.base_url('lab/Dashboard/add_order/').$order_id.'/'.$patient_id.'" class="btn btn-dark">Add Order</a>';

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

	public function add_order($order_id,$patient_id)
	{	
		if ($this->session->userdata('logged_in_lab')) 
		{	

			$token = $this->session->userdata('logged_in_lab')['token'];		
			$encounterid = my_decrypt($order_id);
            $parameters = array('encounterId' => $encounterid);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/detailActiveLabOrderAlert",$header,$json_param);
            $result_array = json_decode($result);

            $details = $result_array->data;
            $status = $result_array->status;

            if ($status == 200) 
            {   
                $data['encounter_id'] = $order_id;
                $data['patient_id'] = $patient_id;
                $data['alldata'] = $details;  
                $this->load->view('backend/lab/template/header');
				$this->load->view('backend/lab/template/add_order',$data);
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

	function add_save_order()
    {
        if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];
            $lab = $this->session->userdata('logged_in_lab')['profile'];
			$lab_id = $lab->id;
            $patient_id = my_decrypt($_POST['patientId']);
            $encounterId = my_decrypt($_POST['encounterId']);
            $labId = $lab_id;
            $labOrderMode = $_POST['labOrderMode'];
            $orderAddressLine1 = $_POST['orderAddressLine1'];
            $orderAddressLine2 = $_POST['orderAddressLine2'];
            $landmark = $_POST['landmark'];
            $pincode = $_POST['pincode'];
            $orderDate = $_POST['orderDate'];

            $parameters = array('encounterId' => $encounterId);
            $json_param = json_encode($parameters);
            $header = ["authorization: Bearer " . $token, "content-type: application/json"];
            $result = methodPost("api/patient/detailActiveLabOrderAlert",$header,$json_param);
            $result_array = json_decode($result);
            $details = $result_array->data;
            $labTests = $details->labTests;
            
            foreach ($labTests as $key => $value) {
                $labTest[] = array(
                    'encounterLabId' => $value->id,
                    'labTestName' => $value->labTestName
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
            redirect('lab/Auth/logout', 'refresh');
        }
    }
}