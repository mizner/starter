
function accordion() {
  [...document.querySelectorAll('.accordion-item')].map(item => {
    item.addEventListener('click', ev => {
      const content = item.querySelector('.accordion-item__content');

      if ('true' === content.getAttribute('aria-hidden')) {
        content.setAttribute('aria-hidden', 'false');
        item.classList.add('expanded');
        content.style.height = `${content.scrollHeight}px`;
      } else {
        content.setAttribute('aria-hidden', 'true');
        item.classList.remove('expanded');
        content.style.height = '0px';
      }
    });
  });
}
export default accordion;
