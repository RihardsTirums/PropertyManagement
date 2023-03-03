const button = document.querySelector('button[aria-label="Main menu"]');
const menu = document.querySelector('.hidden.md\\:hidden');

button.addEventListener('click', function() {
    menu.classList.toggle('hidden');
});


