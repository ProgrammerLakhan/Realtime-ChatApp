const form = document.querySelector(".typing-area");
const inputField = form.querySelector(".input-field");
const sendBtn = form.querySelector("button");
const chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","controller/insert-chat.php",true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200){
                inputField.value = "";
                scrollToBottom();
            }
        } else {
            console.log("Error");
        }
    }
    let formData = new FormData(form); //creating new formData object
    xhr.send(formData); //sending formData to php
}

setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","controller/get-chat.php",true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
                
            }
        } else {
            console.log("Error");
        }
    }
    let formData = new FormData(form); //creating new formData object
    xhr.send(formData);
},500);

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}

