function indexPedido(idpedido){
    let pedido = new Promise(function(myResolve, myReject) {
        try{
            const request = new XMLHttpRequest();
            request.addEventListener("readystatechange", async() => {
                if (request.readyState === 4 &&  request.status === 200) {
                    myResolve(JSON.parse(request.responseText));
                }  
            });
            request.open("GET", "/marias/api/pedidos/indexpedido.php?idpedido="+idpedido);
            request.send();
        }catch(error){
                myReject({
                    success:false,
                    message:error.message
                });
        }
        });
        return pedido;
}

function getPedidos(){
    let pedidos = new Promise(function(myResolve, myReject) {
        try{
            const request = new XMLHttpRequest();
            request.addEventListener("readystatechange", async() => {
                if (request.readyState === 4 &&  request.status === 200) {

                        myResolve(JSON.parse(request.responseText)); 
             
                }  
            });
            request.open("GET", "/marias/api/pedidos/getPedidos.php");
            request.send();
        }catch(error){
                myReject({
                    success:false,
                    message:error.message
                });
        }
        });
        return pedidos;
}

function showPedidos(){
    getPedidos()
    .then((responseData)=>{
        console.log(responseData);
        if(responseData.success){
            
            document.getElementById('tablaPedidos').classList.remove('d-none');
            document.getElementById('sinPedidos').classList.add('d-none');
            let tBody = document.getElementById('tBodyPedidos');
            tBody.innerText ='';
            for(i=0;i<responseData.data.length;i++){
                let tr = document.createElement("tr");

                let td = document.createElement("td");
                td.innerText = responseData.data[i].idpedido;
                td.className = 'align-middle text-center';
                tr.appendChild(td);

                td = document.createElement("td");
                td.innerText = responseData.data[i].EMPLEADO;
                td.className = 'align-middle text-center';
                tr.appendChild(td);

                td = document.createElement("td");
                td.innerText = responseData.data[i].fechainicio;
                td.className = 'align-middle text-center';
                tr.appendChild(td);

                td = document.createElement("td");
                td.innerText = responseData.data[i].fechaentrega;
                td.className = 'align-middle text-center';
                tr.appendChild(td);

                td = document.createElement("td");
                td.innerText = responseData.data[i].costototal;
                td.className = 'align-middle text-center';
                tr.appendChild(td);

                td = document.createElement("td");
                td.innerText = responseData.data[i].anticipo;
                td.className = 'align-middle text-center';
                tr.appendChild(td);

                td = document.createElement("td");
                td.innerText = responseData.data[i].restante;
                td.className = 'align-middle text-center ';
                tr.appendChild(td);

                td = document.createElement("td");
                td.innerText = responseData.data[i].edopago;
                td.className = 'align-middle text-center ';
                tr.appendChild(td);

                td = document.createElement("td");
                td.innerText = responseData.data[i].descripcion;
                td.className = 'align-middle text-center ';
                tr.appendChild(td);
                
                td = document.createElement("td");
                let options = '';
                let startOptions = '<div class="dropdown"><button class="btn btn-secondary  bi bi-list" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button><ul class="dropdown-menu">';
                let endOptions = '</ul></div>';

                let optRead = '<li><a class="dropdown-item" href="javascript:void(0)" onclick="verPedido('+responseData.data[i].idpedido+')">Ver</a></li>';
                let optConcluir = '<li><a class="dropdown-item" href="javascript:void(0)" onclick="concluirPedido('+responseData.data[i].idpedido+')">Concluir</a></li>';
                let optUpdt = '<li><a class="dropdown-item" href="javascript:void(0)" onclick="actualizarPedido('+responseData.data[i].idpedido+')">Editar</a></li>';
                let optRem = '<li><a class="dropdown-item" href="javascript:void(0)" onclick="cancelarPedido('+responseData.data[i].idpedido+')">Cancelar</a></li>';
                
                options = startOptions+optRead;

                    
                if(responseData.data[i].idstatusentrega != '3' && responseData.data[i].idstatusentrega != '4'){
                    if(parseFloat(responseData.data[i].anticipo) > (parseFloat(responseData.data[i].costototal) ) && responseData.data[i].edopago == 'Si'  && responseData.data[i].idstatusentrega != '2'){   
                       /*  options += optAdd; */
    
                       options += optConcluir;
                    }
                }

                if( responseData.data[i].idstatusentrega == '2'){
                    options += optUpdt;
                    options += optRem;
                }

                options+=endOptions;
                td.innerHTML = options;
                td.className = 'align-middle text-center';
                tr.appendChild(td);
                
                tBody.appendChild(tr);
            }
        }else{
            document.getElementById('tablaPedidos').classList.add('d-none');
            document.getElementById('sinPedidos').classList.remove('d-none');
        }
    })
}

function concluirPedido(id_pedido){
            var data =  new FormData();
            data.append("ID_PEDIDO", id_pedido);
            const request = new XMLHttpRequest();
            request.addEventListener("readystatechange", async() => {
                if (request.readyState === 4 &&  request.status === 200) {
                    Swal.fire('Pedido concluido correctamente', '', 'success')
                    .then(()=>{
                        showPedidos();
                    });
                }  
            });
            request.open("POST", "/marias/api/pedidos/finishPedido.php");
            request.send(data);
}

function verPedido(id_pedido){
    location.assign('verpedido.php?idpedido='+id_pedido);
}

function actualizarPedido(id_pedido){
    location.assign('actualizarpedido.php?idpedido='+id_pedido);
}

function cancelarPedido(id_pedido){
    var data =  new FormData();
    data.append("ID_PEDIDO", id_pedido);
    const request = new XMLHttpRequest();
    request.addEventListener("readystatechange", async() => {
        if (request.readyState === 4 &&  request.status === 200) {
            Swal.fire('Pedido cancelado', '', 'success')
            .then(()=>{
                showPedidos();
            });
        }  
    });
    request.open("POST", "/marias/api/pedidos/cancelPedido.php");
    request.send(data);
}


/* Valida desde donde se esta cargando el archivo */
window.onload = function(e){ 
    localStorage.clear();
    if(location.pathname == '/marias/pedidos/pedidos.php'){
    
        showPedidos();
    }


    if(location.pathname == '/marias/pedidos/verpedido.php' || location.pathname == '/marias/pedidos/actualizarpedido.php' ){
        fillData();
    }

}



function fillData(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const idpedido = urlParams.get('idpedido');
    localStorage.setItem('idPedido',idpedido);;
    indexPedido(idpedido)
    .then((responsePedido)=>{
        if(responsePedido .success){
            let pedido = responsePedido.data[0];
            console.log('pedido',pedido);
            getProductos(idpedido)
            .then(async (responseProductos)=>{
                console.log("responseProductos",responseProductos);
                let productos = await responseProductos.data;
                indexpagos(idpedido)
                .then(async(responsePagos)=>{
                    let pagos = await responsePagos.data;
                    console.log("responsePagos",responsePagos);
                    indexCliente(pedido.idcliente)
                    .then(async(responseCliente)=>{
                        let cliente = await responseCliente.data[0];
                        console.log("cliente",cliente);

                        indexDireccion(pedido.iddireccion)
                        .then(async (responseDireccion)=>{
                            let direccion = await responseDireccion.data[0];
                            console.log("direccion",direccion);
                            fillTablePedido(pedido,cliente,direccion);
                            fillTableProductos(responseProductos);
                            fillTablePagos(responsePagos,pedido); 
                        })
                        /* fillTablePagos(idpedido,pedido.ESTATUS); */

                    })

                });
            });
        }
    });
}

function fillTablePedido(pedido,cliente,direccion){
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    var today  = new Date();
    let tBody = document.getElementById('generalInfo');
    tBody.innerText ='';
    let tr = document.createElement("tr");

    let td = document.createElement("td");
    td.innerText = pedido.fechainicio;
    td.className = 'align-middle text-center';
    tr.appendChild(td);

    td = document.createElement("td");
    td.colSpan = 2;
    td.innerHTML = cliente.nombre+" "+cliente.apellidopaterno+" "+cliente.apellidomaterno+"<br>"+cliente.correo+"<br>"+cliente.telefono+"<br> <b>Dirección: </b>"+direccion.calle+" #"+direccion.numeroCasa+" "+direccion.colonia+", "+direccion.ciudad+", "+direccion.estado+"<br> Detalles: "+direccion.descripcion;
    td.className = 'align-middle text-justify';
    tr.appendChild(td);

    td = document.createElement("td");
    td.innerText = pedido.fechaentrega;
    td.className = 'align-middle text-center';
    tr.appendChild(td);

    tBody.appendChild(tr);

    tr = document.createElement("tr");

    td = document.createElement("td");
    td.colSpan = 2;
    td.innerHTML = "<b>Pagado:</b> "+pedido.edopago;
    td.className = 'align-middle text-center';

    tr.appendChild(td);


    td = document.createElement("td");
    td.colSpan = 2;
    td.innerHTML = "<b>Estatus:</b> "+pedido.descripcion;
    td.className = 'align-middle text-center';

    tr.appendChild(td);
    tBody.appendChild(tr);
}


function fillTableProductos(responseData){
       console.log("fillTableProductos",responseData);
        /* if(responseData.success){ */
            /*               document.getElementById('tableInfoProductos').classList.remove('d-none');
            document.getElementById('infoPago').classList.remove('d-none'); */
            
            let tBody = document.getElementById('tableProductos');
            console.log("tBody",tBody);
             tBody.innerText =''; 
            for(let i=0;i<responseData.data.length;i++){
                console.log("or(i=0;i<responseData.data.length;i++){",responseData.data[i]);
                let tr = document.createElement("tr");
                let td = document.createElement("td");
                td.innerText = i+1;
                td.className = 'align-middle text-center';
                tr.appendChild(td);
                
                td = document.createElement("td");
                td.innerText = responseData.data[i].cantidad;
                td.className = 'align-middle text-center';
                tr.appendChild(td);
                
                td = document.createElement("td");
                td.innerText = responseData.data[i].especificaciones;
                td.className = 'align-middle text-center';
                  tr.appendChild(td);
                  
                  td = document.createElement("td");
                  td.innerText = responseData.data[i].SABOR;
                  td.className = 'align-middle text-center';
                  tr.appendChild(td);
                  
                  td = document.createElement("td");
                  td.innerText = responseData.data[i].RELLENO;
                  td.className = 'align-middle text-center';
                  tr.appendChild(td);
                  
                  td = document.createElement("td");
                  td.innerText = responseData.data[i].TAMANO;
                  td.className = 'align-middle text-center';
                  tr.appendChild(td);
                  
                  td = document.createElement("td");
                  td.innerText = responseData.data[i].COBERTURA;
                  td.className = 'align-middle text-center';
                  tr.appendChild(td);
                  
                  td = document.createElement("td");
                  td.innerHTML = "<img src='/marias/api"+responseData.data[i].imgref+"'  width='100' >";
                  td.className = 'align-middle text-center ';
                  tr.appendChild(td);
                  tBody.appendChild(tr);
                  
                    if(location.pathname == '/marias/pedidos/actualizarpedido.php' && responseData.data.length > 1){
                      
                      td = document.createElement("td");
                      td.innerHTML = '<i class="bi bi-dash-circle-fill text-center" id="'+responseData.data[i].idproducto+'" onclick="removeProduct('+responseData.data[i].idproducto+')" ></i>';
                      td.className = 'align-middle text-center';
                      tr.appendChild(td); 
                    } 
                  
            }
/*                 }
        }else{
            console.log("No success");
            let tBody = document.getElementById('tableProductos');
            tBody.innerText ='';
            document.getElementById('tableInfoProductos').classList.add('d-none');
            document.getElementById('infoPago').classList.add('d-none');
        } */
}
function fillTablePagos(responseData,pedido){
  console.log("fillTablePagos",responseData);
    if(responseData.success){
        /*               document.getElementById('tableInfoProductos').classList.remove('d-none');
        document.getElementById('infoPago').classList.remove('d-none'); */
        let tBody = document.getElementById('tablePagos');
        tBody.innerText ='';
        let tr = document.createElement("tr");
        let td = document.createElement("td");
        let sumaPagos = 0;
        for(i=0;i<responseData.data.length;i++){
            let tr = document.createElement("tr");
            let td = document.createElement("td");

              td.innerText = i+1;
              td.className = 'align-middle text-center';
              tr.appendChild(td);
              
/*               td = document.createElement("td");
              td.innerText = responseData.data[i].FORMA_PAGO;
              td.className = 'align-middle text-center';
              tr.appendChild(td);
 */
              td = document.createElement("td");
              td.innerText = "$"+parseFloat(responseData.data[i].cantidad).toFixed(2);
              td.className = 'align-middle text-center';
              tr.appendChild(td);

              if(location.pathname == '/marias/pedidos/actualizarpedido.php' ){
                document.getElementById('costoProducto').value = parseFloat(pedido.costototal).toFixed(2);
                /* document.getElementById('envioProducto').value = parseFloat(pedido.ENVIO).toFixed(2); */

                td = document.createElement("td");
                if(responseData.data.length > 1){
                    td.innerHTML = '<i class="bi bi-dash-circle-fill text-center" id="'+responseData.data[i].idpago+'" onclick="quitarPagoPedido('+responseData.data[i].idpago+')" ></i>';
                }else{
                    td.innerHTML = '&nbsp;';
                }
                td.className = 'align-middle text-center';
              
                tr.appendChild(td); 
              }
           
              
            
              
              tBody.appendChild(tr);
              sumaPagos = parseFloat(responseData.data[i].cantidad) + parseFloat(sumaPagos);
            }

            let colSpanData = 0;
            if(location.pathname == '/marias/pedidos/verpedido.php' ){
                colSpanData = "1";
            }else{

                colSpanData ="2";
            }
            tr = document.createElement("tr");

            td = document.createElement("td");
            td.colSpan =colSpanData;
            td.innerHTML = "<b>PAGOS:</b>";
            td.className = 'align-middle text-end';
            tr.appendChild(td);

            td = document.createElement("td");
            td.innerText = "$"+parseFloat(sumaPagos).toFixed(2);
            td.className = 'align-middle text-center';
            td.id = "sumaPagosInfo";
            tr.appendChild(td);

            tBody.appendChild(tr);

            tr = document.createElement("tr");

            td = document.createElement("td");
            td.colSpan =colSpanData;
            td.innerHTML = "<b>TOTAL:</b>";
            td.className = 'align-middle text-end';
            tr.appendChild(td);

            td = document.createElement("td");
             td.innerText = "$"+(parseFloat(pedido.costototal)).toFixed(2);
            td.className = 'align-middle text-center';
            td.id = "costoTotalInfo";
            tr.appendChild(td);

            tBody.appendChild(tr);

            tr = document.createElement("tr");

            td = document.createElement("td");
            td.colSpan =colSpanData;
            td.innerHTML = "<b>RESTO:</b>";
            td.className = 'align-middle text-end';
            tr.appendChild(td);

            td = document.createElement("td");
            td.innerText = "$"+(parseFloat(pedido.costototal)-parseFloat(sumaPagos)).toFixed(2);
            td.className = 'align-middle text-center';
            td.id = "costoResto";
            tr.appendChild(td);

            tBody.appendChild(tr);

    }else{
        let tBody = document.getElementById('tableProductos');
        tBody.innerText ='';
    }


    
}

function openModal() {
    document.getElementById("backdrop").style.display = "block"
    document.getElementById("modalProductos").style.display = "block"
    document.getElementById("modalProductos").classList.add("show");

    getSabores()
    .then(async (responseSabor)=>{
        if(await responseSabor.success){
            let values = responseSabor.data;
            document.getElementById('saborProducto').innerText ="";
            for(i=0; i < values.length; i++){
                let option = document.createElement("option");
                option.value = values[i].idsabor;
                option.text = values[i].descripcion;
                document.getElementById('saborProducto').add(option);
            }
        }
    });
    getRellenos()
    .then(async (responseSabor)=>{
        if(await responseSabor.success){
            let values = responseSabor.data;
            document.getElementById('rellenoProducto').innerText ="";
            for(i=0; i < values.length; i++){
                let option = document.createElement("option");
                option.value = values[i].idrelleno;
                option.text = values[i].descripcion;
                document.getElementById('rellenoProducto').add(option);
            }
        }
    });
    getTamanos()
    .then(async (responseSabor)=>{
        if(await responseSabor.success){
            let values = responseSabor.data;
            document.getElementById('tamanoProducto').innerText ="";
            for(i=0; i < values.length; i++){
                let option = document.createElement("option");
                option.value = values[i].idtamano;
                option.text = values[i].descripcion;
                document.getElementById('tamanoProducto').add(option);
            }
        }
    });
    getCoberturas()
    .then(async (responseSabor)=>{
        if(await responseSabor.success){
            let values = responseSabor.data;
            document.getElementById('coberturaProducto').innerText ="";
            for(i=0; i < values.length; i++){
                let option = document.createElement("option");
                option.value = values[i].idcobertura;
                option.text = values[i].descripcion;
                document.getElementById('coberturaProducto').add(option);
            }
        }
    });

}

function closeModal() {
    document.getElementById("backdrop").style.display = "none"
    document.getElementById("modalProductos").style.display = "none"
    document.getElementById("modalProductos").classList.remove("show")
    /* check list products */

}
// Get the modal
 var modal = document.getElementById('modalProductos');
 
// When the user clicks anywhere outside of the modal, close it
 window.onclick = function(event) {
  if (event.target == modal) {
    closeModal()
  }
} 

function actualizarCostosPedido(){
    let idPedido = localStorage.getItem('idPedido');
    /* let envio = document.getElementById('envioProducto').value; */
    let costo = document.getElementById('costoProducto').value;
    actualizarCostos(idPedido,costo)
    .then(async (responseCostos)=>{
        if(await responseCostos.success){
            Swal.fire('Costos modificados', '', 'success')
            .then( ()=>{
                fillData();
            });
        }
    });
}


function agregarProductoPedido(){
    let idPedido = localStorage.getItem('idPedido');
    let cantidadProducto = document.getElementById('cantidadProducto');
    let saborProducto = document.getElementById('saborProducto');
    let rellenoProducto = document.getElementById('rellenoProducto');
    let tamanoProducto = document.getElementById('tamanoProducto');
    let coberturaProducto = document.getElementById('coberturaProducto');
    let especificacionesProducto = document.getElementById('especificacionesProducto');
    let referenciaProducto = document.getElementById('referenciaProducto');

    if(idPedido != '' && idPedido != null && cantidadProducto.value != '' && saborProducto.value != '' && rellenoProducto.value != '' && tamanoProducto.value != '' && coberturaProducto.value != '' && especificacionesProducto.value != '' && referenciaProducto.value != ''  ){
        addProducto(idPedido,cantidadProducto.value,saborProducto.value,rellenoProducto.value,tamanoProducto.value,coberturaProducto.value,especificacionesProducto.value,referenciaProducto.files[0])
        .then(async(response)=>{
            if( await response.success){
                
                Swal.fire('Producto agregado', '', 'success')
                .then( ()=>{
                    closeModal();
                    cantidadProducto.value = '';
                    saborProducto.value = '';
                    rellenoProducto.value = '';
                    tamanoProducto.value = '';
                    coberturaProducto.value = '';
                    especificacionesProducto.value = '';
                    referenciaProducto.value = '';
                    getProductos(idPedido)
                    .then((response)=>{
                        fillTableProductos(response);
                    });
                     
                    
                });
            }
        });
        
    }else{
        Swal.fire('Complete todos los campos', '', 'warning');
    }


}


function openModalPagos(){
    document.getElementById("backdrop-pagos").style.display = "block"
    document.getElementById("modalPagos").style.display = "block"
    document.getElementById("modalPagos").classList.add("show");
}

function closeModalPagos(){
    document.getElementById("backdrop-pagos").style.display = "none"
    document.getElementById("modalPagos").style.display = "none"
    document.getElementById("modalPagos").classList.remove("show");
}

// Get the modal
var modal = document.getElementById('modalPagos');
 
// When the user clicks anywhere outside of the modal, close it
 window.onclick = function(event) {
  if (event.target == modal) {
    closeModalPagos()
  }
} 

function agregarPagoPedido(){
    let idPedido = localStorage.getItem('idPedido');
    let forma = document.getElementById('formaPago').value;
    let monto = document.getElementById('montoPago').value;
    let infoTotal = parseFloat(document.getElementById('costoTotalInfo').innerText.replaceAll("$",""));
    let infoPagos =  parseFloat(document.getElementById('sumaPagosInfo').innerText.replaceAll("$",""));

    if((infoTotal - infoPagos - monto) >= 0){
        agregarPago(idPedido,forma,monto)
        .then(async (response)=>{
            if(await response.success){
                Swal.fire('Pago añadido', '', 'success')
                .then( ()=>{
                    closeModalPagos();
                    fillData();
                });
            }
        })
    }else{
            Swal.fire('El monto del pago no puede exceder el resto a pagar $'+(infoTotal-infoPagos) , '', 'warning');
    }
}

function quitarPagoPedido(idpago){
  /*   let infoTotal = parseFloat(document.getElementById('costoTotalInfo').innerText.replaceAll("$",""));
    let infoPagos =  parseFloat(document.getElementById('sumaPagosInfo').innerText.replaceAll("$",""));
    let infoResto =  parseFloat(document.getElementById('costoResto').innerText.replaceAll("$",""));
 */
    let idPedido = localStorage.getItem('idPedido');
    removerPago(idpago,idPedido)
    .then(async (response)=>{
        if(await response.success){
            Swal.fire('Pago removido', '', 'success')
            .then( ()=>{
                fillData();
            });
        }
    })
}

function removeProduct(idProducto){
    var data =  new FormData();
    data.append("ID_PRODUCTO", idProducto);
    const pedido = new XMLHttpRequest();
    pedido.addEventListener("readystatechange", async() => {
        if (pedido.readyState === 4 &&  pedido.status === 200) {
            
            if(JSON.parse(pedido.responseText).success){
                Swal.fire('Pedido eliminado correctamente', '', 'success')
                .then(()=>{
                    fillData();
                });
            }
        }
    });
    pedido.open("POST", "/marias/api/productos/remProducto.php");
    pedido.send(data);
}