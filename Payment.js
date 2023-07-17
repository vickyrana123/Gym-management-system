const cardNumberInput = document.getElementById('card-number-input');

cardNumberInput.addEventListener('input', function(e) {
  // Remove any non-digit characters from the input
  const input = e.target.value.replace(/\D/g, '');

  // Split the input into groups of four digits
  const groups = input.match(/.{1,4}/g);

  // Combine the groups with spaces between them
  const formatted = groups.join(' ');

  // Set the input value to the formatted string
  e.target.value = formatted;
});

const expiryDateInput = document.getElementById('expiry-date-input');

expiryDateInput.addEventListener('input', function(e) {
  // Remove any non-digit characters from the input
  const input = e.target.value.replace(/\D/g, '');

  // Insert slashes after the second and fourth digits
  let formatted = '';
  for (let i = 0; i < input.length; i++) {
    if (i === 2 || i === 4) {
      formatted += '/';
    }
    formatted += input[i];
  }

  // Set the input value to the formatted string
  e.target.value = formatted;
});
