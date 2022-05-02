function getUnreadMesage(){
    fetch("/press/api/message", {credentials: "include"})
        .then(result => result.json())
        .then(data   => {
            getMessage(data);
        });
}


function getMessage(data){
    let mesall = document.querySelector(".messageAll");

    let table = "";
    //unreadnotes

   data.unreadnotes.forEach(result => {
       let noteText = result.note_text;
       let status   = result.status;
       let circless = "circlesr";
       let messtexts= "messtextr";

       if(status == 0){
           circless  = "circlesg";
           messtexts = "messtextg";
       }
       
      /* if(noteText.length > 100){
           noteText = noteText.substring(0,100) + "...";
       }*/

            table += `
                
                        <tr>
                            <td class="col-md-3"><div class="${circless}"></div>${result.note_subject}</td>
                            <td class="${messtexts}" onclick="loadText(this,${result.note_id})"><div>${noteText}</div></td>
                        </tr>
                    `;
                    
   });

   mesall.innerHTML = table;
}

async function loadText(data=null,noteId){
    
   await fetch("/press/api/message/update/"+noteId,{credentials: "include"});
    
   let messText = data.innerHTML;
   let mssClose = document.createElement("button");
   let messDisplay = document.querySelector(".messreadcl");

   mssClose.classList.add("close");
   mssClose.classList.add("btn");
   mssClose.classList.add("btn-primary");
   mssClose.innerHTML = "Zatvori";

   
   
   messDisplay.style.visibility = "visible";
   messDisplay.innerHTML = messText;
   messDisplay.appendChild(mssClose);

   mssClose.addEventListener("click", closeDisplay);
}


function closeDisplay(){
    let messDisplay = document.querySelector(".messreadcl");

    messDisplay.style.visibility = "hidden";
}

setInterval(getUnreadMesage, 1000);
