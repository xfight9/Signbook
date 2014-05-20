        <header>
          <div class="logo text-center"><a href="/"><img src="/img/logo.png" ></a></div>
            <h1 class="title text-center">有米考勤签到分析神器</h1>
        </header>
        <div class="container">
            <form id="submitMore" action="/show/getdptrecords" method="get">
            <div class="text-center mgb-20">
                    <select class="form-control type-selector" name="dpt_name">
<?php 
    foreach ($dpt_names as $dpt_name) {
        if($dpt_name == $department) {
            echo '<option selected="selected" value= "'.$dpt_name.'">'.$dpt_name.'</option>';
        }
        else 
        echo '<option value= "'.$dpt_name.'">'.$dpt_name.'</option>';
    }

?>
                    </select>
                <input id="monthSelector" class="form-control sb-inline-form-control" name="month" placeholder="请选择月份" type="text" />

                <input class="btn btn-green" type="submit"  value="查看其他数据" />
            </div>
            </form>
            <hr />

        </div>
        <?php $this->Session->flash(); ?>
        <div>
            <div class="table-wrap">
            <ul class="table-tag">
              <li><span class="iconfont">出勤 <span>&#xf00b2;</span></li>
              <li><span class="iconfont">迟到 <span class="color-red">&#xf01a3;</span></li>
              <li><span class="iconfont">早退 <span class="color-green">&#x3444;</span></li>
            </ul>
            <table class="sb-table table table-bordered table-hover">
                <caption class="sb-caption">
<?php 
    echo ''.$year. '-'. $month. $department. '考勤统计';
?>
                </caption>
                <thead>
                <tr>
                    <th>姓名</th>
                    <th>星期</th>
<?php 
    $date = $year.$month;  //201403
    $month_timestamp = strtotime($date.'01');
    $n_day = date('t', $month_timestamp);
    $rest_days = array();
    for($i = 1; $i <= $n_day; $i++) {

        $date = $year. '-' .$month . '-'. $i;
        $weekday = date('D', strtotime($date));
        if($weekday == 'Sat' || $weekday == 'Sun') {
            echo '<th class="rest">'.$weekday.'</th>';
            $rest_days[] = $i;
        }
        else {
            echo '<th>'.$weekday.'</th>';           
        }   
    }        
    echo '<div class="rest_days hide">'.implode(',', $rest_days).'</div>';
?>
                </tr>
                    <tr>
                    <th> </th>
                    <th>日</th>
<?php 
    for($i = 1; $i <= $n_day; $i++) {
        echo '<th>'.$i.'</th>';
    }
?>
                    </tr>
                </thead>
                <tbody>

<?php 
    foreach ($results as $name=>$result) {//for someone
        $trHTML = '<tr><th>'. $name .'</th><th>上午</th>' ;

        foreach ($result as $day_data) {//for someone day fornoon

            switch ($day_data['state_forenoon']) {

                case 0://empty
                    $trHTML.= '<td title=" '. $day_data['sign_start'] .'"class="iconfont"></td>';
                    break;

                case 1://normal
                    $trHTML.= '<td title=" '. $day_data['sign_start'] .'"class="iconfont">&#xf00b2;</td>';
                    break;

                case 2://late
                    $trHTML.= '<td title=" '. $day_data['sign_start'] .'"class="iconfont color-red">&#xf01a3;</td>';
                    break;

                case 3://旷工
                    $trHTML.= '<td title=" '. $day_data['sign_start'] .'"class="iconfont color-yellow">&#x004f;</td>';
                    break;  

                case 4://早退
                    $trHTML.= '<td title=" '. $day_data['sign_start'] .'"class="iconfont color-green">&#x3444;</td>';
                    break;

                default://empty
                    $trHTML.= '<td title=" '. $day_data['sign_start'] .'"class="iconfont"></td>';
                    break;
            }

        }
        $trHTML .= '</tr> <tr><th></th> <th>下午</th>' ;

        foreach ($result as $day_data) {
            switch ($day_data['state_afternoon']) {
                case 0://empty
                    $trHTML.= '<td title=" '. $day_data['sign_end'] .'"class="iconfont"></td>';
                    break;

                case 1://normal
                    $trHTML.= '<td title=" '. $day_data['sign_end'] .'"class="iconfont">&#xf00b2;</td>';
                    break;

                case 2://late
                    $trHTML.= '<td title=" '. $day_data['sign_end'] .'"class="iconfont color-red">&#xf01a3;</td>';
                    break;

                case 3://旷工
                    $trHTML.= '<td title=" '. $day_data['sign_end'] .'"class="iconfont">&#x004f;</td>';
                    break;  

                case 4://早退
                    $trHTML.= '<td title=" '. $day_data['sign_end'] .'"class="iconfont color-green">&#x3444;</td>';
                    break;

                default://empty
                    $trHTML.= '<td title=" '. $day_data['sign_end'] .'"class="iconfont"></td>';
                    break;

            }
            
        }
        echo $trHTML.'</tr>';
    }//end foreach.someone
?>

                    </tr>
                </tbody>
            </table>
            </div>
        </div>
<?php echo $this->Html->scriptStart(array('block' => 'script')); ?>
    $(document).ready(
        function() {
            signbook.display.init();
        }
    );
<?php echo $this->Html->scriptEnd(); ?>