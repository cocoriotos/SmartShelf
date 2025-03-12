<!--  Developed by julián González Bucheli -->
<!--<html lang="us"> <!-- Page language-->
	<!--<head>
	<script src="Popper/popper.min.js"></script>
	<script src="plugins/sweetalert/sweetalert.min.js"></script>
	<script src="plugins/alertifyjs/alertify.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<!-- CSS 
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>-->
		  <!--<script>
			/*alert("Enlace Salvado Exitosamente");
			alertify.success('Success message');

			alertify.set('notifier','position', 'top-center');
			alertify.success('Current position : ' + alertify.get('notifier','position'));

			alertify.set('notifier','position', 'Adicnonado Exitosamente');
			alertify.success('Registro : ' + alertify.get('notifier','position'));*/
            $("#btnlinkadded").click(function(){
			alertify.notify('Elance Adicionado Satisfactoriamente', 'success' , 5, function(){ console.log('por consola');});
			
			/*alertify.set('notifier','position', 'top-center');
			alertify.success('Elance Adicionado Satisfactoriamente');*/
			})
		  </script>
	</head>
</html>-->



<!DOCTYPE html>
<html lang="us">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar Enlace</title>

  <!-- Cargar jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Scripts de alertify.js -->
  <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

  <script>
    // Usamos jQuery para asegurarnos de que el documento esté listo
    $(document).ready(function() {
      // Mostrar el mensaje de éxito en la parte superior central inmediatamente
      alertify.notify('Enlace Adicionado Exitosamente', 'success', 5);
    });
  </script>

  <!-- Estilos de alertify.js -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
</head>
<body>
  <!-- El contenido del cuerpo está vacío, el mensaje se mostrará automáticamente -->
</body>
</html>


