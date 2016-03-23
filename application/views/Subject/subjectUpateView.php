  
     

 <!-- Content Header (Page header) -->
    <section class="content-header">
          <h1>
          Subjects
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url() ?>index.php/Payments">Subjects</a></li>
            <li class="active">create Subjects</li>
          </ol>
    </section>

<!-- Main content -->
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
							echo form_open("Subject/update")?>
   
                            <div class="form-group">
								   
								<?php $data = array(
							   // 'id' =>'id',
								'name'        => 'id',
								'value'          => $subject->id,
								//'class'       => 'form-control',
								//'style'       => 'height:30px',
								//'placeholder' => 'Eg: Maths'
								'type' => 'hidden'
								);
								echo form_input($data);   ?> 
								<?php echo form_error('subjectname'); ?>
							</div>
	 
	 
							<div class="form-group">
								<label>Subject Name</label>      
								<?php $data = array(
							    'id' =>'id',
								'name'        => 'subjectname',
								'value'          => $subject->name,
								'class'       => 'form-control',
								'style'       => 'height:30px',
								'placeholder' => 'Eg: Maths'
								// 'required' => 'required'
								);
								echo form_input($data);   ?> 
								<?php echo form_error('subjectname'); ?>
							</div>
	                        
							
	  
	  
							<div class="form-group">
								<label>Subject Code</label>      
								<?php $data = array(
								'id' =>'id',
								'name'        => 'subjectcode',
								'value'          =>  $subject->code,
								'class'       => 'form-control',
								'style'       => 'height:30px',
								'placeholder' => ' Ma/05'
								);
								echo form_input($data);   ?> 
								<?php echo form_error('description'); ?>
							</div>
	                         
							
							 
							 
	 
							<div class="form-group" >
                
								<input name="submit" type="submit" class="btn btn-primary" value="Send" />
								<button type="reset" class="btn btn-primary">Reset</button>
           
							</div>
	 
	 
					</div> 
     
					<?php echo form_close(); ?>	
				</div><!-- /.box-body -->
	
	
				
			</div><!-- /.box -->
		
	</section><!-- /.content -->

		
	<script>
	 
	 $(document).ready(function(){
	$("#submit").click(function(){
	$("#form").submit();  // jQuey's submit function applied on form.
	});
	});
	</script>   	
		
		
		
		

