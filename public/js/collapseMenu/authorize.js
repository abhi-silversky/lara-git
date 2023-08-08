function openCollapseItem(collapseId) {
    const collapseElement = document.getElementById(collapseId);
    if (collapseElement && collapseElement.classList.contains('collapse')) {
        collapseElement.classList.add('show');
    }
}
openCollapseItem('collapseAuthorization');
