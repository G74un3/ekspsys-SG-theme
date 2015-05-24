
    function reroot(elementid){


        var elementClass = $(elementid).attr('class');
        var classArray = elementClass.split(' '); // array til alle klasser
        var theWantedElementsArray = [];
        var res = 'row';


        for(var index in classArray){ // index er som i, i alm java.
            if(!classArray[index].search(res)){ //søg arrayet for strengen res, er den false (altså det vi leder eter er der), fra index position
                theWantedElementsArray.push(classArray[index]);
                alert(theWantedElementsArray);
                $(elementid).hide('slow');
            }

        }

        var childArray = []; // lav et array til at have de nye elementer i, som kun har de elementer vi vil vise.

        for(var index in theWantedElementsArray){
            var parent = theWantedElementsArray[index].attr('parent'); // tag elementet og find parent

            if(parent == elementid){ // parent er det element vi leder efter,
                childArray.push(theWantedElementsArray[index]); // så push det til det nye array
                theWantedElementsArray.pop(index); // og fjern det fra det gamle - dette array indeholder når løkken er færdig, kun elementer som ikke skal være der!
                elementid === parent; // vi skal nu finde børn af dette barn :)
            }
        }

        // du vil nu lave en funktion, som hider hele theWantedElementsArray, og sætter childArray som root :D!

        for(index in theWantedElementsArray){
            theWantedElementsArray[index].hide('slow');
        }


    }

