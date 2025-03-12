function copyToClipboard(text) {
    // Crear un elemento textarea temporal para almacenar el texto
    const tempTextarea = document.createElement("textarea");
    tempTextarea.value = text;
    document.body.appendChild(tempTextarea);
    // Seleccionar y copiar el texto
    tempTextarea.select();
    document.execCommand("copy");
    // Eliminar el elemento temporal
    document.body.removeChild(tempTextarea);
    /*alert("¡Enlace copiado al portapapeles!");*/
}

