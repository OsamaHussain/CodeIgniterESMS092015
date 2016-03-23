<?php

class PaymentModel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this -> load -> database();
	}

	public function registerNewPaymentCatagory($data) {
		if ($this -> db -> insert('paymentcatagory', $data)) {
			return TRUE;
		} else {
		return FALSE;
		}

	}

	function getPaymentRows($params = array())
    {
        $this->db->select('*');
        $this->db->from('paymentcatagory');
        $query = $this->db->get();
        
        
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
		
		
    }

	function getPaymentsTypes($params = array())
    {
        $this->db->select('*');
        $this->db->from('payments_type');
		//$this->db->where('paymentfrequancy', 0);
        $query = $this->db->get();
        
        
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
		
		
    }
	
	function getOneTimePaymentRows($params = array())
    {
        $this->db->select('*');
        $this->db->from('paymentcatagory');
		//$this->db->where('paymentfrequancy', 0);
        $query = $this->db->get();
        
        
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
		
		
    }

	function getPaymentRows2($params = array())
    {
        $this->db->select('*');
        $this->db->from('paymentcatagory');
		//$this->db->where('paymentfrequancy !=', 0);
        $query = $this->db->get();
        
        
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
		
		
    }


	
	 public function getSinglePayment($id = null) {
     $this->db->where('paymentcategoryid', $id);
     return $this->db->get('paymentcatagory');
  }
	
	
	
	function update($id, $data) {
		$this -> db -> where('	paymentcategoryid', $id);
		$this -> db -> update('paymentcatagory', $data);
	}

	function delete($id) {
	
		$this -> db -> where('paymentcategoryid', $id);
		$this -> db -> delete('paymentcatagory');

	}

	function deletePayment($id) {
	
		$this -> db -> where('studentspaymentid', $id);
		$this -> db -> delete('students_payments');

	}

	public function doPayments($data) {
		if ($this -> db -> insert('students_payments', $data)) {
			return  $insert_id = $this->db->insert_id();;
		} else {
		return null;
		}

	}

	
	function getStudentPayments(){
        return  $this->db->select('')
                ->from('table1 as t1')
				->where('t1.id', $id)
                ->join($this->usersTable.' as st','st.id = ht.student_id')
                ->get();
        
    }
	
	
	function getRows($params = array('limit'=>10))
    {
        $this->db->select('students_payments.*,students.*,paymentcatagory.*, users.username as user, students_payments.amount as amount, students_payments.date as pdate, students_payments.time as ptime', false);
        $this->db->from('students_payments as students_payments')
		 ->join('students as students','students.id = students_payments.studentId','left')
		  ->join('paymentcatagory as paymentcatagory','paymentcatagory.paymentcategoryid = students_payments.paymentCatagoryId','left')
		  ->join('users as users','users.id = students_payments.officer','left')
		  ;
        //$this->db->order_by('created','desc');
        
      /*   if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        } */
        $this->db->limit(10);
        $query = $this->db->get();
        
        //return ($query->num_rows() > 0)?$query->result_array():FALSE;
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
		
		
    }
	
/* 	function getPayment($search)
    {
        $this->db->select('*');
        $this->db->from('students_payments');
        
        $whereCondition = array('studentId' =>$search);
	    $this->db->like($whereCondition);
		//$this->db->or_like('phonenumber',$search);
		//$this->db->or_like('parentname',$search);
		$this->db->limit(10);
	//	$this->db->order_by("name", "asc");
	
	    
	
	
        $query = $this->db->get();
        
        //return ($query->num_rows() > 0)?$query->result_array():FALSE;
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
		
		
    }
	 */
	
	function getPayment($search)
    {
        $this->db->select('students_payments.*,students.*,paymentcatagory.*, users.username as user, students_payments.amount as amount, students_payments.date as pdate, students_payments.time as ptime', false);
        $this->db->from('students_payments as students_payments')
		 ->join('students as students','students.id = students_payments.studentId','left')
		  ->join('paymentcatagory as paymentcatagory','paymentcatagory.paymentcategoryid = students_payments.paymentCatagoryId','left')
			->join('users as users','users.id = students_payments.officer','left');
		
        
        $whereCondition = array('studentId' =>$search);
	    $this->db->like($whereCondition);
		$this->db->or_like('name',$search);
		$this->db->or_like('studentspaymentid',$search);
		$this->db->or_like('studentId',$search);
		$this->db->or_like('studentspaymentid',$search);
		//$this->db->or_like('amount',$search);
		$this->db->or_like('date',$search);
		$this->db->limit(10);
		$this->db->order_by("studentspaymentid", "asc");
	
	    
	
	
        $query = $this->db->get();
        
        //return ($query->num_rows() > 0)?$query->result_array():FALSE;
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
		
		
    }
	
	function getPaymentSingle($search)
    {
        $this->db->select('students_payments.*,students.*,paymentcatagory.*, users.username as user, students_payments.amount as amount, students_payments.date as pdate, students_payments.time as ptime', false);
        $this->db->from('students_payments as students_payments')
		 ->join('students as students','students.id = students_payments.studentId','left')
		  ->join('paymentcatagory as paymentcatagory','paymentcatagory.paymentcategoryid = students_payments.paymentCatagoryId','left')
			->join('users as users','users.id = students_payments.officer','left');
		
        
        $whereCondition = array('	studentspaymentid' =>$search);
	    $this->db->like($whereCondition);
		
	//	$this->db->order_by("name", "asc");
	
	    
	
	
        $query = $this->db->get()->row();
        
       
        return $query;
		
		
    }
	
	
	
	
	
	
	
	
	
	
	
	 function GetPaymentOfStudentw($id) {
     return $this->db->where('studentId', $id)->get('students_payments');
     
  }
	
	 function GetPaymentOfStudentrr($id) {
     return $this->db->get_where('students_payments', array('studentId' => $id))->row();
     
  }
	
	public function GetPaymentOfStudent($id){
				
		return $this->db->select('students_payments.*,students.*', false)
         ->from('students_payments as students_payments')
         ->join('students as students','students.id = students_payments.studentId','left')
		// ->join('paymentcatagory as paymentcatagory','paymentcatagory.id = students_payments.paymentCatagoryId','left')
		 ->where('students_payments.studentId', $id)
         ->get()->row();		 	
		
	}
	
	public function GetPaymentOfStudent2($id){
				
		return $this->db->select('students_payments.*,students.*,students_payments.	studentspaymentid as paymentid', false)
         ->from('students_payments as students_payments')
         ->join('students as students','students.id = students_payments.studentId','left')
		// ->join('paymentcatagory as paymentcatagory','paymentcatagory.id = students_payments.paymentCatagoryId','left')
		 ->where('students_payments.studentId', $id)
         ->get()->row();		 	
		
	}
/* 	public function GetPaymentsOfStudents($id){
				
		return $this->db->select('students_payments.*,students.*', false)
         ->from('students_payments as students_payments')
         ->join('students as students','students.id = students_payments.studentId','left')
		// ->join('paymentcatagory as paymentcatagory','paymentcatagory.id = students_payments.paymentCatagoryId','left')
		 ->where('students_payments.studentId', $id)
         ->get()->row();		 	
		
	}
	 */
	
	
	
	public function doStudentPayment($data) {
		if ($this -> db -> insert('students_payments', $data)) {
			return TRUE;
		} else {
		return FALSE;
		}

	}
	
	
	
	
	
	
	
	
	
	
	

}
