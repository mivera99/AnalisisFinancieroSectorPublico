// Función para mostrar u ocultar la contraseña 
function showPassword(){
    let tipo = document.getElementById("password");
    if(tipo.type == "password"){
        tipo.type = "text";
    }else{
        tipo.type = "password";
    }
}

// Funcion para mostrar el tipo de consulta (ccaa, municipio o diputacion)
function showFacility(evt, facilityName) {
  let i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(facilityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Funcion para resetear los campos del formulario de consultas
function resetFields(){
  var forms = document.getElementsByTagName("form");
  for(i=0;i<forms.length;i++){
    forms[i].reset();
  }
  var options = document.getElementsByName("selection");
  for(i=0;i<options.length;i++){
    options[i].checked=false;
  }
  var options = document.getElementsByName("selectionDIP");
  for(i=0;i<options.length;i++){
    options[i].checked=false;
  }
  var options = document.getElementsByName("selectionMUN");
  for(i=0;i<options.length;i++){
    options[i].checked=false;
  }
  var selectTags = document.getElementsByTagName("select");
  for(i=0;i<selectTags.length;i++){
    selectTags[i].selectedIndex=0;
  }
}

// Funcion para esconder la opcion de los años en las consultas
function hideOption(radioName, selectName){
  let selectionOptions = document.getElementsByName(radioName);
  let forms = document.getElementsByClassName(selectName); 
  for(i=0;i<selectionOptions.length;i++){
    forms[i].style.display = "none";
  }

  if(selectionOptions[0].checked){
    forms[0].style.display="block";
  }
  else {
    forms[1].style.display="block";
  }
}

// Funcion para cambiar el tipo de grafica
function changeChart(chart, configChart, radioButtonName){

  let radiobuttons = document.getElementsByName(radioButtonName);
  if(radiobuttons[0].checked){
    configChart.type = "bar";
  }
  else if(radiobuttons[1].checked){
    configChart.type = "line";
  }
  else {
    configChart.type = "bar";
  }
  chart.update();
}

// Funcion para cambiar la casilla From de los años de las consultas
function changeFrom(fromId,toId){
  let from = document.getElementById(fromId);
  let to = document.getElementById(toId);
  
  for(i=0;i<from.options.length;i++){
    let option = from.options[i];
    option.style.display="block";
  }

  if(to.selectedIndex!=0){
    for(i=to.selectedIndex+1;i<from.options.length;i++){
      let option = from.options[i];
      option.style.display="none";
    }
  }
}

// Funcion para cambiar la casilla To de los años de las consultas
function changeTo(toId, fromId){
  let to = document.getElementById(toId);
  let from = document.getElementById(fromId);
  
  for(i=0;i<to.options.length;i++){
    let option = to.options[i];
    option.style.display="block";
  }

  if(from.selectedIndex!=0){
    for(i=1;i<from.selectedIndex;i++){
      let option = to.options[i];
      option.style.display="none";
    }
  }
}

function changeProv(provId, ccaaId, ccaaArray, provArray){
  var provTag = document.getElementById(provId);
  var ccaaTag = document.getElementById(ccaaId);
  
  for(i=0;i<provTag.options.length;i++){
    var option = provTag.options[i];
    option.style.display="block";
  }
  if(ccaaTag.selectedIndex!=0){
    
  }
  
  /*var obj_prov = JSON.parse(provs);
  var obj_ccaa = JSON.parse(ccaas);*/
}

function changeCCAA(ccaaId, provId, ccaaArray, provArray){
  var ccaaTag = document.getElementById(ccaaId);
  var provTag = document.getElementById(provId);
  
  /*var obj_prov = JSON.parse(provs);
  var obj_ccaa = JSON.parse(ccaas);*/

  for(i=0;i<ccaaTag.options.length;i++){
    var option = ccaaTag.options[i];
    option.style.display="block";
  }
  if(provTag.selectedIndex!=0){
    var provObj=null;
    for(i=0;i<provArray.length;i++){
      if(JSON.parse(provArray[i]).codigo == provTag.options[provTag.selectedIndex].value){
        provObj=JSON.parse(provArray[i]);
      }
    }
    if(provObj != null){
      for(i=0;i<ccaaTag.options.length;i++){
        if(ccaaTag.options[i].value == provObj.ccaaCode){
          ccaaTag.options[i].style.display="block";
        }
        else {
          ccaaTag.options[i].style.display="none";
        }
      }
      ccaaTag.selectedIndex=provObj.ccaaCode;
    }
  }
}

// Funcion para habilitar todas las casillas de las consultas
function enableAll(selectButton, allButton){
  let checkboxes = document.getElementsByClassName(selectButton);
  let selectAll = document.getElementById(allButton);

  if(!selectAll.checked){
    for(i=0;i<checkboxes.length;i++){
      checkboxes[i].checked=false;
    }
  }
  else {
    for(i=0;i<checkboxes.length;i++){
      checkboxes[i].checked=true;
    }
  }
}

// Revisa si todas las casillas han sido activadas o no, para poder activar la casilla de Seleccionar Todo de las consultas
function checkAllButton(selectButton, allButton){
  let checkboxes = document.getElementsByClassName(selectButton);
  let selectAll = document.getElementById(allButton);

  checked_boxes=0;
  for(i=0;i<checkboxes.length;i++){
    if(checkboxes[i].checked){
      checked_boxes++;
    }
  }

  if(selectAll.checked){
    if(checked_boxes!=checkboxes.length){
      selectAll.checked=false;
    }
  }
  else{
    if(checked_boxes==checkboxes.length){
      selectAll.checked=true;
    }
  }
}