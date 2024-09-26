<!-- content @s -->
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body wide-lg mx-auto">
                @if (Session::has('error'))
                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">
                        {{ Session::get('error') }}
                        <button type="button" class="close" data-dismiss="alert">×</button>
                    </p>
                @endif
                @if (Session::has('success'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert">×</button>
                    </p>
                @endif
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub">
                                <a class="back-to" href="{{ route('home') }}">
                                    <em class="icon ni ni-arrow-left"></em>
                                    <span>Go Back</span>
                                </a>
                            </div>
                            <h3 class="nk-block-title page-title">View Listener</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have a total of {{ $listner_count }} listeners.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                                    <em class="icon ni ni-menu-alt-r"></em>
                                </a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <form method="GET" action="{{ route('view-listener') }}">
                                                <div class="form-control-wrap">
                                                    <input type="text" name="search" class="form-control" placeholder="Search by ID, Name, Mobile" style="width: 200px">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <div class="dropdown">
                                                <a href="{{ url('add-listener') }}" class="dropdown-toggle btn btn-icon btn-primary" style="width: 140px;">
                                                    <em class="icon ni ni-plus"></em><span>Add Listener</span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner">
                                <div class="nk-tb-list nk-tb-ulist">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span class="sub-text">ID</span></div>
                                        <div class="nk-tb-col tb-col-mb"><span class="sub-text">Listener</span></div>
                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Last Seen</span></div>
                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Online Status</span></div>
                                        <div class="nk-tb-col tb-col-lg"><span class="sub-text">Listener Earning</span></div>
                                        {{-- <div class="nk-tb-col tb-col-md"><span class="sub-text">Online Status</span></div> --}}
                                        <div class="nk-tb-col nk-tb-col-tools text-end"></div>
                                    </div><!-- .nk-tb-item -->
                                    @foreach($listner_data as $data)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <span>{{ $data->id }}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar bg-primary">
                                                    <span><img style="height: 50px; width: 50px" src="{{ $data->image }}" alt="img"></span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $data->name }} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                    <span>{{ $data->mobile_no }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-mb">
                                            @if ($data->created_at)
                                                <span class="tb-amount">{{ $data->created_at }}</span>
                                            @else
                                                <span class="tb-status text-danger">NA</span>
                                            @endif
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            @if ($data->online_status == 1 && $data->busy_status == 1)
                                                <button class="btn btn-warning toggle-status" data-id="{{ $data->id }}" data-status="0">Busy</button>
                                            @elseif ($data->online_status == 1 && $data->busy_status == 0)
                                                <button class="btn btn-success toggle-status" data-id="{{ $data->id }}" data-status="1">Online</button>
                                            @else
                                                <button class="btn btn-danger toggle-status" data-id="{{ $data->id }}" data-status="-1">Offline</button>
                                            @endif   
                                            

                                            {{-- @if ($data->busy_status == 0)
                                                <button class="btn btn-warning toggle-status" data-id="{{ $data->id }}" data-status="0">Busy</button>
                                            @elseif ($data->busy_status == 1)
                                                <button class="btn btn-success toggle-status" data-id="{{ $data->id }}" data-status="1">Online</button>
                                            @else
                                                <button class="btn btn-danger toggle-status" data-id="{{ $data->id }}" data-status="-1">Offline</button>
                                            @endif --}}
                                        </div>
                                        <div class="nk-tb-col tb-col-mb">
                                            @if ($data->listner_earning)
                                                <span class="tb-amount">{{ $data->listner_earning }}</span>
                                            @else
                                                <span class="tb-status text-danger">NA</span>
                                            @endif
                                        </div>
                                        {{-- <div class="nk-tb-col tb-col-md">
                                            @if ($data->online_status == 1)
                                                <span class="tb-status text-success">Online</span>
                                            @elseif ($data->online_status == 0)
                                                <span class="tb-status text-danger">Offline</span>
                                            @else
                                                <span class="tb-status text-warning">Unknown</span>
                                            @endif
                                        </div> --}}
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ url('send-notification') }}" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Notification">
                                                        <em class="icon ni ni-mail-fill"></em>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-more-h"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="{{ url('listener-transaction/' . $data->id) }}">
                                                                    <em class="icon ni ni-repeat"></em><span>Transaction</span></a>
                                                                </li>
                                                                    <li>

                                                                        <a href="{{ url('edit-listener/' . $data->id) }}">
                                                                            <em class="icon ni ni-pen"></em><span>View</span></a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ url('add-wallet/' . $data->id) }}">
                                                                            <em class="icon ni ni-trash"></em><span>Wallet</span></a>
                                                                    </li>
                                                                    <li>

                                                                        <a href="{{ url('block-listener/' . $data->id) }}">
                                                                            <em class="icon ni ni-na"></em><span>Block</span></a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ url('delete-listener/' . $data->id) }}">
                                                                            <em class="icon ni ni-trash"></em><span>Delete</span></a>
                                                                    </li>

                                                                @if (Auth::user()->user_type == 'superadmin' || Auth::user()->user_type == 'admin')
                                                                <li class="divider"></li>
                                                                    <li>
                                                                        @if ($data->status == 0)
                                                                            <a href="{{ url('active-listener/' . $data->id) }}">
                                                                                <em class="icon ni ni-na"></em><span>Active</span></a>
                                                                        @else
                                                                            <a href="{{ url('block-listener/' . $data->id) }}">
                                                                                <em class="icon ni ni-na"></em><span>Block</span></a>
                                                                        @endif
                                                                    </li>
                                                                    <li class="divider"></li>
                                                                    <li>
                                                                        <a href="{{ url('delete-listener/' . $data->id) }}">
                                                                            <em class="icon ni ni-trash"></em><span>Remove</span></a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    @endforeach
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.toggle-status').click(function() {
            var id = $(this).data('id');
            var status = $(this).data('status');
            var button = $(this); // Store reference to the button

            $.ajax({
                url: 'api/toggle-status/' + id,
                type: 'POST',
                data: { status: status }, // Send the current status to the backend
                success: function(response) {
                    // Update the button text and class based on the new status
                    if (response.new_status == 1) {
                        button.text('Online').removeClass('btn-warning btn-danger').addClass('btn-success');
                        button.data('status', 0);
                    } else {
                        button.text('Offline').removeClass('btn-success btn-danger').addClass('btn-danger');
                        button.data('status', 1);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error toggling status:', error);
                    // Optionally display an error message to the user
                }
            });
        });
    });
</script>
