
 // Fonction pour afficher/masquer les champs liés au marchand
 function toggleMarchantFields() {
    var checkBox = document.getElementById("client");
    var marchantFields = document.getElementById("marchantFields");
    if (checkBox.checked == true) {
        marchantFields.style.display = "block";
    } else {
        marchantFields.style.display = "none";
    }
}