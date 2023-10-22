<div class="">
<div class="info">
  <div class="contenedor-anuncios">
    <?php foreach ($mascotas as $mascota): ?>
      <div class="anuncio">

        <img loading="lazy" src="/imagenes/<?php echo $mascota->imagen; ?>" alt="Foto Mascota">

        <div class="contenido-anuncio">
          <h3>
            <?php echo $mascota->nombre; ?>
          </h3>

          <div class="iconos-caracteristicas">
            <li>
              <img class="icono" loading="lazy" src="build/img/IconoRaza.png" alt="icono_raza">
              <p>
                <?php echo $mascota->raza; ?>
              </p>
            </li>
            <li>
              <img class="icono" loading="lazy" src="build/img/genero.png" alt="icono_genero">
              <p>
                <?php echo $mascota->genero; ?>
              </p>
            </li>
          </div>
          <a href="/mascota?id=<?php echo $mascota->id; ?>" class="boton-morado-block">Adoptar</a>
        </div>
        <!--contenido-anuncio-->
      </div>
    <?php endforeach; ?>
  </div>
  <!--contenedor-anuncios-->
</div>