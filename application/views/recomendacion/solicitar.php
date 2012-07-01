<form id='form-solicitar' action='<?php echo base_url();?>buscador/search' method='POST' class="form-horizontal">
  <fieldset>
    <legend> CU: solicitar al sistema una recomendacion. </legend>
    <div class="control-group">

      Se determina la ubicacion del comensal... <br />
      <label class="control-label" for="txt_ux"> Ubicacion X </label>
      <div class="controls">
        <input type="text" name='txt_ux' class="input-xlarge" id="txt_ux"> 
      </div>
      <br />
      
      <label class="control-label" for="txt_uy"> Ubicacion Y </label>
      <div class="controls">
        <input type="text" name='txt_uy' class="input-xlarge" id="txt_uy"> 
      </div>
      <br />

      <div class="controls">
	<button type="button" id="btn-getcoordenadas" class="btn btn-primary">Actualizar ubicaci&oacute;n del comensal</button>
      </div>
      <br />

      <br />

      Se selecciona si desea comer alguna familia de cocina en particular.
      <br />

        <label class="control-label" for="slt_familia">Familia de cocina</label>
        <div class="controls">
            <select class="input-xlarge" name='slt_familia'> 
                    <option value='0'> Cualquiera </option>
                <?php foreach ($familias as $fam): ?>
                    <option value='<?php echo $fam->id; ?>'> <?php echo $fam->nombre; ?> </option>
                <?php endforeach; ?>	
            </select>
        </div>

        <br />  
        <br /> 


      
      Se selecciona si tiene alguna restricci&oacute;n alimentaria que prohiba ciertos ingredientes.
      <br />

        <label class="control-label" for="slt_restriccion">Restricci&oacute;n</label>
        <div class="controls">
            <select class="input-xlarge" name='slt_restriccion'> 
                <option value='0'> Ninguna </option>
                <?php foreach ($restricciones as $res): ?>
                    <option value='<?php echo $res->id; ?>'> <?php echo $res->nombre; ?> </option>
                <?php endforeach; ?>	
            </select>
        </div>
        <br /> 
        <br />  

      
      
      Selecciona un rango maximo de busqueda de restaurantes.
      <br />

        <label class="control-label" for="slt_radio">Radio</label>
        <div class="controls">
            <select class="input-xlarge" name='slt_radio'> 
                <option value='1' selected='SELECTED'> 1 Km </option>
                <option value='5' > 5 Kms </option>
                <option value='10'> 10 Kms </option>
                <option value='20'> 20 Kms </option>
                <option value='50'> 50 Kms </option>
            </select>
        </div>
        <br />
        
      
      <br />
      <div class="controls">

	<button type="button" id='btn-submit' class="btn btn-primary">Solicitar Recomendaci&oacute;n!</button>
	
      </div>
    
    </div>    
  </fieldset>
</form>