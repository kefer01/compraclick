<div class="containerback-tienda">
  <div class="inicio">
    <h1>¡Explora nuestra tienda y encuentra todo lo que necesitas para consentir a tu producto!</h1>
    <!--<a href="/login" class="boton-amarillo-block">Ir a la tienda</a>-->
  </div>
</div>
<div class="contenedor-anuncios">
<?php foreach ($producto as $productos): ?>
      <div class="anuncio">
        <div class="contenedor">
          <h3>
            <?php echo $productos->tipo; ?>
          </h3>
          <p>
            <?php echo $productos->nombre; ?>
          </p>
          <p> Marca: 
            <?php echo $productos->marca; ?>
          </p>
          <p>
            <?php echo $productos->descripcion; ?>
          </p>          
        </div>
        <img width = '200' height = '400' loading="lazy" src="/imagenes/<?php echo $productos->imagen; ?>" alt="Foto producto">
        <a href="https://wa.me/50253407155?text= Hola, me interesa este producto <?php echo $productos->tipo.' '.$productos->nombre.' '.$productos->marca; ?>" class="boton-verde">Comprar</a>
        <!--contenido-anuncio-->
      </div>
    <?php endforeach; ?>
</div>
<div class="info">
  <div class="contenedor-anuncios">
    
  </div>
  <!--contenedor-anuncios-->
</div>