<h2> Lista de consumos pendientes de calificar </h2>

<br />

<table class="table table-striped">
  <thead>
    <tr>
      <th> Restaurante </th>
      <th> Plato consumido </th>
      <th> Accion </th>

    </tr>
  </thead>

  <tbody>

<?php 

foreach ($consumos as $c): ?>

    <tr id='<?php echo $c-> idHistorial; ?>'>
      <td> <?php echo $c->nombreRestaurante; ?> </td>
      <td> <?php echo $c->nombrePlato; ?> </td>
      <td> 
    <a href='<?php echo base_url();?>consumos/feedback/<?php echo $c-> idHistorial; ?>' class="btn btn-success">
      <i class="icon-ok icon-white"></i> Calificar Consumo
    </a>
          &nbsp; &nbsp; &nbsp; &nbsp;   
    <a href='<?php echo base_url();?>consumos/cancel/<?php echo $c-> idHistorial; ?>' class="btn btn-inverse">
      <i class="icon-remove icon-white"></i> No fu&iacute;, desist&iacute;
    </a></td>
    </tr>

<?php endforeach; ?>

  </tbody>
</table>