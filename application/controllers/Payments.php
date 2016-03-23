<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Payments extends MY_Controller {

	
	 
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
		$this->load->library('Ajax_pagination');
		//$this -> load -> library('form_validation');
		//$this -> load -> model('StudentModel');
		$this -> load -> model('PaymentModel');
		$this -> load -> model('StudentModel');
		//$this->load->helper(array('form','url','html','form'));
        //$this->load->library(array('session', 'form_validation', 'email' ,'ion_auth'));
		$this->load->library("pagination");
		$this->perPage = 4;
		}
	 
	public function index()
	{
		$this->data = array('content'=>'Payments/DoPayments');
		$this->data['paymentsCategories'] = $this->PaymentModel->getPaymentRows();
		$this->data['students'] = $this->StudentModel->getStudentsForPayment();
		
		//$this->load->view('masterView', $this->data);
		
		$totalRec = count($this->PaymentModel->getRows());
        
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = base_url().'index.php/Payments/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = 10;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $this->data['payments'] = $this->PaymentModel->getRows(array('limit'=>$this->perPage));
		
		 $this->loadView('Payments/payments_view', $this->data);
		//$this->load->view('Payments/payments_view', $this->data);
	}
		

    public function createPayments(){
	     
		  $this->data['payments'] = $this->PaymentModel->getPaymentRows();
		  $this->data['paymentsTypes'] = $this->PaymentModel->getPaymentsTypes();
		 
		 $this->load->library('form_validation');
		 $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		 $this->form_validation->set_rules('paymentname', 'Name', 'required|min_length[5]|max_length[15]');
		// $this->form_validation->set_rules('paymentfrequancy', 'Frequancy', 'required');
		 if ($this->form_validation->run() == FALSE) {
				$this->loadView('Payments/createPaymentsView', $this->data);
		} else{
		
		$paymentname = $this->input->post('paymentname');
	echo 	$paymentType = $this->input->post('paymentType');
		$description = $this->input->post('description');
		$amount = $this->input->post('amount');
		$paymentType = $this->input->post('paymentType');
		
		$data = array(
			'paymentname'   =>  $paymentname,
			'type'   =>  $paymentType,
			'description'   =>  $description,
			'amount' => $amount
			);
		
		
		
		if($this->PaymentModel->registerNewPaymentCatagory($data)!=null){
				$this->session->set_flashdata('flashSuccess', 'Payment Created!');
				redirect('Payments/createPayments' );
				}else{
				//echo $this->StudentModel->addnewStudents($data);
				$this->session->set_flashdata('flashDanger','Error OCcured, Try again');
				redirect('Payments/createPayments' );
			} 
		
		}
		
    }
		
	
	
	
	
	
	public    function edit($id){
       
        $this->data['payment'] = $this->PaymentModel->getSinglePayment($id)->row();
       $this->loadView('Payments/editPaymentsView', $this->data);
    }
		
    public function updatePayments(){
	
			$id = $this->input->post('id');
			//echo $id;
            $payment = array(
			'paymentcategoryid' => $this->input->post('id'),
			'paymentname' => $this->input->post('paymentname'),
             'paymentfrequancy' => $this->input->post('paymentfrequancy'),
            'description' => $this->input->post('description'),
			'amount' => $this->input->post('amount')
		     
			);
            $this->PaymentModel->update($id,$payment);
			
			redirect('Payments/createPayments');
		}
	
	 public function delete(){
	        $id = $this->uri->segment(3);
			//$id = $this->input->post('id');
			
            $this->PaymentModel->deletePayment($id);
			
			redirect('Payments/SearchPayments');
		} 
	
	
	
	public function otherPaymentsView()
	{
		$this->data = array('content'=>'Payments/DoPayments');
		$this->data['paymentsCategories'] = $this->PaymentModel->getPaymentRows();
		$this->data['students'] = $this->StudentModel->getStudentsForPayment();
		//$this->load->view('masterView', $this->data);
		
		$totalRec = count($this->PaymentModel->getRows());
        
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = base_url().'index.php/Payments/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = 10;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $this->data['payments'] = $this->PaymentModel->getRows(array('limit'=>$this->perPage));
		
		 $this->loadView('Payments/otherPaymentsView', $this->data);
		//$this->load->view('Payments/payments_view', $this->data);
		}
	
	
	public function doOtherPayments(){
    echo	$studentId = $this->input->post('studentname');
	echo	$paymentCatagoryId =	$this->input->post('paymentCatagoryId');
	echo	$amount  = $this->input->post('amount');
	echo	$notes  = $this->input->post('notes');
		// get the current user 
	echo	$userId = $this->ion_auth->user()->row()->id;
	echo	$date = date("Y/m/d");
	echo	$time = date("h:i:sa");
	//	echo $studentId;
		$payment = array(
			'studentId' => $studentId,
			'paymentCatagoryId' => $paymentCatagoryId,
             'amount' => $amount,
            'notes' => $notes,
		      'officer' => $userId,
			   'date' => $date,
			    'time' => $time
			  
			);
		  $paymentId = $this->PaymentModel->doPayments($payment);
		  
		if(!$paymentId=null){
		
		 $this->data['student'] = $this->StudentModel->getSingleStudent2($studentId)->row();
		$this->data['payments'] = $this->PaymentModel->getPayment($paymentId);
		
		
		// $this->loadView('Payments/Recipt', $this->data, false);
		//echo 'SUCCESS';	
		$this->session->set_flashdata('flashSuccess', 'Payment Success');
		redirect('Payments/otherPaymentsView');		
		}else{
		
		//echo 'FAILED';
		$this->session->set_flashdata('flashFail', 'Payment  Failed, Try Again');
		redirect('Payments/otherPaymentsView');			
		} 
		
		
	  
		}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function doPayments(){
    	$studentId = $this->input->post('studentname');
		$paymentCatagoryId =	$this->input->post('paymentCatagoryId');
		$amount  = $this->input->post('amount');
		$notes  = $this->input->post('notes');
		// get the current user 
		$userId = $this->ion_auth->user()->row()->id;
		$date = date("Y/m/d");
		$time = date("h:i:sa");
	//	echo $studentId;
		$payment = array(
			'studentId' => $studentId,
			'paymentCatagoryId' => $paymentCatagoryId,
             'amount' => $amount,
            'notes' => $notes,
		      'officer' => $userId,
			   'date' => $date,
			    'time' => $time
			  
			);
		  $paymentId = $this->PaymentModel->doPayments($payment);
		  
		if(!$paymentId=null){
		
		 $this->data['student'] = $this->StudentModel->getSingleStudent2($studentId)->row();
		$this->data['payments'] = $this->PaymentModel->getPayment($paymentId);
		
		
		 $this->loadView('Payments/Recipt', $this->data, false);
		//echo 'SUCCESS';	
		//$this->session->set_flashdata('flashSuccess', 'Student Registration Success');
				
		}else{
		
		echo 'FAILED';
		//$this->session->set_flashdata('flashFail', 'Payment Made Success');
				
		} 
		
		
	  
		}
		
		
		
		
		// Pyamnt history
		public    function GetStudentPaymentDetails(){
         
		 $studentId = $this->input->post('studentId');
		 
        $data = $this->PaymentModel->GetPaymentOfStudent($studentId);
		
       // $this->loadView('student_view', $this->data);
	  echo json_encode ($data) ;
    }
		
	
	
	public function SearchPayments()
    {
       $search=  $this->input->post('search');
       
        $totalRec = count($this->PaymentModel->getRows());
        
        //pagination configuration
        $config['first_link']  = 'First';
       // $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = base_url().'index.php/payments/ajaxGetPaymentSearch';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $this->data['payments'] = $this->PaymentModel->getRows(array('limit'=>$this->perPage));
        
        //load the view
      $this->loadView('payments/SearchPayment', $this->data);
	   
    }
	
		
	function ajaxGetPaymentSearch()
    {
        $search=  $this->input->post('search');
       // $totalRec = count($this->PaymentModel->getRows());
       // $config['first_link']  = 'First';
       // $config['div']         = 'postList'; //parent div tag id
      //  $config['base_url']    = base_url().'index.php/payments/ajaxGetPaymentSearch';
       // $config['total_rows']  = $totalRec;
      //  $config['per_page']    = $this->perPage;
        
       // $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $this->data['payments'] = $this->PaymentModel->getPayment($search);
       // $this->data['payments'] = $this->PaymentModel->getRows(array('limit'=>$this->perPage)); 
        //load the view
        $this->load->view('Payments/ajax-pagination-search-payment', $this->data, false);
	   //echo json_encode ($data) ;
    }	
		
		
		
	
   
 }
		