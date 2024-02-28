var firstName = document.querySelector('#first-name');
var lastName = document.querySelector('#last-name');
var fullName = document.querySelector('#full-name');

/**
 * Set value of fullName input section concatenation
 * of firstName & lastName
 */
function updateFullName() {
    fullName.value = `${firstName.value} ${lastName.value}`;
}
