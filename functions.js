
/* Cargamos en un array todos los nombres que usaremos en el autocompletar */
/* Lo hacemos antes de todo, justamente cuando se carga el documento porque así quita retrasos a la hora de escribir */
var nombres;
function cargarNombres(){
    /*
    for (i = 0; i < arr.length; i++){
        //if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

        hijo = arr[i]; //Recogemos el valor en una variable para no modificar el array original
        console.log(Object.keys(hijo)); //Mostramos el mensaje por consola para poder depurar
        clave = Object.keys(hijo); //Asignamos a una variable "clave" el objeto de la clave --> CCAA / DIP / MUN"
        valor = Object.values(hijo); //Asignamos a una variable "valor" el objeto del valor --> Andalucía (por ejemplo)
        clave = clave[0]; //El objeto clave tiene, en la posición 0, el string que necesitamos, por lo que lo recogemos
        valor = valor[0]; //El objeto valor tiene, en la posición 0, el string que necesitamos, por lo que lo recogemos
        console.log(clave); //Mostramos por consola para depurar
        console.log(valor); //Mostramos por consola para depurar

        nombres.push(valor + " - " + clave);
        console.log(nombres);
    }
    */
    fetch("datos.json").then(response => response.json()).then(result => nombres = result);
    console.log(nombres);
}

function creardatos(arr){
    /*
    var objeto = {
        datos : []
    };

    for (i = 0; i < arr.length; i++){
        //if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

        hijo = arr[i]; //Recogemos el valor en una variable para no modificar el array original
        //console.log(Object.keys(hijo)); //Mostramos el mensaje por consola para poder depurar
        clave = Object.keys(hijo); //Asignamos a una variable "clave" el objeto de la clave --> CCAA / DIP / MUN"
        valor = Object.values(hijo); //Asignamos a una variable "valor" el objeto del valor --> Andalucía (por ejemplo)
        clave = clave[0]; //El objeto clave tiene, en la posición 0, el string que necesitamos, por lo que lo recogemos
        valor = valor[0]; //El objeto valor tiene, en la posición 0, el string que necesitamos, por lo que lo recogemos
        //console.log(clave); //Mostramos por consola para depurar
        //console.log(valor); //Mostramos por consola para depurar

        nombres.push(valor + " - " + clave);
        //console.log(nombres);

        objeto.datos.push({"nombre":valor, "tipo":clave});
    }

    var archivo = JSON.stringify(objeto);
    //console.log(archivo);
    */

}

function autocomplete(inp) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;

    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/

        //for (i = 0; i < nombres.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            //if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

            
        //    if ((nombres[i].nombre.toUpperCase()).includes(val.toUpperCase())) { // ***cambiamos arr[i] por nombres[i].nombre ***
                /*create a DIV element for each matching element:*/
        //        b = document.createElement("DIV");
                /*make the matching letters bold:*/
                //b.innerHTML = "<strong>" + nombres[i].nombre.substr(0, val.length) + "</strong>"; // *** cambiamos arr[i] por nombres[i].nombre ***
                //b.innerHTML += nombres[i].nombre.substr(val.length);  // *** cambiamos arr[i] por nombres[i].nombre ***
        //        b.innerHTML = nombres[i].nombre;
                /*insert a input field that will hold the current array item's value:*/
        //        b.innerHTML += "<input type='hidden' value='" + nombres[i].nombre + "'>"; // *** cambiamos arr[i] por nombres[i].nombre ***
                /*execute a function when someone clicks on the item value (DIV element):*/
        //        b.addEventListener("click", function(e) {
                    /*insert the value for the autocomplete text field:*/
        //            inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
        //            closeAllLists();
        //        });
        //        a.appendChild(b);
        //    }

            
        //}
        
        //El buscador empieza a dar autocompletados a partir de 2 caracteres, para que sea más rápido
        if(val.length > 2){
            nombres.map(function(objeto){
                if ((objeto.nombre.toUpperCase()).includes(val.toUpperCase())) { // ***cambiamos arr[i] por nombres[i].nombre ***
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    //b.innerHTML = "<strong>" + nombres[i].nombre.substr(0, val.length) + "</strong>"; // *** cambiamos arr[i] por nombres[i].nombre ***
                    //b.innerHTML += nombres[i].nombre.substr(val.length);  // *** cambiamos arr[i] por nombres[i].nombre ***
                    b.innerHTML = objeto.nombre;
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + objeto.nombre + "'>"; // *** cambiamos arr[i] por nombres[i].nombre ***
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }

            });
        }






    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
            }
        }
});
function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
}
function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
    x[i].classList.remove("autocomplete-active");
    }
}
function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
    if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
    }
    }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}