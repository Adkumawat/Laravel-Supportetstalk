 <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body wide-lg mx-auto">
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
                                <div class="nk-block-head-sub">
                                    <a class="back-to" href="{{ route('home') }}"><em class="icon ni ni-arrow-left"></em><span>Go Back</span></a>
                                </div>
                                <h3 class="nk-block-title page-title">View Users</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{ count($user_data_6000_12000)}} users in last 7 days.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
    <div class="nk-block-head-content">
     <div class="toggle-wrap nk-block-tools-toggle">
      <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="more-options"><em class="icon ni ni-more-v"></em></a>
      <div class="toggle-expand-content" data-content="more-options">
         <ul class="nk-block-tools g-3">
        <li>
       <li class="nk-block-tools-opt">
                                                <form id="myForm" onsubmit="event.preventDefault(); return submitData();">
                                                     <div class="form-control-wrap">
														<input id="mobile_no" type="text" name="mobile_no"  class="form-control" placeholder="Search by mobile">
                                               		 </div>
                                                 </li> 
                                              <li  class="nk-block-tools-opt">
                                                   <button type="submit" class="btn btn-primary" >Submit</button>
                                              </li>
                                                
                                           
                                            </form>                                    
     </ul>
         </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-stretch">
                            <div class="card-inner-group">

                                <div class="card-inner ">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <div class="nk-tb-item nk-tb-head">                                          
                                            <div class="nk-tb-col"><span class="sub-text">ID</span></div>
                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">User</span></div>
                                            @if(Auth::user()->role==3)
											
                                            @else
												<div class="nk-tb-col tb-col-md"><span class="sub-text">Wallet Balance</span></div>
										    @endif		
											<div class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></div>                                          
                                            <div class="nk-tb-col nk-tb-col-tools text-end">                                                
                                            </div>
                                        </div><!-- .nk-tb-item -->
										 <?php $i=1; foreach($user_data_6000_12000 as $data){ ?>
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <span><?php echo $data->id; ?></span>
                                            </div>
                                            <div class="nk-tb-col">                                               
                                                <div class="user-card">                                                       
                                                    <div class="user-info">
                                                        <span class="tb-lead"><?php echo $data->name; ?> <span class="dot dot-success d-md-none ms-1"></span></span>
                                                        <span><?php echo $data->mobile_no; ?></span>
                                                    </div>
                                                </div>                                               
                                            </div>
											@if(Auth::user()->role==3)
                                            
											@else
												<div class="nk-tb-col tb-col-mb">
												<span class="tb-amount">&#8377;<?php echo $data->wallet_amount ?? '0.00'; ?></span>
										       </div>
											@endif
                                            <div class="nk-tb-col tb-col-md">
											    @if($data->ac_delete=='0')
                                                @if($data->status == 1)
                                                <span class="tb-status text-success">Active</span>
											@else
												<span class="tb-status text-danger">Block</span>
											@endif
											@else
												<span class="tb-status text-danger">Deleted</span>
											@endif
                                            </div>                                                                                      
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <!--<li class="nk-tb-action-hidden">
                                                        <a href="{{url('user-wallet')}}" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Wallet">
                                                            <em class="icon ni ni-wallet-fill"></em>
                                                        </a>
                                                    </li>-->
                                                    <li class="nk-tb-action-hidden">
                                                        <a href="{{route('send-notification')}}" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Notification">
                                                            <em class="icon ni ni-mail-fill"></em>
                                                        </a>
                                                    </li>
                                                    <!--<li class="nk-tb-action-hidden">
                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Suspend">
                                                            <em class="icon ni ni-user-cross-fill"></em>
                                                        </a>
                                                    </li>-->
                                                    <li>
                                                        <div class="drodown">
                                                           <a  class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr"> 
                                                                    <li><a href="{{url('user-transaction/'.$data->id)}}"><em class="icon ni ni-repeat"></em><span>Transaction</span></a></li>
                                                                    <li class="divider"></li> 
                                                                    @if(Auth::user()->role==1)
																	<li><a href="{{url('user-call/'.$data->id)}}"><em class="icon ni ni-mobile"></em><span>Call History</span></a></li>
                                                                    <li><a href="{{url('user-chat/'.$data->id)}}"><em class="icon ni ni-chat-circle"></em><span>Chat History</span></a></li>
                                                                    <li><a href="{{url('wallet-edit/'.$data->id)}}"><em class="icon ni ni-sign-inr-alt"></em><span>Update Wallet</span></a></li>
                                                                    @else
																    @endif		
																	<li class="divider"></li>                                                                  
                                                                    <li><a href="{{url('user-block/'.$data->id)}}"><em class="icon ni ni-na"></em><span>Block Account</span></a></li>
                                                                    @if($data->ac_delete=='0')
																	<li><a href="{{('user-delete/'.$data->id)}}"><em class="icon ni ni-trash"></em><span>Delete Account</span></a></li>
                                                                    @else
																	<li><a href="#"><em class="icon ni ni-trash"></em><span>Deleted</span></a></li>	
																    @endif
																</ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                        
                                        <?php  $i++; } ?>
                                        

                                    </div><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->

                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
    <!-- content @e -->
</div>
<!-- wrap @e -->
</div>
<!-- main @e -->
</div>
<!-- app-root @e -->
   

<!-- JavaScript -->
<script src="assets/js/bundle.js?ver=3.0.0"></script>
<script src="assets/js/scripts.js?ver=3.0.0"></script>
<script type="text/javascript">
    function submitData(){
        console.log('value', document.getElementById('mobile_no').value);
      $users_list_last_7days = 10;
    }
</script>
</body>

</html>