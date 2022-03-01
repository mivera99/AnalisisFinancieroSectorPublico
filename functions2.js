
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

function compareMax(){
  var minVal = document.getElementById("minVal");
  var maxVal = document.getElementById("maxVal");

  if(parseFloat(minVal.value) >= parseFloat(maxVal.value)){
    minVal.value = parseFloat(maxVal.value)-1; 
  }

}

function compareMin(){
  var minVal = document.getElementById("minVal");
  var maxVal = document.getElementById("maxVal");

  if(parseFloat(maxVal.value) <= parseFloat(minVal.value)){
    maxVal.value = parseFloat(minVal.value)+1; 
  }
}