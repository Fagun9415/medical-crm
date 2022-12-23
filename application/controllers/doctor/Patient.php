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
	public function add_patient()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {	
			$this->load->view('backend/doctor/template/header');
			$this->load->view('backend/doctor/patient/add_patient');
			$this->load->view('backend/doctor/template/footer');
		} 
        else 
        {
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}

	public function add_new_patient()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {	
			$this->load->view('backend/doctor/template/header');
			$this->load->view('backend/doctor/patient/add_new_patient');
			$this->load->view('backend/doctor/template/footer');
		} 
        else 
        {
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}

	public function add_save_new_patient()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {	
        	$token = $this->session->userdata('logged_in_doctor')['token'];	
        	
        	$name = $_POST['full_name'];
        	$email = $_POST['email'];
        	$phoneNo = $_POST['phoneNo'];
        	$phoneNo_phoneCode = $_POST['phoneNo_phoneCode'];
        	$gender = $_POST['gender'];
        	$birthDate = $_POST['birthDate'];

			
				$data_value = array(
				'name' => $name,
				'email' => $email,	
				'birthDate' => $birthDate,
				'phoneCode' => $phoneNo_phoneCode,  	
				'phoneNo' => $phoneNo,
				'gender' => $gender
				);
			
			$final_data = json_encode($data_value);

			$header = ["authorization: Bearer " . $token, "content-type: application/json"];
			$result = methodPost('api/doctors/addNewPatient', $header, $final_data);
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
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}

	public function add_new_patient_step2()
	{	
		$this->load->view('backend/doctor/template/header');
		$this->load->view('backend/doctor/patient/add_new_patient_step2');
		$this->load->view('backend/doctor/template/footer');
	}

	public function patient_profile()
	{	
		$this->load->view('backend/doctor/template/header');
		$this->load->view('backend/doctor/patient/patient_profile');
		$this->load->view('backend/doctor/template/footer');
	}

	public function active_patient()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {	
        	$token = $this->session->userdata('logged_in_doctor')['token'];	

			$this->load->view('backend/doctor/template/header');
			$this->load->view('backend/doctor/patient/active_patient');
			$this->load->view('backend/doctor/template/footer');
		} 
        else 
        {
            redirect('doctor/Auth/logout', 'refresh');
        }	

	}

	public function fetch_active_patient()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {   
            $token = $this->session->userdata('logged_in_doctor')['token'];	
			

			if ($_POST['mobileno'] == null ) 
			{
				$data_value = [
                'mobileNo' => ''
            	];
			}
			else
			{
				$data_value = [
                'mobileNo' => $_POST['mobileno']
            	]; 
			}	

			

            $formdata = json_encode($data_value);

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPost('api/doctors/getActivePatients', $header, $formdata);
            $requestlist = json_decode($result);

            $patient = $requestlist->data;
            $status = $requestlist->status;



            if (!empty($patient)) 
            {	

            	$data = [];
            	$i=1;

                foreach ($patient as $key => $row) {
                    $encounter_id = my_encrypt($row->id);
					$patientId = my_encrypt($row->patientId);
                    $p  = $row->patient;


                    if ($row->paymentPending == true) 
                    {
                    	$payment = 'pending';
                    }
                    else
                    {
                    	$payment = 'completed';	
                    }	

                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = '<a href="'. base_url('doctor/Patient/edit_patient/').$encounter_id.'">
                                                    <h2 class="table-avatar">
                                                        <span class="user-name">'.ucwords($p->name).'('.ucwords($p->gender).')</span>
                                                    </h2></a>';
                    $sub_array[] = $p->email.'<br>(+'.$p->phoneCode.') '.$p->phoneNo;
                    $sub_array[] = date('d-m-Y',strtotime($row->encounterDate)).'<br>Updated at : '.date('d-m-Y',strtotime($row->updatedAt));
                    $sub_array[] = ucwords($payment);
                    $sub_array[] = '<a href="'. base_url('doctor/Patient/edit_patient/').$encounter_id.'" class="btn btn-secondary">
                                                    Edit Patient</a>';
                    $sub_array[] = '<a href="'. base_url('doctor/Patient/past_encounter/').$patientId.'" class="btn btn-secondary">
                                                    View</a>';

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
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}

	public function past_encounter($patientId)
	{	
		
		if ($this->session->userdata('logged_in_doctor')) 
        {	
        	$token = $this->session->userdata('logged_in_doctor')['token'];	

		
			$data['pid'] = $patientId;
			$this->load->view('backend/doctor/template/header');
			$this->load->view('backend/doctor/patient/past_encounter', $data);
			$this->load->view('backend/doctor/template/footer');
		} 
        else 
        {
            redirect('doctor/Auth/logout', 'refresh');
        }	

	}

	public function fetch_past_encounter()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {   
            $token = $this->session->userdata('logged_in_doctor')['token'];	
			

			
				$data_value = [
                'patientId' => "11" 
            	];
			

			

            $formdata = json_encode($data_value);

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPost('api/doctors/past10EncounterOfPatient', $header, $formdata);
            $requestlist = json_decode($result);

            $patient = $requestlist->data;
            $patientdetail = $patient->patient;
            $encountersDetail = $patient->encounters;
			
            if (!empty($patient)) 
            {	
				
				$data = [];
            	$i=1;
				
                foreach ($encountersDetail as $key => $row) {
					
					$doctordetails = $row->doctor;
					$encountersId = my_encrypt($row->id);

                 	

                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = $patientdetail->name.'<br>'.$patientdetail->email.'<br>(+'.$patientdetail->phoneCode.') '.$patientdetail->phoneNo;
                    $sub_array[] = $doctordetails->name .'<br>'.$doctordetails->hospitalName;
                    $sub_array[] = $doctordetails->email.'<br>'.$doctordetails->doctorPhoneNo;
                   
                    $sub_array[] = date('d-m-Y',strtotime($row->encounterDate)).'<br>Updated at : '.date('d-m-Y',strtotime($row->updatedAt));
             
                    $sub_array[] = '<a href="'. base_url('doctor/Patient/past_patient_detail/').$encountersId.'" class="btn btn-secondary">
                                                    View</a>';

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
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}

	public function past_patient()
	{	

		if ($this->session->userdata('logged_in_doctor')) 
        {	
        	$token = $this->session->userdata('logged_in_doctor')['token'];	
			$this->load->view('backend/doctor/template/header');
			$this->load->view('backend/doctor/patient/past_patient');
			$this->load->view('backend/doctor/template/footer');
		} 
        else 
        {
            redirect('doctor/Auth/logout', 'refresh');
        }	

	}

	public function fetch_past_patient()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {   
            $token = $this->session->userdata('logged_in_doctor')['token'];	
			

			if ($_POST['mobileno'] == null ) 
			{
				$data_value = [
                'mobileNo' => ''
            	];
			}
			else
			{
				$data_value = [
                'mobileNo' => $_POST['mobileno']
            	]; 
			}	

			

            $formdata = json_encode($data_value);

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPost('api/doctors/getPastPatients', $header, $formdata);
            $requestlist = json_decode($result);

            $patient = $requestlist->data;
            $status = $requestlist->status;



            if (!empty($patient)) 
            {	

            	$data = [];
            	$i=1;

                foreach ($patient as $key => $row) {
                    $encounter_id = my_encrypt($row->id);

                    $p  = $row->patient;


                    if ($row->paymentPending == true) 
                    {
                    	$payment = 'pending';
                    }
                    else
                    {
                    	$payment = 'completed';	
                    }	

                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = '<a href="'. base_url('doctor/Patient/past_patient_detail/').$encounter_id.'">
                                                    <h2 class="table-avatar">
                                                        <span class="user-name">'.ucwords($p->name).'('.ucwords($p->gender).')</span>
                                                    </h2></a>';
                    $sub_array[] = $p->email.'<br>(+'.$p->phoneCode.') '.$p->phoneNo;
                    $sub_array[] = date('d-m-Y',strtotime($row->encounterDate)).'<br>Updated at : '.date('d-m-Y',strtotime($row->updatedAt));
                    $sub_array[] = ucwords($payment);
                    $sub_array[] = '<a href="'. base_url('doctor/Patient/past_patient_detail/').$encounter_id.'" class="btn btn-secondary">View</a>';
 
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
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}

	public function past_patient_detail($encounter_id)
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        { 	
			$token = $this->session->userdata('logged_in_doctor')['token'];	
			$encounterid = my_decrypt($encounter_id);

			$data_value = [
	                'encounterId' => $encounterid
	            ];

	        $formdata = json_encode($data_value);

	        $header = ["authorization: Bearer " . $token, "content-type: application/json"];

	        $result = methodPost('api/doctors/getEncounterWithFullDetailForDoctor', $header, $formdata);
	        $requestlist = json_decode($result);

	        $encounter = $requestlist->data;
	        $status = $requestlist->status;

	        if ($status == 200) 
	        {	
	        	$data['details'] = $encounter;	        
				$this->load->view('backend/doctor/template/header');
				$this->load->view('backend/doctor/patient/past_patient_detail',$data);
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

	public function chronic_patient()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {	
        	$token = $this->session->userdata('logged_in_doctor')['token'];	

			$this->load->view('backend/doctor/template/header');
			$this->load->view('backend/doctor/patient/chronic_patient');
			$this->load->view('backend/doctor/template/footer');
		} 
        else 
        {
            redirect('doctor/Auth/logout', 'refresh');
        }	

	}

	public function fetch_chronic_patient()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {   
            $token = $this->session->userdata('logged_in_doctor')['token'];	
			

			if ($_POST['mobileno'] == null ) 
			{
				$data_value = [
                'mobileNo' => ''
            	];
			}
			else
			{
				$data_value = [
                'mobileNo' => $_POST['mobileno']
            	]; 
			}	

			

            $formdata = json_encode($data_value);

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPost('api/doctors/getChronicPatients', $header, $formdata);
            $requestlist = json_decode($result);

            $patient = $requestlist->data;
            $status = $requestlist->status;



            if (!empty($patient)) 
            {	

            	$data = [];
            	$i=1;

                foreach ($patient as $key => $row) {
                    $encounter_id = my_encrypt($row->id);

                    $p  = $row->patient;


                    if ($row->paymentPending == true) 
                    {
                    	$payment = 'pending';
                    }
                    else
                    {
                    	$payment = 'completed';	
                    }	

                    $sub_array = [];
                    $sub_array[] = '#'.$i;
                    $sub_array[] = '<a href="'. base_url('doctor/Patient/chronic_patient_detail/').$encounter_id.'">
                                                    <h2 class="table-avatar">
                                                        <span class="user-name">'.ucwords($p->name).'('.ucwords($p->gender).')</span>
                                                    </h2></a>';
                    $sub_array[] = $p->email.'<br>(+'.$p->phoneCode.') '.$p->phoneNo;
                    $sub_array[] = date('d-m-Y',strtotime($row->encounterDate)).'<br>Updated at : '.date('d-m-Y',strtotime($row->updatedAt));
                    $sub_array[] = ucwords($payment);
                    $sub_array[] = '<a href="'. base_url('doctor/Patient/chronic_patient_detail/').$encounter_id.'" class="btn btn-secondary">View</a>';

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
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}

	public function chronic_patient_detail($encounter_id)
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        { 	
			$token = $this->session->userdata('logged_in_doctor')['token'];	
			$encounterid = my_decrypt($encounter_id);

			$data_value = [
	                'encounterId' => $encounterid
	            ];

	        $formdata = json_encode($data_value);

	        $header = ["authorization: Bearer " . $token, "content-type: application/json"];

	        $result = methodPost('api/doctors/getEncounterWithFullDetailForDoctor', $header, $formdata);
	        $requestlist = json_decode($result);

	        $encounter = $requestlist->data;
	        $status = $requestlist->status;

	        if ($status == 200) 
	        {	
	        	$data['details'] = $encounter;	        
				$this->load->view('backend/doctor/template/header');
				$this->load->view('backend/doctor/patient/chronic_patient_detail',$data);
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

	public function edit_patient($encounter_id)
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        { 	
			$token = $this->session->userdata('logged_in_doctor')['token'];	
			$encounterid = my_decrypt($encounter_id);

			$data_value = [
	                'encounterId' => $encounterid
	            ];

	        $formdata = json_encode($data_value);

	        $header = ["authorization: Bearer " . $token, "content-type: application/json"];

	        $result = methodPost('api/doctors/getEncounterWithFullDetailForDoctor', $header, $formdata);
	        $requestlist = json_decode($result);

	        $encounter = $requestlist->data;
	        $status = $requestlist->status;

	        if ($status == 200) 
	        {	
	        	$data['details'] = $encounter;	        
				$this->load->view('backend/doctor/template/header');
				$this->load->view('backend/doctor/patient/edit_patient',$data);
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

	public function edit_save_encounter()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {	

        	$token = $this->session->userdata('logged_in_doctor')['token'];	
        	$encounterId = my_decrypt($_POST['encounterId']);
			$isReferral = $_POST['Referral'];
			$chronicPatient = $_POST['chronic'];
			$totalPayment = $_POST['totalPayment'];
        	$provisionalDiagnosis = $_POST['pdd'];
        	$labTestName = $_POST['test'];
			$doctorName = $_POST['doctorName'];
			$doctorPhoneNo = $_POST['doctorPhoneNo'];
			$paymentMode = $_POST['mode'];
			$isComplete = $_POST['Complete'];
			$symptomsResolved = $_POST['Symptoms'];
        	$finalDiagnosis = $_POST['fdd'];
			$drug_name = $_POST['drug_name'];
			$morning = $_POST['morning'];
			$afternoon = $_POST['afternoon'];
			$evening = $_POST['evening'];
			$night = $_POST['night'];
			$comment = $_POST['comment'];
			$noOfDays = $_POST['noOfDays'];




			for ($i=0; $i <count($drug_name) ; $i++) 
			{ 
				$medicinesDetail[] = array
				(
					'drugName' => $drug_name[$i],
					'morning' => $morning[$i],
					'afternoon' => $afternoon[$i],
					'evening' => $evening[$i],
					'night' => $night[$i],
					'comment' => $comment[$i],
					'noOfDays' => $noOfDays[$i]
				); 	 	
			}

				if ($isReferral == 'yes') 
				{
					$rrr = true;
				}
				else
				{
					$rrr = false;
				}

				if ($chronicPatient == 'yes') 
				{
					$crop = true;
				}
				else
				{
					$crop = false;
				}

				if ($isComplete == 'yes') 
				{
					$is_complet = true;
				}
				else
				{
					$is_complet = false;
				}

				if ($symptomsResolved == 'yes') 
				{
					$sr = true;
				}
				else
				{
					$sr = false;
				}

				if (empty($provisionalDiagnosis)) 
				{
					$pd = [];
				}
				else
				{
					$pd = $provisionalDiagnosis;
				}

				if (empty($labTestName)) 
				{
					$ltn = [];
				}
				else
				{
					$ltn = $labTestName;
				}

				if (empty($medicinesDetail)) 
				{
					$mdd = [];
				}
				else
				{
					$mdd = $medicinesDetail;
				}

				if (empty($finalDiagnosis)) 
				{
					$fd = [];
				}
				else
				{
					$fd = $finalDiagnosis;
				}	


			
				$data_value = array(
				'encounterId' => $encounterId,	
				'isReferral' => $rrr,
				'chronicPatient' => $crop,
				'totalPayment' => $totalPayment,
				'provisionalDiagnosis' => $pd,
				'labTestName' => $ltn,
				'medicinesDetail' => $mdd,
				'doctorName' => $doctorName,
				'doctorPhoneCode' => '91',
				'doctorPhoneNo' => $doctorPhoneNo,
				'paymentMode' => $paymentMode, 
				'isComplete' => $is_complet,
				'symptomsResolved' => $sr,
				'finalDiagnosis' => $fd
				);
			
				

			$final_data = json_encode($data_value);

			$header = ["authorization: Bearer " . $token, "content-type: application/json"];
			$result = methodPost('api/doctors/updateEncounter', $header, $final_data);
	        $result_array = json_decode($result);
	        

	        $error = $result_array->error;
	        $message = $result_array->message;
	        $status = $result_array->status;
	        $flag = $result_array->completFlag;

	        if ($flag == true) {
	        	$data['flag'] = 'past';
	        }
	        else
	        {
	        	$data['flag'] = 'active';	
	        }

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
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}


	public function delete_provisional_diagnosis()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        { 	
			$token = $this->session->userdata('logged_in_doctor')['token'];	
			$encounterid = my_decrypt($_POST['eid']);
			$provisional_diagnosis_id = my_decrypt($_POST['pdid']);

			$data_value = [
					'provisionalDiagnosisId' => (int)$provisional_diagnosis_id,
	                'encounterId' => (int)$encounterid
	            ];

	        $formdata = json_encode($data_value);

	        $header = ["authorization: Bearer " . $token, "content-type: application/json"];

	        $result = methodPost('api/doctors/deleteProvisionalDiagnosisById', $header, $formdata);
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
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}

	public function delete_medicine_information()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        { 	
			$token = $this->session->userdata('logged_in_doctor')['token'];	
			$encounterid = my_decrypt($_POST['eid1']);
			$medicine_id = my_decrypt($_POST['medid']);

			$data_value = [
					'medicineId' => (int)$medicine_id,
	                'encounterId' => (int)$encounterid
	            ];

	        $formdata = json_encode($data_value);

	        $header = ["authorization: Bearer " . $token, "content-type: application/json"];

	        $result = methodPost('api/doctors/deleteMedicineById', $header, $formdata);
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
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}

	public function delete_final_diagnosis()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        { 	
			$token = $this->session->userdata('logged_in_doctor')['token'];	
			$encounterid = my_decrypt($_POST['eid2']);
			$final_diagnosis_id = my_decrypt($_POST['fdid']);

			$data_value = [
					'finalDiagnosisId' => (int)$final_diagnosis_id,
	                'encounterId' => (int)$encounterid
	            ];

	        $formdata = json_encode($data_value);


	        $header = ["authorization: Bearer " . $token, "content-type: application/json"];

	        $result = methodPost('api/doctors/deleteFinalDiagnosisById', $header, $formdata);
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
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}


	public function fetch_patient_relation()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {   
            $token = $this->session->userdata('logged_in_doctor')['token'];	
			$mobileNo = my_decrypt($_POST['mobileno']);

			$data_value = [
                'mobileNo' => $mobileNo
            ];

            $formdata = json_encode($data_value);

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPost('api/doctors/getPatientsByMobile', $header, $formdata);
            $requestlist = json_decode($result);

            $patient = $requestlist->data;


            if (!empty($patient)) 
            {
            	$data = [];

                $i = 1;
                foreach ($patient as $key => $row) {
                    $patient_id = my_encrypt($row->id);

                    $sub_array = [];
                    $sub_array[] = $row->name.'<br>'.$row->email.'<br>(+'.$row->phoneCode.') '.$row->phoneNo;
                    $sub_array[] = date('d-m-Y',strtotime($row->birthDate));
                    $sub_array[] = ucwords($row->gender);
                    $sub_array[] = ucwords($row->role);
                    $sub_array[] =
                        '
                     <a href="' .
                        base_url('doctor/Patient/add_encounter/') .
                        $patient_id .
                        '" class="btn btn-primary">Add New Encounter</a>
                        ';

                    $data[] = $sub_array;

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
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}



	public function patientlist($mobileno)
	{	
		$data['mobile_no'] = $mobileno; 
		$this->load->view('backend/doctor/template/header');
		$this->load->view('backend/doctor/patient/patient_profile',$data);
		$this->load->view('backend/doctor/template/footer');
	}

	public function add_encounter($patient_id)
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {	
			$data['patient_id'] = $patient_id; 
			$this->load->view('backend/doctor/template/header');
			$this->load->view('backend/doctor/patient/add_encounter',$data);
			$this->load->view('backend/doctor/template/footer');
		} 
        else 
        {
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}

	public function add_save_encounter()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {	
        	$token = $this->session->userdata('logged_in_doctor')['token'];	
        	$patientId = my_decrypt($_POST['patientId']);
        	$encounterDate = $_POST['encounterDate'];
			$chronicalIllness = $_POST['chronicalIllness'];
        	$chiefComplaint = $_POST['chiefComplaint'];
        	$otherSymptoms = $_POST['otherSymptoms'];
        	$provisionalDiagnosis = $_POST['pdd'];
			$labTestName = $_POST['test'];
			$isReferral = $_POST['Referral'];
			$chronicPatient = $_POST['chronicPatient'];
			$totalPayment = $_POST['totalPayment'];
			$paymentMode = $_POST['paymentMode'];
			$doctorName = $_POST['doctorName'];
			$doctorPhoneNo = $_POST['doctorPhoneNo'];
			$drug_name = $_POST['drug_name'];
			$morning = $_POST['morning'];
			$afternoon = $_POST['afternoon'];
			$evening = $_POST['evening'];
			$night = $_POST['night'];
			$comment = $_POST['comment'];
			$noOfDays = $_POST['noOfDays'];
			$chronicalIllnessimplode = implode(",",$chronicalIllness);
		
			for ($i=0; $i <count($drug_name) ; $i++) 
			{ 
				$medicinesDetail[] = array
				(
					'drugName' => $drug_name[$i],
					'morning' => $morning[$i],
					'afternoon' => $afternoon[$i],
					'evening' => $evening[$i],
					'night' => $night[$i],
					'comment' => $comment[$i],
					'noOfDays' => $noOfDays[$i]
				); 	 	
			}

				if ($isReferral == 'yes') 
				{
					$rrr = true;
				}
				else
				{
					$rrr = false;
				}

				if ($chronicPatient == 'true') 
				{
					$crop = true;
				}
				else
				{
					$crop = false;
				}

				if (empty($provisionalDiagnosis)) 
				{
					$pd = [];
				}
				else
				{
					$pd = $provisionalDiagnosis;
				}

				if (empty($labTestName)) 
				{
					$ltn = [];
				}
				else
				{
					$ltn = $labTestName;
				}

				if (empty($medicinesDetail)) 
				{
					$mdd = [];
				}
				else
				{
					$mdd = $medicinesDetail;
				}

				if (empty($finalDiagnosis)) 
				{
					$fd = [];
				}
				else
				{
					$fd = $finalDiagnosis;
				}

			
				$data_value = array(
				'patientId' => $patientId,	
				'encounterDate' => $encounterDate,
				'chronicalIllness' => $chronicalIllnessimplode,
				'chiefComplaint' => $chiefComplaint,
				'otherSymptoms' => $otherSymptoms,
				'isReferral' => $rrr,
				'chronicPatient' => $crop,
				'totalPayment' => $totalPayment,
				'provisionalDiagnosis' => $pd,
				'labTestName' => $ltn,
				'medicinesDetail' => $mdd,
				'doctorName' => $doctorName,
				'doctorPhoneCode' => '91',
				'doctorPhoneNo' => $doctorPhoneNo,
				'paymentMode' => $paymentMode 
				);
			$final_data = json_encode($data_value);

			$header = ["authorization: Bearer " . $token, "content-type: application/json"];
			$result = methodPost('api/doctors/createEncounter', $header, $final_data);
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
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}

	public function add_patient_relation()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {	
        	$token = $this->session->userdata('logged_in_doctor')['token'];	
        	$phoneNo = my_decrypt($_POST['phoneNo']);
        	$birthDate = $_POST['birthDate'];
        	$gender = $_POST['gender'];
        	$role = $_POST['role'];
        	$name = $_POST['name'];

			
				$data_value = array(
				'name' => $name,	
				'phoneNo' => $phoneNo,	
				'birthDate' => $birthDate,
				'gender' => $gender,
				'role' => $role
				);
			
				

			$final_data = json_encode($data_value);

			$header = ["authorization: Bearer " . $token, "content-type: application/json"];
			$result = methodPost('api/doctors/addFamilyPatientByDoctor', $header, $final_data);
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
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}

	public function search_patient()
	{	
		if ($this->session->userdata('logged_in_doctor')) 
        {   
            $token = $this->session->userdata('logged_in_doctor')['token'];	
			$mobileNo = $_POST['mobileNo'];

			$data_value = [
                'mobileNo' => $mobileNo
            ];

            $formdata = json_encode($data_value);

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPost('api/doctors/getPatientsByMobile', $header, $formdata);
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
                $data['message'] = "No patient exist on this ".$mobileNo." number";
            }	
            echo json_encode($data);
		} 
        else 
        {
            redirect('doctor/Auth/logout', 'refresh');
        }	
	}
}