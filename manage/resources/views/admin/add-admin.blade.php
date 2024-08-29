

    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
@if(Session::has('error'))	
		<p class="alert
		{{ Session::get('alert-class', 'alert-danger' ) }}">{{Session::get('error') }}
		<button type="button" class="close" data-dismiss="alert" >×</button>  
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
                                <h2 class="nk-block-title fw-normal">Add Admin Account</h2>

                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="nk-block nk-block-lg">                           
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <div class="preview-block">    
                                     <form method="post" action="{{('cretae_admin')}}" enctype="multipart/form-data">									
                                        @csrf									
                                        <div class="row gy-4">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Username</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-user"></em>
                                                        </div>
                                                        <input type="text" name="name" class="form-control" id="default-01" placeholder="Username" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-03">Mobile Number</label>
                                                    <div class="form-control-wrap">                                                        
                                                        <input type="number" name="number" class="form-control" id="default-03" placeholder="Mobile Number" required>
                                                    </div>
                                                </div>                                                
                                            </div>  
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-03">Email</label>
                                                    <div class="form-control-wrap">                                                        
                                                        <input type="email" name="email" class="form-control" id="default-03" placeholder="Email Address" required>
                                                    </div>
                                                </div>                                                
                                            </div>                                        

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-06">Profile Picture</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-file">
                                                            <input type="file" name="image" multiple="" class="form-file-input" id="customFile">
                                                            <label class="form-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-03">Password</label>
                                                    <div class="form-control-wrap">                                                        
                                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                                    </div>
                                                </div>                                                
                                            </div>   
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" name="cpassword" for="default-03">Confirm Password</label>
                                                    <div class="form-control-wrap">                                                        
                                                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                                                    </div>
                                                </div>                                                
                                            </div>                                     
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <!--<label class="form-label">Permissions</label>-->
                                                    <label class="form-label">Role</label>
                                                    <ul class="custom-control-group g-3 align-center">
                                                        <li>
                                                            <div class="custom-control custom-control custom-checkbox checked">
                                                                <input type="radio" name="role" value="1" class="custom-control-input" id="superadmin" required>
                                                                <!--<label class="custom-control-label" for="transaction">Transaction</label>-->
                                                                <label class="custom-control-label" for="superadmin">Superadmin</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-control custom-checkbox">
                                                                <input type="radio" name="role" value="2" class="custom-control-input" id="admin" required>
                                                                <!--<label class="custom-control-label" for="wallet">Wallet</label-->
                                                                <label class="custom-control-label" for="admin">Admin</label>
                                                            </div>
                                                        </li>   
                                                        <li>
                                                            <div class="custom-control custom-control custom-checkbox">
                                                                <input type="radio" name="role" value="3" class="custom-control-input" id="user" required>
                                                                <!--<label class="custom-control-label" for="call-chat">Call Recordings / Chat Transcripts</label>-->
                                                                <label class="custom-control-label" for="user">User</label>
                                                            </div>
                                                        </li>   
                                                    </ul>
                                                </div>
                                            </div>                                          

                                            <div class="form-group">
                                                <button type="submit" value="submit" class="btn btn-lg btn-primary">Create Account</button>
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
<script> 
var pass1 = document.getElementById("password")

  , pass2= document.getElementById("confirm_password");
  function validatePassword(){

  if(pass1.value != pass2.value) {

    pass2.setCustomValidity("Password Don't Match");

  } else {

    pass2.setCustomValidity('');

  }

}
    
pass1.onchange = validatePassword;

pass2.onkeyup = validatePassword;

</script>
<script src="assets/js/bundle.js?ver=3.0.0"></script>
<script src="assets/js/scripts.js?ver=3.0.0"></script>
</body>

</html>