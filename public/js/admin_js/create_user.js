let isAdmin = document.getElementById('is_Admin');
let warningParagraph = document.getElementById('warning');

if (isAdmin) {
    if (isAdmin.checked) {
        warningParagraph.classList.toggle('hidden')
    }
    isAdmin.addEventListener('change', function () {
        if (isAdmin.checked) {
            warningParagraph.classList.toggle('hidden')
        } else {
            warningParagraph.classList.toggle('hidden');
        }
    });
}