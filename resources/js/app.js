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
        // trの子Nodeの数が1つ増える場合もある（index.blade.phpなど）。その場合への対処として以下を記述した。
        children[5].addEventListener('click', () => {
            // trの子Nodeのうち上から6番目のtdタグをクリック➡5番目のそれをクリックした扱いにしてしまうことで（シュミレートすることで）detailOpenの付け外しを達成している。
            children[4].click();
        });
    });

    /* =================================================== */
    // ページトップへ遷移するボタン（アニメーション）の実装。
    /* =================================================== */

    /* callback関数の定義。 */
    // 自由に関数を作ってOK。作った関数をIntersectionObserverのインスタンス生成時に第一引数として代入すること。
    //（交差済み或いは交差前）要素の情報（IntersectionObserverEntry）はentriesで受け取ることが出来る。監視対象として指定した全ての要素の情報が引数として渡される。
    function onScrollCallback(entries) {
        // entriesに複数の値が格納されていることを想定してforEach文を使用しているが，今回は監視対象1つなのでわざわざforEachを使わなくても良い。
        entries.forEach(entry => {
            // 条件式の意味➡entry（今回は空タグ）が交差済みでかつ現在進行形で交差されていない時（通り過ぎた時）,{}を実行する。
            // 空のdiv要素（Node, entry）が交差していない＝もう交差し終わったことを意味する（そもそもこの関数が処理されている時点で一度交差されているわけだから交差済みと判断できる）。
            // 空タグはヘッダーのナビゲーションリンク真下に位置しているのでナビゲーションリンクがスクロールによって画面からほぼ見えなくなったと同時に条件が満たされる。
            if (!entry.isIntersecting) {
                // class="scrolled"の追加。これにより「.wrapper #to_top.scrolled{}」が読み込まれる。
                toTop.classList.add('scrolled');
            } else {
                // class="scrolled"が取り除かれる。これによりボタンが透明になる。
                toTop.classList.remove('scrolled');
            }
        });
    };

    /* DOM操作。 */
    const toTop = document.getElementById('to_top');

    /* インスタンス生成。 */
    // 上から順に読み進めてほしい…。
    // IntersectionObserverAPIの利用はIntersectionObserver（クラス）のインスタンスを生成する所から始まる。
    // 第一引数には関数（callback関数と呼ばれる，自分で自由に定義したものを挿入するのがメジャー）を代入する。
    // 第二引数にはthreshold（閾値）を代入する。省略可能（その場合，「threshold: 0;」が自動的に適用される）。
    // 代入されたcallback関数は予め指定した監視対象（要素）が”ある条件”を満たした場合に実行されるもの。これがこのAPIのメイン機能となる。
    // ある条件というのを指定しているのがthresholdである。
    // 例えば，「threshold: 0.2;」と指定した場合，0.2は20%を指すので「監視対象と画面が20%交差する」という挙動が”ある条件”として設定される。
    // 今回の例では，監視対象が画面と0%交差するとonScrollCallbackという関数が呼び出される。
    const onScrollObserver = new IntersectionObserver(onScrollCallback);
    // 具体的に要素を監視する方法については下記参照。

    /* observeメソッドの呼び出し。 */
    // 作成したIntersectionObserverのインスタンス変数からobserve()を呼び出している。
    // 引数には監視対象としたい要素（Node）を代入する。
    // 以下の記述が読み込まれて始めて，監視が実行される。
    // 今回監視対象に指定しているのは空タグである。空タグなので高さは0。
    onScrollObserver.observe(document.getElementById('monitored'));

    /* 遷移するスピードの調整。 */
    // IntersectionObserverAPIとは無関係なので注意。
    toTop.addEventListener('click', e => {
        // 既定の動作を止める働きがある。
        // 今回はaタグ（toTop）のhref="#"へと遷移する動作を停止している。
        e.preventDefault();

        // href="#"へ遷移する動作を停止した代わりに，以下の指定によってページトップへ自動スクロールするようにしている。
        // 例えば停止した代わりにscroll()を用いればsmoothを指定できるので自動スクロールするスピードを簡単に調整できる。
        // scroll()の他にscrollTo()やscrollBy()を使ってもOK。
        window.scroll({
            // ページトップに指定。
            top: 0,
            // 緩やかに移動する指定。
            behavior: "smooth"
        });
    });

    /* =================================================== */
    // モーダルウインドウの実装。
    /* =================================================== */

    /* DOM操作 */
    const modalWindowOpen = document.getElementById('modalWindowOpen');
    const mask = document.getElementById('mask');

    // ＊以下で使用しているtrs（NodeList）はアコーディオンの実装時にDOM操作済み。
    // trsの各Node（class="tr"のついたtrタグ）にforEach文でアクセス。
    trs.forEach(tr => {
        // tr（class="tr"のついたtrタグ）の子Nodeを全て取得。今回は直下のtdタグを全て取得。
        let children = tr.children;
        // 上から2番目の子Node（ダミーの「完了する」ボタン）がクリックされた時。
        children[1].addEventListener('click', () => {
            // tr（class="tr"のついたtrタグ）の兄弟要素のうち，一個前のNode（id="modalWindow"）のclassListにアクセス。
            // モーダルウインドウ部分を表示させるため。
            tr.previousElementSibling.classList.remove('hidden');
            // マスク部分を表示させるため。
            mask.classList.remove('hidden');
        });
        // マスク部分がクリックされた時。
        mask.addEventListener('click', () => {
            // class="hidden"を追加することで再度モーダルウインドウ部分とマスク部分を非表示にしている。
            tr.previousElementSibling.classList.add('hidden');
            mask.classList.add('hidden');
        });
    });
}