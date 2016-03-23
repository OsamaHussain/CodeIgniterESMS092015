  
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
            <li class="active">Do Payments</li>
          </ol>
    </section>

        <!-- Main content -->
               <!-- Main content -->
    <section class="content">
		
	 <div id="container"></div>
	 
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
						<div id='alert alert-warning'  class="alert alert-info"> 
							<?= $this->session->flashdata('flashSuccess') ?> </div>
						<?php } ?>	
      
					<?php if ($this->session->flashdata('flashFail')) { ?>
					<div id='alert alert-warning'  class="alert-alert-warning">
						<?= $this->session->flashdata('flashFail') ?> </div>
					<?php } ?>	
      
      
						<?php $attributes = array("name" => "registerstudentform", "id" => "doPayments");
		
		
		
		echo form_open('Payments/doOtherPayments', $attributes)?>
   
				
	                
					
					<div class="form-group">
							<label>Student Name</label>
							<select class="form-control" name="studentname" id="studentId" >
	
							<?php foreach($students as $student): ?>
							<option value=<?php echo $student->id;  ?> > <?php echo $student->name; ?></option>
							<?php endforeach; ?>
                                              
							</select>
					</div>  
	 
					<div class="form-group">
							<label>Selects Payment</label>
							<select class="form-control" name="paymentCatagoryId" id="paymentCatagoryId" >
	
							<?php foreach($paymentsCategories as $paymentsCategory): ?>
							<option value=<?php echo $paymentsCategory->paymentcategoryid;?>><?php echo $paymentsCategory->paymentname; ?></option>
							<?php endforeach; ?>
                                              
							</select>
					</div>  
	 
	 
					<div class="form-group">
						<label>Amount</label>      
						<?php $data = array(
						'id' =>'amount',
						'name'        => 'amount',
						//'value'          => $this->input->post('studentname'),
						'class'       => 'form-control',
						'style'       => 'height:30px',
						'placeholder' => 'Eg: 1000',
						 'required' => 'required'
						);
						echo form_input($data);   ?> 
					</div>
					
					<div class="form-group">
						<label>Special notes on Payments</label>      
						<?php $data = array(
						'id' =>'notes',
						'name'        => 'notes',
						//'value'          => $this->input->post('studentname'),
						'class'       => 'form-control',
						'style'       => 'height:30px',
						'placeholder' => 'any notes'
						// 'required' => 'required'
						);
						echo form_input($data);   ?> 
					</div>
	 
					<div class="form-group" >
                
				    <?php echo form_submit('submit', 'Do Payment', 'class="btn btn-primary"'); ?>
					
					<button type="reset" class="btn btn-primary">Reset</button>
					
					
           
					</div>
	  			
      	<?php echo form_close(); ?>	
         
           </div> 
            </div><!-- /.box-body -->
			
		</div><!-- /.box -->
		 
        		<!-- /.row --> 
 
    </section><!-- /.content -->


	
 		
		

<table border='1' id="display"></table>		
		

		



		
 	
		
		
		
		
		
		
		
		
		
		
	 








