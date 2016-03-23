  
        <!--link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/base/jquery-ui.css" type="text/css" media="all" /-->  
        <!--link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/   css" media="all" /-->  
        <!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" type="text/javascript"></script-->  
        <!--script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js" type="text/javascript"></script-->  
        <meta charset="UTF-8">  
           
        <style>  
            /* Autocomplete 
            ----------------------------------*/  
            .ui-autocomplete { position: absolute; cursor: default; }     
            .ui-autocomplete-loading { background: white url('http://jquery-ui.googlecode.com/svn/tags/1.8.2/themes/flick/images/ui-anim_basic_16x16.gif') 
			right center no-repeat; }*/  
   
            /* workarounds */  
            * html .ui-autocomplete { width:1px; } /* without this, the menu expands to 100% in IE6 */  
   
            /* Menu 
            ----------------------------------*/  
            .ui-menu {  
                list-style:none;  
                padding: 2px;  
                margin: 0;  
                display:block;  
            }  
            .ui-menu .ui-menu {  
                margin-top: -3px;  
            }  
            .ui-menu .ui-menu-item {  
                margin:0;  
                padding: 0;  
                zoom: 1;  
                float: left;  
                clear: left;  
                width: 100%;  
                font-size:80%;  
            }  
            .ui-menu .ui-menu-item a {  
                text-decoration:none;  
                display:block;  
                padding:.2em .4em;  
                line-height:1.5;  
                zoom:1;  
            }  
            .ui-menu .ui-menu-item a.ui-state-hover,  
            .ui-menu .ui-menu-item a.ui-state-active {  
                font-weight: normal;  
                margin: -1px;  
            }  
        </style>  
        
		
           
    </head>
            	
 <!-- Content Header (Page header) -->
	<section class="content-header">
          <h1>
            Payments
            
          </h1>
		  
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url() ?>index.php/Payments">Payments</a></li>
            <li class="active">Search Payments</li>
          </ol>
    </section>

        <!-- Main content -->
               <!-- Main content -->



	
 <section class="content">
  <div class="col-md-12">
          <!-- Default box -->
          <div class="box">
		<div class="box-header with-border">
              <h3 class="box-title">Payment Details </h3>
			  <div class="box-tools">
				  
                    <div class="input-group" style="width: 300px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search Ref, Name, Category etc.." name="search" id="search">
                     
                    </div>
                  </div>
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
                  
					 <?php 
						// echo $this->ajax_pagination->create_links()
						 ; ?>
				
                  
                </div><!-- /.box-header -->
				
				
				<div class="row">
				  
				  <?php $attributes = array("name" => "registerstudentform", "id" => "doPayments");?>
			 <?php	echo form_open('Student/doPayments', $attributes)?>
			 
			 
					
					
					
					
					
					<?php echo form_close(); ?>
					
                  </div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
                <div class="box-body">
                  <table class="table table-striped"id="postList" class="list">
                    <tr>
                      <th>Payment Reference</th>
					   <th>Student Id</th>
                      <th>Student Name</th>
                      <th>Payment Category</th>
					  <th>Amount</th>
					   <th>Officer</th>
					   <th>Date</th>
					  
					   <th>Action</th>
                    </tr>
					<div >  
					
					
					<?php if ($payments) { ?>
					
					<!--?php foreach($this->data['students'] as $student): ?-->
					<?php foreach($payments as $payment): ?>
                    <tr>
                      <td><?php echo $payment->studentspaymentid; ?></td>
					   <td><?php echo $payment->studentId; ?></td>
                      <td><?php echo $payment->name; ?></td>
					  <td><?php echo $payment->paymentname; ?></td>
					  <td><?php echo $payment->amount; ?></td>
                      <td><?php echo $payment->user; ?></td>
					  <td><?php echo $payment->pdate; ?></td>
					 
					  <td>
						  <div class="btn-group">
                      <button type="button" class="btn btn-info">Action</button>
                      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo site_url('Payments/edit') . '/' . $payment -> studentspaymentid; ?>">Edit</a></li>
                        <li><a class='deleteUser' href="<?php echo site_url('Payments/delete') . '/' . $payment -> studentspaymentid; ?>">Delete</a></li>
                        <li><a  href="<?php echo site_url('Payments'); ?>">Do Payment</a></li>
                      </ul>
                    </div>  
						</td>
                    </tr>
                    <?php endforeach; ?>
				
					<?php } ?>
					
					
					</div>
                  </table>
				  
                </div><!-- /.box-body -->
				
				
				
              </div>
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
            	
           
            </div><!-- /.box-body -->
           
          </div><!-- /.box -->
  </div><!-- /.box -->
        </section><!-- /.content -->		
		

<table border='1' id="display"></table>		
		

		
		
<script>
	$(document).ready(function(){
		$("#search").keyup(function(){
		if($("#search").val().length>0){
		$.ajax({
			type: "post",
			url: "http://localhost/CodeIgniter3Tests/index.php/Payments/ajaxGetPaymentSearch",
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
		



		
 	
		
		
		
		
		
		
		
		
		
		
	 








