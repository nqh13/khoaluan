<?php
    require_once('./../classes/user.php');
    require_once('./../classes/topic.php');
    $user = new User();
    $topic = new Topic();
    $countUsers = $user->countUsers()->fetchColumn();
    $countTopics = $topic->countTopics()->fetchColumn();

    


?> 
 
 <!-- 4-blocks row start -->
 <div class="row dashboard-header">
     <div class="col-lg-3 col-md-6">
         <div class="card dashboard-product">
             <span>Người dùng</span>
             <h2 class="dashboard-total-products text-center"><?php
             echo $countUsers;?></h2>
             <span class="label label-warning">User</span>Số lượng người dùng.
             <div class="side-box">
                 <i class="ti-user text-warning-color"></i>
             </div>
         </div>
     </div>
     <div class="col-lg-3 col-md-6">
         <div class="card dashboard-product">
             <span>Đề tài</span>
             <h2 class="dashboard-total-products text-center"><?php
             echo $countTopics;?></h2>
             <span class="label label-primary">Đề tài</span>Số lượng đề tài
             <div class="side-box">
                 <i class="ti-book text-primary-color"></i>
             </div>
         </div>
     </div>
     <div class="col-lg-3 col-md-6">
         <div class="card dashboard-product">
             <span>Hoàn thành đề tài</span>
             <h2 class="dashboard-total-products text-center"><span>--</span></h2>
             <span class="label label-success">Hoàn thành</span>sinh viên hoàn thành
             <div class="side-box">
                 <i class="ti-check text-success-color"></i>
             </div>
         </div>
     </div>
     <div class="col-lg-3 col-md-6">
         <div class="card dashboard-product">
             <span>Không hoàn thành đề tài</span>
             <h2 class="dashboard-total-products text-center"><span>--</span></h2>
             <span class="label label-danger">Làm Lại</span>Sinh viên không hoàn thành
             <div class="side-box">
                 <i class="ti-close text-danger-color"></i>
             </div>
         </div>
     </div>
 </div>
 <!-- 4-blocks row end -->