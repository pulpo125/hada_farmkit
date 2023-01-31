<?php

include "DBcon.php";

/**
 * @var PDOStatement $connect
 */

//쿼리 생성,실행
$managing_store = $_GET["managing_store"];
//$query_list = "SELECT count(c.customer_id)*count(ds.delivery_schedule_id) FROM customer c, delivery_schedule ds GROUP BY delivery_id";
$query_list = "SELECT delivery_id, count(customer_id) FROM customer GROUP BY delivery_id";
/*$query_list = "SELECT DISTINCT customer_id, customer_name, customer_contact, customer_menu, district, specific_address, team_id, team_name
            FROM delivery d
            LEFT JOIN customer c ON d.delivery_id=c.delivery_id
            LEFT JOIN team t ON d.delivery_id=t.delivery_id
            LEFT JOIN delivery_schedule ds ON d.delivery_id=ds.delivery_id
            LEFT JOIN managing_district md ON d.district=md.district_name
            WHERE managing_store='$managing_store'
            ORDER BY c.customer_id";*/
$result_list = $connect->query($query_list) or die($connect->errorInfo());
//$man = $result_list->fetch();

//오늘 요일
$date = date("Y-m-d");
//$day = array("일","월","화","수","목","금","토");
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
                <th><a href="">전체</a></th>
                <th class=<?php echo $managing_store=='1호점' ? "here" : ""; ?>><a href="2_week.php?managing_store=1호점">1호점</a></th>
                <th class=<?php echo $managing_store=='2호점' ? "here" : ""; ?>><a href="2_week.php?managing_store=2호점">2호점</a></th>
            </tr>
        </table>
        <div class="lftSelect">
            <li class="lftSelectSection">고객 관리
                <ul>
                    <li><a href="1_db.php?managing_store=1호점">- DB</a></li>
                </ul>
            </li>
            <li class="lftSelectSection">배송 관리
                <ul>
                    <li class="now"><a href="2_week.php?managing_store=1호점">- WEEK</a></li>
                    <li><a href="3_today.php?managing_store=1호점">- TODAY</a></li>
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
                <h3>이번 주 주문을 확인하세요</h3>
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
                        <!--<th class=<?php /*echo $category_num=='1' ? "now" : ""; */?>>월요일</th>-->
                        <th class=<?php echo $day_today=='Mon' ? "today" : ""; ?> >월요일</th>
                        <th class=<?php echo $day_today=='Tue' ? "today" : ""; ?> >화요일</th>
                        <th class=<?php echo $day_today=='Wed' ? "today" : ""; ?> >수요일</th>
                        <th class=<?php echo $day_today=='Thur' ? "today" : ""; ?> >목요일</th>
                        <th class=<?php echo $day_today=='Fri' ? "today" : ""; ?> >금요일</th>
                        <th class=<?php echo $day_today=='Sat' ? "today" : ""; ?> >토요일</th>
                        <th class=<?php echo $day_today=='Sun' ? "today" : ""; ?> >일요일</th>
                    </tr>
                    </thead>

                    <tbody>
<!--                    --><?php
//                    $index=0;
//                    while(){
//                    ?>

                    <tr>
                <?php
                $index=0;
                while($row = $result_list -> fetch() AND $index<7){
                    $loop_day = array("Mon","Tue","Wed","Thur","Fri","Sat","Sun");
                    $query_tbSum = "SELECT count(c.customer_id) AS cIDcnt, count(ds.delivery_schedule_id) AS dsIDcnt
                                        FROM delivery d
                                        LEFT JOIN customer c ON d.delivery_id=c.delivery_id
                                        LEFT JOIN delivery_schedule ds ON d.delivery_id=ds.delivery_id
                                        WHERE managing_store='$managing_store' AND delivery_day='$loop_day[$index]'
                                        GROUP BY delivery_id";
//                    $result_tbSum = $connect->query($query_tbSum) or die($connect->errorInfo());
//                    print_r($result_tbSum);
//                    $row_tbSum = $result_tbSum->fetch();
//                    print_r($row_tbSum);
                    ?>
                    <td class="tbSum <?php echo $day_today==$loop_day[$index] ? "today" : ""; ?>" ><!--월~일-->
                        총 주문: <?php /*echo $row_tbSum["cIDcnt"]; */?>
                        <br>
                        총 배달: <?php /*echo $row_tbSum["dsIDcnt"]; */?>
                    </td>
                    <?php
                    ++$index;
                }
                ?>
                    </tr>


                    <tr>
                        <?php
                            while($row = $result_list -> fetch()){}
                        ?>
                        <td class="tbTime"><!--월-->
                            <b>아침</b>
                            <br>
                            [8:00]
                            <br>
                            [9:00]
                        </td>
                        <td class="tbTime"><!--화-->
                            <b>아침</b>
                            <br>
                            [8:00]
                            <br>
                            [9:00]
                        </td>
                        <td class="tbTime"><!--수-->
                            <b>아침</b>
                            <br>
                            [8:00]
                            <br>
                            [9:00]
                        </td>
                        <td class="tbTime"><!--목-->
                            <b>아침</b>
                            <br>
                            [8:00]
                            <br>
                            [9:00]
                        </td>
                        <td class="tbTime"><!--금-->
                            <b>아침</b>
                            <br>
                            [8:00]
                            <br>
                            [9:00]
                        </td>
                        <td class="tbTime"><!--토-->
                            <b>아침</b>
                            <br>
                            [8:00]
                            <br>
                            [9:00]
                        </td>
                        <td class="tbTime"><!--일-->
                            <b>아침</b>
                            <br>
                            [8:00]
                            <br>
                            [9:00]
                        </td>
                    </tr>
                    <tr>
                        <td class="tbTime"><!--월-->
                            <b>점심</b>
                            <br>
                            [11:00]
                            <br>
                            [12:00]
                        </td>
                        <td class="tbTime"><!--화-->
                            <b>점심</b>
                            <br>
                            [11:00]
                            <br>
                            [12:00]
                        </td>
                        <td class="tbTime"><!--수-->
                            <b>점심</b>
                            <br>
                            [11:00]
                            <br>
                            [12:00]
                        </td>
                        <td class="tbTime"><!--목-->
                            <b>점심</b>
                            <br>
                            [11:00]
                            <br>
                            [12:00]
                        </td>
                        <td class="tbTime"><!--금-->
                            <b>점심</b>
                            <br>
                            [11:00]
                            <br>
                            [12:00]
                        </td>
                        <td class="tbTime"><!--토-->
                            <b>점심</b>
                            <br>
                            [11:00]
                            <br>
                            [12:00]
                        </td>
                        <td class="tbTime"><!--일-->
                            <b>점심</b>
                            <br>
                            [11:00]
                            <br>
                            [12:00]
                        </td>
                    </tr>
                    <tr>
                        <td class="tbTime last"><!--월-->
                            <b>저녁</b>
                            <br>
                            [18:00]
                            <br>
                            [19:00]
                        </td>
                        <td class="tbTime last"><!--화-->
                            <b>저녁</b>
                            <br>
                            [18:00]
                            <br>
                            [19:00]
                        </td>
                        <td class="tbTime last"><!--수-->
                            <b>저녁</b>
                            <br>
                            [18:00]
                            <br>
                            [19:00]
                        </td>
                        <td class="tbTime last"><!--목-->
                            <b>저녁</b>
                            <br>
                            [18:00]
                            <br>
                            [19:00]
                        </td>
                        <td class="tbTime last"><!--금-->
                            <b>저녁</b>
                            <br>
                            [18:00]
                            <br>
                            [19:00]
                        </td>
                        <td class="tbTime last"><!--토-->
                            <b>저녁</b>
                            <br>
                            [18:00]
                            <br>
                            [19:00]
                        </td>
                        <td class="tbTime last"><!--일-->
                            <b>저녁</b>
                            <br>
                            [18:00]
                            <br>
                            [19:00]
                        </td>
                    </tr>
<!--                    --><?php
//                        ++$index;
//                    }
//                    ?>
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