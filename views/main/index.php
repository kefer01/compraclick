<div class="containerback">
  <div class="inicio">
    <h1> Encuentra de todo en tecnologia, sabes que te lo mereces...</h1>
    <a href="/login" class="boton-amarillo-block">Quiero comprar</a>
  </div>
</div>

<div class="info">
  <div class="contenedor-anuncios">
    <?php foreach ($productos as $producto): ?>
      <div class="anuncio tabla-usuario">

        <img loading="lazy" src="/imagenes/<?php echo $producto->imagen; ?>" alt="Foto Mascota">

        <div class="contenido-anuncio">
          <h3>
            <?php echo $producto->nombre; ?>
          </h3>
          <p>
            <?php echo $producto->marca; ?>
          </p>
          <p>
            <?php echo $producto->descripcion; ?>
          </p>

          <div class="iconos-caracteristicas">
            <li>
              <img class="icono" loading="lazy" src="build/img/icono-marca.svg" alt="icono_marca">
              <p>
                <?php echo $producto->marca; ?>
              </p>
            </li>
            <li>
              <img class="icono" loading="lazy" src="build/img/producto.svg" alt="icono_producto">
              <p>
                <?php echo $producto->descripcion; ?>
              </p>
            </li>
            <li>
              <img class="icono" loading="lazy" src="build/img/icono-precio.svg" alt="icono_precio">
              <p>
                 Q. <?php echo $producto->precio; ?>
              </p>
            </li>
          </div>
          <a href="/mascota?id=<?php echo $producto->id_producto; ?>" class="boton-morado-block">Lo Quiero</a>
        </div>
        <!--contenido-anuncio-->
      </div>
    <?php endforeach; ?>
  </div>
  <!--contenedor-anuncios-->
</div>