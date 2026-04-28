<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>A-Frame simplest scene</title>
    <script src="https://aframe.io/releases/1.6.0/aframe.min.js"></script>
  </head>
  <body>
    <a-scene>
      <!-- light -->
      <a-entity light="type: directional; intensity: 1" position="1 2 1"></a-entity>
      <a-entity light="type: ambient; intensity: 0.4"></a-entity>

      <!-- ground plane -->
      <a-plane rotation="-90 0 0" width="10" height="10" color="#7BC8A4"></a-plane>

      <!-- box -->
      <a-box position="0 0.5 -3" depth="1" height="1" width="1" color="#4CC3D9"></a-box>

      <!-- spheres -->
      <a-sphere position="-1.5 0.5 -2" radius="0.5" color="#EF2D5E"></a-sphere>
      <a-sphere position="1.5 1 -2" radius="1" color="#00ff00"></a-sphere>

      <!-- camera -->
      <a-entity position="0 0 0">
        <a-camera></a-camera>
      </a-entity>
    </a-scene>
  </body>
</html>
