

    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
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
                    <div class="components-preview wide-md mx-auto">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-sub"><a class="back-to" href="{{route('home')}}"><em class="icon ni ni-arrow-left"></em><span>Dashboard</span></a></div>
                                <h2 class="nk-block-title fw-normal"><?php echo $all_users->name; ?> current Wallet Amount <em class="icon ni ni-sign-inr-alt"></em> <?php echo $wallets->wallet_amount; ?></h2>

                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="nk-block nk-block-lg">                           
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <div class="preview-block">  
                                    <form method="post" action="{{route('wallet-update')}}" enctype="multipart/form-data">									
                                        @csrf
										<div class="row gy-4">
										     <input type="hidden" name="user_id" value="<?php echo $all_users->id; ?>" class="form-control" id="default-01" placeholder="id" required>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Enter Amount</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-sign-inr-alt"></em>
                                                        </div>
                                                        <input type="number" name="amount" value="<?php echo $all_users->name; ?>" class="form-control" id="default-01" placeholder="Enter Amount" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" value="submit" class="btn btn-lg btn-primary">Update</button>
                                            </div>                                            
                                        </div>                                    
                                      </form>
                                    </div>
                                </div>
                            </div><!-- .card-preview -->

                        </div><!-- .nk-block -->
                    </div>
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

<!-- JavaScript -->
<script src="assets/js/bundle.js?ver=3.0.0"></script>
<script src="assets/js/scripts.js?ver=3.0.0"></script>
</body>

</html>