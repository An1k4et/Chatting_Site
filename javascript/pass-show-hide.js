const pswdField=document.querySelector(".form input[type='password']"),
togBtn=document.querySelector(".form .field i");

togBtn.onclick=()=>{
  if(pswdField.type=="password"){
    pswdField.type="text";
    togBtn.classList.add("active");
  }else{
    pswdField.type="password";
    togBtn.classList.remove("active");
  }
}
