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

    /* 前置き */
    // タブメニューの実装の目的はタブのclass属性値の付け外しを行うことで，タブの配色を変化させることであった。
    // しかし，各ページごとに別々のファイルが用意されているのでそもそも本機能を実装する必要性はなかった（class="active"の付け外しをJavaScriptで制御する必要性がない）。
    // 一方で，若干の挙動の違いが見られる。試しにコメントアウトしてタグをクリックしてもらいたい。

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

    /* =================================================== */
    // アコーディオンの実装。
    /* =================================================== */

    /* DOM操作。 */
    // class="tr"の付くタグのみ取得している。NodeList。
    const trs = document.querySelectorAll('.tr');

    // 挙動確認用。エラーメッセージがないのに思惑通り動かない場合はconsole.logなどを活用してどの箇所をデバックすれば良いか調べる作業を行おう。
    // console.log('ok');

    trs.forEach(tr => {
        // childrenプロパティにより，tr（Node）の子Nodeを全て取得している。
        // 各Nodeには配列のように[]でアクセス出来る。
        // 今回はchildrenにはtdタグ（子Node）が要素として格納されているはずである。
        let children = tr.children;

        // デバック用。forEach文が機能しているか確認するため。
        /* console.log('ok'); */

        // hasChildNodes()は呼び出し元のNodeに子Nodeがあるかどうかチェックするメソッド。あればtrueを返す。
        // デバック用。今回はtr（class="tr"の付いたtrタグのNode）に子要素があるかどうかチェックしている。
        /* if (tr.hasChildNodes()) {
             console.log('yes');
           }
        */

        // デバック用。tr（親Node，NodeListになっている）の子Nodeの個数を確認している。
        // 配列のようにlengthプロパティで取得出来る。
        /* console.log(children.length); */

        // デバック用。tr（親Node，NodeListになっている）の子Nodeの個数を確認している。
        /* console.log(tr.childElementCount); */

        // trの子Nodeのうち上から5番目のtdタグ（id="planDetailButton"が付いている最後のtdタグ）にアクセスし，そのタグがクリックされたかどうかチェックしている。
        children[4].addEventListener('click', () => {

            // デバック用。イベントリスナーが実行されているか確認するため。
            /* console.log('ok'); */

            // デバック用。nextSiblingプロパティとnextElementSiblingプロパティの違いをコンソールにて確認してほしい。
            // classListにアクセスしたい場合は後者を選択すること。
            /* console.log(tr.nextSibling); */
            /* console.log(tr.nextElementSibling); */

            // tr（class="tr"の付いたtrタグ）の次の兄弟Nodeにアクセスし（今回はid="planDetailRow"の付いたtrタグ），class="detailOpen"の付け外しを行っている。
            // これにより#planDetailRow.detailOpen{display: block;}が読み込まれ，表示される。
            tr.nextElementSibling.classList.toggle('detailOpen');
            // trにもclass="detailOpen"の付け外しの処理をしている。
            // これにより.tr.detailOpen{border-radius: 4px 4px 0 0;}が読み込まれる形になる。
            tr.classList.toggle('detailOpen');
        });
    });
}