/**
 * Calls a the given function on all elements in a tree in the right order acording to the rows. Starting frtom the bottom.
 * @param functioncall: The function to be called
 * @param fag: the tree which nodes the function should be called on
 */
function changeTree(functioncall, fag) {

    var i = 1;
    elements = $("." + fag + '.row' + i);


    while(elements.length > 0) {

        elements.each(function () {


            if (typeof functioncall === "function") {

                functioncall($(this));

            }

        });

        i++;
        elements = $("." + fag + '.row' + i);

    }


}


function place(nodeid, parentid) {


    nodeid = idfy(nodeid);
    parentid = idfy(parentid);


    var parent_pos = $(parentid).offset();
    var parent_width = $(parentid).width();
    var element_width = $(nodeid).width();
    var x_string = $(nodeid).attr('x-offset');
    var y_string = $(nodeid).attr('y-offset');


    var x_offset = parseFloat(x_string);
    var y_offset = parseFloat(y_string);

    $(nodeid).offset({top: parent_pos.top - y_offset , left: parent_pos.left + (parent_width/2) - (element_width/2) + x_offset});

}


function connect(nodeid, parentid) {

    nodeid = idfy(nodeid);
    parentid = idfy(parentid);


    $(parentid).connections({to: nodeid , 'class': 'line'});



}


function idfy(id) {

    return '#' + id;

}

function classyfy(aclass) {

    return '.' + aclass;

}


