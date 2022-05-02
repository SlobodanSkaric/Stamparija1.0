function getUnreadeMessage(){
    fetch("/press/api/message",{credentials:"include"})
        .then(data => data.json())
        .then(result => getResutl(result))
}

function getResutl(result){
    let spanNumber = document.querySelector(".numberMessage");
    let messageCounter = 0;
    result.unreadnotes.forEach(data => {
        if(data.status == 1){
            messageCounter +=1;
        }
    });

    if(messageCounter > 0){
        spanNumber.style.backgroundColor = "red";
    }
    spanNumber.innerHTML = messageCounter;
    
}

getUnreadeMessage();