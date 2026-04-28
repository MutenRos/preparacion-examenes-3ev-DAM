<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>A-Frame GLB Example</title>
  <script src="https://aframe.io/releases/1.6.0/aframe.min.js"></script>
</head>
<body>

<a-scene
  renderer="colorManagement: true; physicallyCorrectLights: true"
  shadow="type: pcfsoft">

  <!-- assets -->
  <a-assets>
    <a-asset-item id="suzanne" src="008-mesa con cilindros.glb"></a-asset-item>
    <img id="fondo" src="fondo.jpg">
  </a-assets>

  <!-- fondo esférico equirectangular -->
  <a-sphere
    radius="500"
    position="0 0 0"
    scale="-1 1 1"
    material="src: #fondo; side: back; shader: flat"
    shadow="cast: false; receive: false">
  </a-sphere>

  <!-- directional light with shadows -->
  <a-entity
    light="type: directional;
           color: #ffffff;
           intensity: 1;
           castShadow: true;
           shadowMapWidth: 2048;
           shadowMapHeight: 2048;
           shadowCameraTop: 10;
           shadowCameraBottom: -10;
           shadowCameraLeft: -10;
           shadowCameraRight: 10;
           shadowBias: -0.0005"
    position="2 4 2">
  </a-entity>

  <!-- ambient light -->
  <a-entity
    light="type: ambient;
           color: #ffffff;
           intensity: 0.5">
  </a-entity>

  <!-- hemisphere light -->
  <a-entity
    light="type: hemisphere;
           color: #ffffff;
           groundColor: #cccccc;
           intensity: 0.3">
  </a-entity>

  <!-- floor -->
  <a-plane
    rotation="-90 0 0"
    width="100"
    height="100"
    color="#cccccc"
    shadow="receive: true">
  </a-plane>

  <?php
    $rotaciones = [0, 90, 180, 270];

    for($x = 0; $x < 4; $x++){
      for($z = 0; $z < 4; $z++){
        $rotacion = $rotaciones[array_rand($rotaciones)];
  ?>
      <a-entity
        gltf-model="#suzanne"
        position="<?= $x * 16 ?> 0 <?= $z * 16 ?>"
        rotation="0 <?= $rotacion ?> 0"
        scale="2 2 2"
        shadow="cast: true; receive: true">
      </a-entity>
  <?php
      }
    }
  ?>

  <!-- camera -->
  <a-entity position="0 1 20">
    <a-camera></a-camera>
  </a-entity>

</a-scene>

</body>
</html>
