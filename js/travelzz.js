function image_scroll(){
  const body=document.body;
  let lastScroll=0;

  window.addEventListener('scroll' ,() =>{
      let currentScroll=window.pageYOffset
      if(currentScroll<=0){
        body.classList.add("scroll_up")
        body.classList.remove("scroll_down")
      }
      else if(currentScroll>lastScroll && !body.classList.contains("scroll_down")){
        body.classList.remove("scroll_up")
        body.classList.add("scroll_down")
      }
      else if(currentScroll<lastScroll && body.classList.contains("scroll_down")){
        body.classList.remove("scroll_down")
        body.classList.add("scroll_up")
      }
      lastScroll=currentScroll
  })

}
function mouseAction(){
  var cursor =document.querySelector(".pointer");
  var cursor2 =document.querySelector(".pointer2");
  document.addEventListener("mousemove",(e)=>{
      cursor.style.cssText=cursor2.style.cssText="top:"+e.clientY+"px;"+"left:"+e.clientX+"px;";
  })
}


function booking(){
var currentDateTime = new Date();
var year = currentDateTime.getFullYear();
var month = (currentDateTime.getMonth() + 1);
var date = (currentDateTime.getDate() + 1);

if(date < 10) {
  date = '0' + date;
}
if(month < 10) {
  month = '0' + month;
}

var dateTomorrow = year + "-" + month + "-" + date;
var checkinElem = document.querySelector("#checkin-date");
var checkoutElem = document.querySelector("#checkout-date");

checkinElem.setAttribute("min", dateTomorrow);

checkinElem.onchange = function () {
    checkoutElem.setAttribute("min", this.value);
}
}

function login(){
/**
* Login form validations
*/
 var login =document.querySelector(".login");
 var loginForm= document.querySelector(".user");
 var close=document.querySelector(".ca1");
 const signupButton = document.getElementById('signup-button');
 loginButton = document.getElementById('login-button');
 userForms = document.getElementById('user_options-forms');


login.addEventListener('click',()=>{
  loginForm.style.cssText="transform: translateX(0);"
})
close.addEventListener('click',()=>{
  loginForm.style.cssText="transform: translateX(-200vw);"
})
/**
* Add event listener to the "Sign Up" button
*/
signupButton.addEventListener('click', () => {
userForms.classList.remove('bounceRight')
userForms.classList.add('bounceLeft')
}, false)

/**
* Add event listener to the "Login" button
*/
loginButton.addEventListener('click', () => {
userForms.classList.remove('bounceLeft')
userForms.classList.add('bounceRight')}, false)
}


function contact(){
  var contact =document.getElementById("Contact");
  var contactForm= document.querySelector(".con");
  var close=document.querySelector(".ca");

  contact.addEventListener("click",()=>{
    contactForm.style.cssText="transform: translateX(0);"
  })
  close.addEventListener("click",()=>{
    contactForm.style.cssText="transform: translateX(-200vw);"
  })
}

contact();
image_scroll();
mouseAction();
booking();
login();
