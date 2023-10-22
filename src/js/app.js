document.addEventListener('DOMContentLoaded', function () {

    darkMode();
    tipoMascota();
    fotosPublicaciones();

});

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode.matches);
    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function () {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    });
}

function tipoMascota() {
    const animal = document.querySelector('#animal');
    animal.addEventListener('change', function () {
        // Obtener referencia al elemento select
        const select = document.getElementById('raza');
        select.innerHTML = '';
        const seleccione = document.createElement('option');
        seleccione.text = '-- Selecciona --';
        select.appendChild(seleccione);
        const num = animal.value;

        fetch(`/usuario/mascota/raza?numero=${num}`)
            .then(response => response.json())
            .then(jsonData => {
                // Hacer algo con los datos en formato JSON
                if (jsonData.length > 0) {
                    // Iterar sobre los datos y crear opciones de select
                    jsonData.forEach(dato => {
                        const option = document.createElement('option');
                        option.value = dato.id; // Asignar el valor del dato a la opción
                        option.text = dato.raza; // Asignar el texto del dato a la opción
                        select.appendChild(option); // Agregar la opción al select
                    });
                }
            })
            .catch(error => console.error(error));
    })
}

function subirPublicacion() {
    var formulario = document.getElementById('formularioPublicacion');
    var formData = new FormData(formulario);

    fetch('publicar', {
        method: 'POST',
        body: formData
    })
        .then(function (response) {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Error en la solicitud.');
            }
        })
        .then(function (data) {
            // Procesar la respuesta del servidor JSON aquí
            if (data === true) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: '¡Exito!',
                    text: '¡Tu publicación fue creada con exito!',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index';
                    }
                })
            } else {
                Swal.fire(
                    '¡Error!',
                    '¡Error en la solicitud.!',
                    'warning'
                )
                console.log('La respuesta fue false.');
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}

function fotosPublicaciones() {
    var paginaEspecifica = "index";
    console.log(window.location.href);
    if (window.location.href.endsWith(paginaEspecifica)) {
        console.log('estamos en la pagina');
        // Obtener todos los elementos con la clase "idPublicacion"
        var idPublicaciones = document.getElementsByClassName("idPublicacion");

        // Recorrer los elementos y obtener el identificador de cada idPublicacion
        for (var i = 0; i < idPublicaciones.length; i++) {
            var idPublicacion = idPublicaciones[i];
            var id = idPublicacion.getAttribute("data-id");

            // Hacer algo con el idPublicacion seleccionado (por ejemplo, mostrar el identificador)
            console.log("idPublicacion seleccionado:", id);
        }
    }
}