// Función para mostrar u ocultar la contraseña 
function showPassword(){
    let tipo = document.getElementById("password");
    if(tipo.type == "password"){
        tipo.type = "text";
    }else{
        tipo.type = "password";
    }
}

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