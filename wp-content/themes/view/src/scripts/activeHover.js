const activeHoverInstances = document.querySelectorAll('.active-hover');

function handleAttention(event, items) {
  [...items].map(item => item.classList.remove('active'));
  event.srcElement.classList.add('active');
}

[...activeHoverInstances].map(instance => {
  const items = instance.querySelectorAll('.active-hover__item');
  [...items].map(item => {
    console.log();
    if (1024 < window.innerWidth) {
      item.addEventListener('mouseenter', ev => handleAttention(ev, items));
    }
  });
});
