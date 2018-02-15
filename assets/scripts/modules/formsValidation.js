/**
 * Валидация форм с помощью библиотеки:
 * http://parsleyjs.org/
 *
 * NOTE: ajax-отправка формы обрабатывается в этом модуле
 */
app.createModule("formsValidation", ["pageLoad"], function() {
    var forms = $(".js-form-validate");
    if (!forms.length) {
        return false;
    }

    // Локальные переменные
    var errorMsgWrapperClass = "form__error-msg";
    var serverErrorMsgWrapperClass = "form__err";
    var inputWrapperClass = "form__input-wrapper";
    var defaultParsleyOptions = {
        errorClass: "is-error",
        successClass: "is-success",
        errorsWrapper: "<div class=\"" + errorMsgWrapperClass + "\"></div>",
        classHandler: function(ParsleyField) {
            return ParsleyField.$element.closest("." + inputWrapperClass);
        },
        errorTemplate: "<div></div>"
    };
    var $document = app.commonVars.$document;
    var state2Class = "is-state-2";
    var sendingClass = "is-sending";
    var state2HideDelay = 4000;
    var serverErrorsClass = "js-form-errors";
    var dAttrAjaxSubmit = "data-ajax-submit";


    /**
     * Инициализация сущности Parsley
     * + обработка ajax-отправки для каждой из форм.
     * Данная функция будет отложена до момента загрузки библиотеки.
     */
    var init = function() {
        forms.each(function() {
            var form = $(this);

            var ajaxSubmit = function() {
                return form.attr(dAttrAjaxSubmit) === "true";
            };

            var success = function() {
                DEBUG && console.log("[module formsValidation] validation success");
            };

            var error = function() {
                DEBUG && console.log("[module formsValidation] validation error");
            };

            var submit = function() {
                DEBUG && console.log("[module formsValidation] validation submit");

                // Для форм без ajax-отправки, завершаем выполнение
                // текущей функции, тем самым произойдёт действие по умолчанию для формы
                // (данные будут отправлены с перезагрузкой страницы).
                if (!ajaxSubmit()) {
                    return;
                }

                var popup = form.closest(".popup");
                var formAction = form.attr("action");
                var formMethod = form.attr("method");
                var ajaxRecieved = false;
                var data = form.serializeArray();
                DEBUG && console.log("[module formsValidation] serialized data:");
                DEBUG && console.log(data);

                // Вспомогательная функция (helper)
                var singleClose = function() {
                    setTimeout(unsetState2, 500);
                };

                /**
                 * Вывод сообщения об успешной отправке формы
                 */
                var setState2 = function() {
                    DEBUG && console.log("[module formsValidation] set state-2");

                    // Данный класс скрывает один блок у формы,
                    // и отображает другой.
                    form.addClass(state2Class);

                    // Если форма находится на всплывашке, то вешаем
                    // однократное срабатывание на закрытие всплывашки.
                    // И одновременно начинаем таймер, чтобы через некоторое время
                    // сообщение об ошибке скрылось.
                    // Таким образом, не важно, пользователь сам закроет вслывашку
                    // (быстрее, чем сработает таймер), или она закроется автоматически,
                    // функция singleClose отработает всего лишь один раз.
                    if (popup.length) {
                        popup.one("popups:close", singleClose);
                        setTimeout(function() {
                            popup.trigger("popups:close");
                        }, state2HideDelay);

                    // Если форма находится не на всплывашке,
                    // то ставим такой же таймер, но без привязки
                    // к событию закрытия всплывашки.
                    } else {
                        setTimeout(singleClose, state2HideDelay);
                    }
                };

                /**
                 * Вовзращает форму к исходному виду
                 * (скрывает сообщение об успешной отправке).
                 */
                var unsetState2 = function() {
                    DEBUG && console.log("[module formsValidation] unset state-2");
                    form.removeClass(state2Class);
                };

                /**
                 * Обработка ajax-запроса при отправке формы
                 * (когда ответ пришёл).
                 *
                 * @param  {string}   data
                 */
                var done = function(data) {
                    var newHtml = $("<div></div>");
                    newHtml.html(data);
                    var $data = newHtml;
                    // Ищем в пришедших данных элементы со служебным классом,
                    // в которых будет сообщение об ошибках
                    // (сообщения могут быть разные, и они формируются на сервере).
                    var serverErrorsElem = $data.find("." + serverErrorsClass);
                    DEBUG && console.log("[module formsValidation] ajax done. data.length: " + data.length + ". errorsFound: " + (serverErrorsElem.length > 0));

                    // Независимо ни от чего,
                    // удаляем предыдущие сообщения об ошибках со стороны сервера.
                    form.find("." + serverErrorsClass).remove();

                    // Если ошибок с сервера не пришло,
                    // значит форма прошла серверную валидацию и можно показывать
                    // пользователю сообщение об успешной отправке.
                    if (!serverErrorsElem.length) {
                        setState2();
                        form.data("validation-passed", "false");
                        // Обнуляем поля формы, так как мы со страницы никуда не уходили,
                        // а форма уже отправлена. Будет странно, если пользователь после
                        // успешной отправки увидит те же данные, введённые в форму.
                        // Подумает, что это баг, и отправит повторно.
                        form.trigger("reset");

                    // Если с сервера пришли ошибки, то вставляем их в форму
                    // и прокручиваем страницу, чтобы пользователь обратил внимание на ошибки.
                    } else {
                        form.prepend(serverErrorsElem.addClass(serverErrorMsgWrapperClass));

                        // Выбираем элемент, который будем скроллить
                        // (на случай, если форма находится на всплывашке).
                        var elemForScroll = popup.length ? popup : $document;
                        var scrTop = serverErrorsElem.offset().top - window.innerHeight / 2;
                        elemForScroll.animate({
                            scrollTop: scrTop
                        });
                    }
                };

                /**
                 * Обработчик ошибок ajax-запроса
                 * (когда ответ не пришёл).
                 *
                 * NOTE: Редкий случай, но в идеале можно
                 * сделать нормальный обработчик, вывести пользователю
                 * какое-либо полезное сообщение, и т. д.
                 *
                 * @param  {object} err
                 */
                var fail = function(err) {
                    DEBUG && console.log("[module formsValidation] ajax fail. error: ", err);
                };

                /**
                 * Функция, которая выполнится всегда,
                 * вне зависимости от того, пришёл ajax-ответ или нет.
                 * Например, нам в любом случае нужно убрать неактивное состояние у формы,
                 * которое задаётся в момент её отправки.
                 */
                var always = function() {
                    form.removeClass(sendingClass);
                    ajaxRecieved = true;
                    DEBUG && console.log("[module formsValidation] ajax always");
                };

                // Неактивное состояние у формы
                // лучше задавать через небольшой промежуток времени,
                // так как если форма отправится слишком быстро, то данное состояние
                // не только не нужно, но и, наоборот, будет во вред, т. к.
                // произойдёт "мелькание" формы (слишком быстрая смена стилей).
                setTimeout(function() {
                    if (!ajaxRecieved) {
                        form.addClass(sendingClass);
                    }
                }, 300);

                // Отправляем ajax-запрос
                var request = $.ajax({
                    url: formAction,
                    method: formMethod,
                    data: data
                });

                // Добавляем обработчики ajax-событий
                request.done(done);
                request.fail(fail);
                request.always(always);

                // Отменяем действие по умолчанию для формы
                // (иначе страница перезагрузится)
                return false;
            };

            // Создаём сущность Parsley
            // и делаем привязку событий и функций-обработчиков
            var parsleyInstance = form.parsley(defaultParsleyOptions);
            parsleyInstance.on("form:success", success);
            parsleyInstance.on("form:error", error);
            parsleyInstance.on("form:submit", submit);
        });
    };


    var loadLibrary = function() {
        app.loadScript("/assets/scripts/parsley.min.js", function() {
            DEBUG && console.log("[module formsValidation] parsley.js library loaded, ready to initialize module");
            init();
        });
    };

    // Делегируем функцию в модуль pageLoad
    // (откладываем выполнение до полной загрузки страницы)
    DEBUG && console.log("%c--[module formsValidation] delegating loadLibrary to pageLoad module", "font-style: italic; color: #999");
    app.modules.pageLoad.addEvent(loadLibrary);
});