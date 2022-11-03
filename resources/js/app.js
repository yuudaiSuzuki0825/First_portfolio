// require('./bootstrap');

// window.addEventListener('load', function () {
//     // ハンバーガーメニューの実装。
//     let button = document.querySelector('.toggle-menu-button');
//     let menu = document.querySelector('.header-site-menu');
//     button.addEventListener('click', function () {
//         if (menu.classList.contains('is-show')) {
//             menu.classList.remove('is-show');
//         } else {
//             menu.classList.add('is-show');
//         }
//     })

//     // ページ上部へ遷移するボタンの実装。
//     const top = () => {
//         if ($(window).scrollTop() >= 350) {
//             $('.go-to-top').fadeIn("slow");
//         } else {
//             $('.go-to-top').fadeOut("slow");
//         }
//     }
//     $(window).on('scroll', top);
//     top();
// })

'use strict';

{
    // const openHamburgerMenu = () => {
    //     overlay.classList.add('show');
    // }

    // DOM操作
    const open = document.getElementById('open');
    const overlay = document.querySelector('.overlay');
    const close = document.getElementById('close');

    // ハンバーガーメニューボタンをクリックした時。
    open.addEventListener('click', () => {
        overlay.classList.add('show');
    });

    close.addEventListener('click', () => {
        overlay.classList.remove('show');
    })
}