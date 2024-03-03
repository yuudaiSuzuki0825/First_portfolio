"use strict";

{
    // ページごとに読み込むjsファイルを変更する必要がある（複数ファイルに分割すること）。

    /* =================================================== */
    // サイドパネルの実装。
    /* =================================================== */

    /* DOM操作 */
    const leftPanelButton = document.getElementById("left-panel-button");
    const subLeftPanelButton = document.getElementById("sub-left-panel-button");
    const leftPanel = document.getElementById("left-panel");
    const content = document.querySelector(".content");
    const titleInput = document.querySelector(".title-input");

    // サイドパネルのボタンがクリックされた時。
    leftPanelButton.addEventListener("click", () => {
        // 各Nodeに対してclass="open"を追加している。
        // 「.wrapper .main-area #left-panel.open{}」を読み込むため。
        leftPanel.classList.toggle("open");
        // 「.wrapper .main-area .content #left-panel-button.open i{}」を読み込むため。
        leftPanelButton.classList.toggle("open");
        // 「.wrapper .main-area .content.open[}」を読み込むため。
        content.classList.toggle("open");
        // サイドパネルをクリックした直後，即座にテーマ入力するのを手助けするため。押下と同時に入力欄にフォーカス。
        titleInput.focus();
    });

    // 右側のサイドパネルボタンがクリックされた時。
    subLeftPanelButton.addEventListener("click", () => {
        // 上記Nodeをクリックした扱いにしている。
        leftPanelButton.click();
        subLeftPanelButton.classList.toggle("open");
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
    const planListTitles = document.querySelectorAll(".planListTitle");

    // 先程のNodeList（配列のように扱える）から各Node（各タグ）を取り出すためにforeach文を使用。
    // title1（自由に命名できる）から各Nodeにアクセスできる。
    planListTitles.forEach((title1) => {
        // 各Node（今回はタブメニューの各タブ）がクリックされた時。
        title1.addEventListener("click", () => {
            // 再度先程のNodeListにアクセスした上で，一度全てのタブメニューの各タブ（h2タグ）からclass="active"を取り除いている。
            planListTitles.forEach((title2) => {
                title2.classList.remove("active");
            });
            // クリックされた対象（タブメニューの各タブ）に対してclass="active"を追加している。
            title1.classList.add("active");
        });
    });

    /* =================================================== */
    // アコーディオンの実装。（警告）trace.blade.phpにて致命的なバク発生。tdの個数のズレによるchildren[]の指定が原因。
    /* =================================================== */

    /* DOM操作。 */
    // class="tr"の付くタグのみ取得している。NodeList。
    const trs = document.querySelectorAll(".tr");
    // 全アコーディオンを開閉するボタン。
    const AllplanDetailButton = document.getElementById("AllplanDetailButton");
    // 全アコーディオンを開閉するボタンのアイコン。
    const AllplanDetailButtonChild = AllplanDetailButton.firstElementChild;

    // 挙動確認用。エラーメッセージがないのに思惑通り動かない場合はconsole.logなどを活用してどの箇所をデバックすれば良いか調べる作業を行おう。
    /* console.log('ok'); */

    trs.forEach((tr) => {
        // childrenプロパティにより，tr（Node）の子Nodeを全て取得している。
        // 各Nodeには配列のように[]でアクセス出来る。
        // 今回はchildrenにはtdタグ（子Node）が要素として格納されているはずである。
        let children = tr.children;

        // デバック用。forEach文が機能しているか確認するため。
        /* console.log('hoge'); */

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
        children[5].addEventListener("click", () => {
            // デバック用。nextSiblingプロパティとnextElementSiblingプロパティの違いをコンソールにて確認してほしい。
            // classListにアクセスしたい場合は後者を選択すること。
            /* console.log(tr.nextSibling); */
            /* console.log(tr.nextElementSibling); */

            // tr（class="tr"の付いたtrタグ）の次の兄弟Nodeにアクセスし（今回はid="planDetailRow"の付いたtrタグ），class="detailOpen"の付け外しを行っている。
            // これにより#planDetailRow.detailOpen{display: block;}が読み込まれ，表示される。
            tr.nextElementSibling.classList.toggle("detailOpen");
            // trにもclass="detailOpen"の付け外しの処理をしている。
            // これにより.tr.detailOpen{border-radius: 4px 4px 0 0;}が読み込まれる形になる。
            // また，.wrapper .main-area .content .content-area .table tbody .tr.detailOpen #planDetailButton i{}も読み込まれるのでアイコンが反転する。
            tr.classList.toggle("detailOpen");
        });
        // trの子Nodeの数が1つ増える場合もある（index.blade.phpなど）。その場合への対処として以下を記述した。
        children[4].addEventListener("click", () => {
            // trの子Nodeのうち上から6番目のtdタグをクリック➡5番目のそれをクリックした扱いにしてしまうことで（シュミレートすることで）detailOpenの付け外しを達成している。
            children[5].click();
        });
    });

    // 全アコーディオンの開閉を制御している。
    AllplanDetailButton.addEventListener("click", () => {
        // 表示されている開閉ボタンのアイコンに応じて処理を分岐。
        if (AllplanDetailButtonChild.className === "fa-solid fa-unlock") {
            // 上記と同じくtrs(class="tr"のついた全てのNode)の各Nodeにアクセスしている。
            trs.forEach((tr) => {
                // 計画概要のtrタグのclass属性が何もなく，かつclass="tr"のtrタグにdetailOpen（class属性値）が付いていない時。
                if (tr.nextElementSibling.className === "" && tr.className === "tr") {
                    // 計画概要のtrタグとclass="tr"のtrタグ両方にdetailOpen（class属性値）を追加している。
                    tr.nextElementSibling.classList.add("detailOpen");
                    tr.classList.add("detailOpen");
                } else if (
                    tr.nextElementSibling.className === "" &&
                    tr.className === "tr detailOpen"
                ) {
                    // こちらは計画概要のtrタグのclass属性には何も付いていないが，class="tr"のtrタグにdetailOpen（class属性値）が付いている場合。
                    // class="tr"のtrタグの方にはdetailOpen（class属性値）を追加する必要はない。
                    tr.nextElementSibling.classList.add("detailOpen");
                }
            });
        } else {
            // 上記と同じくtrs(class="tr"のついた全てのNode)の各Nodeにアクセスしている。
            trs.forEach((tr) => {
                // 計画概要のtrタグのclass属性がdetailOpenであり，かつclass="tr"のtrタグにdetailOpen（class属性値）が付いていない時。
                if (tr.nextElementSibling.className === "detailOpen" && tr.className === "tr") {
                    // 計画概要のtrタグの方にだけclass="detailOpen"を取り除けばOK。
                    tr.nextElementSibling.classList.remove("detailOpen");
                } else if (
                    tr.nextElementSibling.className === "detailOpen" &&
                    tr.className === "tr detailOpen"
                ) {
                    // こちらは計画概要のtrタグとclass="tr"のtrタグ両方のdetailOpen（class属性値）を取り除いている。
                    tr.nextElementSibling.classList.remove("detailOpen");
                    tr.classList.remove("detailOpen");
                }
            });
        }

        // 開閉と同時にボタンのアイコンを変更。font Awesome。
        // 開く前はロックのアイコン。開いた後はアンロックのアイコン。
        if (AllplanDetailButtonChild.className === "fa-solid fa-unlock") {
            AllplanDetailButtonChild.className = "fa-solid fa-lock";
        } else {
            AllplanDetailButtonChild.className = "fa-solid fa-unlock";
        }
    });

    /* =================================================== */
    // ページトップへ遷移するボタン（アニメーション）の実装。IntersectionObserverAPI。
    /* =================================================== */

    /* callback関数の定義。 */
    // 自由に関数を作ってOK。作った関数をIntersectionObserverのインスタンス生成時に第一引数として代入すること。
    //（交差済み或いは交差前）要素の情報（IntersectionObserverEntry）はentriesで受け取ることが出来る。監視対象として指定した全ての要素の情報が引数として渡される。
    function onScrollCallback(entries) {
        // entriesに複数の値が格納されていることを想定してforEach文を使用しているが，今回は監視対象1つなのでわざわざforEachを使わなくても良い。
        entries.forEach((entry) => {
            // 条件式の意味➡entry（今回は空タグ）が交差済みでかつ現在進行形で交差されていない時（通り過ぎた時）,{}を実行する。
            // 空のdiv要素（Node, entry）が交差していない＝もう交差し終わったことを意味する（そもそもこの関数が処理されている時点で一度交差されているわけだから交差済みと判断できる）。
            // 空タグはヘッダーのナビゲーションリンク真下に位置しているのでナビゲーションリンクがスクロールによって画面からほぼ見えなくなったと同時に条件が満たされる。
            if (!entry.isIntersecting) {
                // class="scrolled"の追加。これにより「.wrapper #to_top.scrolled{}」が読み込まれる。
                toTop.classList.add("scrolled");
                // 「計画一覧」「完了履歴」「ゴミ箱」においてレコード数が0件の際には全アコーディオンを開閉するボタンを表示させないようにしている。
                if (!trs.length < 1) {
                    // 上記に同じ。これにより「.wrapper #AllplanDetailButton.scrolled{}」が読み込まれる。AllplanDetailButton（Node）はアコーディオンの実装にてDOM操作済み（全アコーディオンを開閉するボタン）。
                    AllplanDetailButton.classList.add("scrolled");
                }
                // 上記に同じ。これにより，「.wrapper #sub-left-panel-button.scrolled{}」が読み込まれる。subLeftPanelButton（Node）はサイドパネルの実装にてDOM操作済み。
                subLeftPanelButton.classList.add("scrolled");
            } else {
                // class="scrolled"が取り除かれる。これによりボタンが透明になる。
                toTop.classList.remove("scrolled");
                // 「計画一覧」「完了履歴」「ゴミ箱」においてレコード数が0件の際には全アコーディオンを開閉するボタンを表示させないようにしている。
                if (!trs.length < 1) {
                    // 上記に同じ。AllplanDetailButton（Node）はアコーディオンにてDOM操作済み（全アコーディオンを開閉するボタン）。
                    AllplanDetailButton.classList.remove("scrolled");
                }
                // 上記に同じ。subLeftPanelButton（Node）はサイドパネルの実装にてDOM操作済み。
                subLeftPanelButton.classList.remove("scrolled");
            }
        });
    }

    /* DOM操作。 */
    const toTop = document.getElementById("to_top");

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
    onScrollObserver.observe(document.getElementById("monitored"));

    /* 遷移するスピードの調整。 */
    // IntersectionObserverAPIとは無関係なので注意。
    toTop.addEventListener("click", (e) => {
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
            behavior: "smooth",
        });
    });

    /* =================================================== */
    // モーダルウインドウの実装その１。
    /* =================================================== */

    /* DOM操作。これはその2でも使用する。 */
    const mask = document.getElementById("mask");

    // ＊以下で使用しているtrs（NodeList）はアコーディオンの実装時にDOM操作済み。
    // trsの各Node（class="tr"のついたtrタグ）にforEach文でアクセス。
    trs.forEach((tr) => {
        // tr（class="tr"のついたtrタグ）の子Nodeを全て取得。今回は直下のtdタグを全て取得。
        let children = tr.children;
        // id="modalWindowOpen"のtdタグ（ダミーの「完了する」ボタン）がクリックされた時。
        children[1].addEventListener("click", () => {
            // tr（class="tr"のついたtrタグ）の兄弟要素のうち，一個前の更に一個前のNode（id="modalWindow"，モーダルウインドウその１の方）のclassListにアクセス。
            // モーダルウインドウ部分を表示させるため。
            tr.previousElementSibling.previousElementSibling.classList.remove("hidden");
            // マスク部分を表示させるため。
            mask.classList.remove("hidden");
        });
        // マスク部分がクリックされた時。
        mask.addEventListener("click", () => {
            // class="hidden"を追加することで再度モーダルウインドウ部分（その１）とマスク部分を非表示にしている。
            tr.previousElementSibling.previousElementSibling.classList.add("hidden");
            mask.classList.add("hidden");
        });
        // 「キャンセル」ボタンがクリックされた時。「キャンセル」ボタンは#modalWindowの子要素[0]（td）の子要素[1]（div）の子要素[0]（span）に位置している。
        tr.previousElementSibling.previousElementSibling.children[0].children[1].children[0].addEventListener(
            "click",
            () => {
                // マスク部分がクリックされた時と同じ挙動。
                mask.click();
            }
        );
    });

    /* =================================================== */
    // モーダルウインドウの実装その２。
    /* =================================================== */

    // ＊以下で使用しているtrs（NodeList）はアコーディオンの実装時にDOM操作済み。
    // trsの各Node（class="tr"のついたtrタグ）にforEach文でアクセス。
    trs.forEach((tr) => {
        // tr（class="tr"のついたtrタグ）の子Nodeを全て取得。今回は直下のtdタグを全て取得。
        let children = tr.children;
        // 先頭の子Node（「編集する」ボタン）がクリックされた時。（追記）只今全ページカーソルキー移動実装中。
        children[0].children[0].addEventListener("click", () => {
            // tr（class="tr"のついたtrタグ）の兄弟要素のうち，一個前のNode（id="subModalWindow）のclassListにアクセス。
            // モーダルウインドウ部分を表示させるため。
            tr.previousElementSibling.classList.remove("hidden");
            // マスク部分を表示させるため。
            mask.classList.remove("hidden");
        });
        // マスク部分がクリックされた時。
        mask.addEventListener("click", () => {
            // class="hidden"を追加することで再度モーダルウインドウ部分とマスク部分を非表示にしている。
            tr.previousElementSibling.classList.add("hidden");
            mask.classList.add("hidden");
            // モーダルウインドウ部分とマスク部分非表示後に、計画作成欄のテーマにフォーカスが当たるようにしている。
            titleInput.focus();
        });
        // 「戻る」ボタンがクリックされた時。
        tr.previousElementSibling.children[0].children[2].addEventListener("click", () => {
            mask.click();
            // モーダルウインドウ部分とマスク部分非表示後に、計画作成欄のテーマにフォーカスが当たるようにしている。
            titleInput.focus();
        });

        tr.previousElementSibling.children[0].children[1].addEventListener("click", () => {
            // デバック用。
            console.log("hoge");

            // ユーザーに削除の最終確認を取っている。
            if (!confirm("本当に中断しますか？")) {
                // キャンセルを押下した場合は早期リターンで以降の処理をスキップ。
                return;
            }

            // 本命の削除ボタンをクリック扱いにしている。
            tr.previousElementSibling.children[0].children[3].children[0].click();
        });

        // 条件式➡class="tr"のtrタグによって，相対的にアクセスされたid="subModalWindow"のtrタグの先頭の子Node（td）の先頭の子Node（form）内の子Nodeの全個数をカウントし，12個かどうか判定。
        // 計画編集のエラーメッセージをダイアログで一括して出すのではなく，各カラムごとに表示させる場合は下記条件分岐が必要になる。
        // すなわち，エラーメッセージの個数分，子Nodeの相対位置がずれるのでその対策をしている。
        // lengthが13の時はエラーメッセージが一切無いとき。
        // if (tr.previousElementSibling.children[0].children[0].children.length == 13) {
        //     // class="tr"のtrタグによって，相対的にアクセスされたid="subModalWindow"のtrタグの先頭の子Node（td）の先頭の子Node（form）の先頭から12番目のタグ（配列の添え字番号の形式なので1ずれている）にアクセスし，それがクリックされた時の挙動を命令している。
        //     tr.previousElementSibling.children[0].children[0].children[11].addEventListener(
        //         "click",
        //         () => {
        //             // デバック用。
        //             /* console.log('hoge'); */

        //             // ユーザーに削除の最終確認を取っている。
        //             if (!confirm("本当に削除しますか？")) {
        //                 // キャンセルを押下した場合は早期リターンで以降の処理をスキップ。
        //                 return;
        //             }

        //             // class="tr"のtrタグによって，相対的にアクセスされたid="subModalWindow"のtrタグの先頭の子Node（td）の先頭から2番目の子Node（form）にアクセスし，クリックした扱いにしている。クリックしたのは「削除」ボタン（本命）。
        //             tr.previousElementSibling.children[0].children[1].children[0].click();
        //         }
        //     );
        //     // lengthが14の時はエラーメッセージが1個表示されているとき（種類は問わない）。
        // } else if (tr.previousElementSibling.children[0].children[0].children.length === 14) {
        //     // class="tr"のtrタグによって，相対的にアクセスされたid="subModalWindow"のtrタグの先頭の子Node（td）の先頭の子Node（form）の先頭から13番目（エラーメッセージ1個分ずれた）のタグ（配列の添え字番号の形式なので1ずれている）にアクセスし，それがクリックされた時の挙動を命令している。
        //     tr.previousElementSibling.children[0].children[0].children[12].addEventListener(
        //         "click",
        //         () => {
        //             // デバック用。
        //             /* console.log('hoge'); */

        //             // ユーザーに削除の最終確認を取っている。
        //             if (!confirm("本当に削除しますか？")) {
        //                 // キャンセルを押下した場合は早期リターンで以降の処理をスキップ。
        //                 return;
        //             }

        //             // class="tr"のtrタグによって，相対的にアクセスされたid="subModalWindow"のtrタグの先頭の子Node（td）の先頭から2番目の子Node（form）にアクセスし，クリックした扱いにしている。クリックしたのは「削除」ボタン（本命）。
        //             tr.previousElementSibling.children[0].children[1].children[0].click();
        //         }
        //     );
        //     // lengthが15の時はエラーメッセージが2個表示されているとき（種類は問わない）。
        // } else if (tr.previousElementSibling.children[0].children[0].children.length === 15) {
        //     // class="tr"のtrタグによって，相対的にアクセスされたid="subModalWindow"のtrタグの先頭の子Node（td）の先頭の子Node（form）の先頭から14番目（エラーメッセージ2個分ずれた）のタグ（配列の添え字番号の形式なので1ずれている）にアクセスし，それがクリックされた時の挙動を命令している。
        //     tr.previousElementSibling.children[0].children[0].children[13].addEventListener(
        //         "click",
        //         () => {
        //             // デバック用。
        //             /* console.log('hoge'); */

        //             // ユーザーに削除の最終確認を取っている。
        //             if (!confirm("本当に削除しますか？")) {
        //                 // キャンセルを押下した場合は早期リターンで以降の処理をスキップ。
        //                 return;
        //             }

        //             // class="tr"のtrタグによって，相対的にアクセスされたid="subModalWindow"のtrタグの先頭の子Node（td）の先頭から2番目の子Node（form）にアクセスし，クリックした扱いにしている。クリックしたのは「削除」ボタン（本命）。
        //             tr.previousElementSibling.children[0].children[1].children[0].click();
        //         }
        //     );
        // }

        // デバック用。以下のようにchildrenの中身を確認することで参考にしよう。
        // tr.previousElementSibling.children[0].children[0].addEventListener('click', () => {
        //     console.log(tr.previousElementSibling.children[0].children[0].children);
        // });
    });

    /* =================================================== */
    // 「GoodJob」通知のアニメーション。
    /* =================================================== */

    // 以下のメソッドはバックエンドの処理によって, id="success-msg"のdivタグが表示された際に実行される。
    function fadeOut1() {
        // 早期リターン。
        if (!successMsg) {
            return;
        }
        // 「.wrapper #success-msg.none{}」を読み込むため。
        successMsg.classList.add("none");
    }

    // 以下のメソッドはバックエンドの処理によって, id="success-msg"のdivタグが表示された際に実行される。
    function fadeOut2() {
        // 早期リターン。
        if (!nonKeywordError) {
            return;
        }
        // 「.wrapper #success-msg.none{}」を読み込むため。
        nonKeywordError.classList.add("none");
    }

    /* DOM操作。 */
    const successMsg = document.getElementById("success-msg");
    const nonKeywordError = document.getElementById("non-keyword-error");
    // 2.5秒後に以下の関数が実行される。
    setTimeout(fadeOut1, 2500);
    setTimeout(fadeOut2, 2500);

    /* =================================================== */
    // カーソルキー移動。
    /* =================================================== */

    /* DOM操作。 */
    // 作成欄に関してのみDOM操作を行う。編集欄は以前利用したtr（class="tr"）を使って相対的なアクセスを行う。
    const textareaInput = document.querySelector(".textarea-input");
    const createButton = document.querySelector(".create-button");

    /* フラグのセット。 */
    let flg = false;

    // -----作成欄-----

    // -----titleInputからtextareaInputに移動-----

    // キーボートがタイプされた時にkeydownイベントとkeyupイベントが発生する。
    // テーマ入力欄においてキーボード入力があったとき。
    titleInput.addEventListener("keydown", (e) => {
        // イベントオブジェクトの中に先程ユーザーがタイプしたキーが格納されている。
        // タイプされたキーが下矢印で，かつ選択中の現在地点がテーマ入力欄の末尾だった時（何も入力していなければ末尾扱い，何か入力していればその文字列の末尾に相当する）。また，末尾をvalueのlengthで表現している（末尾＝欄内の文字列の最後＝長さ）。
        if (e.code == "ArrowDown" && titleInput.selectionStart == titleInput.value.length) {
            // フラグを反転。下で使用。
            flg = true;
        }
    });

    // テーマ入力欄においてキーボード入力があったとき。keydownとkeyup両方でイベントリスナーを作るのは，1つだけの場合，フォーカスとフォーカス地点指定の両方の処理が正常に動作しないため。
    titleInput.addEventListener("keyup", (e) => {
        // もう一度入力されたキーが下矢印であるのを確認し，さらにフラグが反転しているか（trueか）判定している。
        if (e.code == "ArrowDown" && flg) {
            // フラグを元に戻しておく。
            flg = false;
            // 概要入力欄へフォーカス。
            textareaInput.focus();
            // フォーカスされる位置を指定（選択中の現在地点の指定）。今回は末尾に指定した。
            textareaInput.setSelectionRange(textareaInput.value.length, textareaInput.value.length);
        }
    });

    // -----textareaInputからtitleInputに移動-----

    // 以下も上記と同じ処理。setSelectionRangeに注意。
    textareaInput.addEventListener("keydown", (e) => {
        if (e.code == "ArrowUp" && textareaInput.selectionStart == 0) {
            flg = true;
        }
    });

    textareaInput.addEventListener("keyup", (e) => {
        if (e.code == "ArrowUp" && flg) {
            flg = false;
            titleInput.focus();
            titleInput.setSelectionRange(titleInput.value.length, titleInput.value.length);
        }
    });

    // -----textareaInputからcreateButtonに移動-----

    textareaInput.addEventListener("keydown", (e) => {
        if (e.code == "ArrowDown" && textareaInput.selectionStart == textareaInput.value.length) {
            flg = true;
        }
    });

    textareaInput.addEventListener("keyup", (e) => {
        if (e.code == "ArrowDown" && flg) {
            flg = false;
            createButton.focus();
        }
    });

    // -----createButtonからtextareaInputに移動-----

    createButton.addEventListener("keydown", (e) => {
        if (e.code == "ArrowUp") {
            flg = true;
        }
    });

    createButton.addEventListener("keyup", (e) => {
        if (e.code == "ArrowUp" && flg) {
            flg = false;
            textareaInput.focus();
            textareaInput.setSelectionRange(textareaInput.value.length, textareaInput.value.length);
        }
    });

    // ---ページを読み込んだ時、計画作成欄のテーマ入力フォームにフォーカスが当たるようにするため。
    titleInput.focus();

    // -----編集欄とページ内カーソルキー移動-----

    // -----注意点-----
    // tr.previousElementSibling.children[0].children[0].children[3]はテーマ入力欄（inputタグ）を指している。
    // tr.previousElementSibling.children[0].children[0].children[9]は概要入力欄（textareaタグ）を指している。
    // tr.previousElementSibling.children[0].children[0].children[10]は更新ボタンを指している。
    // tr.previousElementSibling.children[0].children[1]は削除ボタンを指している。
    // tr.previousElementSibling.children[0].children[2]は戻るボタンを指している。

    // モーダルウィンドウの際と同じ手順。tr（class="tr"のついたtrタグ）にアクセスしている。「num = 0」はページ内カーソルキー移動の際に使用。一意のクラス名を各レコードに命名するため。
    trs.forEach((tr, num = 0) => {
        // trの子Nodeを取得している。
        let children = tr.children;

        /* 編集欄 */

        // 編集ボタンをクリックしたらテーマ欄にフォーカスされるようにするため。
        children[0].addEventListener("click", () => {
            // フォーカス。
            tr.previousElementSibling.children[0].children[0].children[3].focus();
            // フォーカス後の選択中の現在地点の指定をしている。今回は末尾に選択されるようにした。実際の挙動を確認してほしい。
            tr.previousElementSibling.children[0].children[0].children[3].setSelectionRange(
                tr.previousElementSibling.children[0].children[0].children[3].value.length,
                tr.previousElementSibling.children[0].children[0].children[3].value.length
            );
        });

        // テーマから概要へ移動。
        tr.previousElementSibling.children[0].children[0].children[3].addEventListener(
            "keydown",
            (e) => {
                if (
                    // 入力されたカーソルキーが下矢印で，かつテーマ入力欄において末尾の位置が選択中だった時。
                    e.code == "ArrowDown" &&
                    tr.previousElementSibling.children[0].children[0].children[3].selectionStart ==
                        tr.previousElementSibling.children[0].children[0].children[3].value.length
                ) {
                    // フラグを反転。
                    flg = true;
                }
            }
        );

        tr.previousElementSibling.children[0].children[0].children[3].addEventListener(
            "keyup",
            (e) => {
                if (e.code == "ArrowDown" && flg) {
                    flg = false;
                    tr.previousElementSibling.children[0].children[0].children[9].focus();
                    tr.previousElementSibling.children[0].children[0].children[9].setSelectionRange(
                        tr.previousElementSibling.children[0].children[0].children[9].value.length,
                        tr.previousElementSibling.children[0].children[0].children[9].value.length
                    );
                }
            }
        );

        // 概要からテーマへ移動。

        tr.previousElementSibling.children[0].children[0].children[9].addEventListener(
            "keydown",
            (e) => {
                if (
                    e.code == "ArrowUp" &&
                    tr.previousElementSibling.children[0].children[0].children[9].selectionStart ==
                        0
                ) {
                    flg = true;
                }
            }
        );

        tr.previousElementSibling.children[0].children[0].children[9].addEventListener(
            "keyup",
            (e) => {
                if (e.code == "ArrowUp" && flg) {
                    flg = false;
                    tr.previousElementSibling.children[0].children[0].children[3].focus();
                    tr.previousElementSibling.children[0].children[0].children[3].setSelectionRange(
                        tr.previousElementSibling.children[0].children[0].children[3].value.length,
                        tr.previousElementSibling.children[0].children[0].children[3].value.length
                    );
                }
            }
        );

        // 概要から更新ボタンへ移動。

        tr.previousElementSibling.children[0].children[0].children[9].addEventListener(
            "keydown",
            (e) => {
                if (
                    e.code == "ArrowDown" &&
                    tr.previousElementSibling.children[0].children[0].children[9].selectionStart ==
                        tr.previousElementSibling.children[0].children[0].children[9].value.length
                ) {
                    flg = true;
                }
            }
        );

        tr.previousElementSibling.children[0].children[0].children[9].addEventListener(
            "keyup",
            (e) => {
                if (e.code == "ArrowDown" && flg) {
                    flg = false;
                    tr.previousElementSibling.children[0].children[0].children[10].focus();
                }
            }
        );

        // 更新ボタンから概要へ移動。

        tr.previousElementSibling.children[0].children[0].children[10].addEventListener(
            "keydown",
            (e) => {
                if (e.code == "ArrowUp") {
                    flg = true;
                }
            }
        );

        tr.previousElementSibling.children[0].children[0].children[10].addEventListener(
            "keyup",
            (e) => {
                if (e.code == "ArrowUp" && flg) {
                    flg = false;
                    tr.previousElementSibling.children[0].children[0].children[9].focus();
                    tr.previousElementSibling.children[0].children[0].children[9].setSelectionRange(
                        tr.previousElementSibling.children[0].children[0].children[9].value.length,
                        tr.previousElementSibling.children[0].children[0].children[9].value.length
                    );
                }
            }
        );

        // 更新ボタンから削除ボタンへ移動。
        tr.previousElementSibling.children[0].children[0].children[10].addEventListener(
            "keydown",
            (e) => {
                if (e.code == "ArrowRight") {
                    flg = true;
                }
            }
        );

        tr.previousElementSibling.children[0].children[0].children[10].addEventListener(
            "keyup",
            (e) => {
                if (e.code == "ArrowRight" && flg) {
                    flg = false;
                    tr.previousElementSibling.children[0].children[1].focus();
                }
            }
        );

        // 削除ボタンから更新ボタンへ移動。

        tr.previousElementSibling.children[0].children[1].addEventListener("keydown", (e) => {
            if (e.code == "ArrowLeft") {
                flg = true;
            }
        });

        tr.previousElementSibling.children[0].children[1].addEventListener("keyup", (e) => {
            if (e.code == "ArrowLeft" && flg) {
                flg = false;
                tr.previousElementSibling.children[0].children[0].children[10].focus();
            }
        });

        // 削除ボタンから戻るボタンへ移動。

        tr.previousElementSibling.children[0].children[1].addEventListener("keydown", (e) => {
            if (e.code == "ArrowRight") {
                flg = true;
            }
        });

        tr.previousElementSibling.children[0].children[1].addEventListener("keyup", (e) => {
            if (e.code == "ArrowRight" && flg) {
                flg = false;
                tr.previousElementSibling.children[0].children[2].focus();
            }
        });

        // 戻るボタンから削除するボタンへ移動。

        tr.previousElementSibling.children[0].children[2].addEventListener("keydown", (e) => {
            if (e.code == "ArrowLeft") {
                flg = true;
            }
        });

        tr.previousElementSibling.children[0].children[2].addEventListener("keyup", (e) => {
            if (e.code == "ArrowLeft" && flg) {
                flg = false;
                tr.previousElementSibling.children[0].children[1].focus();
            }
        });

        // 削除ボタンから概要へ移動。

        tr.previousElementSibling.children[0].children[1].addEventListener("keydown", (e) => {
            if (e.code == "ArrowUp") {
                flg = true;
            }
        });

        tr.previousElementSibling.children[0].children[1].addEventListener("keyup", (e) => {
            if (e.code == "ArrowUp" && flg) {
                flg = false;
                tr.previousElementSibling.children[0].children[0].children[9].focus();
                tr.previousElementSibling.children[0].children[0].children[9].setSelectionRange(
                    tr.previousElementSibling.children[0].children[0].children[9].value.length,
                    tr.previousElementSibling.children[0].children[0].children[9].value.length
                );
            }
        });

        // 戻るボタンから概要へ移動。

        tr.previousElementSibling.children[0].children[2].addEventListener("keydown", (e) => {
            if (e.code == "ArrowUp") {
                flg = true;
            }
        });

        tr.previousElementSibling.children[0].children[2].addEventListener("keyup", (e) => {
            if (e.code == "ArrowUp" && flg) {
                flg = false;
                tr.previousElementSibling.children[0].children[0].children[9].focus();
                tr.previousElementSibling.children[0].children[0].children[9].setSelectionRange(
                    tr.previousElementSibling.children[0].children[0].children[9].value.length,
                    tr.previousElementSibling.children[0].children[0].children[9].value.length
                );
            }
        });

        /* ページ内カーソルキー移動 */

        // 各レコードを特定するために一意のクラス名を命名している。デベロッパーツール参照。

        // 各レコードの編集ボタンに一意のクラス名を命名。
        children[0].children[0].classList.add(`edit-number${num}`);

        // 各レコードの完了ボタンに一意のクラス名を命名。
        children[1].children[0].classList.add(`done-number${num}`);

        // 各レコードの編集ボタンから計画作成欄のテーマへ移動。

        document.querySelector(`.edit-number${num}`).addEventListener("keydown", (e) => {
            if (e.code == "ArrowLeft") {
                flg = true;
            }
        });

        document.querySelector(`.edit-number${num}`).addEventListener("keyup", (e) => {
            if (e.code == "ArrowLeft" && flg) {
                flg = false;
                titleInput.focus();
            }
        });

        // レコード間移動。下に降りる。編集ボタン間移動。

        document.querySelector(`.edit-number${num}`).addEventListener("keydown", (e) => {
            if (e.code == "ArrowDown") {
                flg = true;
            }
        });

        document.querySelector(`.edit-number${num}`).addEventListener("keyup", (e) => {
            if (e.code == "ArrowDown" && flg) {
                flg = false;

                // 現在の位置が末尾レコードまで達した場合に下矢印キーをタイプすると先頭レコードに戻る仕様。
                if (num === trs.length - 1) {
                    // 先頭レコードに移動。
                    document.querySelector(`.edit-number0`).focus();
                } else {
                    document.querySelector(`.edit-number${num + 1}`).focus();
                }
            }
        });

        // レコード間移動。下に降りる。完了ボタン間移動。

        document.querySelector(`.done-number${num}`).addEventListener("keydown", (e) => {
            if (e.code == "ArrowDown") {
                flg = true;
            }
        });

        document.querySelector(`.done-number${num}`).addEventListener("keyup", (e) => {
            if (e.code == "ArrowDown" && flg) {
                flg = false;

                // 現在の位置が末尾レコードまで達した場合に下矢印キーをタイプすると先頭レコードに戻る仕様。
                if (num === trs.length - 1) {
                    // 先頭レコードに移動。
                    document.querySelector(`.done-number0`).focus();
                } else {
                    document.querySelector(`.done-number${num + 1}`).focus();
                }
            }
        });

        // レコード間移動。上に上がる。編集ボタン間移動。

        document.querySelector(`.edit-number${num}`).addEventListener("keydown", (e) => {
            if (e.code == "ArrowUp") {
                flg = true;
            }
        });

        document.querySelector(`.edit-number${num}`).addEventListener("keyup", (e) => {
            if (e.code == "ArrowUp" && flg) {
                flg = false;

                // 現在の位置が先頭レコードの場合に上矢印キーをタイプすると末尾レコードに移動する仕様。
                if (num === 0) {
                    // 末尾レコードに移動。
                    document.querySelector(`.edit-number${trs.length - 1}`).focus();
                } else {
                    document.querySelector(`.edit-number${num - 1}`).focus();
                }
            }
        });

        // レコード間移動。上に上がる。完了ボタン間移動。

        document.querySelector(`.done-number${num}`).addEventListener("keydown", (e) => {
            if (e.code == "ArrowUp") {
                flg = true;
            }
        });

        document.querySelector(`.done-number${num}`).addEventListener("keyup", (e) => {
            if (e.code == "ArrowUp" && flg) {
                flg = false;

                // 現在の位置が先頭レコードの場合に上矢印キーをタイプすると末尾レコードに移動する仕様。
                if (num === 0) {
                    // 末尾レコードに移動。
                    document.querySelector(`.done-number${trs.length - 1}`).focus();
                } else {
                    document.querySelector(`.done-number${num - 1}`).focus();
                }
            }
        });

        // レコード内移動。右に移る。
        document.querySelector(`.edit-number${num}`).addEventListener("keydown", (e) => {
            if (e.code == "ArrowRight") {
                flg = true;
            }
        });

        document.querySelector(`.edit-number${num}`).addEventListener("keyup", (e) => {
            if (e.code == "ArrowRight" && flg) {
                flg = false;

                document.querySelector(`.done-number${num}`).focus();
            }
        });

        // レコード内移動。左に移る。
        document.querySelector(`.done-number${num}`).addEventListener("keydown", (e) => {
            if (e.code == "ArrowLeft") {
                flg = true;
            }
        });

        document.querySelector(`.done-number${num}`).addEventListener("keyup", (e) => {
            if (e.code == "ArrowLeft" && flg) {
                flg = false;

                document.querySelector(`.edit-number${num}`).focus();
            }
        });
    });

    // 計画作成欄のテーマ入力フォームから先頭レコードの編集ボタンへ移動。

    titleInput.addEventListener("keydown", (e) => {
        // イベントオブジェクトの中に先程ユーザーがタイプしたキーが格納されている。
        // タイプされたキーが右矢印で，かつ選択中の現在地点がテーマ入力欄の末尾だった時（何も入力していなければ末尾扱い，何か入力していればその文字列の末尾に相当する）。また，末尾をvalueのlengthで表現している（末尾＝欄内の文字列の最後＝長さ）。
        if (e.code == "ArrowRight" && titleInput.selectionStart == titleInput.value.length) {
            // フラグを反転。下で使用。
            flg = true;
        }
    });

    titleInput.addEventListener("keyup", (e) => {
        // もう一度入力されたキーが右矢印であるのを確認し，さらにフラグが反転しているか（trueか）判定している。
        if (e.code == "ArrowRight" && flg) {
            // フラグを元に戻しておく。
            flg = false;
            document.querySelector(".edit-number0").focus();
        }
    });

    // 計画作成欄の概要から先頭レコードの編集ボタンへ移動。

    textareaInput.addEventListener("keydown", (e) => {
        if (e.code == "ArrowRight" && textareaInput.selectionStart == textareaInput.value.length) {
            flg = true;
        }
    });

    textareaInput.addEventListener("keyup", (e) => {
        if (e.code == "ArrowRight" && flg) {
            flg = false;
            if (trs.length >= 1) {
                document.querySelector(".edit-number0").focus();
            }
        }
    });

    // 計画作成欄の作成ボタンから先頭レコードの編集ボタンへ移動。

    createButton.addEventListener("keydown", (e) => {
        if (e.code == "ArrowRight") {
            flg = true;
        }
    });

    createButton.addEventListener("keyup", (e) => {
        if (e.code == "ArrowRight" && flg) {
            flg = false;
            if (trs.length >= 1) {
                document.querySelector(".edit-number0").focus();
            }
        }
    });

    // 加えてapp2.jsにもページ内移動を実装させる予定。
}
