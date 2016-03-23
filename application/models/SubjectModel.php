<?php

class SubjectModel extends CI_Model {
	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	public function createNewSubject($data) {
		if ($this -> db -> insert('subjects', $data)) {
			return TRUE;
		}

	}
	
	
	function getRowSubjects(){
		
		$this->db->select('*');
        $this->db->from('subjects');
        $query = $this->db->get();
        
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
		
		}
	public function getSingleSubject($id = null) {
	    $this->db->where('id', $id);
	 return $this->db->get('subjects');
	}	
		
	function update($id, $data) {
		$this -> db -> where('id', $id);
		$this -> db -> update('subjects', $data);
	}

	function delete($id) {
		$this -> db -> where('id', $id);
		$this -> db -> delete('subjects');
	}	
		
		
		
	function getCourseRelatedSubjects()
    {
        $this->db->select('course_subjects.*, course.cousrecode as cousrecode,course.name as cname,subjects.name as sname, subjects.code as scode');
         $this->db->from('course_subjects as course_subjects')
		 ->join('course as course','course.id = course_subjects.courseId','left')
		  ->join('subjects as subjects','subjects.id = course_subjects.subjectId','left')
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
		
		
	function registerSubjectsForCourse($data){
		
		$this -> db -> insert('course_subjects', $data);
		
		}	
		
		
	function deleteCoursesubject($id) {
		$this -> db -> where('id', $id);
		$this -> db -> delete('course_subjects');
	}	
		
		
		
		
		
		
		
		
		
		
		
		
	
}
