// Wrapping an anchor with class "wrap_me" into a new div element
// example: wrap(document.querySelector('a.wrap_me'), document.createElement('div'))
function wrap(el, wrapper) {
    el.parentNode.insertBefore(wrapper, el);
    wrapper.appendChild(el);
}


export default wrap