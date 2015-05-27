function reroot(elementid) {

    var elementClass = $(idfy(elementid)).attr('class'); // hent klasserne ud af elementet
    var classArray = elementClass.split(' '); // array til alle klasser
    var arrayOfNodeFag = getFagArray(classArray); // hent de elementer som tilhører faget


    var childArray = [];
    var elementstobehidden = [];

    //childArray.push(idfy(elementid));

    for (var index in arrayOfNodeFag) {

        var arrayOfNodeIDs = $(arrayOfNodeFag[index]).map(function (index) {
            // this callback function will be called once for each matching element
            return this.id;
        });

        childArray = getChildArray(arrayOfNodeIDs, childArray, elementid);

        elementstobehidden = getElementsToBeHidden(arrayOfNodeIDs, elementid);


        hideElements(elementstobehidden);

        placeTreeByIDs(childArray, elementid);

    }


}


function placeTreeByIDs(array_of_ids, root) {

    var fag = getFagFromNode(root);

    var fagid = idfy(fag);
    var parent_pos = $(fagid).offset();
    var parent_width = $(fagid).width();
    var element_width = $(idfy(root)).width();

    $(idfy(root)).offset({
        top: parent_pos.top - 200,
        left: parent_pos.left + (parent_width / 2) - (element_width / 2)
    });


    var drawarray = getDrawArray(array_of_ids);

    for( var i in drawarray) {

        var arrayofrow = drawarray[i];

        if (typeof arrayofrow != 'undefined') {

            for (var j in arrayofrow) {

                var nodeid = arrayofrow[j];
                nodeid = nodeid.substr(1); //Removes first caractwer which is #. TODO: Change code so idfycation is ad-hoc instead of before pushing to arrays!!!

                var parentid = $(idfy(nodeid)).attr('parent');


                place(nodeid, parentid);


            }
        }

    }



    connect(root, fag);

}

function uncut(fag, rod) {

    $(classyfy(fag)).show();

    placeAndConnect(fag, rod);


}




function getFagFromNode(nodeid) {


    //LOOK BELOW AD FUNCKING HOC IDFICATION!!! SHOULD BE DONE LIKE THIS EVERYTIME!!!!!!!!
    var classes = $(idfy(nodeid)).attr('class');

    var classarray = classes.split(' ');


    return getSpecficClassFromArray('fag', classarray);


}


function getDrawArray(array_of_ids) {


    var drawarray = new Array(200); //rows cannot be any bigger than 200


    for (var index in array_of_ids) {

        var element = array_of_ids[index];

        var row = $(element).attr('row');

        if (typeof drawarray[row] != 'undefined') {


            var rowarray = drawarray[row];

            rowarray.push(element);

            drawarray[row] = rowarray;


            //alert(row + "IS OLD");

        } else {


            //alert(row + " IS NEW");

            drawarray[row] = new Array(element);

        }

        //console.log(drawarray);


    }


    return drawarray;


}




function hideElements(array) {


    for (var i in array) {

        var idtobehidden = array[i];

        if (typeof idtobehidden == 'string') { // sørg for at vi ikke får andet med, dette tjek er vitalt for koden! - der kommer elementer med som ikke er strenge!
            if (!idtobehidden.search('node')) { // se efter id'er med node


                idtobehidden = idfy(idtobehidden);

                $(idtobehidden).hide();

            }
        }

    }


}


function getElementsToBeHidden(arrayOfNodes, elementid) { // du vil returnere et array med alle childs af elementet


    elementid = idfy(elementid);

    for (var index in arrayOfNodes) {

        var childID = arrayOfNodes[index];

        if (typeof childID == 'string') { // sørg for at vi ikke får andet med, dette tjek er vitalt for koden! - der kommer elementer med som ikke er strenge!
            if (!childID.search('node')) { // se efter id'er med node

                var child = childID;
                childID = idfy(childID);

                var parent = $(childID).attr('parent');
                var parentid = idfy(parent);

                if (parentid == elementid) {

                    //childArray.push(childID);
                    delete arrayOfNodes[index];
                    //arrayOfNodes.pop(index);
                    arrayOfNodes = getElementsToBeHidden(arrayOfNodes, child);
                }
            }
        }
    }


    return arrayOfNodes;

}


function getChildArray(arrayOfNodes, childArray, elementid) { // du vil returnere et array med alle childs af elementet


    var elementindex = jQuery.inArray(elementid, arrayOfNodes);

    delete arrayOfNodes[elementindex];

    elementid = idfy(elementid);

    for (var index in arrayOfNodes) {

        var childID = arrayOfNodes[index];

        if (typeof childID == 'string') { // sørg for at vi ikke får andet med, dette tjek er vitalt for koden! - der kommer elementer med som ikke er strenge!
            if (!childID.search('node')) { // se efter id'er med node

                var child = childID;
                childID = idfy(childID);

                var parent = $(childID).attr('parent');
                var parentid = idfy(parent);

                if (parentid == elementid) {

                    childArray.push(childID);
                    //delete arrayOfNodes[index];
                    //arrayOfNodes.pop(index);
                    childArray = getChildArray(arrayOfNodes, childArray, child);
                }
            }
        }
    }


    return childArray;

}


function getFagArray(arrayOfClasses) {
    var res = 'fag';
    var resultArray = [];


    for (var index in arrayOfClasses) { // index er som i, i alm java.
        if (!arrayOfClasses[index].search(res)) { //søg arrayet for strengen res, er den false (altså det vi leder eter er der), fra index position
            resultArray.push(classyfy(arrayOfClasses[index]));
        }

    }
    return resultArray;

}

