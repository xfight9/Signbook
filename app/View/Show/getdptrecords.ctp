        <header>
          <div class="logo text-center"><a href="index.html"><img src="../img/logo.png" ></a></div>
            <h1 class="title text-center">有米考勤签到分析神器</h1>
        </header>
        <div class="container">
            <div class="text-center mgb-20">
                <input id="monthSelector" class="form-control sb-inline-form-control" placeholder="请选择月份" type="text" />
                <a href="#" class="btn btn-green">查看其他数据</a>

            </div>
            <hr />
            <div class="text-center mgb-20">
                <select class="form-control type-selector">
                    <option value="all">全部</option>
                    <option value="tech">技术研发中心</option>
                    <option value="action">行政部</option>
                    <option value="hr">人事部</option>
                    <option value="business">商务部</option>
                </select>
                <a href="#" class="btn btn-blue">导出该月记录</a>
            </div>
        </div>
        <div>
            <div class="table-wrap">
            <ul class="table-tag">
              <li><span class="iconfont">休假 &#xf004f;</li>
              <li><span class="iconfont">出勤 &#xf00b2;</li>
              <li><span class="iconfont">迟到 &#xf01a3;</li>
              <li><span class="iconfont">早退 &#x3444;</li>
              <li><span class="iconfont">旷工 &#xf004f;</li>
              <li><span class="iconfont">异常 &#xf00b3;</li>
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
    for($i = 1; $i <= $n_day; $i++) {
        $date = $year. '-' .$month . '-'. $i;
        $weekday = date('D', strtotime($date));
        echo '<th>'.$weekday.'</th>';
       
    }        

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
        $trHTML = '<tr><th rowspan="2">'. $name .'</th><th>上午</th>' ;

        foreach ($result as $day_data) {//for someone day fornoon
            
            switch ($day_data['state_forenoon']) {

                case 0://empty
                    $trHTML.= '<td class="iconfont">e</td>';
                    break;

                case 1://normal
                    $trHTML.= '<td class="iconfont">&#xf00b2;</td>';
                    break;

                case 2://late
                    $trHTML.= '<td class="iconfont">&#xf00b2;</td>';
                    break;

                case 3://旷工
                    $trHTML.= '<td class="iconfont">&#xf00b2;</td>';
                    break;  

                case 4://早退
                    $trHTML.= '<td class="iconfont">&#xf00b2;</td>';
                    break;                      

                default://empty
                    $trHTML.= '<td class="iconfont">e</td>';
                    break;
            }

            
        }
        $trHTML .= '</tr> <tr> <th>下午</th>' ;

        foreach ($result as $day_data) {
            switch ($day_data['state_afternoon']) {

                case 0://empty
                    $trHTML.= '<td class="iconfont">e</td>';
                    break;

                case 1://normal
                    $trHTML.= '<td class="iconfont">&#xf00b2;</td>';
                    break;

                case 2://late
                    $trHTML.= '<td class="iconfont">&#xf00b2;</td>';
                    break;

                case 3://旷工
                    $trHTML.= '<td class="iconfont">&#xf00b2;</td>';
                    break;  
                    
                case 4://早退
                    $trHTML.= '<td class="iconfont">&#xf00b2;</td>';
                    break;                      

                default://empty
                    $trHTML.= '<td class="iconfont">e</td>';
                    break;
            }
            
        }
        echo $trHTML.'</tr>';
    }//end foreach.someone
?>
<!--                     <tr>
                    <th rowspan="2">罗跃</th>
                    <th>上午</th> -->
                   <!--  <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont td-warning">&#xf00b3;</td>
                    <td class="iconfont td-warning">&#xf00b3;</td>
                    <td data-toggle="tooltip" data-placement="top" data-original-title="2018-09-05 12:00" class="iconfont td-warning">&#xf00b3;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf004f;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td> -->

<!--                     <td class="iconfont">&#xf01a3;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#x3444;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#x3444;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td>
                    <td class="iconfont">&#xf00b2;</td> -->
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
