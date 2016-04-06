/// <reference path="../PersonDetailPage.html" />
/// <reference path="../PersonDetailPage.html" />
/// <reference path="view.js" />
var treeplugin;

(function ($) {
    var myTreeControl = null; // เก็บ plugin
    var myTreeStatus;
    var idRef;
    var settings = {
        data: {},
        onCancelPersonDetail: function () {
            alert('onCancelPersonDetail');
        },
        onOkPersonDetail: function (obj) {
            alert('onOkPersonDetail');
        }
    };

    $.fn.treeControl = function (options) {
        myTreeControl = this;
        treeplugin = this;
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
            treeOptions.hasButtons = primitives.common.Enabled.True;
            treeOptions.hasSelectorCheckbox = primitives.common.Enabled.False;
            treeOptions.pageFitMode = primitives.common.PageFitMode.None;
            treeOptions.linesWidth = 2;
            treeOptions.linesColor = primitives.common.Colors.Black;
            treeOptions.normalItemsInterval = 20;
            treeOptions.lineLevelShift = 30;
            treeOptions.onButtonClick = function (e, data) {
                //$(myTreeControl).data("id", data.context.id);
                idRef = data.context.id;

                if (data.name == "add") {
                    myTreeStatus = enStatusUI.add;
                    $.blockUI({

                        message: '<iframe src="~/../PersonDetailPage.html" height="220px" width="470px" scrolling="yes" frameborder="0" id="progressIframe" />',
                        css: {
                            width: '500px' // ความกว้างขอบ iframe
                        },
                        overlayCSS: { backgroundColor: '#F2F5F8' },
                        onBlock: function () {
                            $(".blockPage").center();
                        }
                    });
                }

                if (data.name == "delete") {
                    alert("delete");
                }

            };

            $(myTreeControl).famDiagram(treeOptions);
        })
    };

    $.fn.reCreate = function (obj) {
        // เอา obj มาทำส่งให้ server ก่อน
        if (myTreeStatus == enStatusUI.add) {
            if (obj.type_of_relationship == "son") {

                var obj = prepareSonForAdd(obj);

                // ส่งไป save
                var input = JSON.stringify(obj);
                $.ajax({
                    url: 'http://www.cavaros.com/health_system/public/add_person_api',
                    contentType: "application/x-www-form-urlencoded;charset=utf-8",
                    cache: false,
                    type: 'post',
                    dataType: 'json',
                    data: { inputs: JSON.stringify(obj) },
                    success: function (msg) {
                        //$('#basicdiagram').html(msg['status'] + "<br>" + msg['message']);

                        // ถ้า save ผ่านสร้าง
                        settings.data = msg.person;
                        reRender(settings.data);
                    },
                    error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
                        alert(xhr.status);
                        alert(xhr.responseText);
                    }
                });

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
                //todo เคสมีแฟนแล้ว คิดว่าไม่ควรทำได้

                var obj = prepareSpouseForAdd(obj);
                // ส่งไป save
                var input = JSON.stringify(obj);
                $.ajax({
                    url: 'http://www.cavaros.com/health_system/public/add_person_api',
                    contentType: "application/x-www-form-urlencoded;charset=utf-8",
                    cache: false,
                    type: 'post',
                    dataType: 'json',
                    data: { inputs: JSON.stringify(obj) },
                    success: function (msg) {
                        //$('#basicdiagram').html(msg['status'] + "<br>" + msg['message']);

                        // ถ้า save ผ่านสร้าง
                        settings.data = msg.person;
                        reRender(settings.data);
                    },
                    error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
                        alert(xhr.status);
                        alert(xhr.responseText);
                    }
                });
            }
            if (obj.type_of_relationship == "relative") {

                var obj = prepareRelativeForAdd(obj);
                // ส่งไป save
                var input = JSON.stringify(obj);
                $.ajax({
                    url: 'http://www.cavaros.com/health_system/public/add_person_api',
                    contentType: "application/x-www-form-urlencoded;charset=utf-8",
                    cache: false,
                    type: 'post',
                    dataType: 'json',
                    data: { inputs: JSON.stringify(obj) },
                    success: function (msg) {
                        //$('#basicdiagram').html(msg['status'] + "<br>" + msg['message']);

                        // ถ้า save ผ่านสร้าง
                        settings.data = msg.person;
                        reRender(settings.data);
                    },
                    error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
                        alert(xhr.status);
                        alert(xhr.responseText);
                    }
                });
            }
            if (obj.type_of_relationship == "parent") {

                var obj = prepareParentForAdd(obj);
                // ส่งไป save
                var input = JSON.stringify(obj);
                $.ajax({
                    url: 'http://www.cavaros.com/health_system/public/add_person_api',
                    contentType: "application/x-www-form-urlencoded;charset=utf-8",
                    cache: false,
                    type: 'post',
                    dataType: 'json',
                    data: { inputs: JSON.stringify(obj) },
                    success: function (msg) {
                        //$('#basicdiagram').html(msg['status'] + "<br>" + msg['message']);

                        // ถ้า save ผ่านสร้าง
                        settings.data = msg.person;
                        reRender(settings.data);
                    },
                    error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
                        alert(xhr.status);
                        alert(xhr.responseText);
                    }
                });
            }
        }
    }

    function reRender(data) {
        $(myTreeControl).famDiagram({
            items: data
        });
        $(myTreeControl).famDiagram("update", /*Refresh: use fast refresh to update chart*/ primitives.orgdiagram.UpdateMode.Refresh);
    }

    $.fn.cancelPersonDetail = function () {
        settings.onCancelPersonDetail();
    }

    $.fn.okPersonDetail = function (obj) {
        settings.onOkPersonDetail(obj);
    }

    function prepareSonForAdd(obj) {
        var idParner = findSpouseId(idRef);
        if (idParner == null) {
            obj.parents_id = [idRef];
        }
        else {
            obj.parents_id = [idRef, idParner];
        }
        return obj;
    }

    function findSpouseId(id) {
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
        idSpouse = obj[0] == null ? null : obj[0].spouses;

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

    function prepareSpouseForAdd(obj) {
        // ใส่ id ของ node ที่เลือกให้ spouse_id
        obj.spouse_id = idRef;

        // หาว่ามีลูกมั้ยถ้ามีใส่ id ลงไปใน son_id
        obj.son_id = findSonId(idRef);
        return obj;
    }

    function findSonId(id) {
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

    function prepareRelativeForAdd(obj) {
        var idParent = findParentId(idRef);
        obj.parents_id = idParent;
        return obj;
    }

    function findParentId(id) {
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

    function prepareParentForAdd(obj) {
        var idson = findSonId(idRef);
        obj.son_id = idson;
        return obj;
    }

    $.fn.isExceptParentAdd = function (obj) {
        var isExcept = false;
        if (myTreeStatus == enStatusUI.add) {
            var ids = findParentId(idRef);
            if (ids !== null) {
                isExcept = true;
            }

            return isExcept;
        }
    }

    $.fn.isExceptSpouseAdd = function (obj) {
        var isExcept = false;
        if (myTreeStatus == enStatusUI.add) {
            var ids = findSpouseId(idRef);
            if (ids !== null) {
                isExcept = true;
            }

            return isExcept;
        }
    }

    $.fn.isExceptRelativeAdd = function (obj) {
        var isExcept = false;
        if (myTreeStatus == enStatusUI.add) {
            var ids = findParentId(idRef);
            if (ids == null) {
                isExcept = true;
            }

            return isExcept;
        }
    }

    //function createSpouses(obj) {
    //    // ไม่ใช้
    //    var partner = {
    //        id: obj.id
    //            , itemTitleColor: (obj.sex == "female" ? primitives.common.Colors.Pink : null)
    //            , title: obj.first_name + " " + obj.last_name
    //            , description: ""
    //            , image: null
    //            , spouses: [idRef]
    //    }
    //    return partner;
    //}

    //function createRelatives(obj) {
    //    // ไม่ใช้
    //    var objMe = findById(idRef);

    //    var relatives = {
    //        id: obj.id
    //            , itemTitleColor: (obj.sex == "female" ? primitives.common.Colors.Pink : null)
    //            , title: obj.first_name + " " + obj.last_name
    //            , description: ""
    //            , image: null
    //            , parents: objMe.parents
    //    }
    //    return relatives;
    //}

    //function createParent(obj) {
    //    // todo ไม่ได้กันเรื่องมีพ่อมีแม่อยู่แล้วหรือยัง
    //    // สร้างพ่อแม่, update id ที่ส่งเข้ามาให้มี parent
    //    var parent = {
    //        id: obj.id
    //            , itemTitleColor: (obj.sex == "female" ? primitives.common.Colors.Pink : null)
    //            , title: obj.first_name + " " + obj.last_name
    //            , description: ""
    //            , image: null
    //    }
    //    updatePropertyByid(idRef, "parents", [parent.id])
    //    return parent;
    //}

    //function updatePropertyByid(id, proName, parent_id) {
    //    for (var i = 0; i < settings.data.length; i++) {
    //        if (settings.data[i]["id"] === id) {
    //            settings.data[i][proName] = parent_id;
    //        }
    //    }
    //}

    //#region enum
    var enStatusUI = {
        add: { status: 1, text: "เพิ่ม" },
        edit: { status: 2, text: "แก้ไข" },
        getEnStatusUIByVal: function (val) {
            switch (parseInt(val)) {
                case 1: return this.add;
                case 2: return this.edit;
            }
        }
    };

})(jQuery);