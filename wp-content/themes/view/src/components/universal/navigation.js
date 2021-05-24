import useSpriteIcon from '../utils/useSpriteIcon'
import toggleAttribute from '../utils/toggleAttribute'
import { elementHeight } from '../utils/domMeasure'

const toggle = document.querySelector('.nav-mobile-toggle')
const firstLevel = [...document.querySelectorAll('.nav > .menu-items > li')]
const secondLevel = [...document.querySelectorAll('.nav > .menu-items > li > ul > li')]

function handleMobileToggle(toggleEl) {
    const mobileMenu = document.querySelector('.nav-mobile')
    const headerHeight = elementHeight(document.querySelector('.header'))
    mobileMenu.style.top = `${headerHeight}px`

    toggleEl.addEventListener('click', ev => {
        toggleAttribute(mobileMenu, 'aria-hidden')
    })
}

function handleSecondLevelTabKeydown(ev, menuItem) {
    // Skip if not tab keydown
    if (ev.keyCode !== 9) {
        return
    }

    // Use defaults if child menu is expanded
    if (menuItem.querySelector('.menu-items-children').getAttribute('aria-expanded') === 'true') {
        return
    }

    if (ev.getModifierState("Shift")) {
        // If first menu item, use defaults
        if (!menuItem.previousElementSibling){
            return
        }

        // Focus prev menu item
        ev.preventDefault()
        menuItem.previousElementSibling.firstElementChild.focus()
        return
    }
    // If last menu item, focus parent sibling link
    if (!menuItem.nextElementSibling){
        ev.preventDefault()
        menuItem.parentElement.parentElement.nextElementSibling.firstElementChild.focus()
        return
    }
    // Focus next menu item
    ev.preventDefault()
    menuItem.nextElementSibling.firstElementChild.focus()
    return
}

function handleFirstLevelTabKeydown(ev, menuItem) {
    // Ensure tab key is pressed
    if (ev.keyCode !== 9) {
        return
    }

    if (ev.getModifierState("Shift")) {
        // If first menu item, allow default behavior
        if (!menuItem.previousElementSibling){
            return
        }

        // Focus prev menu item
        ev.preventDefault()
        menuItem.previousElementSibling.firstElementChild.focus()
        return
    }

    // If there's no next menu item or is expanded, allow default behavior
    if (
        !menuItem.nextElementSibling
        || menuItem.querySelector('.menu-items-children').getAttribute('aria-expanded') === 'true'
        ) {
        return
    }

    // Focus next menu item
    ev.preventDefault()
    menuItem.nextElementSibling.firstElementChild.focus()
    return
}

function handleFirstLevelClickEvent(ev, menuItem, childMenu) {
    if (!childMenu) {
        return
    }

    if (childMenu.getAttribute('aria-expanded') === 'true') {
        ev.preventDefault()
        childMenu.setAttribute('aria-expanded', 'false')
        return
    }

    ev.preventDefault()
    firstLevel.forEach(menuItem =>
        menuItem.querySelector('.menu-items-children').setAttribute('aria-expanded', 'false')
    )
    childMenu.setAttribute('aria-expanded', 'true')
}

function handleSecondLevelModifications(menuItem) {
    const link = menuItem.querySelector('a')
    const childMenu = menuItem.querySelector('.menu-items-children')
    if (!childMenu) {
        return
    }
    childMenu.setAttribute('aria-expanded', 'false')

    // Create and insert button
    const button = document.createElement('button')
    button.appendChild(useSpriteIcon('plus'))
    link.insertAdjacentElement('afterend', button)

    button.addEventListener('click', ev => {
        ev.preventDefault()
        // Toggle aria
        toggleAttribute(childMenu, 'aria-expanded')
        // Remove any existing icon
        button.lastElementChild.remove()
        // Change Icon
        childMenu.getAttribute('aria-expanded') === 'true'
            ? button.appendChild(useSpriteIcon('minus'))
            : button.appendChild(useSpriteIcon('plus'))
    })

    button.addEventListener('keydown', ev => handleSecondLevelTabKeydown(ev, menuItem))
}

function handleFirstLevelModifications(menuItem) {
    const link = menuItem.querySelector('a')
    const childMenu = menuItem.querySelector('.menu-items-children')

    // Duplicate menu item title and prepend to top of child menu
    const childMenuTitle = document.createElement('h5')
    const childMenuTitleText = document.createTextNode(menuItem.firstElementChild.innerText)
    childMenuTitle.appendChild(childMenuTitleText)
    childMenuTitle.setAttribute('aria-hidden', 'true')
    childMenu.prepend(childMenuTitle)

    // Set default aria states
    childMenu.setAttribute('aria-expanded', 'false')

    link.addEventListener('click', ev => handleFirstLevelClickEvent(ev, menuItem, childMenu))
    link.addEventListener('keydown', ev => handleFirstLevelTabKeydown(ev, menuItem))
}

export default function navigation(){
    handleMobileToggle(toggle)
    firstLevel.forEach(menuItem => handleFirstLevelModifications(menuItem))
    secondLevel.forEach(menuItem => handleSecondLevelModifications(menuItem))
}
