<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>SmartShelf — Admin Module</title>
<link rel="icon" href="SmartShelfUsefulContentLibraryDarrkLightGreen.ico"/>
<link rel="stylesheet" href="smartshelf.css"/>
<style>
.sidebar {
  background: var(--bg);
  padding: 20px;
  height: 100vh;
  position: fixed;
  left: 0;
  top: 80px; /* below nav */
  width: 250px;
  overflow-y: auto;
}
.sidebar-menu {
  list-style: none;
  padding: 0;
}
.sidebar-menu li {
  margin-bottom: 10px;
}
.sidebar-menu a {
  color: var(--t1);
  text-decoration: none;
  display: block;
  padding: 10px;
  border-radius: 5px;
  transition: background 0.3s;
}
.sidebar-menu a:hover {
  background: var(--acglow);
}
.main-content {
  margin-left: 250px;
  padding: 20px;
}
.section {
  margin-bottom: 40px;
}
</style>
<script src="head.js" defer></script>
<script src="Linktoclipboard.js" defer></script>
<script src="Popper/popper.min.js"></script>
<script src="plugins/sweetalert/sweetalert.min.js"></script>
<script src="plugins/alertifyjs/alertify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css" />
</head>
<body>

<!-- NAV -->
<nav>
  <a href="#" class="nav-logo">
    <img src="smartshelf-logo.png" alt="SmartShelf"/>
  </a>
  <ul class="nav-links">
    <li><a href="#cards" data-i18n="nav_cards">Cards</a></li>
    <li><a href="#search" data-i18n="nav_search">Search</a></li>
    <li><a href="#add" data-i18n="nav_add">Add Links</a></li>
    <li><a href="#subscribe" data-i18n="nav_subscribe">Subscribe</a></li>
    <li><a href="#tutorials" data-i18n="nav_tutorials">Tutorials</a></li>
    <li><a href="#manual" data-i18n="nav_manual">Manual</a></li>
    <li><a href="#clear" data-i18n="nav_clear">Clear Form</a></li>
    <li><a href="logout.php" data-i18n="nav_exit">Exit</a></li>
  </ul>
  <div class="nav-right">
    <div class="lang-sw">
      <button class="lb on" onclick="setLang('es')">ES</button>
      <button class="lb" onclick="setLang('en')">EN</button>
      <button class="lb" onclick="setLang('pt')">PT</button>
    </div>
  </div>
  <button class="ham" onclick="toggleMenu()" aria-label="Menú">
    <span></span><span></span><span></span>
  </button>
</nav>

<div class="mob-nav" id="mobNav">
  <a href="#cards" onclick="toggleMenu()" data-i18n="nav_cards">Cards</a>
  <a href="#search" onclick="toggleMenu()" data-i18n="nav_search">Search</a>
  <a href="#add" onclick="toggleMenu()" data-i18n="nav_add">Add Links</a>
  <a href="#subscribe" onclick="toggleMenu()" data-i18n="nav_subscribe">Subscribe</a>
  <a href="#tutorials" onclick="toggleMenu()" data-i18n="nav_tutorials">Tutorials</a>
  <a href="#manual" onclick="toggleMenu()" data-i18n="nav_manual">Manual</a>
  <a href="#clear" onclick="toggleMenu()" data-i18n="nav_clear">Clear Form</a>
  <a href="logout.php" onclick="toggleMenu()" data-i18n="nav_exit">Exit</a>
  <div class="mob-lang">
    <button class="lb on" onclick="setLang('es');toggleMenu()">ES</button>
    <button class="lb" onclick="setLang('en');toggleMenu()">EN</button>
    <button class="lb" onclick="setLang('pt');toggleMenu()">PT</button>
  </div>
</div>

<?php
include "sessions.php";
include "sessionvalidation.php";
$local_username = $_SESSION['email'];
$savedlink = $_SESSION['savedlink'];
$duplicatedlink = $_SESSION['duplicatedlink'];
$updatedlink = $_SESSION['updatedlink'];
$deletedlink = $_SESSION['deletedlink'];
$sessiontimeoutreached = $_SESSION['sessiontimeoutreached'];
$copytoclipboard = $_SESSION['copytoclipboard'];
$videoUrl = $_SESSION['videoUrl'];
$embedUrl = $_SESSION['embedUrl'];
$click = $_SESSION['click'];
$name = $_SESSION['name'];
$delconfirm = $_SESSION['delconfirm'];

include "db_connection1.php";
include "header.php";
?>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 sidebar">
      <ul class="sidebar-menu">
        <li><a href="#cards" data-i18n="nav_cards">Cards</a></li>
        <li><a href="#search" data-i18n="nav_search">Search</a></li>
        <li><a href="#add" data-i18n="nav_add">Add Links</a></li>
        <li><a href="#subscribe" data-i18n="nav_subscribe">Subscribe</a></li>
        <li><a href="#tutorials" data-i18n="nav_tutorials">Tutorials</a></li>
        <li><a href="#manual" data-i18n="nav_manual">Manual</a></li>
        <li><a href="#clear" data-i18n="nav_clear">Clear Form</a></li>
        <li><a href="logout.php" data-i18n="nav_exit">Exit</a></li>
      </ul>
    </div>
    <!-- Main Content -->
    <div class="col-md-9 main-content">
        <!-- Formulario para Adicionar Enlaces -->
        <div id="add" class="section">
            <div class="card card-body" id="card-body">
                <form action="savelinks.php" method="POST">
                    <center>
                        <label for="title" class="col-form-label" style="color: black; font-size: 28px;" data-i18n="add_title">
                            <strong>Add Link</strong>
                        </label>
                    </center>

                    <!-- Primera fila del formulario -->
                    <div class="row justify-content-center">
                        <!-- Campo: Enlace Útil -->
                        <div class="form-group col-md-4">
                            <label for="videolink" class="col-form-label" style="color: black;" data-i18n="link_label">
                                <strong>Useful Link</strong>
                            </label>
                            <textarea id="videolink" name="videolink" rows="1" class="form-control" placeholder="Paste the link here" required data-i18n-placeholder="link_placeholder"></textarea>
                        </div>

                        <!-- Campo: Categoría -->
                        <div class="form-group col-md-2">
                            <label for="maincategory" class="col-form-label" style="color: black;" data-i18n="category_label">
                                <strong>Category</strong>
                            </label>
                            <select class="form-control" name="maincategory" id="maincategory" onchange="getSubcategories(this.value)" required>
                                <option value="" disabled selected data-i18n="select_category">Select a category</option>
                                <?php
                                $SQLSELECT = "SELECT distinct(maincategory) FROM videotips_viodetipscategory WHERE username = '$local_username' ORDER BY maincategory ASC";
                                $result_set = mysqli_query($conn, $SQLSELECT);
                                while ($rows = $result_set->fetch_assoc()) {
                                    $maincategory = $rows['maincategory'];
                                    echo "<option value='$maincategory'>$maincategory</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Campo: Subcategoría -->
                        <div class="form-group col-md-2">
                            <label for="category" class="col-form-label" style="color: black;" data-i18n="subcategory_label">
                                <strong>Subcategory</strong>
                            </label>
                            <select class="form-control" name="category" id="category" required>
                                <option value="" disabled selected data-i18n="select_subcategory">Select a subcategory</option>
                            </select>
                        </div>
                    </div>

                    <!-- Segunda fila del formulario -->
                    <div class="row justify-content-center">
                        <!-- Campo: Tipo de Contenido -->
                        <div class="form-group col-md-4">
                            <label for="proforpers" class="col-form-label" style="color: black;" data-i18n="content_type_label">
                                <strong>Content Type</strong>
                            </label>
                            <select class="form-control" name="proforpers" id="proforpers" required>
                                <?php
                                $SQLSELECT = "SELECT proforpers FROM videotips_proforpers";
                                $result_set = mysqli_query($conn, $SQLSELECT);
                                while ($rows = $result_set->fetch_assoc()) {
                                    $proforpers = $rows['proforpers'];
                                    echo "<option value='$proforpers'>$proforpers</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Campo: Descripción -->
                        <div class="form-group col-md-4">
                            <label for="description" class="col-form-label" style="color: black;" data-i18n="description_label">
                                <strong>Description</strong>
                            </label>
                            <textarea id="description" name="description" rows="1" class="form-control" placeholder="Describe the link content" required data-i18n-placeholder="description_placeholder"></textarea>
                        </div>
                    </div>

                    <!-- Botón de Guardar -->
                    <br>
                    <center>
                        <input id="save_link" type="submit" class="btn btn-success btn-block" name="save_link" value="Save" disabled data-i18n="save_button">
                    </center>
                </form>
            </div>
        </div>

        <!-- Sección de "Tus Contenidos Útiles" -->
        <div id="cards" class="section">
            <br>
            <center><?php include("search.php") ?></center> <!-- Incluir el buscador -->
            <div class="card card-body" div="card-body">
                <center>
                    <label for="description" class="col-form-label" style="color: black; font-size: 28px;" data-i18n="your_content_title">
                        <strong>Your Useful Content</strong>
                    </label>
                </center>
                <div class="grid-container">
                <?php
                $query1 = "SELECT * FROM videotips_videotips 
                          WHERE active = 'Yes' AND username ='$local_username' 
                          ORDER BY content ASC";
                $result_links = mysqli_query($conn, $query1);
                while ($links = mysqli_fetch_array($result_links)) {
                    $randomColor = getRandomLightColor();
                ?>
                    <div class="grid-item" style="background-color: <?php echo $randomColor; ?>; display: none;">
                        <div class="grid-item-content">
                            <button class="grid-item-action-btn" style="color: black; font-size: 40px; font-weight: bold;" onclick="toggleActions(event, <?php echo $links['id']; ?>)">...</button>
                            <div class="grid-item-actions">
                                <div class="grid-item-action-menu" id="action-menu-<?php echo $links['id']; ?>">
                                    <button style="background: white; color: green; font-size: 12px;" onclick="copyToClipboard('<?php echo $links['videolink']; ?>'); toggleActions(event, <?php echo $links['id']; ?>);" class="btn btn-secondary" data-i18n="copy_link">Copy Link</button>
                                    <button style="background: white; color: gray; font-size: 12px;" onclick="window.location.href = 'edit.php?id=<?php echo $links['id']; ?>'" class="btn btn-secondary" data-i18n="modify">Modify</button>
                                    <button style="background: white; color: red; font-size: 12px;" onclick="confirmDelete(<?php echo $links['id']; ?>)" class="btn btn-secondary" data-i18n="delete">Delete</button>
                                </div>
                            </div>
                            <div class="grid-item-header"></div>
                            <span class="grid-item-title" style="color: blue"><?php echo $links['content']; ?></span>
                            <div class="grid-item-body">
                                <p><span class="p-title" data-i18n="category">Category:</span><span class="p-content"><?php echo $links['maincategory']; ?></span></p>
                                <p><span class="p-title" data-i18n="subcategory">Subcategory:</span><span class="p-content"><?php echo $links['category']; ?></span></p>
                                <p><span class="p-title" data-i18n="content_type">Content:</span><span class="p-content"><?php echo $links['proforpers']; ?></span></p>
                                <p><span class="p-title" data-i18n="creation">Creation:</span><span class="p-content"><?php echo $links['creationdate']; ?></span></p>
                            </div>
                            <a href="<?php echo $links['videolink']; ?>" target="_blank" class="btn btn-primary" data-i18n="go_to_content">Go to Content</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
          </div>

        <!-- Subscribe Section -->
        <div id="subscribe" class="section">
            <h2 data-i18n="subscribe_title">Subscribe</h2>
            <p data-i18n="subscribe_text">Subscription options here.</p>
        </div>

        <!-- Tutorials Section -->
        <div id="tutorials" class="section">
            <h2 data-i18n="tutorials_title">Tutorials</h2>
            <p data-i18n="tutorials_text">Tutorial content here.</p>
        </div>

        <!-- Manual Section -->
        <div id="manual" class="section">
            <h2 data-i18n="manual_title">Manual</h2>
            <p data-i18n="manual_text">Manual content here.</p>
        </div>

        <!-- Clear Form Section -->
        <div id="clear" class="section">
            <h2 data-i18n="clear_title">Clear Form</h2>
            <p data-i18n="clear_text">Click the button below to clear the add link form.</p>
            <button onclick="clearForm()" class="btn btn-secondary" data-i18n="clear_button">Clear Form</button>
        </div>
  </div>
</div>

<script>
    function getSubcategories(maincategory) {
        if (maincategory == "") {
            document.getElementById("category").innerHTML = "<option value=''>Seleccione una subcategoría</option>";
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("category").innerHTML = this.responseText;
                checkForm(); // Verificar el estado del formulario después de cargar las subcategorías
            }
        };
        xhr.open("GET", "getSubcategories.php?maincategory=" + maincategory, true);
        xhr.send();
    }

    function checkForm() {
        const videolink = document.getElementById("videolink").value.trim();
        const maincategory = document.getElementById("maincategory").value;
        const category = document.getElementById("category").value;
        const proforpers = document.getElementById("proforpers").value;
        const description = document.getElementById("description").value.trim();

        const saveButton = document.getElementById("save_link");

        if (videolink !== "" && !videolink.includes('""') &&
            maincategory !== "" && category !== "" &&
            proforpers !== "" && description !== "" && !description.includes('""')) {
            saveButton.disabled = false;
        } else {
            saveButton.disabled = true;
        }
    }

    document.getElementById("videolink").addEventListener("input", checkForm);
    document.getElementById("maincategory").addEventListener("change", checkForm);
    document.getElementById("category").addEventListener("change", checkForm);
    document.getElementById("proforpers").addEventListener("change", checkForm);
    document.getElementById("description").addEventListener("input", checkForm);

    window.onload = function() {
        var maincategory = document.getElementById("maincategory").value;
        getSubcategories(maincategory);
    };

    function toggleActions(event, id) {
        event.stopPropagation(); // Evita que el evento de clic se propague al documento
        var actionMenu = document.getElementById("action-menu-" + id);
        if (actionMenu.style.display === "block") {
            actionMenu.style.display = "none";
        } else {
            // Cerrar todos los menús abiertos antes de abrir uno nuevo
            var allMenus = document.querySelectorAll('.grid-item-action-menu');
            allMenus.forEach(function(menu) {
                menu.style.display = "none";
            });
            actionMenu.style.display = "block";
        }
    }

    // Cerrar el menú al hacer clic fuera de él
    document.addEventListener('click', function(event) {
        var allMenus = document.querySelectorAll('.grid-item-action-menu');
        var isClickInside = false;

        allMenus.forEach(function(menu) {
            // Verificar si el clic fue dentro del menú
            if (menu.contains(event.target)) {
                isClickInside = true;
            }
        });

        if (!isClickInside) {
            allMenus.forEach(function(menu) {
                menu.style.display = "none";
            });
        }
    });

    function confirmDelete(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#032642',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrar',
            cancelButtonText: 'Cancelar',
            customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                content: 'custom-swal-content',
                confirmButton: 'custom-swal-confirm-button',
                cancelButton: 'custom-swal-cancel-button'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, redirigir a delete.php con el ID
                window.location.href = "delete.php?id=" + id;
            } else {
                // Si el usuario cancela, no hacer nada
                Swal.fire({
                    title: 'Cancelado',
                    text: 'El elemento no fue borrado.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        popup: 'custom-swal-popup',
                        title: 'custom-swal-title',
                        content: 'custom-swal-content',
                        confirmButton: 'custom-swal-confirm-button'
                    }
                });
            }
        });
    }
</script>

<script>
let allCards = [];
let cardsPerLoad = 20; // cantidad a mostrar por bloque
let currentIndex = 0;

function loadMoreCards() {
    const endIndex = currentIndex + cardsPerLoad;
    for (let i = currentIndex; i < endIndex && i < allCards.length; i++) {
        allCards[i].style.display = "block";
    }
    currentIndex = endIndex;
}

document.addEventListener("DOMContentLoaded", () => {
    allCards = Array.from(document.querySelectorAll(".grid-item"));
    loadMoreCards(); // Mostrar el primer bloque
});

window.addEventListener("scroll", () => {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {
        loadMoreCards();
    }
});
</script>

<script>
const T={es:{nav_cards:"Tarjetas",nav_search:"Buscar",nav_add:"Agregar Enlaces",nav_subscribe:"Suscribirse",nav_tutorials:"Tutoriales",nav_manual:"Manual",nav_clear:"Limpiar Formulario",nav_exit:"Salir",add_title:"Agregar Enlace",link_label:"Enlace Útil",link_placeholder:"Pega aquí el enlace",category_label:"Categoría",select_category:"Seleccione una categoría",subcategory_label:"Subcategoría",select_subcategory:"Seleccione una subcategoría",content_type_label:"Tipo de Contenido",description_label:"Descripción",description_placeholder:"Describe el contenido del enlace",save_button:"Guardar",your_content_title:"Tus Contenidos Útiles",copy_link:"Copiar Enlace",modify:"Modificar",delete:"Borrar",category:"Categoría:",subcategory:"Subcategoría:",content_type:"Contenido:",creation:"Creación:",go_to_content:"Ir al Contenido",subscribe_title:"Suscribirse",subscribe_text:"Opciones de suscripción aquí.",tutorials_title:"Tutoriales",tutorials_text:"Contenido de tutoriales aquí.",manual_title:"Manual",manual_text:"Contenido del manual aquí.",clear_title:"Limpiar Formulario",clear_text:"Haz clic en el botón de abajo para limpiar el formulario de agregar enlace.",clear_button:"Limpiar Formulario"},
en:{nav_cards:"Cards",nav_search:"Search",nav_add:"Add Links",nav_subscribe:"Subscribe",nav_tutorials:"Tutorials",nav_manual:"Manual",nav_clear:"Clear Form",nav_exit:"Exit",add_title:"Add Link",link_label:"Useful Link",link_placeholder:"Paste the link here",category_label:"Category",select_category:"Select a category",subcategory_label:"Subcategory",select_subcategory:"Select a subcategory",content_type_label:"Content Type",description_label:"Description",description_placeholder:"Describe the link content",save_button:"Save",your_content_title:"Your Useful Content",copy_link:"Copy Link",modify:"Modify",delete:"Delete",category:"Category:",subcategory:"Subcategory:",content_type:"Content:",creation:"Creation:",go_to_content:"Go to Content",subscribe_title:"Subscribe",subscribe_text:"Subscription options here.",tutorials_title:"Tutorials",tutorials_text:"Tutorial content here.",manual_title:"Manual",manual_text:"Manual content here.",clear_title:"Clear Form",clear_text:"Click the button below to clear the add link form.",clear_button:"Clear Form"},
pt:{nav_cards:"Cartões",nav_search:"Buscar",nav_add:"Adicionar Links",nav_subscribe:"Inscrever-se",nav_tutorials:"Tutoriais",nav_manual:"Manual",nav_clear:"Limpar Formulário",nav_exit:"Sair",add_title:"Adicionar Link",link_label:"Link Útil",link_placeholder:"Cole o link aqui",category_label:"Categoria",select_category:"Selecione uma categoria",subcategory_label:"Subcategoria",select_subcategory:"Selecione uma subcategoria",content_type_label:"Tipo de Conteúdo",description_label:"Descrição",description_placeholder:"Descreva o conteúdo do link",save_button:"Salvar",your_content_title:"Seus Conteúdos Úteis",copy_link:"Copiar Link",modify:"Modificar",delete:"Excluir",category:"Categoria:",subcategory:"Subcategoria:",content_type:"Conteúdo:",creation:"Criação:",go_to_content:"Ir ao Conteúdo",subscribe_title:"Inscrever-se",subscribe_text:"Opções de inscrição aqui.",tutorials_title:"Tutoriais",tutorials_text:"Conteúdo de tutoriais aqui.",manual_title:"Manual",manual_text:"Conteúdo do manual aqui.",clear_title:"Limpar Formulário",clear_text:"Clique no botão abaixo para limpar o formulário de adicionar link.",clear_button:"Limpar Formulário"}};

function setLang(lang){const d=T[lang];document.querySelectorAll('[data-i18n]').forEach(el=>{const k=el.getAttribute('data-i18n');if(d[k]!==undefined)el.innerHTML=d[k];});document.querySelectorAll('[data-i18n-placeholder]').forEach(el=>{const k=el.getAttribute('data-i18n-placeholder');if(d[k]!==undefined)el.placeholder=d[k];});document.querySelectorAll('.lb').forEach(b=>{b.classList.toggle('on',b.textContent.trim()===lang.toUpperCase());});document.documentElement.lang=lang;}
function toggleMenu(){document.getElementById('mobNav').classList.toggle('open');}

// Section navigation
document.querySelectorAll('.sidebar-menu a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const target = this.getAttribute('href').substring(1);
        document.querySelectorAll('.section').forEach(section => {
            section.style.display = 'none';
        });
        document.getElementById(target).style.display = 'block';
    });
});

// Show default section
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.section').forEach(section => {
        section.style.display = 'none';
    });
    document.getElementById('cards').style.display = 'block'; // Default to cards
});

function clearForm() {
    document.getElementById("videolink").value = "";
    document.getElementById("maincategory").selectedIndex = 0;
    document.getElementById("category").innerHTML = "<option value='' disabled selected data-i18n='select_subcategory'>Select a subcategory</option>";
    document.getElementById("proforpers").selectedIndex = 0;
    document.getElementById("description").value = "";
    checkForm();
}
</script>

<?php
if ($copytoclipboard == 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: '¡Enlace copiado al portapapeles!',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $copytoclipboard = 0;
}

if ($savedlink == 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: '¡Enlace Adicionado Exitosamente!',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $_SESSION['savedlink'] = 0;
}

if ($savedlink == 2) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Hubo un problema al adicionar el enlace, intente nuevamente',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $_SESSION['savedlink'] = 0;
}

if ($updatedlink == 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: '¡Enlace Modificado Exitosamente!',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $_SESSION['updatedlink'] = 0;
}

if ($deletedlink == 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: '¡Enlace Borrado Exitosamente!',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $_SESSION['deletedlink'] = 0;
}

if ($duplicatedlink == 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: '¡Enlace Duplicado!',
        icon: 'warning',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $_SESSION['duplicatedlink'] = 0;
}

if ($sessiontimeoutreached == 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: '¡Sesión Expirada!',
        icon: 'warning',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $_SESSION['sessiontimeoutreached'] = 0;
}
?>

</body>
</html>

<script>
    function getSubcategories(maincategory) {
        if (maincategory == "") {
            document.getElementById("category").innerHTML = "<option value=''>Seleccione una subcategoría</option>";
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("category").innerHTML = this.responseText;
                checkForm(); // Verificar el estado del formulario después de cargar las subcategorías
            }
        };
        xhr.open("GET", "getSubcategories.php?maincategory=" + maincategory, true);
        xhr.send();
    }

    function checkForm() {
        const videolink = document.getElementById("videolink").value.trim();
        const maincategory = document.getElementById("maincategory").value;
        const category = document.getElementById("category").value;
        const proforpers = document.getElementById("proforpers").value;
        const description = document.getElementById("description").value.trim();

        const saveButton = document.getElementById("save_link");

        if (videolink !== "" && !videolink.includes('""') &&
            maincategory !== "" && category !== "" &&
            proforpers !== "" && description !== "" && !description.includes('""')) {
            saveButton.disabled = false;
        } else {
            saveButton.disabled = true;
        }
    }

    document.getElementById("videolink").addEventListener("input", checkForm);
    document.getElementById("maincategory").addEventListener("change", checkForm);
    document.getElementById("category").addEventListener("change", checkForm);
    document.getElementById("proforpers").addEventListener("change", checkForm);
    document.getElementById("description").addEventListener("input", checkForm);

    window.onload = function() {
        var maincategory = document.getElementById("maincategory").value;
        getSubcategories(maincategory);
    };

    function toggleActions(event, id) {
        event.stopPropagation(); // Evita que el evento de clic se propague al documento
        var actionMenu = document.getElementById("action-menu-" + id);
        if (actionMenu.style.display === "block") {
            actionMenu.style.display = "none";
        } else {
            // Cerrar todos los menús abiertos antes de abrir uno nuevo
            var allMenus = document.querySelectorAll('.grid-item-action-menu');
            allMenus.forEach(function(menu) {
                menu.style.display = "none";
            });
            actionMenu.style.display = "block";
        }
    }

    // Cerrar el menú al hacer clic fuera de él
    document.addEventListener('click', function(event) {
        var allMenus = document.querySelectorAll('.grid-item-action-menu');
        var isClickInside = false;

        allMenus.forEach(function(menu) {
            // Verificar si el clic fue dentro del menú
            if (menu.contains(event.target)) {
                isClickInside = true;
            }
        });

        if (!isClickInside) {
            allMenus.forEach(function(menu) {
                menu.style.display = "none";
            });
        }
    });

    function confirmDelete(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#032642',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrar',
            cancelButtonText: 'Cancelar',
            customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                content: 'custom-swal-content',
                confirmButton: 'custom-swal-confirm-button',
                cancelButton: 'custom-swal-cancel-button'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, redirigir a delete.php con el ID
                window.location.href = "delete.php?id=" + id;
            } else {
                // Si el usuario cancela, no hacer nada
                Swal.fire({
                    title: 'Cancelado',
                    text: 'El elemento no fue borrado.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        popup: 'custom-swal-popup',
                        title: 'custom-swal-title',
                        content: 'custom-swal-content',
                        confirmButton: 'custom-swal-confirm-button'
                    }
                });
            }
        });
    }
</script>

<script>
let allCards = [];
let cardsPerLoad = 20; // cantidad a mostrar por bloque
let currentIndex = 0;

function loadMoreCards() {
    const endIndex = currentIndex + cardsPerLoad;
    for (let i = currentIndex; i < endIndex && i < allCards.length; i++) {
        allCards[i].style.display = "block";
    }
    currentIndex = endIndex;
}

document.addEventListener("DOMContentLoaded", () => {
    allCards = Array.from(document.querySelectorAll(".grid-item"));
    loadMoreCards(); // Mostrar el primer bloque
});

window.addEventListener("scroll", () => {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {
        loadMoreCards();
    }
});
</script>


<?php
if ($copytoclipboard == 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: '¡Enlace copiado al portapapeles!',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $copytoclipboard = 0;
}

if ($savedlink == 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: '¡Enlace Adicionado Exitosamente!',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $_SESSION['savedlink'] = 0;
}

if ($savedlink == 2) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Hubo un problema al adicionar el enlace, intente nuevamente',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $_SESSION['savedlink'] = 0;
}

if ($duplicatedlink == 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Este enlace ya lo Tenías guardado en tu Biblioteca',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $_SESSION['duplicatedlink'] = 0;
}

if ($updatedlink == 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Enlace Actualizado Exitosamente',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $_SESSION['updatedlink'] = 0;
}

if ($updatedlink == 2) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Hubo un problema al actualizar el enlace, intente nuevamente',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $_SESSION['updatedlink'] = 0;
}

if ($deletedlink == 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Enlace Borrado Exitosamente',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $_SESSION['deletedlink'] = 0;
}

if ($deletedlink == 2) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Hubo un problema al borrar el enlace, intente nuevamente',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
  </script>";
    $_SESSION['deletedlink'] = 0;
}
?>

<?php
function getRandomLightColor() {
    // Genera componentes de color claros (valores entre 200 y 255 para asegurar colores claros)
    $red = rand(200, 255);
    $green = rand(200, 255);
    $blue = rand(200, 255);
    return sprintf("#%02x%02x%02x", $red, $green, $blue); // Convierte a formato hexadecimal
}
?>
</html>