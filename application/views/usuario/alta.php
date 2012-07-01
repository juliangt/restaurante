<form action='<?php echo base_url();?>usuario/save' method='POST' class="form-horizontal">
  <fieldset>
    <legend>Alta de nuevo usuario</legend>
    <div class="control-group">
    
      <label class="control-label" for="txt_razonsocial">Razon social</label>
      <div class="controls">
        <input type="text" name='txt_razonsocial' class="input-xlarge" id="txt_razonsocial"> 
        
      </div>
      
      <br />
      
      <label class="control-label" for="txt_cuit">NRO de CUIT</label>
      <div class="controls">
        <input type="text" name="txt_cuit" class="input-xlarge" id="txt_cuit">
        
      </div>

    <br />
      
      <label class="control-label" for="txt_mail">Dirección de mail</label>
      <div class="controls">
        <input type="text" name="txt_mail" class="input-xlarge" id="txt_mail"> 
    	</div>

    <br />
      
      <label class="control-label" for="txt_username">Nombre de usuario</label>
      <div class="controls">
        <input type="text" name="txt_username" class="input-xlarge" id="txt_username"> 
      </div>

    <br />
      <label class="control-label" for="txt_password">Password</label>
      <div class="controls">
        <input type="password" name="txt_password" class="input-xlarge" id="txt_password"> 
      </div>

    <br />
      
      <label class="control-label" for="slt_porcentaje">Grupo de porcentaje</label>
      <div class="controls">
        <select class="input-xlarge" name='slt_porcentaje'> 
		    <?php foreach ($porcentajes as $por): ?>
				<option value='<?php echo $por->id_porcentaje; ?>'> <?php echo $por->valor , '  &nbsp; &nbsp;   ( ' , $por->nombre ,  ' )'; ?> </option>
			<?php endforeach; ?>	
		</select>
      </div>
    <br /> <br />
      
	<div class="controls">

	<button type="submit" class="btn btn-primary">Enviar formulario</button>
	&nbsp; &nbsp; &nbsp; 
	<button type="reset" class="btn btn-warning"><i class="icon-fire"></i> Resetear formulario </button>
	
	</div>
    
    
    </div>    
  </fieldset>
</form>
