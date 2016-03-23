<script>
	$(document).ready(function(){
	$('#studentId').change( function(){ 
	
	$('select#studentId').on('change', function (e) {
		$("#coursId").empty();
		$("#paymentId").empty();
	});
		
		
		// $('#coursename').setVal(''));
		//alert($('#studentId').val());
		$.ajax({
			type: "post",
			url: "http://localhost/CodeIgniter3Tests/index.php/Course/getStudentRegisteredCourseAjax",
			cache: false,				
			data:'studentId='+$('#studentId').val(),
			success: function(response){
							
				 var appenddata = "";
				appenddata = "<option value = ''> " +  " </option>";  
				$.each(JSON.parse(response), function (key, value) {
				appenddata += "<option value = '" + value.cousreId + " '>" + value.cname + " </option>";                        
				});
			$('#coursId').html(appenddata);
			
			},
			error: function(){						
				alert('Error while request..');
			}
		});
		
		
	} );
	
	
	
	
		$('#coursId').change(function(){ 
	    
	$.ajax({
			type: "post",
			url: "http://localhost/CodeIgniter3Tests/index.php/Course/getCourseRelatedPaymentsAjax",
			cache: false,				
			data:'courseId='+$('select#courseId').val(),
			success: function(response){
							
				 var appenddata = "";
				$.each(JSON.parse(response), function (key, value) {
				appenddata += "<option value = '" + value.paymentcategoryid + " '>" + value.paymentname + " </option>";                        
				});
			$('#paymentId').html(appenddata);
			
			},
			error: function(){						
				alert('Error while request..');
			}
		});
		
		
	} );
	
	
	
	
	
	
	});
	
	
	
</script>    
	


	
	
	
	
	
	
	
	
	
	
	
	
	
	
 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Course
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="col-md-8">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Hi !</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" title="Collapse"></button>
                <button class="btn btn-box-tool" title="Remove"></button>
              </div>
            </div>
            <div class="box-body">
	
	
	<?php if ($this->session->flashdata('flashSuccess')) { ?>
						<div id='alert alert-warning'  class="alert alert-info"> <?= $this->session->flashdata('flashSuccess') ?> </div>
						<?php } ?>	
      
						<?php if ($this->session->flashdata('flashFail')) { ?>
						<div id='alert alert-warning'  class="alert-alert-warning"> <?= $this->session->flashdata('flashFail') ?> </div>
						<?php } ?>	
	
 
	<?php $attributes = array("name" => "addCoursePayments");
            echo form_open("Course/addCoursePayments")?>
     
	  <div class="form-group">
			<label>Select Student</label>
			
							<select class="form-control" name="studentId" id="studentId" required >
	                        <option > <?php echo 'Select Student'; ?></option>
							<?php foreach($students as $student): ?>
							<option value=<?php echo $student->id;  ?> > <?php echo $student->name; ?></option>
							<?php endforeach; ?>
                                              
							</select>
	</div>
	 
	 
	 
	 
	 
	  <div class="form-group">
			<label>Select Course</label>
							
							<select class="form-control" name="courseId" id="coursId" required >
	                         <option > <?php echo 'Select Course'; ?></option>   
							 <?php foreach($Course as $student): ?>
							<option value=<?php echo $student->id;  ?> > <?php echo $student->name; ?></option>
							<?php endforeach; ?>
							</select>
	</div>
	 
	  
	  <!--div class="form-group">
	  <label>One Time Payments</label> 
	  
	  <select class="form-control" name="onetimepaymentId" id="onetimepaymentId">
	                        <option value= ''> <?php echo 'No Payment'; ?></option>
							
                                              
							</select>
	       
       </div-->
	 
	  
	 
	 <div class="form-group">
			<label>Payments</label>
							<select class="form-control" name="paymentId" id="paymentId" >
	                        <option > <?php echo 'Select Payment'; ?></option> 
							
                             <?php foreach($payments as $payment): ?>
							<option value=<?php echo $payment->paymentcategoryid;  ?> > <?php echo $payment->paymentname; ?></option>
							<?php endforeach; ?>
														
							</select>
	</div>
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	   
				
     
       
	   
	   
			
	   
      
      
       <div class="form-group">
                
      <input name="submit" type="submit" class="btn btn-primary" value="Send" />
      <button type="reset" class="btn btn-primary">Reset</button>
           
      </div>
             
    <?php echo form_close(); ?>

            </div><!-- /.box-body -->
           
          </div><!-- /.box -->
  </div><!-- /.box -->
        </section><!-- /.content -->


		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	 <section class="content">	
  <div class="col-md-8">		
 <div class="box">
<div class="box-body  no-padding">
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
  <table class="table table-striped"id="postList" class="list">
	<tr>
		<th><?php echo 'CODE';?></th>
		<th><?php echo 'NAME';?></th>
		<th><?php echo 'PAYMENTS';?></th>
		
	
		
		

	</tr>
	
	
	<?php if($studentscourse!=null):?>
	<?php foreach ($studentscourse as $course):?>
		<tr>
            <td><?php echo $course->cousrecode;?></td> 
            <td><?php echo $course->cname;?></td>
			 <td><?php echo $course->sid;?></td>
			 <td><?php echo $course->sname;?></td>
			  <td><?php echo $course->joinMonth;?></td>
            <td><?php ?></td>
			<td><div class="btn-group">
                      <button type="button" class="btn btn-info">Action</button>
                      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
						  <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo site_url('Course/editCourse') . '/' . $course -> id; ?>">Edit</a></li>
                        <li><a class='deleteUser' href="<?php echo site_url('Course/deleteCoursePayments') . '/' . $course -> id; ?>">Delete</a></li>
                       
                      </ul>
                    </div>
			</td>
		</tr>
	<?php endforeach;?>
	<?php  else: ?>
	 No Courses Payments Added yet
	 <?php  endif; ?>
	
	
</table>
</div>
</div>
</div>
</section>


</div>
</div>






<!--script type="text/javascript" language="javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/jquery.js"></script-->
<!--script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script-->




