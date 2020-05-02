function isEmpty(value){
  return (
    // null or undefined
    (value == null) ||

    // has length and it's zero
    (value.hasOwnProperty('length') && value.length === 0) ||

    // is an Object and has no keys
    (value.constructor === Object && Object.keys(value).length === 0)
  )
}

//show list in the InPUT, and return result in the same INPUT
function autocomplete(inp, arr) {
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
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          pos=arr[i].toUpperCase().indexOf(val.toUpperCase());
          if (pos>=0) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = arr[i].substr(0, pos)+"<strong>" + arr[i].substr(pos, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(pos+val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function(e) {
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value;
                inp.onchange();
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();
            });
            a.appendChild(b);            
          }
        }

        // /*for each item in the array...*/
        // for (i = 0; i < arr.length; i++) {
        //   /*check if the item starts with the same letters as the text field value:*/
        //   if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
        //     /*create a DIV element for each matching element:*/
        //     b = document.createElement("DIV");
        //     /*make the matching letters bold:*/
        //     b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
        //     b.innerHTML += arr[i].substr(val.length);
        //     /*insert a input field that will hold the current array item's value:*/
        //     b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
        //     /*execute a function when someone clicks on the item value (DIV element):*/
        //     b.addEventListener("click", function(e) {
        //         /*insert the value for the autocomplete text field:*/
        //         inp.value = this.getElementsByTagName("input")[0].value;
        //         /*close the list of autocompleted values,
        //         (or any other open lists of autocompleted values:*/
        //         closeAllLists();
        //     });
        //     a.appendChild(b);
        //   }
        // }

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

  
  /////////////////////////////////////////////////////////
  ///return two value in two fields, if value separated by SPACE
  //show list in the InPUT, and return result in other two INPUTs

  function autocomplete_returnX(inp, arr, MyObjPartID, MyObjPartName) {
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
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          pos=arr[i].toUpperCase().indexOf(val.toUpperCase());
          if (pos>=0) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = arr[i].substr(0, pos)+"<strong>" + arr[i].substr(pos, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(pos+val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function(e) {
                /*insert the value for the autocomplete text field:*/

                //My special
                //returnPART;ObjPartID,ObjPartName
                Xlen = this.getElementsByTagName("input")[0].value.length;  
                //identify line split, by space
                XSpace = this.getElementsByTagName("input")[0].value.indexOf(" ");

                if (document.getElementById(MyObjPartName))
                  {
                    document.getElementById(MyObjPartName).value = this.getElementsByTagName("input")[0].value.slice(XSpace+1,Xlen);
                    document.getElementById(MyObjPartName).onchange();
                  }

                if (document.getElementById(MyObjPartID))
                  {
                    document.getElementById(MyObjPartID).value = this.getElementsByTagName("input")[0].value.slice(0,XSpace);
                    document.getElementById(MyObjPartID).onchange();
                  }
                  
                //inp.onchange();
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();

            });
            a.appendChild(b);
          }
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
 
  /////////////////////////////////////////////////////////
  ///return two value in two fields, if value separated by SPACE
  //show list in the InPUT, and return result in  two DIVs

  function autocomplete_returnX2(inp, arr, IDOfFirstOut, IDOfSecondOut,NameOfModalForClose) {

    // cells ffor Account and supp_id hightligth;
    $("#"+IDOfFirstOut).addClass("highlight_selected_cell");
    $("#"+IDOfSecondOut).addClass("highlight_selected_cell");

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
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          pos=arr[i].toUpperCase().indexOf(val.toUpperCase());
          if (pos>=0) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = arr[i].substr(0, pos)+"<strong>" + arr[i].substr(pos, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(pos+val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function(e) {
                /*insert the value for the autocomplete text field:*/

                //My special
                //get len
                Xlen = this.getElementsByTagName("input")[0].value.length;  
                //identify line split, by space
                XSpace = this.getElementsByTagName("input")[0].value.lastIndexOf(" ");

                if (document.getElementById(IDOfSecondOut))
                  {
                    document.getElementById(IDOfSecondOut).value = this.getElementsByTagName("input")[0].value.slice(XSpace+1,Xlen);
                    document.getElementById(IDOfSecondOut).onchange();
                  }

                //cut last part of the string
                this.getElementsByTagName("input")[0].value = this.getElementsByTagName("input")[0].value.slice(0,XSpace);
                //get len
                Xlen = this.getElementsByTagName("input")[0].value.length;  
                //identify line split, by space
                XSpace = this.getElementsByTagName("input")[0].value.lastIndexOf(" ");                

                if (document.getElementById(IDOfFirstOut))
                  {
                    document.getElementById(IDOfFirstOut).value = this.getElementsByTagName("input")[0].value.slice(XSpace+1,Xlen);
                    document.getElementById(IDOfFirstOut).onchange();
                  }


                //reset initial input
                document.getElementById(inp.id).value="";
                // cells for Account and supp_id REMOVE hightligth;
                $("#"+IDOfFirstOut).removeClass("highlight_selected_cell");
                $("#"+IDOfSecondOut).removeClass("highlight_selected_cell");                
                // close modal
                $('#'+NameOfModalForClose).modal('hide');

                //inp.onchange();
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();

            });
            a.appendChild(b);
          }
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
  

