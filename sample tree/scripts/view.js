
//#region class
function PersonDetailView() {
    this.first_name = "";
    this.last_name = "";
    this.age = null;
    this.sex = ""; // male, female
    this.is_sick = ""; // ?
    this.person_alive = ""; // 1=live , 2=not live
    this.type_of_relationship = ""; // parent, spouse, relative, son
    this.parents_id = null;
    this.spouse_id = null;
    this.son_id = null;
};
PersonDetailView.prototype.getDataInform = function () {
    this.first_name = $("#txtFirstName").val();
    this.last_name = $("#txtLastName").val();
    this.age = ($("#txtAge").val() == "" ? null : $("#txtAge").val());
    this.sex = $("input[name=sex]:checked").val();
    this.person_alive = $("input[name=live]:checked").val();;
    this.type_of_relationship = $("input[name=relationship]:checked").val();;
};



//#region enum
var enSex = {
    male: { status: 0, text: "male" },
    female: { status: 1, text: "female" },
    getEnSexUIByVal: function (val) {
        switch (parseInt(val)) {
            case 0: return this.male;
            case 1: return this.female;
        }
    }
};
var enSick = {
    sick: { status: 0, text: "sick" },
    notSick: { status: 1, text: "notSick" },
    getEnSickByVal: function (val) {
        switch (parseInt(val)) {
            case 0: return this.sick;
            case 1: return this.notSick;
        }
    }
};
var enLive = {
    live: { status: 1, text: "live" },
    notLive: { status: 2, text: "notLive" },
    getEnLiveByVal: function (val) {
        switch (parseInt(val)) {
            case 1: return this.live;
            case 2: return this.notLive;
        }
    }
};
var enRelationType = {
    parent: { status: 1, text: "parent" },
    spouse: { status: 2, text: "spouse" },
    son: { status: 3, text: "son" },
    relative: { status: 4, text: "relative" },
    getEnRelationTypeByVal: function (val) {
        switch (parseInt(val)) {
            case 1: return this.parent;
            case 2: return this.spouse;
            case 3: return this.son;
            case 4: return this.relative;
        }
    }
};