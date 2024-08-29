 <!-- content @s -->
 ggghg
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body wide-lg mx-auto">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-sub">
                                    <a class="back-to" href="{{ route('home') }}"><em class="icon ni ni-arrow-left"></em><span>Go Back</span></a>
                                </div>
                                <h3 class="nk-block-title page-title">View Call History</h3>
                                <div class="nk-block-des text-soft">
                                    <p> You have total <?php echo @$listner_call_count; ?> <span>Users</span></p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>                                                                  </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner ">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <div class="nk-tb-item nk-tb-head">                                          
                                            <div class="nk-tb-col"><span class="sub-text">SL. No</span></div>
                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Listener name</span></div>
                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">User name</span></div>
                                               <div class="nk-tb-col tb-col-mb"><span class="sub-text">Date/Time</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Call Recording</span></div>                                         
                                        </div><!-- .nk-tb-item -->
                                        <?php 
                                         use App\Models\Registration;
                                          $i=1;
                                         foreach($listner_call_data as $datas){ 
                                         $users=Registration::where('id',$datas->from_id)->first();
                                        
                                         ?>
                                        <div class="nk-tb-item">
                                           
                                            <div class="nk-tb-col">
                                                
                                                <span class="tb-amount"><?php echo $i; ?></span>
                                            </div>
                                            <div class="nk-tb-col">                                               
                                                <div class="user-card">                                                       
                                                    <div class="user-info">
                                                        <span class="tb-lead"><?php echo $datas->listner_name; ?></span>
                                                        <span><?php echo $datas->mobile_number; ?></span>
                                                    </div>
                                                </div>                                               
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-lead"><?php echo $users->name; ?></span>
                                                 <span><?php echo $users->mobile_no; ?></span>

                                            </div>
                                            <div class="nk-tb-col tb-col-mb">
                                                <span class="tb-lead"><?php  echo date('Y-m-d H:i:a', strtotime($datas->created_at));?></span>
                                            </div>
                                           
                                            <div class="nk-tb-col tb-col-md">
                                                <a href="<?php echo $datas->recorded_url;?>" target="_blank" download><em class="icon ni ni-circle-fill text-danger"></em><span>Recording</span></a>
                                            </div>   
                                         
                                        </div><!-- .nk-tb-item -->
                                       
                                    <?php   $i++; } ?>



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