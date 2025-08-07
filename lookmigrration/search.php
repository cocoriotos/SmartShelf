<!-- search.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
.search-container {
    margin-bottom: 15px;
}
.search-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}
.search-icon {
    position: absolute;
    left: 10px;
    color: #888;
}
#searchInput {
    padding: 8px 35px 8px 30px;
    width: 250px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.clear-icon {
    position: absolute;
    right: 10px;
    color: #888;
    cursor: pointer;
    display: none;
}
.total-cards {
    margin-top: 10px;
    font-weight: bold;
}
</style>

<script>
let filteredCards = []; // Cards que coinciden con la búsqueda
let cardsPerLoad = 20;  // Número de cards a mostrar por bloque
let currentIndex = 0;   // Índice de hasta dónde hemos mostrado

function searchCards() {
    const searchTerm = document.getElementById("searchInput").value.toLowerCase().trim();
    const cards = document.querySelectorAll(".grid-item");

    const searchWords = searchTerm.split(/\s+/).filter(word => word.length > 0);

    filteredCards = [];

    // Ocultamos todas
    cards.forEach(card => card.style.display = "none");

    cards.forEach((card) => {
        const content = card.textContent.toLowerCase();
        const videoLink = card.querySelector("a.btn-primary")?.getAttribute("href")?.toLowerCase() || "";

        let match = true;
        if (searchWords.length > 0) {
            match = searchWords.every(word => content.includes(word) || videoLink.includes(word));
        }

        if (match) {
            filteredCards.push(card);
        }
    });

    // Reiniciar índice y mostrar el primer bloque
    currentIndex = 0;
    loadMoreCards();

    // Actualizar el conteo
    updateCardCount(filteredCards.length);

    // Mostrar/ocultar botón de limpiar
    document.querySelector(".clear-icon").style.display = searchTerm.length > 0 ? "block" : "none";
}

function loadMoreCards() {
    const endIndex = currentIndex + cardsPerLoad;
    for (let i = currentIndex; i < endIndex && i < filteredCards.length; i++) {
        filteredCards[i].style.display = "block";
    }
    currentIndex = endIndex;
}

window.addEventListener("scroll", () => {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {
        loadMoreCards();
    }
});

function updateCardCount(visibleCards) {
    document.querySelector(".total-cards").textContent = `Total de cards mostrados: ${visibleCards}`;
}

function clearSearch() {
    document.getElementById("searchInput").value = "";
    searchCards();
}

document.addEventListener("DOMContentLoaded", () => {
    searchCards(); // Cargar en bloques al inicio
});
</script>

<div class="search-container">
    <div class="search-wrapper">
        <i class="fas fa-search search-icon"></i>
        <input type="text" id="searchInput" placeholder="Buscar..." oninput="searchCards()">
        <i class="fas fa-times clear-icon" onclick="clearSearch()"></i>
    </div>
</div>

<div class="total-cards"></div>

<!-- Ejemplo de cards -->
<div class="grid">
    <div class="grid-item">
        <h3>Card 1</h3>
        <a href="video1.mp4" class="btn-primary">Ver video</a>
    </div>
    <div class="grid-item">
        <h3>Card 2</h3>
        <a href="video2.mp4" class="btn-primary">Ver video</a>
    </div>
    <!-- Aquí seguirían todas las demás .grid-item -->
</div>
