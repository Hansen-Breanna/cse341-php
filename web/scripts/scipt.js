function enableSelectAuthor() {
    document.getElementById("first_name").disabled = true;
    document.getElementById("middle_name").disabled = true;
    document.getElementById("last_name").disabled = true;
    document.getElementById("authorList").disabled = false;
}

function enableAddAuthor() {
    document.getElementById("first_name").disabled = false;
    document.getElementById("middle_name").disabled = false;
    document.getElementById("last_name").disabled = false;
    document.getElementById("authorList").disabled = true;
}