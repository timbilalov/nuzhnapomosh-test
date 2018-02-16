/**
 * Мобильное меню
 *
 * NOTE: Модуль можно удалить, если на сайте предусмотрено
 * принципиально иное меню для мобильных устройств.
 */
app.createModule("mobMenu", ["windowScroll"], function() {
    var parentClass = "js-mobmenu";
    var parent = $("." + parentClass);
    if (!parent.length) {
        return false;
    }

    // Локальные переменные
    var toggleBtns = $(".js-mobmenu-toggle");
    var openedClass = "is-opened";
    var activeClass = "is-active";
    var opened = false;
    var $body = app.commonVars.$body;
    var expandedBlocks = $(".js-mobmenu-expand");


    var openMenu = function() {
        if (opened) {
            return;
        }
        opened = true;

        toggleBtns.addClass(activeClass);
        parent.addClass(openedClass);
        DEBUG && console.log("[module mobMenu] menu opened");
    };


    var closeMenu = function() {
        if (!opened) {
            return;
        }
        opened = false;

        toggleBtns.removeClass(activeClass);
        parent.removeClass(openedClass);
        DEBUG && console.log("[module mobMenu] menu closed");
    };


    var toggleBtnClick = function() {
        if (opened) {
            closeMenu();
        } else {
            openMenu();
        }
    };


    /**
     * Обработчик события пролистывания страницы.
     * Мы будем скрывать меню, если пользователь начал листать страницу вниз.
     *
     * @param  {number} y Текущее значение прокрутки страницы
     */
    var scrollController = function(y) {
        if (!opened) {
            return;
        }
        // Значение уже придёт нам из модуля app.modules.windowScroll,
        // но на всякий случай пропишем fallback.
        y = typeof y === "number" ? y : document.body.scrollTop || document.documentElement.scrollTop;

        var menuHeight = parent.outerHeight() + expandedBlocks.outerHeight();

        if (y > menuHeight + 20) {
            closeMenu();
        }
    };


    /**
     * Как и в случае со всплывашками на сайте,
     * для меню, если мы видим оставшуюся часть страницы, и кликаем по затемнённой области,
     * то пользователь интуитивно ожидает, что меню закроется.
     * Данный обработчик как раз для этого.
     *
     * @param  {object} e Event
     */
    var bodyClick = function(e) {
        if (!opened) {
            return;
        }

        var target = $(e.target);
        var hasParent = target.closest("." + parentClass).length > 0;

        // Закрываем меню, только если клик произошёл
        // по элементу вне пределов родительского блока
        // (по сути - клик по любой точке экрана, кроме меню).
        if (!hasParent) {
            closeMenu();

            // Отмена действия по умолчанию
            // (например, чтобы не произошёл переход по ссылке, если
            // мы кликнули по элементу <a>).
            return false;
        }
    };


    // Привязка событий и функций-обработчиков
    toggleBtns.on("click", toggleBtnClick);
    $body.on("click", bodyClick);

    // NOTE: Выловили нелепый баг, на айпадике.
    // Без строчки ниже не срабатывало событие click у верхнего элемента body.
    // Говно, дерьмо, жопа :D
    app.commonVars.$wrapper.on("click", function() {});


    // Делегируем функцию в модуль windowScroll
    // (единая точка входа для события "scroll").
    DEBUG && console.log("%c--[module mobMenu] delegating scrollController to windowScroll module", "font-style: italic; color: #999");
    app.modules.windowScroll.addEvent(scrollController);
});