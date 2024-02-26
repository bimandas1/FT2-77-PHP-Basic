var firstName = document.querySelector("#first-name");
var lastName = document.querySelector("#last-name");
var fullName = document.querySelector("#full-name");

function updateFullName() {
    fullName.value = `${firstName.value} ${lastName.value}`;
}