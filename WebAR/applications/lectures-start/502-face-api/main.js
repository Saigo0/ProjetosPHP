import * as faceapi from '../../libs/faceapi/face-api.esm.js';
import {loadTexture} from "../../libs/loader.js";
const THREE = window.MINDAR.FACE.THREE;

document.addEventListener('DOMContentLoaded', () => {
  const start = async() => {

    const optionsTinyFace = new faceapi.TinyFaceDetectorOptions({inputSize: 128, scoreThreshold: 0.3});
    const modelPath = '../../libs/faceapi/model';
    await faceapi.nets.tinyFaceLandmark68Net.load(modelPath);
    await faceapi.nets.faceExpressionNet.load(modelPath);

    // initialize MindAR 
    const mindarThree = new window.MINDAR.FACE.MindARThree({
      container: document.body
    });
    const {renderer, scene, camera} = mindarThree;

    const textures = {};

    textures['happy'] = await loadTexture('../../assets/openmoji/1F600');
    textures['angry'] = await loadTexture('../../assets/openmoji/1F621');
    textures['sad'] = await loadTexture('../../assets/openmoji/1F625');
    textures['neutral'] = await loadTexture('../../assets/openmoji/1F610');


     // start AR
    await mindarThree.start();
    renderer.setAnimationLoop(() => {
      renderer.render(scene, camera);
    });

    const video = mindarThree.video;

    const detect = async() => {
      const results = await faceapi.detectSingleFace(video, optionsTinyFace).widthFaceLandMarks().withFaceExpressions();
      window.requestAnimationFrame(detect);
      if(results && results.expressions){
        for(let i = 0; i < expressions.length; i++){
          if(results.expressions[i] > 0.5){
            newExpression = expressions[i];
          }
        }
        if(newExpression !== lastExpression){
          Material.map = textures[newExpression];
          Material.needsUpdate = true;
        }
        lastExpression = newExpression;
      }
    }
    window.requestAnimationFrame(detect);
  }
  start();
});
