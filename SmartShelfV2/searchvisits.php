<!-- search.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- FontAwesome para íconos -->

<!-- search.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- FontAwesome para íconos -->

<script>

function searchVisitsByDate(inputElement) {
    const searchTerm = inputElement.value.toLowerCase().trim();
    const tableId = inputElement.getAttribute("data-table-id");
    const rows = document.querySelectorAll(`#${tableId} tbody tr`);
    const searchWords = searchTerm.split(/\s+/).filter(word => word.length > 0);

    rows.forEach((row) => {
        const columns = row.querySelectorAll("td");
        const content = Array.from(columns).map(col => col.textContent.toLowerCase()).join(" ");
        const match = searchWords.length === 0 || searchWords.every(word => content.includes(word));
        row.style.display = match ? "table-row" : "none";
    });
}

function clearSearch(iconElement) {
    const wrapper = iconElement.closest(".search-wrapper");
    const input = wrapper.querySelector(".searchInput");
    input.value = "";
    searchVisitsByDate(input);
    input.focus(); // Para mantener foco después de limpiar
}
</script>

<style>
.search-container {
    margin-bottom: 15px;
    display: flex;
    justify-content: center;
}

.search-wrapper {
    position: relative;
    width: 90%;
    max-width: 500px;
}

.search-wrapper input.searchInput {
    width: 100%;
    padding: 10px 35px 10px 35px; /* espacio para íconos */
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.search-icon {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    color: #999;
    pointer-events: none;
}

.clear-icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    color: #999;
    cursor: pointer;
    display: none; /* Oculta por defecto */
}

/* Mostrar el ícono "X" cuando hay texto */
.search-wrapper input:not(:placeholder-shown) ~ .clear-icon {
    display: block;
}
</style>

<div class="search-container">
    <div class="search-wrapper">
        <i class="fas fa-search search-icon"></i> <!-- Ícono de búsqueda -->
        <input type="text" class="searchInput" placeholder="Buscar..." oninput="searchVisitsByDate(this)" data-table-id="inactiveUsersTable">
        <!--<input type="text" id="searchInput" placeholder="Buscar..." oninput="searchVisitsByDate()">-->
        <i class="fas fa-times clear-icon" onclick="clearSearch(this)"></i>
        <!--<i class="fas fa-times clear-icon" onclick="clearSearch()"></i>--> <!-- Ícono de limpiar -->
    </div>
</div>



<div class="total-cards"></div> <!-- Contenedor para mostrar el total de cards -->