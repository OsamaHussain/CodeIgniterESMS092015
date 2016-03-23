

  
            	
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
            echo form_open("Course/registerStudent")?>
     
	 
	 
	  <div class="form-group">
			<label>Slect Student</label>
							<select class="form-control" name="studentId" id="paymentId" >
								
							<?php foreach($students as $student): ?>
							<option value=<?php echo $student->id;  ?> > <?php echo $student->name; ?></option>
							<?php endforeach; ?>
                                              
						</select>
		</div>
	 
	 
	 
	  <div class="form-group">
			<label>Select Course</label>
							<select class="form-control" name="courseId" id="coursename" required >
	                        
							<?php foreach($courses as $course): ?>
							<option value=<?php echo $course->id;  ?> > <?php echo $course->name; ?></option>
							<?php endforeach; ?>
                                              
							</select>
	</div>
	 
	 
	  <div class="form-group">
			<label>Join Month</label>
			<input type="date" name="joindateDay" min="2016-01-31" class="form-control">				
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
  <div class="col-md-12">		
 <div class="box">
<div class="box-body  no-padding">
  <table class="table table-striped"id="postList" class="list">
	<tr>
		<th><?php echo 'COURSE CODE';?></th>
		<th><?php echo 'COURSE NAME';?></th>
		<th><?php echo 'STUDENT ID';?></th>
		<th><?php echo 'STUDENT NAME';?></th>
		<th><?php echo 'JOIN DATE';?></th>
			
	
		
		

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
                        <!--li><a href="<?php echo site_url('Course/editCourse') . '/' . $course -> id; ?>">Edit</a></li-->
                        <li><a class='deleteUser' href="<?php echo site_url('Course/deleteStudentCourseRegistration') . '/' . $course -> id; ?>">Delete</a></li>
                       
                      </ul>
                    </div>
			</td>
		</tr>
	<?php endforeach;?>
	<?php  else: ?>
	 No Students have registered for Any course
	 <?php  endif; ?>
</table>
</div>
</div>
</div>
</section>


</div>
</div>


 



