import lozad from 'lozad';

function lazyLoading() {
  const imageObserver = lozad('.lozad', {
    rootMargin: '10px 0px', // syntax similar to that of CSS Margin
    threshold: 0.1, // ratio of element convergence
  });

  // Picture observer
  // with default `load` method
  const pictureObserver = lozad('.lozad-picture', {
    threshold: 0.1,
  });

  imageObserver.observe();
  pictureObserver.observe();
}

export default lazyLoading;
