/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
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


{
  /* =================================================== */
  // ページトップへ遷移するボタン（アニメーション）の実装。

  /* =================================================== */
  // とりあえず完成。コメント残しをお願いします。

  /* callback関数の定義。 */
  var onScrollCallback = function onScrollCallback(entries) {
    entries.forEach(function (entry) {
      if (!entry.isIntersecting) {
        toTop.classList.add('scrolled');
      } else {
        toTop.classList.remove('scrolled');
      }
    });
  };

  /* =================================================== */
  // ハンバーガーメニューの実装。

  /* =================================================== */

  /* DOM操作 */
  var open = document.getElementById('open');
  var overlay = document.querySelector('.overlay');
  var close = document.getElementById('close'); // ハンバーガーメニューボタンをクリックした時。

  open.addEventListener('click', function () {
    // class="show"を追加している。
    // 「.header .overlay.show{}」を読み込むため。
    overlay.classList.add('show');
  }); // オーバーレイ画面の×ボタンがクリックされた時。

  close.addEventListener('click', function () {
    // class="show"を取り除いている。
    overlay.classList.remove('show');
  });
  /* =================================================== */
  // サイドパネルの実装。

  /* =================================================== */

  /* DOM操作 */

  var leftPanelButton = document.getElementById('left-panel-button');
  var leftPanel = document.getElementById('left-panel'); // サイドパネルのボタンがクリックされた時。

  leftPanelButton.addEventListener('click', function () {
    // 各Nodeに対してclass="open"を追加している。
    // 「.wrapper .main-area #left-panel.open{}」を読み込むため。
    leftPanel.classList.toggle('open'); // 「.wrapper .main-area .content #left-panel-button.open i{}」を読み込むため。

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

  var planListTitles = document.querySelectorAll('.planListTitle'); // 先程のNodeList（配列のように扱える）から各Node（各タグ）を取り出すためにforeach文を使用。
  // title1（自由に命名できる）から各Nodeにアクセスできる。

  planListTitles.forEach(function (title1) {
    // 各Node（今回はタブメニューの各タブ）がクリックされた時。
    title1.addEventListener('click', function () {
      // 再度先程のNodeListにアクセスした上で，一度全てのタブメニューの各タブ（h2タグ）からclass="active"を取り除いている。
      planListTitles.forEach(function (title2) {
        title2.classList.remove('active');
      }); // クリックされた対象（タブメニューの各タブ）に対してclass="active"を追加している。

      title1.classList.add('active');
    });
  });
  /* =================================================== */
  // アコーディオンの実装。

  /* =================================================== */

  /* DOM操作。 */
  // class="tr"の付くタグのみ取得している。NodeList。

  var trs = document.querySelectorAll('.tr'); // 挙動確認用。エラーメッセージがないのに思惑通り動かない場合はconsole.logなどを活用してどの箇所をデバックすれば良いか調べる作業を行おう。
  // console.log('ok');

  trs.forEach(function (tr) {
    // childrenプロパティにより，tr（Node）の子Nodeを全て取得している。
    // 各Nodeには配列のように[]でアクセス出来る。
    // 今回はchildrenにはtdタグ（子Node）が要素として格納されているはずである。
    var children = tr.children; // デバック用。forEach文が機能しているか確認するため。

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

    children[4].addEventListener('click', function () {
      // デバック用。イベントリスナーが実行されているか確認するため。

      /* console.log('ok'); */
      // デバック用。nextSiblingプロパティとnextElementSiblingプロパティの違いをコンソールにて確認してほしい。
      // classListにアクセスしたい場合は後者を選択すること。

      /* console.log(tr.nextSibling); */

      /* console.log(tr.nextElementSibling); */
      // tr（class="tr"の付いたtrタグ）の次の兄弟Nodeにアクセスし（今回はid="planDetailRow"の付いたtrタグ），class="detailOpen"の付け外しを行っている。
      // これにより#planDetailRow.detailOpen{display: block;}が読み込まれ，表示される。
      tr.nextElementSibling.classList.toggle('detailOpen'); // trにもclass="detailOpen"の付け外しの処理をしている。
      // これにより.tr.detailOpen{border-radius: 4px 4px 0 0;}が読み込まれる形になる。

      tr.classList.toggle('detailOpen');
    });
  });
  ;
  /* DOM操作。 */

  var toTop = document.getElementById('to_top');
  /* インスタンス生成。 */

  var onScrollObserver = new IntersectionObserver(onScrollCallback);
  /* observeメソッドの呼び出し。 */

  onScrollObserver.observe(document.getElementById('monitored'));
  /* 遷移するスピードの調整。 */

  toTop.addEventListener('click', function (e) {
    e.preventDefault();
    window.scroll({
      top: 0,
      behavior: "smooth"
    }); // scroll()やscrollTo()以外にも特定の位置までスクロールしてくれるメソッドがある。
    // window.scrollBy(0, -window.innerHeight);
  });
}

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\TaskManagement\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\xampp\TaskManagement\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });