
    function reroot(elementid) {

        elementid = idfy(elementid); // sørg for at ID bliver repræsenteret rigtigt

        var elementClass = $(elementid).attr('class'); // hent klasserne ud af elementet
        var classArray = elementClass.split(' '); // array til alle klasser
        var arrayOfNodeFag = getFagArray(classArray); // hent de elementer som tilhører faget



        var childArray = [];
        childArray.push(elementid);

        for(var index in arrayOfNodeFag) {


            var arrayOfNodeIDs = $(arrayOfNodeFag[index]).map(function(index) {
                // this callback function will be called once for each matching element
                return this.id;
            });



            childArray = getChildArray(arrayOfNodeIDs, childArray, elementid);

        }

        //var elementsToBeHidden = compareArrays(childArray, arrayOfNodeIDs);
        //
        //console.log(elementsToBeHidden);
        //
        //for(var index2 in elementsToBeHidden){
        //    $(elementsToBeHidden[index2]).hide('slow');
        //
        //}


    }

    //function compareArrays(childArray, arrayOfNodes){
    //
    //    var nodesToBeRemoved = [];
    //
    //    for(var index in arrayOfNodes){
    //        for(var jindix in childArray){
    //            if(arrayOfNodes[index] != childArray[jindix]){
    //                var childID = arrayOfNodes[index];
    //                if(typeof childID == 'string') {
    //                    if(!childID.search('node')){
    //                        alert(childID);
    //                        nodesToBeRemoved.push(arrayOfNodes[index]);
    //                    }
    //                }
    //            }
    //        }
    //    }
    //
    //    return nodesToBeRemoved;
    //
    //}






    function getChildArray(arrayOfNodes, childArray, elementid){ // du vil returnere et array med alle childs af elementet


            for(var index in arrayOfNodes) {

                var childID = arrayOfNodes[index];

                if(typeof childID == 'string') { // sørg for at vi ikke får andet med, dette tjek er vitalt for koden! - der kommer elementer med som ikke er strenge!
                    if (!childID.search('node')) { // se efter id'er med node

                        childID = idfy(childID);

                        var parent = $(childID).attr('parent');
                        var parentid = idfy(parent);

                        if (parentid == elementid) {

                            childArray.push(childID);
                            //arrayOfNodes.pop(index);
                            childArray = getChildArray(arrayOfNodes, childArray, childID);
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

