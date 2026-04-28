<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>A-Frame GLB Example</title>
  <script src="https://aframe.io/releases/1.6.0/aframe.min.js"></script>
  <script>
    AFRAME.registerComponent('follow-light', {
      init: function () {
        this.player = document.querySelector('#player');
      },
      tick: function () {
        if (!this.player) return;

        const p = this.player.object3D.position;
        this.el.object3D.position.set(
          p.x + 20,
          p.y + 40,
          p.z + 20
        );
      }
    });
  </script>
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

  <!-- spherical equirectangular background -->
  <a-sphere
    radius="500"
    position="0 0 0"
    scale="-1 1 1"
    material="src: #fondo; side: back; shader: flat"
    shadow="cast: false; receive: false">
  </a-sphere>

  <!-- directional light following player -->
  <a-entity
    id="sun"
    follow-light
    light="type: directional;
           color: #ffffff;
           intensity: 1;
           castShadow: true;
           shadowMapWidth: 4096;
           shadowMapHeight: 4096;
           shadowCameraTop: 50;
           shadowCameraBottom: -50;
           shadowCameraLeft: -50;
           shadowCameraRight: 50;
           shadowCameraNear: 1;
           shadowCameraFar: 200;
           shadowBias: -0.0005"
    position="20 40 20">
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

  <!-- player / camera -->
  <a-entity id="player" position="0 1 20">
    <a-camera></a-camera>
  </a-entity>

</a-scene>

</body>
</html>
