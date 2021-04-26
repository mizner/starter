const signUps = document.querySelectorAll('.newsletter');

[...signUps].map(signUp => {
  const form = signUp.querySelector('form');
  form.addEventListener('submit', function(ev) {
    ev.preventDefault();
    const pristine = new Pristine(form);

    // check if the form is valid
    const valid = pristine.validate(); // returns true or false
    valid
      ? showConfirmation(form, signUp) || requestSubscriberAddition({ email: ev.target.querySelector('[type="email"]').value })
      : console.error(valid);
  });
});