function buscarMascota(){var o=document.getElementById("botonBuscar"),n=new FormData(o);fetch("/",{method:"POST",body:n}).then((function(o){if(o.ok)return console.log(o.json()),o.json();throw new Error("Error en la solicitud.")})).then((function(o){!0===o||console.log("La respuesta fue false.")})).catch((function(o){console.log(o)}))}document.addEventListener("DOMContentLoaded",(function(){darkMode(),tipoMascota()}));