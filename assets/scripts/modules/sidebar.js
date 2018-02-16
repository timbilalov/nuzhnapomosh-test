app.createModule("sidebar", function() {
    var parent = $(".js-sidebar");
    if (!parent.length) {
        return false;
    }

    // Local variables
    var toggleBtns = parent.find(".js-sidebar-toggle");
    var openedClass = "is-opened";

    // Methods
    var toggleSidebar = function() {
        parent.toggleClass(openedClass);
        DEBUG && console.log("[module sidebar] toggled");
    };

    // Binds
    toggleBtns.on("click", toggleSidebar);

    // Export
});