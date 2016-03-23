<?php

class CourseModel extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this -> load -> database();
	}

	public function registerNewCourse($data) {
		if ($this -> db -> insert('course', $data)) {
			return TRUE;
		}

	}
	
	
	public function addCoursePayments($data) {
		if ($this -> db -> insert('course_payments', $data)) {
			return TRUE;
			}
		else {
			return FALSE;
			}
	}
	
	
	

	public function getAllCourses() {
		$this -> db -> select('id as id, name as name ,description as description, cousrecode as cousrecode');
		$q = $this -> db -> get_where('course');
		//$this->db->order_by("name", "des");
		if ($q -> num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
				//echo $row->product_id;
			}

			return $data;
		}

		return FALSE;

	}

	public function registerForCourse($data) {
		$this -> db -> insert('courseregistration', $data);
	}
	
	
	public function registerForCoursePayments($data) {
		$this -> db -> insert('course_payments', $data);
	}

	public function getCourseById($id) {
		$this -> db -> select('*');
		$this -> db -> from('course');
		$this -> db -> where('id', $id);
		$query = $this -> db -> get();
		$result = $query -> result();
		return $result;
	}

	
	 public function getSingleCourse($id = null) {
	    $this->db->where('id', $id);
	 return $this->db->get('course');
	 }
	
	
	
	function updateCourse($id, $data) {
		$this -> db -> where('id', $id);
		$this -> db -> update('course', $data);
	}

	function deleteCourse($id) {
		$this -> db -> where('id', $id);
		$this -> db -> delete('course');
	}

	
	
	function deleteCoursePayments($id) {
		$this -> db -> where('id', $id);
		$this -> db -> delete('course_payments');
	}
	
	function deleteStudentCourseRegistration($id) {
		$this -> db -> where('id', $id);
		$this -> db -> delete('course_registrations');
	}
	
	
	
	
	function getCourse($cousre) {
		$this -> db -> select('id,name');
		$whereCondition = array('name' => $cousre);
		$this -> db -> like($whereCondition);
		$this -> db -> from('course');
		$this -> db -> limit(5);
		$query = $this -> db -> get();
		return $query -> result();
	}

	public function isRegisteredForTheCourse($studentzId, $courseId) {
		$this -> db -> select('studentid,courseid');
		$whereCondition = array('studentid' => $studentzId, 'courseid' => $courseId);
		$this -> db -> like($whereCondition);
		$this -> db -> from('courseregistration');
		$query = $this -> db -> get();
		$rowcount = $query -> num_rows();
		if ($rowcount > 0) {
			return TRUE;
		} else {
			return FALSE;
		}

	}

	function getAllTypeOfClasses() {
		$this -> db -> select('id,name');
		$this -> db -> from('classtypes');
		$query = $this -> db -> get();
		return $query -> result();
	}
    
	
	
	function getCourseRelatedPayments()
    {
        $this->db->select('course_payments.*, course.cousrecode as cousrecode,course.name as cname,paymentcatagory.paymentname as paymentname, paymentcatagory.amount as amount');
         $this->db->from('course_payments as course_payments')
		 ->join('course as course','course.id = course_payments.courseId','left')
		  ->join('paymentcatagory as paymentcatagory','paymentcatagory.paymentcategoryid = course_payments.paymentId','left')
		  ;
        
      //  $whereCondition = array('students.id' =>$id);
	  //  $this->db->like($whereCondition);
		//$this->db->or_like('phonenumber',$search);
		//$this->db->or_like('address',$search);
		//$this->db->limit(10);
		//$this->db->order_by("name", "asc");
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
	
	
	
	function registerStudentsForCourse($data){
		
		$this -> db -> insert('course_registrations', $data);
		
		}
	
	
	function getCourseRegistrationOfStudents(){
	
		 $this->db->select('course_registrations.*, course.cousrecode as cousrecode,course.name as cname, students.id as sid,students.name as sname ');
         $this->db->from('course_registrations as course_registrations')
		 ->join('course as course','course.id = course_registrations.courseId','left')
		  ->join('students as students','students.id = course_registrations.studentId','left')
		  ;
        
      //  $whereCondition = array('students.id' =>$id);
	  //  $this->db->like($whereCondition);
		//$this->db->or_like('phonenumber',$search);
		//$this->db->or_like('address',$search);
		//$this->db->limit(10);
		//$this->db->order_by("name", "asc");
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
	
	
	
	
	function getAllRegisteredCourseOfTheStudents($studentId){
		
		 $this->db->select('course.id as cousreId,course.name as cname');
         $this->db->from('course_registrations as course_registrations')
		 ->join('course as course','course.id = course_registrations.courseId','left');
		        
        $whereCondition = array('course_registrations.studentId' =>$studentId);
	    $this->db->like($whereCondition);
		$query = $this->db->get();
                
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
		
		}
	
	
	
	function getAlltheCourserelatedPayments($courseId){
		
		 $this->db->select('course_payments.*,paymentcatagory.paymentcategoryid as paymentcategoryid,paymentcatagory.paymentname as paymentname');
         $this->db->from('course_payments as course_payments')
		 ->join('paymentcatagory as paymentcatagory','paymentcatagory.paymentcategoryid = course_payments.paymentId','left');
		        
      //  $whereCondition = array('course_payments.courseId' =>$courseId);
	  //  $this->db->like($whereCondition);
		$query = $this->db->get();
                
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
		
		}
	
	
	
	
	
	
	
	
	
	
	
	
}
