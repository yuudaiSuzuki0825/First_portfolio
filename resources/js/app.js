require('./bootstrap');

window.addEventListener('load', function () {
    let button = document.querySelector('.toggle-menu-button');
    let menu = document.querySelector('.header-site-menu');
    button.addEventListener('click', function () {
        if (menu.classList.contains('is-show')) {
            menu.classList.remove('is-show');
        } else {
            menu.classList.add('is-show');
        }
    })
})