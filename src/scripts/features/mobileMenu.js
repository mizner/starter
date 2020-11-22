const handleToggleClick = menu => {
  menu.classList.toggle('active');
  document.body.setAttribute('data-scroll-enabled', 'true');
  document.body.classList.toggle('overlay-active');
};

const mobileMenu = () => {
  const toggles = document.querySelectorAll('.nav-mobile-toggle');
  const mobileMenu = document.querySelector('.nav-mobile');

  [...toggles].map(el => el.addEventListener('click', ev => handleToggleClick(mobileMenu)));
};

export default mobileMenu;
