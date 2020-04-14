
$(function(){

  var maxChars = 255;
  var textLength = 0;
  var comment = "";
  var outOfChars = 'You have reached the limit of ' + maxChars + ' characters';

  /* initalize for when no data is in localStorage */
  var count = maxChars;
  $('#characterLeft').text(count + ' characters left');

  /* fix val so it counts carriage returns */
  $.valHooks.textarea = {
    get: function(e) {
      return e.value.replace(/\r?\n/g, "\r\n");
    }
  };

  function checkCount() {
    textLength = $('textarea').val().length;
    if (textLength >= maxChars) {
      $('#characterLeft').text(outOfChars);
    }
    else {
      count = maxChars - textLength;
      $('#characterLeft').text(count + ' characters left');
    }
  }

  /* on keyUp: update #characterLeft as well as count & comment in localStorage */
  $('textarea').keyup(function() {
    checkCount();
    comment = $(this).val();
    localStorage.setItem("comment", comment);
  });

  /* on pageload: get check for comment text in localStorage, if found update comment & count */
  if (localStorage.getItem("comment") != null) {
    $('#comment').text(localStorage.getItem("comment"));
    checkCount();
  }

  let menu = document.querySelector(".menu");
let button = document.querySelector(".menu__button");

toggleMenu = () => {
  menu.classList.toggle("open");
}

button.addEventListener("click", function() {
  clearInterval(interactionPreview);
  toggleMenu();
});

let interactionPreview = setInterval(() => {
  toggleMenu();
}, 2000)


});





//form submit





document.addEventListener('DOMContentLoaded', () => {
  PopupMenu.init();
});

/**
 * ポップアップメニュー
 * @constructor
 * @param {HTMLElement} elem ポップアップメニュー全体の親要素
 * @property {HTMLElement} opener 開くボタン
 * @property {HTMLElement} closer 閉じるボタン
 * @property {HTMLElement} menu メニュー要素
 */
function PopupMenu(elem) {
  this.opener = elem.querySelector('.js-popup-open');
  this.closer = elem.querySelector('.js-popup-close');
  this.menu = elem.querySelector('.js-popup-menu');
  
  this.handleOpen();
  this.handleClose();
}

/**
 * 開く動作をクリックイベントに登録
 */
PopupMenu.prototype.handleOpen = function() {
  this.opener.addEventListener('click', this.open.bind(this));
};

/**
 * 閉じる動作をクリックイベントに登録
 */
PopupMenu.prototype.handleClose = function() {
  this.closer.addEventListener('click', this.close.bind(this));
};

/**
 * 開く
 */
PopupMenu.prototype.open = function() {
  this.menu.classList.add('is-open');
};

/**
 * 閉じる
 */
PopupMenu.prototype.close = function() {
  // 閉じるアニメーション用を表現するためのクラス
  this.menu.classList.add('is-closing');
  
  const that = this;

  // 閉じるアニメーションが終わってからis-openクラスを消去する
  // すぐis-openクラスを消去してしまうと、display: noneになり、
  // 閉じるアニメーションを見せられないため
  this.menu.addEventListener('animationend', function close() {
    // リスナー実行直後にリスナーを削除する
    // これをしないと、開くアニメーションの終了時にも
    // このリスナーが実行されてしまう
    that.menu.removeEventListener('animationend', close);
    that.menu.classList.remove('is-open');
    that.menu.classList.remove('is-closing');
  });
};

PopupMenu.init = function() {
  const popupMenus = document.querySelectorAll('.js-popup');
  popupMenus.forEach(elem => {
    new PopupMenu(elem);
  });
};

//send mail

