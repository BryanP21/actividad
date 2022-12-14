function getRellenos(){
    let rellenos = new Promise(function(myResolve, myReject) {
        try{
            const dataRellenos = new XMLHttpRequest();
            dataRellenos.addEventListener("readystatechange", async() => {
                if (dataRellenos.readyState === 4 &&  dataRellenos.status === 200) {
                    myResolve(JSON.parse(dataRellenos.responseText));
                }  
            });
            dataRellenos.open("GET", "/marias/api/rellenos/getrellenos.php");
            dataRellenos.send();
        }catch(error){
                myReject({
                    success:false,
                    message:error.message
                });
        }
        });
        return rellenos;
}


window.onload = function(e){ 
    if(location.pathname == '/marias/rellenos/rellenos.php'){
        showRellenos();
    }

}

function showRellenos(){
    getRellenos()
        .then((responseRellenos)=>{
            if(responseRellenos.success){
                let dataRellenos = responseRellenos.data;
                document.getElementById('tablaRellenos').classList.remove('d-none');
                document.getElementById('sinRellenos').classList.add('d-none');
                let tBody = document.getElementById('tBodyRellenos');
                tBody.innerText ='';
                for(i=0; i < dataRellenos.length; i++){
                    let tr = document.createElement("tr");

                    td = document.createElement("td");
                    td.innerText = dataRellenos[i].idrelleno;
                    td.className = 'align-middle text-center';
                    tr.appendChild(td);

                    td = document.createElement("td");
                    td.innerText = dataRellenos[i].descripcion;
                    td.className = 'align-middle text-center';
                    tr.appendChild(td);

                    td = document.createElement("td");
                    td.innerText = dataRellenos[i].idstatus;
                    td.className = 'align-middle text-center';
                    tr.appendChild(td);

                    td = document.createElement("td");
                    td.innerHTML = '<i class="bi bi-dash-circle-fill text-center" id="'+dataRellenos[i]+'" onclick="" ></i>';
                    td.className = 'align-middle text-center';
                    tr.appendChild(td);



                    tBody.appendChild(tr);
                }
            }
        });
}

function nuevoRelleno(){
    let descripcion = document.getElementById('descripcionRelleno');
    let idstatus = document.getElementById('estatusRelleno');

    var data =  new FormData();
    data.append("descripcion",descripcion.value );
    data.append("idstatus", idstatus.value);

    const request = new XMLHttpRequest();
    request.addEventListener("readystatechange", async() => {
        if (request.readyState === 4 &&  request.status === 200) {
            let response = JSON.parse(request.responseText);
            if(response.success){
                Swal.fire('Relleno a??adido correctamente', '', 'success')
                .then(()=>{
                    location.assign('rellenos.php');
                });
            }else{
                console.log(request.responseText);
                Swal.fire('Relleno no a??adido', '', 'error');
            }
        }  
    });
    request.open("POST", "/marias/api/rellenos/addRelleno.php");
    request.send(data);
}