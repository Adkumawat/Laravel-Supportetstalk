<!DOCTYPE html>
<html lang="zxx" class="js">

    <head>
        <base href="">
        <meta charset="utf-8">
        <meta name="author" content="Softnio">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
       
        <!-- Fav Icon  -->
        <link rel="shortcut icon" href="{{url('public/uploads/app-icon.jpg')}}">
        <!-- Page Title  -->
        <title>Admin Dashboard | Support Admin </title>
        <!-- StyleSheets  -->
        <link rel="stylesheet" href="{{url('assets/css/dashlite.css?ver=3.0.0')}}">

    <link id="skin-default" rel="stylesheet" href="{{url('assets/css/theme.css?ver=3.0.0')}}">
   
    <link rel="stylesheet" href="{{url('assets/css/dashlite.css?ver=3.0.0')}}">
    <link id="skin-default" rel="stylesheet" href="{{url('assets/css/theme.css?ver=3.0.0')}}">

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	</head>

    <body class="nk-body bg-lighter npc-default has-sidebar ">
        <div class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                <!-- sidebar @s -->
                <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
                    <div class="nk-sidebar-element nk-sidebar-head">
                        <div class="nk-sidebar-brand">
                            <a href="{{url('home')}}" class="logo-link nk-sidebar-logo">
                                  <!--<img class="logo-light logo-img" src="{{('images/logo.png')}}" srcset="{{url('images/logo2x.png 2x')}}" alt="logo">-->
                                  <img class="logo-dark logo-img" src="{{('public/uploads/app-icon.jpg')}}" srcset="{{('public/uploads/app-icon.jpg 2x')}}" alt="logo-dark">
                            <img class="logo-dark logo-img" src="{{('public/uploads/app-icon.jpg')}}" srcset="{{('public/uploads/app-icon.jpg 2x')}}" alt="logo-dark">
                           <!-- <img class="logo-small logo-img logo-img-small" src="{{url('images/logo-small.png')}}" srcset="{{url('images/logo-small2x.png 2x')}}" alt="logo-small">-->
                            </a>
                        </div>
                        <div class="nk-menu-trigger me-n2">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                        </div>
                    </div><!-- .nk-sidebar-element -->
                    <div class="nk-sidebar-element">
                        <div class="nk-sidebar-content">
                            <div class="nk-sidebar-menu" data-simplebar>
                                <ul class="nk-menu">
                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title text-primary-alt">Admin Panel</h6>
                                    </li><!-- .nk-menu-item -->

                                    <li class="nk-menu-item">
                                        <a href="{{route('home')}}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><img src="https://support2heal.com/manage/images/dash.png" style="width:24px; height:22px;"></span>
                                            <span class="nk-menu-text" style="color:#9769FF;">Dashboard</span>
                                        </a>
                                    </li><!-- .nk-menu-item -->


                                    <li class="nk-menu-item has-sub">
                                        <a href="{{url('admin')}}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-user"></em></span>
                                            <span class="nk-menu-text">Admin Account</span>
                                        </a>
                                       
                                    </li><!-- .nk-menu-item -->
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                            <span class="nk-menu-text">User Account</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="{{url('view-user')}}" class="nk-menu-link"><span class="nk-menu-text">View Users (0 - 6000)</span></a>
                                            </li>

                                        
                                           
                                            <li class="nk-menu-item">
                                                <a href="{{url('block-user')}}" class="nk-menu-link"><span class="nk-menu-text">Blocked Users</span></a>
                                            </li>
                                        </ul><!-- .nk-menu-sub -->
                                    </li><!-- .nk-menu-item -->
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-headphone-fill"></em></span>
                                            <span class="nk-menu-text">Listener Account</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                           
                                            <li class="nk-menu-item">
                                                <a href="{{url('view-listener')}}" class="nk-menu-link"><span class="nk-menu-text">View Listener</span></a>
                                            </li>
                                            
                                            <li class="nk-menu-item">
                                                <a href="{{url('block-listener')}}" class="nk-menu-link"><span class="nk-menu-text">Blocked Listener</span></a>
                                            </li>
                                            <hr>

                                            <li class="nk-menu-item">
                                                <a href="{{url('listener-payout')}}" class="nk-menu-link"><span class="nk-menu-text">Payout Requests</span></a>
                                            </li> 
											
											<li class="nk-menu-item">
                                                <a href="{{url('listener-charge')}}" class="nk-menu-link"><span class="nk-menu-text">Listner Charge</span></a>
                                            </li> 
                                        </ul><!-- .nk-menu-sub -->
                                    </li><!-- .nk-menu-item -->
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-repeat-fill"></em></span>
                                            <span class="nk-menu-text">Transaction</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="{{url('search-transaction')}}" class="nk-menu-link"><span class="nk-menu-text">Search All Transaction</span></a>
                                            </li>

                                        </ul><!-- .nk-menu-sub -->
                                    </li><!-- .nk-menu-item -->
                                    
                                     <!--Send msg-->
                                    <li class="nk-menu-item has-sub">
                                        <a href="{{url('send-message')}}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-send"></em></span>
                                            <span class="nk-menu-text">Send Message</span>
                                        </a>                                    
                                    </li><!-- .nk-menu-item -->

                                    <li class="nk-menu-item has-sub">
                                        <a href="{{url('send-notification')}}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-bell-fill"></em></span>
                                            <span class="nk-menu-text">Send Notification</span>
                                        </a>                                    
                                    </li><!-- .nk-menu-item -->
                                    
                                    <li class="nk-menu-item has-sub">
                                        <a href="{{url('offence-report')}}" class="nk-menu-link text-danger">
                                            <span class="nk-menu-icon"><em class="icon ni ni-alert-circle text-danger"></em></span>
                                            <span class="nk-menu-text">Offence Reported</span>
                                        </a>                                    
                                    </li><!-- .nk-menu-item -->



                                </ul><!-- .nk-menu -->
                            </div><!-- .nk-sidebar-menu -->
                        </div><!-- .nk-sidebar-content -->
                    </div><!-- .nk-sidebar-element -->
                
                  </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="{{url('home')}}" class="logo-link">
                                   
                                     <img class="logo-dark logo-img" src="{{('public/uploads/app-icon.jpg')}}" srcset="{{('public/uploads/app-icon.jpg 2x')}}" alt="logo-dark">
                            <img class="logo-dark logo-img" src="{{('public/uploads/app-icon.jpg')}}" srcset="{{('public/uploads/app-icon.jpg 2x')}}" alt="logo-dark">
                                </a>
                            </div><!-- .nk-header-brand -->
                           <!-- <div class="nk-header-search ms-3 ms-xl-0">
                                <em class="icon ni ni-search"></em>
                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search anything">
                            </div>--><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    
                                    <li class="dropdown chats-dropdown hide-mb-xs">
                                       
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Recent Chats</span>
                                                <a href="#">Setting</a>
                                            </div>
                                            <div class="dropdown-body">
                                                <ul class="chat-list">
                                                    <li class="chat-item">
                                                        <a class="chat-link" href="html/apps-chats.html">
                                                            <div class="chat-media user-avatar">
                                                                <span>IH</span>
                                                                <span class="status dot dot-lg dot-gray"></span>
                                                            </div>
                                                            <div class="chat-info">
                                                                <div class="chat-from">
                                                                    <div class="name">Iliash Hossain</div>
                                                                    <span class="time">Now</span>
                                                                </div>
                                                                <div class="chat-context">
                                                                    <div class="text">You: Please confrim if you got my last messages.</div>
                                                                    <div class="status delivered">
                                                                        <em class="icon ni ni-check-circle-fill"></em>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li><!-- .chat-item -->
                                                    <li class="chat-item is-unread">
                                                        <a class="chat-link" href="html/apps-chats.html">
                                                            <div class="chat-media user-avatar bg-pink">
                                                                <span>AB</span>
                                                                <span class="status dot dot-lg dot-success"></span>
                                                            </div>
                                                            <div class="chat-info">
                                                                <div class="chat-from">
                                                                    <div class="name">Mr.Bean</div>
                                                                   
                                                                </div>
                                                                <div class="chat-context">
                                                                    <div class="text">Hi, I am Bean, can you help me with this problem ?</div>
                                                                    <div class="status unread">
                                                                        <em class="icon ni ni-bullet-fill"></em>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li><!-- .chat-item -->
                                                    <li class="chat-item">
                                                        <a class="chat-link" href="html/apps-chats.html">
                                                            <div class="chat-media user-avatar">
                                                                <img src="images/avatar/b-sm.jpg" alt="">
                                                            </div>
                                                            <div class="chat-info">
                                                                <div class="chat-from">
                                                                    <div class="name">George Philips</div>
                                                                    <span class="time">6 Apr</span>
                                                                </div>
                                                                <div class="chat-context">
                                                                    <div class="text">Have you seens the claim from Rose?</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li><!-- .chat-item -->
                                                    <li class="chat-item">
                                                        <a class="chat-link" href="html/apps-chats.html">
                                                            <div class="chat-media user-avatar user-avatar-multiple">
                                                                <div class="user-avatar">
                                                                    <img src="images/avatar/c-sm.jpg" alt="">
                                                                </div>
                                                                <div class="user-avatar">
                                                                    <span>AB</span>
                                                                </div>
                                                            </div>
                                                            <div class="chat-info">
                                                                <div class="chat-from">
                                                                    <div class="name">Softnio Group</div>
                                                                    <span class="time">27 Mar</span>
                                                                </div>
                                                                <div class="chat-context">
                                                                    <div class="text">You: I just bought a new computer but i am having some problem</div>
                                                                    <div class="status sent">
                                                                        <em class="icon ni ni-check-circle"></em>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li><!-- .chat-item -->
                                                    <li class="chat-item">
                                                        <a class="chat-link" href="html/apps-chats.html">
                                                            <div class="chat-media user-avatar">
                                                                <img src="images/avatar/a-sm.jpg" alt="">
                                                                <span class="status dot dot-lg dot-success"></span>
                                                            </div>
                                                            <div class="chat-info">
                                                                <div class="chat-from">
                                                                    <div class="name">Larry Hughes</div>
                                                                    <span class="time">3 Apr</span>
                                                                </div>
                                                                <div class="chat-context">
                                                                    <div class="text">Hi Frank! How is you doing?</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li><!-- .chat-item -->
                                                    <li class="chat-item">
                                                        <a class="chat-link" href="html/apps-chats.html">
                                                            <div class="chat-media user-avatar bg-purple">
                                                                <span>TW</span>
                                                            </div>
                                                            <div class="chat-info">
                                                                <div class="chat-from">
                                                                    <div class="name">Tammy Wilson</div>
                                                                    <span class="time">27 Mar</span>
                                                                </div>
                                                                <div class="chat-context">
                                                                    <div class="text">You: I just bought a new computer but i am having some problem</div>
                                                                    <div class="status sent">
                                                                        <em class="icon ni ni-check-circle"></em>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li><!-- .chat-item -->
                                                </ul><!-- .chat-list -->
                                            </div><!-- .nk-dropdown-body -->
                                            <div class="dropdown-foot center">
                                                <a href="html/apps-chats.html">View All</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown notification-dropdown">
                                       
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                                <a href="#">Mark All as Read</a>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification">
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-notification -->
                                            </div><!-- .nk-dropdown-body -->
                                            <div class="dropdown-foot center">
                                                <a href="#">View All</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-xl-block">
                                                  
                                                    <div class="user-name dropdown-indicator">{{ Auth::user()->name }}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>AB</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{ Auth::user()->name }}</span>
                                                        <span class="sub-text">{{ Auth::user()->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <!--<li><a href="#"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>   -->                                           
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
												<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->