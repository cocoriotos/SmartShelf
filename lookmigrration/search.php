<!-- search.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- FontAwesome para íconos -->

<script>
function searchCards() {
    const searchTerm = document.getElementById("searchInput").value.toLowerCase().trim(); // Obtener y normalizar el término de búsqueda
    const cards = document.querySelectorAll(".grid-item"); // Obtener todas las cards

    // Dividir el término de búsqueda en palabras individuales
    const searchWords = searchTerm.split(/\s+/).filter(word => word.length > 0);

    let visibleCards = 0; // Contador de cards visibles

    cards.forEach((card) => {
        const content = card.textContent.toLowerCase(); // Obtener el contenido de la card
        const videoLink = card.querySelector("a.btn-primary")?.getAttribute("href")?.toLowerCase() || ""; // Obtener el enlace de la card

        let match = true;

        // Verificar si todas las palabras de búsqueda están presentes en el contenido de la card o en el enlace
        if (searchWords.length > 0) {
            match = searchWords.every(word => content.includes(word) || videoLink.includes(word));
        }

        // Mostrar u ocultar la card según si coincide con la búsqueda
        if (match) {
            card.style.display = "block";
            visibleCards++; // Incrementar el contador de cards visibles
        } else {
            card.style.display = "none";
        }
    });

    // Actualizar el conteo de cards visibles
    updateCardCount(visibleCards);

    // Mostrar u ocultar el ícono de limpiar
    const clearIcon = document.querySelector(".clear-icon");
    if (searchTerm.length > 0) {
        clearIcon.style.display = "block";
    } else {
        clearIcon.style.display = "none";
    }
}



function updateCardCount(visibleCards) {
    const totalCardsContainer = document.querySelector(".total-cards");
    totalCardsContainer.textContent = `Total de cards mostrados: ${visibleCards}`;
}

function clearSearch() {
    const searchInput = document.getElementById("searchInput");
    searchInput.value = ""; // Limpiar el campo de búsqueda
    searchCards(); // Actualizar la búsqueda
}

// Inicializar el conteo de cards al cargar la página
document.addEventListener("DOMContentLoaded", () => {
    const totalCards = document.querySelectorAll(".grid-item").length; // Obtener el total de cards
    updateCardCount(totalCards); // Mostrar el conteo total de cards al cargar la página
});
</script>

<script>
function searchVisitsByDate() {
    const searchTerm = document.getElementById("searchInput").value.toLowerCase().trim(); // Obtener y normalizar el término de búsqueda
    const rows = document.querySelectorAll("table tbody tr"); // Obtener todas las filas de la tabla

    // Dividir el término de búsqueda en palabras individuales
    const searchWords = searchTerm.split(/\s+/).filter(word => word.length > 0);

    rows.forEach((row) => {
        const columns = row.querySelectorAll("td"); // Obtener todas las celdas de la fila
        const content = Array.from(columns).map(col => col.textContent.toLowerCase()).join(" "); // Concatenar todo el contenido de la fila

        let match = true;

        // Verificar si todas las palabras de búsqueda están presentes en el contenido de la fila
        if (searchWords.length > 0) {
            match = searchWords.every(word => content.includes(word));
        }

        // Mostrar u ocultar la fila según si coincide con la búsqueda
        if (match) {
            row.style.display = "table-row";
        } else {
            row.style.display = "none";
        }
    });
}

function clearSearch() {
    const searchInput = document.getElementById("searchInput");
    searchInput.value = ""; // Limpiar el campo de búsqueda
    searchVisitsByDate(); // Actualizar la búsqueda
}

</script>

<div class="search-container">
    <div class="search-wrapper">
        <i class="fas fa-search search-icon"></i> <!-- Ícono de búsqueda -->
        <input type="text" id="searchInput" placeholder="Buscar..." oninput="searchVisitsByDate()">
        <i class="fas fa-times clear-icon" onclick="clearSearch()"></i> <!-- Ícono de limpiar -->
    </div>
</div>



<div class="search-container">
    <div class="search-wrapper">
        <i class="fas fa-search search-icon"></i> <!-- Ícono de búsqueda -->
        <input type="text" id="searchInput" placeholder="Buscar..." oninput="searchCards()">
        <i class="fas fa-times clear-icon" onclick="clearSearch()"></i> <!-- Ícono de limpiar -->
    </div>
</div>

<div class="total-cards"></div> <!-- Contenedor para mostrar el total de cards -->