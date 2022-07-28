<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth  extends CI_Controller {

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
	public function login()
	{	
		$this->load->view('backend/doctor/login');
	}

	public function save_user()
	{  
   		$name = $_POST['full_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$hospitalName = $_POST['hospitalName'];
		$hospitalPhoneCode = $_POST['phoneNo1_phoneCode'];
		$hospitalPhoneNo = $_POST['phoneNo1'];
		$doctorSpeciality = $_POST['doctorSpeciality'];
		$doctorPhoneCode = $_POST['phoneNo_phoneCode'];
		$doctorPhoneNo = $_POST['phoneNo'];
		$doctorRegistrationNo = $_POST['doctorRegistrationNo'];
		$file = new CURLFile($_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']);


		$data_value = array(
		'name' => $name,
		'email' => $email,
		'password' => $password,
		'hospitalName' => $hospitalName,
		'hospitalPhoneCode' => $hospitalPhoneCode,
		'hospitalPhoneNo' => $hospitalPhoneNo,
		'doctorSpeciality' => $doctorSpeciality,
		'doctorPhoneCode' => $doctorPhoneCode,
		'doctorPhoneNo' => $doctorPhoneNo,
		'doctorRegistrationNo' => $doctorRegistrationNo,
		'file' => $file
		);


		$formdata = $data_value;


        $result = methodPost('api/doctors/register', $header, $formdata);
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

	function check_login()
    {   
        $this->form_validation->set_rules('email','Email','required');

        $this->form_validation->set_rules('password','Password','required|callback_check_database');

        if ($this->form_validation->run() == FALSE) 
        {
            $this->login();
        }   
        else
        {   
            if ($this->session->userdata('logged_in_doctor')) 
            {
                redirect('doctor/Dashboard','refresh');
            }
            else{
                $this->load->view('doctor/Auth/login');
            }
        }
    }

    function check_database()
    {
        $email = $this->input->post('email');
        $password =$this->input->post('password');

        $parameters = array('email' => $email,"password" => $password,'loginType' => 'doctor');
        $json_param = json_encode($parameters);
        $header = array("content-type: application/json");
        $result = methodPost("api/auth/login",$header,$json_param);
        
        $result_array = json_decode($result);
        
        $status = $result_array->status;
        $message = $result_array->message;


        if ($status==200) 
        {
            $token = $result_array->accessToken;
              
            $result1 = methodGet("api/doctors/profile",$token);
            $result_array1 = json_decode($result1);
            $clientdata = $result_array1->user;

            $sess_array = array(
                    'token' => $token,
                    'profile' => $clientdata
                );

            $this->session->set_userdata('logged_in_doctor', $sess_array);
            
            return true;    
        }
        else
        {
            $this->form_validation->set_message('check_database', '<p style="color:red;">'.$message.'</p>');
            return false;
        }
    }


    function edit_profile()
    {
        if ($this->session->userdata('logged_in_doctor')) 
        {   
            $user = $this->session->userdata('logged_in_doctor')['profile'];

            $data['user'] = $user;
            $this->load->view('backend/doctor/template/header');
            $this->load->view('backend/doctor/template/edit_profile',$data);
            $this->load->view('backend/doctor/template/footer');
        } 
        else 
        {
            redirect('doctor/Auth/logout', 'refresh');
        }
    }

    function edit_save_profile()
    {
        if ($this->session->userdata('logged_in_doctor')) 
        {   

            $token = $this->session->userdata('logged_in_doctor')['token'];
            $name = $_POST['name'];
            $hospitalName = $_POST['hospitalName'];
            $doctorSpeciality = $_POST['doctorSpeciality'];
            $hospitalPhoneNo = $_POST['phoneNo1'];
            $hospitalPhoneCode = !empty($_POST['phoneNo1_phoneCode']) ? $_POST['phoneNo1_phoneCode'] : $_POST['countrycode1'];
            $doctorPhoneNo = $_POST['phoneNo'];
            $doctorPhoneCode = !empty($_POST['phoneNo_phoneCode']) ? $_POST['phoneNo_phoneCode'] : $_POST['countrycode'];

            $data_value = array(
            'name' => $name,
            'hospitalName' => $hospitalName,
            'doctorSpeciality' => $doctorSpeciality,
            'hospitalPhoneCode' => $hospitalPhoneCode,
            'hospitalPhoneNo' => $hospitalPhoneNo,
            'doctorPhoneCode' => $doctorPhoneCode,
            'doctorPhoneNo' => $doctorPhoneNo
            );

            $formdata = json_encode($data_value);

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPatch('api/doctors/editprofile', $header, $formdata);
            $result_array = json_decode($result);
            $error = $result_array->error;
            $message = $result_array->message;
            $status = $result_array->status;


            if ($status == 200) 
            {

                $result1 = methodGet("api/doctors/profile",$token);
                $result_array1 = json_decode($result1);
                $clientdata = $result_array1->user;

                $sess_array = array(
                        'token' => $token,
                        'profile' => $clientdata
                    );

                $this->session->set_userdata('logged_in_doctor', $sess_array);

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
            redirect('doctor/Auth/logout', 'refresh');
        }
    }

    function change_password()
    {
        if ($this->session->userdata('logged_in_doctor')) 
        {   
            $token = $this->session->userdata('logged_in_doctor')['token'];
            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            $data_value = array(
            'oldPassword' => $oldPassword,
            'newPassword' => $newPassword,
            'confirmPassword' => $confirmPassword
            );

            $formdata = json_encode($data_value);

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPatch('api/auth/login/changePasswordProfile', $header, $formdata);
            $result_array = json_decode($result);
            $error = $result_array->error;
            $message = $result_array->message;
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
            redirect('doctor/Auth/logout', 'refresh');
        }
    }   


    function logout()
    {
        $this->session->unset_userdata('logged_in_doctor');
        redirect('doctor/Auth/login','refresh');
    }

	public function forgot_password()
	{	
		$this->load->view('backend/doctor/forgot_password');
	}

    public function forgot_password_verify()
    {  

        $email = $_POST['email'];
        $loginType = $_POST['loginType'];

        $data_value = array(
        'email' => $email,
        'loginType' => $loginType
        );

        $formdata = json_encode($data_value);

        $header = ["authorization: Bearer " . $token, "content-type: application/json"];

        $result = methodPost('api/auth/login/forgotpassword', $header, $formdata);
        $result_array = json_decode($result);

        $error = $result_array->error;
        $message = $result_array->message;
        $status = $result_array->status;

        if ($status == 404) {
            $data['status'] = "unsuccess";
            $data['message'] = $message;
        } else {
            $data['status'] = "success";
            $data['message'] = "Forgot Password email is sent to your id".$email;
        }
        echo json_encode($data);

    }


	public function register()
	{	
		$this->load->view('backend/doctor/register');
	}
}