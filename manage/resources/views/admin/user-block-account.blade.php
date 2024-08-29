<!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body wide-lg mx-auto">
								@if(Session::has('error'))	
		<p class="alert
		{{ Session::get('alert-class', 'alert-danger' ) }}">{{Session::get('error') }}
		<button type="button" class="close" data-dismiss="alert" style="margin-left: 400px; margin-right: 400px;">×</button>  
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
                                    <a class="back-to" href="view-listener.php"><em class="icon ni ni-arrow-left"></em><span>Go Back</span></a>
                                </div>
                                <h3 class="nk-block-title page-title">Blocked Users</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{$user_count}} blocked users.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>                                                                  </div><!-- .toggle-wrap -->
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
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Wallet Balance</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></div>                                          
                                            <div class="nk-tb-col nk-tb-col-tools text-end">                                                
                                            </div>
                                        </div><!-- .nk-tb-item -->
										 <?php $i=1; foreach($user_data as $data){ ?>
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <span><?php echo $i; ?></span>
                                            </div>
                                            <div class="nk-tb-col">                                               
                                                <div class="user-card">                                                       
                                                    <div class="user-info">
                                                        <span class="tb-lead"><?php echo $data->name; ?> <span class="dot dot-success d-md-none ms-1"></span></span>
                                                        <span><?php echo $data->mobile_no; ?></span>
                                                    </div>
                                                </div>                                               
                                            </div>
                                            <div class="nk-tb-col tb-col-mb">
                                                <span class="tb-amount">&#8377;<?php echo $data->wallet_amount ?? '0.00'; ?></span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                   @if($data->status == 1)
                                                <span class="tb-status text-success">Active</span>
											@else
												<span class="tb-status text-danger">Blocked</span>
											@endif
                                            </div>                                                                                      
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <!--<li class="nk-tb-action-hidden">
                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Wallet">
                                                            <em class="icon ni ni-wallet-fill"></em>
                                                        </a>
                                                    </li>-->
                                                    <li class="nk-tb-action-hidden">
                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Notification">
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
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr"> 
                                                                    <li><a href="{{'user-transaction/'.$data->id}}"><em class="icon ni ni-repeat"></em><span>Transaction</span></a></li>
                                                                    <li class="divider"></li> 
                                                                    <li><a href="{{url('user-call')}}"><em class="icon ni ni-mobile"></em><span>Call History</span></a></li>
                                                                    <li><a href="{{url('user-chat')}}"><em class="icon ni ni-chat-circle"></em><span>Chat History</span></a></li>
                                                                    <li class="divider"></li>                                                                  
                                                                    <li><a href="{{url('user-unblock/'.$data->id)}}"><em class="icon ni ni-na"></em><span>Unblock Account</span></a></li>
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
    <!-- footer @s -->
    <div class="nk-footer">
        <div class="container-fluid">
            <div class="nk-footer-wrap">
                <div class="nk-footer-copyright"> &copy; 2022 DashLite.
                </div>
                <div class="nk-footer-links">

                </div>
            </div>
        </div>
    </div>
    <!-- footer @e -->
</div>
<!-- wrap @e -->
</div>
<!-- main @e -->
</div>
<!-- app-root @e -->

<!-- JavaScript -->


<script src="assets/js/bundle.js?ver=3.0.0"></script>
<script src="assets/js/scripts.js?ver=3.0.0"></script>
</body>

</html>