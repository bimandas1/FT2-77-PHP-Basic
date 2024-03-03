var firstName = document.querySelector('#first-name');
var lastName = document.querySelector('#last-name');
var fullName = document.querySelector('#full-name');

/**
 * Set value of full_name input section concatenation
 * of first_name & last_name.
 */
function updateFullName() {
  fullName.value = `${firstName.value} ${lastName.value}`;
}

// Add event listener to first name & last name input field.
firstName.addEventListener('input', updateFullName);
lastName.addEventListener('input', updateFullName);
