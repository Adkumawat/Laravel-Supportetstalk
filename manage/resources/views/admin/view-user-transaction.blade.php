<!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <a class="back-to" href="view-user.php"><em class="icon ni ni-arrow-left"></em><span>Go Back</span></a>
                                <h3 class="nk-block-title page-title">View User Transactions</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                           <!-- <li>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-search"></em>
                                                    </div>
                                                    <input type="text" class="form-control" id="default-04" placeholder="Quick search by id">
                                                </div>
                                            </li>-->
                                           <!-- <li>
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-bs-toggle="dropdown">Transaction Type</a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><span>Call</span></a></li>
                                                            <li><a href="#"><span>Chat</span></a></li>
                                                            <li><a href="#"><span>Recharge</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>  -->                                         
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="nk-tb-list is-separate is-medium mb-3">
                            <div class="nk-tb-item nk-tb-head">                               
                                <div class="nk-tb-col"><span>Trn ID</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Date/Time</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-block">Transaction Type</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-block">With Listener</span></div>
                                <!--<div class="nk-tb-col tb-col-sm"><span>Time Duration</span></div>-->
                                <div class="nk-tb-col tb-col-md"><span>Amount</span></div>
                                <div class="nk-tb-col"><span>Credit/Debit</span></div>
                                 <div class="nk-tb-col"><span>Duration</span></div>
                               <!-- <div class="nk-tb-col"><span>Balance Amount</span></div>  -->                              
                            </div>
                            <!-- .nk-tb-item -->
							<?php $i=1; foreach($user_transections as $data){
						
							?>
                            <div class="nk-tb-item">                                
                                <div class="nk-tb-col">
                                    <span class="tb-lead"><a href="#"><?php echo $data->payment_id ?? '--'; ?></a></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <!--<span class="tb-lead"><i class="icon ni ni-clock text-success"></i><?php echo $data->created_at; ?></span>-->
                                    <span class="tb-lead"><?php echo $data->created_at; ?></span>
                                </div>
                                <div class="nk-tb-col">   
                                        <?php if($data->mode == 'chat'){ ?>
										<span class="badge badge-sm has-bg bg-purple d-none d-sm-inline-flex"><em class="icon ni ni-msg"></em>&nbsp;<?php echo $data->mode; ?></span>
										<?php }elseif($data->mode == 'call'){?>
										<span class="badge badge-sm has-bg bg-warning d-none d-sm-inline-flex"><em class="icon ni ni-call"></em>&nbsp;<?php echo $data->mode; ?></span>
									    <?php }elseif($data->mode == 'recharge'){ ?>
										<span class="badge badge-sm has-bg bg-success d-none d-sm-inline-flex"><em class="icon ni ni-money"></em>&nbsp;<?php echo $data->mode; ?></span>
								        <?php }else{ ?>
										<span class="badge badge-sm has-bg bg-danger d-none d-sm-inline-flex"><em class="icon ni ni-money"></em>&nbsp;<?php echo $data->mode; ?></span>
								        <?php }?>
								</div>
                                <div class="nk-tb-col"> 
                                    <div class="user-info">
                                        <span class="tb-lead"><?php echo $data->name ?? '--'; ?><span class="dot dot-success d-md-none ms-1"></span></span>
                                        <span><?php echo $data->mobile_no; ?></span>
                                    </div>
                                </div>
                                <!--<div class="nk-tb-col tb-col-sm">
                                    <span class="tb-sub"></span>
                                </div>-->
                                <div class="nk-tb-col tb-col-md">
								<?php if($data->cr_amount == '0.00'){ ?>
                                    <span class="tb-sub text-danger">&#x20B9;<?php echo $data->dr_amount; ?></span>
                                <?php }else{ ?>
								    <span class="tb-sub text-success">&#x20B9;<?php echo $data->cr_amount; ?></span>
								<?php } ?>
								</div>
                                <div class="nk-tb-col">
								<?php if($data->cr_amount == '0.00'){ ?>
                                    <span class="tb-lead text-danger">DR</span>
									 <?php }else{ ?>
									 <span class="tb-lead text-success">CR</span>
									 <?php } ?>
                                </div>
                               <div class="nk-tb-col">
                                    <span class="tb-lead"><?php echo $data->duration; echo" "; echo "  ";?> Minutes </span>
                                </div>                            
                            </div>
                            <?php  $i++; } ?>

                        </div><!-- .nk-tb-list -->
                      
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
    <!-- JavaScript -->
    <script src="assets/js/bundle.js?ver=3.0.0"></script>
    <script src="assets/js/scripts.js?ver=3.0.0"></script>
</body>

</html>