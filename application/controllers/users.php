<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{

    var $USER_OBJ = false;
    var $REVIEWING_TIME = 21;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->model('document_handle'); 
        $this->load->library('form_validation');

        $this->USER_OBJ = $this->session->userdata('user');
        date_default_timezone_set('Asia/Colombo');
    }

    public function index()
    {
        if ($this->USER_OBJ != false) {
            //session exists
            redirect('/dashboard');
        } else {
            //session expired or DNE
            $this->load->view('login');
        }
//
//        $user = $this->session->userdata('user');
//        if (isset($user)) {
//            $this->dashboard();
//            //$this->load->view('dashboard');
//        } else {
//            $this->load->view('login');
//        }
    }

    public function dashboard()
    {
        switch ($this->ua->check_login()) {
            case "Super":
                $this->super_user_dashboard();
                break;
            case "Editor":
                $this->editor_dashboard();
                break;
            case "Manage":
                $this->manager_dashboard();
                break;
            default:
                $this->load->view('401');
        }
    }

    private function manager_dashboard()
    {   
        $this->load->helper('arraystring');

        $success = $this->session->flashdata('upload');

        if ($success == "success") {
            $data['success_upload'] = TRUE;
        }

        $documents = $this->document_handle->get_documents($this->USER_OBJ->id); 
          $data['review_documents'] = $documents;
        $this->load->view('manager_dashboard',$data);
    }

    private function editor_dashboard()
    {   //$author_id = array("author_id" => $this->USER_OBJ->id);

        //$data['author_article'] = array();
        $this->load->view('editor_dashboard');
    }

    private function super_user_dashboard()
    {
        $this->load->helper('arraystring');

        $success = $this->session->flashdata('upload');

        if ($success == "success") {
            $data['success_upload'] = TRUE;
        }

        $documents = $this->document_handle->get_documents($this->USER_OBJ->id); 
          $data['review_documents'] = $documents;
            
        $this->load->view('super_user_dashboard', $data);    
            
    }

            

    // Login & Logout
    public function login()
    {
        $user_obj = $this->session->userdata('user');
        if ($user_obj != false) {
            redirect('/dashboard');
        } else {

            $this->form_validation->set_rules('username', 'Email', 'required|valid_email|is_unique[user.email_address]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|sha1');
            $email = $this->input->post('username');
            $pass = $this->input->post('password');
            $remember = $this->input->post('remember');
            $ip = $this->input->server('REMOTE_ADDR');
            $pass = sha1($pass);
            $user = $this->user->get_pass($email);
            //var_dump($user); die();
            if (!is_null($user)) {
                if ($user->password === $pass) {
                    $this->session->set_userdata("user", $user);
                    //$this->user->loginLogSave($user->id, $ip);
                    redirect('/dashboard');
                } else {
                    $error = array('error' => "Password is incorrect!");
                    $this->load->view('login', $error);
                }
            } else {
                $error = array('error' => "E-mail is wrong!");
                $this->load->view('login', $error);
            }
        }
    }

    public function logOut()
    {
        $this->session->sess_destroy();
        redirect('/');
    }

    /**
     * common function for the user profile.
     */
    public function profile()
    {
        switch ($this->ua->check_login()) {
            case "Super":
                $this->super_user_dashboard();
                break;
            case "DivitionalHead":
                $this->editor_profile();
                break;
            case "Opperator":
                $this->author_profile();
                break;
            case "Reviewer":
                $this->reviewer_profile();
                break;
            default:
                $this->load->view('401');
        }
    }

    /**
     * opens the editor profile view
     * Load the data from model and show in the view.
     *
     */
    private function editor_profile()
    {


    }

    private function author_profile()
    {
        $user_obj = $this->session->userdata('user');
        $wheararray = $user_obj->id;
        $data['authors'] = $this->author->getAuthorData($wheararray);
        $this->load->view('profile_author', $data);
    }

    private function reviewer_profile()
    {
        $user_obj = $this->session->userdata('user');
        $wheararray = $user_obj->id;
        $data['reviewer'] = $this->reviewer->getReviewerData($wheararray);
        $this->load->view('profile_reviewer', $data);
    }

    // following function can be disregarded.
    public function profile_author()
    {
        $this->load->view('profile_author');
    }

    public function update_profile_author()
    {
        $id = $this->input->post("id", TRUE);
        $email = $this->input->post("email", TRUE);

        $pass = $this->input->post("password", TRUE);
        $pass2 = $this->input->post("password2", TRUE);
        if ($pass == $pass2) {
            $first_name = $this->input->post("first_name", TRUE);
            $last_name = $this->input->post("last_name", TRUE);
            $title = $this->input->post("title", TRUE);
            $address1 = $this->input->post("address1", TRUE);
            $address2 = $this->input->post("address2");
            $city = $this->input->post("city", TRUE);
            $postal_code = $this->input->post("postal_code", TRUE);
            $country = $this->input->post("country", TRUE);
            $sec_question = $this->input->post("sec_question", TRUE);
            $sec_answer = $this->input->post("sec_answer", TRUE);

            $DataSet = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email_address' => $email,
                'title' => $title,
                'password' => sha1($pass),
                'address_1' => $address1,
                'address_2' => $address2,
                'city' => $city,
                'postal_code' => $postal_code,
                'country' => $country,
                'security_question' => $sec_question,
                'security_answer' => $sec_answer,
                'role' => "Author",
                'deleted' => 0,
                'banned' => 1);
            $this->author->UpdateAuthorData($DataSet, "user", $id);
            redirect('/dashboard');
        }
    }

    public function update_profile_reviewer()
    {
        $id = $this->input->post("id", TRUE);
        $email = $this->input->post("email", TRUE);

        $pass = $this->input->post("password", TRUE);
        $pass2 = $this->input->post("password2", TRUE);
        if ($pass == $pass2) {
            $first_name = $this->input->post("first_name", TRUE);
            $last_name = $this->input->post("last_name", TRUE);
            $title = $this->input->post("title", TRUE);
            $address1 = $this->input->post("address1", TRUE);
            $address2 = $this->input->post("address2");
            $city = $this->input->post("city", TRUE);
            $postal_code = $this->input->post("postal_code", TRUE);
            $country = $this->input->post("country", TRUE);
            $sec_question = $this->input->post("sec_question", TRUE);
            $sec_answer = $this->input->post("sec_answer", TRUE);

            $DataSet = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email_address' => $email,
                'title' => $title,
                'password' => sha1($pass),
                'address_1' => $address1,
                'address_2' => $address2,
                'city' => $city,
                'postal_code' => $postal_code,
                'country' => $country,
                'security_question' => $sec_question,
                'security_answer' => $sec_answer,
                'role' => "Reviewer",
                'deleted' => 0,
                'banned' => 1);
            $this->reviewer->UpdateAuthorData($DataSet, "user", $id);
            redirect('/dashboard');
        }
    }
    
    
    public function AddEmployee(){
        $fieldset = array('LocationId', 'LocationName','CostCenter');
        $data['locations'] = $this->user->getData($fieldset, 'mdm_location');       
        $this->load->view('employee_manage',$data);
    }
    public function add_new_employee()
    {
        $title = $this->input->post("title", TRUE);
        $EmployeeName = $this->input->post("EmployeeName", TRUE);
        $locationid = $this->input->post("locationid", TRUE);
        $EmployeeNumber = $this->input->post("EmployeeNumber", TRUE);
        $designation = $this->input->post("designation", TRUE);
        $boadgrade = $this->input->post("boadgrade", TRUE);
        $DataSet = array('title' => $title, 'EmployeeName' => $EmployeeName, 'EmployeeNumber' => $EmployeeNumber, 
            'Designation' => $designation, 'BoardGrade' => $boadgrade, 'account' => 0);
        //Query For Editor insertion 
        $insert_id = $this->user->insertData("mdm_employee", $DataSet);
            
        if ($insert_id > 0) {
            $success = array('Success' => "Successfully Added!");
            redirect(base_url() . 'index.php/Users/AddEmployee', $success);
        } else {
            $Error = array('Error' => "Error Detected!");
            redirect(base_url() . 'index.php/Users/AddEmployee', $Error);
        }
    }
    
    public function edit_Employee($id)
    {
        $fieldset = array('LocationId', 'LocationName','CostCenter');
        $data['locations'] = $this->user->getData($fieldset, 'mdm_location');    
        $data['EmployeeData'] = $this->user->get_user($id);
        
           
        $this->load->view("admin_edit_employee",$data );
    }
    
    public function update_employee()
    {
        $title = $this->input->post("title", TRUE);
        $EmployeeName = $this->input->post("EmployeeName", TRUE);
        $locationid = $this->input->post("locationid", TRUE);
        $EmployeeNumber = $this->input->post("EmployeeNumber", TRUE);
        $designation = $this->input->post("designation", TRUE);
        $boadgrade = $this->input->post("boadgrade", TRUE);
        $id = $this->input->post("hdnID", TRUE);
        $DataSet = array('title' => $title, 'EmployeeName' => $EmployeeName, 'EmployeeNumber' => $EmployeeNumber, 
            'Designation' => $designation, 'BoardGrade' => $boadgrade, 'account' => 0,'EmpId' => $id);
        //var_dump($DataSet); die();    
        //Query For Editor insertion 
        $this->user->update( $DataSet, "mdm_employee",$id);
        redirect(base_url() . 'index.php/Users/ViewEmployee');
    }

    public function EditEmployee(){
        
        $title = $this->input->post("title", TRUE);
        $EmployeeName = $this->input->post("EmployeeName", TRUE);
        $locationid = $this->input->post("locationid", TRUE);
        $EmployeeNumber = $this->input->post("EmployeeNumber", TRUE);
        $designation = $this->input->post("designation", TRUE);
        $boadgrade = $this->input->post("boadgrade", TRUE);
        $DataSet = array('title' => $title, 'EmployeeName' => $EmployeeName, 'EmployeeNumber' => $EmployeeNumber, 
            'Designation' => $designation, 'BoardGrade' => $boadgrade, 'account' => 0);
        //Query For Editor insertion 
        $insert_id = $this->user->insertData("mdm_employee", $DataSet);
            
        if ($insert_id > 0) {
            $success = array('Success' => "Successfully Added!");
            redirect(base_url() . 'index.php/Users/AddEmployee', $success);
        } else {
            $Error = array('Error' => "Error Detected!");
            redirect(base_url() . 'index.php/Users/AddEmployee', $Error);
        }
        
        $this->load->model('user');
        $data['employees'] = $this->user->get_employee_data(); 
        //var_dump($data); die();
        $this->load->view('employee_view', $data);
    }
    
    
    public function ViewEmployee(){
            
        $this->load->model('user');
        $data['employees'] = $this->user->get_employee_data(); 
        //var_dump($data); die();
        $this->load->view('employee_view', $data);
    }
    
    public function AddUser(){
        $fieldset = array('EmpId', 'EmployeeName', 'Designation');
        $data['users'] = $this->user->getData($fieldset, 'mdm_employee', array( 'account' => 0));           
//        $this->load->model('journalm');
//        $data['journals'] = $this->journalm->get_journals();
        $this->load->view('user_manage', $data);
    }
    
    public function ViewUser(){
        $status = 1;
        $this->load->model('user');
        $data['users'] = $this->user->get_users_data($status); 
        //var_dump($data); die();
        $this->load->view('user_view', $data);
    }
    
    public function edit_User($id){
        $fieldset = array('EmpId', 'EmployeeName', 'Designation');
        $data['users'] = $this->user->getData($fieldset, 'mdm_employee', array( 'account' => 0));       
        $data['UserData'] = $this->user->get_system_user($id);   
        //var_dump($data); die();
        $this->load->view("admin_edit_user",$data );      
    }

        public function add_new_user()
    {
        $empid = $this->input->post("empid", TRUE);
        $password = $this->input->post("password", TRUE);
        $conpw = $this->input->post("conpassword", TRUE);
        $username = $this->input->post("username", TRUE);
        $role = $this->input->post("role", TRUE);
        //$password = $this->generateRandomString();
        $DataSet = array('UserId' => $username, 'EmpId' => $empid, 'Password' => $password, 'role' => $role, 
            'Password' => sha1($password), 'mdm_employee_EmpId' =>$empid);
        //Query For Editor insertion 
        $insert_id = $this->user->insertData("userdetails", $DataSet);
        $EpdateEmpData = array('account' => 1);
        $this->user->Update($EpdateEmpData,"mdm_employee", array('EmpId' => $empid));
        if ($insert_id > 0) {
//            $this->load->library('EmailSender');
//            $data = array(
//                'editor_name' => $first_name . " " . $last_name,
//                'password' => $password
//            );
//            $this->emailsender->notify_editor_creation($email, $data);
            $success = array('Success' => "Successfully Added!");
            redirect(base_url() . 'index.php/Users/AddUser', $success);
        } else {
            $Error = array('Error' => "Error Detected!");
            redirect(base_url() . 'index.php/Users/AddUser', $Error);
        }
    }

     public function update_user()
    {
        $empid = $this->input->post("empid", TRUE);
        $password = $this->input->post("password", TRUE);
        $conpw = $this->input->post("conpassword", TRUE);
        $username = $this->input->post("username", TRUE);
        $role = $this->input->post("role", TRUE);
        //$id = $this->input->post("hdnID", TRUE);
       $DataSet = array('UserId' => $username, 'EmpId' => $empid, 'Password' => $password, 'role' => $role, 
            'Password' => sha1($password), 'mdm_employee_EmpId' =>$empid);
        //var_dump($DataSet); die();    
        //Query For Editor insertion 
        $this->user->update( $DataSet, "userdetails",$empid);
        redirect(base_url() . 'index.php/Users/ViewUser');
    }
    
    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function new_editor()
    {
        $fieldset = array('id', 'email_address', 'first_name', 'last_name', 'title', 'address_1', 'address_2',
            'city', 'postal_code', 'country', 'role', 'security_question', 'security_answer', '');
        $data['users'] = $this->user->getData($fieldset, 'user', array('role' => 'Editor', 'banned' => 0, 'deleted' => 0));

        $this->load->model('journalm');

        $data['journals'] = $this->journalm->get_journals();
        $this->load->view('admin_manage_editors', $data);
    }

    function get_single_user()
    {
        $data = $this->input->post("user_id");
        $query = $this->db->get_where('user', array('id' => $data, 'banned' => 0, 'deleted' => 0))->result()[0];
        //$a = $query['rows'];
        $this->load->view('json', array('data' => $query));
//        echo json_encode($query);
        //var_dump($a);
    }

    public function delete_editor()
    {
        $id = $this->input->post("id", TRUE);
        $flag = $this->user->deleteEditor($id);

        if ($flag == 0) {
            redirect(base_url() . 'index.php/Users/new_editor');
        } else {
            echo "Error";
            die();
        }
    }

    // Reviewers Area
    public function reviewers()
    {
        $fieldset = array('id', 'email_address', 'first_name', 'last_name', 'title', 'address_1', 'address_2',
            'city', 'postal_code', 'country', 'role', 'security_question', 'security_answer');

        $data['users'] = $this->user->getData($fieldset, 'user', array('role' => 'Reviewer', 'banned' => '1', 'deleted' => '0'));

        $fieldset = array('id', 'email_address', 'first_name', 'last_name');
        $data['invited'] = $this->user->getData($fieldset, 'invited_reviewers');
        $this->load->view("invite_reviewer", $data);
    }

    public function invite_reviewer()
    {
        $first_name = $this->input->post("first_name");
        $email = $this->input->post("email");
        $last_name = $this->input->post("last_name");
        //$journal = $this->input->post("journals[]");
        //ToDO send this data as a mail to reviver
        $this->load->library('EmailSender');

        $this->load->library('parser');
        $data = array(
            'name' => $first_name . " " . $last_name,
            'link' => base_url() . "index.php/users/register_reviewer"
        );
        $body_string = $this->parser->parse('email/invite_reviewer', $data, TRUE);

//        if ($this->emailsender->send($email, 'Applied e journal', $body_string)) {
        if (true) {

            $DataSet = array('first_name' => $first_name,
                'last_name' => $last_name,
                'email_address' => $email);

            $insert_id = $this->user->insertData("invited_reviewers", $DataSet);
            $success = array('Success' => "Successfully Invited!");
            redirect(base_url() . 'index.php/Users/reviewers', $success);
        } else {
            $Error = array('Error' => "Error Detected!");
            redirect(base_url() . 'index.php/Users/reviewers', $Error);
        }
    }

            

            
    public function register_reviewer()
    {
        $this->load->view("register_reviewer");
    }

            

    // Authors Area
    public function register_author()
    {
        $this->load->view("register_author_url");
    }

    public function view_author()
    {
        $fieldset = array('id', 'first_name', 'last_name', 'email_address', 'title',);
        $data['authors'] = $this->user->getData($fieldset, 'user');
        $this->load->view("admin_edit_author", $data);
    }

    public function authorRegistration()
    {

        $email = $this->input->post("email", TRUE);
        $pass = $this->input->post("password", TRUE);
        $pass2 = $this->input->post("password2", TRUE);
        if ($pass == $pass2) {
            $first_name = $this->input->post("first_name", TRUE);
            $last_name = $this->input->post("last_name", TRUE);
            $title = $this->input->post("title", TRUE);
            $address1 = $this->input->post("address1", TRUE);
            $address2 = $this->input->post("address2");
            $city = $this->input->post("city", TRUE);
            $postal_code = $this->input->post("postal_code", TRUE);
            $country = $this->input->post("country", TRUE);
            $sec_question = $this->input->post("sec_question", TRUE);
            $sec_answer = $this->input->post("sec_answer", TRUE);


            $DataSet = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email_address' => $email,
                'title' => $title,
                'password' => sha1($pass),
                'address_1' => $address1,
                'address_2' => $address2,
                'city' => $city,
                'postal_code' => $postal_code,
                'country' => $country,
                'security_question' => $sec_question,
                'security_answer' => $sec_answer,
                'role' => "Author",
                'deleted' => 0,
                'banned' => 1);


            $insert_id = $this->user->insertData("user", $DataSet);
            if ($insert_id > 0) {
                redirect('/login');
                //Todo; send email
            } else {
                $error = array('error' => "Error in InsertData");
                $this->load->view('register_author', $error);
            }
        } else {
            $error = array('error' => "Password mis match!");
            $this->load->view('register_author', $error);
        }
    }

    // Forgot Password Area
    public function forgot_pass()
    {
        $this->load->view("forgot_password");
    }

    public function forgot_pw()
    {
        $this->form_validation->set_rules('username', 'Email', 'required|valid_email|is_unique[user.email_address]');
        $email = $this->input->post('username');
        $id_email = $this->user->is_User($email);
        if (isset($id_email)) {
            $url = "http://localhost/JMS-V1/index.php/users/reset_password/" . $id_email->email_address . "/";
            echo $url;
//            echo $id_email->id." ".$id_email->email_address;
        } else {
            $this->load->view("forgot_password");
        }
    }

    public function reset_password($email)
    {
        $data["emails"] = array("email" => $email);
        $this->load->view("password_reset", $data);
    }

    public function reset()
    {
        $this->form_validation->set_rules('username', 'Email', 'required|valid_email|is_unique[user.email_address]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|sha1');
        $this->form_validation->set_rules('repassword', 'Password', 'trim|required|sha1');
        $email = $this->input->post('username');
        $pass = $this->input->post('password');
        $pass2 = $this->input->post('repassword');

        if ($pass == $pass2) {
            $this->user->reset_pw($email, $pass);
        } else {
            $url = "http://localhost/JMS-V1/index.php/users/reset_password/" . $email . "/";
            redirect($url);
        }
    }

}
