<?php
include "DBcon.php";

/**
 * @var PDOStatement $connect
 */

$managing_store = $_GET["managing_store"];

//2. 쿼리 생성 (1호점, 2호점)
$query_list = "SELECT DISTINCT customer_id, customer_name, customer_contact, customer_menu, district, specific_address, team_id, team_name
            FROM delivery d
            LEFT JOIN customer c ON d.delivery_id=c.delivery_id
            LEFT JOIN team t ON d.delivery_id=t.delivery_id
            LEFT JOIN delivery_schedule ds ON d.delivery_id=ds.delivery_id
            LEFT JOIN managing_district md ON d.district=md.district_name
            WHERE managing_store='$managing_store'";

//검색바 쿼리
$searchKey = isset($_REQUEST['search_key']) ? $_REQUEST['search_key'] : "";
$search_field = isset($_REQUEST['search_field']) ? $_REQUEST['search_field'] : "";
if( $searchKey ) {
    if ($search_field === 'all') {
        $query_list = $query_list . " AND (c.customer_name LIKE '%$searchKey%' OR t.team_name LIKE '%$searchKey%')";
    } elseif ($search_field === 'team') {
        $query_list = $query_list . " AND t.team_name LIKE '%$searchKey%'";
    } elseif ($search_field === 'customer') {
        $query_list = $query_list . " AND c.customer_name LIKE '%$searchKey%'";
    } elseif ($search_field='team'){
        $query_list = $query_list . " AND t.team_name LIKE '%$searchKey%'";
    }
}

$query_list = $query_list . " ORDER BY c.customer_id";

//3. 쿼리 실행
$result_list = $connect->query($query_list) or die($connect->errorInfo());

?>

<!doctype html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATABASE</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/1_db.css">
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
                <th class=<?php echo $managing_store=='1호점' ? "here" : ""; ?>><a href="1_db.php?managing_store=1호점">1호점</a></th>
                <th class=<?php echo $managing_store=='2호점' ? "here" : ""; ?>><a href="1_db.php?managing_store=2호점">2호점</a></th>
            </tr>
        </table>
        <div class="lftSelect">
            <li class="lftSelectSection">고객 관리
                <ul>
                    <li class="now"><a href="1_db.php?managing_store=<?php echo $managing_store; ?>">- DB</a></li>
                </ul>
            </li>
            <li class="lftSelectSection">배송 관리
                <ul>
                    <li><a href="2_week.php?managing_store=<?php echo $managing_store; ?>">- WEEK</a></li>
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
                <h1>DataBase</h1>
            </div>
            <div>
                <h3>고객 데이터베이스</h3>
            </div>
        </header>

        <!--contents-->
        <main>
            <!--검색바 시작-->
            <div id="searchBox">
                <form id="search_form" action="" method="get" name="search_form">
                    <input type="hidden" name="managing_store" value="<?php echo $managing_store; ?>">
                    <select name="search_field" id="searchSelect">
                        <option value="all" id="searchAll" <?php echo $search_field=='all' ? "selected" : ""; ?>>전체</option>
                        <option value="customer" id="searchCustomer" <?php echo $search_field=='customer' ? "selected" : ""; ?>>고객명</option>
                        <option value="team" id="searchTeam" <?php echo $search_field=='team' ? "selected" : ""; ?>>팀명</option>
                    </select>
                    <div id="searchBlank">
                        <input type="text" name="search_key" id="searchKey" value="<?php echo $searchKey; ?>">
                        <button id="searchBtn">🔍︎</button>
                    </div>

                </form>
            </div>
            <!--검색바 끝-->

            <div>
                <table>

                    <colgroup>
                        <col width="50px">
                        <col width="70px">
                        <col width="100px">
                        <col width="150px">
                        <col width="190px">
                        <col width="260px">
                        <col width="80px">
                        <col width="160px">
                        <col width="220px">
                    </colgroup>

                    <thead>
                    <tr>
                        <th>순번</th>
                        <th>고객 ID</th>
                        <th>고객명</th>
                        <th>연락처</th>
                        <th>메뉴</th>
                        <th>배송지</th>
                        <th>팀 ID</th>
                        <th>팀명</th>
                        <th>상세정보 / 관리</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $index=0;
                    while($row = $result_list -> fetch()){
                        ?>
                        <tr>
                            <td><?php echo ++$index; ?></td>
                            <td><?php echo $row['customer_id']; ?></td>
                            <td><?php echo $row['customer_name']; ?></td>
                            <td><?php echo $row['customer_contact']; ?></td>
                            <td><?php echo $row['customer_menu']; ?></td>
                            <td><?php echo $row['specific_address']; ?></td>
                            <td><?php echo $row['team_id']; ?></td>
                            <td><?php echo $row['team_name']; ?></td>
                            <td><a href="1_1_detail.php?cID=<?php echo $row["customer_id"]; ?>" class="edit">바로가기</a></td>
                        </tr>
                        <?php
                    }
                    ?>
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