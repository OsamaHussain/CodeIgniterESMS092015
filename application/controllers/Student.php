<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	
	class Student extends MY_Controller {
		
		   function __construct() {
			parent::__construct();
			if (!$this->ion_auth->logged_in())
			{
				// redirect them to the login page
				redirect('auth/login', 'refresh');
			}
			$this->load->library('Ajax_pagination');
			$this->load->database();
			$this->load->library("pagination");
			$this -> load -> model('StudentModel');
			$this -> load -> model('CourseModel');
			$this->load->helper(array('form','url','html'));
			$this->load->library(array('session', 'form_validation', 'email'));
			$this->perPage = 10;
		}
		
		
		public function index()
		{
		
		
		$this->data['registernumber'] = $this->StudentModel->getNextRegisterNumber();	
		
		$this->loadView('student_add', $this->data);		
		}
		

		public function registerStudent()
		{   
		   $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//$this->form_validation->set_rules('registernumber', 'Register Number', '|required|min_length[5]|max_length[20]|numeric', array('numeric' => 'Insert A numeric vlaue'));
			$this->form_validation->set_rules('studentname', 'Student Name', 'trim|required|min_length[5]|max_length[20]|alpha');
			$this->form_validation->set_rules('parentname', 'Parent Name', 'trim|required|min_length[2]|max_length[20]|alpha');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[20]');
			$this->form_validation->set_rules('phonenumber', 'Phone Number', 'numeric|required|min_length[10]|max_length[10]');
			
			//$this->StudentModel->getNextRegisterNumber();
			
			
			 if ($this->form_validation->run() == FALSE) {
				$this->data['registernumber'] = $this->StudentModel->getNextRegisterNumber();	
				 $this->loadView('student_add', $this->data);
			} 
			
			else {
			
			$registernumber = $this->StudentModel->getNextRegisterNumber();	
			//$registernumber = $this->input->post('registernumber');
			$studentname = $this->input->post('studentname');
			$parentname = $this->input->post('parentname');
			$address = $this->input->post('address');
			$phonenumber = $this->input->post('phonenumber');
			//$$classeType = $this->input->post('$classeType');
			
			$data2 = array(
			//'id'  =>  $registernumber,
			'name'   =>  $studentname,
			'parentname'   =>  $parentname,
			'address'   =>  $address,
			'phonenumber'   =>  $phonenumber
			// 'classeType'   =>  $$classeType
			);
					if($this->StudentModel->addnewStudents($data2)!=null){
						$this->session->set_flashdata('flashSuccess', 'Student Registration Success');
						redirect('Student' );
					}else{
						//echo $this->StudentModel->addnewStudents($data);
						$this->session->set_flashdata('flashDanger','Student Registration Fail');
					}
			
			}
			
			
			
			
			
			
		}
		
		
		
		
		
		public function getStudentByName()
		{
			$text = $this->input->post('vlaue');
			
			if($rows = $this->StudentModel->getStudentByName($text)){
				header('Content-type : application/jason');
				echo json_encode($rows);
				}else {
				$data = false;
			}
			
		}
		
		
		public function registerForCourseView()
		
		{
			$this->data = array('content'=>'RegisterForCourse');
			//$this->session->set_flashdata('msg', 'Category added');
			//	$data['courses'] = $this->coursemodel-> getAllCourses();
			//$this->load->view('header');	
			$this->load->view('masterView', $this->data);
			//$this->load->view('RegisterForCourse',$data);   
			//$this->load->view('footer');
			//echo "Hello!";
		}
		
		
		public function registerForCourse()
		{
			//$this->data = array('content'=>'RegisterForCourse');	
			$courseid =  $this->input->post('course');
			$studentidid =  $this->input->post('student');
			$array = array(
			'studentid' => $studentidid,
			'courseid' => $courseid,
			);
			
			if ($this->CourseModel->isRegisteredForTheCourse($studentidid,$courseid)==FALSE) {
				$this->CourseModel->registerForCourse($array);
				$this->session->set_flashdata('message',"<div style='color:GREEN;'> REGISTRATION SUCCESS .<div>");
				//$this->load->view('masterView', $this->data);
				redirect('/' );
				} else {
				$this->session->set_flashdata('message',"<div style='color:RED;'> ALREADY REGISTERED .<div>");
				//$this->load->view('masterView', $this->data);
				redirect('/' );
			}
			
			
			
		}
		
		public function searchStudent(){
			$search=  $this->input->post('search');
			$query = $this->StudentModel->getStudent($search);
			header('Content-type : application/jason');
			echo json_encode($query);
			//echo json_encode ($query);
		}
		
		public function searchStudentByRegNumber(){
			$search=  $this->input->post('search');
			$query = $this->StudentModel->getStudentByRegNumber($search);
			//header('Content-type : application/jason');
			//	  echo json_encode($query);
			
			
			
			$arr = array();
			foreach ($query as $q) {
				$arr[] = $g;
			}
			print json_encode($arr);
			
			
			
		}
		
		
		
		
		
	
        

    
		
	function get_all_studens(){
	//	$data = null;
	//	$query_s = $this -> StudentModel -> get_student_list();
		
	/* 	if ($query_s -> num_rows() > 0) {
            $data['students'] = $query_s -> result();
			foreach ($data['students'] as $student) {
			  	
				echo $student->name;
				echo '<br>';
				       
			}
        }
		
		}	
		 */
	return 	$this -> StudentModel -> get_student_list();
	}
	
	
/* 	
	public function ajax_search()
	{
		$search=  $this->input->post('search');
		$query = $this->StudentModel->getStudentAjax($search);
		echo json_encode ($query);
	}
	
 */	
 
 
 
	public function search_student()
    {
	
        $totalRec = count($this->StudentModel->getRows());
        
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = base_url().'index.php/Student/ajaxGetStudentSearch';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $this->data['students'] = $this->StudentModel->getRows(array('limit'=>$this->perPage));
		//print_r($this->data['students']);
        
        //load the view
        $this->loadView('student_search', $this->data);
    }
    
	
	
    function ajaxGetStudentSearch()
    {
        $page=  $this->input->post('page');
       // if(!$page){
       //     $offset = 0;
       // }else{
            $offset = $page;
      //  }
        
        //total rows count
        $totalRec = count($this->StudentModel->getRows());
        
        //pagination configuration
        $config['first_link']  = 'First';
       // $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = base_url().'index.php/student/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['students'] = $this->StudentModel->getRows(array('start'=>$offset,'limit'=>$this->perPage));
        
        //load the view
        $this->load->view('ajax-pagination-data', $data, false);
    }
	
	 
	
  	function ajaxGetStudentSearch2()
    {
        $search=  $this->input->post('search');
        $totalRec = count($this->StudentModel->getRows());
        $config['first_link']  = 'First';
       // $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = base_url().'index.php/Student/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['students'] = $this->StudentModel->getStudent($search);
        
        //load the view
        $this->load->view('ajax-pagination-data', $data, false);
    }
	
	
	function ajaxGetStudentSearch3()
    {
        $search=  $this->input->post('search');
        $totalRec = count($this->StudentModel->getRows());
        $config['first_link']  = 'First';
       // $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = base_url().'index.php/Student/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['students'] = $this->StudentModel->getStudent($search);
        
        //load the view
		//echo '<option >jgfjgdfgfg </option>';
		                foreach ($data['students'] as $student) {
							echo    '<option value=';
							 echo $student->id;  
							echo '>';
							 echo $student->name;
							echo '</option>';
						}
									
		
       // $this->load->view('ajax-pagination-data', $data, false);
		}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function ajaxGetStudentSearchForPayment()
    {
		$search=  $this->input->post('search');
        //$totalRec = count($this->StudentModel->getRows());
		/* if($students = $this->StudentModel->getStudentForPayment($search)){
			header('Content-type : application/jason');
			  echo json_encode($students);
			} else{
			$data = false;
			} */
        $data['student'] = $this->StudentModel->getStudentForPayment($search);
		//$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);
		
		
        
    }
	

	
	public    function edit($id){
       
        $this->data['student'] = $this->StudentModel->getSingleStudent2($id)->row();
        $this->loadView('student_view', $this->data);
    }
	
	
	public function update(){
	
	        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//$this->form_validation->set_rules('registernumber', 'Register Number', '|required|min_length[5]|max_length[20]|numeric', array('numeric' => 'Insert A numeric vlaue'));
			$this->form_validation->set_rules('studentname', 'Student Name', 'trim|required|min_length[5]|max_length[20]|alpha');
			$this->form_validation->set_rules('parentname', 'Parent Name', 'trim|required|min_length[5]|max_length[20]|alpha');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[20]|alpha');
			$this->form_validation->set_rules('phonenumber', 'Phone Number', 'numeric|required|min_length[10]|max_length[10]');
			
			//$this->StudentModel->getNextRegisterNumber();
			
			
			// if ($this->form_validation->run() == FALSE) {
			//	$id = $this->input->post('id');
			//   $this->data['student'] = $this->StudentModel->getSingleStudent2($id)->row();
				//$this->data['registernumber'] = $this->StudentModel->getNextRegisterNumber();
				 //$this->data['student'] = $this->StudentModel->getSingleStudent2($id)->row();
			//	 $this->loadView('student_view', $this->data);
			//} else {
			
			
			try {
				
				$id = $this->input->post('id');
				//echo $id;
				$student = array(
				'name' => $this->input->post('name'),
				'parentname' => $this->input->post('parentname'),
					'address' => $this->input->post('address'),
				'phonenumber' => $this->input->post('phonenumber')
				);
				$this->StudentModel->update($id,$student);
			
				redirect('Student/search_student');
				
				} catch (Exception $e) {
				//alert the user then kill the process
					var_dump($e->getMessage());
				}
			
			
			
				
		//	}
			
			
			
	
			
		}
	
	
	
	 public function remove(){
	        $id = $this->uri->segment(3);
			//$id = $this->input->post('id');
			
            $this->StudentModel->remove($id);
			
			redirect('Student/search_student');
		} 
	
	public function removeAjax($id){
	    
	    $this->StudentModel->remove($id);
        if($this->StudentModel->remove($id))
	    redirect('Student/search_student')  ;   
  
		}
	
	
	public function upload_file()
{
    $status = "";
    $msg = "";
    $file_element_name = 'userfile';
     
    if (empty($_POST['title']))
    {
        $status = "error";
        $msg = "Please enter a title";
    }
     
    if ($status != "error")
    {
        $config['upload_path'] = './files/';
        $config['allowed_types'] = 'gif|jpg|png|doc|txt';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
 
        $this->load->library('upload', $config);
 
        if (!$this->upload->do_upload($file_element_name))
        {
            $status = 'error';
            $msg = $this->upload->display_errors('', '');
        }
        else
        {
            $data = $this->upload->data();
            $file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
            if($file_id)
            {
                $status = "success";
                $msg = "File successfully uploaded";
            }
            else
            {
                unlink($data['full_path']);
                $status = "error";
                $msg = "Something went wrong when saving the file, please try again.";
            }
        }
        @unlink($_FILES[$file_element_name]);
    }
    echo json_encode(array('status' => $status, 'msg' => $msg));
}
	
	
	//http://localhost/CodeIgniter3Tests/uploads/profileimages/1001.jpg
	
	
	
	public function uploadProfileImage(){
		//$this->load->view('file_view', array('error' => ' ' ));
		$this->data['students'] = $this->StudentModel->getStudentsForPayment();
		$this->loadView('file_view', $this->data);
		

	}
	
	public function getProfileImage(){
	     $studentId = $this->input->get('studentId');
		 $this->data['student'] = $this->StudentModel->getProfileImageName($studentId);
		 if(!$student=null){
		  echo $student->imagename;
			 } else {
			   echo 'No Images Found';
			 }
		
		 //echo $studentId;
	    // echo base_url().'uploads/profileimages/'.$row->imagename;
		 
	
		}
	
	
public function do_upload(){
$config = array(
'upload_path' => "./uploads/profileimages/",
'allowed_types' => "gif|jpg|png|jpeg|pdf",
'overwrite' => TRUE,
'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
'max_height' => "768",
'max_width' => "1024"
);
$this->load->library('upload', $config);
if($this->upload->do_upload())
{
$data = array('upload_data' => $this->upload->data());
$this->load->view('message',$data);
}
else
{
$error = array('error' => $this->upload->display_errors());
$this->load->view('message', $error);
}
}	
	

	
	
	
	
	public function getStudentRegisteredCourseAjax(){
		$this->load->view('tess');
		}
	
	
	
	
	
	}
		