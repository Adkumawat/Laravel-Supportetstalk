

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
                                <div class="nk-block-head-sub"><a class="back-to" href="dashboard.php"><em class="icon ni ni-arrow-left"></em><span>Dashboard</span></a></div>
                                <h2 class="nk-block-title fw-normal">Add Listner Account</h2>

                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <div class="preview-block">
                                    <form method="post" action="{{('add-listner')}}" enctype="multipart/form-data">
                                        @csrf
										<div class="row gy-4">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Username</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-user"></em>
                                                        </div>
                                                        <input type="text" name="user_name" class="form-control" id="default-01" placeholder="Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Full Name</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-user"></em>
                                                        </div>
                                                        <input type="text" name="full_name" class="form-control" id="default-01" placeholder="Enter User Full Name" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Email</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-mail"></em>
                                                        </div>
                                                        <input type="email" name="email" class="form-control" id="default-01" placeholder="Enter Email" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-03">Mobile Number</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-mobile"></em>
                                                        </div>
                                                        <input type="number" name="mobile_no" class="form-control" id="default-03" placeholder="Mobile Number" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-06">Profile Picture</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-file">
                                                            <input type="file" name="image" value="" class="form-file-input" id="customFile">
                                                            <label class="form-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-06">Age</label>
                                                    <div class="form-control-wrap">
                                                        <input type="number" name="age" class="form-control" id="default-03" placeholder="In Years" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Interest</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2" name="interest[]" multiple="multiple" data-placeholder="Select Multiple options" required>
                                                            <option value="Relationship">Relationship</option>
                                                            <option value="Breakup">Breakup</option>
                                                            <option value="Studies">Studies</option>
                                                            <option value="Friendship">Friendship</option>
                                                            <option value="Career">Career</option>
                                                            <option value="Stress">Stress</option>
                                                            <option value="Loneliness">Loneliness</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Language</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-select js-select2" name="language[]" multiple="multiple" data-placeholder="Select Multiple options" required>
                                                            <option value="Hindi">Hindi</option>
                                                            <option value="English">English</option>
                                                            <option value="Punjabi">Punjabi</option>
                                                            <option value="Gujrati">Gujrati</option>
                                                            <option value="Bengali">Bengali</option>
                                                            <option value="Tamil">Tamil</option>
                                                            <option value="Assamese">Assamese</option>
                                                            <option value="Malayalam">Malayalam</option>
                                                            <option value="Telugu">Telugu</option>
                                                            <option value="Marathi">Marathi</option>
                                                            <option value="Odia">Odia</option>
                                                            <option value="Kannada">Kannada</option>
                                                            <option value="Konkani">Konkani</option>
                                                            <option value="Kashmiri">Kashmiri</option>
                                                            <option value="Bhojpuri">Bhojpuri</option>
                                                            <option value="Dogri">Dogri</option>
                                                            <option value="Urdu">Urdu</option>
                                                            <option value="Manipuri">Manipuri</option>
                                                            <option value="Sindhi">Sindhi</option>
                                                            <option value="Bodo">Bodo</option>
                                                            <option value="Sanskrit">Sanskrit</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="preview-block">
                                                        <label class="form-label">Sex</label>
                                                        <div class="g-4 align-center flex-wrap">
                                                            <div class="g">
                                                                <div class="custom-control custom-radio checked">
                                                                    <input type="radio" name="sex" class="custom-control-input" value="M"  id="customRadio6" required>
                                                                    <label class="custom-control-label" for="customRadio6">Male</label>
                                                                </div>
                                                            </div>
                                                            <br/>
                                                            <div class="g">
                                                                <div class="custom-control custom-radio ">
                                                                    <input type="radio" name="sex" class="custom-control-input" value="F" id="customRadio5" required>
                                                                    <label class="custom-control-label" for="customRadio5">Female</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Available on</label>
                                                    <ul class="custom-control-group g-3 align-center">
                                                        <li>
                                                            <div class="custom-control custom-control custom-checkbox checked">
                                                                <input type="checkbox" name="available_on[]" value="call" class="custom-control-input" id="call" >
                                                                <label class="custom-control-label" for="call">Call</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-control custom-checkbox">
                                                                <input type="checkbox" name="available_on[]" value="chat" class="custom-control-input" id="chat" >
                                                                <label class="custom-control-label" for="chat">Chat</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-control custom-checkbox">
                                                                <input type="checkbox" name="available_on[]" value="video" class="custom-control-input" id="video" >
                                                                <label class="custom-control-label" for="video">Video Call</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" name="about" for="default-textarea">About Us</label>
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control no-resize" name="about" id="default-textarea" required></textarea>
                                                    </div>
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
<script src="assets/js/bundle.js?ver=3.0.0"></script>
<script src="assets/js/scripts.js?ver=3.0.0"></script>
</body>

</html>
