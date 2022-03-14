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