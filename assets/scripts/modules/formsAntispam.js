/**
 * Добавление скрытых антиспам-полей в формы на сайте
 *
 * NOTE: Здесь используется модуль app.modules.base64,
 * но перечислять его в качестве зависимости не обязательно,
 * т. к. логика работы текущего модуля позволяет обойтись без зависимости.
 */
app.createModule("formsAntispam", function() {
    // Выбраны будут только те формы, у которых уже есть одно скрытое
    // поле с антиспам-кодом, полученным из php.
    // Другие формы (в т. ч. те, которые не надо проверять на спам),
    // будут проигнорированы.
    var forms = $("form").filter(function() {
        return $(this).find("[name='antispam']").length > 0;
    });
    if (!forms.length) {
        return false;
    }

    // Локальные переменные
    var antispamElemAppendDelay = 2000;


    /**
     * Вспомогательная функция, которая является подстраховкой
     * на случай, если не определена функция window.btoa
     * (нужна для base64-преобразований).
     * Для нормальных браузеров переданная функция будет исполнена сразу,
     * для старых - сначала загружена библиотека base64.js, и только затем выполнена функция.
     *
     * @param  {function} func
     */
    var checkBase64AndFire = function(func) {
        if (typeof func !== "function") {
            return;
        }

        // Для нормальных браузеров - функция будет вызвана сразу
        if (typeof window.btoa === "function") {
            func();

        // Для старых браузеров - выполнение функции откладывается
        } else if (app.modules.base64 && typeof app.modules.base64.addEvent === "function") {
            app.modules.base64.addEvent(func);

        // Случай, если что-то пошло не так (например, отсутствует модуль app.modules.base64)
        } else {
            DEBUG && console.log("%c[module formsAntispam] something went wrong with window.btoa function. check your code and loaded files!", "color: red");
        }
    };


    /**
     * Проходимся по всем формам, для каждой
     * определяем свою область видимости, свои функции вставки скрытых полей и т. д.
     */
    forms.each(function() {
        var form = $(this);

        var antispam1Value = form.find("[name='antispam']").val();
        var antispam1ValuePart1 = antispam1Value.substring(0, antispam1Value.indexOf("."));
        var antispam1ValuePart2 = antispam1Value.substring(antispam1Value.indexOf(".") + 1);

        var appendFirstAntispamElem = function() {
            var f = function() {
                var antispamValue = window.btoa(antispam1ValuePart1 + "5d41402abc4b2a76b9719d911017c592");
                var antispamElem = $("<input type=\"hidden\" name=\"antispam2\" value=\"" + antispamValue + "\">");
                DEBUG && console.log("%c[module formsAntispam] first antispam element appended. antispamValue: " + antispamValue, "font-style: italic; color: orange;");
                form.append(antispamElem);
            };

            checkBase64AndFire(f);
        };

        var appendSecondAntispamElem = function() {
            var f = function() {
                var antispamValue = window.btoa(antispam1ValuePart2 + "7d793037a0760186574b0282f2f435e7");
                var antispamElem = $("<input type=\"hidden\" name=\"antispam3\" value=\"" + antispamValue + "\">");
                DEBUG && console.log("%c[module formsAntispam] second antispam element appended. antispamValue: " + antispamValue, "font-style: italic; color: orange;");
                form.append(antispamElem);
            };

            checkBase64AndFire(f);
        };

        // Первое скрытое поле будет добавлено после определённого таймаута
        // (но при этом не требует от пользователя каких-либо действий)
        setTimeout(appendFirstAntispamElem, antispamElemAppendDelay);

        // Второе скрытое поле добавляется только после определённого
        // действия пользователя:
        // предполагаем, что любой пользователь перед отправкой формы переводит фокус
        // на одно из полей формы
        // (трудно представить, что есть механизм, вставляющий все данные формы
        // и одновременно производящий субмит).
        form.one("focus", "input:not([type='submit']), textarea, select", appendSecondAntispamElem);
    });
});