import { add } from 'ramda'

function distanceFromTop(el) {
    return add(window.pageYOffset, el.getBoundingClientRect().top)
}

function elementHeight(el) {
    return el.offsetHeight
}

export { distanceFromTop, elementHeight }