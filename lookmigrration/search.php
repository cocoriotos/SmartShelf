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
    max-width: 350px; /* Limitar ancho */
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
