 <!-- content @s -->
 <div class="nk-content">
     <div class="container-fluid">
         <div class="nk-content-inner">
             <div class="nk-content-body wide-lg mx-auto">
                 @if (Session::has('error'))
                     <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}
                         <button type="button" class="close" user-dismiss="alert">×</button>
                     </p>
                 @endif
                 @if (Session::has('success'))
                     <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}
                         <button type="button" class="close" user-dismiss="alert">×</button>
                     </p>
                 @endif
                 <div class="nk-block-head nk-block-head-sm">
                     <div class="nk-block-between">
                         <div class="nk-block-head-content">
                             <div class="nk-block-head-sub">
                                 <a class="back-to" href="{{ route('home') }}"><em
                                         class="icon ni ni-arrow-left"></em><span>Go Back</span></a>
                             </div>
                             <h3 class="nk-block-title page-title">View User</h3>
                             <div class="nk-block-des text-soft">
                                 <p>You have total {{ $users->total() }} users.</p>
                             </div>
                         </div><!-- .nk-block-head-content -->
                         <div class="nk-block-head-content">
                             <div class="toggle-wrap nk-block-tools-toggle">
                                 <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                     user-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                 <div class="toggle-expand-content" user-content="pageMenu">
                                     <ul class="nk-block-tools g-3">
                                         <li class="nk-block-tools-opt">
                                             <form method="GET" action="{{ route('view-user') }}">
                                                 <div class="form-control-wrap"  style="width: 250px;">
                                                     <input type="text" name="search" class="form-control"
                                                         placeholder="Search by ID, Name, or Mobile"
                                                         value="{{ request()->input('search') }}" >
                                                 </div>
                                         </li>
                                         <li class="nk-block-tools-opt">
                                             <button type="submit" class="btn btn-primary">Submit</button>
                                         </li>
                                         </form>
                                         <li class="nk-block-tools-opt">
                                             <div class="drodown">
                                                 {{-- <a href="{{ url('add-user') }}"
                                                     class="dropdown-toggle btn btn-icon btn-primary"
                                                     style="width:140px;"><em class="icon ni ni-plus"></em><span>Add
                                                         User</span></a> --}}
                                             </div>
                                         </li>
                                     </ul>
                                 </div><!-- .toggle-expand-content -->
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
                                         <div class="nk-tb-col tb-col-mb"><span class="sub-text">User</span></div>
                                         <div class="nk-tb-col tb-col-mb"><span class="sub-text">Mobile/Email</span></div>
                                         <div class="nk-tb-col tb-col-md"><span class="sub-text">Date</span></div>
                                         <div class="nk-tb-col tb-col-lg"><span class="sub-text">User Earning</span>
                                         </div>
                                         <div class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></div>
                                         <div class="nk-tb-col nk-tb-col-tools text-end"></div>
                                     </div><!-- .nk-tb-item -->

                                     @foreach ($users as $user)
                                         <div class="nk-tb-item">
                                             <div class="nk-tb-col nk-tb-col-check">
                                                 <span>{{ $user->id }}</span>
                                             </div>
                                             <div class="nk-tb-col">
                                                 <div class="user-card">
                                                     <div class="user-avatar bg-primary">
                                                         <span><img style="height:50px; width:50px"
                                                                 src="{{ $user->image }}" alt="img"></span>
                                                     </div>


                                                     <div class="user-info">
                                                         <span class="tb-lead">{{ $user->name }} <span
                                                                 class="dot dot-success d-md-none ms-1"></span></span>


                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="nk-tb-col tb-col-mb">
                                                 @if (!empty($user->helping_category))
                                                     <span>{{ $user->helping_category }}</span>
                                                 @else
                                                     <span>{{ $user->mobile_no }}</span>
                                                 @endif
                                             </div>


                                             <div class="nk-tb-col tb-col-mb">
                                                 @if ($user->created_at)
                                                     <span class="tb-amount">{{ $user->created_at }}</span>
                                                 @else
                                                     <span class="tb-status text-danger">NA</span>
                                                 @endif
                                             </div>
                                             <div class="nk-tb-col tb-col-mb">
                                                 @if ($user->wallet)
                                                     <span class="tb-amount">{{ $user->wallet->wallet_amount }}</span>
                                                 @else
                                                     <span class="tb-status text-danger">NA</span>
                                                 @endif
                                             </div>
                                             <div class="nk-tb-col tb-col-md">
                                                 @if ($user->status == 1)
                                                     <span class="tb-status text-success">Active</span>
                                                 @else
                                                     <span class="tb-status text-danger">Block</span>
                                                 @endif
                                             </div>
                                             <div class="nk-tb-col nk-tb-col-tools">
                                                 <ul class="nk-tb-actions gx-1">
                                                     <li class="nk-tb-action-hidden">
                                                         <a href="{{ url('send-notification') }}"
                                                             class="btn btn-trigger btn-icon" user-bs-toggle="tooltip"
                                                             user-bs-placement="top" title="Send Notification">
                                                             <em class="icon ni ni-mail-fill"></em>
                                                         </a>
                                                     </li>
                                                     <li>
                                                         <div class="drodown">
                                                             <a class="dropdown-toggle btn btn-icon btn-trigger"
                                                                 user-bs-toggle="dropdown"><em
                                                                     class="icon ni ni-more-h"></em></a>
                                                             <div class="dropdown-menu dropdown-menu-end">
                                                                 <ul class="link-list-opt no-bdr">
                                                                     <li><a
                                                                             href="{{ url('user-transaction/' . $user->id) }}"><em
                                                                                 class="icon ni ni-repeat"></em><span>Transaction</span></a>
                                                                     </li>
                                                                     <li class="divider"></li>
                                                                     {{-- @if (Auth::user()->role == 'admin') --}}
                                                                         <li><a
                                                                                 href="{{ url('user-call/' . $user->id) }}"><em
                                                                                     class="icon ni ni-mobile"></em><span>Call
                                                                                     History</span></a></li>
                                                                         <li><a
                                                                                 href="{{ url('user-chat/' . $user->id) }}"><em
                                                                                     class="icon ni ni-chat-circle"></em><span>Chat
                                                                                     History</span></a></li>
                                                                         <li><a
                                                                                 href="{{ url('wallet-edit/' . $user->id) }}"><em
                                                                                     class="icon ni ni-wallet"></em><span>Update
                                                                                     Wallet</span></a></li>
                                                                         <li><a
                                                                                 href="{{ url('user-edit/' . $user->id) }}"><em
                                                                                     class="icon ni ni-mobile"></em><span>Edit
                                                                                     User</span></a></li>
                                                                     {{-- @endif --}}
                                                                     <li class="divider"></li>
                                                                     <li><a href="{{ url('user-block/' . $user->id) }}"><em
                                                                                 class="icon ni ni-na"></em><span>Block
                                                                                 Account</span></a></li>
                                                                     <li><a href="{{ url('delete/' . $user->id) }}"><em
                                                                                 class="icon ni ni-na"></em><span>Delete
                                                                                 Account</span></a></li>
                                                                 </ul>
                                                             </div>
                                                         </div>
                                                     </li>
                                                 </ul>
                                             </div>
                                         </div><!-- .nk-tb-item -->
                                     @endforeach

                                 </div><!-- .nk-tb-list -->

                                 <!-- Pagination -->
                                 <div class="nk-block-between">
                                     {{-- <div class="g">
                                        {{ $users->links('vendor.pagination.default') }}
                                    </div> --}}
                                     <div class="g" style="">
                                         {{ $users->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                                     </div>
                                 </div>

                             </div><!-- .card-inner -->
                         </div><!-- .card-inner-group -->
                     </div><!-- .card -->
                 </div><!-- .nk-block -->
             </div><!-- .nk-content-body -->
         </div>
     </div>
 </div><!-- .nk-content -->
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
 </div><!-- footer @e -->

 </div><!-- wrap @e -->
 </div><!-- main @e -->
 </div><!-- app-root @e -->

 <script src="assets/js/bundle.js?ver=3.0.0"></script>
 <script src="assets/js/scripts.js?ver=3.0.0"></script>
