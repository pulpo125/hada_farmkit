<?php


include "../../website/pages/DBcon.php";

/**
 * @var PDOStatement $connect
 */

?>

<!doctype html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <title>팜킷샐러드 정기배송 주문폼</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/orderForm.css">
</head>
<body>
<!--header-->
<header>
    <div class="wrapper clearfix">
        <h2>팜킷샐러드 정기배송 주문 완료</h2>
    </div>
</header>

<!--main-->
<main>
    <div class="wrapper clearfix">
        <!--Notice-->
        <div class="wrapper_box">
            <h3>Notice</h3>
            <p>팜킷샐러드는 샐러드 개별 맞춤 식단 정기 배송 서비스를 제공합니다. 양식에 맞게 주문폼을 작성 후 [제출]을 눌러주세요.</p>
            <p class="notice">개인 주문/팀 주문</p>
            <p>
                제한 지역(새롬동, 종촌동)에서만 개인 주문이 가능하며, 그 외 세종시 지역에서는 팀 주문만 가능합니다.
                <br>팀은 3~5인으로 구성되며, 개별 맞춤 식단을 제공하지만 하나의 배송지에 배송된다는 점 유의해주시길 바랍니다.
                <br>※제한 지역 내 팀 주문은 10% 할인입니다.
            </p>
        </div>

        <form name="dbAdd_orderForm" action="orderForm_confirm.php" method="post">
            <!--주문 유형 선택 -->
            <div>
                <h3>주문 유형 선택</h3>
                <label><input type="radio" name="order_type" value=true onclick='customerSelect()' checked> 개인 주문&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <label><input type="radio" name="order_type" value=false onclick='teamSelect()' > 팀 주문</label>
                <label><input type="text" name="team_name" placeholder="팀명을 입력하세요." id="teamName" disabled required></label>
            </div>

            <!--개인 정보 등록-->
            <fieldset class="fieldBox">
                <h3>
                    개인 정보 등록
                    <input id="removeBtn" class="register_btn" type='button' value='삭제하기' onclick='removeForm()' disabled>
                    <input id="addBtn" class="register_btn" type="button" value="추가하기" onclick="addForm()" disabled>
                </h3>
                <div id="registerForm">
                    <div id="registerForm1">
                        - 이름 : &nbsp;<input type="text" name="customer_name[]" required ><br>
                        - 생년월일 : &nbsp;<input type="date" name="customer_age[]" required ><br>
                        - 성별 : &nbsp;<label><input type="radio" name="customer_gender1" required value="0" checked> 남&nbsp;&nbsp;&nbsp;&nbsp;</label><label><input type="radio" name="customer_gender1" required value="1"> 여</label> <br>
                        - 연락처 : &nbsp;<input type="tel" name="phone0[]" class="phone" maxlength="3" required>
                        - <input type="tel" name="phone1[]" class="phone" maxlength="4" required>
                        - <input type="tel" name="phone2[]" class="phone" maxlength="4" required>
                        <br><hr><br>
                    </div>
                    <div id="registerForm2" style="display: none">
                        - 이름 : &nbsp;<input type="text" name="customer_name[]" required disabled><br>
                        - 생년월일 : &nbsp;<input type="date" name="customer_age[]" required disabled ><br>
                        - 성별 : &nbsp;<label><input type="radio" name="customer_gender2" required value="0" checked disabled> 남&nbsp;&nbsp;&nbsp;&nbsp;</label><label><input type="radio" name="customer_gender2" required value="1" disabled> 여</label> <br>
                        - 연락처 : &nbsp;<input type="tel" name="phone0[]" class="phone" maxlength="3" required value="" disabled>
                        - <input type="tel" name="phone1[]" class="phone" maxlength="4" required value="" disabled>
                        - <input type="tel" name="phone2[]" class="phone" maxlength="4" required value="" disabled>
                        <br><hr><br>
                    </div>
                    <div id="registerForm3" style="display: none">
                        - 이름 : &nbsp;<input type="text" name="customer_name[]" required  disabled><br>
                        - 생년월일 : &nbsp;<input type="date" name="customer_age[]" required  disabled><br>
                        - 성별 : &nbsp;<label><input type="radio" name="customer_gender3" required value="0" checked disabled> 남&nbsp;&nbsp;&nbsp;&nbsp;</label><label><input type="radio" name="customer_gender3" required value="1" disabled> 여</label> <br>
                        - 연락처 : &nbsp;<input type="tel" name="phone0[]" class="phone" maxlength="3" required value="" disabled>
                        - <input type="tel" name="phone1[]" class="phone" maxlength="4" required value="" disabled>
                        - <input type="tel" name="phone2[]" class="phone" maxlength="4" required value="" disabled>
                        <br><hr><br>
                    </div>
                    <div id="registerForm4" style="display: none">
                        - 이름 : &nbsp;<input type="text" name="customer_name[]" required  disabled><br>
                        - 생년월일 : &nbsp;<input type="date" name="customer_age[]" required  disabled><br>
                        - 성별 : &nbsp;<label><input type="radio" name="customer_gender4" required value="0" checked disabled> 남&nbsp;&nbsp;&nbsp;&nbsp;</label><label><input type="radio" name="customer_gender4" required value="1" disabled> 여</label> <br>
                        - 연락처 : &nbsp;<input type="tel" name="phone0[]" class="phone" maxlength="3" required value="" disabled>
                        - <input type="tel" name="phone1[]" class="phone" maxlength="4" required value="" disabled>
                        - <input type="tel" name="phone2[]" class="phone" maxlength="4" required value="" disabled>
                        <br><hr><br>
                    </div>
                    <div id="registerForm5" style="display: none">
                        - 이름 : &nbsp;<input type="text" name="customer_name[]" required  disabled><br>
                        - 생년월일 : &nbsp;<input type="date" name="customer_age[]" required  disabled><br>
                        - 성별 : &nbsp;<label><input type="radio" name="customer_gender5" required value="0" checked disabled> 남&nbsp;&nbsp;&nbsp;&nbsp;</label><label><input type="radio" name="customer_gender5" required value="1" disabled> 여</label> <br>
                        - 연락처 : &nbsp;<input type="tel" name="phone0[]" class="phone" maxlength="3" required value="" disabled>
                        - <input type="tel" name="phone1[]" class="phone" maxlength="4" required value="" disabled>
                        - <input type="tel" name="phone2[]" class="phone" maxlength="4" required value="" disabled>
                        <br><hr><br>
                    </div>
                    <input id="cntInput" type="text" name="cnt" value="1" style="display: none">
                </div>
            </fieldset>

            <!--배송 정보 등록-->
            <fieldset class="fieldBox">
                <h3>배송 정보 등록</h3>
                - 배송지<br>
                <input type="text" id="sample6_postcode" placeholder="우편번호" required>
                <input type="button" onclick="sample6_execDaumPostcode()" value="우편번호 찾기" id="deliveryCode" required><br>
                <input type="text" id="sample6_address" placeholder="주소" name="address1" required><br>
                <input type="text" id="sample6_detailAddress" placeholder="상세주소" name="address2" required>
                <input type="text" id="sample6_extraAddress" placeholder="참고항목" name="address3" required><br>
                <hr><br>
                - 배송 시간<br>
                <div id="deliveryTimes">
                    <label><input type="radio" name="severalTimes" id="once" class="click">  주 1회&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <label><input type="radio" name="severalTimes" id="twice" class="click">  주 2회&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <label><input type="radio" name="severalTimes" id="third" class="click">  주 3회</label>
                </div>
                <ul id="deliverySchedule">
                    <li>
                        1. <select name="ds_day[]" class="once" disabled>
                            <option value="Mon">월요일</option><option value="Tue">화요일</option><option value="Wed">수요일</option>
                            <option value="Thu">목요일</option><option value="Fri">금요일</option><option value="Sat">토요일</option><option value="Sun">일요일</option>
                        </select>
                        <select name="ds_time[]" class="once" disabled>
                            <option value="08:00">08시</option><option value="09:00">09시</option><option value="11:00">11시</option>
                            <option value="12:00">12시</option><option value="18:00">18시</option><option value="19:00">19시</option>
                        </select>&nbsp;&nbsp;
                    </li>
                    <li>
                        2. <select name="ds_day[]" class="twice" disabled>
                            <option value="Mon">월요일</option><option value="Tue">화요일</option><option value="Wed">수요일</option>
                            <option value="Thu">목요일</option><option value="Fri">금요일</option><option value="Sat">토요일</option><option value="Sun">일요일</option>
                        </select>
                        <select name="ds_time[]" class="twice" disabled>
                            <option value="08:00">08시</option><option value="09:00">09시</option><option value="11:00">11시</option>
                            <option value="12:00">12시</option><option value="18:00">18시</option><option value="19:00">19시</option>
                        </select>&nbsp;&nbsp;
                    </li>
                    <li>
                        3. <select name="ds_day[]" class="third" disabled>
                            <option value="Mon">월요일</option><option value="Tue">화요일</option><option value="Wed">수요일</option>
                            <option value="Thu">목요일</option><option value="Fri">금요일</option><option value="Sat">토요일</option><option value="Sun">일요일</option>
                        </select>
                        <select name="ds_time[]" class="third" disabled>
                            <option value="08:00">08시</option><option value="09:00">09시</option><option value="11:00">11시</option>
                            <option value="12:00">12시</option><option value="18:00">18시</option><option value="19:00">19시</option>
                        </select>&nbsp;&nbsp;
                    </li>
                </ul>
            </fieldset>


            <!--맞춤 식단 공지사항 -->
            <div class="wrapper_box">
                <p class="notice notice_menu">※맞춤 식단 안내사항</p>
                <p class="notice_menu">주문 접수 후 맞춤 식단을 위한 전문가 상담이 진행됩니다. 입력해주신 번호로 상담이 진행되니 다시 한 번 체크해주세요.</p>
            </div>

            <!-- 제출 버튼 -->
            <div class="wrapper_box">
                <button type="submit">제출</button>
            </div>
        </form>
    </div>
</main>

<!--footer-->
<footer>
    <div class="wrapper">
        <p>Copyright &copy HADA project</p>
    </div>
</footer>

<!--javaScript-->
<script src="../js/orderForm.js"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

</body>
</html>