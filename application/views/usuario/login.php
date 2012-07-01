<form action="<?php echo base_url();?>usuario/login_check" method="POST" class="form-horizontal">
  <fieldset>
    <legend>Login de usuario</legend>
    <div class="control-group">
    
      <label class="control-label" for="txt_mail">Mail</label>
      <div class="controls">
        <input type="text" name="txt_mail" class="input-xlarge" id="txt_username">
      </div>

    <br /> <br />
      
      <div class="controls">

	<button type="submit" class="btn btn-primary">Iniciar sesion</button>

      </div>
    
    </div>    
  </fieldset>
</form>
