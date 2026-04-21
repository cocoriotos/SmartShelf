<!--  Developed by julián González Bucheli -->
<html lang="us">
	<?php
    include "sessions.php";
	date_default_timezone_set('America/Bogota');
	?>
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - SmartShelf</title>
        <link rel="icon" href="SSCircleBackgroundWhite.ico" type="image/x-icon">
        <script src="head.js?v=<?php echo time(); ?>" defer></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="style_sheet_auth.css?v=<?php echo time(); ?>">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <script>
            window.onload = function() {
                // Verificar si la página ya ha sido cargada
                if (!sessionStorage.getItem('pageReloaded')) {
                    if ('caches' in window) {
                        caches.keys().then(function(names) {
                            for (let name of names) caches.delete(name);
                        });
                    }
                    // Marcar la página como recargada
                    sessionStorage.setItem('pageReloaded', 'true');
                    // Recargar la página sin modificar la URL
                    location.replace(location.href);
                }
            };
        </script>
    </head>
	
	<body id="bodyadminmodule">   
        <div class="lang-sw">
            <button class="lb on" onclick="setLang('es')">ES</button>
            <button class="lb" onclick="setLang('en')">EN</button>
            <button class="lb" onclick="setLang('pt')">PT</button>
        </div>
        <div class="login-container">
            <!-- New section for "Video Tutoriales" and "Manual del Usuario" links -->
            <div class="help-links">
                <!--<a id="ayuda" href="https://www.youtube.com/playlist?list=PLRQ5KF9igtB2GRlHLSP6Uwx1lzy387Wz5" target="_blank">Video Tutoriales</a>while Adjustments
                <a id="ayuda" href="UCLToolManualDelUsuario2025.pdf" target="_blank">Manual del Usuario</a>-->
            </div> 
            <div class="login-header">
                <img src="SmartShelfUsefulContentLibraryDarrkLightGreen.ico" alt="SmartShelf Logo" class="logo">
                <h1 data-i18n="auth_title">Biblioteca de Contenidos Útiles</h1>
            </div>
            <form id="login" action="access_success_Tasks_final.php" method="POST" autocomplete="off">
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="email" data-i18n-placeholder="auth_email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" data-i18n-placeholder="auth_password" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="btn-login" data-i18n="auth_login">Ingresar</button>
            </form>

            <form id="login" action="index.php" method="POST" autocomplete="off">
                <button type="submit" class="btn-login" data-i18n="auth_cancel">Cancelar</button>
                <br>
                <a href="recoverpassword.php" class="forgot-password" data-i18n="auth_forgot">¿Olvidaste tu contraseña?</a>
            </form>

            <form id="request-access" action="requestaccessfinal.php" method="POST" autocomplete="off">
                <p data-i18n="auth_no_access">¿Sin acceso? <button type="submit" class="btn-request" style="font-size: 20px" data-i18n="auth_request_here">Solicitarlo aquí</button></p>
                <br>
                <p data-i18n="auth_questions">¿Alguna duda? Contáctenos al Email: <a href="mailto:adm@solicionespro.com">adm@solicionespro.com</a></p>
                <br>
                <!--<p>Fecha: <?php /*echo date('m/d/Y');*/ ?></p>-->
            </form>
        <a href="https://wa.me/573054293185" target="_blank" 
        style="position: fixed; bottom: 20px; right: 20px; background-color: #25D366; color: white; padding: 10px 20px; border-radius: 50px; font-size: 16px; text-decoration: none; display: flex; align-items: center;">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="35" height="35" style="margin-right: 10px;"></a>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<script>
const T={es:{auth_title:"Biblioteca de Contenidos Útiles",auth_login:"Ingresar",auth_cancel:"Cancelar",auth_forgot:"¿Olvidaste tu contraseña?",auth_no_access:"¿Sin acceso?",auth_request_here:"Solicitarlo aquí",auth_questions:"¿Alguna duda? Contáctenos al Email:",auth_email:"Email",auth_password:"Contraseña"},
en:{auth_title:"Useful Content Library",auth_login:"Log In",auth_cancel:"Cancel",auth_forgot:"Forgot your password?",auth_no_access:"No access?",auth_request_here:"Request it here",auth_questions:"Any questions? Contact us at Email:",auth_email:"Email",auth_password:"Password"},
pt:{auth_title:"Biblioteca de Conteúdos Úteis",auth_login:"Entrar",auth_cancel:"Cancelar",auth_forgot:"Esqueceu sua senha?",auth_no_access:"Sem acesso?",auth_request_here:"Solicite aqui",auth_questions:"Alguma dúvida? Contate-nos pelo Email:",auth_email:"Email",auth_password:"Senha"}};

function setLang(lang){const d=T[lang];document.querySelectorAll('[data-i18n]').forEach(el=>{const k=el.getAttribute('data-i18n');if(d[k]!==undefined)el.innerHTML=d[k];});document.querySelectorAll('[data-i18n-placeholder]').forEach(el=>{const k=el.getAttribute('data-i18n-placeholder');if(d[k]!==undefined)el.placeholder=d[k];});document.querySelectorAll('.lb').forEach(b=>{b.classList.toggle('on',b.textContent.trim()===lang.toUpperCase());});document.documentElement.lang=lang;}
</script>
    </body>
</html>
