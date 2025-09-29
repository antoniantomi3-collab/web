<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Pago - Formulario</title>
    <link rel="stylesheet" href="consulta1.css">
</head>
<body>

    <div class="contenedor-principal">
        <header>
            <h1>Cálculo de Sueldo por Categoría</h1>
        </header>

        <?php
        // 1. Inicializar variables para el formulario
        $sueldo_base = '';
        $categoria_seleccionada = '';
        $resultado_html = '';

        // 2. Verificar si el formulario fue enviado (usando el método POST)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recibir y limpiar los datos del formulario
            $sueldo_base = floatval($_POST['sueldo']);
            $categoria_seleccionada = intval($_POST['categoria']);
            $nuevo_sueldo = 0;
            $mensaje = '';

            // 3. Lógica de cálculo (similar a tu código original)
            if ($categoria_seleccionada == 1) {
                $nuevo_sueldo = $sueldo_base * 1.30;
                $mensaje = "Aumento del 30%";
            } elseif ($categoria_seleccionada == 2) {
                $nuevo_sueldo = $sueldo_base * 1.20;
                $mensaje = "Aumento del 20%";
            } elseif ($categoria_seleccionada == 3) {
                $nuevo_sueldo = $sueldo_base * 1.15;
                $mensaje = "Aumento del 15%";
            } else {
                $nuevo_sueldo = $sueldo_base;
                $mensaje = "Sin aumento (Categoría no válida)";
            }

            // 4. Generar la salida de resultados
            $resultado_html = "
                <div class='resultado-box'>
                    <h2>Resultado del Cálculo</h2>
                    <p>Sueldo Base: <strong>$$sueldo_base</strong></p>
                    <p>Categoría: <strong>$categoria_seleccionada</strong></p>
                    <p>Aumento Aplicado: <strong>$mensaje</strong></p>
                    <hr>
                    <p class='resultado-final'>Nuevo Sueldo: <strong>$$nuevo_sueldo</strong></p>
                    <a href='#' onclick='window.history.back()' class='btn-volver'>&#x25C0; Calcular de Nuevo</a>
                </div>
            ";
            
        } 
        
        // 5. Mostrar el formulario si no se ha enviado O si se necesita ver el formulario nuevamente
        if (empty($resultado_html)) {
        ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="formulario-pago">
                <div class="form-group">
                    <label for="sueldo">Sueldo Base ($):</label>
                    <input type="number" id="sueldo" name="sueldo" min="1" step="0.01" value="1000" required>
                </div>
                
                <div class="form-group">
                    <label for="categoria">Categoría (1, 2 ó 3):</label>
                    <select id="categoria" name="categoria" required>
                        <option value="1" selected>Categoría 1 (30%)</option>
                        <option value="2">Categoría 2 (20%)</option>
                        <option value="3">Categoría 3 (15%)</option>
                        <option value="4">Otras</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-calcular">Calcular Nuevo Sueldo</button>
            </form>
        <?php
        } else {
            // Mostrar los resultados si el formulario fue enviado
            echo $resultado_html;
        }
        ?>
    </div>

</body>
</html>