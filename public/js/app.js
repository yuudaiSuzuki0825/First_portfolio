/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (() => {



{
  /* =================================================== */
  // ページトップへ遷移するボタン（アニメーション）の実装。IntersectionObserverAPI。

  /* =================================================== */

  /* callback関数の定義。 */
  // 自由に関数を作ってOK。作った関数をIntersectionObserverのインスタンス生成時に第一引数として代入すること。
  //（交差済み或いは交差前）要素の情報（IntersectionObserverEntry）はentriesで受け取ることが出来る。監視対象として指定した全ての要素の情報が引数として渡される。
  var onScrollCallback = function onScrollCallback(entries) {
    // entriesに複数の値が格納されていることを想定してforEach文を使用しているが，今回は監視対象1つなのでわざわざforEachを使わなくても良い。
    entries.forEach(function (entry) {
      // 条件式の意味➡entry（今回は空タグ）が交差済みでかつ現在進行形で交差されていない時（通り過ぎた時）,{}を実行する。
      // 空のdiv要素（Node, entry）が交差していない＝もう交差し終わったことを意味する（そもそもこの関数が処理されている時点で一度交差されているわけだから交差済みと判断できる）。
      // 空タグはヘッダーのナビゲーションリンク真下に位置しているのでナビゲーションリンクがスクロールによって画面からほぼ見えなくなったと同時に条件が満たされる。
      if (!entry.isIntersecting) {
        // class="scrolled"の追加。これにより「.wrapper #to_top.scrolled{}」が読み込まれる。
        toTop.classList.add("scrolled"); // 「計画一覧」「完了履歴」「ゴミ箱」においてレコード数が0件の際には全アコーディオンを開閉するボタンを表示させないようにしている。

        if (!trs.length < 1) {
          // 上記に同じ。これにより「.wrapper #AllplanDetailButton.scrolled{}」が読み込まれる。AllplanDetailButton（Node）はアコーディオンの実装にてDOM操作済み（全アコーディオンを開閉するボタン）。
          AllplanDetailButton.classList.add("scrolled");
        } // 上記に同じ。これにより，「.wrapper #sub-left-panel-button.scrolled{}」が読み込まれる。subLeftPanelButton（Node）はサイドパネルの実装にてDOM操作済み。


        subLeftPanelButton.classList.add("scrolled");
      } else {
        // class="scrolled"が取り除かれる。これによりボタンが透明になる。
        toTop.classList.remove("scrolled"); // 「計画一覧」「完了履歴」「ゴミ箱」においてレコード数が0件の際には全アコーディオンを開閉するボタンを表示させないようにしている。

        if (!trs.length < 1) {
          // 上記に同じ。AllplanDetailButton（Node）はアコーディオンにてDOM操作済み（全アコーディオンを開閉するボタン）。
          AllplanDetailButton.classList.remove("scrolled");
        } // 上記に同じ。subLeftPanelButton（Node）はサイドパネルの実装にてDOM操作済み。


        subLeftPanelButton.classList.remove("scrolled");
      }
    });
  };
  /* DOM操作。 */


  /* =================================================== */
  // 「GoodJob」通知のアニメーション。

  /* =================================================== */
  // 以下のメソッドはバックエンドの処理によって, id="success-msg"のdivタグが表示された際に実行される。
  var fadeOut1 = function fadeOut1() {
    // 早期リターン。
    if (!successMsg) {
      return;
    } // 「.wrapper #success-msg.none{}」を読み込むため。


    successMsg.classList.add("none");
  }; // 以下のメソッドはバックエンドの処理によって, id="success-msg"のdivタグが表示された際に実行される。


  var fadeOut2 = function fadeOut2() {
    // 早期リターン。
    if (!nonKeywordError) {
      return;
    } // 「.wrapper #success-msg.none{}」を読み込むため。


    nonKeywordError.classList.add("none");
  };
  /* DOM操作。 */


  // ページごとに読み込むjsファイルを変更する必要がある（複数ファイルに分割すること）。

  /* =================================================== */
  // ハンバーガーメニューの実装。

  /* =================================================== */

  /* DOM操作 */
  var open = document.getElementById("open");
  var overlay = document.querySelector(".overlay");
  var close = document.getElementById("close"); // ハンバーガーメニューボタンをクリックした時。

  open.addEventListener("click", function () {
    // class="show"を追加している。
    // 「.header .overlay.show{}」を読み込むため。
    overlay.classList.add("show");
  }); // オーバーレイ画面の×ボタンがクリックされた時。

  close.addEventListener("click", function () {
    // class="show"を取り除いている。
    overlay.classList.remove("show");
  });
  /* =================================================== */
  // サイドパネルの実装。

  /* =================================================== */

  /* DOM操作 */

  var leftPanelButton = document.getElementById("left-panel-button");
  var subLeftPanelButton = document.getElementById("sub-left-panel-button");
  var leftPanel = document.getElementById("left-panel");
  var content = document.querySelector(".content");
  var titleInput = document.querySelector(".title-input"); // サイドパネルのボタンがクリックされた時。

  leftPanelButton.addEventListener("click", function () {
    // 各Nodeに対してclass="open"を追加している。
    // 「.wrapper .main-area #left-panel.open{}」を読み込むため。
    leftPanel.classList.toggle("open"); // 「.wrapper .main-area .content #left-panel-button.open i{}」を読み込むため。

    leftPanelButton.classList.toggle("open"); // 「.wrapper .main-area .content.open[}」を読み込むため。

    content.classList.toggle("open"); // サイドパネルをクリックした直後，即座にテーマ入力するのを手助けするため。押下と同時に入力欄にフォーカス。

    titleInput.focus();
  }); // 右側のサイドパネルボタンがクリックされた時。

  subLeftPanelButton.addEventListener("click", function () {
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

  var planListTitles = document.querySelectorAll(".planListTitle"); // 先程のNodeList（配列のように扱える）から各Node（各タグ）を取り出すためにforeach文を使用。
  // title1（自由に命名できる）から各Nodeにアクセスできる。

  planListTitles.forEach(function (title1) {
    // 各Node（今回はタブメニューの各タブ）がクリックされた時。
    title1.addEventListener("click", function () {
      // 再度先程のNodeListにアクセスした上で，一度全てのタブメニューの各タブ（h2タグ）からclass="active"を取り除いている。
      planListTitles.forEach(function (title2) {
        title2.classList.remove("active");
      }); // クリックされた対象（タブメニューの各タブ）に対してclass="active"を追加している。

      title1.classList.add("active");
    });
  });
  /* =================================================== */
  // アコーディオンの実装。（警告）trace.blade.phpにて致命的なバク発生。tdの個数のズレによるchildren[]の指定が原因。

  /* =================================================== */

  /* DOM操作。 */
  // class="tr"の付くタグのみ取得している。NodeList。

  var trs = document.querySelectorAll(".tr"); // 全アコーディオンを開閉するボタン。

  var AllplanDetailButton = document.getElementById("AllplanDetailButton"); // 全アコーディオンを開閉するボタンのアイコン。

  var AllplanDetailButtonChild = AllplanDetailButton.firstElementChild; // 挙動確認用。エラーメッセージがないのに思惑通り動かない場合はconsole.logなどを活用してどの箇所をデバックすれば良いか調べる作業を行おう。

  /* console.log('ok'); */

  trs.forEach(function (tr) {
    // childrenプロパティにより，tr（Node）の子Nodeを全て取得している。
    // 各Nodeには配列のように[]でアクセス出来る。
    // 今回はchildrenにはtdタグ（子Node）が要素として格納されているはずである。
    var children = tr.children; // デバック用。forEach文が機能しているか確認するため。

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

    children[5].addEventListener("click", function () {
      // デバック用。イベントリスナーが実行されているか確認するため。

      /* console.log('hoge'); */
      // デバック用。nextSiblingプロパティとnextElementSiblingプロパティの違いをコンソールにて確認してほしい。
      // classListにアクセスしたい場合は後者を選択すること。

      /* console.log(tr.nextSibling); */

      /* console.log(tr.nextElementSibling); */
      // tr（class="tr"の付いたtrタグ）の次の兄弟Nodeにアクセスし（今回はid="planDetailRow"の付いたtrタグ），class="detailOpen"の付け外しを行っている。
      // これにより#planDetailRow.detailOpen{display: block;}が読み込まれ，表示される。
      tr.nextElementSibling.classList.toggle("detailOpen"); // trにもclass="detailOpen"の付け外しの処理をしている。
      // これにより.tr.detailOpen{border-radius: 4px 4px 0 0;}が読み込まれる形になる。
      // また，.wrapper .main-area .content .content-area .table tbody .tr.detailOpen #planDetailButton i{}も読み込まれるのでアイコンが反転する。

      tr.classList.toggle("detailOpen");
    }); // trの子Nodeの数が1つ増える場合もある（index.blade.phpなど）。その場合への対処として以下を記述した。

    children[4].addEventListener("click", function () {
      // trの子Nodeのうち上から6番目のtdタグをクリック➡5番目のそれをクリックした扱いにしてしまうことで（シュミレートすることで）detailOpenの付け外しを達成している。
      children[5].click(); // デバック用。

      /* console.log("hoge"); */
    });
  }); // 全アコーディオンの開閉を制御している。

  AllplanDetailButton.addEventListener("click", function () {
    // 表示されている開閉ボタンのアイコンに応じて処理を分岐。
    if (AllplanDetailButtonChild.className === "fa-solid fa-unlock") {
      // デバック用。

      /* console.log('hoge1'); */
      // 上記と同じくtrs(class="tr"のついた全てのNode)の各Nodeにアクセスしている。
      trs.forEach(function (tr) {
        // デバック用。

        /* console.log('hoge2'); */
        // 計画概要のtrタグのclass属性が何もなく，かつclass="tr"のtrタグにdetailOpen（class属性値）が付いていない時。
        if (tr.nextElementSibling.className === "" && tr.className === "tr") {
          // デバック用。

          /* console.log('hoge3'); */
          // 計画概要のtrタグとclass="tr"のtrタグ両方にdetailOpen（class属性値）を追加している。
          tr.nextElementSibling.classList.add("detailOpen");
          tr.classList.add("detailOpen");
        } else if (tr.nextElementSibling.className === "" && tr.className === "tr detailOpen") {
          // こちらは計画概要のtrタグのclass属性には何も付いていないが，class="tr"のtrタグにdetailOpen（class属性値）が付いている場合。
          // class="tr"のtrタグの方にはdetailOpen（class属性値）を追加する必要はない。
          tr.nextElementSibling.classList.add("detailOpen");
        }
      });
    } else {
      // デバック用。

      /* console.log('hoge4'); */
      // 上記と同じくtrs(class="tr"のついた全てのNode)の各Nodeにアクセスしている。
      trs.forEach(function (tr) {
        // デバック用。

        /* console.log('hoge5'); */
        // 計画概要のtrタグのclass属性がdetailOpenであり，かつclass="tr"のtrタグにdetailOpen（class属性値）が付いていない時。
        if (tr.nextElementSibling.className === "detailOpen" && tr.className === "tr") {
          // デバック用。

          /* console.log('hoge6'); */
          // 計画概要のtrタグの方にだけclass="detailOpen"を取り除けばOK。
          tr.nextElementSibling.classList.remove("detailOpen");
        } else if (tr.nextElementSibling.className === "detailOpen" && tr.className === "tr detailOpen") {
          // こちらは計画概要のtrタグとclass="tr"のtrタグ両方のdetailOpen（class属性値）を取り除いている。
          tr.nextElementSibling.classList.remove("detailOpen");
          tr.classList.remove("detailOpen");
        }
      });
    } // 開閉と同時にボタンのアイコンを変更。font Awesome。
    // 開く前はロックのアイコン。開いた後はアンロックのアイコン。


    if (AllplanDetailButtonChild.className === "fa-solid fa-unlock") {
      AllplanDetailButtonChild.className = "fa-solid fa-lock";
    } else {
      AllplanDetailButtonChild.className = "fa-solid fa-unlock";
    }
  });
  var toTop = document.getElementById("to_top");
  /* インスタンス生成。 */
  // 上から順に読み進めてほしい…。
  // IntersectionObserverAPIの利用はIntersectionObserver（クラス）のインスタンスを生成する所から始まる。
  // 第一引数には関数（callback関数と呼ばれる，自分で自由に定義したものを挿入するのがメジャー）を代入する。
  // 第二引数にはthreshold（閾値）を代入する。省略可能（その場合，「threshold: 0;」が自動的に適用される）。
  // 代入されたcallback関数は予め指定した監視対象（要素）が”ある条件”を満たした場合に実行されるもの。これがこのAPIのメイン機能となる。
  // ある条件というのを指定しているのがthresholdである。
  // 例えば，「threshold: 0.2;」と指定した場合，0.2は20%を指すので「監視対象と画面が20%交差する」という挙動が”ある条件”として設定される。
  // 今回の例では，監視対象が画面と0%交差するとonScrollCallbackという関数が呼び出される。

  var onScrollObserver = new IntersectionObserver(onScrollCallback); // 具体的に要素を監視する方法については下記参照。

  /* observeメソッドの呼び出し。 */
  // 作成したIntersectionObserverのインスタンス変数からobserve()を呼び出している。
  // 引数には監視対象としたい要素（Node）を代入する。
  // 以下の記述が読み込まれて始めて，監視が実行される。
  // 今回監視対象に指定しているのは空タグである。空タグなので高さは0。

  onScrollObserver.observe(document.getElementById("monitored"));
  /* 遷移するスピードの調整。 */
  // IntersectionObserverAPIとは無関係なので注意。

  toTop.addEventListener("click", function (e) {
    // 既定の動作を止める働きがある。
    // 今回はaタグ（toTop）のhref="#"へと遷移する動作を停止している。
    e.preventDefault(); // href="#"へ遷移する動作を停止した代わりに，以下の指定によってページトップへ自動スクロールするようにしている。
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
  // モーダルウインドウの実装その１。

  /* =================================================== */

  /* DOM操作。これはその2でも使用する。 */

  var mask = document.getElementById("mask"); // ＊以下で使用しているtrs（NodeList）はアコーディオンの実装時にDOM操作済み。
  // trsの各Node（class="tr"のついたtrタグ）にforEach文でアクセス。

  trs.forEach(function (tr) {
    // tr（class="tr"のついたtrタグ）の子Nodeを全て取得。今回は直下のtdタグを全て取得。
    var children = tr.children; // id="modalWindowOpen"のtdタグ（ダミーの「完了する」ボタン）がクリックされた時。

    children[1].addEventListener("click", function () {
      // tr（class="tr"のついたtrタグ）の兄弟要素のうち，一個前の更に一個前のNode（id="modalWindow"，モーダルウインドウその１の方）のclassListにアクセス。
      // モーダルウインドウ部分を表示させるため。
      tr.previousElementSibling.previousElementSibling.classList.remove("hidden"); // マスク部分を表示させるため。

      mask.classList.remove("hidden");
    }); // マスク部分がクリックされた時。

    mask.addEventListener("click", function () {
      // class="hidden"を追加することで再度モーダルウインドウ部分（その１）とマスク部分を非表示にしている。
      tr.previousElementSibling.previousElementSibling.classList.add("hidden");
      mask.classList.add("hidden");
    }); // 「キャンセル」ボタンがクリックされた時。「キャンセル」ボタンは#modalWindowの子要素[0]（td）の子要素[1]（div）の子要素[0]（span）に位置している。

    tr.previousElementSibling.previousElementSibling.children[0].children[1].children[0].addEventListener("click", function () {
      // マスク部分がクリックされた時と同じ挙動。
      mask.click(); // デバック用。

      /* console.log('hoge'); */
    });
  });
  /* =================================================== */
  // モーダルウインドウの実装その２。

  /* =================================================== */
  // ＊以下で使用しているtrs（NodeList）はアコーディオンの実装時にDOM操作済み。
  // trsの各Node（class="tr"のついたtrタグ）にforEach文でアクセス。

  trs.forEach(function (tr) {
    // tr（class="tr"のついたtrタグ）の子Nodeを全て取得。今回は直下のtdタグを全て取得。
    var children = tr.children; // 先頭の子Node（「編集する」ボタン）がクリックされた時。

    children[0].addEventListener("click", function () {
      // tr（class="tr"のついたtrタグ）の兄弟要素のうち，一個前のNode（id="subModalWindow）のclassListにアクセス。
      // モーダルウインドウ部分を表示させるため。
      tr.previousElementSibling.classList.remove("hidden"); // マスク部分を表示させるため。

      mask.classList.remove("hidden");
    }); // マスク部分がクリックされた時。

    mask.addEventListener("click", function () {
      // class="hidden"を追加することで再度モーダルウインドウ部分とマスク部分を非表示にしている。
      tr.previousElementSibling.classList.add("hidden");
      mask.classList.add("hidden");
    }); // 「戻る」ボタンがクリックされた時。

    tr.previousElementSibling.children[0].children[2].addEventListener("click", function () {
      mask.click(); // デバック用。

      /* console.log('hogehoge'); */
    });
    tr.previousElementSibling.children[0].children[1].addEventListener("click", function () {
      // デバック用。
      console.log("hoge"); // ユーザーに削除の最終確認を取っている。

      if (!confirm("本当に中断しますか？")) {
        // キャンセルを押下した場合は早期リターンで以降の処理をスキップ。
        return;
      } // 本命の削除ボタンをクリック扱いにしている。


      tr.previousElementSibling.children[0].children[3].children[0].click();
    }); // 条件式➡class="tr"のtrタグによって，相対的にアクセスされたid="subModalWindow"のtrタグの先頭の子Node（td）の先頭の子Node（form）内の子Nodeの全個数をカウントし，12個かどうか判定。
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
  var successMsg = document.getElementById("success-msg");
  var nonKeywordError = document.getElementById("non-keyword-error"); // 2.5秒後に以下の関数が実行される。

  setTimeout(fadeOut1, 2500);
  setTimeout(fadeOut2, 2500);
  /* =================================================== */
  // カーソルキー移動。

  /* =================================================== */

  /* DOM操作。 */
  // 作成欄に関してのみDOM操作を行う。編集欄は以前利用したtr（class="tr"）を使って相対的なアクセスを行う。

  var textareaInput = document.querySelector(".textarea-input");
  var createButton = document.querySelector(".create-button");
  var flg = false; // -----作成欄-----
  // -----titleInputからtextareaInputに移動-----
  // キーボートがタイプされた時にkeydownイベントとkeyupイベントが発生する。
  // テーマ入力欄においてキーボード入力があったとき。

  titleInput.addEventListener("keydown", function (e) {
    // イベントオブジェクトの中に先程ユーザーがタイプしたキーが格納されている。
    // タイプされたキーが下矢印で，かつ選択中の現在地点がテーマ入力欄の末尾だった時（何も入力していなければ末尾扱い，何か入力していればその文字列の末尾に相当する）。また，末尾をvalueのlengthで表現している（末尾＝欄内の文字列の最後＝長さ）。
    if (e.code == "ArrowDown" && titleInput.selectionStart == titleInput.value.length) {
      // フラグを反転。下で使用。
      flg = true; // デバック用。

      console.log("hoge");
    }
  }); // テーマ入力欄においてキーボード入力があったとき。keydownとkeyup両方でイベントリスナーを作るのは，1つだけの場合，フォーカスとフォーカス地点指定の両方の処理が正常に動作しないため。

  titleInput.addEventListener("keyup", function (e) {
    // もう一度入力されたキーが下矢印であるのを確認し，さらにフラグが反転しているか（trueか）判定している。
    if (e.code == "ArrowDown" && flg) {
      // デバック用。
      console.log("hoge2"); // フラグを元に戻しておく。

      flg = false; // 概要入力欄へフォーカス。

      textareaInput.focus(); // フォーカスされる位置を指定（選択中の現在地点の指定）。今回は末尾に指定した。

      textareaInput.setSelectionRange(textareaInput.value.length, textareaInput.value.length);
    }
  }); // -----textareaInputからtitleInputに移動-----
  // 以下も上記と同じ処理。setSelectionRangeに注意。

  textareaInput.addEventListener("keydown", function (e) {
    if (e.code == "ArrowUp" && textareaInput.selectionStart == 0) {
      flg = true; // デバック用。

      console.log("hoge");
    }
  });
  textareaInput.addEventListener("keyup", function (e) {
    if (e.code == "ArrowUp" && flg) {
      // デバック用。
      console.log("hoge2");
      flg = false;
      titleInput.focus();
      titleInput.setSelectionRange(titleInput.value.length, titleInput.value.length);
    }
  }); // -----textareaInputからcreateButtonに移動-----

  textareaInput.addEventListener("keydown", function (e) {
    if (e.code == "ArrowDown" && textareaInput.selectionStart == textareaInput.value.length) {
      flg = true; // デバック用。

      console.log("hoge");
    }
  });
  textareaInput.addEventListener("keyup", function (e) {
    if (e.code == "ArrowDown" && flg) {
      // デバック用。
      console.log("hoge2");
      flg = false;
      createButton.focus();
    }
  }); // -----createButtonからtextareaInputに移動-----

  createButton.addEventListener("keydown", function (e) {
    if (e.code == "ArrowUp") {
      flg = true; // デバック用。

      console.log("hoge");
    }
  });
  createButton.addEventListener("keyup", function (e) {
    if (e.code == "ArrowUp" && flg) {
      // デバック用。
      console.log("hoge100");
      flg = false;
      textareaInput.focus();
      textareaInput.setSelectionRange(textareaInput.value.length, textareaInput.value.length);
    }
  }); // -----編集欄-----
  // -----注意点-----
  // tr.previousElementSibling.children[0].children[0].children[3]はテーマ入力欄（inputタグ）を指している。
  // tr.previousElementSibling.children[0].children[0].children[9]は概要入力欄（textareaタグ）を指している。
  // tr.previousElementSibling.children[0].children[0].children[10]は更新ボタンを指している。
  // tr.previousElementSibling.children[0].children[1]は削除ボタンを指している。
  // tr.previousElementSibling.children[0].children[2]は戻るボタンを指している。
  // モーダルウィンドウの際と同じ手順。tr（class="tr"のついたtrタグ）にアクセスしている。

  trs.forEach(function (tr) {
    // trの子Nodeを取得している。
    var children = tr.children; // 編集ボタンをクリックしたらテーマ欄にフォーカスされるようにするため。

    children[0].addEventListener("click", function () {
      // フォーカス。
      tr.previousElementSibling.children[0].children[0].children[3].focus(); // フォーカス後の選択中の現在地点の指定をしている。今回は末尾に選択されるようにした。実際の挙動を確認してほしい。

      tr.previousElementSibling.children[0].children[0].children[3].setSelectionRange(tr.previousElementSibling.children[0].children[0].children[3].value.length, tr.previousElementSibling.children[0].children[0].children[3].value.length);
    }); // テーマから概要へ移動。

    tr.previousElementSibling.children[0].children[0].children[3].addEventListener("keydown", function (e) {
      if ( // 入力されたカーソルキーが下矢印で，かつテーマ入力欄において末尾の位置が選択中だった時。
      e.code == "ArrowDown" && tr.previousElementSibling.children[0].children[0].children[3].selectionStart == tr.previousElementSibling.children[0].children[0].children[3].value.length) {
        // フラグを反転。
        flg = true; // デバック用。

        console.log("hoge");
      }
    });
    tr.previousElementSibling.children[0].children[0].children[3].addEventListener("keyup", function (e) {
      if (e.code == "ArrowDown" && flg) {
        // デバック用。
        console.log("hoge2");
        flg = false;
        tr.previousElementSibling.children[0].children[0].children[9].focus();
        tr.previousElementSibling.children[0].children[0].children[9].setSelectionRange(tr.previousElementSibling.children[0].children[0].children[9].value.length, tr.previousElementSibling.children[0].children[0].children[9].value.length);
      }
    }); // 概要からテーマへ移動。

    tr.previousElementSibling.children[0].children[0].children[9].addEventListener("keydown", function (e) {
      if (e.code == "ArrowUp" && tr.previousElementSibling.children[0].children[0].children[9].selectionStart == 0) {
        flg = true; // デバック用。

        console.log("hoge");
      }
    });
    tr.previousElementSibling.children[0].children[0].children[9].addEventListener("keyup", function (e) {
      if (e.code == "ArrowUp" && flg) {
        // デバック用。
        console.log("hoge2");
        flg = false;
        tr.previousElementSibling.children[0].children[0].children[3].focus();
        tr.previousElementSibling.children[0].children[0].children[3].setSelectionRange(tr.previousElementSibling.children[0].children[0].children[3].value.length, tr.previousElementSibling.children[0].children[0].children[3].value.length);
      }
    }); // 概要から更新ボタンへ移動。

    tr.previousElementSibling.children[0].children[0].children[9].addEventListener("keydown", function (e) {
      if (e.code == "ArrowDown" && tr.previousElementSibling.children[0].children[0].children[9].selectionStart == tr.previousElementSibling.children[0].children[0].children[9].value.length) {
        flg = true; // デバック用。

        console.log("hoge");
      }
    });
    tr.previousElementSibling.children[0].children[0].children[9].addEventListener("keyup", function (e) {
      if (e.code == "ArrowDown" && flg) {
        // デバック用。
        console.log("hoge2");
        flg = false;
        tr.previousElementSibling.children[0].children[0].children[10].focus();
      }
    }); // 更新ボタンから概要へ移動。

    tr.previousElementSibling.children[0].children[0].children[10].addEventListener("keydown", function (e) {
      if (e.code == "ArrowUp") {
        flg = true; // デバック用。

        console.log("hoge");
      }
    });
    tr.previousElementSibling.children[0].children[0].children[10].addEventListener("keyup", function (e) {
      if (e.code == "ArrowUp" && flg) {
        // デバック用。
        console.log("hoge100");
        flg = false;
        tr.previousElementSibling.children[0].children[0].children[9].focus();
        tr.previousElementSibling.children[0].children[0].children[9].setSelectionRange(tr.previousElementSibling.children[0].children[0].children[9].value.length, tr.previousElementSibling.children[0].children[0].children[9].value.length);
      }
    }); // 更新ボタンから削除ボタンへ移動。

    tr.previousElementSibling.children[0].children[0].children[10].addEventListener("keydown", function (e) {
      if (e.code == "ArrowRight") {
        flg = true; // デバック用。

        console.log("hoge110");
      }
    });
    tr.previousElementSibling.children[0].children[0].children[10].addEventListener("keyup", function (e) {
      if (e.code == "ArrowRight" && flg) {
        // デバック用。
        console.log("hoge111");
        flg = false;
        tr.previousElementSibling.children[0].children[1].focus();
        console.log("hoge112");
      }
    }); // 削除ボタンから更新ボタンへ移動。

    tr.previousElementSibling.children[0].children[1].addEventListener("keydown", function (e) {
      if (e.code == "ArrowLeft") {
        flg = true; // デバック用。

        console.log("hoge113");
      }
    });
    tr.previousElementSibling.children[0].children[1].addEventListener("keyup", function (e) {
      if (e.code == "ArrowLeft" && flg) {
        // デバック用。
        console.log("hoge114");
        flg = false;
        tr.previousElementSibling.children[0].children[0].children[10].focus();
        console.log("hoge115");
      }
    }); // 削除ボタンから戻るボタンへ移動。

    tr.previousElementSibling.children[0].children[1].addEventListener("keydown", function (e) {
      if (e.code == "ArrowRight") {
        console.log("hoge116");
        flg = true;
      }
    });
    tr.previousElementSibling.children[0].children[1].addEventListener("keyup", function (e) {
      if (e.code == "ArrowRight" && flg) {
        console.log("hoge117");
        flg = false;
        tr.previousElementSibling.children[0].children[2].focus();
      }
    }); // 戻るボタンから削除するボタンへ移動。

    tr.previousElementSibling.children[0].children[2].addEventListener("keydown", function (e) {
      if (e.code == "ArrowLeft") {
        console.log("hoge118");
        flg = true;
      }
    });
    tr.previousElementSibling.children[0].children[2].addEventListener("keyup", function (e) {
      if (e.code == "ArrowLeft" && flg) {
        console.log("hoge119");
        flg = false;
        tr.previousElementSibling.children[0].children[1].focus();
      }
    }); // 削除ボタンから概要へ移動。

    tr.previousElementSibling.children[0].children[1].addEventListener("keydown", function (e) {
      if (e.code == "ArrowUp") {
        flg = true; // デバック用。

        console.log("hoge120");
      }
    });
    tr.previousElementSibling.children[0].children[1].addEventListener("keyup", function (e) {
      if (e.code == "ArrowUp" && flg) {
        // デバック用。
        console.log("hoge121");
        flg = false;
        tr.previousElementSibling.children[0].children[0].children[9].focus();
        tr.previousElementSibling.children[0].children[0].children[9].setSelectionRange(tr.previousElementSibling.children[0].children[0].children[9].value.length, tr.previousElementSibling.children[0].children[0].children[9].value.length);
      }
    }); // 戻るボタンから概要へ移動。

    tr.previousElementSibling.children[0].children[2].addEventListener("keydown", function (e) {
      if (e.code == "ArrowUp") {
        flg = true; // デバック用。

        console.log("hoge122");
      }
    });
    tr.previousElementSibling.children[0].children[2].addEventListener("keyup", function (e) {
      if (e.code == "ArrowUp" && flg) {
        // デバック用。
        console.log("hoge123");
        flg = false;
        tr.previousElementSibling.children[0].children[0].children[9].focus();
        tr.previousElementSibling.children[0].children[0].children[9].setSelectionRange(tr.previousElementSibling.children[0].children[0].children[9].value.length, tr.previousElementSibling.children[0].children[0].children[9].value.length);
      }
    });
  }); // ------------------------
  // console.log(Laravel.name);
  // console.log(Laravel.array);
}

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/sass/app.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;