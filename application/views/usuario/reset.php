<form action='<?php echo base_url();?>usuario/reset' method='POST' class="form-horizontal">
  <fieldset>
    <legend>Reset de password de usuario</legend>
    <div class="control-group">
    
      <label class="control-label" for="txt_username">Nombre de usuario</label>
      <div class="controls">
        <input type="text" name='txt_username' class="input-xlarge" id="txt_username">
      </div>
 
    <br />
      
      <label class="control-label" for="txt_password">Password nuevo</label>
      <div class="controls">
        <input type="password" name='txt_password' class="input-xlarge" id="txt_password">
      </div>
    
    <br /> <br />
      
      <div class="controls">
		<button type="submit" class="btn btn-primary">Guardar nuevo password</button>
      </div>
    
    </div>    
  </fieldset>
</form>