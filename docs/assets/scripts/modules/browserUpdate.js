/* globals Raven, $buoop, $buo, $buo_show */
/* eslint camelcase:0 */

/**
 * Ненавязчивая плашка, которая оповестит пользователя о том,
 * что его браузер устарел и нуждается в обновлении.
 * https://browser-update.org/
 *
 * NOTE: Для нормальных браузеров данная плашка, понятное дело, не отображается.
 * Но посмотреть, как она выглядит, можно, выполнив в консоли код:
 * $buo({}, true);
 */
app.createModule("browserUpdate", ["pageLoad"], function() {

    // Локальные переменные
    var module = this;
    var isRavenOn = typeof window.Raven !== "undefined";


    /**
     * Запуск интервального таймера
     */
    var init = function() {
        /**
         * Функция, которая будет вызываться с определённым интервалом
         * до тех пор, пока скрипты с сайта browser-update.org не загрузятся и не отработают.
         */
        var intervalFunc = function() {
            // Так как нет прямого метода, позволяющего определить, отработали или нет скрипты browser-update.org,
            // то определяем косвенно, по наличию некоторой глобальной переменной.
            if (typeof $buoop === "undefined") {
                return;
            }

            // Один раз определив момент, когда скрипты browser-update.org отработали,
            // отменяем интервальный таймер.
            clearInterval(interval);

            // Три разных косвенных способа проверить, была ли пользователю
            // показана плашка с предупреждением об устаревшем браузере:
            var barShown1 = !!document.getElementById("buorg");
            var barShown2 = $buoop.test;
            var barShown3 = typeof $buo_show !== "undefined";

            // Необходимо, чтобы хотя бы один косвенный метод дал положительный результат,
            // тогда будем считать, что плашка, действительно, показана.
            var barShown = barShown1 || barShown2 || barShown3;


            // Если сам скрипт посчитал, что браузер не устаревший, хотя на самом деле
            // он не поддерживает некоторые функции, мы можем сами определить
            // дополнительные проверки, по результатам которых решим,
            // показывать или нет сообщение пользователю.
            var extaConditions = [];
            if (!barShown) {
                var fakeElem = document.createElement("div");

                // Проверка, поддерживает ли браузер операции classList.add, classList.remove и т. п.
                // (проверку провалят браузеры на android 2.3.6 и аналогичные динозавры)
                if (!("classList" in fakeElem) || !("add" in fakeElem.classList)) {
                    extaConditions.push("classList");
                }

                // Проверка, поддерживает ли браузер обработчик событий addEventListener
                // (проверку провалят старые IE)
                if (!("addEventListener" in document)) {
                    extaConditions.push("addEventListener");
                }

                // Проверка, поддерживает ли браузер методы window.btoa и window.atob,
                // которые нужны для преобразований base64
                // (проверку провалят старые IE)
                if (app.modules.base64 && app.modules.base64.initialized === true) {
                    extaConditions.push("base64");
                }

                // Если хотя бы одно из доп. условий сработало,
                // то показываем плашку с предложением обновить браузер.
                if (extaConditions.length > 0) {
                    $buo({}, true); // Показать предупреждение (принудительно)
                    barShown = true;
                    DEBUG && console.log("[module browserUpdate] bar shown by additional conditions");
                }
            }

            // Создаём объект с параметрами, которые мы передадим в js-логгер
            var barShownMessage = (barShown ? "shown" : "not shown");
            var extraContext = {};
            var key, value;

            for (key in $buoop) {
                value = $buoop[key];
                if ($buoop.hasOwnProperty(key) && typeof value !== "function") {
                    extraContext[key] = value;
                }
            }

            if (extaConditions.length > 0) {
                extraContext["extraConditions"] = extaConditions.join(", ");
            }

            // Отправить сообщение в js-логгер
            // (только в том случае, если плашка показана)
            if (isRavenOn && barShown) {
                Raven.captureMessage("[module browserUpdate] old browser detected", {
                    level: "info", // one of 'info', 'warning', or 'error'
                    extra: extraContext
                });
            }

            // Передать в остальные модули, где будет происходить отправка
            // сообщений в логгер, параметр browserUpdateBar (показана плашка или нет).
            if (isRavenOn) {
                Raven.setExtraContext({
                    browserUpdateBar: barShownMessage
                });
            }

            DEBUG && console.log("[module browserUpdate] object recieved. barShown: " + barShown + ". extraContext: ", extraContext);
            module.extraContext = extraContext;
            module.barShown = barShown;
        };

        // Выполняем функцию с определённым интервалом,
        // так как загрузка скрипта //browser-update.org/update.min.js -
        // это не тот самый момент, когда отрабатывает сам скрипт.
        // Дело в том, что там дальше по цепочке грузится ещё один скрипт, вот почему
        // мы не можем чётко отследить момент, когда всё-таки у нас прошла проверка на устаревшие браузеры.
        // Функция будет выполняться до тех пор,
        // пока не появится объект $buoop - признак того, что проверка произведена.
        var interval = setInterval(intervalFunc, 100);
    };


    /**
     * Грузим первоначальный скрипт с сайта browser-update.org
     * (локальная версия - в качестве fallback'а),
     * после чего запускаем наш интервальный таймер,
     * ловим момент загрузки второго скрипта и т. д.
     */
    var load = function() {
        app.loadScript("http://browser-update.org/update.min.js", "assets/scripts/browser-update.min.js", function() {
            DEBUG && console.log("[module browserUpdate] script loaded");
            init();
        });
    };


    // Делегируем функцию в модуль pageLoad
    // (откладываем выполнение до полной загрузки страницы)
    DEBUG && console.log("%c--[module browserUpdate] delegating load to pageLoad module", "font-style: italic; color: #999");
    app.modules.pageLoad.addEvent(load);
});