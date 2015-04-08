<?php 
    $total_page = ceil($total_row / $limit);
?>

<div class="col-lg-6">
<span style="line-height:70px;">Total Data: <?=$total_row?></span>
</div>

<div class="col-lg-6" style="text-align:right;">
    <ul class="pagination">
        <li><a href="javascript:;" onclick="gotopage(1)">&laquo;</a></li>
        <?php
            if($page == 1) { $start_page = 1; $page_stop = $page + 4; }
            if($page == 2) { $start_page = 1; $page_stop = $page + 3; }
            if($page > 2) {
                $start_page = $page - 2;
                $page_stop = $page + 2;
            }
            if($page == $total_page-1) { $start_page = $page - 3; $page_stop = $total_page;}
            if($page == $total_page) { $start_page = $page - 4; $page_stop = $total_page;}

            if($start_page < 1) $start_page = 1;
            if($page_stop > $total_page) $page_stop = $total_page;

            for($i = $start_page; $i <= $page_stop; $i++) {
                if($i == $page) $class = 'active'; else $class = '';
                echo '<li class="'.$class.'"><a href="javascript:;" onclick="gotopage('.$i.')">'.$i.'</a></li>';
            }
        ?>
        <li><a href="javascript:;" onclick="gotopage(<?=$total_page?>)">&raquo;</a></li>
    </ul>
</div>