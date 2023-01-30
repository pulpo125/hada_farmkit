function disabledTarget(target) {
    for (let i = 0; i < 7; i++) {
        let form2 = target.getElementsByTagName('input')[i];
        form2.disabled = true;
    }
}

function activeTarget(target) {
    for (let i = 0; i < 7; i++) {
        let form2 = target.getElementsByTagName('input')[i];
        form2.disabled = false;
    }
}

/*주문 유형 선택*/
function customerSelect()  {
    /* 개인 선택 시 팀이름 입력 칸 비활성화*/
    let teamName = document.getElementById('teamName');
    teamName.disabled = true;

    /* 개인 선택 시 등록폼 1개만 보이기*/
    document.getElementById("registerForm2").style.display = "none";
    document.getElementById("registerForm3").style.display = "none";

    /* 등록폼 비활성화 */
    //2,3,addForm 비활성화
    let target1 = document.getElementById("registerForm2");
    disabledTarget(target1);
    let target2 = document.getElementById("registerForm3");
    disabledTarget(target2);
    let target3 = document.getElementById("addForm");
    disabledTarget(target3);

    /* 개인 선택 시 추가/삭제 버튼 비활성화*/
    let addBtn = document.getElementById('addBtn');
    addBtn.disabled = true;
    let removeBtn = document.getElementById('removeBtn');
    removeBtn.disabled = true;
}
function teamSelect()  {
    /* 팀 선택 시 팀이름 입력 칸 활성화*/
    let target = document.getElementById('teamName');
    target.disabled = false;

    /* 팀 선택 시 등록폼 3개 보이기*/
    document.getElementById("registerForm2").style.display = "block";
    document.getElementById("registerForm3").style.display = "block";

    /* 등록폼 활성화 */
    //2,3,addForm 활성화
    let target1 = document.getElementById("registerForm2");
    activeTarget(target1);
    let target2 = document.getElementById("registerForm3");
    activeTarget(target2);

    /* 개인 선택 시 추가/삭제 버튼 활성화*/
    let addBtn = document.getElementById('addBtn');
    addBtn.disabled = false;
    let removeBtn = document.getElementById('removeBtn');
    removeBtn.disabled = false;
}

/*개인 정보 등록*/
function addForm() {
    /*추가하기 버튼 클릭시 개인 정보 등록 칸 추가*/
    const form = document.getElementById('addFormChild');
    const plus = document.getElementById('plusSection');
    const formCopy = form.cloneNode(true);
    const plus2 = plus.appendChild(formCopy);
    plus2.id = 'addFormCopy'
    plus2.style.display = "block";

    let target3 = document.getElementById("addFormCopy");
    activeTarget(target3);
}

function removeForm()  {
    /* 삭제하기 버튼 클릭시 추가된 개인 정보 등록 칸 삭제*/
    const copyForm = document.getElementById('addFormCopy');
    copyForm.parentNode.removeChild(copyForm);
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

/*배송 정보*/
const targetFirst = document.querySelectorAll('.click');
targetFirst.forEach((target) => target.addEventListener("click", function(){
        jsSearch(target.id);
    })
);

function jsSearch(id) {
    const formList = ["once", "twice", "third"];
    const n = formList.indexOf(id) + 1;
    for (let i = 0; i < 3; i++) {
        const form = document.getElementsByClassName(formList[i]);
        form[0].disabled = i >= n;
        form[1].disabled = i >= n;
    }
}