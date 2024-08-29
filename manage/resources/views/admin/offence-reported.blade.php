

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
                                <a class="back-to" href="{{route('home')}}"><em class="icon ni ni-arrow-left"></em><span>Dashboard</span></a>
                                <h3 class="nk-block-title page-title">Offence Reported</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                 <form>
                                                     <div class="form-control-wrap">
                                                   
                                                   
                                                 <input type="text" name="mobile_no"  class="form-control" placeholder="Search by mobile">
                                                 
                                                </div>
                                                 </li> 
                                              <li  class="nk-block-tools-opt">
                                                   <button type="submit" class="btn btn-primary" >Submit</button>
                                              </li>
                                                
                                           
                                            </form>
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
                                <div class="nk-tb-col"><span class="d-none d-sm-block">Reported By</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-block">Reported For</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Date/Time</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-block">Transaction Type</span></div>
                               
                                <div class="nk-tb-col"><span>Action</span></div>                                
                            </div>
                            <!-- .nk-tb-item -->
							<?php  foreach($report as $data){ ?>
                            <div class="nk-tb-item">                                
                                <div class="nk-tb-col"> 
                                    <div class="user-info">
                                        <span class="tb-lead"><?php echo $data->name; ?> <span class="dot dot-success d-md-none ms-1"></span></span>
                                        <span><?php echo $data->mobile_no; ?></span>
                                    </div>
                                </div>
                                <div class="nk-tb-col"> 
                                    <div class="user-info text-danger">
                                        <span class="tb-lead text-danger">Anonymous <span class="dot dot-success d-md-none ms-1"></span></span>
                                        <span><?php echo ($data->to_id); ?></span>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-lead"><?php echo $data->created_at; ?> </span>
                                </div>
                                <div class="nk-tb-col">  
                                   <?php if($data->reason == 'chat'){ ?>	
                                    <span class="badge badge-sm has-bg bg-purple d-none d-sm-inline-flex"><em class="icon ni ni-msg"></em>&nbsp;<?php echo $data->reason; ?></span>								   
								   <?php }else{ ?>
									<span class="badge badge-sm has-bg bg-success d-none d-sm-inline-flex"><em class="icon ni ni-call"></em>&nbsp;<?php echo $data->reason; ?></span>
								   <?php }?>
								</div>
                                
                               
                                <div class="nk-tb-col">
								    <?php if($data->status == 0){ ?>
                                    <span class="tb-lead text-danger"><a href="{{url('block/'.$data->to_id)}}" class="btn btn-sm btn-danger" onclick="Confirm()"><em class="icon ni ni-cross-circle"></em>&nbsp;Block User</a></span>
									<?php }else{ ?>
										<span class="tb-lead text-danger"><a href="#" class="btn btn-sm btn-danger"><em class="icon ni ni-cross-circle"></em>&nbsp;Blocked</a></span>
									<?php } ?>
								</div>                                                               
                            </div>
                            <!-- .nk-tb-item -->
                           <?php  } ?>
                            <!-- .nk-tb-item -->
                        </div><!-- .nk-tb-list -->                     
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
    <!-- JavaScript -->
	<script>
function Confirm() {
  confirm("Are you sure you want to block user?'");
}
</script>
    <script src="assets/js/bundle.js?ver=3.0.0"></script>
    <script src="assets/js/scripts.js?ver=3.0.0"></script>
</body>

</html>