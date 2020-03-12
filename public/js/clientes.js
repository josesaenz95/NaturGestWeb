document.querySelector("#btnRegistrar").addEventListener("click", registrarCliente);
document.querySelector("#txtBuscarCliente").addEventListener("input", buscarCliente);

function validarForm(){
    let errores = [];
    let divErrores = document.querySelector("#errores");
    let rut = document.querySelector("#txtRut").value,
        nombre = document.querySelector("#txtNombre").value,
        apPat = document.querySelector("#txtApPat").value,
        apMat = document.querySelector("#txtApMat").value,
        dir = document.querySelector("#txtDir").value,
        nDir = document.querySelector("#txtNDir").value,
        telefono = document.querySelector("#txtFono").value,
        correo = document.querySelector("#txtCorreo").value;
    if(rut.trim() == ""){
        errores.push("Debe ingresar un rut");
    }   
    if(nombre.trim() == ""){
        errores.push("Debe ingresar un nombre");
    }
    if(apPat.trim() == ""){
        errores.push("Debe ingresar apellido paterno");
    }
    if(apMat.trim() == ""){
        errores.push("Debe ingresar apellido materno");
    }
    if(dir.trim() == ""){
        errores.push("Debe ingresar una dirección");
    }
    if(nDir == ""){
        errores.push("Debe ingresar un número de dirección");
    }
    if(telefono == ""){
     errores.push("Debe ingresar un teléfono");
    }
    if(correo.trim() == ""){
        errores.push("Debe ingresar un correo");
    }
    divErrores.innerHTML = "";
    if(errores.length > 0){
        let ul = document.createElement("ul");
        ul.className += "alert alert-danger errores";
        for(let i=0; i < errores.length; ++i){
            let li = document.createElement("li");
            li.append(errores[i]);
            ul.appendChild(li);
        }
        divErrores.appendChild(ul);
        setTimeout(function(){
            divErrores.removeChild(ul);
        }, 4000); 
        return false;
    }else{
        return true;
    }
}

function limpiar(){
    document.querySelector("#txtRut").value = "";
    document.querySelector("#txtNombre").value = "";
    document.querySelector("#txtApPat").value = "";
    document.querySelector("#txtApMat").value = "";
    document.querySelector("#txtDir").value = "";
    document.querySelector("#txtNDir").value = "";
    document.querySelector("#txtFono").value = "";
    document.querySelector("#txtCorreo").value = "";
}

function cargarTabla(lista){
    let tbody = document.querySelector("#tbody-clientes");
    while(tbody.firstChild){
        tbody.removeChild(tbody.firstChild);
    }
    for(let i=0; i < lista.length; ++i){
        let cliente = lista[i];
        let tr = document.createElement("tr"),
            tdId = document.createElement("td"),
            tdRut = document.createElement("td"),
            tdNombre = document.createElement("td"),
            tdAp = document.createElement("td"),
            tdTelefono = document.createElement("td"),
            tdCorreo = document.createElement("td"),
            tdAccion = document.createElement("td"),
            btnEliminar = document.createElement("button"),
            btnEditar = document.createElement("button"),
            tdEd = document.createElement("td");
        btnEliminar.innerHTML = "ELIMINAR";
        btnEliminar.className += "btn btn-danger btn-eliminar";
        btnEliminar.setAttribute("data-cliente", cliente.id);
        btnEditar.innerHTML = "EDITAR";
        btnEditar.className += "btn bg-form text-white btn-editar";
        btnEditar.setAttribute("data-cliente", JSON.stringify(cliente));
        btnEditar.setAttribute("id", "btnEditar");
        tdId.append(cliente.id);
        tdRut.append(cliente.rut);
        tdNombre.append(cliente.nombre);
        tdAp.append(cliente.ap_pat);
        tdTelefono.append(cliente.telefono);
        tdCorreo.append(cliente.correo);
        tdAccion.append(btnEliminar);
        tdEd.append(btnEditar);
        tr.appendChild(tdId);
        tr.appendChild(tdRut);
        tr.appendChild(tdNombre);
        tr.appendChild(tdAp);
        tr.appendChild(tdTelefono);
        tr.appendChild(tdCorreo);
        tr.appendChild(tdAccion);
        tr.append(tdEd);
        tbody.appendChild(tr);
        btnEliminar.addEventListener("click", eliminarCliente);
        btnEditar.addEventListener("click", editarCliente);
    }
}

function getClientes(){
    let url = "../getClientes";
    fetch(url)
        .then(function(response){
            return response.json();
        }).then(function(data) {
            cargarTabla(data);
        })
        .catch(function(error){
            console.log(error);
        });
}

function buscarCliente(){
    try{
        let txtBuscar = document.querySelector("#txtBuscarCliente").value;
        let slFiltro = document.querySelector("#slFiltro").value;
        if(txtBuscar != ""){
            let url = "../findCliente/" + txtBuscar + "_" + slFiltro;
            fetch(url)
                .then(function(response){
                    return response.json();
                }).then(function(data) {
                    switch(slFiltro){
                        case "id":
                            filtrarId(data);        
                            break;
                        case 'rut':
                            cargarTabla(data);
                        case 'nombre':                           
                            cargarTabla(data);
                        case 'ap_pat':                    
                            cargarTabla(data);
                            break;
                        default:
                            break;
                    } 
                })
                .catch(function(error){
                    console.log(error);
                });
        }else{
            getClientes();
        }
    }catch(error){
        console.log(error);
    }
}

function filtrarId(lista){
    let tbody = document.getElementById("tbody-clientes");
     while(tbody.firstChild){
        tbody.removeChild(tbody.firstChild);
     }
    // for(var i=0; i < lista.length; ++i){
        let cliente = lista;
        let tr = document.createElement("tr"),
            tdId = document.createElement("td"),
            tdRut = document.createElement("td"),
            tdNombre = document.createElement("td"),
            tdAp = document.createElement("td"),
            tdTelefono = document.createElement("td"),
            tdCorreo = document.createElement("td"),
            tdAccion = document.createElement("td"),
            btnEliminar = document.createElement("button"),
            btnEditar = document.createElement("button"),
            tdEd = document.createElement("td");
        btnEliminar.innerHTML = "ELIMINAR";
        btnEliminar.className += "btn btn-danger btn-eliminar";
        btnEliminar.setAttribute("data-cliente", cliente.id);
        btnEditar.innerHTML = "EDITAR";
        btnEditar.className += "btn bg-form text-white btn-editar";
        btnEditar.setAttribute("data-cliente", JSON.stringify(cliente));
        btnEditar.setAttribute("id", "btnEditar");
        tdId.append(cliente.id);
        tdRut.append(cliente.rut);
        tdNombre.append(cliente.nombre);
        tdAp.append(cliente.ap_pat);
        tdTelefono.append(cliente.telefono);
        tdCorreo.append(cliente.correo);
        tdAccion.append(btnEliminar);
        tdEd.append(btnEditar);
        tr.appendChild(tdId);
        tr.appendChild(tdRut);
        tr.appendChild(tdNombre);
        tr.appendChild(tdAp);
        tr.appendChild(tdTelefono);
        tr.appendChild(tdCorreo);
        tr.appendChild(tdAccion);
        tr.append(tdEd);
        tbody.appendChild(tr);
        btnEliminar.addEventListener("click", eliminarCliente);
        btnEditar.addEventListener("click", editarCliente);
    // }
}

function registrarCliente(){
    if(validarForm()){
        let rut = document.querySelector("#txtRut").value,
            nombre = document.querySelector("#txtNombre").value,
            apPat = document.querySelector("#txtApPat").value,
            apMat = document.querySelector("#txtApMat").value,
            dir = document.querySelector("#txtDir").value,
            nDir = document.querySelector("#txtNDir").value,
            telefono = document.querySelector("#txtFono").value,
            correo = document.querySelector("#txtCorreo").value;

        let data = {};
        data.rut = rut;
        data.nombre = nombre;
        data.ap_pat = apPat;
        data.ap_mat = apMat;
        data.direccion = dir;
        data.n_dir = nDir;
        data.telefono = telefono;
        data.correo = correo;

        let json = JSON.stringify(data);

        let url = "../setCliente";
        let headers = new Headers({
            'Content-type':'application/json; charset=utf-8',
            'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content
        });
        fetch(url, {
                method: 'POST',
                headers: headers,
                body: json
            })
            .then(function(response){
                return response;
            })
            .then(function(data){
                console.log(data);
                getClientes();
                limpiar();
            })
            .catch(function(error){
                console.log(error);
            });
    }
}

function eliminarCliente(){
    let cliente = this.getAttribute("data-cliente"),
        url = "../delCliente/" + cliente,
        headers = new Headers({
            'Content-type':'application/json; charset=utf-8',
            'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content
        });
    fetch(url, {
            method: 'DELETE',
            headers: headers,
        })
        .then(function(response){
            return response;
        })
        .then(function(data){
            console.log(data);
            getClientes();
        })
        .catch(function(error){
            console.log(error);
        });
}

function editarCliente(){
    let cliente = JSON.parse(this.getAttribute("data-cliente"));
    console.log(cliente);
    let btnEd = document.getElementById("btnEd"); 
    let btnRe = document.getElementById("btnRegistrar"); 
    btnEd.hidden = false
    btnRe.hidden = true;
    let rut = document.querySelector("#txtRut").value = cliente.rut,
        nombre = document.querySelector("#txtNombre").value = cliente.nombre,
        apPat = document.querySelector("#txtApPat").value = cliente.ap_pat,
        apMat = document.querySelector("#txtApMat").value = cliente.ap_mat,
        dir = document.querySelector("#txtDir").value = cliente.direccion,
        nDir = document.querySelector("#txtNDir").value = cliente.n_dir,
        telefono = document.querySelector("#txtFono").value = cliente.telefono,
        correo = document.querySelector("#txtCorreo").value = cliente.correo;
    btnEd.addEventListener("click", function(){    
        try{
            rut = document.querySelector("txtRut").value,
            nombre = document.querySelector("txtNombre").value ,
            apPat = document.querySelector("txtApPat").value,
            apMat = document.querySelector("txtApMat").value,
            dir = document.querySelector("txtDir").value,
            nDir = document.querySelector("txtNDir").value ,
            telefono = document.querySelector("txtFono").value,
            correo = document.querySelector("txtCorreo").value;

            let data = {};
            data.rut = rut;
            data.nombre = nombre;
            data.ap_pat = apPat;
            data.ap_mat = apMat;
            data.direccion = dir;
            data.n_dir = nDir;
            data.telefono = telefono;
            data.correo = correo;

            let json = JSON.stringify(data);
            let url = "";
            url = "../updCliente/" + cliente.id;
            console.log(url);
            let headers = new Headers({
                'Content-type':'application/json; charset=utf-8',
                'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content
            });
                if(validarForm()){
                    fetch(url, {
                            method: 'PATCH',
                            headers: headers,
                            body: json
                        })
                        .then(function(response){
                            return response;
                        })
                        .then(function(data){
                            console.log(data);
                            btnRe.hidden = false;
                            btnEd.hidden = true;
                            cliente = null;
                            limpiar();
                            let tg = setTimeout(function(){
                                getClientes();
                            }, 15);
                        })
                        .catch(function(error){
                            console.log(error);
                        });
                }
            }catch(error){
                console.log(error);
            }
        });
}

getClientes();