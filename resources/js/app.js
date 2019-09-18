require('./bootstrap');

document.getElementById("form-delete").addEventListener("submit", function (e) {
    if (!confirm("Do you want to delete this record?")) {
        e.preventDefault();
    }
});
