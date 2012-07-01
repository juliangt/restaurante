<h2> Restaurantes </h2>

<br />

<table class="table table-striped">
  <thead>
    <tr>
      <th> ID Restaurante </th>
      <th> Nombre </th>
      <th> Cumple reglas </th>

    </tr>
  </thead>

  <tbody>

<?php foreach ($restaurantes as $r): ?>

      <tr id='<?php echo $r['id']; ?>'>
      <td> <?php echo $r['id']; ?> </td>
      <td> <?php echo $r['nombre'];?> </td>
      <td> <?php echo $r['cumple']; ?> </td>
    </tr>

<?php endforeach; ?>

  </tbody>
</table>
