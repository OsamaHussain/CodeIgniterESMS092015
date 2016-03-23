     
<!--script type="text/javascript" language="javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/jquery.js"></script-->
<!--script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script-->
<script>
	$(document).ready(function(){
		$("#search").keyup(function(){
		if($("#search").val().length>1){
		$.ajax({
			type: "post",
			url: "http://localhost/CodeIgniter3Tests/index.php/Posts/ajaxPaginationData2",
			cache: false,				
			data:'search='+$("#search").val(),
			success: function(response){
				$('#postList').html(response);
				var obj = JSON.parse(response);
				if(obj.length>0){
					try{
						
					}catch(e) {		
						alert('Exception while request..');
						}		
				}else{
					$('#finalResult').html($('<li/>').text("No Data Found"));		
				}		
				
			},
			error: function(){						
				alert('Error while request..');
			}
		});
		}
		return false;
	  });
	});
</script>
	 
	 
	 
 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Blank page
            <small>it all starts here</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
  <div class="col-md-12">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Student Details</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            
             <?php if ($this->session->flashdata('flashSuccess')) { ?>
        <div id='alert alert-warning'  class="alert alert-info"> <?= $this->session->flashdata('flashSuccess') ?> </div>
    <?php } ?>	
      
      <?php if ($this->session->flashdata('flashFail')) { ?>
        <div id='alert alert-warning'  class="alert-alert-warning"> <?= $this->session->flashdata('flashFail') ?> </div>
    <?php } ?>	
      
      
          <div class="box">
                <div class="box-header">
                  
					 <?php echo $this->ajax_pagination->create_links(); ?>
				
                  <div class="box-tools">
				  
                    <div class="input-group" style="width: 300px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search" name="search" id="search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body  no-padding">
                  <table class="table table-striped"id="postList" class="list">
                    <tr>
                      <th>Register Number</th>
                      <th>Name</th>
                      <th>Parent Name</th>
                      <th>Phone</th>
					  <th>Address</th>
					   <th>Actions</th>
                    </tr>
					<div >  
					
					<!--?php foreach($this->data['students'] as $student): ?-->
					<?php foreach($students as $student): ?>
                    <tr>
                      <td><?php echo $student->id; ?></td>
                      <td><?php echo $student->name; ?></td>
                       <td><?php echo $student->parentname; ?></td>
                      <td><?php echo $student->phonenumber; ?></td>
					   <td><?php echo $student->address; ?></td>
                      <td>Bacon </td>
                    </tr>
                    <?php endforeach; ?>
					
					
					</div>
                  </table>
				  
                </div><!-- /.box-body -->
              </div>
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
           
            </div><!-- /.box-body -->
           
          </div><!-- /.box -->
  </div><!-- /.box -->
        </section><!-- /.content -->
