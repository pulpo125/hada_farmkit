<?php
include "DBcon.php";

/**
 * @var PDOStatement $connect
 */

$managing_store = $_GET["managing_store"];

/* timeInfo */
$weekday = date('D');
$query  = "SELECT ds.delivery_id as delivery_id, delivery_time, COUNT(delivery_time) AS count_time
FROM delivery_schedule ds
    left join delivery d on ds.delivery_id = d.delivery_id
    left join managing_district md on d.district = md.district_name
    WHERE delivery_day = '$weekday' and managing_store = '$managing_store'
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
where delivery_day = '$weekday' and managing_store = '$managing_store'
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
WHERE ds.delivery_day = '$weekday' and managing_store = '$managing_store'
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
    <title>TODAY</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/3_today.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script>
        const timeInfo = <?php echo json_encode($list); ?>;
        const deliveryInfo = <?php echo json_encode($deliveryInfo); ?>;
        const customerInfo = <?php echo json_encode($customerInfo); ?>;
    </script>
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
                <th class=<?php echo $managing_store=='1호점' ? "here" : ""; ?>><a href="3_today.php?managing_store=1호점">1호점</a></th>
                <th class=<?php echo $managing_store=='2호점' ? "here" : ""; ?>><a href="3_today.php?managing_store=2호점">2호점</a></th
            </tr>
        </table>
        <div class="lftSelect">
            <li class="lftSelectSection">고객 관리
                <ul>
                    <li><a href="1_db.php?managing_store=<?=$managing_store?>">- DB</a></li>
                </ul>
            </li>
            <li class="lftSelectSection">배송 관리
                <ul>
                    <li><a href="2_week.php?managing_store=<?=$managing_store?>">- WEEK</a></li>
                    <li class="now"><a href="3_today.php?managing_store=<?=$managing_store?>">- TODAY</a></li>
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
                <h3>오늘의 주문을 확인하세요</h3>
            </div>
        </header>

        <!--contents-->
        <main>
            <div id="contentWrapper">
                <div class="contentBox">
                    <div id="timeBox" class="time_box"></div>
                </div>
                <div class="contentBox">
                    <img src="../img/right_arrow.png" alt="right_arrow" id="arrow">
                </div>
                <div class="contentBox" id="tabHideBox">
                    <div id="tabHideContent">
                        시간을 클릭하면 배송ID 별 배송지 정보와<br>주문내역을 확인할 수 있습니다.<br><br>
                        주문 내역에 맞게 샐러드를 만들고 배송을 보낸 뒤<br>'완료' 버튼을 눌러주세요.<br><br>
                        시간 옆 카운트가 차감되어<br>현재 남은 주문 개수를 확인할 수 있습니다.
                    </div>
                </div>
                <div class="contentBox" id="tabBox">
                    <ul id="tabList" class="tabs"></ul>
                    <div id="tabContent" class="tab_content">
                        <button id="hideBtn" onclick="hideBtn()">X</button>
                        <h3 id="tabTime"></h3>
                        <ul id="deliveryInfo"></ul>
                        <hr>
                        <h3>주문내역</h3>
                        <div id="orderDetails">
                            <div id="teamInfo"></div>
                            <ul id="customerInfo"></ul>
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
