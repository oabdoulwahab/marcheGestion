
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

document.getElementById('searchInput').addEventListener('keyup', function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#marchantTable tbody tr');
    
    rows.forEach(row => {
        let name = row.cells[1].textContent.toLowerCase();
        let address = row.cells[2].textContent.toLowerCase();
        let phone = row.cells[3].textContent.toLowerCase();
        
        if (name.includes(filter) || address.includes(filter) || phone.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});