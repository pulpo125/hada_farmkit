/*전역 변수*/
let timeCount;
let currentTime;
let currentID;
let buttonStates = {};


/* 완료 버튼 클릭 함수 */
const btn = document.querySelector("#tabFooter > button");
btn.addEventListener("click", (e) => {
    const cntText = timeCount.innerText;
    if (cntText === '1') {
        //카운트가 0이 되면 timeBox 회색 및 비활성화
        currentTime.style.background = '#b6b6b6';
        currentTime.style.color = 'white';
    }
    timeCount.innerText = cntText - 1;

    //버튼 클릭 시 버튼 비활성화
    const time = currentTime.getElementsByTagName("h3")[0].innerText;
    buttonStates[time][currentID] = false;
    e.target.style.backgroundColor = "#b6b6b6";
    e.target.disabled = true;
})


/* timeBox 생성 */
for (const info of timeInfo) {
    const parent = document.getElementById("timeBox");
    const divTag = document.createElement("div");
    divTag.setAttribute("onclick", "selectTime(this, '"+info.delivery_time+"')");
    const hTag = document.createElement("h3");
    const textNode = document.createTextNode(info.delivery_time);
    const pTag1 = document.createElement("p");
    const textNode1 = document.createTextNode(info.count_time);
    const pTag2 = document.createElement("p");
    const textNode2 = document.createTextNode("/"+info.count_time);
    hTag.appendChild(textNode);
    pTag1.appendChild(textNode1);
    pTag2.appendChild(textNode2);
    divTag.appendChild(hTag);
    divTag.appendChild(pTag1);
    divTag.appendChild(pTag2);
    parent.appendChild(divTag);

    buttonStates[info.delivery_time] = {};
}

/* selectTime */
function selectTime(tag, time) {
    timeCount = tag.getElementsByTagName("p")[0]; //선택한 시간의 count(pTag) 저장
    currentTime = tag //선택한 timeBox 저장

    /* tabHideBox는 숨기고 tabBox 보여주기 */
    document.getElementById("tabHideBox").style.display = "none";
    document.getElementById("tabBox").style.display = "block";

    /* tabList 초기화 */
    const tab = document.getElementById('tabList');
    tab.replaceChildren();

    const idList = {};
    let firstTab;
    let tabCount = 0;
    /* 시간 클릭 시 tab 생성*/
    for (const info of deliveryInfo) {
        if (info.delivery_time === time) {
            const liTag = document.createElement("li");
            const id = "ID " + info.delivery_id;
            const textNode = document.createTextNode(id);
            liTag.appendChild(textNode);
            liTag.setAttribute("class", "tab-link");
            liTag.setAttribute("data-tab", "tab-"+info.delivery_id);
            liTag.addEventListener("click", (e) => {
                selectTab(e.target.outerText, info);
            });
            tab.appendChild(liTag);

            if (tabCount === 0) {
                //첫 번째 탭 클릭 시 탭 class 'current' 추가
                tab.firstElementChild.className = "tab-link current";
                firstTab = { id, info };
            }
            tabCount++;
            idList[id] = true;
        }
    }

    /* 버튼 첫 번째 클릭 시 id 리스트를 저장 후 탭 정보 생성*/
    if (Object.keys(buttonStates[time]).length === 0) {
        buttonStates[time] = idList;
    }
    const { id, info } = firstTab;
    selectTab(id, info);

    /* 카운트가 0이 되면 timeBox 비활성화 */
    if (timeCount.innerText === 0) {
        tag.style.background = '#b6b6b6';
        tag.style.color = 'white';
    }
}


/* selectTab */
function selectTab(tag, info) {
    currentID = tag;
    /* 초기화 */
    const parent1 = document.getElementById("tabTime");
    parent1.replaceChildren();
    const parent2 = document.getElementById("deliveryInfo");
    parent2.replaceChildren();
    const parent3 = document.getElementById("teamInfo");
    parent3.replaceChildren();

    /* tabTime */
    const textNode = document.createTextNode(info.delivery_time);
    parent1.appendChild(textNode);

    /* deliveryInfo */
    const liTag1 = document.createElement("li");
    const liTag2 = document.createElement("li");
    const textNode1 = document.createTextNode("- Delivery_ID: "+info.delivery_id);
    const textNode2 = document.createTextNode("- 배송지: "+info.district+" "+info.specific_address);
    liTag1.appendChild(textNode1);
    liTag2.appendChild(textNode2);
    parent2.appendChild(liTag1);
    parent2.appendChild(liTag2);

    /* teamInfo */
    if (info.team_id === null) {
        //null 값이면 (팀이 아니면) 빈칸
        const child = document.createTextNode(" ");
        parent3.appendChild(child);
    } else {
        // 팀이면 팀 정보 생성
        const pTag1 = document.createElement("p");
        const pTag2 = document.createElement("p");
        const hrTag = document.createElement("hr");
        const textP1= document.createTextNode("- Team_ID: "+info.team_id);
        const textP2= document.createTextNode("- Team: "+info.team_name);
        pTag1.appendChild(textP1);
        pTag2.appendChild(textP2);
        parent3.appendChild(pTag1);
        parent3.appendChild(pTag2);
        parent3.appendChild(hrTag);
    }

    /* customerInfo */
    getCustomerList(info.delivery_id);


    const time = currentTime.getElementsByTagName("h3")[0].innerText;
    if (buttonStates[time][tag]) {
        //buttonStates가 true이면 버튼 활성화
        btn.style.backgroundColor = "#27B06E";
        btn.disabled = false;
    } else {
        //buttonStates가 false이면 버튼 비활성화
        btn.style.backgroundColor = "#b6b6b6";
        btn.disabled = true;
    }
}


/* getCustomerList */
function getCustomerList(id) {
    const parent = document.getElementById("customerInfo");
    parent.replaceChildren();
    for (const c of customerInfo) {
        if (c.delivery_id === id) {
            const liTag = document.createElement("li");
            const pTag1 = document.createElement("p");
            const pTag2 = document.createElement("p");
            const textNode1 = document.createTextNode("- Customer_ID: "+c.customer_id);
            const textNode2 = document.createTextNode("- Menu: "+c.customer_menu);
            pTag1.appendChild(textNode1);
            pTag2.appendChild(textNode2);
            liTag.appendChild(pTag1);
            liTag.appendChild(pTag2);
            parent.appendChild(liTag);
        }
    }
}


function switchCurrent() {
    if ($(this).hasClass('current') === false) {
        $(this).toggleClass('current');
        $(this).siblings().removeClass('current');
    }
}

/* current time */
$(document).on("click", "#timeBox>div", function (){
    switchCurrent.call(this);
})

/* current tab*/
$(document).on("click", "#tabList>li", function (){
    switchCurrent.call(this);
})


/* x 버튼 클릭 시 숨기기 */
function hideBtn() {
    document.getElementById("tabBox").style.display = "none";
    document.getElementById("tabHideBox").style.display = "block";
}


