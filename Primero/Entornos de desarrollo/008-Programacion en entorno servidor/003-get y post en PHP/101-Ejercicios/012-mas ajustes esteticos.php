<!doctype html>
  <html>
  <head>
    <style>
      html,body{width:100%;height:100%;padding:0px;margin:0px;font-family:sans-serif;}
      body{display:flex;}
      nav{flex:1;background:indigo;color:white;padding:20px;display:flex;flex-direction:column;gap:20px;}
      main{flex:5;background:aliceblue;padding:20px;}
      nav a{border:none;background:white;padding:20px;text-decoration:none;color:indigo;text-transform:uppercase;font-weight:bold;border-radius:5px;display:flex;align-items:center;gap:20px;transition:all 0.3s ease;box-shadow:0 2px 5px rgba(0,0,0,0.1);}
      nav a:hover{transform:translateX(10px);box-shadow:0 4px 12px rgba(75,0,130,0.3);background:indigo;color:white;}
      table{width:100%;border-collapse:separate;border-spacing:0;border:3px solid indigo;border-radius:8px;overflow:hidden;}
      table th{background:indigo;color:white;padding:12px;font-weight:bold;}
      table td{padding:12px;border-bottom:1px solid #ddd;}
      table tbody tr:nth-child(odd){background:white;}
      table tbody tr:nth-child(even){background:#f0f8ff;}
      table tbody tr:hover{background:#e6e6fa;}
      .redondeado {border-radius:8px;}
      .inicial{display:block;width:20px;height:20px;background:indigo;color:white;text-align:center;padding:10px;border-radius:5px;line-height:20px;}
    </style>
  </head>
  <body>
    <nav>
      <?php
        $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
        $sql = "SHOW TABLES";
        $resultado = $mysqli->query($sql);
        while ($fila = $resultado->fetch_assoc()) {
            // Fuerzo (truco) un parametro GET de url
            echo '<a href="?tabla='.$fila['Tables_in_miempresa'].'">
              <span class="inicial">'.$fila['Tables_in_miempresa'][0].'</span>
             '.$fila['Tables_in_miempresa'].'
             </a>';
        }
      ?>
    </nav>
    <main>
      <table class="redondeado">
        <thead>
          <?php
            ///////////////////////// ESTO MUESTRA LAS CABECERAS
            $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
            $sql = "SELECT * FROM ".$_GET['tabla']." LIMIT 1;";
            $resultado = $mysqli->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach($fila as $clave=>$valor){
                  echo "<th>".$clave."</th>";
                }
                echo "</tr>";
            }
          ?>
          </thead>
          <tbody>
          <?php
            ///////////////////////// ESTO MUESTRA LOS DATOS
            $mysqli = new mysqli("localhost", "miempresa", "miempresa", "miempresa");
            $sql = "SELECT * FROM ".$_GET['tabla'].";";
            $resultado = $mysqli->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach($fila as $clave=>$valor){
                  echo "<td>".$valor."</td>";
                }
                echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </main>
  </body>
</html>


