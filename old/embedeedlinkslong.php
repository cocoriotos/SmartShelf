

<?php
session_start();
$videoUrl = $_SESSION['videoUrl'];
$embedUrl = $_SESSION['embedUrl'];
$url = $videoUrl;

function convert_to_embed($url) {
    // Verificar si el enlace es un enlace de YouTube
    if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
        // Si es un enlace corto (youtu.be), se extrae el ID
        $videoId = $matches[1];
    } elseif (preg_match('/youtube\.com\/.*[?&]v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
        // Si es un enlace estándar de YouTube (youtube.com/watch?v=...)
        $videoId = $matches[1];
    }

    // Retornar el enlace embebido
    return "https://www.youtube.com/embed/" . $videoId;
}
$embedUrl = $url;
?>
