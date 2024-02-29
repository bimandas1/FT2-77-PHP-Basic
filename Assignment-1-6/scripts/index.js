var first_name = document.querySelector('#first-name');
var last_name = document.querySelector('#last-name');
var full_name = document.querySelector('#full-name');

/**
 * Set value of full_name input section concatenation
 * of first_name & last_name.
 */
function updateFullName() {
    full_name.value = `${first_name.value} ${last_name.value}`;
}
