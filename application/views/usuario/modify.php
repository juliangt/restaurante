<form action='<?php echo base_url();?>usuario/save' method='POST' class="form-horizontal">
<input type="hidden" name="id_cliente" value="<?php echo $usuario->id_cliente;?>"/> 

  <fieldset>
    <legend>Modificaci&oacute; de nuevo usuario</legend>
    <div class="control-group">
    
      <label class="control-label" for="txt_razonsocial">Razon social</label>
      <div class="controls">
        <input type="text" value="<?php echo $usuario->razonsocial;?>" name='txt_razonsocial' class="input-xlarge" id="txt_razonsocial"> 
        
      </div>
      
      <br />
      
      <label class="control-label" for="txt_cuit">NRO de CUIT</label>
      <div class="controls">
        <input type="text" value="<?php echo $usuario->cuit;?>" name="txt_cuit" class="input-xlarge" id="txt_cuit">
        
      </div>

    <br />
      
      <label class="control-label" for="txt_mail">Dirección de mail</label>
      <div class="controls">
        <input type="text" value="<?php echo $usuario->mail;?>" name="txt_mail" class="input-xlarge" id="txt_mail"> 
    	</div>

    <br />
      
      <label class="control-label" for="txt_username">Nombre de usuario</label>
      <div class="controls">
        <input type="text" value="<?php echo $usuario->username;?>" name="txt_username" class="input-xlarge" id="txt_username"> 
      </div>

    <br />
      <label class="control-label" for="txt_password">Password</label>
      <div class="controls">
        <input type="password" value="<?php echo $usuario->password;?>"  name="txt_password" class="input-xlarge" id="txt_password"> 
      </div>

    <br />
      <label class="control-label" for="radio_habilitado">Habilitado</label>
      <div class="controls">
        <input type='radio' name='radio_enabled' class="input-xlarge" value='1' <?php if ($usuario->enabled == 1) echo 'checked'; ?> id='radio_habilitado' > <br />
      </div>
		
	
	<br />
	  <label class="control-label" for="radio_deshabilitado">Deshabilitado</label>
      <div class="controls">
		<input type='radio' name='radio_enabled' class="input-xlarge" value='0' <?php if ($usuario->enabled == 0) echo 'checked'; ?> id='radio_deshabilitado' > <br />
      </div>

    <br />
      
      <label class="control-label" for="slt_porcentaje">Grupo de porcentaje</label>
      <div class="controls">
        <select class="input-xlarge" name='slt_porcentaje'> 
		    <?php foreach ($porcentajes as $por): ?>
				<option <?php if ($usuario->id_porcentaje == $por->id_porcentaje) echo 'selected'; ?> value='<?php echo $por->id_porcentaje; ?>'> <?php echo $por->valor , '  &nbsp; &nbsp;   ( ' , $por->nombre ,  ' )'; ?> </option>
			<?php endforeach; ?>
		</select>
      </div>
    <br /> <br />
      
	<div class="controls">

	<button type="submit" class="btn btn-primary">Enviar formulario</button>
	
	</div>
    
    
    </div>    
  </fieldset>
</form>
