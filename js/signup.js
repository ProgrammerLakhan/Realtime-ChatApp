const form = document.querySelector(".signup form");
const continueBtn = document.querySelector(".button input");
const errorText = document.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","controller/signup.php",true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == 'success'){
                    window.location = "users.php";
                }else{
                    errorText.style.display = "block";
                    errorText.textContent = data;
                }
            }
        } else {
            console.log("Error");
        }
    }
    let formData = new FormData(form); //creating new formData object
    xhr.send(formData); //sending formData to php

}