function seleccionEvento(){
    if(document.getElementById("tipo_evento").value==="1"){
        document.getElementById("grupo").style.visibility = "visible";
        document.getElementById("festival").style.visibility = "visible";
        document.getElementById("varios_dias").setAttribute("disabled", "true");
        document.getElementById("fecha_fin").style.visibility = "hidden";
        document.getElementById("varios_dias").checked = false;      
    }else{
        document.getElementById("grupo").style.visibility = "hidden";
        document.getElementById("festival").style.visibility = "hidden";
        document.getElementById("varios_dias").removeAttribute("disabled");
    }
}




function marcar(){
    if(document.getElementById("varios_dias").checked){
        document.getElementById("fecha_fin").style.visibility = "visible";
    }else{
        document.getElementById("fecha_fin").style.visibility = "hidden";
    }
}

function desactivarPrecio(){
    if(document.getElementById("tipo_evento").value==="1"&&document.getElementById("festival").value!==""){
        document.getElementById("precio").setAttribute("disabled", "true");
    }else{
        document.getElementById("precio").removeAttribute("disabled");
    }
}
seleccionEvento();
document.getElementById("tipo_evento").addEventListener("change", seleccionEvento);
document.getElementById("enviar").addEventListener("click",function(event){event.preventDefault(),location.reload()});
document.getElementById("varios_dias").addEventListener("change", marcar);


