/*주문 유형 선택*/
/*팀 선택 시 팀 이름 입력칸 활성화*/
function btnActive()  {
    const target = document.getElementById('target_btn');
    target.disabled = false;
}
function btnDisabled()  {
    const target = document.getElementById('target_btn');
    target.disabled = true;
}

/*개인 정보 등*/
/*추가하기 버튼 클릭시 개인 정보 등록 칸 추가*/
function setInnerHTML() {
    const element = document.getElementById('plus_form');
    element.innerHTML += '- 이름 : &nbsp;<input type="text" name="name"><br>\n' +
        '                - 생년월일 : &nbsp;<input type="date" name="birth"><br>\n' +
        '                - 성별 : &nbsp;<label><input type="radio" name="gender" value="male"> 남&nbsp;&nbsp;&nbsp;&nbsp;</label><label><input type="radio" name="gender" value="female"> 여</label> <br>\n' +
        '                - 연락처 : &nbsp;<input type="tel" name="tel" placeholder="예) 01012345678">\n' +
        '                <br><hr><br>';
}
function refresh()  {
    const element = document.getElementById('plus_form');
    element.innerHTML = ' ';
}

/*주소검색*/
// 우편번호 찾기 화면을 넣을 element
var element_layer = document.getElementById('layer');
function closeDaumPostcode() {
    // iframe을 넣은 element를 안보이게 한다.
    element_layer.style.display = 'none';
}
function sample6_execDaumPostcode() {
    new daum.Postcode({
        oncomplete: function(data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if(data.userSelectedType === 'R'){
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                }
                // 조합된 참고항목을 해당 필드에 넣는다.
                document.getElementById("sample6_extraAddress").value = extraAddr;

            } else {
                document.getElementById("sample6_extraAddress").value = '';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById('sample6_postcode').value = data.zonecode;
            document.getElementById("sample6_address").value = addr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("sample6_detailAddress").focus();
        }
    }).open();
}

/*배송 시간*/
function plusTime1() {
    document.getElementById("twice").style.display = "none";
    document.getElementById("third").style.display = "none";
    document.getElementById("once").style.display = "block";
}
function plusTime2() {
    document.getElementById("once").style.display = "none";
    document.getElementById("third").style.display = "none";
    document.getElementById("twice").style.display = "block";
}
function plusTime3() {
    document.getElementById("once").style.display = "none";
    document.getElementById("twice").style.display = "none";
    document.getElementById("third").style.display = "block";
}