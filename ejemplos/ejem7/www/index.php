<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 7 - Docker MySQL + PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            max-width: 800px;
            width: 100%;
        }
        
        h1 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 2.5em;
            text-align: center;
        }
        
        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        
        .status {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
            font-size: 1.1em;
        }
        
        .status.error {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        
        th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 1px;
        }
        
        tbody tr:hover {
            background: #e9ecef;
            transition: background 0.3s ease;
        }
        
        tbody tr:last-child td {
            border-bottom: none;
        }
        
        .info-box {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin-top: 30px;
            border-radius: 5px;
        }
        
        .info-box h3 {
            color: #1976d2;
            margin-bottom: 10px;
        }
        
        .info-box p {
            color: #555;
            line-height: 1.6;
        }
        
        .badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }
        
        .badge-success {
            background: #d4edda;
            color: #155724;
        }
        
        .badge-info {
            background: #cce5ff;
            color: #004085;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐘 Ejemplo 7 - Docker + MySQL</h1>
        <p class="subtitle">Conexión PHP con base de datos MySQL en Docker</p>
        
        <?php
        $host = 'mysql';
        $dbname = 'mi_base';
        $username = 'usuario';
        $password = 'userpass';
        
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            echo '<div class="status">✅ Conexión exitosa a MySQL</div>';
            
            // Crear tabla usuarios si no existe
            $sql = "CREATE TABLE IF NOT EXISTS usuarios (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            
            $pdo->exec($sql);
            
            // Insertar datos de ejemplo si la tabla está vacía
            $check = $pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
            
            if ($check == 0) {
                $sql = "INSERT INTO usuarios (nombre, email) VALUES 
                    ('Juan Pérez', 'juan@example.com'),
                    ('María García', 'maria@example.com'),
                    ('Carlos López', 'carlos@example.com'),
                    ('Ana Martínez', 'ana@example.com')";
                $pdo->exec($sql);
                echo '<div class="status" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">📝 Datos de ejemplo insertados</div>';
            }
            
            // Mostrar datos
            $stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id");
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($usuarios) > 0) {
                echo '<h2 style="color: #667eea; margin-top: 30px; margin-bottom: 15px;">👥 Usuarios registrados</h2>';
                echo '<table>';
                echo '<thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Fecha Registro</th></tr></thead>';
                echo '<tbody>';
                
                foreach ($usuarios as $usuario) {
                    echo '<tr>';
                    echo '<td><span class="badge badge-info">#' . htmlspecialchars($usuario['id']) . '</span></td>';
                    echo '<td>' . htmlspecialchars($usuario['nombre']) . '</td>';
                    echo '<td>' . htmlspecialchars($usuario['email']) . '</td>';
                    echo '<td><span class="badge badge-success">' . htmlspecialchars($usuario['fecha_registro']) . '</span></td>';
                    echo '</tr>';
                }
                
                echo '</tbody></table>';
            }
            
        } catch (PDOException $e) {
            echo '<div class="status error">❌ Error de conexión: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
        ?>
        
        <div class="info-box">
            <h3>ℹ️ Información del entorno</h3>
            <p>
                <strong>Servicios Docker:</strong><br>
                • MySQL: localhost:3306<br>
                • PHPMyAdmin: <a href="http://localhost:8081" target="_blank" style="color: #1976d2;">localhost:8081</a><br>
                • Aplicación PHP: localhost:8000
            </p>
        </div>
    </div>
</body>
</html>
