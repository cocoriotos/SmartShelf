function copyToClipboard(text) {
    const tempTextarea = document.createElement("textarea");
    tempTextarea.value = text;
    document.body.appendChild(tempTextarea);
    tempTextarea.select();
    document.execCommand("copy");
    document.body.removeChild(tempTextarea);
    fetch('videolinkadminmodule.php', {
        method: 'GET', 
    })
    .catch(error => {
        console.error('Hubo un error al llamar el archivo PHP', error);
    });
}
