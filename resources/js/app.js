import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

function initSearch(tableId, inputId) {
    const searchInput = document.getElementById(inputId);
    const table = document.getElementById(tableId);

    if (!searchInput || !table) return;

    const rows = table.querySelectorAll("tbody tr");

    searchInput.addEventListener("input", function () {
        const query = this.value.toLowerCase().trim();
        rows.forEach((row) => {
            const rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(query) ? "" : "none";
        });
    });
}

initSearch("rolesTable", "rolesSearch");
// initSearch("tasksTable", "taskSearch");
initSearch("categoriesTable", "categorySearch");
initSearch("usersTable", "userSearch");

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initSearch);
} else {
    initSearch();
}
