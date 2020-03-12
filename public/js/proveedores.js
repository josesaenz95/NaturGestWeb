let scroll = new SmoothScroll('a[href="#form-registro"]',{
    speed: 500,
    speedAsDuration: true
});
document.querySelector('#btnRegistrar').addEventListener('click', registrarTrabajador);
document.querySelector('#txtBuscarProveedor').addEventListener('input', buscarProveedor);

function obtenerProveedores(){
    let url = '../getProveedores';
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

function buscarProveedor(){
    try{
        let txtBuscar = document.querySelector("#txtBuscarProveedor").value,
            slFiltro = document.querySelector("#slFiltro").value;
        if(txtBuscar != ""){
            let url = "../findProveedor/" + txtBuscar + "_" + slFiltro;
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
                        case 'ciudad':                    
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
            obtenerProveedores();
        }
    }catch(error){
        console.log(error);
    }
}

function cargarTabla(data){
    let tbody = document.querySelector("#tbody-proveedores");
    while(tbody.firstChild){
        tbody.removeChild(tbody.firstChild);
    }
    for(let i=0; i < data.length; ++i){
        let proveedor = data[i];
        let tr = document.createElement("tr"),
            tdId = document.createElement("td"),
            tdRut = document.createElement("td"),
            tdNombre = document.createElement("td"),
            tdDireccion = document.createElement("td"),
            tdTelefono = document.createElement("td"),
            tdCorreo = document.createElement("td"),
            tdCiudad = document.createElement("td"),
            tdAccion = document.createElement("td"),
            btnEliminar = document.createElement("button"),
            btnEditar = document.createElement("button"),
            tdEd = document.createElement("td");
        btnEliminar.innerHTML = "ELIMINAR";
        btnEliminar.className += "btn btn-danger btn-eliminar";
        btnEliminar.setAttribute("data-proveedor", proveedor.id);
        btnEditar.innerHTML = "EDITAR";
        btnEditar.className += "btn bg-form text-white btn-editar";
        btnEditar.setAttribute("data-proveedor", JSON.stringify(proveedor));
        btnEditar.setAttribute("id", "btnEditar");
        tdId.append(proveedor.id);
        tdRut.append(proveedor.rut !== null ? proveedor.rut : '"No registra"');
        tdNombre.append(proveedor.nombre !== null ? proveedor.nombre : '"No registra"');
        tdDireccion.append(proveedor.direccion !== null ? proveedor.direccion : '"No registra"');
        tdDireccion.append(proveedor.n_dir);
        tdTelefono.append(proveedor.telefono !== null ? proveedor.telefono : '"No registra"');
        tdCorreo.append(proveedor.correo !== null ? proveedor.correo : '"No registra"');
        tdCiudad.append(proveedor.ciudad !== null ? proveedor.ciudad : '"No registra"');
        tdAccion.append(btnEliminar);
        tdEd.append(btnEditar);
        tr.appendChild(tdId);
        tr.appendChild(tdRut);
        tr.appendChild(tdNombre);
        tr.appendChild(tdDireccion);
        tr.appendChild(tdTelefono);
        tr.appendChild(tdCorreo);
        tr.appendChild(tdCiudad)
        tr.appendChild(tdAccion);
        tr.append(tdEd);
        tbody.appendChild(tr);
        btnEliminar.addEventListener("click", eliminarProveedor);
        btnEditar.addEventListener("click", editarProveedor);
    }
}

( () => {
    let ciudades = ['La Serena', 'Santiago', 
                    'Valparaíso', 'Viña del Mar',
                    'Valdivia', 'Puerto Montt',
                    'Chiloe', 'Coyhaique', 'Aysen'];
    for(let i=0; i < ciudades.length; ++i){
        let ciudad = ciudades[i],
            option = document.createElement('option');
        option.value = ciudad;
        option.append(ciudad);
        slCiudades.appendChild(option);
    }
})();

function limpiar(){
    document.querySelector("#txtRut").value = "";
    document.querySelector("#txtNombre").value = "";
    document.querySelector("#txtDir").value = "";
    document.querySelector("#txtNDir").value = "";
    document.querySelector("#txtFono").value = "";
    document.querySelector("#txtCorreo").value = "";
    document.querySelector("#slCiudades").value = "0";
}

function validarForm(){
    let errores = [];
    let divErrores = document.querySelector("#errores");
    let rut = document.querySelector("#txtRut").value,
        nombre = document.querySelector("#txtNombre").value,
        dir = document.querySelector("#txtDir").value,
        nDir = document.querySelector("#txtNDir").value,
        telefono = document.querySelector("#txtFono").value,
        correo = document.querySelector("#txtCorreo").value,
        ciudad = document.querySelector("#slCiudades").value;
    if(rut.trim() === ""){
        errores.push("Debe ingresar un rut");
    }   
    if(nombre.trim() === ""){
        errores.push("Debe ingresar un nombre");
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
    if(ciudad === "0"){
        errores.push("Debe seleccionar una ciudad");
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
        divErrores.classList.add('alert', 'alert-success');
        span.append(errores);
        divErrores.appendChild(span);
        setTimeout(function(){
            divErrores.removeChild(span);
            divErrores.classList.remove('alert', 'alert-success');
        }, 4000);
        return true;
    }
}

function registrarTrabajador(){
    if(validarForm()){
        let rut = document.querySelector("#txtRut").value,
            nombre = document.querySelector("#txtNombre").value,
            dir = document.querySelector("#txtDir").value,
            nDir = document.querySelector("#txtNDir").value,
            telefono = document.querySelector("#txtFono").value,
            correo = document.querySelector("#txtCorreo").value,
            ciudad = document.querySelector("#slCiudades").value;

        let data = {};
        data.rut = rut;
        data.nombre = nombre;
        data.telefono = telefono;
        data.correo = correo;
        data.direccion = dir;
        data.n_dir = nDir;
        data.ciudad = ciudad;

        let json = JSON.stringify(data);
        console.log(json);
        let url = "../setProveedor";
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
                console.log(JSON.stringify(data));
                obtenerProveedores();
                limpiar();
            })
            .catch(function(error){
                console.log(JSON.stringify(error));
            });
    }
}

function eliminarProveedor(){
    let proveedor = this.getAttribute('data-proveedor'),
        url = '../delProveedor/' + proveedor,
        headers = new Headers({
            'Content-type':'application/json; charset=utf-8',
            'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content
        });
    fetch(url, {
        method: 'DELETE',
        headers: headers
    })
    .then(function(response){
        return response;
    })
    .then(function(data){
        obtenerProveedores();
        limpiar();
    })
    .catch(function(error){
        console.log(error);
    });
}

function editarProveedor(){
    let proveedor = JSON.parse(this.getAttribute('data-proveedor'));
    console.log(proveedor);
    let btnEd = document.querySelector('#btnEd'),
        btnRe = document.querySelector('#btnRegistrar');
    btnEd.hidden = false;
    btnRe.hidden = true;

    let rut = document.querySelector("#txtRut").value = proveedor.rut,
        nombre = document.querySelector("#txtNombre").value = proveedor.nombre,
        dir = document.querySelector("#txtDir").value = proveedor.direccion,
        nDir = document.querySelector("#txtNDir").value = proveedor.n_dir,
        telefono = document.querySelector("#txtFono").value = proveedor.telefono,
        correo = document.querySelector("#txtCorreo").value = proveedor.correo,
        ciudad = document.querySelector("#slCiudades").value = proveedor.ciudad;

    btnEd.addEventListener('click', function(){
        try{
            rut = document.querySelector("#txtRut").value,
            nombre = document.querySelector("#txtNombre").value,
            dir = document.querySelector("#txtDir").value,
            nDir = document.querySelector("#txtNDir").value,
            telefono = document.querySelector("#txtFono").value,
            correo = document.querySelector("#txtCorreo").value,
            ciudad = document.querySelector("#slCiudades").value;

            let data = {};
            data.rut = rut;
            data.nombre = nombre;
            data.telefono = telefono;
            data.correo = correo;
            data.direccion = dir;
            data.n_dir = nDir;
            data.ciudad = ciudad;

            let json = JSON.stringify(data),
                url = '';
            url = '../updProveedor/' + proveedor.id;
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
                        // let tg = setTimeout(function(){
                            obtenerProveedores();
                        // }, 15);
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

obtenerProveedores();