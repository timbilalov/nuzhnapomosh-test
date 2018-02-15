app.createModule("newsList", function() {
    var parent = $(".js-news-list");
    if (!parent.length) {
        return false;
    }

    // Local variables
    var module = this;
    var items = parent.find(".js-item");
    var dateClass = "js-date";
    var toggleBtns = parent.find(".js-toggle");
    var toggled = false;
    var container = parent.find(".js-container");
    var dAttrToggleText = "data-toggle-text";


    // Methods
    var toggleDate = function() {
        var k = toggled ? 1 : -1;
        items.sort(function(a, b) {
            var $a = $(a);
            var $b = $(b);
            var dateTextA = $a.find("." + dateClass).text().trim().split(".");
            var dateTextB = $b.find("." + dateClass).text().trim().split(".");
            var dateTimeA = new Date(dateTextA[2], dateTextA[1] - 1, dateTextA[0]).getTime();
            var dateTimeB = new Date(dateTextB[2], dateTextB[1] - 1, dateTextB[0]).getTime();
            var res;
            if (dateTimeA > dateTimeB) {
                res = -1 * k;
            } else if (dateTimeA < dateTimeB) {
                res = 1 * k;
            } else {
                res = 0;
            }
            return res;
        });

        toggleBtns.each(function() {
            var self = $(this);
            dText = self.attr(dAttrToggleText).trim();
            self.attr(dAttrToggleText, self.text().trim()).text(dText);
        });

        toggled = !toggled;
        container.append(items);
        DEBUG && console.log("[module newsList] sorted: " + (toggled ? "older" : "newer") + " first")
    };

    // Binds
    toggleBtns.on("click", toggleDate);

    // Export
    module.toggleDate = toggleDate;
});