function openCollapseItem(collapseId) {
    const collapseElement = document.getElementById(collapseId);

    // Check if the element exists and is currently collapsed
    if (collapseElement && collapseElement.classList.contains('collapse')) {
        // Show the collapse item
        collapseElement.classList.add('show');
    }
}
openCollapseItem('collapseUser');
