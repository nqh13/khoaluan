<?php
//random background-color
// $background_color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);

require_once('../classes/topic.php');
$topic = new Topic();

$topicItem = $topic->getTopicByGV($_SESSION['ma_nguoidung']);

$results = $topicItem->fetchAll(PDO::FETCH_ASSOC);


?>


<div class="content container-fluid">
    <div class="row">
        <!-- <div class="col-md-4">
            <div class="card mt-3 " style="width:400px; background-color:aliceblue;">
                <div class="card-body">
                    <h4 class="card-title">John Doe</h4>
                    <p class="card-text">Some example text.</p>
                    <a href="#" class="btn btn-primary">See Profile</a>
                </div>
            </div>

        </div> -->
        <?php

        foreach ($results as $row) {
            echo '
            <a href="?page=chitiet&id=' . $row['ma_detai'] . ' style="text-decoration: none;">
                <div class="col-md-4">
                    <div class="card mt-3 " style="width:400px; box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;">
                        <div class="card-body">
                            <h4 class="card-title">' . $row['tendetai'] . '</h4>
                            <p class="card-text">' . $row['mota'] . '</p>
                            <a href="?page=chitiet&id=' . $row['ma_detai'] . '" class="btn btn-primary mt-2">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </a>
            ';
        }
        ?>






    </div>



</div>