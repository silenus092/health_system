

(function ($) {
    var myTreeControl = null; // เก็บ plugin
    var settings = {
        'data': {}
    };

    $.fn.treeControl = function (options) {
        myItemDetail = this;
        settings = $.extend(settings, options);

        return this.each(function () {
            var buttons = [];
            buttons.push(new primitives.orgdiagram.ButtonConfig("add", "ui-icon-plus", "Add"));
            buttons.push(new primitives.orgdiagram.ButtonConfig("edit", "ui-icon-pencil", "Edit"));
            buttons.push(new primitives.orgdiagram.ButtonConfig("delete", "ui-icon-close", "Delete"));
            buttons.push(new primitives.orgdiagram.ButtonConfig("properties", " ui-icon-info", "Info"));
            var treeOptions = new primitives.orgdiagram.Config();

            treeOptions.items = settings.data;
            treeOptions.buttons = buttons;
            treeOptions.hasSelectorCheckbox = primitives.common.Enabled.False;
            treeOptions.pageFitMode = primitives.common.PageFitMode.None;
            treeOptions.linesWidth = 2;
            treeOptions.linesColor = primitives.common.Colors.Black;
            treeOptions.normalItemsInterval = 20;
            treeOptions.lineLevelShift = 30;

            $(myItemDetail).famDiagram(treeOptions);
        })
    };

})(jQuery);