const btnL = document.querySelectorAll(".moveL");
const overlay = document.getElementById("overlay");
const formDiv = document.getElementById("formDiv");
const signOverlay = document.querySelectorAll(".signOverlay");
const logo = document.querySelector(".logo");
const messageDiv = document.querySelector(".message");
const eyes=document.querySelectorAll(".eye");
const passinputs=document.querySelectorAll(".password");
const signForm = document.querySelectorAll(".signForm");
function fun1() {
  overlay.classList.toggle("move");
  formDiv.classList.toggle("move");
  logo.classList.toggle("light-mode");

  signOverlay.forEach((overlay) => {
    overlay.classList.toggle("hidden");
  });

  signForm.forEach((form) => {
    form.classList.toggle("hidden");
  });
}

btnL.forEach((btn) => {
  btn.addEventListener("click", fun1);
});
// إخفاء رسالة الخطأ بعد 3 ثواني
document.addEventListener("DOMContentLoaded", function () {
  if (messageDiv) {
    setTimeout(function () {
      messageDiv.style.opacity = "0";
      messageDiv.style.transition = "opacity 0.5s ease";
      setTimeout(function () {
        messageDiv.remove();
      }, 500);
    }, 3000);
  }
});
eyes.forEach((eye)=>{
  eye.addEventListener('click',()=>{
    eye.classList.toggle('fa-eye-slash');
    eye.classList.toggle('fa-eye');
    if(eye.classList.contains('fa-eye')){
      passinputs.forEach((passinput)=>{
        passinput.type='text';
      })
      
    }
    if(eye.classList.contains('fa-eye-slash')){
      passinputs.forEach((passinput)=>{
        passinput.type='password';
      })
      
    }
  })
})



