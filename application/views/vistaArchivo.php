	<!-- section: team -->
	<section id="cargar" class="section green" >
		<div class="container" >
			<h4>Cargar archivo</h4>
			<div class="row">
				<div class="col-md-2">
                 </div>
                 <div class="col-md-8">
                 	<section id="cargar_blank" class="section" >
                 	<div class="container" style="padding-left:25%; padding-right: 25%; " >
                 	<div class="col-md-4">
                    </div>	
                     <div class="col-md-4">
                          
                 		<?= form_open_multipart("cargarArchivo/cargarDatos")?>
                 			<label for="identidad">
                 				Seleccionar Entidad
                 			</label>
                 		
                 			<select name="identidad" class="form-control">
                                    <!--  <?php
                                    
                                        foreach($entidades as $row)
                                        { 
                                           echo '<option value="'.$row->id.'">'.$row->Nombre_EntidadPago.'</option>';
                                        }
                                       ?> -->
                            </select>	
                            <label for="Subir_A">
                 			 Subir Archivo
                 			</label>
							 <?= form_upload([
								'name'  => 'archivo',
								'id'    => 'archivo'
							])?>
							<?= form_submit('sub','Cargar')?>  
							<?= form_close()?>
                 	</div>	
                     <div class="col-md-4">
                    </div>
                       </div>
                   </div>
                    </section>	 
			        <div class="col-md-2">
                   </div>
                 	
	   </div>
		</div>
		<!-- /.container -->	
	</section>
	<!-- end section: team -->
	<!-- section: services -->

