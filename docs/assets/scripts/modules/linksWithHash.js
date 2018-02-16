/* globals Raven */

/**
 * Отмена действия по умолчанию для ссылок с атрибутом href="#".
 * В нашей заготовки таковыми являются ссылки, для которых предполагается реальный href,
 * но который на вёрстке ещё не известен.
 * Если не отменить для таких ссылок действие по умолчанию,
 * то при клике страница перепрыгнет на самый верх, а в адресной строке появится #.
 *
 * NOTE: Также данный модуль отправляет сообщения в логгер, если подобные ссылки
 * найдены на продакт-сервере (там вместо # должны быть проставлены реальные адреса).
 */
app.createModule("linksWithHash", function() {
    var links = document.querySelectorAll("a[href='#']");
    if (!links.length) {
        return false;
    }

    DEBUG && console.log("%c[module linksWithHash] " + links.length + " links with href='#' found. is it ok for this page?? maybe you need to replace '#' with normal link? check it.", "color: orange");
    var isLocal = app.isLocal;


    /**
     * Простой обрабочик, который отменяет действие по умолчанию
     *
     * @param  {object} e Event
     */
    var linksWithHashHandler = function(e) {
        e.preventDefault();
        DEBUG && console.log("[module linksWithHash] default action prevented for link");
    };


    // Привязка функций к событиям
    for (var i = 0, len = links.length, link; i < len; i++) {
        link = links[i];
        link.addEventListener("click", linksWithHashHandler, false);
    }


    // Если на боевом сервере найдены ссылки с атрибутом href="#",
    // то отправляем в логгер сообщение об ошибке,
    // так как там уже должны быть настоящие ссылки вместо заглушек.
    if (typeof Raven !== "undefined" && !isLocal) {
        var extra = {};

        // Формируем объект, в котором перечислены все найденные ссылки,
        // причём с указанием их html-кода
        // (для того, чтобы можно было определить, какие именно ссылки найдены, точно ли это ошибка или нет)
        Array.prototype.forEach.call(links, function(link, index) {
            var html = link.outerHTML;
            extra["link" + (index + 1)] = html;
        });

        Raven.captureMessage("[module linksWithHash] links with href='#' found", {
            level: "warning", // one of 'info', 'warning', or 'error'
            extra: extra
        });
    }
});