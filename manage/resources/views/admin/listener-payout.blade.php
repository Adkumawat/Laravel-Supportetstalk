<!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
				@if(Session::has('error'))	
		<p class="alert
		{{ Session::get('alert-class', 'alert-danger' ) }}">{{Session::get('error') }}
		<button type="button" class="close" data-dismiss="alert">×</button>  
		</p>
		@endif
			@if(Session::has('success'))	
		<p class="alert
		{{ Session::get('alert-class', 'alert-success' ) }}">{{Session::get('success') }}
		<button type="button" class="close" data-dismiss="alert">×</button>  
		</p>
		@endif
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <a class="back-to" href="{{route('home')}}"><em class="icon ni ni-arrow-left"></em><span>Go Back</span></a>
                                <h3 class="nk-block-title page-title">Payout Requests</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-search"></em>
                                                    </div>
                                                    <input type="text" class="form-control" id="default-04" placeholder="Quick search by id">
                                                </div>
                                            </li>                                                                                     
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="nk-tb-list is-separate is-medium mb-3">
                            <div class="nk-tb-item nk-tb-head">                               
                                <div class="nk-tb-col"><span>Requested By</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Date/Time</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-block">Request Amount</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-block">Wallet Amount</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-block">Request Method</span></div>
                                <div class="nk-tb-col tb-col-sm"><span>Action</span></div>                                                              
                            </div>
                            <!-- .nk-tb-item -->
							<?php  foreach($listener_payout as $data){ ?>
                            <div class="nk-tb-item">                                
                                <div class="nk-tb-col">
                                    <div class="user-info">
                                        <span class="tb-lead"><?php echo $data->name; ?> <span class="dot dot-success d-md-none ms-1"></span></span>
                                        <span><?php echo $data->mobile_no; ?></span>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-lead"><?php echo $data->created_at; ?> </span>
                                </div>
                                <div class="nk-tb-col">                                    
                                    <span class="badge badge-sm bg-warning-dim bg-outline-warning d-none d-sm-inline-flex">₹<?php echo $data->amount; ?></span>
                                </div>
                                <div class="nk-tb-col"> 
                                    <span class="badge badge-sm bg-success-dim bg-outline-success">₹<?php echo $data->wallet_amount; ?></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
								<?php if($data->upi_id==NULL){ ?>
								      <span class="tb-lead">Bank Details</span>
									  <span>A/c no. - <?php echo $data->account_no; ?></span></br>
									  <span>Ifsc code - <?php echo $data->ifsc_code; ?></span></br>
									  <span>Bank name - <?php echo $data->bank_name; ?></span>
								<?php }else{ ?> 
								       <span class="tb-lead">UPI ID</span>
                                       <span>Upi id - <?php echo $data->upi_id; ?></span>
								<?php } ?>
                                   
                                </div>
                                <div class="nk-tb-col tb-col-sm">
								<?php if($data->status==0){ ?>
									<span class="tb-sub"><button type="button" class="btn btn-round btn-success" >Submited</button></span>
								<?php }elseif($data->status==2){ ?>
									<span class="tb-sub"><button type="button" class="btn btn-round btn-danger" >Canceled</button></span>
								<?php }else{ ?>
									<!--<span class="tb-sub"><button type="button" id="myBtn" value="<?php echo $data->id; ?>" class="btn btn-round btn-success" ><em class="icon ni ni-check"></em></button></span>-->              
									<span class="tb-sub"><a href="withdrawal-success/<?php echo $data->id; ?>" class="btn btn-round btn-success"><em class="icon ni ni-check"></em></a></span>
                                    <span class="tb-sub"><a href="withdrawal-cancel/<?php echo $data->id; ?>" class="btn btn-round btn-danger"><em class="icon ni ni-cross"></em></a></span>                  
								<?php } ?>
																        
								</div> 
                            </div>
                            <!-- .nk-tb-item -->
                            <?php } ?>
                            

                        </div><!-- .nk-tb-list -->
                       
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
	
	  <!-- The Modal -->
  <div class="modal" id="myModal" >
    <div class="modal-dialog">
      <div class="modal-content">
      <form method="post" action="{{('')}}" enctype="multipart/form-data">									
            @csrf
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Withdrawal</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <label class="form-label" for="default-03">Transection Number</label>
			<div class="form-control-wrap"> 
                 <input type="text" name="id" id="id"> 			
				<input type="text" name="transection_no" class="form-control" id="default-03" placeholder="Transection Number">
			</div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
		<button type="submit" value = "submit" class="btn btn-success">Submit</button>
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div> 
  
  
  
    <!-- content @e -->
    <!-- JavaScript -->
<script>
 
$(document).ready(function(){
  $("#myBtn").on('click',function(){
    $("#myModal").modal('show');
	
	var id = $(this).val();
	
	console.log(id);
	
	$('#id').val(id);	
  });
});
</script>
</script>

    <script src="assets/js/bundle.js?ver=3.0.0"></script>
    <script src="assets/js/scripts.js?ver=3.0.0"></script>
</body>

</html>