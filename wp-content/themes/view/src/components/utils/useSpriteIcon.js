function useSpriteIcon(iconName) {
    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    const useEl = document.createElementNS('http://www.w3.org/2000/svg', 'use');
    svg.classList.add('icon', 'h-4', 'w-4')
    useEl.setAttributeNS('http://www.w3.org/1999/xlink', 'xlink:href', `#icon-${iconName}`)
    svg.appendChild(useEl)
    return svg;
}
export default useSpriteIcon