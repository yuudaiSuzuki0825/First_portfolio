'use strict';

{
    // JavaScriptファイル分割を当初行おうとしていた。

    /* =================================================== */
    // モーダルウインドウの実装。
    /* =================================================== */

    /* DOM操作 */
    const mask = document.getElementById('mask');
    const modalWindow = document.getElementById('modalWindow');
    const modalWindowOpenButton = document.getElementById('modalWindowOpenButton');
    const cancelButton = document.getElementById('cancelButton');

    // edit.blade.php用。内容は上記に同じ。
    modalWindowOpenButton.addEventListener('click', () => {
        modalWindow.classList.remove('hidden');
        mask.classList.remove('hidden');
    });

    // edit.blade.php用。内容は上記に同じ。
    mask.addEventListener('click', () => {
        modalWindow.classList.add('hidden');
        mask.classList.add('hidden');
    });

    // edit.blade.php用。内容は上記に同じ。
    cancelButton.addEventListener('click', () => {
        mask.click();
    });
}