<!-- search.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
.search-container {
    margin-bottom: 15px;
    display: flex;
    justify-content: center; /* Centrar horizontalmente */
    align-items: center;     /* Centrar verticalmente si tiene altura */
}

.search-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 550px; /* Limitar ancho */
}

.search-icon {
    position: absolute;
    left: 10px;
    color: #888;
}

#searchInput {
    padding: 8px 35px 8px 30px;
    width: 100%;
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
    text-align: center;
}
</style>

<script>
let filteredCards = [];
let cardsPerLoad = 20;
let currentIndex = 0;

function searchCards() {
    const searchTerm = document.getElementById("searchInput").value.toLowerCase().trim();
    const cards = document.querySelectorAll(".grid-item");

    const searchWords = searchTerm.split(/\s+/).filter(word => word.length > 0);

    filteredCards = [];

    // Ocultar todas
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

    currentIndex = 0;
    loadMoreCards();

    updateCardCount(filteredCards.length);

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
    searchCards();
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
