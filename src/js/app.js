document.addEventListener('DOMContentLoaded', function () {

    darkMode();
    // tipoMascota();
    fotosPublicaciones();
    // seleccionarProducto(idProducto);
    carrito();

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

function seleccionarProducto(idProducto) {
    // localStorage.clear();
    if (localStorage.getItem("listado") == null) {
        console.log('No hay nada en el localStorage');
        lista = [];
        cantTemp = 0;
    } else {
        console.log('si hay algo en el localStorage y es lo siguiente: ');
        lista = JSON.parse(localStorage.getItem("listado"));
        indice = lista.findIndex(item => item.id === idProducto.toString())
        if (indice !== -1) {
            cantTemp = lista[indice].cantidad;
            console.log("el indice encontrado en el localStorage: " + indice);
        } else {
            // El producto no existe en el carrito 
            cantTemp = 0;
            console.log("No existe el producto en el localstorage");
        }
        console.log(lista);

    }


    fetch(`/api/producto?id=${idProducto}`)
        .then(response => response.json())
        .then(jsonData => {
            if (jsonData.Error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Usuario no logueado...',
                    text: 'Por favor para poder comprar inicia sesión o crea una cuenta.',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/login';
                    }
                });
            } else {
                // Hacer algo con los datos en formato JSON
                if (jsonData.length > 0) {
                    const producto = jsonData[0];
                    const cant = parseInt(producto.stock) - cantTemp
                    // Validar si ya hay esta el producto en el carrito
                    if (parseInt(cant) === 0 && parseInt(producto.stock) > 1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Producto en carrito',
                            text: 'Ya tienes todo el stock del producto en el carrito, pero aun no es tuyo. Ve al carrito a finalizar tu compra antes de que alguien mas te lo gane.',
                            showCancelButton: true,
                            confirmButtonText: 'Aceptar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/carrito';
                            }
                        });
                    } else if (cantTemp >= 1) {
                        Swal.fire({
                            icon: 'warning',
                            title: '¡Producto en el carrito!',
                            text: '¿Ya tienes este producto en el carrito deseas agregar mas unidades?',
                            showCancelButton: true,
                            confirmButtonText: 'Si',
                            cancelButtonText: 'No, me equivoque de producto'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: producto.nombre,
                                    icon: 'info',
                                    input: 'number',
                                    inputLabel: `Ya tienes ${cantTemp} unidades. ¿Cuantas unidades quieres agregar?`,
                                    inputAttributes: {
                                        min: 1,
                                        max: cant,
                                        step: 1
                                    },
                                    inputValue: 1,
                                    confirmButtonText: 'Agregar al carrito',
                                    inputValidator: (value) => {
                                        if (parseInt(value) > cant) {
                                            return 'Alerta: la cantidad es superior al stock del producto!'
                                        } else if (parseInt(value) < 1) {
                                            return 'Alerta: la cantidad es menor al stock del producto!'
                                        }
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // validar que el producto no exista en el carrito
                                        productoExiste = lista.findIndex(item => item.id === producto.id)
                                        if (productoExiste !== -1) {
                                            lista[productoExiste].cantidad = parseInt(lista[productoExiste].cantidad) + parseInt(result.value);
                                        } else {
                                            // El producto no existe en el carrito 
                                            lista.push({ id: producto.id, nombre: producto.nombre, cantidad: result.value, precio: producto.precio });
                                        }
                                        localStorage.setItem('listado', JSON.stringify(lista));
                                        Swal.fire('Se han agregado ' + result.value + ' productos al carrito de compras');
                                    }
                                });
                            }
                        });
                    } else {
                        Swal.fire({
                            title: producto.nombre,
                            icon: 'info',
                            input: 'number',
                            inputLabel: '¿Cuantas unidades quieres?',
                            inputAttributes: {
                                min: 1,
                                max: cant,
                                step: 1
                            },
                            inputValue: 1,
                            confirmButtonText: 'Agregar al carrito',
                            inputValidator: (value) => {
                                if (parseInt(value) > cant) {
                                    return 'Alerta: la cantidad es superior al stock del producto!'
                                } else if (parseInt(value) < 1) {
                                    return 'Alerta: la cantidad es menor al stock del producto!'
                                }
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // validar que el producto no exista en el carrito
                                productoExiste = lista.findIndex(item => item.id === producto.id)
                                if (productoExiste !== -1) {
                                    console.log(lista[productoExiste].cantidad);
                                    lista[productoExiste].cantidad = result.value;
                                } else {
                                    // El producto no existe en el carrito 
                                    lista.push({ id: producto.id, nombre: producto.nombre, cantidad: result.value, precio: producto.precio });
                                }
                                localStorage.setItem('listado', JSON.stringify(lista));
                                Swal.fire('Se han agregado ' + result.value + ' productos al carrito de compras');
                            }
                        });
                    }
                }
            }
        })
        .catch(error => console.error(error));
}

function eliminarProducto(idProducto) {
    // localStorage.clear();
    if (localStorage.getItem("listado") == null) {
        console.log('No hay nada en el localStorage');
        lista = [];
        cantTemp = 0;
    } else {
        console.log('si hay algo en el localStorage y es lo siguiente: ');
        lista = JSON.parse(localStorage.getItem("listado"));
        indice = lista.findIndex(item => item.id === idProducto.toString())
        if (indice !== -1) {
            cantTemp = lista[indice].cantidad;
            console.log("el indice encontrado en el localStorage: " + indice);
        } else {
            // El producto no existe en el carrito 
            cantTemp = 0;
            console.log("No existe el producto en el localstorage");
        }
        console.log(lista);

    }
    productoExiste = lista.findIndex(item => item.id === idProducto.toString())
    if (productoExiste !== -1) {
        productosLista = lista.filter(producto => producto.id !== idProducto.toString());
        console.log(productosLista);
        localStorage.setItem('listado', JSON.stringify(productosLista));
        Swal.fire('Se han eliminado el articulo ' + productoExiste + ' del carrito de compras');
        setTimeout(() => {
            
        }, 2000);
        location.reload();
    } 
}

function carrito() {
    divCarrito = document.getElementById('productos-carrito')
    if (localStorage.getItem("listado") == null) {
        console.log('No hay nada en el localStorage');
        lista = [];
        cantTemp = 0;
    } else {
        console.log('si hay algo en el localStorage y es lo siguiente: ');
        lista = JSON.parse(localStorage.getItem("listado"));

        lista.forEach(producto => {
            const card = document.createElement("div");
            card.classList.add("card");

            const info = document.createElement("div");
            info.classList.add("info");

            const botones = document.createElement("div");
            botones.classList.add("botones-carrito");

            const nombre = document.createElement("h2");
            nombre.textContent = producto.nombre;

            const cantidad = document.createElement("p");
            cantidad.textContent = `Cantidad: ${producto.cantidad}`;

            const precio = document.createElement("p");
            precio.textContent = `Precio: $${producto.precio}`;

            const btnActualizar = document.createElement("button");
            btnActualizar.textContent = 'Actualizar';
            btnActualizar.addEventListener("click", () => {
                seleccionarProducto(producto.id);
            });

            const btnEliminar = document.createElement("button");
            btnEliminar.textContent = 'Eliminar';
            btnEliminar.addEventListener("click", () => {
                eliminarProducto(producto.id);
            });

            // Agrega los elementos al div info
            info.appendChild(nombre);
            info.appendChild(cantidad);
            info.appendChild(precio);
            // Agrega los botones al div botones
            botones.appendChild(btnActualizar);
            botones.appendChild(btnEliminar);
            // Agrega el div info al card
            card.appendChild(info);
            // Agrega el div botones al card
            card.appendChild(botones);


            // Agrega el card al contenedor divCarrito
            divCarrito.appendChild(card);
        });
        console.log(lista);

    }
}