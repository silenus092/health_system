@extends('app')

@section('content')
    <script src="{{ URL::asset('/scripts/js/go-debug/go-debug.js') }}"></script>
    <style>
        a.ss_btn {
            color: #fff;
            text-decoration: none;
            display: block;
            font-family: 'Arial',sans-serif;
            margin: 20px auto;
            width: 240px;
            text-align: center;
            border-radius: 8px;
            background: #009688;
            padding: 8px;
        }

        @-webkit-keyframes badbounce {
            0%,100% {
                -webkit-transform: translateY(0px);
            }
            10% {
                -webkit-transform: translateY(6px);
            }
            30% {
                -webkit-transform: translateY(-4px);
            }
            70% {
                -webkit-transform: translateY(3px);
            }
            90% {
                -webkit-transform: translateY(-2px);
            }
        }
        @-moz-keyframes badbounce {
            0%,100% {
                -moz-transform: translateY(0px);
            }
            10% {
                -moz-transform: translateY(6px);
            }
            30% {
                -moz-transform: translateY(-4px);
            }
            70% {
                -moz-transform: translateY(3px);
            }
            90% {
                -moz-transform: translateY(-2px);
            }
        }
        @keyframes badbounce {
            0%,100% {
                -webkit-transform: translateY(0px);
                -moz-transform: translateY(0px);
                -ms-transform: translateY(0px);
                -o-transform: translateY(0px);
                transform: translateY(0px);
            }
            10% {
                -webkit-transform: translateY(6px);
                -moz-transform: translateY(6px);
                -ms-transform: translateY(6px);
                -o-transform: translateY(6px);
                transform: translateY(6px);
            }
            30% {
                -webkit-transform: translateY(-4px);
                -moz-transform: translateY(-4px);
                -ms-transform: translateY(-4px);
                -o-transform: translateY(-4px);
                transform: translateY(-4px);
            }
            70% {
                -webkit-transform: translateY(3px);
                -moz-transform: translateY(3px);
                -ms-transform: translateY(3px);
                -o-transform: translateY(3px);
                transform: translateY(3px);
            }
            90% {
                -webkit-transform: translateY(-2px);
                -moz-transform: translateY(-2px);
                -ms-transform: translateY(-2px);
                -o-transform: translateY(-2px);
                transform: translateY(-2px);
            }
        }
        .ss_animate {
            -webkit-animation: badbounce 1s linear;
            -moz-animation: badbounce 1s linear;
            animation: badbounce 1s linear;
        }



        #ss_menu {
            bottom: 30px;
            width: 60px;
            height: 60px;
            color: #fff;
            position: fixed;
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            transition: all 1s ease;
            right: 30px;
            -webkit-transform: rotate(180deg);
            -moz-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            -o-transform: rotate(180deg);
            transform: rotate(180deg);
        }
        #ss_menu > .menu {
            display: block;
            position: absolute;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.23), 0 3px 10px rgba(0, 0, 0, 0.16);
            color: #fff;
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            transition: all 1s ease;
        }
        #ss_menu > .menu .share {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0px;
            top: 0px;
            -webkit-transform: rotate(180deg);
            -moz-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            -o-transform: rotate(180deg);
            transform: rotate(180deg);
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            transition: all 1s ease;
        }
        #ss_menu > .menu .share .circle {
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            transition: all 1s ease;
            position: absolute;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #fff;
            top: 50%;
            margin-top: -6px;
            left: 12px;
            opacity: 1;
        }
        #ss_menu > .menu .share .circle:after, #ss_menu > .menu .share .circle:before {
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            transition: all 1s ease;
            content: '';
            opacity: 1;
            display: block;
            position: absolute;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #fff;
        }
        #ss_menu > .menu .share .circle:after {
            left: 20.78461px;
            top: 12px;
        }
        #ss_menu > .menu .share .circle:before {
            left: 20.78461px;
            top: -12px;
        }
        #ss_menu > .menu .share .bar {
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            transition: all 1s ease;
            width: 24px;
            height: 3px;
            background: #fff;
            position: absolute;
            top: 50%;
            margin-top: -1.5px;
            left: 18px;
            -webkit-transform-origin: 0% 50%;
            -moz-transform-origin: 0% 50%;
            -ms-transform-origin: 0% 50%;
            -o-transform-origin: 0% 50%;
            transform-origin: 0% 50%;
            -webkit-transform: rotate(30deg);
            -moz-transform: rotate(30deg);
            -ms-transform: rotate(30deg);
            -o-transform: rotate(30deg);
            transform: rotate(30deg);
        }
        #ss_menu > .menu .share .bar:before {
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            transition: all 1s ease;
            content: '';
            width: 24px;
            height: 3px;
            background: #fff;
            position: absolute;
            left: 0px;
            -webkit-transform-origin: 0% 50%;
            -moz-transform-origin: 0% 50%;
            -ms-transform-origin: 0% 50%;
            -o-transform-origin: 0% 50%;
            transform-origin: 0% 50%;
            -webkit-transform: rotate(-60deg);
            -moz-transform: rotate(-60deg);
            -ms-transform: rotate(-60deg);
            -o-transform: rotate(-60deg);
            transform: rotate(-60deg);
        }
        #ss_menu > .menu .share.close .circle {
            opacity: 0;
        }
        #ss_menu > .menu .share.close .bar {
            top: 50%;
            margin-top: -1.5px;
            left: 50%;
            margin-left: -12px;
            -webkit-transform-origin: 50% 50%;
            -moz-transform-origin: 50% 50%;
            -ms-transform-origin: 50% 50%;
            -o-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
            -webkit-transform: rotate(405deg);
            -moz-transform: rotate(405deg);
            -ms-transform: rotate(405deg);
            -o-transform: rotate(405deg);
            transform: rotate(405deg);
        }
        #ss_menu > .menu .share.close .bar:before {
            -webkit-transform-origin: 50% 50%;
            -moz-transform-origin: 50% 50%;
            -ms-transform-origin: 50% 50%;
            -o-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
            -webkit-transform: rotate(-450deg);
            -moz-transform: rotate(-450deg);
            -ms-transform: rotate(-450deg);
            -o-transform: rotate(-450deg);
            transform: rotate(-450deg);
        }
        #ss_menu > .menu.ss_active {
            background: #00796B;
            -webkit-transform: scale(0.7);
            -moz-transform: scale(0.7);
            -ms-transform: scale(0.7);
            -o-transform: scale(0.7);
            transform: scale(0.7);
        }
        #ss_menu > div {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            position: absolute;
            width: 60px;
            height: 60px;
            font-size: 30px;
            text-align: center;
            background: #00796B;
            border-radius: 50%;
            display: table;
        }
        #ss_menu > div i {
            display: table-cell;
            vertical-align: middle;
        }
        #ss_menu > div:hover {
            background: #009688;
            cursor: pointer;
        }
        #ss_menu div:nth-child(1) {
            top: 0px;
            left: -160px;
        }
        #ss_menu div:nth-child(2) {
            top: -80px;
            left: -138.56406px;
        }
        #ss_menu div:nth-child(3) {
            top: -138.56406px;
            left: -80px;
        }
        #ss_menu div:nth-child(4) {
            top: -160px;
            left: 0px;
        }



    </style>
    <script>


        $(document).ready(function() {
            var toggle = $('#ss_toggle');
            var menu = $('#ss_menu');
            var rot;
            $('#ss_toggle').on('click', function (ev) {
                rot = parseInt($(this).data('rot')) - 180;
                menu.css('transform', 'rotate(' + rot + 'deg)');
                menu.css('webkitTransform', 'rotate(' + rot + 'deg)');
                if ((rot / 180) % 2 == 0) {
                    //Moving in
                    toggle.parent().addClass('ss_active');
                    toggle.addClass('close');
                } else {
                    //Moving Out
                    toggle.parent().removeClass('ss_active');
                    toggle.removeClass('close');
                }
                $(this).data('rot', rot);
            });

            menu.on('transitionend webkitTransitionEnd oTransitionEnd', function () {
                if ((rot / 180) % 2 == 0) {
                    $('#ss_menu div i').addClass('ss_animate');
                } else {
                    $('#ss_menu div i').removeClass('ss_animate');
                }
            });
        });

        $(function () {

            if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
            var $ = go.GraphObject.make;
            myDiagram =
                    $(go.Diagram, "myDiagramDiv",
                            {
                                initialAutoScale: go.Diagram.Uniform,
                                initialContentAlignment: go.Spot.Center,
                                "undoManager.isEnabled": true,
                                // when a node is selected, draw a big yellow circle behind it
                                nodeSelectionAdornmentTemplate:
                                        $(go.Adornment, "Auto",
                                                { layerName: "Grid" },  // the predefined layer that is behind everything else
                                                $(go.Shape, "Circle", { fill: "yellow", stroke: null }),
                                                $(go.Placeholder)
                                        ),
                                layout:  // use a custom layout, defined below
                                        $(GenogramLayout, { direction: 90, layerSpacing: 30, columnSpacing: 10 })
                            });

            // determine the color for each attribute shape
            // ขาวหมด, ดำหมด, สองส่วน, สามส่วน, สี่ส่วน
            function attrFill(a) {
                switch (a) {
                    case "B1": return "black";
                    case "B2": return "black";
                    case "B3": return "black";
                    case "B4": return "black";
                    case "TW1": return "blue";
                    case "TW2": return "blue";
                    case "TW3": return "purple";
                    case "TW4": return "purple";
                    case "TH1": return "blue";
                    case "TH2": return "purple";
                    case "TH3": return "pink";
                    case "FO1": return "blue";
                    case "FO2": return "purple";
                    case "FO3": return "pink";
                    case "FO4": return "magenta";
                    case "E": return "gold";
                    case "F": return "pink";
                    case "G": return "blue";
                    case "H": return "brown";
                    case "I": return "purple";
                    case "J": return "chartreuse";
                    case "K": return "lightgray";
                    case "L": return "magenta";
                    case "S": return "red";
                    default: return "transparent";
                }
            }


            // determine the geometry for each attribute shape in a male;
            // except for the slash these are all squares at each of the four corners of the overall square
            var tlsq = go.Geometry.parse("F M1 1 l19 0 0 19 -19 0z"); // ซ้ายบน
            var trsq = go.Geometry.parse("F M20 1 l19 0 0 19 -19 0z"); // ขวาบน
            var brsq = go.Geometry.parse("F M20 20 l19 0 0 19 -19 0z"); // ขวาล่าง
            var blsq = go.Geometry.parse("F M1 20 l19 0 0 19 -19 0z"); // ซ้ายล่าง
            var slash = go.Geometry.parse("F M38 0 L40 0 40 2 2 40 0 40 0 38z");
            function maleGeometry(a) {
                switch (a) {
                    case "B1": return tlsq;
                    case "B2": return trsq;
                    case "B3": return blsq;
                    case "B4": return brsq;
                    case "TW1": return tlsq;
                    case "TW3": return trsq;
                    case "TW2": return blsq;
                    case "TW4": return brsq;
                    case "TH1": return tlsq;
                    case "TH3": return trsq;
                    case "TH2": return blsq;
                    case "FO1": return tlsq;
                    case "FO2": return trsq;
                    case "FO3": return blsq;
                    case "FO4": return brsq;
                    case "A": return tlsq;
                    case "B": return tlsq;
                    case "C": return tlsq;
                    case "D": return trsq;
                    case "E": return trsq;
                    case "F": return trsq;
                    case "G": return brsq;
                    case "H": return brsq;
                    case "I": return brsq;
                    case "J": return blsq;
                    case "K": return blsq;
                    case "L": return blsq;
                    case "S": return slash;
                    default: return tlsq;
                }
            }

            // determine the geometry for each attribute shape in a female;
            // except for the slash these are all pie shapes at each of the four quadrants of the overall circle
            var tlarc = go.Geometry.parse("F M20 20 B 180 90 20 20 19 19 z");
            var trarc = go.Geometry.parse("F M20 20 B 270 90 20 20 19 19 z");
            var brarc = go.Geometry.parse("F M20 20 B 0 90 20 20 19 19 z");
            var blarc = go.Geometry.parse("F M20 20 B 90 90 20 20 19 19 z");
            function femaleGeometry(a) {
                switch (a) {
                    case "TH1": return tlarc;
                    case "TH3": return trarc;
                    case "TH2": return blarc;
                    case "A": return tlarc;
                    case "B": return tlarc;
                    case "C": return tlarc;
                    case "D": return trarc;
                    case "E": return trarc;
                    case "F": return trarc;
                    case "G": return brarc;
                    case "H": return brarc;
                    case "I": return brarc;
                    case "J": return blarc;
                    case "K": return blarc;
                    case "L": return blarc;
                    case "S": return slash;
                    default: return tlarc;
                }
            }


            // determine the geometry for each attribute shape in a none sex;
            // except for the slash these are all pie shapes at each of the four quadrants of the overall Diamond
            var tladi = go.Geometry.parse("F M20 20 B 180 90 20 20 19 19 z");
            var tradi = go.Geometry.parse("F M20 1 l19 0 0 19 -19 0z");
            var bradi = go.Geometry.parse("F M20 20 B 0 90 20 20 19 19 z");
            var bladi = go.Geometry.parse("F M20 20 B 90 90 20 20 19 19 z");
            function noneSexGeometry(a) {
                switch (a) {
                    case "A": return tladi;
                    case "B": return tladi;
                    case "C": return tladi;
                    case "D": return tradi;
                    case "E": return tradi;
                    case "F": return tradi;
                    case "G": return bradi;
                    case "H": return bradi;
                    case "I": return bradi;
                    case "J": return bladi;
                    case "K": return bladi;
                    case "L": return bladi;
                    case "S": return slash;
                    default: return tladi;
                }
            }


            // two different node templates, one for each sex,
            // named by the category value in the node data object
            myDiagram.nodeTemplateMap.add("M",  // male
                    $(go.Node, "Vertical",
                            { locationSpot: go.Spot.Center, locationObjectName: "ICON" },
                            $(go.Panel,
                                    { name: "ICON" },
                                    $(go.Shape, "Square",
                                            { width: 40, height: 40, strokeWidth: 2, fill: "white", portId: "" }),
                                    $(go.Panel,
                                            { // for each attribute show a Shape at a particular place in the overall square
                                                itemTemplate:
                                                        $(go.Panel,
                                                                $(go.Shape,
                                                                        { stroke: null, strokeWidth: 0 },
                                                                        new go.Binding("fill", "", attrFill),
                                                                        new go.Binding("geometry", "", maleGeometry))
                                                        ),
                                                margin: 1
                                            },
                                            new go.Binding("itemArray", "a")
                                    )
                            ),
                            $(go.TextBlock,
                                    { textAlign: "center", maxSize: new go.Size(80, NaN) },
                                    new go.Binding("text", "n"))
                    ));

            myDiagram.nodeTemplateMap.add("F",  // female
                    $(go.Node, "Vertical",
                            { locationSpot: go.Spot.Center, locationObjectName: "ICON" },
                            $(go.Panel,
                                    { name: "ICON" },
                                    $(go.Shape, "Circle",
                                            { width: 40, height: 40, strokeWidth: 2, fill: "white", portId: "" }),
                                    $(go.Panel,
                                            { // for each attribute show a Shape at a particular place in the overall circle
                                                itemTemplate:
                                                        $(go.Panel,
                                                                $(go.Shape,
                                                                        { stroke: null, strokeWidth: 0 },
                                                                        new go.Binding("fill", "", attrFill),
                                                                        new go.Binding("geometry", "", femaleGeometry))
                                                        ),
                                                margin: 1
                                            },
                                            new go.Binding("itemArray", "a")
                                    )
                            ),
                            $(go.TextBlock,
                                    { textAlign: "center", maxSize: new go.Size(80, NaN) },
                                    new go.Binding("text", "n"))
                    ));

            myDiagram.nodeTemplateMap.add("N",  // none sex
                    $(go.Node, "Vertical",
                            { locationSpot: go.Spot.Center, locationObjectName: "ICON" },
                            $(go.Panel,
                                    { name: "ICON" },
                                    $(go.Shape, "Diamond",
                                            { width: 40, height: 40, strokeWidth: 2, fill: "white", portId: "" }),
                                    $(go.Panel,
                                            { // for each attribute show a Shape at a particular place in the overall circle
                                                itemTemplate:
                                                        $(go.Panel,
                                                                $(go.Shape,
                                                                        { stroke: null, strokeWidth: 0 },
                                                                        new go.Binding("fill", "", attrFill),
                                                                        new go.Binding("geometry", "", noneSexGeometry))
                                                        ),
                                                margin: 1
                                            },
                                            new go.Binding("itemArray", "a")
                                    )
                            ),
                            $(go.TextBlock,
                                    { textAlign: "center", maxSize: new go.Size(80, NaN) },
                                    new go.Binding("text", "n"))
                    ));

            // the representation of each label node -- nothing shows on a Marriage Link
            myDiagram.nodeTemplateMap.add("LinkLabel",
                    $(go.Node, { selectable: false, width: 1, height: 1, fromEndSegmentLength: 20 }));


            myDiagram.linkTemplate =  // for parent-child relationships
                    $(go.Link,
                            {
                                routing: go.Link.Orthogonal, curviness: 15,
                                layerName: "Background", selectable: false,
                                fromSpot: go.Spot.Bottom, toSpot: go.Spot.Top
                            },
                            $(go.Shape, { strokeWidth: 2 })
                    );

            myDiagram.linkTemplateMap.add("Marriage",  // for marriage relationships
                    $(go.Link,
                            { selectable: false },
                            $(go.Shape, { strokeWidth: 2, stroke: "blue" })
                    ));


            // n: name, s: sex, m: mother, f: father, ux: wife, vir: husband, a: attributes/markers
            setupDiagram(myDiagram, [



                        { key: -50, n: "เทพสุธา ธนันสิดากร 39 y ", s: "M", ux: -51, a: ["B1", "B2", "B3", "B4", "S"] },
                        { key: -51, n: "จิรดาณัท ธนันสิดากร 34 y ", s: "F" },
                        { key: 3, n: "พรรณพรรษ นันท์วิชกรณ์ 24 y", s: "F", m: -50, f: -51, a: ["TH1", "TH2", "TH3"] },
                        { key: 4, n: "ภัณณิพงศ์ ธนันสิดากร 27 y", s: "M", ux: 3 },
                        { key: 5, n: "พงษ์ธณัฐ  ธนันสิดากร 4 y", s: "M", m: 3, f: 4, a: ["FO1", "FO2", "FO3", "FO4"] },
                        { key: 6, n: "นารีรัตน์ ธนันสิดากร 1 m 1 w", s: "N", m: 3, f: 4 },
                        { key: 1, n: "ปัณน์ญะพัทธ์ ธนันสิดากร 22 y", s: "M", m: -50, f: -51, a: ["TW1", "TW2", "TW3", "TW4"] },
                        { key: 2, n: "มณจนาภัทธ์ ธนันสิดากร 20 y", s: "F", m: -50, f: -51 }





                    ],
                    4 /* focus on this person */);


        })




        // create and initialize the Diagram.model given an array of node data representing people
        function setupDiagram(diagram, array, focusId) {
            diagram.model =
                    go.GraphObject.make(go.GraphLinksModel,
                            { // declare support for link label nodes
                                linkLabelKeysProperty: "labelKeys",
                                // this property determines which template is used
                                nodeCategoryProperty: "s",
                                // create all of the nodes for people
                                nodeDataArray: array
                            });
            setupMarriages(diagram);
            setupParents(diagram);

            var node = diagram.findNodeForKey(focusId);
            if (node !== null) {
                diagram.select(node);
                // remove any spouse for the person under focus:
                //node.linksConnected.each(function(l) {
                //  if (!l.isLabeledLink) return;
                //  l.opacity = 0;
                //  var spouse = l.getOtherNode(node);
                //  spouse.opacity = 0;
                //  spouse.pickable = false;
                //});
            }
        }

        function findMarriage(diagram, a, b) {  // A and B are node keys
            var nodeA = diagram.findNodeForKey(a);
            var nodeB = diagram.findNodeForKey(b);
            if (nodeA !== null && nodeB !== null) {
                var it = nodeA.findLinksBetween(nodeB);  // in either direction
                while (it.next()) {
                    var link = it.value;
                    // Link.data.category === "Marriage" means it's a marriage relationship
                    if (link.data !== null && link.data.category === "Marriage") return link;
                }
            }
            return null;
        }

        // now process the node data to determine marriages
        function setupMarriages(diagram) {
            var model = diagram.model;
            var nodeDataArray = model.nodeDataArray;
            for (var i = 0; i < nodeDataArray.length; i++) {
                var data = nodeDataArray[i];
                var key = data.key;
                var uxs = data.ux;
                if (uxs !== undefined) {
                    if (typeof uxs === "number") uxs = [uxs];
                    for (var j = 0; j < uxs.length; j++) {
                        var wife = uxs[j];
                        if (key === wife) {
                            // or warn no reflexive marriages
                            continue;
                        }
                        var link = findMarriage(diagram, key, wife);
                        if (link === null) {
                            // add a label node for the marriage link
                            var mlab = { s: "LinkLabel" };
                            model.addNodeData(mlab);
                            // add the marriage link itself, also referring to the label node
                            var mdata = { from: key, to: wife, labelKeys: [mlab.key], category: "Marriage" };
                            model.addLinkData(mdata);
                        }
                    }
                }
                var virs = data.vir;
                if (virs !== undefined) {
                    if (typeof virs === "number") virs = [virs];
                    for (var j = 0; j < virs.length; j++) {
                        var husband = virs[j];
                        if (key === husband) {
                            // or warn no reflexive marriages
                            continue;
                        }
                        var link = findMarriage(diagram, key, husband);
                        if (link === null) {
                            // add a label node for the marriage link
                            var mlab = { s: "LinkLabel" };
                            model.addNodeData(mlab);
                            // add the marriage link itself, also referring to the label node
                            var mdata = { from: key, to: husband, labelKeys: [mlab.key], category: "Marriage" };
                            model.addLinkData(mdata);
                        }
                    }
                }
            }
        }

        // process parent-child relationships once all marriages are known
        function setupParents(diagram) {
            var model = diagram.model;
            var nodeDataArray = model.nodeDataArray;
            for (var i = 0; i < nodeDataArray.length; i++) {
                var data = nodeDataArray[i];
                var key = data.key;
                var mother = data.m;
                var father = data.f;
                if (mother !== undefined && father !== undefined) {
                    var link = findMarriage(diagram, mother, father);
                    if (link === null) {
                        // or warn no known mother or no known father or no known marriage between them
                        if (window.console) window.console.log("unknown marriage: " + mother + " & " + father);
                        continue;
                    }
                    var mdata = link.data;
                    var mlabkey = mdata.labelKeys[0];
                    var cdata = { from: mlabkey, to: key };
                    myDiagram.model.addLinkData(cdata);
                }
            }
        }


        // A custom layout that shows the two families related to a person's parents
        function GenogramLayout() {
            go.LayeredDigraphLayout.call(this);
            this.initializeOption = go.LayeredDigraphLayout.InitDepthFirstIn;
            this.spouseSpacing = 30;  // minimum space between spouses
        }
        go.Diagram.inherit(GenogramLayout, go.LayeredDigraphLayout);

        /** @override */
        GenogramLayout.prototype.makeNetwork = function (coll) {
            // generate LayoutEdges for each parent-child Link
            var net = this.createNetwork();
            if (coll instanceof go.Diagram) {
                this.add(net, coll.nodes, true);
                this.add(net, coll.links, true);
            } else if (coll instanceof go.Group) {
                this.add(net, coll.memberParts, false);
            } else if (coll.iterator) {
                this.add(net, coll.iterator, false);
            }
            return net;
        };

        // internal method for creating LayeredDigraphNetwork where husband/wife pairs are represented
        // by a single LayeredDigraphVertex corresponding to the label Node on the marriage Link
        GenogramLayout.prototype.add = function (net, coll, nonmemberonly) {
            var multiSpousePeople = new go.Set();
            // consider all Nodes in the given collection
            var it = coll.iterator;
            while (it.next()) {
                var node = it.value;
                if (!(node instanceof go.Node)) continue;
                if (!node.isLayoutPositioned || !node.isVisible()) continue;
                if (nonmemberonly && node.containingGroup !== null) continue;
                // if it's an unmarried Node, or if it's a Link Label Node, create a LayoutVertex for it
                if (node.isLinkLabel) {
                    // get marriage Link
                    var link = node.labeledLink;
                    var spouseA = link.fromNode;
                    var spouseB = link.toNode;
                    // create vertex representing both husband and wife
                    var vertex = net.addNode(node);
                    // now define the vertex size to be big enough to hold both spouses
                    vertex.width = spouseA.actualBounds.width + this.spouseSpacing + spouseB.actualBounds.width;
                    vertex.height = Math.max(spouseA.actualBounds.height, spouseB.actualBounds.height);
                    vertex.focus = new go.Point(spouseA.actualBounds.width + this.spouseSpacing / 2, vertex.height / 2);
                } else {
                    // don't add a vertex for any married person!
                    // instead, code above adds label node for marriage link
                    // assume a marriage Link has a label Node
                    var marriages = 0;
                    node.linksConnected.each(function (l) { if (l.isLabeledLink) marriages++; });
                    if (marriages === 0) {
                        var vertex = net.addNode(node);
                    } else if (marriages > 1) {
                        multiSpousePeople.add(node);
                    }
                }
            }
            // now do all Links
            it.reset();
            while (it.next()) {
                var link = it.value;
                if (!(link instanceof go.Link)) continue;
                if (!link.isLayoutPositioned || !link.isVisible()) continue;
                if (nonmemberonly && link.containingGroup !== null) continue;
                // if it's a parent-child link, add a LayoutEdge for it
                if (!link.isLabeledLink) {
                    var parent = net.findVertex(link.fromNode);  // should be a label node
                    var child = net.findVertex(link.toNode);
                    if (child !== null) {  // an unmarried child
                        net.linkVertexes(parent, child, link);
                    } else {  // a married child
                        link.toNode.linksConnected.each(function (l) {
                            if (!l.isLabeledLink) return;  // if it has no label node, it's a parent-child link
                            // found the Marriage Link, now get its label Node
                            var mlab = l.labelNodes.first();
                            // parent-child link should connect with the label node,
                            // so the LayoutEdge should connect with the LayoutVertex representing the label node
                            var mlabvert = net.findVertex(mlab);
                            if (mlabvert !== null) {
                                net.linkVertexes(parent, mlabvert, link);
                            }
                        });
                    }
                }
            }

            while (multiSpousePeople.count > 0) {
                // find all collections of people that are indirectly married to each other
                var node = multiSpousePeople.first();
                var cohort = new go.Set();
                this.extendCohort(cohort, node);
                // then encourage them all to be the same generation by connecting them all with a common vertex
                var dummyvert = net.createVertex();
                net.addVertex(dummyvert);
                var marriages = new go.Set();
                cohort.each(function (n) {
                    n.linksConnected.each(function (l) {
                        marriages.add(l);
                    })
                });
                marriages.each(function (link) {
                    // find the vertex for the marriage link (i.e. for the label node)
                    var mlab = link.labelNodes.first()
                    var v = net.findVertex(mlab);
                    if (v !== null) {
                        net.linkVertexes(dummyvert, v, null);
                    }
                });
                // done with these people, now see if there are any other multiple-married people
                multiSpousePeople.removeAll(cohort);
            }
        };

        // collect all of the people indirectly married with a person
        GenogramLayout.prototype.extendCohort = function (coll, node) {
            if (coll.contains(node)) return;
            coll.add(node);
            var lay = this;
            node.linksConnected.each(function (l) {
                if (l.isLabeledLink) {  // if it's a marriage link, continue with both spouses
                    lay.extendCohort(coll, l.fromNode);
                    lay.extendCohort(coll, l.toNode);
                }
            });
        };

        /** @override */
        GenogramLayout.prototype.assignLayers = function () {
            go.LayeredDigraphLayout.prototype.assignLayers.call(this);
            var horiz = this.direction == 0.0 || this.direction == 180.0;
            // for every vertex, record the maximum vertex width or height for the vertex's layer
            var maxsizes = [];
            this.network.vertexes.each(function (v) {
                var lay = v.layer;
                var max = maxsizes[lay];
                if (max === undefined) max = 0;
                var sz = (horiz ? v.width : v.height);
                if (sz > max) maxsizes[lay] = sz;
            });
            // now make sure every vertex has the maximum width or height according to which layer it is in,
            // and aligned on the left (if horizontal) or the top (if vertical)
            this.network.vertexes.each(function (v) {
                var lay = v.layer;
                var max = maxsizes[lay];
                if (horiz) {
                    v.focus = new go.Point(0, v.height / 2);
                    v.width = max;
                } else {
                    v.focus = new go.Point(v.width / 2, 0);
                    v.height = max;
                }
            });
            // from now on, the LayeredDigraphLayout will think that the Node is bigger than it really is
            // (other than the ones that are the widest or tallest in their respective layer).
        };

        /** @override */
        GenogramLayout.prototype.commitNodes = function () {
            go.LayeredDigraphLayout.prototype.commitNodes.call(this);
            // position regular nodes
            this.network.vertexes.each(function (v) {
                if (v.node !== null && !v.node.isLinkLabel) {
                    v.node.position = new go.Point(v.x, v.y);
                }
            });
            // position the spouses of each marriage vertex
            var layout = this;
            this.network.vertexes.each(function (v) {
                if (v.node === null) return;
                if (!v.node.isLinkLabel) return;
                var labnode = v.node;
                var lablink = labnode.labeledLink;
                // In case the spouses are not actually moved, we need to have the marriage link
                // position the label node, because LayoutVertex.commit() was called above on these vertexes.
                // Alternatively we could override LayoutVetex.commit to be a no-op for label node vertexes.
                lablink.invalidateRoute();
                var spouseA = lablink.fromNode;
                var spouseB = lablink.toNode;
                // prefer fathers on the left, mothers on the right
                if (spouseA.data.s === "F") {  // sex is female
                    var temp = spouseA;
                    spouseA = spouseB;
                    spouseB = temp;
                }
                // see if the parents are on the desired sides, to avoid a link crossing
                var aParentsNode = layout.findParentsMarriageLabelNode(spouseA);
                var bParentsNode = layout.findParentsMarriageLabelNode(spouseB);
                if (aParentsNode !== null && bParentsNode !== null && aParentsNode.position.x > bParentsNode.position.x) {
                    // swap the spouses
                    var temp = spouseA;
                    spouseA = spouseB;
                    spouseB = temp;
                }
                spouseA.position = new go.Point(v.x, v.y);
                spouseB.position = new go.Point(v.x + spouseA.actualBounds.width + layout.spouseSpacing, v.y);
                if (spouseA.opacity === 0) {
                    var pos = new go.Point(v.centerX - spouseA.actualBounds.width / 2, v.y);
                    spouseA.position = pos;
                    spouseB.position = pos;
                } else if (spouseB.opacity === 0) {
                    var pos = new go.Point(v.centerX - spouseB.actualBounds.width / 2, v.y);
                    spouseA.position = pos;
                    spouseB.position = pos;
                }
            });
            // position only-child nodes to be under the marriage label node
            this.network.vertexes.each(function (v) {
                if (v.node === null || v.node.linksConnected.count > 1) return;
                var mnode = layout.findParentsMarriageLabelNode(v.node);
                if (mnode !== null && mnode.linksConnected.count === 1) {  // if only one child
                    var mvert = layout.network.findVertex(mnode);
                    var newbnds = v.node.actualBounds.copy();
                    newbnds.x = mvert.centerX - v.node.actualBounds.width / 2;
                    // see if there's any empty space at the horizontal mid-point in that layer
                    var overlaps = layout.diagram.findObjectsIn(newbnds, function (x) { return x.part; }, function (p) { return p !== v.node; }, true);
                    if (overlaps.count === 0) {
                        v.node.move(newbnds.position);
                    }
                }
            });
        };

        GenogramLayout.prototype.findParentsMarriageLabelNode = function (node) {
            var it = node.findNodesInto();
            while (it.next()) {
                var n = it.value;
                if (n.isLinkLabel) return n;
            }
            return null;
        };
        // end GenogramLayout class
    </script>

    </head>
    <body>
    <div id='ss_menu' style="position:fixed;z-index:1000">
        <div>
            <i class="fa fa-cloud-download"  title="Download" ></i>
        </div>
        <div>
            <i class="fa fa-reply" title="Back to previous page"></i>
        </div>
        <div>
            <i class="glyphicon glyphicon-trash" title="Clear all relationships"></i>
        </div>
        <div>
            <i class="fa fa-step-backward" title="Undo"></i>
        </div>
        <div class='menu'>
            <div class='share' id='ss_toggle' data-rot='180'>
                <div class='circle'></div>
                <div class='bar'></div>
            </div>
        </div>
    </div>
    <!-- The DIV for a Diagram needs an explicit size or else we will not see anything.
     In this case we also add a background color so we can see that area. -->
    <div id="myDiagramDiv"
         style="width: auto; height: 100vh; background-color: #DAE4E4;">
    </div>
    </body>
@endsection