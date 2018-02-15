/**
 * Кнопки в левом нижнем углу экрана
 * (только в режиме dev)
 *
 * NOTE: Код подключается с доп. командой DEBUG && -
 * это значит, что при минификации скриптов
 * данный модуль будет целиком вырезан, и можно не париться насчёт лишних килобайтов.
 */
DEBUG && app.createModule("devBtns", function() {
    if (!document.querySelector(".js-toggle-styles") && !document.querySelector(".js-toggle-images")) {
        return false;
    }

    /**
     * Отображение без стилей
     * (полезно для проверки чистой разметки, заголовков, секций и т. п.)
     */
    (function() {
        var btn = document.querySelector(".js-toggle-styles");
        if (!btn) {
            return false;
        }

        var toggled = false;
        var links = document.querySelectorAll("link");

        var btnClick = function() {
            var link, i, media;

            if (!toggled) {
                for (i = links.length - 1; i >= 0; i--) {
                    link = links[i];
                    media = link.getAttribute("media");
                    if (!media) {
                        continue;
                    }

                    link.setAttribute("data-media", media);
                    link.setAttribute("media", "none");
                }
                toggled = true;
            } else {
                for (i = links.length - 1; i >= 0; i--) {
                    link = links[i];
                    media = link.getAttribute("data-media");
                    if (!media) {
                        continue;
                    }

                    link.setAttribute("media", media);
                    link.removeAttribute("data-media");
                }
                toggled = false;
            }
        };

        btn.addEventListener("click", btnClick, false);
    })();


    /**
     * Отображение без изображений,
     * но так, чтобы был виден текст атрибута alt.
     */
    (function() {
        var btn = document.querySelector(".js-toggle-images");
        if (!btn) {
            return false;
        }

        var toggled = false;
        var dAttrSrcOri = "data-src-ori";
        var attrSrc = "src";
        var i, img;

        var btnClick = function() {
            var images = document.querySelectorAll("img");

            for (i = images.length - 1; i >= 0; i--) {
                img = images[i];
                if (!toggled) {
                    img.setAttribute(dAttrSrcOri, img.getAttribute(attrSrc));
                    img.removeAttribute(attrSrc);
                } else {
                    img.setAttribute(attrSrc, img.getAttribute(dAttrSrcOri));
                    img.removeAttribute(dAttrSrcOri);
                }
            }
            toggled = !toggled;
        };

        btn.addEventListener("click", btnClick, false);
    })();
});