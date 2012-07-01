<form id='form-calificar' action='<?php echo base_url();?>consumos/calificar/<?php echo $historial[0]->id; ?>/<?php echo $restaurante[0]->id; ?>/<?php echo $plato[0]->id; ?>' method='POST' class="form-horizontal">
<fieldset>
    <legend> CU: Calificar un consumo. </legend>
    <div class="control-group">

        Usted asisti&oacute; al restaurante: <b> <?php echo $restaurante[0]->nombre; ?> </b>, por favor, califique al 
        mismo de acuerdo a su opini&oacute;n general, tomando en cuenta calidad de atenci&oacute;n, ubicaci&oacute;n, calidez del personal, etc...
      <br /><br />

        <label class="control-label" for="slt_restaurante">Calificacion</label>
        <div class="controls">
            <select class="input-xlarge" name='slt_restaurante'> 
                <?php for ($i=0;$i<=10;$i++) {
                    echo "<option value='$i'>$i</option>";
                } ?>
            </select>
        </div>

        <br />  
        <br /> 

      Le recomendamos que coma el siguiente plato <b> <?php echo $plato[0]->nombre; ?> </b>, por favor, d&iacute;ganos
      como califica al mismo, si no lo consumi&oacute; seleccione la opci&oacute;n que refleja eso. 
      <br />
        <label class="control-label" for="slt_plato">Calificaci&oacute;n del plato</label>
        <div class="controls">
            <select class="input-xlarge" name='slt_plato'> 
                <option value="x"> Consumi otro plato </option>
                <?php for ($i=0;$i<=10;$i++) {
                    echo "<option value='$i'>$i</option>";
                } ?>
            </select>
        </div>
        <br /> 
        <br />  

      
      
        
      <div class="controls">

	<button type="submit" id='btn-submit' class="btn btn-primary">Guardar calificaci&oacute;n!</button>
	
      </div>
    
    
    </div>    
  </fieldset>
</form>