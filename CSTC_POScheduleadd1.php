<a href="#modal-warning_sch"  data-toggle="modal"  ><b><H6>Add Purchase Order Schedule</H6></b> </a>
                <div class="modal modal-warning fade" id="modal-warning_sch" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img src=images/wbtc.png class="img-circle" alt="User Image"height="42" width="42"><h4 class="modal-title"><span style="color:white;">ADD PURCHASE ORDER SCHEDULE</span></h4>
                            </div>
                            <form method="post" action="CSTC_POScheduleAdd.php"  enctype="multipart/form-data">
					<table >
						<tr>
                                                    <td colspan="3"><p></p></td>
                                                </tr>
						<tr>
                                                    <td width="20%"></td>
							<td>SCHEDULE NO. :</td>
							
							<td><input class="form-control"type="text" id='line' name='line'  placeholder="Schedule Number (e.g. 1,2,3 etc.)"  required /></td>
						</tr>
                                                <tr>
                                                    <td colspan="3"><p></p></td>
                                                </tr>
						<tr>
                                                     <td width="20%"></td>
							<td>SCHEDULE DATE</td>
							
							<td>
                                                         <input class="form-control" type="text" placeholder="click to show datepicker" name="mydate" id="mydate" value="" readonly='readonly'>

                                                               </td>
						</tr>
                                               <tr>
                                                    <td colspan="3"><p></p></td>
                                                </tr>
                                              <tr>
                                                   <td width="20%"></td>
							<td>QUANTITY</td>
							
							<td>
                                                         <input class="form-control" type="text" placeholder="% of quantity to deliver" name="qty" id="qty" value="" required>
                                                         <input class="form-control" type="hidden"  name="po_no" id="po_no" value="<?php echo $po_no ; ?>" required>

                                                               </td>
						</tr>  
                                                <tr>
                                                    <td colspan="3"><p></p></td>
                                                </tr>
                                               
						
						
					</table>
					
	
    
    <div class="modal-footer">
    <button class="btn badge-warning" data-dismiss="modal" aria-hidden="true">Close</button>
<button type="submit" name="Submit" class="btn btn-success">Add</button>
    </div>
	

					</form>
                            </div>
                    </div>
                </div>

