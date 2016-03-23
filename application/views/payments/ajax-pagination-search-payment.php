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
                        <li><a href="<?php echo site_url('Payment/edit') . '/' . $payment -> studentspaymentid; ?>">Edit</a></li>
                        <li><a class='deleteUser' href="<?php echo site_url('Payment/remove') . '/' . $payment -> studentspaymentid; ?>">Delete</a></li>
                        <li><a  href="<?php echo site_url('Payments'); ?>">Do Payment</a></li>
                      </ul>
                    </div>  
						</td>
                    </tr>
                    <?php endforeach; ?>
				
					<?php } ?>
					
					
					</div>
                  </table>