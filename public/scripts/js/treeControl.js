/// <reference path="../PersonDetailPage.html" />
/// <reference path="../PersonDetailPage.html" />
/// <reference path="view.js" />
var treeplugin;

// เรียงลำดับแบบอายุไม่รู้ทำได้เปล่า
// ขยับ layout หน่อย

(function ($) {
    var myTreeControl = null; // เก็บ plugin
    var myTreeStatus;
    var idRef;
    var objData = null;
    var errMsg = "";
    var settings = {
        url: "",
        mainId: 0,
        mainReId: 0,
        data: {},
        onCancelPersonDetail: function () {
            alert('onCancelPersonDetail');
        },
        onOkPersonDetail: function (obj) {
            alert('onOkPersonDetail');
        },
        onReturnPage: function (obj) {
            alert('onReturnPage');
        },
        onUndoDelete: function (obj) {
            $.ajax({
                url: settings.url + '/undo_state',
                contentType: "application/x-www-form-urlencoded;charset=utf-8",
                cache: false,
                type: 'get',
                success: function (msg) {
                    //$('#basicdiagram').html(msg['status'] + "<br>" + msg['message']);

                    // ถ้า save ผ่านสร้าง
                    if (msg['status'].toUpperCase() == 'success'.toUpperCase()) {
                        reRender();
                    }
                    else {
                        alertSaveErr();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
                    alertServiceErr(xhr);
                }
            });
        }
    };

    function findByIdKey(idKey) {
        var obj = settings.data.filter(function (o) {
            if (o.id_key === idKey) {
                return o;
            }
        });
        return obj[0];
    }

    $.fn.treeControl = function (options) {
        myTreeControl = this;
        treeplugin = this;
        settings = $.extend(settings, options);

        return this.each(function () {
            // todo เทส
            //settings.mainReId = findByIdKey(settings.mainId);

            var buttons = [];
            buttons.push(new primitives.orgdiagram.ButtonConfig("add", "ui-icon-plus", "เพิ่ม"));
            buttons.push(new primitives.orgdiagram.ButtonConfig("edit", "ui-icon-pencil", "แก้ไข"));
            buttons.push(new primitives.orgdiagram.ButtonConfig("delete", "ui-icon-close", "ลบ"));
            //buttons.push(new primitives.orgdiagram.ButtonConfig("properties", " ui-icon-info", "Info"));
            var treeOptions = new primitives.orgdiagram.Config();

            treeOptions.items = settings.data;
            treeOptions.buttons = buttons;
            treeOptions.hasButtons = primitives.common.Enabled.True;
            treeOptions.hasSelectorCheckbox = primitives.common.Enabled.False;
            treeOptions.pageFitMode = primitives.common.PageFitMode.None;
            treeOptions.linesWidth = 2;
            treeOptions.linesColor = primitives.common.Colors.Black;
            treeOptions.normalItemsInterval = 20;
            treeOptions.lineLevelShift = 40;

            treeOptions.templates = [getContactTemplate()];
            treeOptions.onItemRender = onTemplateRender;
            options.defaultTemplateName = "contactTemplate";

            treeOptions.onButtonClick = function (e, data) {
                //$(myTreeControl).data("id", data.context.id);
                idRef = data.context.id;

                if (data.name == "add") {
                    myTreeStatus = enStatusUI.add;
                    $.blockUI({

                        message: '<iframe src="http://localhost/health_system/public/scripts/resources/PersonDetailPage.html" height="280px" width="470px" scrolling="yes" frameborder="0" id="progressIframe" />',
                        css: {
                            width: '500px' // ความกว้างขอบ iframe
                        },
                        overlayCSS: {backgroundColor: '#F2F5F8'},
                        onBlock: function () {
                            $(".blockPage").center();
                        }
                    });
                }

                if (data.name == "delete") {
                    myTreeStatus = enStatusUI.delete;
                    $.blockUI({

                        message: '<iframe src="http://localhost/health_system/public/scripts/resources/PersonDeletePage.html" height="220px" width="500px" scrolling="yes" frameborder="0" id="progressIframe" />',
                        css: {
                            width: '500px' // ความกว้างขอบ iframe
                        },
                        overlayCSS: {backgroundColor: '#F2F5F8'},
                        onBlock: function () {
                            $(".blockPage").center();
                        }
                    });
                }

                if (data.name == "edit") {
                    myTreeStatus = enStatusUI.edit;
                    $.blockUI({

                        message: '<iframe src="http://localhost/health_system/public/scripts/resources/PersonEditPage.html" height="270px" width="470px" scrolling="yes" frameborder="0" id="progressIframe" />',
                        css: {
                            width: '500px' // ความกว้างขอบ iframe
                        },
                        overlayCSS: {backgroundColor: '#F2F5F8'},
                        onBlock: function () {
                            $(".blockPage").center();
                        }
                    });
                }

            };

            $(myTreeControl).famDiagram(treeOptions);
            //createMenuBtn();
            callCheckUndoDelete();
        })
    };

    $.fn.reCreate = function (obj) {
        // เอา obj มาทำส่งให้ server ก่อน
        if (myTreeStatus == enStatusUI.add) {

            obj.person_select_id = idRef;
            if (obj.type_of_relationship == "son") {

                var obj = prepareSonForAdd(obj);

                // ถ้า save ผ่านสร้าง test
                //obj.id = settings.data.length + 1; //test
                //var child = createSonObj(obj);
                //settings.data.push(child);
                //$(myTreeControl).famDiagram({
                //    items: settings.data
                //});
                //$(myTreeControl).famDiagram("update", /*Refresh: use fast refresh to update chart*/ primitives.orgdiagram.UpdateMode.Refresh);
            }
            if (obj.type_of_relationship == "spouse") {

                var obj = prepareSpouseForAdd(obj);
            }
            if (obj.type_of_relationship == "relative") {

                var obj = prepareRelativeForAdd(obj);
            }
            if (obj.type_of_relationship == "parent") {

                var obj = prepareParentForAdd(obj);
            }

            // สลับเป็น id จิงๆ
            var idAdd = findById(idRef).id_key;
            obj.person_select_id = idAdd;

            // ส่งไป save
            $.ajax({
                url: settings.url + '/add_person_api',
                contentType: "application/x-www-form-urlencoded;charset=utf-8",
                cache: false,
                type: 'post',
                dataType: 'json',
                data: {inputs: JSON.stringify(obj)},
                success: function (msg) {
                    //$('#basicdiagram').html(msg['status'] + "<br>" + msg['message']);

                    // ถ้า save ผ่านสร้าง
                    if (msg['status'].toUpperCase() == 'success'.toUpperCase()) {
                        reRender();
                    }
                    else {
                        alertSaveErr();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
                    alertServiceErr(xhr);
                    //alert(xhr.status);
                    //alert(xhr.responseText);
                }
            });
        }
        if (myTreeStatus == enStatusUI.delete) {
            // ส่งไป save
            //var input = JSON.stringify({ person_id: "" + idRef + "" });
            var idDelete = findById(idRef).id_key;
            var input = JSON.stringify({person_id: idDelete});
            $.ajax({
                url: settings.url + '/drop_person_api',
                contentType: "application/x-www-form-urlencoded;charset=utf-8",
                cache: false,
                type: 'post',
                dataType: 'json',
                data: {inputs: input},
                success: function (msg) {
                    //$('#basicdiagram').html(msg['status'] + "<br>" + msg['message']);

                    // ถ้า save ผ่านสร้าง
                    if (msg['status'].toUpperCase() == 'success'.toUpperCase()) {
                        reRender();
                    }
                    else {
                        alertSaveErr();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
                    alertServiceErr(xhr);
                }
            });
        }
        if (myTreeStatus == enStatusUI.edit) {

            obj.person_change_id = idRef;
            if (obj.type_of_relationship == "son") {

                var obj = prepareSonForEdit(obj);
            }
            if (obj.type_of_relationship == "spouse") {

                var obj = prepareSpouseForEdit(obj);
            }
            if (obj.type_of_relationship == "relative") {

                var obj = prepareRelativeForEdit(obj);
            }
            if (obj.type_of_relationship == "parent") {

                var obj = prepareParentForEdit(obj);
            }

            // สลับเป็น id จิงๆ
            var idEdit = findById(idRef).id_key;
            obj.person_change_id = idEdit;

            // ส่งไป save
            $.ajax({
                url: settings.url + '/edit_person_api',
                contentType: "application/x-www-form-urlencoded;charset=utf-8",
                cache: false,
                type: 'post',
                dataType: 'json',
                data: {inputs: JSON.stringify(obj)},
                success: function (msg) {
                    // ถ้า save ผ่านสร้าง
                    if (msg['status'].toUpperCase() == 'success'.toUpperCase()) {
                        reRender();
                    }
                    else {
                        alertSaveErr();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
                    alertServiceErr(xhr);
                }
            });
        }

    };

    function reRender() {
        $.ajax({
            url: settings.url + '/get_tree_api/' + settings.mainId,
            dataType: 'json',
            type: 'GET',
            success: function (data, textStatus, jQxhr) {
                settings.data = data.person;
                $(myTreeControl).famDiagram({
                    items: data.person
                });
                $(myTreeControl).famDiagram("update", /*Refresh: use fast refresh to update chart*/ primitives.orgdiagram.UpdateMode.Recreate);
            },
            error: function (data, textStatus, jQxhr) {
                alertServiceErr(xhr);
            },
        });

        callCheckUndoDelete();
    }

    function reId() {
        $.each(settings.data, function (key, value) {

        })
    }

    function getContactTemplate() {
        var result = new primitives.orgdiagram.TemplateConfig();
        result.name = "contactTemplate";

        result.itemSize = new primitives.common.Size(200, 120);
        result.minimizedItemSize = new primitives.common.Size(3, 3);
        result.highlightPadding = new primitives.common.Thickness(2, 2, 2, 2);


        var itemTemplate = jQuery(
            '<div class="bp-item bp-corner-all bt-item-frame">'
            + '<div name="titleBackground" class="bp-item bp-corner-all bp-title-frame" style="top: 2px; left: 2px; width: 216px; height: 20px; overflow: hidden;">'
            + '<div name="title" class="bp-item bp-title" style="top: 3px; left: 6px; width: 208px; height: 18px; overflow: hidden;">'
            + '</div>'
            + '</div>'
            + '<div class="bp-item bp-photo-frame" style="top: 26px; left: 2px; width: 50px; height: 60px; overflow: hidden;">'
            + '<img name="photo" style="height:60px; width:50px;" />'
            + '</div>'
            + '<div name="description" class="bp-item" style="top: 26px; left: 56px; width: 138px; height: 62px; font-size: 12px; overflow: hidden;"></div>'
            + '<div class="bp-item" style="top: 89px;left: 2px; width: 193px; height: 27px; overflow: hidden;text-align: right;">'
            + '<img name="photoDead" style="height:30px; width:32px;" src="http://localhost/health_system/public/images/rip.png" />'
            + '</div>'
            + '<div name="divMainId" class="bp-item" style="top: 2px;left: 169px;width: 32px;height: 30px;">'
            + '<img style="height:25px; width:26px;" src="http://localhost/health_system/public/images/star.png"/>'
            + '</div>'
            + '</div>'
        ).css({
            width: result.itemSize.width + "px",
            height: result.itemSize.height + "px"
        }).addClass("bp-item bp-corner-all bt-item-frame");
        result.itemTemplate = itemTemplate.wrap('<div>').parent().html();

        return result;
    }

    function onTemplateRender(event, data) {
        switch (data.renderingMode) {
            case primitives.common.RenderingMode.Create:
                /* Initialize widgets here */
                break;
            case primitives.common.RenderingMode.Update:
                /* Update widgets here */
                break;
        }

        var itemConfig = data.context;

        if (data.templateName == "contactTemplate") {
            if (itemConfig.image == null) {
                if (itemConfig.sex == "male") {
                    data.element.find("[name=photo]").attr({
                        "src": "http://localhost/health_system/public/images/men.png",
                        "alt": itemConfig.title
                    });
                }
                else {
                    data.element.find("[name=photo]").attr({
                        "src": "http://localhost/health_system/public/images/women.png",
                        "alt": itemConfig.title
                    });
                }
            }
            else {
                data.element.find("[name=photo]").attr({"src": itemConfig.image, "alt": itemConfig.title});
            }
            data.element.find("[name=titleBackground]").css({"background": itemConfig.itemTitleColor});
            if (itemConfig.id != settings.mainReId) {
                data.element.find("[name=divMainId]").css("visibility", "hidden");
            }

            var fields = ["title", "description"];
            for (var index = 0; index < fields.length; index++) {
                var field = fields[index];

                var element = data.element.find("[name=" + field + "]");
                if (element.text() != itemConfig[field]) {
                    element.text(itemConfig[field]);
                }

                if (itemConfig.person_alive == "1") {
                    data.element.find("[name=photoDead]").css("visibility", "hidden");
                }
                else {
                    data.element.find("[name=photoDead]").css("visibility", "visible");
                }
            }
        }
    }

    function createMenuBtn() {
        var menu = $('<div style="position:fixed;z-index:1000;top: 115px;">'
            + '<div>'
            + '<input id="btnReturn" type="button" class="btn btn-primary" value="ย้อนกลับ" style="border-radius: 12px; width:120px; position:relative;" /></div>'
            + '<div id="divUndoDelelte" style="position:relative; left:150px;">'
            + '<input id="btnUndoDelete" type="button" value="ยกเลิกการลบ" style="width:120px; position:relative;"/>'
            + '</div>').attr("id", "divMenu");

        $("body").prepend(menu);

        $("#btnReturn").bind("click", settings.onReturnPage);
        $("#btnUndoDelete").bind("click", settings.onUndoDelete);
    }

    function callCheckUndoDelete() {
        $.ajax({
            url: "http://localhost/health_system/public/check_undo_state",
            contentType: "application/x-www-form-urlencoded;charset=utf-8",
            cache: false,
            type: 'get',
            success: function (msg) {
                if (msg['status'].toUpperCase() == 'TRUE'.toUpperCase()) {
                    $("#divUndoDelelte").fadeIn("fast");
                }
                else {
                    $("#divUndoDelelte").fadeOut("fast");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
                alertServiceErr(xhr);
            }
        });
    }

    function alertSaveErr() {
        alert("ไม่สามารถบันทึกได้");
    }

    function alertServiceErr(xhr) {
        alert("พบปัญหาตอนบันทึก" + " Status: " + xhr.status + " responseText: " + xhr.responseText);
    }

    $.fn.cancelPersonDetail = function () {
        settings.onCancelPersonDetail();
    };

    $.fn.okPersonDetail = function (obj) {
        settings.onOkPersonDetail(obj);
    };

    function findSpouseId(id) {
        // return Null,id
        var idSpouse = null;

        //ตัวเองมี spouses มั้ย
        var obj = settings.data.filter(function (o) {
            if (o.id === id & o.spouses != null) {
                return o;
            }
            else {
                return null;
            }
        });
        idSpouse = obj[0] == null ? null : obj[0].spouses[0];

        //เป็น spouses ของใคร
        if (idSpouse == null) {
            var obj = settings.data.filter(function (o) {
                if (o.spouses != null) {
                    var idSp = o.spouses.filter(function (s) {
                        if (s == id) {
                            return s;
                        }
                    });

                    if (idSp.length > 0) {
                        return o;
                    }
                }
            });
            idSpouse = obj[0] == null ? null : obj[0].id;
        }

        return idSpouse;
    }

    function findSonId(id) {
        // return Null,Array
        var obj = settings.data.filter(function (o) {
            if (o.parents != undefined) {
                for (var i = 0; i < o.parents.length; i++) {
                    if (o.parents[i] === id) {
                        return o;
                    }
                }
            }

        });
        if (obj[0] == null) {
            return null;
        }
        else {
            var sons = [];
            for (var i = 0; i < obj.length; i++) {
                sons.push(obj[i].id);
            }
            return sons;
        }
    }

    function findParentId(id) {
        // return Null,Array
        var my = findById(id);
        if (my.parents == undefined) {
            return null;
        }
        else {
            return my.parents;
        }
    }



    function findById(id) {
        var obj = settings.data.filter(function (o) {
            if (o.id === id) {
                return o;
            }
        });
        return obj[0];
    }

    function prepareSonForAdd(obj) {
        var idParner = findSpouseId(obj.person_select_id);
        if (idParner == null) {
            obj.parents_id = [findById(obj.person_select_id).id_key];
        }
        else {
            obj.parents_id = [findById(obj.person_select_id).id_key, findById(idParner).id_key];
        }
        return obj;
    }

    function prepareSpouseForAdd(obj) {
        // ใส่ id ของ node ที่เลือกให้ spouse_id
        obj.spouse_id = [findById(obj.person_select_id).id_key];

        // หาว่ามีลูกมั้ยถ้ามีใส่ id ลงไปใน son_id
        var sonIds = findSonId(obj.person_select_id);
        if (sonIds == null) {
            obj.son_id = null;
        }
        else {
            var sonIdKeys = [];
            for (var i = 0; i < sonIds.length; i++) {
                sonIdKeys.push(findById(sonIds[i]).id_key);
            }
            obj.son_id = sonIdKeys;
        }
        return obj;
    }

    function prepareRelativeForAdd(obj) {
        var idParents = findParentId(obj.person_select_id);
        if (idParents == null) {
            obj.parents_id = null;
        }
        else {
            var parentIdKeys = [];
            for (var i = 0; i < idParents.length; i++) {
                parentIdKeys.push(findById(idParents[i]).id_key);
            }
            obj.parents_id = parentIdKeys;
        }
        return obj;
    }

    function prepareParentForAdd(obj) {
        obj.son_id = [findById(obj.person_select_id).id_key];
        return obj;
    }

    function prepareSonForEdit(obj) {
        var idParner = findSpouseId(obj.person_select_id);
        if (idParner == null) {
            obj.parents_id = [findById(obj.person_select_id).id_key];
        }
        else {
            obj.parents_id = [findById(obj.person_select_id).id_key, findById(idParner).id_key];
        }
        return obj;
    }

    function prepareSpouseForEdit(obj) {
        // ใส่ id ของ node ที่เลือกให้ spouse_id
        obj.spouse_id = [findById(obj.person_select_id).id_key];

        // หาว่ามีลูกมั้ยถ้ามีใส่ id ลงไปใน son_id
        var sonIds = findSonId(obj.person_select_id);
        if (sonIds == null) {
            obj.son_id = null;
        }
        else {
            var sonIdKeys = [];
            for (var i = 0; i < sonIds.length; i++) {
                sonIdKeys.push(findById(sonIds[i]).id_key);
            }
            obj.son_id = sonIdKeys;
        }

        return obj;
    }

    function prepareRelativeForEdit(obj) {
        var idParents = findParentId(obj.person_select_id);
        if (idParents == null) {
            obj.parents_id = null;
        }
        else {
            var parentIdKeys = [];
            for (var i = 0; i < idParents.length; i++) {
                parentIdKeys.push(findById(idParents[i]).id_key);
            }
            obj.parents_id = parentIdKeys;
        }

        return obj;
    }

    function prepareParentForEdit(obj) {
        obj.son_id = [findById(obj.person_select_id).id_key];
        return obj;
    }

    $.fn.isExceptParentAdd = function (idTarget) {
        //todo หน้าจะกันกลุ่มแฟนด้วยที่ไม่มีโหนดหัว
        if (idTarget == null) {
            idTarget = idRef;
        }
        var isExcept = false;
        if (myTreeStatus == enStatusUI.add) {
            var ids = findParentId(idTarget);
            if (ids !== null) {
                isExcept = true;
            }

            return isExcept;
        }
    };

    $.fn.isExceptSpouseAdd = function (idTarget) {
        if (idTarget == null) {
            idTarget = idRef;
        }
        var isExcept = false;
        if (myTreeStatus == enStatusUI.add) {
            var id = findSpouseId(idTarget);
            if (id !== null) {
                isExcept = true;
            }

            return isExcept;
        }
    };

    $.fn.isExceptRelativeAdd = function (idTarget) {
        if (idTarget == null) {
            idTarget = idRef;
        }
        var isExcept = false;
        if (myTreeStatus == enStatusUI.add) {
            var ids = findParentId(idTarget);
            if (ids == null) {
                isExcept = true;
            }
            return isExcept;
        }
    };

    $.fn.isExceptParentEdit = function (idTarget) {
        //todo หน้าจะกันกลุ่มแฟนด้วยที่ไม่มีโหนดหัว
        if (idTarget == null) {
            idTarget = idRef;
        }
        var isExcept = false;
        if (myTreeStatus == enStatusUI.edit) {
            var ids = findParentId(idTarget);
            if (ids !== null) {
                isExcept = true;
            }

            return isExcept;
        }
    };

    $.fn.isExceptSpouseEdit = function (idTarget) {
        if (idTarget == null) {
            idTarget = idRef;
        }
        var isExcept = false;
        if (myTreeStatus == enStatusUI.edit) {
            var id = findSpouseId(idTarget);
            if (id !== null) {
                isExcept = true;
            }

            return isExcept;
        }
    };

    $.fn.isExceptRelativeEdit = function (idTarget) {
        if (idTarget == null) {
            idTarget = idRef;
        }
        var isExcept = false;
        if (myTreeStatus == enStatusUI.edit) {
            var ids = findParentId(idTarget);
            if (ids == null) {
                isExcept = true;
            }
            return isExcept;
        }
    };

    $.fn.getData = function () {
        return settings.data;
    };

    $.fn.getDataById = function (Id) {
        return findById(Id);
    };

    $.fn.getDataByRefId = function () {
        return findById(idRef);
    };

    $.fn.getDataSonByRefId = function () {
        var obj = settings.data.filter(function (o) {
            if (o.parents != undefined) {
                for (var i = 0; i < o.parents.length; i++) {
                    if (o.parents[i] === idRef) {
                        return o;
                    }
                }
            }

        });
        if (obj[0] == null) {
            return null;
        }
        else {
            var sons = [];
            for (var i = 0; i < obj.length; i++) {
                sons.push(obj[i]);
            }
            return sons;
        }
    };

    $.fn.getDataSonById = function (id) {
        var obj = settings.data.filter(function (o) {
            if (o.parents != undefined) {
                for (var i = 0; i < o.parents.length; i++) {
                    if (o.parents[i] === id) {
                        return o;
                    }
                }
            }

        });
        if (obj[0] == null) {
            return null;
        }
        else {
            var sons = [];
            for (var i = 0; i < obj.length; i++) {
                sons.push(obj[i]);
            }
            return sons;
        }
    };

    $.fn.getDataSpouseByRefId = function () {
        return findSpouseId(idRef);
    };

    $.fn.getDataParentById = function (id) {
        var my = findById(id);
        if (my.parents == undefined) {
            return null;
        }
        else {
            var parents = [];
            for (var i = 0; i < my.parents.length; i++) {
                parents.push(findById(my.parents[i]));
            }
            return parents;
        }
    };

    $.fn.getDataParentByRefId = function () {
        var my = findById(idRef);
        if (my.parents == undefined) {
            return null;
        }
        else {
            var parents = [];
            for (var i = 0; i < my.parents.length; i++) {
                parents.push(findById(my.parents[i]));
            }
            return parents;
        }
    };

    $.fn.getErrMsg = function () {
        return errMsg;
    };

    $.fn.setErrMsg = function (textErr) {
        return errMsg = textErr;
    };

    $.fn.getObjData = function () {
        return objData;
    };

    $.fn.setObjData = function (obj) {
        objData = obj;
    };


    //#region enum
    var enStatusUI = {
        add: {status: 1, text: "เพิ่ม"},
        edit: {status: 2, text: "แก้ไข"},
        delete: {status: 2, text: "ลบ"},
        getEnStatusUIByVal: function (val) {
            switch (parseInt(val)) {
                case 1:
                    return this.add;
                case 2:
                    return this.edit;
                case 3:
                    return this.delete;
            }
        }
    };

})(jQuery);