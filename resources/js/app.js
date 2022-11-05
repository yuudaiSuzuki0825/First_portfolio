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

    /* =================================================== */
    // ハンバーガーメニューの実装。
    /* =================================================== */

    /* DOM操作 */
    const open = document.getElementById('open');
    const overlay = document.querySelector('.overlay');
    const close = document.getElementById('close');

    // ハンバーガーメニューボタンをクリックした時。
    open.addEventListener('click', () => {
        // class="show"を追加している。
        // 「.header .overlay.show{}」を読み込むため。
        overlay.classList.add('show');
    });

    // オーバーレイ画面の×ボタンがクリックされた時。
    close.addEventListener('click', () => {
        // class="show"を取り除いている。
        overlay.classList.remove('show');
    });

    /* =================================================== */
    // サイドパネルの実装。
    /* =================================================== */

    /* DOM操作 */
    const leftPanelButton = document.getElementById('left-panel-button');
    const leftPanel = document.getElementById('left-panel');

    // サイドパネルのボタンがクリックされた時。
    leftPanelButton.addEventListener('click', () => {
        // 各Nodeに対してclass="open"を追加している。
        // 「.wrapper .main-area #left-panel.open{}」を読み込むため。
        leftPanel.classList.toggle('open');
        // 「.wrapper .main-area .content #left-panel-button.open i{}」を読み込むため。
        leftPanelButton.classList.toggle('open');
    });

    /* =================================================== */
    // タブメニューの実装。
    /* =================================================== */

    /* DOM操作 */
    // class="planListTitle"がつく全てのNode（タグ）を取得し，配列形式で格納（正確にはNodeListとして格納）。
    // 今回はタブメニューの各タブ（h2タグ）を取得している。index.blade.phpにて確認を。
    const planListTitles = document.querySelectorAll('.planListTitle');

    // 先程のNodeList（配列のように扱える）から各Node（各タグ）を取り出すためにforeach文を使用。
    // title1（自由に命名できる）から各Nodeにアクセスできる。
    planListTitles.forEach(title1 => {
        // 各Node（今回はタブメニューの各タブ）がクリックされた時。
        title1.addEventListener('click', () => {
            // 再度先程のNodeListにアクセスした上で，一度全てのタブメニューの各タブ（h2タグ）からclass="active"を取り除いている。
            planListTitles.forEach(title2 => {
                title2.classList.remove('active');
            });
            // クリックされた対象（タブメニューの各タブ）に対してclass="active"を追加している。
            title1.classList.add('active');
        });
    });
}