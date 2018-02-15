/**
 * Общий модуль для всех лисалок на сайте.
 * Библиотека загружается по мере необходимости.
 */
app.createModule("slidersLibrary", function() {

    // Локальные переменные
    var module = this;
    var queue = [];
    var libraryLoaded = false;
    var loadingStarted = false;


    /**
     * Вызов всех функций, которые были добавлены
     * в массив queue в процессе загрузки библиотеки
     * (до этого момента их вызов привёл бы к ошибке).
     */
    var initQueue = function() {
        if (!libraryLoaded) {
            return false;
        }

        var qLen = queue.length;
        if (!qLen) {
            return;
        }

        DEBUG && console.log("[module slidersLibrary] initQueue function fired, queue.length: " + qLen);

        while (queue.length > 0) {
            // Взять первый элемент массива,
            // и вызвать его. Мы уже знаем, что это функция,
            // поэтому доп. проверка не требуется.
            queue.shift()();
        }
    };


    /**
     * Загрузить библиотеку и выполнить
     * отложенные функции из массива queue.
     */
    var loadAndInit = function() {
        var f = function() {
            libraryLoaded = true;
            initQueue();
        };

        // Случай, если библиотека вдруг уже загружена
        // (например, если она принудительна вставлена в html через <script>)
        if (typeof window.Swiper !== "undefined") {
            f();

        } else {
            app.loadStyle("//cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css");
            app.loadScript("//cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js", function() {
                DEBUG && console.log("[module slidersLibrary] library loaded, ready to init queue");
                f();

            // Fallback на случай, если что-то произошло с CDN
            }, function() {
                app.loadStyle("/assets/scripts/swiper-3.3.1/css/swiper.min.css");
                app.loadScript("/assets/scripts/swiper-3.3.1/js/swiper.min.js", function() {
                    DEBUG && console.log("[module slidersLibrary] library FINALLY loaded, ready to init queue");
                    f();
                });
            });
        }
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
        if (!libraryLoaded) {

            // Если библиотека ещё не начала грузиться, то загружаем её
            // (причём откладываем загрузку библиотеки до полной загрузки самой страницы).
            if (!loadingStarted) {
                loadingStarted = true;
                DEBUG && console.log("%c--[module slidersLibrary] first function added. delegating loadAndInit to pageLoad module (or firing if page already loaded)", "font-style: italic; color: #999");
                app.modules.pageLoad.addEvent(loadAndInit);
            }

            queue.push(func);
            DEBUG && console.log("[module slidersLibrary] function added, count of functions to init now: " + queue.length);

        // Если библиотека уже загружена, то просто вызываем переданную функцию
        } else {
            func();
        }
    };


    // Доступ к фукциям
    // текущего модуля
    module.addEvent = addEvent;
});