
    function reroot(elementid) {


        var elementClass = $(idfy(elementid)).attr('class'); // hent klasserne ud af elementet
        var classArray = elementClass.split(' '); // array til alle klasser
        var arrayOfNodeFag = getFagArray(classArray); // hent de elementer som tilhører faget



        var childArray = [];
        var elementstobehidden = [];

        childArray.push(idfy(elementid));

        for(var index in arrayOfNodeFag) {

            var arrayOfNodeIDs = $(arrayOfNodeFag[index]).map(function(index) {
                // this callback function will be called once for each matching element
                return this.id;
            });

            childArray = getChildArray(arrayOfNodeIDs, childArray, elementid);

            elementstobehidden = getElementsToBeHidden(arrayOfNodeIDs, elementid);

            //console.log(elementstobehidden);

        }




        for(var i in elementstobehidden) {

            var idtobehidden = elementstobehidden[i];

            if(typeof idtobehidden == 'string') { // sørg for at vi ikke får andet med, dette tjek er vitalt for koden! - der kommer elementer med som ikke er strenge!
                if (!idtobehidden.search('node')) { // se efter id'er med node


                    idtobehidden = idfy(idtobehidden);

                    alert(idtobehidden);
                    $(idtobehidden).hide();

                }
            }


        }




    }




    function getElementsToBeHidden(arrayOfNodes, elementid){ // du vil returnere et array med alle childs af elementet


        elementid = idfy(elementid);

        for(var index in arrayOfNodes) {

            var childID = arrayOfNodes[index];

            if(typeof childID == 'string') { // sørg for at vi ikke får andet med, dette tjek er vitalt for koden! - der kommer elementer med som ikke er strenge!
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






    function getChildArray(arrayOfNodes, childArray, elementid){ // du vil returnere et array med alle childs af elementet




        var elementindex = jQuery.inArray(elementid, arrayOfNodes);

        delete arrayOfNodes[elementindex];

        elementid = idfy(elementid);

            for(var index in arrayOfNodes) {

                var childID = arrayOfNodes[index];

                if(typeof childID == 'string') { // sørg for at vi ikke får andet med, dette tjek er vitalt for koden! - der kommer elementer med som ikke er strenge!
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




    function getFagArray(arrayOfClasses){
        var res = 'fag';
        var resultArray = [];


        for(var index in arrayOfClasses){ // index er som i, i alm java.
            if(!arrayOfClasses[index].search(res)){ //søg arrayet for strengen res, er den false (altså det vi leder eter er der), fra index position
                resultArray.push(classyfy(arrayOfClasses[index]));
            }

        }
        return resultArray;

    }

