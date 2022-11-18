function getDirecciones(idcliente){
    let direccion = new Promise(function(myResolve, myReject) {
        try{
            const client = new XMLHttpRequest();
            client.addEventListener("readystatechange", async() => {
                if (client.readyState === 4 &&  client.status === 200) {
                    myResolve(JSON.parse(client.responseText));
                }  
            });
            client.open("GET", "/marias/api/direcciones/getdirecciones.php?idcliente="+idcliente);
            client.send();
        }catch(error){
                myReject({
                    success:false,
                    message:error.message
                });
        }
        });
        return direccion;
}

function indexDireccion(iddireccion){
    console.log("iddireccion",iddireccion);
    let direccion = new Promise(function(myResolve, myReject) {
        try{
            const request = new XMLHttpRequest();
            request.addEventListener("readystatechange", async() => {
                if (request.readyState === 4 &&  request.status === 200) {
                    console.log("filerequestes",request.responseText);
                    myResolve(JSON.parse(request.responseText));
                }  
            });
            request.open("GET", "/marias/api/direcciones/indexdireccion.php?iddireccion="+iddireccion);
            request.send();
        }catch(error){
                myReject({
                    success:false,
                    message:error.message
                });
        }
        });
        return direccion;
}

function nuevaDireccion(idcliente,calle,ciudad,codigo,numero,colonia,estado,descripcion){
    let direccion = new Promise(function(myResolve, myReject) {
        var data =  new FormData();
        data.append("ID_CLIENTE",idcliente);
        data.append("CALLE",calle);
        data.append("CIUDAD",ciudad);
        data.append("CODIGO",codigo);
        data.append("NUMERO",numero);
        data.append("COLONIA",colonia);
        data.append("ESTADO",estado);
        data.append("DESCRIPCION",descripcion);
        try{
            
            const request = new XMLHttpRequest();
            request.addEventListener("readystatechange", async() => {
                if (request.readyState === 4 &&  request.status === 200) {
                    let response = JSON.parse(request.responseText);
                    if(response.success){
                        myResolve({
                            success:true,
                            response
                        });
                    }else{
                        myResolve({
                            success:false,
                            message:response.responseText
                        });
                    }
                }  
            });
            request.open("POST", "/marias/api/direcciones/adddireccion.php");
            request.send(data);
        }catch(error){
            myReject({
                success:false,
                message:error.message
            });
        }
    });
    return direccion;
}