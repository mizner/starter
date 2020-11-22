import loadGoogleMapsApi from 'load-google-maps-api';
import mapInfoWindowHTML from '../components/molecules/map-info-window.twig';

const pins = JSON.parse(document.querySelector('[data-pin]').getAttribute('data-pin'));

function createMap(googleMaps) {
  const mapOptions = {
    disableDefaultUI: true,
    center: {
      lat: 37.790,
      lng: -122.444,
    },
    zoom: 1024 < window.innerWidth ? 14 : 12,
    styles: [
      {
        featureType: 'administrative',
        elementType: 'labels',
        stylers: [
          { visibility: 'on' },
        ],
      }, {
        featureType: 'poi',
        elementType: 'labels',
        stylers: [
          { visibility: 'off' },
        ],
      }, {
        featureType: 'water',
        elementType: 'labels',
        stylers: [
          { visibility: 'off' },
        ],
      }, {
        featureType: 'road',
        elementType: 'labels',
        stylers: [
          { visibility: 'on' },
        ],
      },
    ],
  };
  const map = new googleMaps.Map(document.querySelector('.google-map'), mapOptions);

  const iconDefault = {
    url: '/wp-content/themes/look/dist/svgs/pin.svg',
    size: new googleMaps.Size(100, 100),
    scaledSize: new googleMaps.Size(100, 100),
  };

  const configs = pins.map(pin => {
    return {
      marker: {
        clickable: true,
        visible: true,
        position: {
          lat: parseFloat(pin.latitude),
          lng: parseFloat(pin.longitude),
        },
        icon: iconDefault,
        map: map,
      },
      window: {
        content: mapInfoWindowHTML({
          heading: pin.heading,
          address_1: pin.address_1,
          address_2: pin.address_2,
          hours: pin.hours,
          images: pin.images,
        }),
      },
    };
  });

  const infoWindow = new googleMaps.InfoWindow();

  infoWindow.addListener('domready', ev => {
    const galleryLinks = document.querySelectorAll('a[data-fslightbox]');
    [...galleryLinks].map(link => {
      link.addEventListener('click', ev => {
        ev.preventDefault();
        require('fslightbox');
        fsLightboxInstances['main-gallery'].open(0);
      });
    });
  });

  configs.map(config => {
    const marker = new googleMaps.Marker(config.marker);
    marker.addListener('mouseover', ev => {
      marker.setIcon({
        url: '/wp-content/themes/look/dist/svgs/pin-active.svg',
        size: new googleMaps.Size(100, 100),
        scaledSize: new googleMaps.Size(100, 100),
      });
    });
    marker.addListener('click', ev => {
      infoWindow.close();
      infoWindow.setOptions({ ...config.window, ...{ maxWidth: 436 } });
      infoWindow.open(map, marker);
    });
  });
};

loadGoogleMapsApi({ key: 'AIzaSyBP6D4tf1U6AAmOXRzmtcafonaNWzzhw2s' }).then(createMap).catch(error => console.error(error));
