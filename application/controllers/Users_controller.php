<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_controller extends CI_Controller {
	public $session;
	public $form_validation;
	public $Usermodel;
    public $db;
    public $email;
    public function __construct()
    {
        parent::__construct();
        //load db and model
        $this->load->database();
        $this->load->model('Usermodel');
    }

    public function index(){
        $this->login("customer");
    }

    public function login($type){
        $data["user_type"] = $type;
        $this->load->view('login',$data);//load view login and send data to the view
    }

	public function userupdate(){
		if ($this->session->userdata('id') === NULL)//check if user is logged in 
		{
			$this->login("customer");//if not redirect to login
		}
		else
		{
			$this->load->view('usermenu');//if logged in load user menu with user update as the starting point
			$this->load->view('userupdate');
		} 
	}

    public function adminupdate(){
		if ($this->session->userdata('id') === NULL)//check if admin is logged in 
		{
			$this->login("admin");//if not redirect to login
		}
		else
		{
			$this->load->view('adminmenu');//if logged in load admin menu with admin update as the starting point
			$this->load->view('adminupdate');
		} 
	}

	public function logout($type){
        $this->session->sess_destroy();//close session and send user to the correct login page
        if($type=='admin')
            $this->login("admin");
        else
            $this->login("customer");
    }

    public function register(){//load register view
        $this->load->view('register');
    }

    public function validate($mode){//mode=-1 registration //mode=-2 user update //mode=-3 admin update //else mode=id of the user admin edits
        $this->form_validation->set_rules('name','Name','trim|required|min_length[5]|max_length[30]');
        $this->form_validation->set_rules('lastname','Lastname','trim|required|min_length[5]|max_length[30]');
        $this->form_validation->set_rules('password','password','trim|required|min_length[5]');
        if($mode=='-1'){//if in regstration check if email is unique and confirm password 
            $this->form_validation->set_rules('confirm_password','confirm password','trim|required|matches[password]');
            $this->form_validation->set_rules('email','email','trim|required|valid_email|is_unique[users.email]');
        }
        else{
            if($this->input->input_stream('email') != $this->session->userdata('email'))//if we update the email check that th new email isnt in the db already
                $this->form_validation->set_rules('email','email','trim|required|valid_email|is_unique[users.email]');
        }
        if($this->form_validation->run() == FALSE){//if validation fails redirect to correct page
            if($mode== '-1')
                $this->register();
            else if ($mode=='-2')
                $this->userupdate();
            else
                $this->adminupdate();
        } 
        else{//if validation doesnt fail save form into data array with the password hashed
            $data['firstname']=$this->input->post('name');
            $data['lastname']=$this->input->post('lastname');
            $data['email']=$this->input->post('email');
            $hashedpassword=password_hash($this->input->post('password'),PASSWORD_DEFAULT);
            $data['password']=$hashedpassword;
            if($mode=='-1'){//if true send to registration
                $isdone=$this->Usermodel->registration($data);
                if($isdone){
                    $this->userupdate();
                }
            }
            else{
                if($mode<0){//if we are on update mode,update userdata and then load the correct views
                    $isdone=$this->Usermodel->update($data,$this->session->userdata('id'));
                    $this->session->set_userdata($data);
                }
                else
                    $isdone=$this->Usermodel->update($data,$mode);
                if($isdone){
                    if($mode=='-2'){
                    $this->load->view('usermenu');
                    $this->load->view('userupdate');
                    $this->load->view('updated');
                    }
                    else{
                        $this->load->view('adminmenu');
                        $this->load->view('adminupdate');
                        $this->load->view('updated');
                    }
                }
            }
        } 
    }

    public function checklogin($type){//type=customer or admin
        $this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {//if validation fails redirect to login 
			$this->login($type);
		} 
        else {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$currentuser=$this->Usermodel->login($email,$password,$type);
            if($currentuser){
                $usrdata = array(
					'id' => $currentuser->id,
					'firstname' => $currentuser->firstname,
					'lastname' => $currentuser->lastname,
					'email' => $currentuser->email,
					);
			$this->session->set_userdata($usrdata);
            }
            else{
                $this->session->set_flashdata('login_error', 'Please check your email or password and try again.', 300);
                redirect(uri_string());
            }
			if($type=="customer")//redirect to correct menu
			redirect('/users_controller/userupdate'); 
            redirect('/users_controller/adminupdate');
		}		
	}

    public function customers(){
        if ($this->session->userdata('id') === NULL)//check if admin is logged in 
		{
			$this->login("admin");//if not redirect to login
		}
        $data['customers'] = $this->Usermodel->getallcustomers();//get all customers into data array and load allcustomers view
        $this->load->view('adminmenu');
        $this->load->view('allcustomers',$data);
    }

    public function deleteuser($id){
        if ($this->session->userdata('id') === NULL)//check if admin is logged in 
		{
			$this->login("admin");//if not redirect to login
		}
        $isdone=$this->Usermodel->delete($id);//delete user with id=$id and then reload views
        if($isdone){
            $data['customers'] = $this->Usermodel->getallcustomers();
            $this->load->view('adminmenu');
            $this->load->view('allcustomers',$data);
        }
    }

    public function edituser($id){//admin edits customer so we load admin menu and update the user with id=$id
        if ($this->session->userdata('id') === NULL)//check if admin is logged in 
		{
			$this->login("admin");//if not redirect to login
		}
        $this->load->view('adminmenu');
        $data['id'] = $id;
        $this->load->view('userupdate',$data);
    }

    public function newmessage(){//load views
        if ($this->session->userdata('id') === NULL)//check if user is logged in 
		{
			$this->login("customer");//if not redirect to login
		}
        $this->load->view('usermenu');
        $this->load->view('newmessage');
    }
}
