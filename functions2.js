// Función para mostrar u ocultar la contraseña 
function showPassword(){
    var tipo = document.getElementById("password");
    if(tipo.type == "password"){
        tipo.type = "text";
    }else{
        tipo.type = "password";
    }
}

function showFacility(evt, facilityName) {
  var i, tabcontent, tablinks;
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

function hideOption(radioName, selectName){
  var selectionOptions = document.getElementsByName(radioName);
  var forms = document.getElementsByClassName(selectName); 
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
function changeChart(chart, configChart, radioButtonName){

  var radiobuttons = document.getElementsByName(radioButtonName);
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

function changeTo(toId, fromId){
  var to = document.getElementById(toId);
  var from = document.getElementById(fromId);
  
  for(i=0;i<to.options.length;i++){
    var option = to.options[i];
    option.style.display="block";
  }

  if(from.selectedIndex!=0){
    for(i=1;i<from.selectedIndex;i++){
      var option = to.options[i];
      option.style.display="none";
    }
  }
}

function changeFrom(fromId,toId){
  var from = document.getElementById(fromId);
  var to = document.getElementById(toId);
  
  for(i=0;i<from.options.length;i++){
    var option = from.options[i];
    option.style.display="block";
  }

  if(to.selectedIndex!=0){
    for(i=to.selectedIndex+1;i<from.options.length;i++){
      var option = from.options[i];
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
}

function changeCCAA(ccaaId, provId, ccaaArray, provArray){
  var ccaaTag = document.getElementById(ccaaId);
  var provTag = document.getElementById(provId);
  
  for(i=0;i<ccaaTag.options.length;i++){
    var option = ccaaTag.options[i];
    option.style.display="block";
  }
  if(provTag.selectedIndex!=0){

  }
}