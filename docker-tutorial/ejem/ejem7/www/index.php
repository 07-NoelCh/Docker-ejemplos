<?php
$host = "db";
$user = "usuario";
$pass = "userpass";
$dbname = "mi_base";

$conn = new mysqli($host, $user, $pass, $dbname);

// Crear tabla si no existe
$conn->query("CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  email VARCHAR(100),
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Insertar dato de ejemplo si la tabla está vacía
$res = $conn->query("SELECT COUNT(*) as total FROM usuarios");
$row = $res->fetch_assoc();
if ($row['total'] == 0) {
  $conn->query("INSERT INTO usuarios (nombre, email) VALUES ('Noel', 'noel@docker.com')");
}

// Obtener usuarios
$result = $conn->query("SELECT * FROM usuarios");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ejemplo 7 - PHP + MySQL</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #0f172a;
      color: #e2e8f0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
    }
    h1 {
      font-size: 2rem;
      margin-bottom: 8px;
      color: #38bdf8;
    }
    p.subtitle {
      color: #94a3b8;
      margin-bottom: 32px;
      font-size: 0.95rem;
    }
    .card {
      background: #1e293b;
      border-radius: 12px;
      padding: 24px;
      width: 100%;
      max-width: 700px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.4);
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th {
      background: #0ea5e9;
      color: white;
      padding: 12px 16px;
      text-align: left;
      font-weight: 600;
    }
    td {
      padding: 12px 16px;
      border-bottom: 1px solid #334155;
    }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: #273549; }
    .badge {
      display: inline-block;
      background: #0ea5e9;
      color: white;
      border-radius: 999px;
      padding: 2px 10px;
      font-size: 0.75rem;
      font-weight: bold;
    }
    .status {
      margin-top: 16px;
      font-size: 0.85rem;
      color: #64748b;
      text-align: right;
    }
  </style>
</head>
<body>
  <h1>🐳 Ejemplo 7</h1>
  <p class="subtitle">PHP + MySQL + PHPMyAdmin corriendo en Docker</p>

  <div class="card">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Creado</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($u = $result->fetch_assoc()): ?>
        <tr>
          <td><span class="badge"><?= $u['id'] ?></span></td>
          <td><?= htmlspecialchars($u['nombre']) ?></td>
          <td><?= htmlspecialchars($u['email']) ?></td>
          <td><?= $u['creado_en'] ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <p class="status">Conectado a MySQL · PHPMyAdmin en <a style="color:#38bdf8" href="http://localhost:8080" target="_blank">localhost:8080</a></p>
  </div>
</body>
</html>
