    <!-- content @s -->
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    @if(Session::has('error'))
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}
                            <button type="button" class="close" data-dismiss="alert">×</button>
                        </p>
                    @endif
                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert">×</button>
                        </p>
                    @endif
                    <div class="components-preview wide-md mx-auto">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-sub">
                                    <a class="back-to" href="{{ route('home') }}">
                                        <em class="icon ni ni-arrow-left"></em><span>Dashboard</span>
                                    </a>
                                </div>
                                <h2 class="nk-block-title fw-normal">Send Notification</h2>
                            </div>
                        </div>
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <div class="preview-block">
                                        <form method="post" action="{{ route('submit-notification') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row gy-4">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="preview-block">
                                                            <label class="form-label">Send to</label>
                                                            <div class="g-4 align-center flex-wrap">
                                                                <div class="g">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="users" id="customRadio1" value="1">
                                                                        <label class="custom-control-label" for="customRadio1">All Users</label>
                                                                    </div>
                                                                </div>
                                                                <div class="g">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="users" id="customRadio2" value="2">
                                                                        <label class="custom-control-label" for="customRadio2">All Listener</label>
                                                                    </div>
                                                                </div>
                                                                <div class="g">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="users" id="customRadio3" value="3">
                                                                        <label class="custom-control-label" for="customRadio3">Selected Users</label>
                                                                    </div>
                                                                </div>
                                                                <div class="g">
                                                                    <div class="custom-control custom-radio">
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
                                                            <select id="user-dropdown" name="selected_users[]" class="form-select js-select2" multiple="multiple" data-placeholder="Select Multiple options">
                                                                <!-- Options will be loaded via AJAX -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Select Listener</label>
                                                        <div class="form-control-wrap">
                                                            <select id="listener-dropdown" name="selected_listeners[]" class="form-select js-select2" multiple="multiple" data-placeholder="Select Multiple options">
                                                                <!-- Options will be loaded via AJAX -->
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
                                                        <label class="form-label" for="default-textarea">Message</label>
                                                        <div class="form-control-wrap">
                                                            <textarea name="msg" class="form-control no-resize" id="default-textarea"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="default-06">Image</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-file">
                                                                <input name="image" type="file" multiple="" class="form-file-input" id="customFile">
                                                                <label class="form-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" value="submit" class="btn btn-lg btn-primary">Send Notification</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer @s -->
    <div class="nk-footer">
        <div class="container-fluid">
            <div class="nk-footer-wrap">
                <div class="nk-footer-copyright">&copy; 2022 DashLite.</div>
                <div class="nk-footer-links"></div>
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

    <!-- Select2 CSS CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="assets/js/bundle.js?ver=3.0.0"></script>
    <script src="assets/js/scripts.js?ver=3.0.0"></script>
    <script>
        $(document).ready(function() {
            $('#user-dropdown').select2({
                ajax: {
                    url: '{{ route('fetch-users') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            page: params.page || 1,
                            search: params.term || ''
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.items,
                            pagination: {
                                more: data.items.length >= 20 // Adjust based on `perPage` value
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Select Multiple Users',
                minimumInputLength: 0
            });

            $('#listener-dropdown').select2({
                ajax: {
                    url: '{{ route('fetch-listeners') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            page: params.page || 1,
                            search: params.term || ''
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.items,
                            pagination: {
                                more: data.items.length >= 20 // Adjust based on `perPage` value
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Select Multiple Listeners',
                minimumInputLength: 0
            });
        });
    </script>

</body>

</html>