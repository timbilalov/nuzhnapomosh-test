/**
 * Base64 (функции window.btoa & window.atob)
 *
 * NOTE: Вспомогательный модуль.
 * Нужен в основном для IE <= 9
 * (http://caniuse.com/#search=btoa)
 */
app.createModule("base64", function() {
    // Для современных браузеров - просто завершаем выполнение модуля
    if (typeof window.btoa === "function" && typeof window.atob === "function") {
        return false;
    }

    // Локальные переменные
    var module = this;
    var queue = [];
    var loaded = false;


    /**
     * Вызов всех функций, которые были добавлены
     * в массив queue в процессе загрузки библиотеки
     * (до этого момента их вызов привёл бы к ошибке).
     */
    var initQueue = function() {
        var qLen = queue.length;
        if (!qLen) {
            return;
        }

        while (queue.length > 0) {
            // Взять первый элемент массива,
            // и вызвать его. Мы уже знаем, что это функция,
            // поэтому доп. проверка не требуется.
            queue.shift()();
        }

        DEBUG && console.log("[module base64] initialized " + qLen + " functions in queue");
    };


    /**
     * Добавление переданной функции в очередь на выполнение,
     * либо немедленное исполнение функции, если библиотека уже загружена.
     *
     * @param {function} func
     */
    var addEvent = function(func) {
        if (typeof func !== "function") {
            return;
        }

        // Если библиотека ещё не загружена, то добавляем в очередь
        if (!loaded) {
            queue.push(func);
            DEBUG && console.log("[module base64] function added to queue, count of functions to init now: " + queue.length);

        // Если уже загружена, то просто вызываем переданную функцию
        } else {
            func();
            DEBUG && console.log("[module base64] function fired immediately");
        }
    };


    /**
     * Грузим библиотеку из CDN
     * (локальная версия - в качестве fallback'а),
     * после чего вызываем функции, которые были отложены в массив queue
     */
    app.loadScript("//cdnjs.cloudflare.com/ajax/libs/Base64/1.0.1/base64.min.js", "/assets/scripts/base64.min.js", function() {
        DEBUG && console.log("[module base64] script loaded. now you can use window.atob and window.btoa functions");
        loaded = true;
        initQueue();
    });


    // Доступ к фукциям
    // текущего модуля
    module.addEvent = addEvent;
});