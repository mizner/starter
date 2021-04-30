import useSpriteIcon from '../utils/useSpriteIcon'
import toggleAttribute from '../utils/toggleAttribute'

function handleSecondLevelModifications(menuItem) {
    const link = menuItem.querySelector('a');
    const childMenu = menuItem.querySelector('.menu-items-children');
    const button = document.createElement('button');

    button.appendChild(useSpriteIcon('plus'))
    link.insertAdjacentElement('afterend', button)

    button.addEventListener('click', ev => {
        ev.preventDefault()
        if (!childMenu) {
           return;
        }
         // Toggle aria
         toggleAttribute(childMenu, 'aria-expanded')
         // Remove any existing icon
         button.lastElementChild.remove()
         // Change Icon
         childMenu.getAttribute('aria-expanded') === 'true'
             ? button.appendChild(useSpriteIcon('minus'))
             : button.appendChild(useSpriteIcon('plus'))
    })
}

function handleFirstLevelModifications(menuItem) {
    const link = menuItem.querySelector('a');
    const childMenu = menuItem.querySelector('.menu-items-children');
    link.addEventListener('click', ev => {
        ev.preventDefault();
        toggleAttribute(childMenu, 'aria-expanded')
    })
}

const
    firstLevelMobile = [...document.querySelectorAll('.header-navigation .nav-mobile > div > .menu-items > li')],
    secondLevelMobile = [...document.querySelectorAll('.header-navigation .nav-mobile > div > .menu-items > li > ul > li')],
    thirdLevelMobile = [...document.querySelectorAll('.header-navigation .menu-items > li')]

firstLevelMobile.forEach(menuItem => handleFirstLevelModifications(menuItem));
secondLevelMobile.forEach(menuItem => handleSecondLevelModifications(menuItem))
// [...menuItems.firstLevel].forEach(item => console.log('hi'))
// ['hing'].map(item => console.log(item))
// Object.keys(menuItems.firstLevel).map(item => console.log(menuItems.firstLevel[item]))
// [...menuItems.firstLevel].forEach(item => item)