<div class="hero-unit">
  <h2>Recomendaci&oacute;n:</h2>
  <p> Se muestra el potencial candidato.</p>
  <p>
      Restaurante: <b> <?php echo $restaurante[0]-> nombre; ?> </b>
      <?php // print_r($restaurante); ?>

      <br />
      Plato de comida: <b> <?php echo $plato[0]-> nombre; ?> </b>
      <?php //print_r($plato); ?>
      <br /><br />

     <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
         src="https://maps.google.com.ar/?ie=UTF8&amp;ll=<?php echo $restaurante[0]-> CoordenadaX; ?>,<?php echo $restaurante[0]-> CoordenadaY; ?>&amp;q=<?php echo $restaurante[0]-> domicilio; ?>, <?php echo $restaurante[0]-> localidad; ?>, <?php echo $restaurante[0]-> provincia; ?>&amp;t=m&amp;z=16&amp;output=embed"></iframe>

      <br /><br />
      
    <a href="<?php echo base_url();?>recomendacion/aceptar/<?php echo $restaurante[0] ->idRecomendacion; ?>/<?php echo $restaurante[0] ->idParRestaurante; ?>/<?php echo $plato[0] ->idParPlatoRestaurante; ?>/<?php echo $restaurante[0] ->id; ?>/<?php echo $plato[0] ->id; ?>" class="btn btn-success btn-large">
      Aceptar recomendaci&oacute;n
    </a>
      
    &nbsp; &nbsp; &nbsp;
    
    <a href="<?php echo base_url();?>recomendacion/denegar/<?php echo $restaurante[0] ->idRecomendacion; ?>/<?php echo $restaurante[0] ->idParRestaurante; ?>/<?php echo $plato[0] ->idParPlatoRestaurante; ?>/<?php echo $restaurante[0] ->id; ?>/<?php echo $plato[0] ->id; ?>" class="btn btn-warning btn-large">
      Denegar recomendaci&oacute;n del restaurante
    </a>
      
       <br /><br />
    
    <a href="<?php echo base_url();?>recomendacion/denegar_plato/<?php echo $restaurante[0] ->idRecomendacion; ?>/<?php echo $restaurante[0] ->idParRestaurante; ?>/<?php echo $plato[0] ->idParPlatoRestaurante; ?>/<?php echo $restaurante[0] ->id; ?>/<?php echo $plato[0] ->id; ?>" class="btn btn-warning btn-large">
      Denegar recomendacion del plato
    </a>
 
 
  </p>
</div>