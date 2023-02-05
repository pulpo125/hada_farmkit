<?php
include "DBcon.php";

/**
 * @var PDOStatement $connect
 */

//$managing_store = $_GET["managing_store"];
$managing_store = '전체';

?>


<!doctype html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/4_dashboard.css">
</head>
<body>

<!--페이지 시작-->
<div id="pageWrapper">
    <!--좌측 네비게이션 시작-->
    <div id="leftNavWrapper">
        <div id="clockDate"></div>
        <div id="clockTime"></div>
        <div class="storeBox">전체</div>
        <table>
            <colgroup>
                <col width="30%">
                <col width="30%">
                <col width="30%">
            </colgroup>
            <tr>
                <th class="here"><a href="">전체</a></th>
                <th class=<?php echo $managing_store=='1호점' ? "here" : ""; ?>><a href="1_db.php?managing_store=1호점">1호점</a></th>
                <th class=<?php echo $managing_store=='2호점' ? "here" : ""; ?>><a href="1_db.php?managing_store=2호점">2호점</a></th>
            </tr>
        </table>
        <div class="lftSelect">
            <li class="lftSelectSection">통계
                <ul>
                    <li class="now"><a href="4_dashboard.php">- Dashboard</a></li>
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
                <h1>Dashboard</h1>
            </div>
            <div>
                <h3>지점 & 고객 별 주문 수를 분석하세요</h3>
            </div>
        </header>

        <!--contents-->
        <main>
            <div class='tableauPlaceholder' id='viz1675574255641' style='position: relative'>
                <noscript>
                    <a href='#'>
                        <img alt='Dashboard  ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;ha&#47;hada_farmkitdashboard-0205&#47;Dashboard&#47;1_rss.png' style='border: none' />
                    </a>
                </noscript>
                <object class='tableauViz'  style='display:none;'>
                    <param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' />
                    <param name='embed_code_version' value='3' />
                    <param name='site_root' value='' />
                    <param name='name' value='hada_farmkitdashboard-0205&#47;Dashboard' />
                    <param name='tabs' value='no' /><param name='toolbar' value='yes' />
                    <param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;ha&#47;hada_farmkitdashboard-0205&#47;Dashboard&#47;1.png' />
                    <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' />
                    <param name='display_spinner' value='yes' />
                    <param name='display_overlay' value='yes' /><param name='display_count' value='yes' />
                    <param name='language' value='ko-KR' />
                </object>
            </div>
        </main>
    </div>
    <!--메인 페이지 끝-->
</div>
<!--페이지 끝-->

<!--JS연결-->
<script src="../js/base.js"></script>
<script type='text/javascript'>
    var divElement = document.getElementById('viz1675574255641');
    var vizElement = divElement.getElementsByTagName('object')[0];
    if ( divElement.offsetWidth > 800 ) { vizElement.style.width='1300px';vizElement.style.height='827px';}
    else if ( divElement.offsetWidth > 500 ) { vizElement.style.width='1300px';vizElement.style.height='827px';}
    else { vizElement.style.width='100%';vizElement.style.height='1777px';}
    var scriptElement = document.createElement('script');
    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';
    vizElement.parentNode.insertBefore(scriptElement, vizElement);
</script>

</body>
</html>