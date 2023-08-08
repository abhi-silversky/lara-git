    // Get the collapse element by its ID
    // function openCollapseItem(collapseId) {
    //     alert('Hii');
    //     const collapseElement = document.getElementById(collapseId);

    //     // Check if the element exists and is currently collapsed
    //     if (collapseElement && collapseElement.classList.contains('collapse')) {
    //         // Show the collapse item
    //         collapseElement.classList.add('show');
    //     }
    //     if (targetCollapse.classList.contains('show')) {
    //             targetCollapse.classList.remove('show');
    //     } else {
    //         targetCollapse.classList.add('show');
    //     }
    // }

    // // // Call the function with the desired collapse item ID
    // openCollapseItem('collapseAuthorization'); // Adjust the ID as needed
    // openCollapseItem('collapseUser'); // Adjust the ID as needed
    // openCollapseItem('collapseTwo'); // Adjust the ID as needed


    // // Attach an event listener to the collapse links
    // const collapseLinks = document.querySelectorAll('.nav-link[data-toggle="collapse"]');

    // collapseLinks.forEach(link => {
    //     link.addEventListener('click', () => {
    //         // Close all other collapses
    //         collapseLinks.forEach(otherLink => {
    //             if (otherLink !== link) {
    //                 const target = document.querySelector(otherLink.getAttribute('data-target'));
    //                 if (target.classList.contains('show')) {
    //                     target.classList.remove('show');
    //                 }
    //             }
    //         });
    //     });
    // });

    // const collapseLinks = document.querySelectorAll('.nav-link[data-toggle="collapse"]');

    // collapseLinks.forEach(link => {
    //     link.addEventListener('click', () => {
    //         // Get the target collapse element
    //         const targetCollapse = document.querySelector(link.getAttribute('data-target'));

    //         // Close all other collapses except the target
    //         collapseLinks.forEach(otherLink => {
    //             if (otherLink !== link) {
    //                 const otherCollapse = document.querySelector(otherLink.getAttribute('data-target'));
    //                 if (otherCollapse.classList.contains('show')) {
    //                     otherCollapse.classList.remove('show');
    //                 }
    //             }
    //         });

    //         // Toggle the state of the target collapse
    //         if (targetCollapse.classList.contains('show')) {
    //             // targetCollapse.classList.remove('show');
    //         } else {
    //             targetCollapse.classList.add('show');
    //         }
    //     });
    // });



    // const collapseLinks = document.querySelectorAll('.nav-link[data-toggle="collapse"]');

    // collapseLinks.forEach(link => {
    //     link.addEventListener('click', () => {
    //         // Get the target collapse element
    //         const targetCollapse = document.querySelector(link.getAttribute('data-target'));

    //         // If the target collapse is already open, do nothing
    //         if (targetCollapse.classList.contains('show')) {
    //             return;
    //         }

    //         // Close all other collapses except the target
    //         collapseLinks.forEach(otherLink => {
    //             if (otherLink !== link) {
    //                 const otherCollapse = document.querySelector(otherLink.getAttribute('data-target'));
    //                 if (!otherCollapse.classList.contains('show')) {
    //                     otherCollapse.classList.remove('show');
    //                 }
    //             }
    //         });

    //         // Open the target collapse
    //         targetCollapse.classList.add('show');
    //     });
    // });
