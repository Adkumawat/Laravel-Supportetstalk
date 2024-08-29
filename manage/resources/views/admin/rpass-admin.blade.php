
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
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Reset Password</h3>
                                        </div>
                                    </div>
                                </div>
                                <!--.nk-block-head -->
                                <div class="nk-block">
                                    <div class="card">
                                        <div class="card-inner">
										<form method="post" action="{{route('rpass_admin')}}" enctype="multipart/form-data">									
                                        @csrf
                                            <div class="row gy-4">                                                                                                                          
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="phone-no">New Password</label>
                                                        <input type="hidden" class="form-control" name="id" value="{{$id}}" >
                                                        <input type="password" name="password" class="form-control" id="pass" placeholder="New Password">
                                                    </div>
                                                </div>
                                                <!--col-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email">Confirm Password</label>
                                                        <input type="password" name="cpassword" class="form-control" id="cpass" placeholder="Confirm Password">
                                                    </div>
                                                </div>
                                                <!--col-->
                                            
							
												
												
                                                <div class="col-sm-12">
                                                    <ul class="preview-list ">
                                                        <li class="preview-item">
                                                            <button type="submit" value="submit" class="btn btn-primary">Submit</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--col-->
                                            </div>
											</form>
                                            <!--row-->
                                        </div>
                                        <!--card inner-->
                                    </div>
                                    <!--card-->
                                </div>
                                <!--.nk-block -->
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
    <!-- JavaScript -->
	
	<script> 
var pass1 = document.getElementById("pass")

  , pass2= document.getElementById("cpass");
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