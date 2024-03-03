function seleccionEvento(){
    if(document.getElementById("tipo_evento").value=="concierto"){
        document.getElementById("grupo").style.visibility = "visible";
        document.getElementById("festival").style.visibility = "visible";
    } 
}


document.getElementById("tipo_evento").addEventListener("change", seleccionEvento);
document.getElementById("enviar").addEventListener("click",function(event){event.preventDefault(),location.reload()})

function marcar(){
    if(document.getElementById("varios_dias").checked&&document.getElementById("tipo_evento").value!="concierto"&&document.getElementById("tipo_evento").value!=""){
        document.getElementById("fecha_fin").style.visibility = "visible";
    }
}