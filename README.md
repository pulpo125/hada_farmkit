# Project Title  
**Salad Delivery Management System**  
<br/><br/>

## 기획 의도
𝙍𝙚𝙖𝙡 𝙛𝙧𝙚𝙨𝙝, 𝙀𝙫𝙚𝙧𝙮𝙙𝙖𝙮 𝙛𝙖𝙧𝙢𝙠𝙞𝙩

   세종시에 위치한 **팜킷샐러드**는 **샐러드 개별맞춤식단 정기 배송 서비스**를 제공하는 기업으로, 서비스 초기에 수요가 많았지만 세종시 특성상 공무원들이 많아 고객 별, 시간대 별로 주문이 집중되는 현상 때문에 배송 루트상의 문제가 발생하여 정기 배송 서비스를 중단했다. 서비스 중단 이후 제한지역 내에서만 배송하는 방법을 통해 배송문제를 해결하려 했지만, 제한지역 밖에서는 배송이 불가하다는 문제점이 남게 되었다. 

   이를 해결하기 위해, **팀별 배송 제도**를 도입하고 이를 관리할 수 있는 **배송 관리 시스템**을 구축하여 해당 기업이 **세종시 전체에 배송 서비스를 제공**할 수 있도록 하고자 한다.  
   <br/><br/>


## 세부 사항
**팀(Team) 배송 제도**
- 팀은 3명 이상의 개인으로 구성된 팀으로, 개별 맞춤 식단이지만 **하나의 배송지에 배송** 되는 것이 가장 큰 특징이다.
- 팀으로 신청을 하면 제한 지역 밖의 배송지라도 배송이 가능하다.
- 제한 지역 안의 팀이 주문할 경우에는 10% 할인한다.

**‘제한지역’ 배송 정책**
- 개인 주문은 제한지역 내에서만 가능하다.
- **제한지역 외에는 팀별 배송**으로 배송지를 축소하여 세종시 전체에 배송 서비스를 제공한다.
(제한지역 내에서도 팀별 배송 가능)  
  
**이때, 지점별로 관리하는 동을 나누어 지역을 관리한다.**
- 1 호점 관리 구역 : 새롬동 , 다정동 , 어진동 , 나성동 , 한솔동
- 2 호점 관리 구역 : 종촌동 , 고운동 , 아름동 , 도담동
(관리 구역은 각 팜킷 샐러드 지점과의 거리로 나눔)  
<br/><br/>


## ERD
<img width="80%" src="https://user-images.githubusercontent.com/118874524/219833067-6ec1f382-d0c3-4e41-9289-383222203c31.PNG"/>  

<br/><br/>

## Menu Structure
<img width="80%" src="https://user-images.githubusercontent.com/118874524/219832803-72479b60-e616-4706-b614-d6642a0c7eb9.png"/>  


<br/><br/>

## 레이아웃 시안

**1. 주문폼**  
<img width="80%" src="https://user-images.githubusercontent.com/118874524/219835034-7ca62d55-769b-4fb3-8773-e01893c8bebf.PNG"/>

**2. 관리사이트**  
2-1. 고객 관리  
* DB  
<img width="80%" src="https://user-images.githubusercontent.com/118874524/219835055-fa36425b-c55f-4da1-9ff2-884396a76f7c.png"/>

2-2. 배송 관리  
* Week  
<img width="80%" src="https://user-images.githubusercontent.com/118874524/219835069-98ac268a-1585-4b79-b78a-85c1ee227266.PNG"/>  
  
* Today  
<img width="80%" src="https://user-images.githubusercontent.com/118874524/219835077-24ce914e-08d8-4018-9fbd-7e10ccc6e3b4.PNG"/>
<img width="80%" src="https://user-images.githubusercontent.com/118874524/219835083-fc8e5df3-0678-45fa-83a9-8e5c7a8822da.PNG"/>  

2-3. 통계  
* Dashboard
<img width="80%" src="https://user-images.githubusercontent.com/118874524/219835090-89baa0ea-763c-4eb2-8d2f-a75d9f765490.PNG"/>  

<br/><br/>
## fake data 만들기  

:arrow_lower_right: [farmkit_fake_data](https://colab.research.google.com/drive/1UyEHKpZDlHQ91Gvv09-sgnDMF4xz1JwS?usp=sharing)  
<br/><br/>  

---  
  
### :hammer:Tools
<img src="https://img.shields.io/badge/HTML5-E34F26?style=flat&logo=HTML5&logoColor=white"/> <img src="https://img.shields.io/badge/CSS3-1572B6?style=flat &logo=CSS3&logoColor=white"/> <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=flat &logo=JavaScript&logoColor=white"/> <img src="https://img.shields.io/badge/Tableau-E97627?style=flat&logo=Tableau&logoColor=white"/> <img src="https://img.shields.io/badge/Python-3776AB?style=flat&logo=Python&logoColor=white"/>
