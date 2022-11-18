function openModal() {
    let listEmpleados = document.getElementById('listEmpleados');
    let listClientes = document.getElementById('listClientes');
    let fechaEntrega = document.getElementById('fechaEntrega');
if(fechaEntrega.value != '' && fechaEntrega.value != null && listClientes.value != '' && listEmpleados.value != '' && listClientes.value != null && listEmpleados.value != null){

    document.getElementById("backdrop").style.display = "block"
    document.getElementById("modalProductos").style.display = "block"
    document.getElementById("modalProductos").classList.add("show")
    

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
}else{
    Swal.fire('Complete todos los campos', '', 'warning');
}
    
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
window.onload = function(e){ 
    let d = new Date();
    let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
    let mo = new Intl.DateTimeFormat('en', { month: 'numeric' }).format(d);
    let da = new Intl.DateTimeFormat('en', { day: 'numeric' }).format(d);
    let listEmpleados = document.getElementById('listEmpleados');
    let listClientes = document.getElementById('listClientes');
    let listDirecciones = document.getElementById('listDirecciones');
    let fechaEntrega = document.getElementById('fechaEntrega');

    let todayIs = `${ye}-${mo}-${da}`;
    getEmpleados()
    .then(async (responseEmpleados)=>{
        if( await responseEmpleados.success){
            localStorage.setItem('empleados',JSON.stringify(responseEmpleados.data));
            let empleados = responseEmpleados.data;
            getClientes()
            .then(async (responseClientes)=>{
                if(await responseClientes.success){
                    localStorage.setItem('clientes',JSON.stringify(responseClientes.data));
                }
                let clientes = responseClientes.data;
                
               // for(i=0; i < empleados.length; i++){
                 //   let option = document.createElement("option");
                    //option.value = empleados[i].idempleado;
                   // option.text = empleados[i].nombre;
                 //   listEmpleados.add(option);
              //  }
               
                for(i=0; i < clientes.length; i++){
                    let option = document.createElement("option");
                    option.value = clientes[i].idcliente;
                    option.text = clientes[i].nombre;
                    listClientes.add(option);
                }
            });
        }
    });

  
    fechaEntrega.addEventListener('change',()=>{
        if(fechaEntrega.value != ''  && fechaEntrega.value != null  && listClientes.value != '' && listEmpleados != '' && listClientes.value != null && listEmpleados != null){
           if(!localStorage.getItem('idPedido') != ""){
            agregarPedido();

           }else{
            actualizarPedido();
           }
        }
    });
    
    listEmpleados.addEventListener('change', ()=>{
        if(fechaEntrega.value != ''  && fechaEntrega.value != null  && listClientes.value != '' && listEmpleados != '' && listClientes.value != null && listEmpleados != null){
                      if(!localStorage.getItem('idPedido') != ""){
            agregarPedido();

           }else{
            actualizarPedido();
           }
        }

    });

    listClientes.addEventListener('change', ()=>{
        if(fechaEntrega.value != ''  && fechaEntrega.value != null  && listClientes.value != '' && listEmpleados != '' && listClientes.value != null && listEmpleados != null){
                      if(!localStorage.getItem('idPedido') != ""){
            agregarPedido();

           }else{
            actualizarPedido();
           }
        }

        if(listClientes.value != ""){
            getDirecciones(listClientes.value)
            .then(async (responseDirecciones)=>{
                    console.log("responseDirecciones",await responseDirecciones);
                    if(responseDirecciones.success){
                        let direcciones = responseDirecciones.data;
                        localStorage.setItem('direccionesCliente',JSON.stringify(direcciones));
                        listDirecciones.innerText = '';
                        listDirecciones.innerHTML = '<option value="">Seleccione una dirección</option>'; 
                        for(i=0; i < direcciones.length; i++){
                            let option = document.createElement("option");
                            option.value = direcciones[i].iddireccion;
                            /* option.text = direcciones[i].calle+" #"+direcciones[i].numeroCasa+" "+direcciones[i].colonia; */
                            option.text = "Dirección "+(i+1);
                            listDirecciones.add(option);
                            
                        }
                        document.getElementById('infoDirecciones').classList.remove('d-none');
                    }
            });
        }else{
            document.getElementById('infoDirecciones').classList.add('d-none');
        }
    });
    listDirecciones.addEventListener('change', ()=>{
        if(listDirecciones.value != ""){
            document.getElementById('infoCliente').classList.remove('d-none');
            let direcciones = JSON.parse(localStorage.getItem('direccionesCliente'));
            for(i=0; i < direcciones.length; i++){
                if(direcciones[i].iddireccion == listDirecciones.value){

                    document.getElementById('clienteCalle').value =  direcciones[i].calle;
                    document.getElementById('clienteCiudad').value =  direcciones[i].ciudad;
                    document.getElementById('clienteCodigoPostal').value =  direcciones[i].codigopostal;
                    document.getElementById('clienteNumeroExterior').value =  direcciones[i].numeroCasa;
                    document.getElementById('clienteColonia').value =  direcciones[i].colonia;
                    document.getElementById('clienteEstado').value =  direcciones[i].estado;
                    document.getElementById('clienteDescripcion').value =  direcciones[i].descripcion;
                }
            }
        }else{
            document.getElementById('infoCliente').classList.add('d-none');
        }
    });
    



    function agregarPedido(){
        var data =  new FormData();
        data.append("idempleado", listEmpleados.value);
        data.append("fechainicio",todayIs.replaceAll("-",","));
        data.append("fechaentrega", fechaEntrega.value.replaceAll("-",","));
        data.append("idcliente", listClientes.value);
        const pedido = new XMLHttpRequest();
        pedido.addEventListener("readystatechange", async() => {
            if (pedido.readyState === 4 &&  pedido.status === 201) {
                console.log(pedido.responseText);
                let result = JSON.parse(pedido.responseText);
                localStorage.setItem('idPedido',result.data);
            }
        });
        pedido.open("POST", "/marias/api/pedidos/addpedido.php");
        pedido.send(data);
    }

    function actualizarPedido(){
        var data =  new FormData();
        data.append("idempleado", listEmpleados.value);
        data.append("idpedido",localStorage.getItem('idPedido'));
        data.append("fechaentrega", fechaEntrega.value.replaceAll("-",","));
        data.append("idcliente", listClientes.value);
        const pedido = new XMLHttpRequest();
        pedido.addEventListener("readystatechange", async() => {
            if (pedido.readyState === 4 &&  pedido.status === 201) {
                console.log("Actualizado",pedido.responseText);
                /* let result = JSON.parse(pedido.responseText); */
             
            }
        });
        pedido.open("POST", "/marias/api/pedidos/editpedido.php");
        pedido.send(data);
    }




    let costoPedido = document.getElementById('costoPedido');
    let costoEnvio = document.getElementById('costoEnvio');
    let anticipo = document.getElementById('anticipo');
    let costoTotal = document.getElementById('costoTotal');
    let restante = document.getElementById('restante');
    let pagado = document.getElementById('pagado');

    document.getElementById('costoPedido').addEventListener('keyup',()=>{
        if(costoPedido.value != '' && costoEnvio.value != ''){
            costoTotal.value = "$"+(parseFloat(costoPedido.value) + parseFloat(costoEnvio.value)).toFixed(2);
        }else{
            costoTotal.value = '';
        }
    });

    document.getElementById('costoEnvio').addEventListener('keyup',()=>{
        if(costoPedido.value != '' && costoEnvio.value != ''){
            costoTotal.value = "$"+(parseFloat(costoPedido.value) + parseFloat(costoEnvio.value)).toFixed(2);
        }else{
            costoTotal.value = '';
        }
    });
    document.getElementById('anticipo').addEventListener('keyup',()=>{
       if(costoTotal.value != '' && anticipo.value != ''){
                restante.value = "$"+(parseFloat(costoTotal.value.replace('$','')) - parseFloat(anticipo.value)).toFixed(2);
            if(parseFloat(anticipo.value.replace('$','')) < parseFloat(costoTotal.value.replace('$',''))){
                pagado.value = 'No';
            }else{
                pagado.value = 'Si';
            }
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
        .then((response)=>{
            if(response.success){
                
                Swal.fire('Producto agregado', '', 'success')
                .then(async ()=>{
                    closeModal();
                    cantidadProducto.value = '';
                    saborProducto.value = '';
                    rellenoProducto.value = '';
                    tamanoProducto.value = '';
                    coberturaProducto.value = '';
                    especificacionesProducto.value = '';
                    referenciaProducto.value = '';
                    await fillTableProductos(idPedido);
                    
                });
            }
        });
        
    }else{
        Swal.fire('Complete todos los campos', '', 'warning');
    }


}
function completePedidoPago(){
    let idPedido = localStorage.getItem('idPedido');
    let nPagos = document.getElementById('nPagos');
    let costoPedido = document.getElementById('costoPedido');
    let costoEnvio = document.getElementById('costoEnvio');
    let anticipo = document.getElementById('anticipo');
    let costoTotal = document.getElementById('costoTotal');
    let restante = document.getElementById('restante');
    let metodoPago = document.getElementById('metodoPago');
    let pagado = document.getElementById('pagado');
    let iddireccion = document.getElementById('listDirecciones');
    


            var data =  new FormData();
            data.append("ID_PEDIDO", idPedido);
            data.append("MONTO", costoPedido.value);
            data.append("ENVIO",costoEnvio.value);
            data.append("ANTICIPO", anticipo.value);
            data.append("PAGADO", pagado.value);
            data.append("FORMA_PAGO", metodoPago.value);
            data.append("ID_DIRECCION", iddireccion.value);

            const pedido = new XMLHttpRequest();
            pedido.addEventListener("readystatechange", async() => {
                console.log(pedido.responseText);
                if (pedido.readyState === 4 &&  pedido.status === 200) {
                    if(JSON.parse(pedido.responseText).success){
                        Swal.fire('Pedido agregado correctamente', '', 'success')
                        .then(()=>{
                            window.location.assign('pedidos.php')
                        });
                    }
                }
            });
            pedido.open("POST", "/marias/api/pedidos/completePedido.php");
            pedido.send(data);
        




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
                    let idPedido = localStorage.getItem('idPedido');
                    fillTableProductos(idPedido);
                });
            }
        }
    });
    pedido.open("POST", "/marias/api/productos/remProducto.php");
    pedido.send(data);
}


function fillTableProductos(idPedido){
    getProductos(idPedido)
    .then((responseData)=>{
        
        if(responseData.success){
              document.getElementById('tableInfoProductos').classList.remove('d-none');
              document.getElementById('infoPago').classList.remove('d-none');
              let tBody = document.getElementById('tableProductos');
              tBody.innerText ='';
              for(i=0;i<responseData.data.length;i++){
                  let tr = document.createElement("tr");
  
                  let td = document.createElement("td");
                  td.innerText = i+1;
                  td.className = 'align-middle';
                  tr.appendChild(td);
  
                  td = document.createElement("td");
                  td.innerText = responseData.data[i].cantidad;
                  td.className = 'align-middle';
                  tr.appendChild(td);
  
                  td = document.createElement("td");
                  td.innerText = responseData.data[i].especificaciones;
                  td.className = 'align-middle';
                  tr.appendChild(td);
  
                  td = document.createElement("td");
                  td.innerText = responseData.data[i].SABOR;
                  td.className = 'align-middle';
                  tr.appendChild(td);
  
                  td = document.createElement("td");
                  td.innerText = responseData.data[i].RELLENO;
                  td.className = 'align-middle';
                  tr.appendChild(td);
  
                  td = document.createElement("td");
                  td.innerText = responseData.data[i].TAMANO;
                  td.className = 'align-middle';
                  tr.appendChild(td);
  
                  td = document.createElement("td");
                  td.innerText = responseData.data[i].COBERTURA;
                  td.className = 'align-middle';
                  tr.appendChild(td);
  
                  td = document.createElement("td");
                  td.innerHTML = "<img src='/marias/api"+responseData.data[i].imgref+"'  width='100' >";
                  td.className = 'align-middle ';
                  tr.appendChild(td);
  
                  
                  td = document.createElement("td");
                  td.innerHTML = '<i class="bi bi-dash-circle-fill text-center" id="'+responseData.data[i].idproducto+'" onclick="removeProduct('+responseData.data[i].idproducto+')" ></i>';
                  td.className = 'align-middle';
                  tr.appendChild(td);
                  
                  tBody.appendChild(tr);
              }
        }else{
            let tBody = document.getElementById('tableProductos');
            tBody.innerText ='';
            document.getElementById('tableInfoProductos').classList.add('d-none');
            document.getElementById('infoPago').classList.add('d-none');
        }
    });
}

function addAddress(){
    let listDirecciones = document.getElementById('listDirecciones');
    let direcciones = JSON.parse(localStorage.getItem('direccionesCliente'));

    listDirecciones.innerText = '';
    listDirecciones.innerHTML = '<option value="">Nueva dirección</option>'; 
   
    for(i=0; i < direcciones.length; i++){
        let option = document.createElement("option");
        option.value = direcciones[i].iddireccion;
        option.text = "Dirección "+(i+1);
        listDirecciones.add(option);
    }   
   

  

   
    document.getElementById('clienteCalle').removeAttribute("readonly");
    document.getElementById('clienteCalle').classList.remove('form-control-plaintext');
    document.getElementById('clienteCalle').value = '';
    document.getElementById('clienteCiudad').removeAttribute("readonly");
    document.getElementById('clienteCiudad').classList.remove('form-control-plaintext');
    document.getElementById('clienteCiudad').value = '';
    document.getElementById('clienteCodigoPostal').removeAttribute("readonly");
    document.getElementById('clienteCodigoPostal').classList.remove('form-control-plaintext');
    document.getElementById('clienteCodigoPostal').value = '';
    document.getElementById('clienteNumeroExterior').removeAttribute("readonly");
    document.getElementById('clienteNumeroExterior').classList.remove('form-control-plaintext');
    document.getElementById('clienteNumeroExterior').value = '';
    document.getElementById('clienteColonia').removeAttribute("readonly");
    document.getElementById('clienteColonia').classList.remove('form-control-plaintext');
    document.getElementById('clienteColonia').value = '';
    document.getElementById('clienteEstado').removeAttribute("readonly");
    document.getElementById('clienteEstado').classList.remove('form-control-plaintext');
    document.getElementById('clienteEstado').value = '';
    document.getElementById('clienteDescripcion').removeAttribute("readonly");
    document.getElementById('clienteDescripcion').classList.remove('form-control-plaintext');
    document.getElementById('clienteDescripcion').value = '';
    document.getElementById('infoCliente').classList.remove('d-none');
    document.getElementById('btnGuardarDireccion').classList.remove('d-none');
    


}

function guardarDireccion(){
    
    let idcliente = document.getElementById('listClientes').value;
    let calle = document.getElementById('clienteCalle').value;
    let ciudad = document.getElementById('clienteCiudad').value;
    let codigo = document.getElementById('clienteCodigoPostal').value;
    let numero = document.getElementById('clienteNumeroExterior').value;
    let colonia = document.getElementById('clienteColonia').value;
    let estado = document.getElementById('clienteEstado').value;
    let descripcion = document.getElementById('clienteDescripcion').value;
    nuevaDireccion(idcliente,calle,ciudad,codigo,numero,colonia,estado,descripcion)
    .then(async (responseDireccion)=>{
        if(await responseDireccion.success){
            window.memo = responseDireccion;
            console.log("responseDireccion.data",responseDireccion);
            Swal.fire('Dirección guardada coreectamente', '', 'success')
            .then(()=>{
                document.getElementById('clienteCalle').setAttribute("readonly","");
                document.getElementById('clienteCalle').classList.add('form-control-plaintext');
                document.getElementById('clienteCiudad').setAttribute("readonly","");
                document.getElementById('clienteCiudad').classList.add('form-control-plaintext');
                document.getElementById('clienteCodigoPostal').setAttribute("readonly","");
                document.getElementById('clienteCodigoPostal').classList.add('form-control-plaintext');
                document.getElementById('clienteNumeroExterior').setAttribute("readonly","");
                document.getElementById('clienteNumeroExterior').classList.add('form-control-plaintext');
                document.getElementById('clienteColonia').setAttribute("readonly","");
                document.getElementById('clienteColonia').classList.add('form-control-plaintext');
                document.getElementById('clienteEstado').setAttribute("readonly","");
                document.getElementById('clienteEstado').classList.add('form-control-plaintext');
                document.getElementById('clienteDescripcion').setAttribute("readonly","");
                document.getElementById('clienteDescripcion').classList.add('form-control-plaintext');
                document.getElementById('btnGuardarDireccion').classList.add('d-none');
                
                let listDirecciones = document.getElementById('listDirecciones');
                let direcciones = JSON.parse(localStorage.getItem('direccionesCliente'));
                listDirecciones.innerText = '';
                listDirecciones.innerHTML = '<option value="'+responseDireccion.response.data+'">Nueva dirección</option>'; 
               
                for(i=0; i < direcciones.length; i++){
                    let option = document.createElement("option");
                    option.value = direcciones[i].iddireccion;
                    option.text = "Dirección "+(i+1);
                    listDirecciones.add(option);
                }   
                
        });
        }
    });
}