import axios from 'axios';
import { stringify } from 'qs';
import 'custom-event-polyfill';

const noop = () => {};

// Get localized data from WP
// eslint-disable-next-line no-undef
const { ajaxURL, nonce } = GLOBAL;

function handleMiniCartUpdate({ wpResponse: { data: { cartQty } } }) {
  const cartQtyElements = document.querySelectorAll('.cart-qty');
  [...cartQtyElements].map(item => {
    item.classList.remove('hidden');
    item.innerHTML = cartQty;
  });
}

function requestCartQty(event) {
  const request = {
    method: 'post',
    url: ajaxURL,
    data: stringify({
      action: 'check_cart_qty',
      security: nonce,
    }),
    headers: {
      'X-WP-Nonce': nonce,
      'Content-Type': 'application/x-www-form-urlencoded',
    },
  };
  axios(request).then(response =>
    200 === response.status
      ? handleMiniCartUpdate({ wpResponse: response.data })
      : console.log(response.status),
  ).catch(response =>
    console.log(response.status),
  );
}

function miniCart() {
  requestCartQty();
}

export default miniCart;
