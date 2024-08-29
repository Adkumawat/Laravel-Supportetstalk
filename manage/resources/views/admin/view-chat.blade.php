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
                                    <span class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></span>                                                                  </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                   
                        
         <div class=" row card"> <!-- card body -->
         <div class="card-body"> 
         
        <div class="row">
            <div class="col-md-12"  style="text-align:center">
                <b>Total Duration:</b> <?php
                $time = array();
                foreach($datas as $data){
                    $time[] = $data['fields']['time']['timestampValue'];
                }
                    $time_min = min($time);
                    $time_max = max($time);
           
                    $time_min = date_create($time_min);
                    $time_max = date_create($time_max);
                    $diff =  date_diff($time_min, $time_max);
                    echo $diff->format("%Y-%m-%d %H:%I:%S");
                ?>
            </div>
        </div>
         <div class="row">
       
          <div class="col-md-6" style="text-align:left">                    
   <strong><b>User Name : </b></strong> <?php echo $datasdetails['user_name']['stringValue'];?><br>
  
   <!-- <strong><b></b>Total User Messages : </b></strong><?php echo $datasdetails['user_count']['integerValue'];?> <br>-->
     </div>
  <div class="col-md-6" style="text-align:right; ">
    <strong><b>Listener Name : </b></strong> <?php echo $datasdetails['listener_name']['stringValue'];?><br>
  
  
   </div>
   </div>
   
    <div class="row"> 
      <div class="col-md-12">
      <?php
      $chat = array();
    foreach($datas as $data){
        $chat[] = array(
            'sendby' => $data['fields']['sendby']['stringValue'],
            'message' => $data['fields']['message']['stringValue'],
            'time' => $data['fields']['time']['timestampValue']
            );
    }
    function date_compare($element1, $element2) {
        $datetime1 = strtotime($element1['time']);
        $datetime2 = strtotime($element2['time']);
        return $datetime2 - $datetime1;
    } 
      
    // Sort the array 
    usort($chat, 'date_compare');
    foreach($chat as $data){
        if($data['sendby']=="Anonymous"){?>
           
               
                    <p style="padding-top:25px;">
                        <span><b>Send By :</b> </span> <span><?php echo $data['sendby'];?></span>
                        <span> <b> Message :</b> <?php echo $data['message'];?></span><br>
                        <span><b>Send Time :</b> </span> <span><?php  echo date('Y-m-d g:i:a', strtotime($data['time']));?></span>
                    </p>
               
                <?php }else{ ?>
                
                    <p style="padding-top:25px;text-align:right"> 
                   
                         <?php echo $data['message'];?></span><span> <b> : Message </b>
                         <span><?php echo $data['sendby'];?></span> <span><b>: By Send</b> </span> <br>
                         <span><?php  echo date('Y-m-d g:i A.', strtotime($data['time']));?></span> <span><b> : Time Send</b> </span>
                          </p>
                          
                         
                          
                <?php }} ?>
         </div>
         
        </div>
        </div>
    </div>
    
    </div>
    </div> 
    </div> 
    
    
     
    </div> 
    <!-- card body end --->
       
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