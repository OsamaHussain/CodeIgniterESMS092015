<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Course extends MY_Controller {

	
	 
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
		$this -> load -> model('StudentModel');
		$this -> load -> model('CourseModel');
		$this -> load -> model('PaymentModel');
		//$this->load->helper(array('form','url','html','form'));
        //$this->load->library(array('session', 'form_validation', 'email' ,'ion_auth'));
		}
	 
	public function index()
	{
		$this->data = array('content'=>'Course/RegisterCourseView');
		$this->data['courses'] = $this->CourseModel->getAllCourses();
		
		$this->data['onetimepayments'] = $this->PaymentModel->getOneTimePaymentRows();
		//$this->load->view('masterView', $this->data);
		 $this->loadView('Course/RegisterCourseView', $this->data);
		
	}
		


   public function registerNewCourse()
   {
   
   // foreach ($this->data['onetimepayments'] as $onetimepayment) {
    //  $this->data['onetimepaymentsSelected']  = $this->input->post($onetimepayment->paymentcategoryid);
	//	}
   
        $coursename = $this->input->post('coursename');
    	$description = $this->input->post('description');
		//$paymentname = $this->input->post('paymentname');
		$cousrecode = $this->input->post('cousrecode');
		
		
		
		 $data = array(
        'name'  =>  $coursename,
        'description'   =>  $description,
		'cousrecode' => $cousrecode
         );
		 if($this->CourseModel->registerNewCourse($data)==TRUE){
		   
		 
		   
		 	$this->session->set_flashdata('message',"<div style='color:green;'> COURSE REGISTRATION SUCCESS .<div>");
		//$this->data = array('content'=>'Course/RegisterCourseView');
		//$this->load->view('masterView', $this->data);
		redirect('Course');
		}else {
			//echo $this->StudentModel->addnewStudents($data);
		   $this->session->set_flashdata('message',"<div style='color:red;'> COURSE REGISTRATION SUCCESS .<div>");
		}
		
   }
   
   
   public function editCourse($id)
   {
   	    $this->data = array('content'=>'Course/CourseUpateView');
   	    $id = $this->uri->segment(3);
		//echo $id;
		$this->data['course'] = $this->CourseModel->getSingleCourse($id)->row();	
		//echo $this->CourseModel->getCourseById($id);
        $this->data['courses'] = $this->CourseModel->getAllCourses();
		 $this->loadView('Course/CourseUpateView', $this->data);
		//$this->load->view('masterView', $this->data);
   }
   
   
   public function updateCourse()
   {
    	$id= $this->input->post('id');
		//echo $id;
		$data = array(
		'name' => $this->input->post('name'),
		'description'=> $this->input->post('description'),
		'cousrecode'=> $this->input->post('cousrecode')
		
		);
		$this->CourseModel->updateCourse($id,$data);
		redirect('Course');
   }
   
  public function deleteCourse() {
	$id = $this->uri->segment(3);
	$this->CourseModel->deleteCourse($id);
	redirect('Course');
	}
   
   
    public function deleteCoursePayments() {
	$id = $this->uri->segment(3);
	$this->CourseModel->deleteCoursePayments($id);
	redirect('Course/addCoursePaymentsView');
	}
   
   
   
    public function deleteStudentCourseRegistration() {
	$id = $this->uri->segment(3);
	$this->CourseModel->deleteStudentCourseRegistration($id);
	redirect('Course/registerStudentView');
	}
     
   
   public  function addCoursePaymentsView(){
   // $this->data['onetimepayments'] = $this->PaymentModel->getOneTimePaymentRows();
    $this->data['payments'] = $this->PaymentModel->getPaymentRows2();
	 $this->data['courses'] = $this->CourseModel->getAllCourses();	
	 $this->data['coursePaymentsDetails'] = $this->CourseModel->getCourseRelatedPayments();	 
	 
	$this->loadView('Course/addCoursePayments', $this->data);
	}
	
	
	
	
    public  function addCoursePayments(){
   // $this->data['onetimepayments'] = $this->PaymentModel->getOneTimePaymentRows();
    
			$courseId = $this->input->post('courseId');
			$onetimepaymentId = $this->input->post('onetimepaymentId');
			$paymentId = $this->input->post('paymentId');
	
	
	$data2 = array(
        'courseId'  =>   $courseId,
      	'paymentId' => $paymentId
         );
	
	
	if($paymentId){
		if($this->CourseModel->addCoursePayments($data2)){
		$this->session->set_flashdata('flashSuccess', 'Payments Added');
			}
		
		}
		
	$data3 = array(
        'courseId'  =>   $courseId,
      	'paymentId' => $onetimepaymentId
         );
		 
	if($onetimepaymentId){
	
		if($this->CourseModel->addCoursePayments($data3)){
		$this->session->set_flashdata('flashSuccess', 'Payments Added');
			}
		}
		
	
	
	redirect('Course/addCoursePaymentsView');
	}
   
   
    public function registerStudentView(){
		$this->data['courses'] = $this->CourseModel->getAllCourses();
		$this->data['students'] = $this->StudentModel->getRows();
		$this->data['studentscourse'] = $this->CourseModel->getCourseRegistrationOfStudents();
		$this->loadView('Course/registerStudentView', $this->data);
		
		
		}
   
   
   
   public function registerStudent(){
		$courseId = $this->input->post('courseId');
		$studentId = $this->input->post('studentId');
	echo	$joindateDay = $this->input->post('joindateDay');
		$data5 = array(
        'courseId'  =>   $courseId,
      	'studentId' => $studentId,
		'joinMonth' => $joindateDay
		
         );
		
		$this->CourseModel->registerStudentsForCourse($data5);
		
		redirect('Course/registerStudentView');
		
		}
   
   
   public function studentCoursePaymentsView(){
		 
		$this->data['students'] = $this->StudentModel->getRows();
		//$this->data['Course'] = $this->CourseModel->getAllCourses();
	//	$this->data['payments'] = $this->CourseModel->getAlltheCourserelatedPayments(10); 
		$date1 = '2010-01-25';
		$date2 = '2010-02-20';

		$ts1 = strtotime($date1);
		$ts2 = strtotime($date2);

		$year1 = date('Y', $ts1);
		$year2 = date('Y', $ts2);

		$month1 = date('m', $ts1);
		$month2 = date('m', $ts2);

		 $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
   
   
	   $this->loadView('Course/studentCoursePaymentsView', $this->data);
	   }
   
   
   
   public function getStudentRegisteredCourseAjax(){
		
	    $studentId =  $this->input->post('studentId');
		$this->data['coursesR'] = $this->CourseModel->getAllRegisteredCourseOfTheStudents($studentId);
		 
		$arr = array();
		foreach ($this->data['coursesR'] as $guard) {
		
		$arr[] = array(
            'cousreId'  => $guard->cousreId,
            'cname' => $guard->cname
        );
		
		
		
		//$arr[] = $guard;
        
		}
        print json_encode($arr);
		//$this->load->view('Payments/ajax-pagination-search-payment', $this->data, false);
		
      }
				
		
		
		
	 public function getCourseRelatedPaymentsAjax(){
		
	    $courseId =  $this->input->post('courseId');
		
		$this->data['payments'] = $this->CourseModel->getAlltheCourserelatedPayments($courseId);
		 
		$arr = array();
		foreach ($this->data['payments'] as $guard) {
		
		$arr[] = array(
            'paymentcategoryid'  => $guard->paymentcategoryid,
            'paymentname' => $guard->paymentname
        );
		
		
		
		//$arr[] = $guard;
        
		}
        print json_encode($arr);
		//$this->load->view('Payments/ajax-pagination-search-payment', $this->data, false);
		
      }
		
	  
	   
   
   
   
   
   
} 
		