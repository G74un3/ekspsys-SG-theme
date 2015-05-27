/**
 * Calls a the given function on all elements in a tree in the right order acording to the rows. Starting frtom the bottom.
 * @param functioncall: The function to be called
 * @param fag: the tree which nodes the function should be called on
 */
function changeTree(functioncall, fag) {

    var i = 1;
    elements = $("." + fag + '.row' + i);


    while (elements.length > 0) {

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

    $(nodeid).offset({
        top: parent_pos.top - y_offset,
        left: parent_pos.left + (parent_width / 2) - (element_width / 2) + x_offset
    });

}


function connect(nodeid, parentid) {

    nodeid = idfy(nodeid);
    parentid = idfy(parentid);


    $(parentid).connections({to: nodeid, 'class': 'line'});


}


function idfy(id) {

    return '#' + id;

}

function classyfy(aclass) {

    return '.' + aclass;

}


function connectFag(fag) {


    var functioncall = function (element) {

        connect(element.attr('id'), element.attr('parent'));

    };

    changeTree(functioncall, fag);

}

function placeAndConnect(fag, rod) {


    disconnectFag(fag);
    placeFag(fag, rod);
    connectFag(fag);



}


function menuItemClicked(fag, rod) {

    var fagclass  = classyfy(fag);
    var atrname = 'lastrod';


    var lastrod = $(fagclass).attr(atrname);


    var currentFag = $(idfy(rod) + ' .fagplaceholder').attr('id');


    if(currentFag == fag || currentFag == "") {

        if (lastrod == undefined) { //element is not placed

            $(fagclass).attr(atrname, rod);

            toogleVisible(fag);
            updateItemGrey(fag);

            placeAndConnect(fag, rod);

        } else if (lastrod == rod) { //element should be hidden

            $(fagclass).removeAttr(atrname);

            toogleVisible(fag);
            updateItemGrey(fag);

        } else { //Rote should be moved

            $(fagclass).attr(atrname, rod);

            placeAndConnect(fag, rod);


        }

    }




}


function updateItemGrey(fag) {

    var menuitem = $('#fagmenu ' + classyfy(fag));
    var menuitemclasses = menuitem.attr('class').split(' '); //Gets an array of all classes from the menuitem

    //Toggles the state of greyed
    if(getSpecficClassFromArray('greyed', menuitemclasses) == "") {

        menuitem.addClass('greyed');

    } else {

        menuitem.removeClass('greyed');

    }


}


function disconnectFag(fag) {

    fag = classyfy(fag);

    $(fag).each(function () {

        id = $(this).attr('id');

        disconnect(id);

    });


}


function disconnect(nodeid) {


    nodeid = idfy(nodeid);

    $(nodeid).connections('remove');

}

function placeFag(fag, rod) {




    var fagid = idfy(fag);

    $(fagid).connections('remove'); //Removes any previous connections making shure that the treee will only be connected to the new root
    $(fagid).removeAttr('id'); //removes fag id from any root that cuurently uses is thereby making shure that the tree is moved correctly
    $('#' + rod + ' .fagplaceholder').attr('id', fag);


    var functioncall = function (element) {

        place(element.attr('id'), element.attr('parent'))

    };

    changeTree(functioncall, fag);



}


function toogleVisible(fag) {

    var fagid = '#' + fag;
    var fagcontainerid = fagid + "-container";

    if ($(fagcontainerid).is(":visible")) { //Visible

        //$(fagcontainerid).css('visibility', 'hidden');
        //$(fagcontainerid).hide();
        $(fagcontainerid).css("display", "none")

    } else { //Invisible

        //$(fagcontainerid).css('visibility', 'visible');
        //$(fagcontainerid).show();
        $(fagcontainerid).css("display", "block")
    }

}

jQuery.fn.visible = function () {
    return this.css('visibility', 'visible');
};

jQuery.fn.invisible = function () {
    return this.css('visibility', 'hidden');
};

jQuery.fn.visibilityToggle = function () {
    return this.css('visibility', function (i, visibility) {
        return (visibility == 'visible') ? 'hidden' : 'visible';
    });
};


function getRodID(element) {


    var classes = element.parent().parent().parent().attr('class');

    var arrayofclasses = classes.split(' ');

    var rodid = getSpecficClassFromArray('rod', arrayofclasses);


    return rodid;


}


function getSpecficClassFromArray(string, array) {


    for (var index in array) {

        if (!array[index].search(string)) {

            return array[index];

        }


    }

    return "";

}


