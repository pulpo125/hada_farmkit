<?php

include "DBcon.php";

/**
 * @var PDOStatement $connect
 */

$managing_store = $_GET["managing_store"];

//common쿼리 생성 (루프 실행하며 WHERE 뒷부분 덧붙여서 사용)
$query_common = "SELECT COUNT(DISTINCT c.customer_id), /*COUNT(DISTINCT d.delivery_id), */COUNT(DISTINCT ds.delivery_schedule_id)
                                        FROM delivery d
                                        LEFT JOIN customer c ON d.delivery_id=c.delivery_id
                                        LEFT JOIN delivery_schedule ds ON d.delivery_id=ds.delivery_id
                                        LEFT JOIN managing_district md ON d.district=md.district_name
                                        WHERE managing_store='$managing_store'";

//오늘 요일
$date = date("Y-m-d");
$day = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
$day_today = ($day[date('w', strtotime($date))]);

?>

<!doctype html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Week</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/2_week.css">
</head>
<body>

<!--페이지 시작-->
<div id="pageWrapper">
    <!--좌측 네비게이션 시작-->
    <div id="leftNavWrapper">
        <div id="clockDate"></div>
        <div id="clockTime"></div>
        <div class="storeBox"><?php echo $managing_store; ?></div>
        <table>
            <colgroup>
                <col width="30%">
                <col width="30%">
                <col width="30%">
            </colgroup>
            <tr>
                <th><a href="../pages/4_dashboard.php">전체</a></th>
                <th class=<?php echo $managing_store=='1호점' ? "here" : ""; ?>><a href="2_week.php?managing_store=1호점">1호점</a></th>
                <th class=<?php echo $managing_store=='2호점' ? "here" : ""; ?>><a href="2_week.php?managing_store=2호점">2호점</a></th>
            </tr>
        </table>
        <div class="lftSelect">
            <li class="lftSelectSection">고객 관리
                <ul>
                    <li><a href="1_db.php?managing_store=<?php echo $managing_store; ?>">- DB</a></li>
                </ul>
            </li>
            <li class="lftSelectSection">배송 관리
                <ul>
                    <li class="now"><a href="2_week.php?managing_store=<?php echo $managing_store; ?>">- WEEK</a></li>
                    <li><a href="3_today.php?managing_store=<?php echo $managing_store; ?>">- TODAY</a></li>
                </ul>
            </li>
        </div>

    </div>
    <!--좌측 네비게이션 끝-->

    <!--메인 페이지 시작-->
    <div id="mainPgWrapper">
        <!--header-->
        <header>
            <div>
                <h1>Week</h1>
            </div>
            <div>
                <h3>이번 주 주문 개수를 확인하세요</h3>
            </div>
        </header>

        <!--contents-->
        <main>
            <div>
                <table>

                    <colgroup>
                        <col width="190px">
                        <col width="190px">
                        <col width="190px">
                        <col width="190px">
                        <col width="190px">
                        <col width="190px">
                        <col width="190px">
                    </colgroup>

                    <thead>
                    <tr id="day_head">
                        <th class=<?php echo $day_today=='Mon' ? "today" : ""; ?> >월요일</th>
                        <th class=<?php echo $day_today=='Tue' ? "today" : ""; ?> >화요일</th>
                        <th class=<?php echo $day_today=='Wed' ? "today" : ""; ?> >수요일</th>
                        <th class=<?php echo $day_today=='Thu' ? "today" : ""; ?> >목요일</th>
                        <th class=<?php echo $day_today=='Fri' ? "today" : ""; ?> >금요일</th>
                        <th class=<?php echo $day_today=='Sat' ? "today" : ""; ?> >토요일</th>
                        <th class=<?php echo $day_today=='Sun' ? "today" : ""; ?> >일요일</th>
                    </tr>
                    </thead>

                    <tbody>
                    <!--총 배달, 총 주문-->
                    <tr>
                    <?php
                    $index=0;
                    while($index<7){
                        $loop_day = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
                        //쿼리 생성,실행
                        $query_tbSum = $query_common . " AND delivery_day='$loop_day[$index]'";
                        $result_tbSum = $connect->query($query_tbSum) or die($connect->errorInfo());
                        $row_tbSum = $result_tbSum->fetch();
                        //개수
                        $cID_cnt = $row_tbSum["COUNT(DISTINCT c.customer_id)"];
                        $dsID_cnt = $row_tbSum["COUNT(DISTINCT ds.delivery_schedule_id)"];
                        ?>
                        <td class="tbSum <?php echo $day_today==$loop_day[$index] ? "today" : ""; ?>" ><!--월~일-->
                            총 배달: <?php echo $dsID_cnt; ?>
                            <br>
                            <u>총 주문: <span class="<?php echo $cID_cnt!=0 ? "highlight" : ""; ?>"><?php echo $cID_cnt; ?></span></u>
                        </td>
                        <?php
                        ++$index;
                    }
                    ?>
                    </tr>

                    <!--아침, 점심, 저녁-->
                    <tr>
                        <?php
                        $i_day=0;

                        while($i_day<7){
                            $loop_day = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
                            $loop_time = array("08:00","09:00","11:00","12:00","18:00","19:00");
                            ?>
                            <td class="tbTime <?php echo $day_today==$loop_day[$i_day] ? "today" : ""; ?>" ><!--월~일-->
                                <p class="tbTitle">주문 개수</p>
                                <?php
                                $i_time=0;

                                while ($i_time<6){
                                    //쿼리 생성,실행
                                    $query_tbDetail = $query_common . " AND delivery_day='$loop_day[$i_day]' AND delivery_time='$loop_time[$i_time]'";
                                    $result_tbDetail = $connect->query($query_tbDetail) or die($connect->errorInfo());
                                    $row_tbDetail = $result_tbDetail->fetch();
                                    //개수
                                    $cID_cnt = $row_tbDetail["COUNT(DISTINCT c.customer_id)"];
                                    ?>
                                    <p class="<?php echo $i_time===0 ? "tbSub" : ( $i_time===2 ? "tbSub": ($i_time===4 ? "tbSub":"") ); ?>">
                                        <?php
                                            echo $i_time===0 ? "아침" : ( $i_time===2 ? "점심": ($i_time===4 ? "저녁":"") );
                                        ?>
                                    </p>
                                    <span class="<?php echo $cID_cnt!=0 ? "highlight" : ""; ?>">
                                        [<?php echo $loop_time[$i_time]; ?>] <?php echo $cID_cnt; ?>
                                    </span>
                                    <br>
                                    <?php
                                    ++$i_time;
                                }
                                ?>
                            </td>
                            <?php
                            ++$i_day;
                        }
                        ?>
                    </tr>

                    </tbody>

                </table>
            </div>
        </main>
    </div>
    <!--메인 페이지 끝-->
</div>
<!--페이지 끝-->

<!--JS연결-->
<script src="../js/base.js"></script>

</body>
</html>