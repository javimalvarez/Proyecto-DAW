function seleccionEvento(){
    var reference=document.getElementById("evento");
    if(document.getElementById("tipo_evento").value=="festival"){
        document.getElementById("formulario_eventos").insertBefore(document.getElementById("festival"), reference.nextSibling);
        document.getElementById("festival").style.visibility = "visible";
        document.getElementById("concierto").style.visibility = "visible";
    }
    else if(document.getElementById("tipo_evento").value=="concierto"){
        document.getElementById("formulario_eventos").insertBefore(document.getElementById("concierto"), reference.nextSibling);
        document.getElementById("concierto").style.visibility = "visible";
    } 
    else{
        document.getElementById("formulario_eventos").insertBefore(document.getElementById("otro"), reference.nextSibling);
        document.getElementById("otro").style.visibility = "visible";
    }
}
document.getElementById("tipo_evento").addEventListener("change", seleccionEvento);