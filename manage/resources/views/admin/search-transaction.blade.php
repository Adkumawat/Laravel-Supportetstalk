{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Transactions</title>
    <!-- Include CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Additional CSS -->
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <!-- Content Start -->
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <!-- Block Head -->
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <a class="back-to" href="{{ route('home') }}"><em class="icon ni ni-arrow-left"></em><span>Go Back</span></a>
                                <h3 class="nk-block-title page-title">Search Transactions</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-bs-toggle="dropdown">Transaction Type</a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="{{ route('call-transactions') }}"><span>Call</span></a></li>
                                                            <li><a href="{{ route('chat-transactions') }}"><span>Chat</span></a></li>
                                                            <li><a href="{{ route('recharge-transactions') }}"><span>Recharge</span></a></li>
                                                            <li><a href="{{ route('withdrawal-transactions') }}"><span>Withdrawal</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- Block Head End -->

                    <!-- Transaction List -->
                    <div class="nk-block">
                        <div class="nk-tb-list is-separate is-medium mb-3">
                            <!-- Table Head -->
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span>ID</span></div>
                                <div class="nk-tb-col"><span>Trn ID</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Date/Time</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-block">Transaction Type</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-block">Listener/User</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Amount</span></div>
                                <div class="nk-tb-col"><span>Credit/Debit</span></div>
                            </div><!-- .nk-tb-item -->

                            <!-- Transaction Items -->
                            @foreach ($transactions as $transaction)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col"><span class="tb-lead"><a href="#">{{ $transaction->id ?? '--' }}</a></span></div>
                                <div class="nk-tb-col"><span class="tb-lead"><a href="#">{{ $transaction->id ?? '--' }}</a></span></div>
                                <div class="nk-tb-col tb-col-md"><span class="tb-lead">{{ $transaction->created_at }}</span></div>
                                <div class="nk-tb-col">
                                    @php
                                        $badgeClass = '';
                                        switch ($transaction->mode) {
                                            case 'chat':
                                                $badgeClass = 'bg-purple';
                                                break;
                                            case 'call':
                                                $badgeClass = 'bg-warning';
                                                break;
                                            case 'recharge':
                                                $badgeClass = 'bg-success';
                                                break;
                                            default:
                                                $badgeClass = 'bg-danger';
                                                break;
                                        }
                                    @endphp
                                    <span class="badge badge-sm has-bg {{ $badgeClass }} d-none d-sm-inline-flex"><em class="icon ni ni-money"></em>&nbsp;{{ $transaction->mode }}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $transaction->name ?? '--' }}<span class="dot dot-success d-md-none ms-1"></span></span>
                                        <span>{{ $transaction->mobile_no }}</span>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    @if ($transaction->cr_amount == '0.00')
                                        <span class="tb-sub text-danger">&#x20B9;{{ $transaction->dr_amount }}</span>
                                    @else
                                        <span class="tb-sub text-success">&#x20B9;{{ $transaction->cr_amount }}</span>
                                    @endif
                                </div>
                                <div class="nk-tb-col">
                                    @if ($transaction->cr_amount == '0.00')
                                        <span class="tb-lead text-danger">DR</span>
                                    @else
                                        <span class="tb-lead text-success">CR</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            <!-- Transaction Items End -->

                        </div><!-- .nk-tb-list -->
                    </div><!-- .nk-block -->
                    <!-- Transaction List End -->

                </div><!-- .nk-content-body -->
            </div><!-- .nk-content-inner -->
        </div><!-- .container-fluid -->
    </div><!-- .nk-content -->
    <!-- Content End -->

    <!-- JavaScript -->
    <script src="{{ asset('assets/js/bundle.js?ver=3.0.0') }}"></script>
    <script src="{{ asset('assets/js/scripts.js?ver=3.0.0') }}"></script>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Transactions</title>
    <!-- Include CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Additional CSS -->
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <!-- Content Start -->
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <!-- Block Head -->
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <a class="back-to" href="{{ route('home') }}"><em class="icon ni ni-arrow-left"></em><span>Go Back</span></a>
                                <h3 class="nk-block-title page-title">Search Transactions</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-bs-toggle="dropdown">Transaction Type</a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="{{ route('call-transactions') }}"><span>Call</span></a></li>
                                                            <li><a href="{{ route('chat-transactions') }}"><span>Chat</span></a></li>
                                                            <li><a href="{{ route('recharge-transactions') }}"><span>Recharge</span></a></li>
                                                            <li><a href="{{ route('withdrawal-transactions') }}"><span>Withdrawal</span></a></li>
                                                        <li><a href="{{ route('bonus') }}"><span>Bonus</span></a></li>
                                                        <li><a href="{{ route('penalty') }}"><span>Penalty</span></a></li>
                                                        <li><a href="{{ route('reel') }}"><span>Reel Gift</span></a></li>
                                                         <li><a href="{{ route('reel') }}"><span>Video</span></a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- Block Head End -->

                    <!-- Transaction List -->
                    <div class="nk-block">
                        <div class="nk-tb-list is-separate is-medium mb-3">
                            <!-- Table Head -->
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span>Transaction</span></div>
                                {{-- <div class="nk-tb-col"><span>Trn ID</span></div> --}}
                                <div class="nk-tb-col tb-col-md"><span>Date/Time</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-block">Transaction Type</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-block">Listner/user</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Amount</span></div>
                                <div class="nk-tb-col"><span>Credit/Debit</span></div>
                            </div><!-- .nk-tb-item -->

                            <!-- Transaction Items -->
                            @foreach ($transactions as $transaction)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col"><span class="tb-lead"><a href="#">{{ $transaction->id ?? '--' }}</a></span></div>
                                {{-- <div class="nk-tb-col"><span class="tb-lead"><a href="#">{{ $transaction->mobile_no }}</a></span></div> --}}
                                <div class="nk-tb-col tb-col-md"><span class="tb-lead">{{ $transaction->created_at ?? '--' }}</span></div>

                                <div class="nk-tb-col">
                                    @php
                                        $badgeClass = '';
                                        switch ($transaction->mode) {
                                            case 'chat':
                                                $badgeClass = 'bg-purple';
                                                break;
                                            case 'call':
                                                $badgeClass = 'bg-warning';
                                                break;
                                            case 'recharge':
                                                $badgeClass = 'bg-success';
                                                break;
                                                 case 'bonus':
                                                $badgeClass = 'bg-success';
                                                break;
                                                 case 'penalty':
                                                $badgeClass = 'bg-danger';
                                                break;
                                                 case 'video':
                                                $badgeClass = 'bg-success';
                                                break;
                                                 case 'reel_gift':
                                                $badgeClass = 'bg-success';
                                                break;
                                            default:
                                                $badgeClass = 'bg-danger';
                                                break;
                                        }
                                    @endphp

                                    <span class="badge badge-sm has-bg {{ $badgeClass }} d-none d-sm-inline-flex"><em class="icon ni ni-money"></em>&nbsp;{{ $transaction->mode }}</span>
                                </div>

                                <div class="nk-tb-col">
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $transaction->type }}<span class="dot dot-success d-md-none ms-1"></span></span>
                                        <span class="tb-lead">{{ $transaction->name ?? 'Unknown' }}<span class="dot dot-success d-md-none ms-1"></span></span>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    @if ($transaction->cr_amount == '0.00')
                                        <span class="tb-sub text-danger">&#x20B9;{{ $transaction->dr_amount }}</span>
                                    @else
                                        <span class="tb-sub text-success">&#x20B9;{{ $transaction->cr_amount }}</span>
                                    @endif
                                </div>
                                <div class="nk-tb-col">
                                    @if ($transaction->cr_amount == '0.00')
                                        <span class="tb-lead text-danger">DR</span>
                                    @else
                                        <span class="tb-lead text-success">CR</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            <!-- Transaction Items End -->

                        </div><!-- .nk-tb-list -->

                        <!-- Pagination -->
                       <!-- Pagination -->
<div class="nk-block">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-Left">
            @if ($transactions->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $transactions->previousPageUrl() }}">&laquo; Previous</a></li>
            @endif

            @if ($transactions->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $transactions->nextPageUrl() }}">Next &raquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
            @endif
        </ul>
    </nav>
</div>
<!-- Pagination End -->

                        <!-- Pagination End -->

                    </div><!-- .nk-block -->
                    <!-- Transaction List End -->

                </div><!-- .nk-content-body -->
            </div><!-- .nk-content-inner -->
        </div><!-- .container-fluid -->
    </div><!-- .nk-content -->
    <!-- Content End -->

    <!-- JavaScript -->
    <script src="{{ asset('assets/js/bundle.js?ver=3.0.0') }}"></script>
    <script src="{{ asset('assets/js/scripts.js?ver=3.0.0') }}"></script>
</body>
</html>
