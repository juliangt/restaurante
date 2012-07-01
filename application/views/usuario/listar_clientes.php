<h2> Lista de clientes. </h2>

<table class="table table-striped">
  <thead>
    <tr>
      <th>id</th>
      <th>Razon social</th>
      <th>Nombre de usuario</th>
      <th>Porcentaje</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>
  </thead>

  <tbody>

<?php foreach ($usuarios as $usuario): ?>

    <tr>
      <td> <?php echo $usuario->id_cliente; ?> </td>
      <td> <?php echo $usuario->razonsocial; ?> </td>
      <td> <b><?php echo $usuario->username; ?></b> </td>
      <td> (<?php echo $usuario->valor; ?> %) <?php echo $usuario->nombre; ?>  </td>
      <td> <?php echo $usuario->enabled ? 'HABILITADO' : 'DESHABILITADO'; ?> </td>
      <td>
      	<button type="button" onClick='_a("edit",<?php echo $usuario->id_cliente; ?>)' class="btn btn-warning btn-mini"><i class="icon-pencil icon-white"></i></button>
		<button type="button" onClick='_a("enable",<?php echo $usuario->id_cliente; ?>)' class="btn btn-success btn-mini"><i class="icon-ok icon-white"></i></button>
      	<button type="button" onClick='_a("disable",<?php echo $usuario->id_cliente; ?>)' class="btn btn-danger btn-mini"><i class="icon-remove icon-white"></i></button>
	</td>
      
    </tr>

<?php endforeach; ?>
    
  </tbody>
</table>

<div class='span6'>
	Descripcion de acciones: <br /> 
	<button type="button" class="btn btn-warning btn-mini"><i class="icon-pencil icon-white"></i></button> - Editar usuario <br />
	<button type="button" class="btn btn-success btn-mini"><i class="icon-ok icon-white"></i></button> - Habilitar usuario <br />
	<button type="button" class="btn btn-danger btn-mini"><i class="icon-remove icon-white"></i></button> - Deshabilitar usuario <br />
</div>

<script type="text/javascript">
function _a(a,id) {
	switch (a) {
		case 'enable' : 
			url = '<?php echo base_url();?>usuario/enable/'+id+'?sh=no';
			break;
		case 'disable' :
			url = '<?php echo base_url();?>usuario/disable/'+id+'?sh=no';
			break;
		case 'edit' : 
			url = '<?php echo base_url();?>usuario/modify/'+id;
			window.location = url;
			return;
		break;
		
	}
	data = Math.floor(Math.random()*99+1)
	$.ajax({
	  url: url,
	  dataType: 'json',
	  data: data,
	  success: function(r){
		window.location.reload();
	  }
	});
}
</script>