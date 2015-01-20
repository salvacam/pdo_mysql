var verPagina = function(txt) {
    document.getElementById("mostrar").innerHTML = "";
    var ojson = JSON.parse(txt);
    var tabla = document.createElement("table");
    tabla.setAttribute("border", "1");
    var tr = document.createElement("tr");
    //Cabecera
    for (prop in ojson.usuarios[0]) {
        var th = document.createElement("th");
        th.textContent = prop;
        tr.appendChild(th);
    }
    var th1 = document.createElement("th");
    th1.textContent = "Borrar";
    tr.appendChild(th1);
    var th2 = document.createElement("th");
    th2.textContent = "Editar";
    tr.appendChild(th2);
    tabla.appendChild(tr);
    for (var i = 0; i < ojson.usuarios.length; i++) {
        var tr = document.createElement("tr");
        for (prop in ojson.usuarios[i]) {
            var td = document.createElement("td");
            td.textContent = ojson.usuarios[i][prop];
            tr.appendChild(td);
        }
        //Enlace borrar
        var td1 = document.createElement("td");
        var enlace1 = document.createElement("a");
        enlace1.setAttribute("class", "borrar");
        enlace1.setAttribute("href", "#");
        enlace1.setAttribute("data-id", ojson.usuarios[i]["login"]);
        enlace1.appendChild(document.createTextNode('Borrar'));
        td1.appendChild(enlace1);
        tr.appendChild(td1);
        //Enlace editar
        var td2 = document.createElement("td");
        var enlace2 = document.createElement("a");
        enlace2.setAttribute("class", "editar");
        enlace2.setAttribute("href", "#");
        enlace2.setAttribute("data-id", ojson.usuarios[i]["login"]);
        enlace2.appendChild(document.createTextNode('Editar'));
        td2.appendChild(enlace2);
        tr.appendChild(td2);
        tabla.appendChild(tr);
    }
    //Paginacion

    //console.log(ojson.paginas);
    var inicio = ojson.paginas[0];
    //console.log("inicio: "+inicio);
    var enlaceInicio = document.createElement("a");
    enlaceInicio.setAttribute("href", "#");
    enlaceInicio.setAttribute("class", "paginacion");
    enlaceInicio.setAttribute("data-pagina", inicio);
    enlaceInicio.appendChild(document.createTextNode("<<"));
    var anterior = ojson.paginas[2] >= 0 ? ojson.paginas[2] : "";
    //console.log("anterior: "+anterior);
    var enlaceAnterior = document.createElement("a");
    enlaceAnterior.setAttribute("href", "#");
    enlaceAnterior.setAttribute("class", "paginacion");
    enlaceAnterior.setAttribute("data-pagina", anterior);
    enlaceAnterior.appendChild(document.createTextNode("<"));
    var primero = ojson.paginas[1] >= 1 ? ojson.paginas[1] : "";
    //console.log(primero);
    var enlacePrimero = document.createElement("a");
    enlacePrimero.setAttribute("href", "#");
    enlacePrimero.setAttribute("class", "paginacion");
    enlacePrimero.setAttribute("data-pagina", primero);
    enlacePrimero.appendChild(document.createTextNode(primero));
    var segundo = ojson.paginas[2] >= 0 ? ojson.paginas[2] : "";
    //console.log(segundo);
    var enlaceSegundo = document.createElement("a");
    enlaceSegundo.setAttribute("href", "#");
    enlaceSegundo.setAttribute("class", "paginacion");
    enlaceSegundo.setAttribute("data-pagina", segundo);
    enlaceSegundo.appendChild(document.createTextNode(segundo));
    var actual = ojson.paginas[2] + 1;
    //console.log("actual: "+actual);   
    var enlaceActual = document.createElement("a");
    enlaceActual.setAttribute("href", "#");
    enlaceActual.setAttribute("class", "paginacion actual");
    enlaceActual.setAttribute("data-pagina", "");
    enlaceActual.appendChild(document.createTextNode(actual));
    var ultimo = ojson.paginas[ojson.paginas.length - 1];
    var cuarto = ojson.paginas[3] <= ultimo ? ojson.paginas[3] : "";
    //console.log(cuarto);
    var enlaceCuarto = document.createElement("a");
    enlaceCuarto.setAttribute("href", "#");
    enlaceCuarto.setAttribute("class", "paginacion");
    enlaceCuarto.setAttribute("data-pagina", cuarto);
    enlaceCuarto.appendChild(document.createTextNode(cuarto));
    var quinto = ojson.paginas[4] <= ultimo ? ojson.paginas[4] : "";
    //console.log(quinto);
    var enlaceQuinto = document.createElement("a");
    enlaceQuinto.setAttribute("href", "#");
    enlaceQuinto.setAttribute("class", "paginacion");
    enlaceQuinto.setAttribute("data-pagina", quinto);
    enlaceQuinto.appendChild(document.createTextNode(quinto));
    var siguiente = ojson.paginas[2] + 2 <= ultimo ? ojson.paginas[2] + 2 : "";
    //console.log(siguiente);    
    var enlaceSiguiente = document.createElement("a");
    enlaceSiguiente.setAttribute("href", "#");
    enlaceSiguiente.setAttribute("class", "paginacion");
    enlaceSiguiente.setAttribute("data-pagina", siguiente);
    enlaceSiguiente.appendChild(document.createTextNode(">"));
    //console.log(ultimo);
    var enlaceUltimo = document.createElement("a");
    enlaceUltimo.setAttribute("href", "#");
    enlaceUltimo.setAttribute("class", "paginacion");
    enlaceUltimo.setAttribute("data-pagina", ultimo);
    enlaceUltimo.appendChild(document.createTextNode(">>"));

    var tr = document.createElement("tr");
    var td = document.createElement("td");
    td.setAttribute("colspan", "12");
    td.setAttribute("id", "paginacion");

    //td.textContent = "paginacion";
    td.appendChild(enlaceInicio);
    td.appendChild(document.createTextNode(" "));
    td.appendChild(enlaceAnterior);
    td.appendChild(document.createTextNode(" "));
    td.appendChild(enlacePrimero);
    td.appendChild(document.createTextNode(" "));
    td.appendChild(enlaceSegundo);

    td.appendChild(document.createTextNode(" "));
    td.appendChild(enlaceActual);

    td.appendChild(document.createTextNode(" "));
    td.appendChild(enlaceCuarto);
    td.appendChild(document.createTextNode(" "));
    td.appendChild(enlaceQuinto);
    td.appendChild(document.createTextNode(" "));
    td.appendChild(enlaceSiguiente);
    td.appendChild(document.createTextNode(" "));
    td.appendChild(enlaceUltimo);


    tr.appendChild(td);
    tabla.appendChild(tr);
    document.getElementById("mostrar").appendChild(tabla);

    var enlacesPaginacion = document.getElementsByClassName("paginacion");
    console.log(enlacesPaginacion);
    for (i = 0; i < enlacesPaginacion.length; i++) {
        enlacesPaginacion[i].addEventListener("click", function(e) {
            pag = e.target.getAttribute("data-pagina");
            if (pag != "" && pag != actual) {
                console.log("carga");
                cargarPagina(pag);
            }
        });
    }

    var enlacesBorrar = document.getElementsByClassName("borrar");
    for (i = 0; i < enlacesBorrar.length; i++) {
        enlacesBorrar[i].addEventListener("click", function(e) {
            id = e.target.getAttribute("data-id");
            console.log("borrar "+ id);
            borrarEntrada(id);
        });
    }
    
    var enlacesEditar = document.getElementsByClassName("editar");
    for (i = 0; i < enlacesEditar.length; i++) {
        enlacesEditar[i].addEventListener("click", function(e) {
            id = e.target.getAttribute("data-id");
            console.log("editar "+ id);
            editarEntrada(id);
        });
    }
};

var cargarPagina = function(pagina) {
    if (pagina == "" || pagina == undefined) {
        pagina = 0;
    }
    var ajax = new Ajax();
    ajax.setUrl("ajaxSelect.php?pagina=" + pagina);
    ajax.setRespuesta(verPagina);
    ajax.doPeticion();
};

window.addEventListener("load", cargarPagina());