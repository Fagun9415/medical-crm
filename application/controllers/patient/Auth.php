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
		$this->load->view('backend/patient/login');
	}

	public function save_user()
	{  

		$name = $_POST['full_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$birthDate = $_POST['birthDate'];
		$phoneCode = $_POST['phoneNo_phoneCode'];
		$phoneNo = $_POST['phoneNo'];
		$gender = $_POST['gender'];

		$data_value = array(
		'name' => $name,
		'email' => $email,
		'password' => $password,
		'birthDate' => date('Y-m-d',strtotime($birthDate)),
		'phoneCode' => $phoneCode,
		'phoneNo' => $phoneNo,
		'gender' => $gender,
		'role' => 'self',
		'isPrimary' => true,
		'primaryId' => 0 
		);


		

		$formdata = json_encode($data_value);

        $header = ["authorization: Bearer " . $token, "content-type: application/json"];

        $result = methodPost('api/patient/register', $header, $formdata);
        $result_array = json_decode($result);
        $error = $result_array->error;
        $message = $result_array->message;

        if ($message == "User registration successfully!") {
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
            if ($this->session->userdata('logged_in_patient')) 
            {
                redirect('patient/Dashboard/family_list','refresh');
            }
            else{
                $this->load->view('patient/Auth/login');
            }
        }
    }

    function check_database()
    {
        $email = $this->input->post('email');
        $password =$this->input->post('password');

        $parameters = array('email' => $email,"password" => $password,'loginType' => 'patient');
        $json_param = json_encode($parameters);
        $header = array("content-type: application/json");
        $result = methodPost("api/auth/login",$header,$json_param);
        
        $result_array = json_decode($result);
        
        $status = $result_array->status;
        $message = $result_array->message;

        if ($status==200) 
        {
            $token = $result_array->accessToken;
              
            $result1 = methodGet("api/patient/profile",$token);
            $result_array1 = json_decode($result1);
            $clientdata = $result_array1->user;

            $sess_array = array(
                    'token' => $token,
                    'profile' => $clientdata,
                    'patient_id' => $clientdata->id
                );

            $this->session->set_userdata('logged_in_patient', $sess_array);
            
            return true;    
        }
        else
        {
            $this->form_validation->set_message('check_database', '<p style="color:red;">'.$message.'</p>');
            return false;
        }
    }   


    function logout()
    {
        $this->session->unset_userdata('logged_in_patient');
        redirect('patient/Auth/login','refresh');
    }
	
    function edit_profile()
    {
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $user = $this->session->userdata('logged_in_patient')['profile'];

            $data['user'] = $user;
            $this->load->view('backend/patient/template/header');
            $this->load->view('backend/patient/template/edit_profile',$data);
            $this->load->view('backend/patient/template/footer');
        } 
        else 
        {
            redirect('patient/Auth/logout', 'refresh');
        }
    }

    function edit_save_profile()
    {
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];
            $name = $_POST['name'];
            $phoneNo = $_POST['phoneNo'];
            $phoneCode = !empty($_POST['phoneNo_phoneCode']) ? $_POST['phoneNo_phoneCode'] : $_POST['countrycode'];

            $data_value = array(
            'name' => $name,
            'phoneCode' => $phoneCode,
            'phoneNo' => $phoneNo
            );

            $formdata = json_encode($data_value);

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPatch('api/patient/editProfile', $header, $formdata);
            $result_array = json_decode($result);
            $error = $result_array->error;
            $message = $result_array->message;
            $status = $result_array->status;


            if ($status == 200) 
            {

                $result1 = methodGet("api/patient/profile",$token);
                $result_array1 = json_decode($result1);
                $clientdata = $result_array1->user;

                $sess_array = array(
                        'token' => $token,
                        'profile' => $clientdata
                    );

                $this->session->set_userdata('logged_in_patient', $sess_array);

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

    function change_password()
    {
        if ($this->session->userdata('logged_in_patient')) 
        {   
            $token = $this->session->userdata('logged_in_patient')['token'];
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
            redirect('patient/Auth/logout', 'refresh');
        }
    }


	public function forgot_password()
	{	
		$this->load->view('backend/patient/forgot_password');
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
		$this->load->view('backend/patient/register');
	}
}