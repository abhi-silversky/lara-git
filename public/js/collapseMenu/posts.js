function openCollapseItem(collapseId) {
    const collapseElement = document.getElementById(collapseId);

    // Check if the element exists and is currently collapsed
    if (collapseElement && collapseElement.classList.contains('collapse')) {
        // Show the collapse item
        collapseElement.classList.add('show');
    }
    if (targetCollapse.classList.contains('show')) {
        targetCollapse.classList.remove('show');
    } else {
        targetCollapse.classList.add('show');
    }
}
openCollapseItem('collapsePost');
