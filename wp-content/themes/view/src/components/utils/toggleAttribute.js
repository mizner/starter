const toggleAttribute = (el, attr) =>
    el.getAttribute(attr) === 'false' || el.getAttribute(attr) === null
    ? el.setAttribute(attr, "true")
    : el.setAttribute(attr, "false")

export default toggleAttribute