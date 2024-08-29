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
                                <h3 class="nk-block-title page-title">Admin Accounts</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{$admin_count}} admin users.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="more-options">
                                        <ul class="nk-block-tools g-3">                                                                                    
                                            <li class="nk-block-tools-opt">
                                                <a href="#" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                <a href="{{url('add-admin')}}" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Admin</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="nk-tb-list is-separate mb-3">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col tb-col-md"><span class="sub-text">SL. No.</span></div>
                                <div class="nk-tb-col"><span class="sub-text">Username</span></div>
                                <div class="nk-tb-col tb-col-mb"><span class="sub-text">Mobile</span></div>
                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Transactions</span></div>
                                <div class="nk-tb-col tb-col-lg"><span class="sub-text">Wallet</span></div> 
                                <div class="nk-tb-col tb-col-lg"><span class="sub-text">Call Recordings / Chat Transcripts</span></div> 
                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                <div class="nk-tb-col nk-tb-col-tools"></div>
                            </div>
                            <!-- .nk-tb-item -->
							<?php $i=1; foreach($admin as $data){ ?>
                            <div class="nk-tb-item">
                                <div class="nk-tb-col nk-tb-col-check">
                                    <span><?php echo $i; ?></span>
                                </div>
                                <div class="nk-tb-col">                                   
                                    <div class="user-card">                                          
                                        <div class="user-info">
										@if($data->role=='1')
                                            <span class="tb-lead">Superadmin<span class="dot dot-success d-md-none ms-1"></span></span>
                                          @elseif($data->role=='2') 
                                            <span class="tb-lead">Admin<span class="dot dot-success d-md-none ms-1"></span></span>										  
											@else
												<span class="tb-lead">User<span class="dot dot-success d-md-none ms-1"></span></span>
											@endif
											<span>{{$data->email}}</span>
                                        </div>
                                    </div>                                    
                                </div>                               
                                <div class="nk-tb-col tb-col-md">
                                    <span>{{$data->number}}</span>
                                </div>
								@if($data->role=='1')
                                <div class="nk-tb-col tb-col-lg">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" checked="checked" id="transaction">
                                        <label class="custom-control-label" for="transaction"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" checked="checked" id="wallet">
                                        <label class="custom-control-label" for="wallet"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" checked="checked" id="call-chat">
                                        <label class="custom-control-label" for="call-chat"></label>
                                    </div>
                                </div>
								 @elseif($data->role=='2')
								 <div class="nk-tb-col tb-col-lg">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" checked="checked" id="transaction">
                                        <label class="custom-control-label" for="transaction"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" checked="checked" id="wallet">
                                        <label class="custom-control-label" for="wallet"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="call-chat">
                                        <label class="custom-control-label" for="call-chat"></label>
                                    </div>
                                </div>
								 @else
									 <div class="nk-tb-col tb-col-lg">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" checked="checked" id="transaction">
                                        <label class="custom-control-label" for="transaction"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="wallet">
                                        <label class="custom-control-label" for="wallet"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="call-chat">
                                        <label class="custom-control-label" for="call-chat"></label>
                                    </div>
                                </div>
							     @endif
                                <div class="nk-tb-col tb-col-md">
								@if($data->status=='1')
                                    <span class="tb-status text-success">Active</span>
								@else
									<span class="tb-status text-danger">Blocked</span>
								@endif	
                                </div>
                                <div class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">                                       
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">                                                       
                                                        <li><a href="{{('resetPass/'.$data->id)}}"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                                                    @if($data->status=='1')   
													   <li><a href="{{('admin-block/'.$data->id)}}"><em class="icon ni ni-na"></em><span>Block</span></a></li>
                                                    @else    
														<li><a href="{{('admin-unblock/'.$data->id)}}"><em class="icon ni ni-na"></em><span>Unblock</span></a></li>
                                                    @endif
													</ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- .nk-tb-item -->
                              <?php  $i++; } ?>
                        </div><!-- .nk-tb-list -->
                       
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
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
<!-- select region modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="region">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-md">
                <h5 class="title mb-4">Select Your Country</h5>
                <div class="nk-country-region">
                    <ul class="country-list text-center gy-2">
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/arg.png" alt="" class="country-flag">
                                <span class="country-name">Argentina</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/aus.png" alt="" class="country-flag">
                                <span class="country-name">Australia</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/bangladesh.png" alt="" class="country-flag">
                                <span class="country-name">Bangladesh</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/canada.png" alt="" class="country-flag">
                                <span class="country-name">Canada <small>(English)</small></span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/china.png" alt="" class="country-flag">
                                <span class="country-name">Centrafricaine</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/china.png" alt="" class="country-flag">
                                <span class="country-name">China</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/french.png" alt="" class="country-flag">
                                <span class="country-name">France</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/germany.png" alt="" class="country-flag">
                                <span class="country-name">Germany</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/iran.png" alt="" class="country-flag">
                                <span class="country-name">Iran</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/italy.png" alt="" class="country-flag">
                                <span class="country-name">Italy</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/mexico.png" alt="" class="country-flag">
                                <span class="country-name">México</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/philipine.png" alt="" class="country-flag">
                                <span class="country-name">Philippines</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/portugal.png" alt="" class="country-flag">
                                <span class="country-name">Portugal</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/s-africa.png" alt="" class="country-flag">
                                <span class="country-name">South Africa</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/spanish.png" alt="" class="country-flag">
                                <span class="country-name">Spain</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/switzerland.png" alt="" class="country-flag">
                                <span class="country-name">Switzerland</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/uk.png" alt="" class="country-flag">
                                <span class="country-name">United Kingdom</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="images/flags/english.png" alt="" class="country-flag">
                                <span class="country-name">United State</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- .modal-content -->
    </div><!-- .modla-dialog -->
</div><!-- .modal -->
<!-- @@ Profile Edit Modal @e -->
<div class="modal fade" role="dialog" id="student-add">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-md">
                <h5 class="title">Admin Account</h5>
                <ul class="nk-nav nav nav-tabs mt-n2">
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#student-info">Admin Information</a>
                    </li>

                </ul><!-- .nav-tabs -->
                <div class="tab-content">
                    <div class="tab-pane active" id="student-info">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="full-name">Name</label>
                                    <input type="text" class="form-control" id="full-name" placeholder="Name" required>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="phone-no">Phone Number</label>
                                    <input type="text" class="form-control" id="phone-no" value="+880" placeholder="Phone Number" required>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="phone-no">Address</label>
                                    <textarea class="form-control" id="phone-no"  placeholder="Address" required></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <a href="#" class="btn btn-primary">Submit</a>
                                    </li>
                                    <li>
                                        <a href="#" data-bs-dismiss="modal" class="link link-light">Cancel</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- .tab-pane -->
                    <!-- .tab-pane -->
                </div><!-- .tab-content -->
            </div><!-- .modal-body -->
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div><!-- .modal -->
<!-- JavaScript -->
<script src="assets/js/bundle.js?ver=3.0.0"></script>
<script src="assets/js/scripts.js?ver=3.0.0"></script>
</body>

</html>