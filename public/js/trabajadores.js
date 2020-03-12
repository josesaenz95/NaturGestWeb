let scroll = new SmoothScroll('a[href="#form-registro"]',{
    speed: 500,
    speedAsDuration: true
});
document.querySelector('#btnRegistrar').addEventListener('click', registrarTrabajador);
document.querySelector('#txtBuscarTrabajador').addEventListener('input', buscarTrabajador);

function obtenerTrabajadores(){
    let url = '../getTrabajadores';
    fetch(url)
        .then(function(response){
            return response.json();
        })
        .then(function(data){
            cargarTabla(data);
        })
        .catch(function(error){
            console.log(error);
        });
}

function buscarTrabajador(){
    try{
        let txtBuscar = document.querySelector("#txtBuscarTrabajador").value,
            slFiltro = document.querySelector("#slFiltro").value;
        if(txtBuscar != ""){
            let url = "../findTrabajador/" + txtBuscar + "_" + slFiltro;
            fetch(url)
                .then(function(response){
                    return response.json();
                }).then(function(data) {
                    switch(slFiltro){
                        case "id":
                            cargarTabla(data);        
                            break;
                        case 'rut':
                            cargarTabla(data);
                        case 'nombre':                           
                            cargarTabla(data);
                        case 'ap_pat':                    
                            cargarTabla(data);
                            break;
                        case 'sucursal':                    
                            cargarTabla(data);
                        break;
                        case 'usuario':                    
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
            obtenerTrabajadores();
        }
    }catch(error){
        console.log(error);
    }
}

function cargarTabla(data){
    let tbody = document.querySelector("#tbody-trabajadores");
    while(tbody.firstChild){
        tbody.removeChild(tbody.firstChild);
    }
    for(let i=0; i < data.length; ++i){
        let trabajador = data[i];
        let tr = document.createElement("tr"),
            tdId = document.createElement("td"),
            tdRut = document.createElement("td"),
            tdNombre = document.createElement("td"),
            tdApP = document.createElement("td"),
            tdApM = document.createElement("td"),
            tdTelefono = document.createElement("td"),
            tdCorreo = document.createElement("td"),
            tdSucursal = document.createElement("td"),
            tdUsuario = document.createElement("td"),
            tdAccion = document.createElement("td"),
            btnEliminar = document.createElement("button"),
            btnEditar = document.createElement("button"),
            tdEd = document.createElement("td");
        btnEliminar.innerHTML = "ELIMINAR";
        btnEliminar.className += "btn btn-danger btn-eliminar";
        btnEliminar.setAttribute("data-trabajador", trabajador.id);
        btnEditar.innerHTML = "EDITAR";
        btnEditar.className += "btn bg-form text-white btn-editar";
        btnEditar.setAttribute("data-trabajador", JSON.stringify(trabajador));
        btnEditar.setAttribute("id", "btnEditar");
        tdId.append(trabajador.id);
        tdRut.append(trabajador.rut !== null ? trabajador.rut : '"No registra"');
        tdNombre.append(trabajador.nombre !== null ? trabajador.nombre : '"No registra"');
        tdApP.append(trabajador.ap_pat !== null ? trabajador.ap_pat : '"No registra"');
        tdApM.append(trabajador.ap_mat !== null ? trabajador.ap_mat : '"No registra"');
        tdTelefono.append(trabajador.telefono !== null ? trabajador.telefono : '"No registra"');
        tdCorreo.append(trabajador.correo !== null ? trabajador.correo : '"No registra"');
        tdSucursal.append(trabajador.sucursal !== null ? trabajador.sucursal : '"No registra"');
        tdUsuario.append(trabajador.usuario !== null ? trabajador.usuario : '"No registra"');
        tdAccion.append(btnEliminar);
        tdEd.append(btnEditar);
        tr.appendChild(tdId);
        tr.appendChild(tdRut);
        tr.appendChild(tdNombre);
        tr.appendChild(tdApP);
        tr.appendChild(tdApM);
        tr.appendChild(tdTelefono);
        tr.appendChild(tdCorreo);
        tr.appendChild(tdSucursal)
        tr.appendChild(tdUsuario)
        tr.appendChild(tdAccion);
        tr.append(tdEd);
        tbody.appendChild(tr);
        btnEliminar.addEventListener("click", eliminarTrabajador);
        btnEditar.addEventListener("click", editarTrabajador);
    }
}

/**
 * Obtiene las sucrsales de la B.D y los carga en el dropdown.
 */
(() => {
    let slSucursales = document.querySelector('#slSucursales'),
        url = '../getSucursales';
    fetch(url)
        .then(function(response){
            return response.json();
        })
        .then(function(data){
            for(let i=0; i < data.length; ++i){
                let sucursal = data[i],
                    option = document.createElement('option');
                option.value = sucursal.id;
                option.append(sucursal.nombre);
                slSucursales.appendChild(option);
            }
        })
        .catch(function(error){
            console.log(error);
        });
})();

/**
 * Obtiene los tipos de usuario de la B.D y los carga en el dropdown.
 */
(() => {
    let slUsuario = document.querySelector('#slUsuario'),
        url = '../getUsuarios';
    fetch(url)
        .then(function(response){
            return response.json();
        })
        .then(function(data){
            for(let i=0; i < data.length; ++i){
                let usuario = data[i],
                    option = document.createElement('option');
                if(usuario.name != 'gerente'){
                    option.value = usuario.id;
                    option.append(usuario.name);
                    slUsuario.appendChild(option);
                }
            }
        })
        .catch(function(error){
            console.log(error);
        });
})();

function limpiar(){
    document.querySelector("#txtRut").value = "";
    document.querySelector("#txtNombre").value = "";
    document.querySelector("#txtApPat").value = "";
    document.querySelector("#txtApMat").value = "";
    document.querySelector("#txtDir").value = "";
    document.querySelector("#txtNDir").value = "";
    document.querySelector("#txtFono").value = "";
    document.querySelector("#txtCorreo").value = "";
    document.querySelector("#slSucursales").value = "0";
    document.querySelector("#slUsuario").value = "0";
}

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
        correo = document.querySelector("#txtCorreo").value,
        sucursal = document.querySelector("#slSucursales").value,
        usuario = document.querySelector("#slUsuario").value;
    if(rut.trim() === ""){
        errores.push("Debe ingresar un rut");
    }   
    if(nombre.trim() === ""){
        errores.push("Debe ingresar un nombre");
    }
    if(apPat.trim() === ""){
        errores.push("Debe ingresar apellido paterno");
    }
    if(apMat.trim() === ""){
        errores.push("Debe ingresar apellido materno");
    }
    if(dir.trim() === ""){
        errores.push("Debe ingresar una dirección");
    }
    if(nDir === ""){
        errores.push("Debe ingresar un número de dirección");
    }
    if(telefono === ""){
     errores.push("Debe ingresar un teléfono");
    }
    if(correo.trim() === ""){
        errores.push("Debe ingresar un correo");
    }
    if(sucursal === "0"){
        errores.push("Debe seleccionar una sucursal");
    }
    if(usuario === "0"){
        errores.push("Debe seleccionar un usuario");
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
        errores.push("Registro Exitoso");
        let span = document.createElement('span');
        divErrores.className += 'alert alert-success';
        span.append(errores);
        divErrores.appendChild(span);
        return true;
    }
}

function registrarTrabajador(){
    if(validarForm()){
        let rut = document.querySelector("#txtRut").value,
            nombre = document.querySelector("#txtNombre").value,
            apPat = document.querySelector("#txtApPat").value,
            apMat = document.querySelector("#txtApMat").value,
            dir = document.querySelector("#txtDir").value,
            nDir = document.querySelector("#txtNDir").value,
            telefono = document.querySelector("#txtFono").value,
            correo = document.querySelector("#txtCorreo").value,
            sucursal = document.querySelector("#slSucursales").value,
            usuario = document.querySelector("#slUsuario").value;

        let data = {};
        data.rut = rut;
        data.nombre = nombre;
        data.ap_pat = apPat;
        data.ap_mat = apMat;
        data.direccion = dir;
        data.n_direccion = nDir;
        data.telefono = telefono;
        data.correo = correo;
        data.sucursales_id = sucursal;
        data.users_id = usuario;

        let json = JSON.stringify(data);
        let url = "../setTrabajador";
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
                obtenerTrabajadores();
                limpiar();
            })
            .catch(function(error){
                console.log(error);
            });
    }
}

function eliminarTrabajador(){
    let trabajador = this.getAttribute("data-trabajador"),
        url = "../delTrabajador/" + trabajador,
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
            obtenerTrabajadores();
        })
        .catch(function(error){
            console.log(error);
        });
}

function editarTrabajador(){
    let trabajador = JSON.parse(this.getAttribute('data-trabajador'));
    console.log(trabajador);
    let btnEd = document.querySelector('#btnEd'),
        btnRe = document.querySelector('#btnRegistrar');
    btnEd.hidden = false;
    btnRe.hidden = true;

    let rut = document.querySelector("#txtRut").value = trabajador.rut,
        nombre = document.querySelector("#txtNombre").value = trabajador.nombre,
        apPat = document.querySelector("#txtApPat").value = trabajador.ap_pat,
        apMat = document.querySelector("#txtApMat").value = trabajador.ap_mat,
        dir = document.querySelector("#txtDir").value = trabajador.direccion,
        nDir = document.querySelector("#txtNDir").value = trabajador.n_direccion,
        telefono = document.querySelector("#txtFono").value = trabajador.telefono,
        correo = document.querySelector("#txtCorreo").value = trabajador.correo,
        sucursal = document.querySelector("#slSucursales").value = trabajador.sucursales_id,
        usuario = document.querySelector("#slUsuario").value = trabajador.users_id;
    
    btnEd.addEventListener("click", function(){    
        try{
            rut = document.querySelector("#txtRut").value,
            nombre = document.querySelector("#txtNombre").value,
            apPat = document.querySelector("#txtApPat").value,
            apMat = document.querySelector("#txtApMat").value,
            dir = document.querySelector("#txtDir").value,
            nDir = document.querySelector("#txtNDir").value,
            telefono = document.querySelector("#txtFono").value,
            correo = document.querySelector("#txtCorreo").value,
            sucursal = document.querySelector("#slSucursales").value,
            usuario = document.querySelector("#slUsuario").value;
            
            let data = {};
            data.rut = rut;
            data.nombre = nombre;
            data.ap_pat = apPat;
            data.ap_mat = apMat;
            data.direccion = dir;
            data.n_direccion = nDir;
            data.telefono = telefono;
            data.correo = correo;
            data.sucursales_id = sucursal;
            data.users_id = usuario;
            
            let json = JSON.stringify(data);
            let url = "";
            url = "../updTrabajador/" + trabajador.id;
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
                            trabajador = null;
                            limpiar();
                            let tg = setTimeout(function(){
                                obtenerTrabajadores();
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

obtenerTrabajadores();