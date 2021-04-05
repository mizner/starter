// Polyfill
import 'core-js/features/url-search-params';
// Import Libraries
import axios from 'axios';
import { stringify } from 'qs';
import miniCart from './features/miniCart';
import Toastify from 'toastify-js';

// Get localized data from WP
// eslint-disable-next-line no-undef
const { ajaxURL, nonce, notices: { noProductID, contactSupport }, wc: { cartURL } } = GLOBAL;

// Get all add to cart buttons
const addToCartButtons = [...document.querySelectorAll('.preview-product .btn')];

// Safety check for a tag, should never return a span
const getLinkIfSpanWasClicked = el => 'SPAN' === el.tagName ? el.parentElement : el;

function handleAddToCartSuccess({ wpResponse: { data: { goToCartText, productTitle } }, el }) {
  Toastify({
    text: `<strong>${productTitle}</strong> is in your cart! - <a class="text-light hover:text-dark underline" href="${cartURL}">view cart</a>`,
    duration: 30000,
    destination: cartURL,
    newWindow: true,
    close: true,
    gravity: 'bottom', // `top` or `bottom`
    position: 'right', // `left`, `center` or `right`
    backgroundColor: 'linear-gradient(to right, #00b09b, #96c93d)',
    stopOnFocus: true, // Prevents dismissing of toast on hover
  }).showToast();

  miniCart();
  el.querySelector('span').innerText = goToCartText;
  el.setAttribute('href', cartURL);
  el.classList.add('go-to-cart');
}

// Handle possible event if no product ID is found in query args
function handleNoProductID({ el }) {
  window.alert(`${noProductID} - ${contactSupport}`);
}

// Handle various errors
function handleVariousFailures({ status }) {
  window.alert(`Error: ${status} - ${contactSupport}`);
}

// Handle actions
function requestAddToCart({ productID, el }) {
  const request = {
    method: 'post',
    url: ajaxURL,
    data: stringify({
      action: 'custom_add_to_cart',
      productID,
      security: nonce,
    }),
    headers: {
      'X-WP-Nonce': nonce,
      'Content-Type': 'application/x-www-form-urlencoded',
    },
  };
  axios(request).then(response =>
    200 === response.status
      ? handleAddToCartSuccess({ wpResponse: response.data, el: el })
      : handleVariousFailures({ status: response.status }),
  ).catch(response =>
    handleVariousFailures({ status: response.status }),
  );
}

function handleClickEvent(event) {
  // Safety check if span is clicked on, try to always return the "A" tag
  const link = getLinkIfSpanWasClicked(event.srcElement);

  const href = link.getAttribute('href');
  // Create url params object for searching
  const urlParams = new URLSearchParams(href);
  // Check for required product id paramter
  urlParams.has('add-to-cart')
    // If product id is available request to server to add to cart
    ? requestAddToCart({ productID: urlParams.get('add-to-cart'), el: link })
    // If product id is not available check see if we're ready to go to the checkout page
    : href.includes('/cart') //
      // Go to checkout
      ? window.location.href = cartURL
      // Throw error
      : handleNoProductID({ el: link });
}

[...addToCartButtons].map((button, i) =>
  button.addEventListener('click', ev =>
    ev.preventDefault() || handleClickEvent(ev),
  ),
);
