<h2> Comensales </h2>

<br />

<table class="table table-striped">
  <thead>
    <tr>
      <th> ID  </th>
      <th> mail </th>
      <th> Ubicacion Latitud </th>
      <th> Ubicacion Longitud </th>

    </tr>
  </thead>

  <tbody>

<?php foreach ($comensales as $c): ?>

      <tr id='<?php echo $c['id']; ?>'>
      <td> <?php echo $c['id']; ?> </td>
      <td> <?php echo $c['mail'];?> </td>
      <td> <?php echo $c['x']; ?> </td>
      <td> <?php echo $c['y']; ?> </td>
    </tr>

<?php endforeach; ?>

  </tbody>
</table>
