/**
 * Адаптивные таблицы.
 * Вдохновение было взято отсюда:
 * http://codepen.io/anon/pen/QwPVNW
 * https://css-tricks.com/examples/ResponsiveTables/responsive.php
 * http://codepen.io/pixelchar/pen/rfuqK
 */
app.createModule("responsiveTables", function() {
    var tables = $("table");
    if (!tables.length) {
        return false;
    }

    // Локальные переменные
    var dAttrLabel = "data-label";


    tables.each(function() {
        var table = $(this);
        var thead = table.find("thead");

        // Случай, когда таблица неправильно свёрстана
        // (напр., через визивик)
        if (!thead.length) {
            thead = table.find("tr:first-child");
        }

        var th = thead.find("th, td");
        var labels = [];
        th.each(function() {
            labels.push($(this).text().trim());
        });

        table.find("tr").each(function() {
            var tr = $(this);
            tr.find("td").each(function(index) {
                var td = $(this);
                if (!td.attr(dAttrLabel)) {
                    td.attr(dAttrLabel, labels[index]);
                }
            });
        });
    });



    // Unit-tests
    if (DEBUG && typeof describe === "function") {
        describe("[module responsiveTables]", function() {
            it("labels array must be non-empty", function() {
                tables.each(function() {
                    var table = $(this);
                    var thead = table.find("thead");

                    // Случай, когда таблица неправильно свёрстана
                    // (напр., через визивик)
                    if (!thead.length) {
                        thead = table.find("tr:first-child");
                    }

                    var th = thead.find("th, td");
                    var labels = [];
                    th.each(function() {
                        labels.push($(this).text().trim());
                    });

                    expect(labels).to.be.an("array");
                    expect(labels.length).to.be.above(0);
                });
            });

            it("must add " + dAttrLabel + " attribute to each table cell (inside <tbody>)", function() {
                tables.find("tbody td").each(function() {
                    var td = $(this);
                    expect(td.attr(dAttrLabel)).to.not.be.undefined;
                });
            });
        });
    }
});