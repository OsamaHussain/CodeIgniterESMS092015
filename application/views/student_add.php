<script>
	$("#alert alert-warning").fadeIn('slow').delay(5000).fadeOut('slow');
	</script>
 
 <style>

</style>
            	
 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add New Students
            
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
      
      
            <?php $attributes = array("name" => "registerstudentform");
            echo form_open("Student/registerStudent")?>
   
     <div class="form-group">
				<label>Register Number</label>      
     <?php $data = array(
          'name'        => 'registernumber',
         // 'value'          => $this->input->post('registernumber'),
		  'value'          => $registernumber,
          'class'       => 'form-control',
          'style'       => 'height:30px',
          'placeholder' => 'Eg: 12345678',
		  'readonly'=>'readonly'
         // 'required' => 'required'         
          
        );
     echo form_input($data); ?> 
	 
      </div>
   
       <div class="form-group">
				<label>Student Name</label>      
     <?php $data = array(
          'name'        => 'studentname',
          'value'          => $this->input->post('studentname'),
          'class'       => 'form-control',
          'style'       => 'height:30px',
          'placeholder' => 'Eg: Thasneem ILM',
          'required' => 'required'
        );
     echo form_input($data);   ?> 
	 <?php echo form_error('studentname'); ?>
      </div>
     
      <div class="form-group">
				<label>Parent Name</label>      
     <?php $data = array(
          'name'        => 'parentname',
          'value'          => $this->input->post('parentname'),
          'class'       => 'form-control',
          'style'       => 'height:30px',
          'placeholder' => 'Eg: Ibura Lebbe',
          'required' => 'required'
        );
     echo form_input($data);   ?> 
	 <?php echo form_error('parentname'); ?>
      </div> 
			
	
	 <div class="form-group">
				<label>Address</label>      
     <?php $data = array(
          'name'        => 'address',
          'value'          => $this->input->post('address'),
          'class'       => 'form-control',
          'placeholder' => 'Eg: No 350, Hijra mawatha, kekunagolla',
		  'required' => 'required'
          );
     echo form_input($data);   ?> 
	 <?php echo form_error('address'); ?>
      </div> 
			
	 <div class="form-group">
				<label>Phone Number</label>      
     <?php $data = array(
          'name'        => 'phonenumber',
          'value'          => $this->input->post('phonenumber'),
          'class'       => 'form-control',
          'style'       => 'height:30px',
          'placeholder' => 'Eg: 0711585515',
           'required' => 'required'
        );
     echo form_input($data);   ?> 
	 <?php echo form_error('phonenumber'); ?>
      </div> 
      
      
      	
      
      
      
      
      
      
      
      
      
	  <div class="form-group">
                
      <input name="submit" type="submit" class="btn btn-primary" value="Send" />
      <button type="reset" class="btn btn-primary">Reset</button>
           
      </div>
            
    <?php echo form_close(); ?>	
            	
            	
            	
            	
            	
            	
            	
            	
     <!--form method="post" action="" id="upload_file">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="" />
 
        <label for="userfile">File</label>
        <input type="file" name="userfile" id="userfile" size="20" />
 
        <input type="submit" name="submit" id="submit" />
    <--/form>       	
            	
            	
            	
            	
           
            </div><!-- /.box-body -->
           
          </div><!-- /.box -->
  </div><!-- /.box -->
        </section><!-- /.content -->
		
		
		
		
<script>
	$(function() {
	$('#upload_file').submit(function(e) {
		e.preventDefault();
		$.ajaxFileUpload({
			url 			:'./upload/upload_file/', 
			secureuri		:false,
			fileElementId	:'userfile',
			dataType		: 'json',
			data			: {
				'title'				: $('#title').val()
			},
			success	: function (data, status)
			{
				if(data.status != 'error')
				{
					$('#files').html('<p>Reloading files...</p>');
					refresh_files();
					$('#title').val('');
				}
				alert(data.msg);
			}
		});
		return false;
	});
});
</script>