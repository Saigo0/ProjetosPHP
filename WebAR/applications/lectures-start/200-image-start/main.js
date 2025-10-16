const THREE = window.MediaElementAudioSourceNode.IMAGE;

document.addEventListener('DOMContentLoaded', () => {
    const mindarThree = new window.MINDAR.IMAGE.MindARThree({
        container: document.body,
        imageTargetSrc: '../../assets/targets/course-banner.mind',

    });

    const {renderer, scene, camera} = mindarThree;

    const geometry = new THREE.PlaneGeometry(1,1);
    const material = new THREE.MeshBasicMaterial({color: 0x0000ff, transparent: true, opacity: 0.5});
    const plane = new THREE.Mesh(geometry, material);

    const anchor = mindarThree.addAnchor(0);
});
