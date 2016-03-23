<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Subject extends MY_Controller {

	
	 
	  function __construct() {
		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		//$this->load->library('Datatables');
       // $this->load->library('table');
        $this->load->database();
		//$this -> load -> library('form_validation');
		$this -> load -> model('SubjectModel');
		$this -> load -> model('StudentModel');
		$this -> load -> model('CourseModel');
		$this -> load -> model('PaymentModel');
		//$this->load->helper(array('form','url','html','form'));
        //$this->load->library(array('session', 'form_validation', 'email' ,'ion_auth'));
		}
	 
	public function index()
	{
		$this->data = array('content'=>'Course/RegisterCourseView');
		$this->data['subjects'] = $this->SubjectModel->getRowSubjects();
		$this->loadView('Subject/createNewSubject', $this->data);
		
	}
		
    public function createNewSubject(){
		
		$subjectname = $this->input->post('subjectname');
		$subjectcode = $this->input->post('subjectcode');
				
		 $data = array(
        'name'  =>  $subjectname,
        'code' => $subjectcode
         );
		 if($this->SubjectModel->createNewSubject($data)==TRUE){
		$this->session->set_flashdata('flashSuccess',"Subject Added");
		redirect('Subject');
		}else {
		$this->session->set_flashdata('flashFail',"Subject Not Added");
		}
		
		}
         
		 public function edit($id)
			{
   	    $this->data = array('content'=>'Course/CourseUpateView');
   	    $id = $this->uri->segment(3);
		//echo $id;
		$this->data['subject'] = $this->SubjectModel->getSingleSubject($id)->row();	
		//echo $this->CourseModel->getCourseById($id);
       // $this->data['courses'] = $this->CourseModel->getAllCourses();
		 $this->loadView('Subject/subjectUpateView', $this->data);
		//$this->load->view('masterView', $this->data);
			}
		 
		 
		 
   
    public function update()
		{
    	$id= $this->input->post('id');
		//echo $id;
		$data = array(
		'name' => $this->input->post('subjectname'),
		'code'=> $this->input->post('subjectcode')
		);
		$this->SubjectModel->update($id,$data);
		redirect('Subject');
		}
   
	public function delete() {
		$id = $this->uri->segment(3);
		$this->SubjectModel->delete($id);
		redirect('Subject');
	}
   
   
     public function addCourseSubjectsView(){
		   $this->data['courseSubjects'] = $this->SubjectModel->getCourseRelatedSubjects();	 
		  $this->data['courses'] = $this->CourseModel->getAllCourses();	
		  $this->data['subjects'] = $this->SubjectModel->getRowSubjects();	
		  $this->loadView('Subject/addCourseSubjectsView', $this->data);
		  
		  
		 
		 }
   
   
   public function addCourseSubjects(){
	   
	   $courseId = $this->input->post('courseId');
		$subjectId = $this->input->post('subjectId');
			
	$data = array(
        'courseId'  =>   $courseId,
      	'subjectId' => $subjectId
         );
	
		if($this->SubjectModel->registerSubjectsForCourse($data))
		{
		$this->session->set_flashdata('flashSuccess', 'Course Subject  Added');
		} else
		{
		$this->session->set_flashdata('flashFail', 'Failed, Try Again');
		}
		
		redirect('Subject/addCourseSubjectsView');
	   }
   
   
   
   public function deleteCoursesubject(){
		$id = $this->uri->segment(3);
		$this->SubjectModel->deleteCoursesubject($id);
		redirect('Subject/addCourseSubjectsView');
	  }
   
   
   
   
  
   
   
   
   
   
   
   
   
   
   
   
   
 }
		