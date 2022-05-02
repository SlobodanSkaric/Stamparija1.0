var searcFild = document.querySelector(".allSearch");

searcFild.addEventListener("click", function(){
    searcFild.value = "3200300";
});

searcFild.addEventListener("keyup", function(){
    $numberMaterial = searcFild.value;

    fetch("/press/api/search/"+$numberMaterial, {credentials: "include"})
        .then(result => result.json())
        .then(data   => {
             getDisplay(data);
        });  
});

function getDisplay(data){
    var url = window.location.href;
    var checkUrl = [
        /http:\/\/localhost\/press\/material/,
        /http:\/\/localhost\/press\/publishing/
    ];

    var result = document.querySelector(".resultSearch");

    result.innerHTML = "";
   
    var table = "";

    if((/http:\/\/localhost\/press\/material/).test(url)){
        for(var i = 0; i < data.material.length; i++){
            table +=  `
           
                <tr class="text-center">
                    <th scope="row">${i+1}</th>
                    <td><a href="/press/material/${data.material[i].numbr_material}">${data.material[i].numbr_material}</a></td>
                    <td>${data.material[i].create_at}</td>
                </tr>
            `
        }
    }

    if((/http:\/\/localhost\/press\/publishing/).test(url)){
        for(var i = 0; i < data.material.length; i++){
            table +=  `
           
                <tr class="text-center">
                    <th scope="row">${i+1}</th>
                    <td><a href="/press/material/${data.material[i].numbr_material}">${data.material[i].numbr_material}</a></td>
                    <td><a href="#">${data.material[i].count}</a></td>
                    <td>
                    <input type="checkbox" class="form-check-input" name="valche[]" value="${data.material[i].log_material_id}"></div>
                    </td>
                    <td></td>
                </tr>
            `
        }
    }

    

   
    
    result.innerHTML = table;
}


