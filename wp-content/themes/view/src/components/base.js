import domReady from './utils/domReady'
import overlay from './universal/overlay'
import navigation from './universal/navigation'

domReady(ev => {
    overlay()
    navigation()
})