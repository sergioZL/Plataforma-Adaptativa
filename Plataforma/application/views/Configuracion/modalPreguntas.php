<div id="formulario" class="container">
    
    <form id="formularito" action="<?php echo site_url('ConfiguracionController/agregarPreguntas')?>" enctype="multipart/form-data" method="post" role="form">
        <div class="modal-body mx-3">                 
            <div class="md-form mb-5 from-group">
                <label data-error="wrong" data-success="right" for="enunciado">Enunciado</label>
                <textarea rows = "6" class="form-control text-left"  name = "enunciado" placeholder="Ingrese el enunciado de la pregunta">
                
                </textarea>                
                <label data-error="wrong" data-success="right" for="userImage">Imagen</label>
                <input type="file" class="form-control" id="userImage" name="userImage"> 

            </div>
            <div id="contenedorPorcentage">
                 
            </div>
            <div class="escondido">
                <input type="text" class="form-control" id="id_tema" name="id_tema" value="<?php echo $id_tema; ?>"> 
                <input type="text" class="form-control" id="id_pregunta" name="id_pregunta" value="<?php echo $id_pregunta;?>"> 
            </div>
        </div>
        <div class="modal-footer">
            <div style="margin-bottom: 10px; color:white;">
                <input id="inputAgregar" type="submit" class="btn btn-primary" value="Agregar Pregunta">
            </div>
        </div>
    </form>      
</div>
<script>
    var id_pregunta = '<?php echo $id_pregunta; ?>';
    $(function(){
        if(id_pregunta != ''){
            $('#inputAgregar').val('Agregar Opcion');
            $('#contenedorPorcentage').html('<label data-error="wrong" data-success="right" for="porcentaje">Porcentaje</label>'
                +'<select class="custom-select" id="porcentaje" name="porcentaje">'
                +'<option value="0">0%</option>'
                +'<option value="25">25%</option>'
                +'<option value="50">50%</option>'
                +'<option value="100">100%</option>'
                +'</select>');
            $('#formularito').attr('action', "<?php echo site_url('ConfiguracionController/agregarOpciones')?>");
        }
    });
</script>
