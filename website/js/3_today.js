for (const info of timeInfo) {
    const time = info.delivery_time;
    const parent = document.getElementById("timeBox");
    const divTag = document.createElement("div");
    divTag.setAttribute("onclick", "selectTime(this, '"+time+"')");
    const hTag = document.createElement("h3");
    const textNode = document.createTextNode(time);
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
}


const btn = document.querySelector("#tabFooter > button");

function selectTime(tag, time) {
    currentTag = tag.getElementsByTagName("p")[0];
    /* tabHideBox는 숨기고 tabBox 보여주기 */
    document.getElementById("tabHideBox").style.display = "none";
    document.getElementById("tabBox").style.display = "block";

    /* tabList 초기화 */
    const tab = document.getElementById('tabList');
    tab.replaceChildren();

    let tabCount = 0;
    /* 시간 클릭 시 tab 생성*/
    for (const info of deliveryInfo) {
        if (info.delivery_time === time) {
            const liTag = document.createElement("li");
            const textNode = document.createTextNode("ID "+info.delivery_id);
            liTag.appendChild(textNode);
            liTag.setAttribute("class", "tab-link");
            liTag.setAttribute("data-tab", "tab-"+info.delivery_id);
            liTag.addEventListener("click", () => {selectTab(info)});
            tab.appendChild(liTag);
            if (tabCount === 0) {
                tab.firstElementChild.className = "tab-link current";
                selectTab(info)
            }
            tabCount++;
        }
    }

    if (currentTag.innerText > 0) {
        btn.disabled = false;
        btn.style.background = '#27B06E';
    } else {
        btn.disabled = true;
        btn.style.background = '#7F7F7F';
    }
}

function selectTab(info) {
    /* 초기화 */
    const parent1 = document.getElementById("tabTime");
    parent1.replaceChildren();
    const parent2 = document.getElementById("deliveryInfo");
    parent2.replaceChildren();
    const parent3 = document.getElementById("teamInfo");
    parent3.replaceChildren();

    /* time */
    const textNode = document.createTextNode(info.delivery_time);
    parent1.appendChild(textNode);

    /* tab 클릭 시 정보 생성 */
    const liTag1 = document.createElement("li");
    const liTag2 = document.createElement("li");
    const textNode1 = document.createTextNode("- Delivery_ID: "+info.delivery_id);
    const textNode2 = document.createTextNode("- 배송지: "+info.district+" "+info.specific_address);
    liTag1.appendChild(textNode1);
    liTag2.appendChild(textNode2);
    parent2.appendChild(liTag1);
    parent2.appendChild(liTag2);

    /* Team 정보 */ /* null 값일 때 만들 지 말기 */
    if (info.team_id === null) {
        const child = document.createTextNode(" ");
        parent3.appendChild(child);
    } else {
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
    getCustomerList(info.delivery_id);
}

/* customer */
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

/* tab current class 추가*/
$(document).on("click", "#tabList>li", function (){
    $(this).toggleClass('current');
    $(this).siblings().removeClass('current');
})

/* x 버튼 클릭 시 숨기기 */
function hideBtn() {
    document.getElementById("tabBox").style.display = "none";
    document.getElementById("tabHideBox").style.display = "block";
}




/* 완료 버튼 클릭 시 카운트 차감 */
btn.addEventListener("click", () => {
    /*const cnt = document.querySelector("#contentWrapper > div:nth-child(1) > div > div:nth-child(1) > p:nth-child(2)");*/
    const cntText = currentTag.innerText;
    countOrder(currentTag, cntText)
})


function countOrder(cnt, cntText) {
    if (cntText === '1') {
        //카운트가 0이 되면 타임박스 회색, 완료 버튼 회색 및 비활성화
        btn.disabled = true;
        btn.style.background = '#7F7F7F';
    }
    cnt.innerText = cntText - 1;
}
