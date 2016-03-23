
  
            	
 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Add Course Subjects
            
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
            echo form_open("Subject/addCourseSubjects")?>
     
	 
	  <div class="form-group">
			<label>Select Course</label>
							<select class="form-control" name="courseId" id="coursename" required >
	                        <option > <?php echo 'Select Course'; ?></option>
							<?php foreach($courses as $course): ?>
							<option value=<?php echo $course->id;  ?> > <?php echo $course->name; ?></option>
							<?php endforeach; ?>
                                              
							</select>
	</div>
	 
	 
	 <div class="form-group">
			<label>Subject</label>
							<select class="form-control" name="subjectId" id="paymentId" >
	                        <option value='' > <?php echo 'Slect Subject'; ?></option>
							<?php foreach($subjects as $subject): ?>
							<option value=<?php echo $subject->id;  ?> > <?php echo $subject->name; ?></option>
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
		<th><?php echo 'COURSE CODE';?></th>
		<th><?php echo 'COURSE NAME';?></th>
		<th><?php echo 'SUBJECT CODE';?></th>
		<th><?php echo 'SUBJECT NAME';?></th>
		
	
		
		

	</tr>
	
	<?php if($courseSubjects!=null):?>
	<?php foreach ($courseSubjects as $courseSubject):?>
		<tr>
            <td><?php echo $courseSubject->cousrecode;?></td> 
            <td><?php echo $courseSubject->cname;?></td>
			 <td><?php echo $courseSubject->scode;?></td>
			  <td><?php echo $courseSubject->sname;?></td>
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






