OrgChart.templates.cool = Object.assign({}, OrgChart.templates.ana,OrgChart.templates.ula, OrgChart.templates.olivia);
OrgChart.templates.cool.defs = '<filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="cool-shadow"><feOffset dx="0" dy="4" in="SourceAlpha" result="shadowOffsetOuter1" /><feGaussianBlur stdDeviation="10" in="shadowOffsetOuter1" result="shadowBlurOuter1" /><feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.1 0" in="shadowBlurOuter1" type="matrix" result="shadowMatrixOuter1" /><feMerge><feMergeNode in="shadowMatrixOuter1" /><feMergeNode in="SourceGraphic" /></feMerge></filter>';

OrgChart.templates.cool.size = [310, 190];
OrgChart.templates.cool.node = '<rect filter="url(#cool-shadow)"  x="0" y="0" height="190" width="310" fill="#ffffff" stroke-width="1" stroke="#eeeeee" rx="10" ry="10"></rect><rect fill="#ffffff" x="100" y="10" width="200" height="100" rx="10" ry="10" filter="url(#cool-shadow)"></rect><rect stroke="#eeeeee" stroke-width="1" x="10" y="120" width="220" fill="#ffffff" rx="10" ry="10" height="60"></rect><rect stroke="#eeeeee" stroke-width="1" x="240" y="120" width="60" fill="#ffffff" rx="10" ry="10" height="60"></rect><text  style="font-size: 11px;" fill="#afafaf" x="110" y="60">PERFORMANCE</text>'
    + '<image  xlink:href="https://cdn.balkan.app/shared/speedometer.svg" x="110" y="65" width="32" height="32"></image>';

OrgChart.templates.cool.img = '<clipPath id="{randId}"><rect  fill="#ffffff" stroke="#039BE5" stroke-width="5" x="10" y="10" rx="10" ry="10" width="80" height="100"></rect></clipPath><image preserveAspectRatio="xMidYMid slice" clip-path="url(#{randId})" xlink:href="{val}" x="10" y="10"  width="80" height="100"></image><rect fill="none" stroke="#F57C00" stroke-width="2" x="10" y="10" rx="10" ry="10" width="80" height="100"></rect>';

OrgChart.templates.cool.name = '<text  style="font-size: 18px;" fill="#afafaf" x="110" y="30">{val}</text>';
OrgChart.templates.cool.title = '<text  style="font-size: 14px;" fill="#F57C00" x="20" y="145">{val}</text>';
OrgChart.templates.cool.title2 = '<text style="font-size: 14px;" fill="#afafaf" x="20" y="165">{val}</text>';
OrgChart.templates.cool.points = '<text style="font-size: 24px;" fill="#F57C00" x="270" y="165" text-anchor="middle">{val}</text>';
OrgChart.templates.cool.performance = '<text style="font-size: 24px;" fill="#F57C00" x="150" y="90" >{val}</text>';
OrgChart.templates.cool.svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="background-color:#F2F2F2;display:block;" width="{w}" height="{h}" viewBox="{viewBox}">{content}</svg>';
OrgChart.templates.cool.nodeMenuButton =
    '<g style="cursor:pointer;" transform="matrix(1,0,0,1,270,20)" data-ctrl-n-menu-id="{id}">'
    + '<rect x="-4" y="-10" fill="#000000" fill-opacity="0" width="22" height="22"></rect>'
    + '<circle cx="0" cy="0" r="2" fill="#F57C00"></circle>'
    + '<circle cx="7" cy="0" r="2" fill="#F57C00"></circle><circle cx="14" cy="0" r="2" fill="#F57C00"></circle>'
    + '</g>';

OrgChart.templates.itTemplate = Object.assign({}, OrgChart.templates.ana);

OrgChart.templates.invisibleGroup.padding = [20, 0, 0, 0];


var chart;
chart = new OrgChart(document.getElementById('tree'), {
    mouseScrool: OrgChart.none,
    mouseScrool: OrgChart.action.ctrlZoom,
    nodeMouseClick: OrgChart.action.edit,
    //nodeMouseClick: false,
    template: 'cool',
    assistantSeparation: 160,
    nodeBinding: {
        name: 'name',
        title: 'title',
        title2: 'title2',
        points: 'points',
        performance: 'performance',
        img: 'img'
    },
    menu: {
        pdfPreview: {
            text: "Export to PDF",
            icon: OrgChart.icon.pdf(24, 24, '#7A7A7A'),
            onClick: preview
        },
        csv: { text: "Save as CSV" }
    },
    nodeMenu: {
        details: { text: "Details" },
        edit: { text: "Edit" },
        add: { text: "Add" },
        remove: { text: "Remove" }
    },
    align: OrgChart.ORIENTATION,
    toolbar: {
        fullScreen: true,
        zoom: true,
        fit: true,
        expandAll: true
    },
    tags: {
        "top-management": {
            template: "invisibleGroup",
            subTreeConfig: {
                orientation: OrgChart.orientation.bottom,
                collapse: {
                    level: 1
                }
            }
        },
        "it-team": {
            subTreeConfig: {
                layout: OrgChart.mixed,
                collapse: {
                    level: 1
                }
            },
        },
        "hr-team": {
            subTreeConfig: {
                layout: OrgChart.treeRightOffset,
                collapse: {
                    level: 1
                }
            },
        },
        "sales-team": {
            subTreeConfig: {
                layout: OrgChart.treeLeftOffset,
                collapse: {
                    level: 1
                }
            },
        },
        "seo-menu": {
            nodeMenu: {
                addSharholder: { text: "Add new sharholder", icon: OrgChart.icon.add(24, 24, "#7A7A7A"), onClick: addSharholder },
                addDepartment: { text: "Add new department", icon: OrgChart.icon.add(24, 24, "#7A7A7A"), onClick: addDepartment },
                addAssistant: { text: "Add new assitsant", icon: OrgChart.icon.add(24, 24, "#7A7A7A"), onClick: addAssistant },
                edit: { text: "Edit" },
                details: { text: "Details" },
            }
        },
        "menu-without-add": {
            nodeMenu: {
                details: { text: "Details" },
                edit: { text: "Edit" },
                remove: { text: "Remove" }
            }
        },
        "department": {
            template: "group",
            nodeMenu: {
                addManager: { text: "Add new manager", icon: OrgChart.icon.add(24, 24, "#7A7A7A"), onClick: addManager },
                remove: { text: "Remove department" },
                edit: { text: "Edit department" },
                nodePdfPreview: { text: "Export department to PDF", icon: OrgChart.icon.pdf(24, 24, "#7A7A7A"), onClick: nodePdfPreview }
            }
        },
        "it-team-member": {
            template: "itTemplate",
        }
    },
});

chart.nodeCircleMenuUI.on('click', function (sender, args) {
    switch (args.menuItem.text) {
        case "Details": chart.editUI.show(args.nodeId, true);
            break;
        case "Add node": {
            var id = chart.generateId();
            chart.addNode({ id: id, pid: args.nodeId, tags: ["it-team-member"] });
        }
            break;
        case "Edit node": chart.editUI.show(args.nodeId);
            break;
        case "Remove node": chart.removeNode(args.nodeId);
            break;
        default:
    };
});

chart.nodeCircleMenuUI.on('drop', function (sender, args) {
    chart.addClink(args.from, args.to).draw(OrgChart.action.update);
});

chart.on("added", function (sender, id) {
    sender.editUI.show(id);
});

chart.on('drop', function (sender, draggedNodeId, droppedNodeId) {
    var draggedNode = sender.getNode(draggedNodeId);
    var droppedNode = sender.getNode(droppedNodeId);

    if (droppedNode.tags.indexOf("department") != -1 && draggedNode.tags.indexOf("department") == -1) {
        var draggedNodeData = sender.get(draggedNode.id);
        draggedNodeData.pid = null;
        draggedNodeData.stpid = droppedNode.id;
        sender.updateNode(draggedNodeData);
        return false;
    }
});

/*
chart.on('exportstart', function (sender, args) {
    args.styles = document.getElementById('myStyles').outerHTML;
});
*/
chart.load([
    /*{ id: 1, performance: 11, points: 50, name: 'Caden Ellison', title: 'Dev Manager', title2: 'Application Development', img: 'https://cdn.balkan.app/shared/1.jpg' },
    { id: 2, performance: 33, points: 99, name: 'Fran Parsons', title: 'Developer', pid: 1, title2: 'Application Development', img: 'https://cdn.balkan.app/shared/2.jpg' },
    { id: 3, performance: 99, points: 34, name: 'Lynn Hussain', title: 'Sales', pid: 1, title2: 'Application Development', img: 'https://cdn.balkan.app/shared/3.jpg' },
    */
    { id: "top-management", tags: ["top-management"] },
    { id: "hr-team", pid: "top-management", tags: ["hr-team", "department"], name: "HR department" },
    { id: "it-team", pid: "top-management", tags: ["it-team", "department"], name: "IT department" },
    { id: "sales-team", pid: "top-management", tags: ["sales-team", "department"], name: "Sales department" },

    { id: 1, performance: 11, points: 50, stpid: "top-management", name: "Nicky Phillips", title2: 'Application Development', title: "CEO", img: "https://cdn.balkan.app/shared/anim/1.gif", tags: ["seo-menu"] },
    { id: 2, performance: 12, points: 80, pid: 1, name: "Rowan Hall", title: "Shareholder (51%)", title2: 'Application Development', img: "https://cdn.balkan.app/shared/2.jpg", tags: ["menu-without-add"] },
    { id: 3, performance: 13, points: 95, pid: 1, name: "Danni Anderson", title: "Shareholder (49%)", title2: 'Application Development', img: "https://cdn.balkan.app/shared/3.jpg", tags: ["menu-without-add"] },

    { id: 4, performance: 13, points: 95, stpid: "hr-team", name: "Jordan Harris", title: "HR Manager", title2: 'Application Development', img: "https://cdn.balkan.app/shared/4.jpg" },
    { id: 5, performance: 13, points: 95, pid: 4, name: "Emerson Adams", title: "Senior HR", title2: 'Application Development', img: "https://cdn.balkan.app/shared/5.jpg" },
    { id: 6, performance: 13, points: 95, pid: 4, name: "Kai Morgan", title: "Junior HR", title2: 'Application Development', img: "https://cdn.balkan.app/shared/6.jpg" },

    { id: 7, performance: 13, points: 95, stpid: "it-team", name: "Cory Robbins", title: "Core Team Lead", title2: 'Application Development', img: "https://cdn.balkan.app/shared/7.jpg" },
    { id: 8, performance: 13, points: 95, pid: 7, name: "Billie Roach",  title: "Backend Senior Developer", title2: 'Application Development', img: "https://cdn.balkan.app/shared/8.jpg" },
    { id: 9, performance: 13, points: 95, pid: 7, name: "Maddox Hood",  title: "C# Developer", title2: 'Application Development', img: "https://cdn.balkan.app/shared/9.jpg" },
    { id: 10, performance: 13, points: 95, pid: 7, name: "Sam Tyson",  title: "Backend Junior Developer", title2: 'Application Development', img: "https://cdn.balkan.app/shared/10.jpg" },

    { id: 11, performance: 13, points: 95, stpid: "it-team", name: "Lynn Fleming",  title: "UI Team Lead", title2: 'Application Development', img: "https://cdn.balkan.app/shared/11.jpg" },
    { id: 12, performance: 13, points: 95, pid: 11, name: "Jo Baker",  title: "JS Developer", title2: 'Application Development', img: "https://cdn.balkan.app/shared/12.jpg" },
    { id: 13, performance: 13, points: 95, pid: 11, name: "Emerson Lewis",  title: "Graphic Designer", title2: 'Application Development', img: "https://cdn.balkan.app/shared/13.jpg" },
    { id: 14, performance: 13, points: 95, pid: 11, name: "Haiden Atkinson", title: "UX Expert", title2: 'Application Development', img: "https://cdn.balkan.app/shared/14.jpg" },

    { id: 15, performance: 13, points: 95, stpid: "sales-team", name: "Tyler Chavez", title: "Sales Manager", title2: 'Application Development', img: "https://cdn.balkan.app/shared/15.jpg" },
    { id: 16, performance: 13, points: 95, pid: 15, name: "Raylee Allen", title: "Sales", title2: 'Application Development', img: "https://cdn.balkan.app/shared/16.jpg" },
    { id: 17, performance: 13, points: 95, pid: 15, name: "Kris Horne", title: "Sales Guru", title2: 'Application Development', img: "https://cdn.balkan.app/shared/8.jpg" },
    { id: 18, performance: 13, points: 95, pid: "top-management", name: "Leslie Mcclain", title: "Personal assistant", title2: 'Application Development', img: "https://cdn.balkan.app/shared/9.jpg", tags: ["assistant", "menu-without-add"] }

]);


function preview() {
    OrgChart.pdfPrevUI.show(chart, {
        format: 'A4'
    });
}

function nodePdfPreview(nodeId) {
    OrgChart.pdfPrevUI.show(chart, {
        format: 'A4',
        nodeId: nodeId
    });
}

function addSharholder(nodeId) {
    chart.addNode({ id: OrgChart.randomId(), pid: nodeId, tags: ["menu-without-add"] });
}

function addAssistant(nodeId) {
    var node = chart.getNode(nodeId);
    var data = { id: OrgChart.randomId(), pid: node.stParent.id, tags: ["assistant"] };
    chart.addNode(data);
}


function addDepartment(nodeId) {
    var node = chart.getNode(nodeId);
    var data = { id: OrgChart.randomId(), pid: node.stParent.id, tags: ["department"] };
    chart.addNode(data);
}

function addManager(nodeId) {
    chart.addNode({ id: OrgChart.randomId(), stpid: nodeId });
}