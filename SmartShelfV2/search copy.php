<!---------------New search ---->

<!-- search.php -->
<script>
function openList(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the link that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

<meta charset="iso-8559-1">
<link rel="stylesheet" style="font-family: arial; background-color: white" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script> $(document).ready( function () {
      $('#autosearch').DataTable(

        {
      language: {
              processing: "Procesando...",
              search: "Buscar:",
              lengthMenu: "Mostrar _MENU_ registros",
              info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
              infoFiltered: "(filtrado de un total de _MAX_ registros)",
              loadingRecords: "Cargando...",
              zeroRecords: "No se encontraron resultados",
              emptyTable: "Ningún dato disponible en esta tabla",
              paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Último"
              },
        aria: {
          sortAscending: ": Activar para ordenar la columna de manera ascendente",
          sortDescending: ": Activar para ordenar la columna de manera descendente"
              }
      }
    }); 

     } );</script>

<!---------------End New search ---->

<!--<script>
function openList(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the link that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

<meta charset="iso-8559-1">
<link rel="stylesheet" style="font-family: arial; background-color: white" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script> $(document).ready( function () {
      $('#autosearch').DataTable(

        {
      language: {
              processing: "Procesando...",
              search: "Buscar:",
              lengthMenu: "Mostrar _MENU_ registros",
              info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
              infoFiltered: "(filtrado de un total de _MAX_ registros)",
              loadingRecords: "Cargando...",
              zeroRecords: "No se encontraron resultados",
              emptyTable: "Ningún dato disponible en esta tabla",
              paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Último"
              },
        aria: {
          sortAscending: ": Activar para ordenar la columna de manera ascendente",
          sortDescending: ": Activar para ordenar la columna de manera descendente"
              }
      }
    }); 

     } );</script>-->
