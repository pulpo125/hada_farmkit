<?php
include "DBcon.php";

/**
 * @var PDOStatement $connect
 */

$managing_store = $_GET["managing_store"];

/* 시간 */
/*$weekday = date('D');
$query  = "SELECT ds.delivery_id as delivery_id, delivery_time, COUNT(delivery_time) AS count_time
FROM delivery_schedule ds
    left join delivery d on ds.delivery_id = d.delivery_id
    left join managing_district md on d.district = md.district_name
    WHERE delivery_day = 'Thur' and managing_store = '$managing_store'
GROUP BY delivery_time
ORDER BY delivery_time";
$result = $connect->query($query) or die($connect->errorInfo());
$list = '';
while($row = $result->fetch())
{
    $time = $row['delivery_time'];
    $list = $list."<div onclick=selectTime('{$time}')><h3>{$time}</h3><p>{$row['count_time']}</p><p>/{$row['count_time']}</p></div>";
}*/

$weekday = date('D');
$query  = "SELECT ds.delivery_id as delivery_id, delivery_time, COUNT(delivery_time) AS count_time
FROM delivery_schedule ds
    left join delivery d on ds.delivery_id = d.delivery_id
    left join managing_district md on d.district = md.district_name
    WHERE delivery_day = 'Thur' and managing_store = '$managing_store'
GROUP BY delivery_time
ORDER BY delivery_time";
$result = $connect->query($query) or die($connect->errorInfo());
$list = array();
while($row = $result->fetch())
{
    $list[] = $row;
}

/* deliveryInfo */
$query = "SELECT delivery_time, d.delivery_id as delivery_id, district, specific_address, team_id, team_name
FROM delivery d
    LEFT JOIN delivery_schedule ds ON d.delivery_id = ds.delivery_id
    Left JOIN team t ON d.delivery_id = t.delivery_id
    left join managing_district md on d.district = md.district_name
where delivery_day = 'Thur' and managing_store = '$managing_store'
ORDER BY delivery_time";
$result = $connect->query($query) or die($connect->errorInfo());
$deliveryInfo = array();
while($row = $result->fetch())
{
    $deliveryInfo[] = $row;
}

/* customerInfo */
$query = "SELECT delivery_time, c.delivery_id as delivery_id, customer_id, customer_menu
FROM customer c
LEFT JOIN delivery d on c.delivery_id = d.delivery_id
LEFT JOIN delivery_schedule ds on d.delivery_id = ds.delivery_id
left join managing_district md on d.district = md.district_name
WHERE ds.delivery_day = 'Thur' and managing_store = '$managing_store'
ORDER BY delivery_time";
$result = $connect->query($query) or die($connect->errorInfo());
$customerInfo = array();
while($row = $result->fetch())
{
    $customerInfo[] = $row;
}
?>

<!doctype html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Today</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/3_today.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script>
        const timeInfo = <?php echo json_encode($list); ?>;
        const deliveryInfo = <?php echo json_encode($deliveryInfo); ?>;
        const customerInfo = <?php echo json_encode($customerInfo); ?>;
        let currentTag;
    </script>
</head>
<body>

<!--페이지 시작-->
<div id="pageWrapper">
    <!--좌측 네비게이션 시작-->
    <div id="leftNavWrapper">
        <div id="clockDate"></div>
        <div id="clockTime"></div>
        <div class="storeBox">0호점</div>
        <table>
            <colgroup>
                <col width="30%">
                <col width="30%">
                <col width="30%">
            </colgroup>
            <tr>
                <th><a href="">전체</a></th>
                <th class=<?php echo $managing_store=='1호점' ? "here" : ""; ?>><a href="3_today.php?managing_store=1호점">1호점</a></th>
                <th class=<?php echo $managing_store=='2호점' ? "here" : ""; ?>><a href="3_today.php?managing_store=2호점">2호점</a></th
            </tr>
        </table>
        <div class="lftSelect">
            <li class="lftSelectSection">고객 관리
                <ul>
                    <li><a href="1_db.php">- DB</a></li>
                </ul>
            </li>
            <li class="lftSelectSection">배송 관리
                <ul>
                    <li><a href="2_week.php">- WEEK</a></li>
                    <li class="now"><a href="3_today.html">- TODAY</a></li>
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
                <h1>TODAY</h1>
            </div>
            <div>
                <h3>오늘의 주문을 확인하세요.</h3>
            </div>
        </header>

        <!--contents-->
        <main>
            <div id="contentWrapper">
                <div class="contentBox">
                    <div id="timeBox" class="time_box">

                    </div>
                </div>
                <div class="contentBox">
                    <img src="../img/right_arrow.png" alt="right_arrow" id="arrow">
                </div>
                <div class="contentBox" id="tabHideBox">
                    <div id="tabHideContent">
                        좌측 시간대 버튼 미활성시 (=초기화면) <br>
                        버튼을 클릭하면 세부 사항을 볼 수 있다는 <br>
                        안내문구 삽입
                    </div>
                </div>
                <div class="contentBox" id="tabBox">
                    <ul id="tabList" class="tabs">
                        <!--<li class="tab-link current" data-tab="tab-1">ID 03</li>
                        <li class="tab-link" data-tab="tab-2">ID 30</li>-->
                    </ul>
                    <div id="tabContent" class="tab_content">
                        <button id="hideBtn" onclick="hideBtn()">X</button>
                        <h3 id="tabTime"><!--09:00--></h3>
                        <ul id="deliveryInfo">
                            <!--<li>- Delivery_ID: </li>
                            <li>- 배송지: </li>
                            <li>- Phone: </li>-->
                        </ul>
                        <hr>
                        <h3>주문내역</h3>
                        <div id="orderDetails">
                            <div id="teamInfo">
                                <!--<p>- Team_ID: </p>
                                <p>- Team: </p>-->
                                <!--<hr>-->
                            </div>
                            <ul id="customerInfo">
                                <!--<li>
                                    <p>- Customer_ID: </p>
                                   <p>- Menu: </p>-->
                                </li>-->
                            </ul>
                        </div>
                        <div id="tabFooter">
                            <button type="button" onclick="alert('발송이 완료되었습니다.')" class="submissionBtn">완료</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!--메인 페이지 끝-->
</div>
<!--페이지 끝-->

<!--JS연결-->
<script src="../js/base.js"></script>
<script src="../js/3_today.js"></script>

</body>
</html>
