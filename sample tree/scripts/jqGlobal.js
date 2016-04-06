// จัดไว้ตรงกลาง browser
$.fn.center = function () {
    this.css("position", "absolute");
    this.css("top", ($(window).height() - this.height()) / 2 + $(window).scrollTop() + "px");
    this.css("left", ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + "px");
    return this;
}
// แปลงข้อความเป็น ทศนิยม ถ้าเป็นช่องว่างแปลงเป็น 0
$.fn.parseTxtToFloat = function () {
    if (this.is("input")) {
        if (isNaN(this.val())) {
            return 0
        } else {
            if (this.val() == "") {
                return 0
            } else {
                return parseFloat(this.val())
            }
        }
    } else {
        if (isNaN(this.text())) {
            return 0
        } else {
            if (this.text() == "") {
                return 0
            } else {
                return parseFloat(this.text())
            }
        }

    }
}
// เมื่อกด enter จะ focus ไปตัวถัดไป
$.fn.configKeyEnter = function (child) {
    var parent = $(this);
    $(this).find(child).not(notControl).keyup(function () {
        if (event.which == 13) {
            var controls = parent.find(child);
            var index = 0;
            for (var i = 0; i < controls.length; i++) {
                if ($(controls[i]).attr("name") == $(this).attr("name")) {
                    index = i;
                    break;
                }
            }
            $(controls[index + 1]).focus();
        }
    })
}
//กันกดคลิ๊ก
$.fn.preventClick = function () {
    $(this).click(function (event) {
        event.stopImmediatePropagation();
    });
}
//ยังใช้ไม่ได้
$.fn.bindEnter = function (fn) {
    $(this).keyup(function () {
        if (event.which == 13) {
            $(this).bind("click", fn);
        }
    })
}