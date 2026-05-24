
<!-- Developed by Julián González Bucheli -->
<html>
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

<head>
    <script src="head.js" defer></script>
    <script src="Linktoclipboard.js" defer></script>
    <link rel="icon" href="SSCircleBackgroundWhite.ico" type="image/x-icon">
    <link rel="stylesheet" href="style_sheet_ops.css" />
    <script src="Popper/popper.min.js"></script>
    <script src="plugins/sweetalert/sweetalert.min.js"></script>
    <script src="plugins/alertifyjs/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css" />
    <style>
        body.admin-module-page {
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(180deg, #f7fcfb 0%, #ffffff 100%);
            color: #10283d;
            margin: 0;
            min-height: 100vh;
        }

        .admin-wrapper {
            max-width: 1180px;
            margin: 0 auto;
            padding: 32px 20px 64px;
        }

        .section-card {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(3, 38, 66, 0.08);
            box-shadow: 0 20px 45px rgba(3, 38, 66, 0.08);
            border-radius: 28px;
            padding: 32px;
            margin-bottom: 28px;
        }

        .hero-card {
            background: rgba(37, 211, 102, 0.08);
            border: 1px solid rgba(37, 211, 102, 0.18);
            border-radius: 28px;
            padding: 32px;
            margin-bottom: 28px;
        }

        .section-heading {
            color: #0f3650;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.35rem;
            text-align: center;
        }

        .section-subtitle {
            color: #4b6475;
            margin-bottom: 1.8rem;
            font-size: 1rem;
            text-align: center;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-group label {
            color: #10283d;
            font-weight: 700;
            font-size: 1rem;
        }

        .form-control {
            border: 1px solid #d7e6ea;
            border-radius: 16px;
            padding: 14px 16px;
            font-size: 0.98rem;
            color: #10283d;
            background: #f9fefa;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            text-align: left;
        }

        .form-control:focus {
            outline: none;
            border-color: #25d366;
            box-shadow: 0 0 0 6px rgba(37, 211, 102, 0.12);
            background: #ffffff;
        }

        .form-control::placeholder {
            color: #7a8c97;
        }

        .btn-success {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 320px;
            margin: 0 auto;
            background-color: #25d366;
            border: none;
            color: #ffffff;
            padding: 14px 24px;
            border-radius: 999px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .btn-success:hover:not(:disabled) {
            background-color: #1bb55d;
            transform: translateY(-1px);
        }

        .btn-success:disabled {
            background-color: #c6dcc7;
            cursor: not-allowed;
        }

        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, rgba(37, 211, 102, 0) 0%, rgba(37, 211, 102, 0.28) 50%, rgba(37, 211, 102, 0) 100%);
            margin: 36px 0;
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 8px;
        }

        .content-card {
            border-radius: 24px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-height: 330px;
            border: 1px solid rgba(3, 38, 66, 0.08);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(243, 255, 250, 0.96));
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .content-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 22px 48px rgba(3, 38, 66, 0.09);
        }

        .grid-item-content {
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 18px;
            height: 100%;
        }

        .grid-item-title {
            color: #032642;
            font-size: 1.15rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .grid-item-body p {
            margin: 8px 0;
            color: #405862;
        }

        .grid-item-body .p-title {
            font-weight: 700;
            color: #10283d;
            margin-bottom: 4px;
        }

        .grid-item-action-btn {
            background: rgba(3, 38, 66, 0.06);
            border: none;
            border-radius: 999px;
            width: 46px;
            height: 46px;
            font-size: 28px;
            color: #032642;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .grid-item-action-btn:hover {
            background: rgba(3, 38, 66, 0.12);
        }

        .grid-item-actions {
            position: relative;
        }

        .grid-item-action-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 50px;
            width: 220px;
            background-color: #ffffff;
            border: 1px solid rgba(3, 38, 66, 0.08);
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(3, 38, 66, 0.12);
            z-index: 1000;
        }

        .grid-item-action-menu button {
            display: block;
            width: 100%;
            padding: 12px 14px;
            text-align: left;
            background: none;
            border: none;
            border-bottom: 1px solid rgba(3, 38, 66, 0.06);
            color: #10283d;
            font-size: 0.95rem;
            cursor: pointer;
        }

        .grid-item-action-menu button:last-child {
            border-bottom: none;
        }

        .grid-item-action-menu button:hover {
            background: #f6fbf8;
        }

        .btn-primary {
            background-color: #032642;
            color: #ffffff;
            padding: 12px 18px;
            border-radius: 999px;
            text-decoration: none;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            transition: background 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #0c316d;
        }

        .whatsapp-fab {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background-color: #25d366;
            color: white;
            padding: 12px 18px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 18px 40px rgba(37, 211, 102, 0.24);
            z-index: 999;
            text-decoration: none;
        }

        .whatsapp-fab img {
            width: 30px;
            height: 30px;
        }

        .search-wrapper {
            margin-bottom: 24px;
            text-align: center;
        }

        .lang-switcher {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .lang-btn {
            border: 1px solid rgba(3, 38, 66, 0.16);
            background: rgba(255, 255, 255, 0.95);
            color: #10283d;
            padding: 10px 18px;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease, color 0.2s ease;
            min-width: 64px;
        }

        .lang-btn:hover,
        .lang-btn.active {
            background: #032642;
            color: #ffffff;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .admin-wrapper {
                padding: 24px 16px 48px;
            }

            .section-heading {
                font-size: 1.75rem;
            }
        }
    </style>
    <script>
        window.moduleTranslations = {
            es: {
                add_link_title: 'Adicionar Enlace',
                add_link_subtitle: 'Guarda y organiza contenido útil con el diseño de SmartShelf.',
                useful_contents: 'Tus Contenidos Útiles',
                search_placeholder: 'Buscar...',
                select_category: 'Seleccione una categoría',
                select_subcategory: 'Seleccione una subcategoría',
                helpful_title: 'Enlace Útil',
                category: 'Categoría',
                subcategory: 'Subcategoría',
                content: 'Contenido',
                description: 'Descripción',
                link_placeholder: 'Pega aquí el enlace',
                description_placeholder: 'Describe el contenido del enlace',
                save: 'Guardar',
                copy: 'Copiar Enlace',
                edit: 'Modificar',
                delete: 'Borrar',
                go_content: 'Ir al Contenido',
                label_category: 'Categoría:',
                label_subcategory: 'Subcategoría:',
                label_content: 'Contenido:',
                label_creation: 'Creación:',
                support: 'Soporte',
                confirm_title: '¿Estás seguro?',
                confirm_delete_button: 'Sí, borrar',
                cancel_button: 'Cancelar',
                cancel_text: 'El elemento no fue borrado.',
                accept_button: 'Aceptar',
                message_title: 'Mensaje',
                copied_text: '¡Enlace copiado al portapapeles!',
                added_text: '¡Enlace Adicionado Exitosamente!',
                updated_text: 'Enlace Actualizado Exitosamente',
                delete_error_text: 'Hubo un problema al borrar el enlace, intente nuevamente',
            },
            en: {
                add_link_title: 'Add Link',
                add_link_subtitle: 'Save and organize useful content with the SmartShelf design.',
                useful_contents: 'Your Useful Contents',
                search_placeholder: 'Search...',
                select_category: 'Select a category',
                select_subcategory: 'Select a subcategory',
                helpful_title: 'Useful Link',
                category: 'Category',
                subcategory: 'Subcategory',
                content: 'Content',
                description: 'Description',
                link_placeholder: 'Paste the link here',
                description_placeholder: 'Describe the link content',
                save: 'Save',
                copy: 'Copy Link',
                edit: 'Edit',
                delete: 'Delete',
                go_content: 'Go to Content',
                label_category: 'Category:',
                label_subcategory: 'Subcategory:',
                label_content: 'Content:',
                label_creation: 'Creation:',
                support: 'Support',
                confirm_title: 'Are you sure?',
                confirm_delete_button: 'Yes, delete',
                cancel_button: 'Cancel',
                cancel_text: 'The item was not deleted.',
                accept_button: 'OK',
                message_title: 'Message',
                copied_text: 'Link copied to clipboard!',
                added_text: 'Link added successfully!',
                updated_text: 'Link updated successfully',
                delete_error_text: 'There was a problem deleting the link, please try again',
            },
            pt: {
                add_link_title: 'Adicionar Link',
                add_link_subtitle: 'Salve e organize conteúdo útil com o design do SmartShelf.',
                useful_contents: 'Seus Conteúdos Úteis',
                search_placeholder: 'Buscar...',
                select_category: 'Selecione uma categoria',
                select_subcategory: 'Selecione uma subcategoria',
                helpful_title: 'Link Útil',
                category: 'Categoria',
                subcategory: 'Subcategoria',
                content: 'Conteúdo',
                description: 'Descrição',
                link_placeholder: 'Cole o link aqui',
                description_placeholder: 'Descreva o conteúdo do link',
                save: 'Salvar',
                copy: 'Copiar Link',
                edit: 'Editar',
                delete: 'Excluir',
                go_content: 'Ir ao Conteúdo',
                label_category: 'Categoria:',
                label_subcategory: 'Subcategoria:',
                label_content: 'Conteúdo:',
                label_creation: 'Criação:',
                support: 'Suporte',
                confirm_title: 'Tem certeza?',
                confirm_delete_button: 'Sim, excluir',
                cancel_button: 'Cancelar',
                cancel_text: 'O item não foi excluído.',
                accept_button: 'OK',
                message_title: 'Mensagem',
                copied_text: 'Link copiado para a área de transferência!',
                added_text: 'Link adicionado com sucesso!',
                updated_text: 'Link atualizado com sucesso',
                delete_error_text: 'Houve um problema ao excluir o link, tente novamente',
            }
        };

        window.currentLang = localStorage.getItem('smartshelfLang') || localStorage.getItem('moduleLang') || 'es';

        function t(key) {
            const translations = window.moduleTranslations?.[window.currentLang] || window.moduleTranslations?.es || {};
            return translations[key] || key;
        }

        function updateModuleText() {
            const updateText = (selector, key) => {
                const el = document.querySelector(selector);
                if (el) el.textContent = t(key);
            };

            updateText('#heading-add-link', 'add_link_title');
            updateText('#subtitle-add-link', 'add_link_subtitle');
            updateText('#heading-useful-contents', 'useful_contents');
            updateText('#label-videolink', 'helpful_title');
            updateText('#label-maincategory', 'category');
            updateText('#label-category', 'subcategory');
            updateText('#label-proforpers', 'content');
            updateText('#label-description', 'description');
            updateText('#support-label', 'support');

            const mainCategoryPlaceholder = document.querySelector('#maincategory option[data-i18n="select_category"]');
            const subCategoryPlaceholder = document.querySelector('#category option[data-i18n="select_subcategory"]');
            if (mainCategoryPlaceholder) mainCategoryPlaceholder.textContent = t('select_category');
            if (subCategoryPlaceholder) subCategoryPlaceholder.textContent = t('select_subcategory');

            const descr = document.getElementById('description');
            if (descr) descr.placeholder = t('description_placeholder');
            const linkInput = document.getElementById('videolink');
            if (linkInput) linkInput.placeholder = t('link_placeholder');

            const saveButton = document.getElementById('save_link');
            if (saveButton) saveButton.value = t('save');

            document.querySelectorAll('.action-button[data-action="copy"]').forEach(btn => {
                btn.innerHTML = '<i class="fas fa-copy"></i> ' + t('copy');
            });
            document.querySelectorAll('.action-button[data-action="edit"]').forEach(btn => {
                btn.innerHTML = '<i class="fas fa-edit"></i> ' + t('edit');
            });
            document.querySelectorAll('.action-button[data-action="delete"]').forEach(btn => {
                btn.innerHTML = '<i class="fas fa-trash-alt"></i> ' + t('delete');
            });

            document.querySelectorAll('[data-key="label-category"]').forEach(el => el.textContent = t('label_category'));
            document.querySelectorAll('[data-key="label-subcategory"]').forEach(el => el.textContent = t('label_subcategory'));
            document.querySelectorAll('[data-key="label-content"]').forEach(el => el.textContent = t('label_content'));
            document.querySelectorAll('[data-key="label-creation"]').forEach(el => el.textContent = t('label_creation'));

            document.querySelectorAll('.content-link-btn').forEach(btn => btn.textContent = t('go_content'));

            if (window.updateSearchTexts) {
                window.updateSearchTexts(window.currentLang);
            }
        }

        function setModuleLanguage(lang) {
            window.currentLang = lang;
            localStorage.setItem('moduleLang', lang);
            localStorage.setItem('smartshelfLang', lang);
            document.querySelectorAll('.lang-btn').forEach(button => {
                button.classList.toggle('active', button.dataset.lang === lang);
            });
            updateModuleText();
            if (window.updateSearchTexts) window.updateSearchTexts(lang);
            if (window.searchCards) window.searchCards();
            window.dispatchEvent(new Event('languageChanged'));
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.lang-btn').forEach(button => {
                button.addEventListener('click', function () {
                    setModuleLanguage(this.dataset.lang);
                });
            });
            setModuleLanguage(window.currentLang);
        });
    </script>
</head>

<body id="bodyadminmodule" class="admin-module-page">
    <div class="admin-wrapper">
        <div class="container-fluid p-0">
            <div class="row justify-content-start" style="width: 100%;">
                <!-- Formulario para Adicionar Enlaces -->
                <div class="col-md-12">
                    <div class="section-card hero-card" id="card-body">
                        <form action="savelinks.php" method="POST">
                            <div class="lang-switcher">
                                <button type="button" class="lang-btn active" data-lang="es">ES</button>
                                <button type="button" class="lang-btn" data-lang="en">EN</button>
                                <button type="button" class="lang-btn" data-lang="pt">PT</button>
                            </div>
                            <div class="section-heading" id="heading-add-link">Adicionar Enlace</div>
                            <div class="section-subtitle" id="subtitle-add-link">Guarda y organiza contenido útil con el diseño de SmartShelf.</div>

                            <!-- Primera fila del formulario -->
                            <div class="form-row">
                                <!-- Campo: Enlace Útil -->
                                <div class="form-group">
                                    <label for="videolink" id="label-videolink"><strong>Enlace Útil</strong></label>
                                    <textarea id="videolink" name="videolink" rows="1" class="form-control" placeholder="Pega aquí el enlace" required></textarea>
                                </div>

                                <!-- Campo: Categoría -->
                                <div class="form-group">
                                    <label for="maincategory" id="label-maincategory"><strong>Categoría</strong></label>
                                    <select class="form-control" name="maincategory" id="maincategory" onchange="getSubcategories(this.value)" required>
                                        <option value="" disabled selected data-i18n="select_category">Seleccione una categoría</option>
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
                                <div class="form-group">
                                    <label for="category" id="label-category"><strong>Subcategoría</strong></label>
                                    <select class="form-control" name="category" id="category" required>
                                        <option value="" disabled selected data-i18n="select_subcategory">Seleccione una subcategoría</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Segunda fila del formulario -->
                            <div class="form-row">
                                <!-- Campo: Tipo de Contenido -->
                                <div class="form-group">
                                    <label for="proforpers" id="label-proforpers"><strong>Contenido</strong></label>
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
                                <div class="form-group">
                                    <label for="description" id="label-description"><strong>Descripción</strong></label>
                                    <textarea id="description" name="description" rows="1" class="form-control" placeholder="Describe el contenido del enlace" required></textarea>
                                </div>
                            </div>

                            <!-- Botón de Guardar -->
                            <div style="text-align:center; margin-top: 16px;">
                                <input id="save_link" type="submit" class="btn btn-success" name="save_link" value="Guardar" disabled>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sección de "Tus Contenidos Útiles" -->
                <div class="col-md-12">
                    <div class="search-section"><?php include("search.php") ?></div> <!-- Incluir el buscador -->
                    <div class="section-card">
                        <div class="section-heading" id="heading-useful-contents">Tus Contenidos Útiles</div>
                        <div class="section-subtitle" id="subtitle-useful-contents">Accede rápido a tus enlaces más importantes con tarjetas limpias y modernas.</div>
                        <div class="content-grid">
                        <?php
                        $query1 = "SELECT * FROM videotips_videotips 
                                  WHERE active = 'Yes' AND username ='$local_username' 
                                  ORDER BY content ASC";
                        $result_links = mysqli_query($conn, $query1);
                        while ($links = mysqli_fetch_array($result_links)) {
                            $randomColor = getRandomLightColor();
                        ?>
                            <div class="content-card grid-item" style="background-color: <?php echo $randomColor; ?>; display: none;">
                                <div class="grid-item-content">
                                    <button class="grid-item-action-btn" onclick="toggleActions(event, <?php echo $links['id']; ?>)">...</button>
                                    <div class="grid-item-actions">
                                        <div class="grid-item-action-menu" id="action-menu-<?php echo $links['id']; ?>">
                                            <button class="action-button" data-action="copy" onclick="copyToClipboard('<?php echo $links['videolink']; ?>'); toggleActions(event, <?php echo $links['id']; ?>);">Copiar Enlace</button>
                                            <button class="action-button" data-action="edit" onclick="window.location.href = 'edit.php?id=<?php echo $links['id']; ?>'">Modificar</button>
                                            <button class="action-button" data-action="delete" onclick="confirmDelete(<?php echo $links['id']; ?>)">Borrar</button>
                                        </div>
                                    </div>
                                    <div class="grid-item-header"></div>
                                    <span class="grid-item-title"><?php echo $links['content']; ?></span>
                                    <div class="grid-item-body">
                                        <p><span class="p-title" data-key="label-category">Categoría:</span><span class="p-content"><?php echo $links['maincategory']; ?></span></p>
                                        <p><span class="p-title" data-key="label-subcategory">Subcategoría:</span><span class="p-content"><?php echo $links['category']; ?></span></p>
                                        <p><span class="p-title" data-key="label-content">Contenido:</span><span class="p-content"><?php echo $links['proforpers']; ?></span></p>
                                        <p><span class="p-title" data-key="label-creation">Creación:</span><span class="p-content"><?php echo $links['creationdate']; ?></span></p>
                                    </div>
                                    <a href="<?php echo $links['videolink']; ?>" target="_blank" class="btn btn-primary content-link-btn">Ir al Contenido</a>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Botón de WhatsApp -->
    <a href="https://wa.me/573054293185" target="_blank" class="whatsapp-fab">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
        <span id="support-label">Soporte</span>
    </a>
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
</body>
</html>