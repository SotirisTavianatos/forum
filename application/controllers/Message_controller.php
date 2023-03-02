<?php

class Message_controller extends CI_Controller {
    public $form_validation;
    public $Usermodel;
    public $db;
    public $session;
    public $Messagemodel;
    public $email;
    public function __construct()
    {
        parent::__construct();
        //load db and model
        $this->load->database();
        $this->load->model('Messagemodel');
    }

    public function messageToDb(){//save message to db
        $data['message']=$this->input->post('message');
        $data['title']=$this->input->post('title');
        $data['user_id']=$this->session->userdata('id');
        $isdone=$this->Messagemodel->post($data);
        if($isdone){
            $this->load->view('usermenu');
            $this->load->view('newmessage');
        }
    }

	public function messagehistory($id)//load messages of user with id=$id
	{
        if ($this->session->userdata('id') === NULL)//check if user is logged in 
		{
            redirect('Users_controller/login/customer');//if not redirect to login
		}
        $data['messages'] = $this->Messagemodel->getmessages($id);
        if($id==$this->session->userdata('id'))//if true its the user trying to view his history
            $this->load->view('usermenu');
        else//if false its admin looking at the messages of a user
            $this->load->view('adminmenu');
        $this->load->view('messagehistory',$data);
	}

    public function allmessagehistory()//send all messages to view
	{
        $data['messages'] = $this->Messagemodel->getallmessages();
        $this->load->view('adminmenu');
        $this->load->view('allmessagehistory',$data);
	}

    public function allmessages()//send all messages to view
	{
        $data['messages'] = $this->Messagemodel->getallmessages();
        $this->load->view('usermenu');
        $this->load->view('allmessagehistory',$data);
	}

}