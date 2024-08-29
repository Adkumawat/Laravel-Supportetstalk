
            <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Dashboard</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">

                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Total Users</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{$user}}</div>
                                                
                                                </div>                                                
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">New Users Today</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{$users_today}}</div>
                                                
                                                </div>                                                
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Users Last 7 Days</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{$users_7days}}</div>
                                                
                                                </div>                                                
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Users Last 30 Days</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{$users_30days}}</div>
                                                
                                                </div>                                                
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Total Listeners</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{$listener}}</div>
                                                    
                                                </div>                                              
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">New Listener This Month</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{$listener_count}}</div>
                                              
                                                </div>                                                
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Recharge Today</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{$recharge_today}}</div>
                                              
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Recharge Yesterday</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{$recharge_yesterday}}</div>
                                              
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Recharge Last 7 Days</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{$recharge_7days}}</div>
                                              
                                                </div>                                                
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div><!-- .col -->
                          
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Total Recharge this Month</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{$recharge_this_month}}</div>
                                              
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                          
                          
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Busy Listeners</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{$busy_listeners}}</div>
                                              
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                          <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Total Calls/Chats/VC Today</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{$total_calls_today/2}} + {{$total_chats_today/2}} + {{$total_vc_today/2}} = {{$total_calls_today/2 + $total_chats_today/2 + $total_vc_today/2}}</div>
                                              
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Total Calls/Chats/VC Yesterday</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{$total_calls_yesterday/2}} + {{$total_chats_yesterday/2}} + {{$total_vc_yesterday/2}} = {{$total_calls_yesterday/2 + $total_chats_yesterday/2 + $total_vc_yesterday/2}}</div>
                                              
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-xxl-3">
                                <div class="card card-full">
                                    <div class="card-inner-group">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Missed Chat Requests</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <a href="{{url('view-user')}}" class="link">{{ count($missed_chat_list) }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php foreach($missed_chat_list as $data){ ?>
                                        <div class="card-inner card-inner-md">
                                            <div class="user-card">                                                
                                                <div class="user-info">
                                                    <span class="lead-text"><?php echo $data->created_at; ?></span>
                                                </div>
                                                <div class="user-action">
                                                    <div class="drodown">
                                                        <span class="sub-text"><?php echo $data->to_id; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="col-md-3 col-xxl-3">
                                <div class="card card-full">
                                    <div class="card-inner-group">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Missed Calls</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <a href="#" class="link">{{ count($missed_call_list) }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php foreach($missed_call_list as $data){ ?>
                                        <div class="card-inner card-inner-md">
                                            <div class="user-card">                                                
                                                <div class="user-info">
                                                    <span class="lead-text"><?php echo $data->updated_at; ?></span>
                                                </div>
                                                <div class="user-action">
                                                    <div class="drodown">
                                                        <span class="sub-text"><?php echo $data->listner_id; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-xxl-3">
                                <div class="card card-full">
                                    <div class="card-inner-group">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Daily Recharge</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <a href="{{url('view-user')}}" class="link">{{ count($recharge_today_list) }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php foreach($recharge_today_list as $data){ ?>
                                        <div class="card-inner card-inner-md">
                                            <div class="user-card">                                                
                                                <div class="user-info">
                                                    <span class="lead-text"><?php echo $data->created_at; ?></span>
                                                </div>
                                                <div class="user-action">
                                                    <div class="drodown">
                                                        <span class="sub-text"><?php echo $data->cr_amount; ?>: (<?php echo $data->mode; ?>)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                           <!-- <div class="col-xxl-6">
                                <div class="card card-full">                                    
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-2">
                                            <div class="card-title">
                                                <h6 class="title">Sales Revenue</h6>
                                                <p>In last 30 days revenue from all transactions.</p>
                                            </div>                                               
                                        </div>
                                        <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                            <div class="nk-sale-data-group flex-md-nowrap g-5">
                                                <div class="nk-sale-data">
                                                    <span class="amount">14,299.59 <span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>16.93%</span></span>
                                                    <span class="sub-title">This Month</span>
                                                </div>
                                                <div class="nk-sale-data">
                                                    <span class="amount">7,299.59 <span class="change up text-success"><em class="icon ni ni-arrow-long-up"></em>4.26%</span></span>
                                                    <span class="sub-title">This Week</span>
                                                </div>
                                                <div class="nk-sale-data">
                                                    <span class="amount">1,299.59 <span class="change up text-success"><em class="icon ni ni-arrow-long-up"></em>1.16%</span></span>
                                                    <span class="sub-title">Today</span>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>                                    
                                </div>
                                
                            </div>--->


                            <!--<div class="col-xxl-3 col-md-6">
                                <div class="card h-100">
                                    <div class="card-inner">
                                        <div class="card-title-group mb-2">
                                            <div class="card-title">
                                                <h6 class="title">Monthly Statistics</h6>
                                            </div>
                                        </div>
                                        <ul class="nk-store-statistics">
                                            <li class="item">
                                                <div class="info">
                                                    <div class="title">Calls</div>
                                                    <div class="count">8,795 Min</div>
                                                </div>
                                                <em class="icon bg-primary-dim ni ni-call"></em>
                                            </li>
                                            <li class="item">
                                                <div class="info">
                                                    <div class="title">Chats</div>
                                                    <div class="count">2,327 Min</div>
                                                </div>
                                                <em class="icon bg-info-dim ni ni-chat"></em>
                                            </li>
                                            <li class="item">
                                                <div class="info">
                                                    <div class="title">New Users</div>
                                                    <div class="count">{{$user_count}}</div>
                                                </div>
                                                <em class="icon bg-pink-dim ni ni-users"></em>
                                            </li>
                                            <li class="item">
                                                <div class="info">
                                                    <div class="title">New Listener</div>
                                                    <div class="count">{{$listener_count}}</div>
                                                </div>
                                                <em class="icon bg-purple-dim ni ni-headphone-fill"></em>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>-->                       
                        </div><!-- .row -->
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
                <div class="nk-footer-copyright"> &copy; 2023 <a href="https://supportletstalk.com/">Support: Lets Talk</a></div>                
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
<script src="assets/js/charts/chart-ecommerce.js?ver=3.0.0"></script>
<script>
 function autoLogout(){
    if(!localStorage.getItem('xphSfC4ihQTVsMxF')){
        localStorage.clear();
        window.location.href = 'https://support2heal.com/manage/';
    }
 }
 //autoLogout();
</script>
</body>

</html>