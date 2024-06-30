document.addEventListener('DOMContentLoaded', function() {
    const sidebarLinks = document.querySelectorAll('li a');

    sidebarLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const userConfirmed = confirm('Do you want to leave the page? You might lose your progress!');
            if (userConfirmed) {
                window.location.href = link.href;
            }
        });
    });
});