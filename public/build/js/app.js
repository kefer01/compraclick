function darkMode(){const e=window.matchMedia("(prefers-color-scheme: dark)");e.matches?document.body.classList.add("dark-mode"):document.body.classList.remove("dark-mode"),e.addEventListener("change",(function(){e.matches?document.body.classList.add("dark-mode"):document.body.classList.remove("dark-mode")}));document.querySelector(".dark-mode-boton").addEventListener("click",(function(){document.body.classList.toggle("dark-mode")}))}function tipoMascota(){const e=document.querySelector("#animal");e.addEventListener("change",(function(){const o=document.getElementById("raza");o.innerHTML="";const n=document.createElement("option");n.text="-- Selecciona --",o.appendChild(n);const t=e.value;fetch("/usuario/mascota/raza?numero="+t).then(e=>e.json()).then(e=>{e.length>0&&e.forEach(e=>{const n=document.createElement("option");n.value=e.id,n.text=e.raza,o.appendChild(n)})}).catch(e=>console.error(e))}))}function subirPublicacion(){var e=document.getElementById("formularioPublicacion"),o=new FormData(e);fetch("publicar",{method:"POST",body:o}).then((function(e){if(e.ok)return e.json();throw new Error("Error en la solicitud.")})).then((function(e){if(!0===e){Swal.mixin({customClass:{confirmButton:"btn btn-success"},buttonsStyling:!1}).fire({title:"¡Exito!",text:"¡Tu publicación fue creada con exito!",icon:"success",confirmButtonText:"Aceptar",reverseButtons:!0}).then(e=>{e.isConfirmed&&(window.location.href="index")})}else Swal.fire("¡Error!","¡Error en la solicitud.!","warning"),console.log("La respuesta fue false.")})).catch((function(e){console.log(e)}))}function fotosPublicaciones(){if(console.log(window.location.href),window.location.href.endsWith("index")){console.log("estamos en la pagina");for(var e=document.getElementsByClassName("idPublicacion"),o=0;o<e.length;o++){var n=e[o].getAttribute("data-id");console.log("idPublicacion seleccionado:",n)}}}document.addEventListener("DOMContentLoaded",(function(){darkMode(),tipoMascota(),fotosPublicaciones()}));