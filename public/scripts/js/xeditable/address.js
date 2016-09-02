/**
 Address editable input.
 Internally value stored as {city: "Moscow", street: "Lenina", building: "15"}

 @class address
 @extends abstractinput
 @final
 @example
 <a href="#" id="address" data-type="address" data-pk="1">awesome</a>
 <script>
 $(function(){
    $('#address').editable({
        url: '/post',
        title: 'Enter city, street and building #',
        value: {
            city: "Moscow", 
            street: "Lenina", 
            building: "15"
        }
    });
});
 </script>
 **/
(function ($) {
    "use strict";

    var Address = function (options) {
        this.init('address', options, Address.defaults);
    };

    //inherit from Abstract input
    $.fn.editableutils.inherit(Address, $.fn.editabletypes.abstractinput);

    $.extend(Address.prototype, {
        /**
         Renders input from tpl

         @method render()
         **/
        render: function () {
            this.$input = this.$tpl.find('input');
        },

        /**
         Default method to show value in element. Can be overwritten by display option.

         @method value2html(value, element)
         **/
        value2html: function (value, element) {
            if (!value) {
                $(element).empty();
                return;
            }
            var html = $('<div>').text(value.house_number).html() + ' ' + $('<div>').text(value.street).html() + ' ' + $('<div>').text(value.soi).html() + ' '
                + $('<div>').text(value.mooh).html() + ' ' + $('<div>').text(value.tumbon).html() + ' ' + $('<div>').text(value.amphur).html() + ' '
                + $('<div>').text(value.province).html() + ' ' + $('<div>').text(value.post_code).html();
            $(element).html(html);
        },

        /**
         Gets value from element's html

         @method html2value(html)
         **/
        html2value: function (html) {
            /*
             you may write parsing method to get value by element's html
             e.g. "Moscow, st. Lenina, bld. 15" => {city: "Moscow", street: "Lenina", building: "15"}
             but for complex structures it's not recommended.
             Better set value directly via javascript, e.g.
             editable({
             value: {
             city: "Moscow",
             street: "Lenina",
             building: "15"
             }
             });
             */
            return null;
        },

        /**
         Converts value to string.
         It is used in internal comparing (not for sending to server).

         @method value2str(value)
         **/
        value2str: function (value) {
            var str = '';
            if (value) {
                for (var k in value) {
                    str = str + k + ':' + value[k] + ';';
                }
            }
            return str;
        },

        /*
         Converts string to value. Used for reading value from 'data-value' attribute.

         @method str2value(str)
         */
        str2value: function (str) {
            /*
             this is mainly for parsing value defined in data-value attribute.
             If you will always set value by javascript, no need to overwrite it
             */
            return str;
        },

        /**
         Sets value of input.

         @method value2input(value)
         @param {mixed} value
         **/
        value2input: function (value) {
            if (!value) {
                return;
            }
            this.$input.filter('[name="house_number"]').val(value.house_number);
            this.$input.filter('[name="street"]').val(value.street);
            this.$input.filter('[name="soi"]').val(value.soi);
            this.$input.filter('[name="mooh"]').val(value.mooh);
            this.$input.filter('[name="tumbon"]').val(value.tumbon);
            this.$input.filter('[name="amphur"]').val(value.amphur);
            this.$input.filter('[name="province"]').val(value.province);
            this.$input.filter('[name="post_code"]').val(value.post_code);
        },

        /**
         Returns value of input.

         @method input2value()
         **/
        input2value: function () {
            return {
                house_number: this.$input.filter('[name="house_number"]').val(),
                street: this.$input.filter('[name="street"]').val(),
                soi: this.$input.filter('[name="soi"]').val(),
                mooh: this.$input.filter('[name="mooh"]').val(),
                tumbon: this.$input.filter('[name="tumbon"]').val(),
                amphur: this.$input.filter('[name="amphur"]').val(),
                province: this.$input.filter('[name="province"]').val(),
                post_code: this.$input.filter('[name="post_code"]').val(),
            };
        },

        /**
         Activates input: sets focus on the first field.

         @method activate()
         **/
        activate: function () {
            this.$input.filter('[name="house_number"]').focus();
        },

        /**
         Attaches handler to submit form in case of 'showbuttons=false' mode

         @method autosubmit()
         **/
        autosubmit: function () {
            this.$input.keydown(function (e) {
                if (e.which === 13) {
                    $(this).closest('form').submit();
                }
            });
        }
    });

    Address.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
        tpl: '<div class="editable-address"><label><span>House Number: </span><input type="text" name="house_number" class="input-small"></label></div>' +
        '<div class="editable-address"><label><span>Street: </span><input type="text" name="street" class="input-small"></label></div>' +
        '<div class="editable-address"><label><span>Soi: </span><input type="text" name="soi" class="input-mini"></label></div>' +
        '<div class="editable-address"><label><span>Mooh: </span><input type="text" name="mooh" class="input-small"></label></div>' +
        '<div class="editable-address"><label><span>Tumbon: </span><input type="text" name="tumbon" class="input-mini"></label></div>' +
        '<div class="editable-address"><label><span>Amphur: </span><input type="text" name="amphur" class="input-small"></label></div>' +
        '<div class="editable-address"><label><span>Province: </span><input type="text" name="province" class="input-mini"></label></div>' +
        '<div class="editable-address"><label><span>Post Code: </span><input type="text" name="post_code" class="input-mini"></label></div>',

        inputclass: ''
    });

    $.fn.editabletypes.address = Address;

}(window.jQuery));