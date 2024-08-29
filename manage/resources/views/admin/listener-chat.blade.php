<?php 
use App\Models\Registration;
?>
               <!-- content @s -->
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
                                <h3 class="nk-block-title page-title">View Chat History</h3>
                                <div class="nk-block-des text-soft">
                                   <!-- <p>Total 3 Chats.</p>-->
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
                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Chat With User</span></div>
                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Date/Time</span></div>
                                            <!--<div class="nk-tb-col tb-col-mb"><span class="sub-text">Chat Duration</span></div>-->
                                           <!-- <div class="nk-tb-col tb-col-md"><span class="sub-text">Charges</span></div>-->
                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Chat Transcript</span></div>                                         

                                        </div><!-- .nk-tb-item -->
                                        <?php
                                     //dd($documents);
                                        
                                        $i=1; foreach($documents as $data){ 
                                      //  $registrations=Registration::where('id',$data['fields']['user']['stringValue'])->get();
                                       // dd($registrations);
                                      //  foreach($registrations as $listeners){
                                           ?>
                                             
                                       
                                      
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col">
                                                <span class="tb-amount"><?php echo $i; ?></span>
                                            </div>
                                            <div class="nk-tb-col">                                               
                                                <div class="user-card">                                                       
                                                    <div class="user-info">
                                                        <span class="tb-lead"> <?php echo $data->user_name; ?></span>
                                                       <span  class="tb-lead"><?php echo $data->mobile_number ;?></span>
                                                    </div>
                                                </div>                                               
                                            </div>
                                            <div class="nk-tb-col">
                                              
                                                    <?php  echo $data->created_at;?>
                                            </div>
                                           <!-- <div class="nk-tb-col tb-col-mb">
                                               
                                            </div>-->
                                           <!-- <div class="nk-tb-col tb-col-md">
                                                <span class="tb-amount">&#x20B9;120</span>
                                            </div> -->
                                            <div class="nk-tb-col tb-col-md">
                                               
                                                
                                                <a href=" https://support2heal.com/manage/view-chat/<?php echo $data->chatroom ;?>"><em class="icon ni ni-chat-fill text-primary"></em><span> View chat</span></a>
                                           
                                            </div>                                                                                         
                                        </div>
                                       

                                     <?php  $i++; } ?>

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