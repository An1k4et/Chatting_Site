const form = document.querySelector(".typing-input"),
  inputField = form.querySelector(".input-field"),
  sendBtn = form.querySelector(".send-button"),
  encryptBtn = form.querySelector(".encrypt-button"),
  decryptBtn = document.getElementById("decrypt"),
  chatBox = document.querySelector(".chat-box");




form.onsubmit = (e) => {
  e.preventDefault(); //preventing form from submitting when any input is not given
};

decryptBtn.onclick = ()=>{
  setInterval(() => {
    let mess = document.getElementById("recipient-name").value;
    let key = document.getElementById("message-text").value;
    document.cookie = "message=" + mess;
    document.cookie = "key=" + key;
  }, 500);
  document.getElementById("decr").onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/decrypt.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let ans = xhr.response;
          document.getElementById("ans").innerHTML = ans;
        }
      }
    };
    let formData = new FormData(form);
    xhr.send(formData);
  };
  document.getElementById("close").onclick = () => {
    document.getElementById("recipient-name").value = "";
    document.getElementById("message-text").value = "";
    document.getElementById("ans").innerHTML = "";
  }
}

sendBtn.onclick = ()=>{
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/chat_area.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {        
        inputField.value = ""; //when user send message the input box become empty
      }
    }
  }
  let formData = new FormData(form);
  xhr.send(formData);
}

encryptBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/encrpt.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var key = xhr.response;
        document.getElementById("rand").innerHTML = "Your key is "+key;
        inputField.value = ""; //when user send message the input box become empty
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};






setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/get-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        chatBox.classList.contains("active");
      }
    }
  };
   let formData = new FormData(form);
   xhr.send(formData);
}, 500);


