<?php
Class Hellosess extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("Final_Modelsess");
		$this->load->library("session");//session start
	}
	function savedata()
	{	
		$this->load->view("forminsertsess");
		if($this->input->post("submit")) 
		{
			$name= $this->input->post("name");
			$email=$this->input->post("email");
			$address=$this->input->post("address");
			$pass=md5($this->input->post("password"));
			$phn=$this->input->post("phone");
			$gender=$this->input->post("gender");
			$degree=$this->input->post("degree");
			$language=implode(",",$this->input->post("language"));
			$filename= $_FILES["uploadimage"]["name"];
			$tmpname=$_FILES["uploadimage"]["tmp_name"];
			$folder="image/".$filename;
			move_uploaded_file($tmpname,$folder);
			//echo $name,$email,$address,$pass,$phn,$gender,$degree,$language,$folder;
			if($this->Final_Modelsess->saverecords($name,$email,$address,$pass,$phn,$gender,$degree,$language,$folder))
			{
				//echo "Insert data successful";
				//redirect("HelloSess/logindata");
				redirect("HelloSess/dispdata");
			}
			else
			{
				echo "not inserted";
			}
		}
	}
	function dispdata() 
	{
		$id=$_SESSION["email"];
		$result['data']= $this->Final_Modelsess->disprecords($id);
		//print_r($result);
		$this->load->view("displaysess",$result);
	}
	function logindata()
	{
		$this->load->view("loginsess");
		if($this->input->post("submit")) 
		{
			
			$_SESSION["email"]=$this->input->post("email");
			$pass=md5($this->input->post("password"));
			if($this->Final_Modelsess->loginrecords($_SESSION["email"],$pass))
			{
				//echo "login successful";
				redirect("Hellosess/dispdata");
			}
			else
			{
				echo "login failure";
			}
		}
	}
	function editdata()
	{
		$id= $this->input->get("ep");
		//echo $id;
		$result['data']= $this->Final_Modelsess->updaterecordsbyid($id);
		//print_r($result);
		$this->load->view("editsess",$result);
		if($this->input->post("submit")) 
		{
			$name= $this->input->post("name");
			$email=$this->input->post("email");
			$address=$this->input->post("address");
			$phn=$this->input->post("phone");
			$gender=$this->input->post("gender");
			$degree=$this->input->post("degree");
			$language=implode(",",$this->input->post("language"));
			$filename= $_FILES["uploadimage"]["name"];
			$tmpname=$_FILES["uploadimage"]["tmp_name"];
			$folder="image/".$filename;
			move_uploaded_file($tmpname,$folder);


			//echo $name,$email,$address,$phn,$gender,$degree,$language,$folder;
			if($this->Final_Modelsess->updaterecords($name,$email,$address,$phn,$gender,$degree,$language,$folder,$id))
			{
				//echo "Update data successful";
				redirect("Hellosess/dispdata");
			}
			else
			{
				echo "not updated";
			}
		}
	}
	
	function logoutdata()
	{
		session_unset();
		redirect("Hellosess/logindata");
	}
}
?>