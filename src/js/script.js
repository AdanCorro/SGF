/* Buscar factura-historial */
document.addEventListener("keyup", e => {
    if (e.target.id === "buscador") {
        if (e.key === "Escape") e.target.value = "";

        // Itera sobre todas las celdas con la clase "factura"
        document.querySelectorAll(".recibo").forEach(factura => {
            // Comprueba si el contenido de la celda coincide con el término de búsqueda
            if (factura.textContent.toLowerCase().includes(e.target.value.toLowerCase())) {
                factura.parentElement.style.display = ""; // Muestra la fila
            } else {
                factura.parentElement.style.display = "none"; // Oculta la fila
            }
        });
    }
});