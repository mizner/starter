import axios from 'axios';
import { stringify } from 'qs';

const { coupon: { code, amount } } = NEWSLETTER;

const { ajaxURL, nonce } = GLOBAL;

function handleSuccess({ wpResponse: { data } }) {
  console.log('worked', data);
}

function handleVariousFailures({ status }) {
  window.alert(`Error: ${status} - please try again`);
}

function requestSubscriberAddition({ email }) {
  const request = {
    method: 'post',
    url: ajaxURL,
    data: stringify({
      action: 'add_subscriber',
      email: email,
      security: nonce,
    }),
    headers: {
      'X-WP-Nonce': nonce,
      'Content-Type': 'application/x-www-form-urlencoded',
    },
  };
  axios(request).then(response =>
    200 === response.status
      ? handleSuccess({ wpResponse: response.data })
      : handleVariousFailures({ status: response.status }),
  ).catch(response =>
    handleVariousFailures({ status: response.status }),
  );
}

function showCoupon(form, signUp) {
  if (amount) {
    const couponCode = signUp.querySelector('.coupon-code');
    const couponMessage = signUp.querySelector('.coupon-message');
    couponCode.innerText = `${code}`;
    couponMessage.classList.add('reveal');
  }
}

function showConfirmation(form, signUp) {
  signUp.querySelector('.newsletter__inner').classList.add('submitted');
  signUp.querySelector('.newsletter__confirmation').classList.add('reveal');
  setInterval(() => showCoupon(form, signUp), 500);
}

function newsletter() {
  const signUps = document.querySelectorAll('.newsletter');

  [...signUps].map(signUp => {
    const form = signUp.querySelector('form');
    form.addEventListener('submit', function(ev) {
      ev.preventDefault();
      const pristine = new Pristine(form);

      // check if the form is valid
      const valid = pristine.validate(); // returns true or false
      valid
        ? showConfirmation(form, signUp) || requestSubscriberAddition({ email: ev.srcElement.querySelector('[type="email"]').value })
        : console.error(valid);
    });
  });
}

document.addEventListener('DOMContentLoaded', newsletter);
