

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
                                <div class="nk-block-head-sub"><a class="back-to" href="{{ route('home') }}"><em class="icon ni ni-arrow-left"></em><span>Dashboard</span></a></div>
                                <h2 class="nk-block-title fw-normal">Send Message</h2>
                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="nk-block nk-block-lg">                           
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <div class="preview-block"> 
                                    <form method="post" action="{{ route('submit-message') }}" enctype="multipart/form-data">									
                                        @csrf									
                                        <div class="row gy-4">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="preview-block">
                                                        <label class="form-label">Send to</label>
                                                        <div class="g-4 align-center flex-wrap">                                                            
                                                            <div class="g">
                                                                <div class="custom-control custom-radio checked">
                                                                    <input type="radio" class="custom-control-input" name="users" id="customRadio1" value="1">
                                                                    <label class="custom-control-label" for="customRadio1">All Users</label>
                                                                </div>
                                                            </div>                                                           
                                                            <div class="g">
                                                                <div class="custom-control custom-radio ">
                                                                    <input type="radio" class="custom-control-input" name="users" id="customRadio2" value="2">
                                                                    <label class="custom-control-label" for="customRadio2">All Listener</label>
                                                                </div>
                                                            </div>
                                                            <div class="g">
                                                                <div class="custom-control custom-radio checked">
                                                                    <input type="radio" class="custom-control-input" name="users" id="customRadio3" value="3">
                                                                    <label class="custom-control-label" for="customRadio3">Selected Users</label>
                                                                </div>
                                                            </div>
                                                            <div class="g">
                                                                <div class="custom-control custom-radio ">
                                                                    <input type="radio" class="custom-control-input" name="users" id="customRadio4" value="4">
                                                                    <label class="custom-control-label" for="customRadio4">Selected Listener</label>
                                                                </div>
                                                            </div>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Select User</label>
                                                    <div class="form-control-wrap">
                                                        <select name="selected_users[]" class="form-select js-select2" multiple="multiple" data-placeholder="Select Multiple options">
                                                            <?php  foreach($user_data as $data){ ?>
                                                                <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?> <?php echo $data->mobile_no; ?></option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Select Listener</label>
                                                    <div class="form-control-wrap">
                                                        <select name="selected_listeners[]" class="form-select js-select2" multiple="multiple" data-placeholder="Select Multiple options">
                                                             <?php foreach($listeners as $data){ ?>
                                                                <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?> <?php echo $data->mobile_no; ?></option>
                                                            <?php }
                                                            ?>                                                                                                                 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Title</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-user"></em>
                                                        </div>
                                                        <input type="text" name="title" class="form-control" id="default-01" placeholder="Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Link</label>
                                                    <div class="form-control-wrap">
                                                        <!--<div class="form-icon form-icon-left">-->
                                                        <!--    <em class="icon ni ni-user"></em>-->
                                                        <!--</div>-->
                                                        <input type="text" name="link" class="form-control" id="default-01" placeholder="Link">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-textarea">Message</label>
                                                    <div class="form-control-wrap">
                                                        <textarea name="msg" class="form-control no-resize" id="default-textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div>                                                                                   
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-06">Image </label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-file">
                                                            <input name="image" type="file" multiple="" class="form-file-input" id="customFile">
                                                         
                                                            <label class="form-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <!--<div class="col-sm-6">-->
                                            <!--    <div class="form-group">-->
                                            <!--        <label class="form-label" for="default-03">URL (Optional)</label>-->
                                            <!--        <div class="form-control-wrap">                                                        -->
                                            <!--            <input name="url" type="url" class="form-control" id="default-03" placeholder="http://">-->
                                            <!--        </div>-->
                                            <!--    </div>                                                -->
                                            <!--</div>                                            -->

                                            <div class="form-group">
                                                <button type="submit" value="submit" class="btn btn-lg btn-primary">Send Message</button>
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