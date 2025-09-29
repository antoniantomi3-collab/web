<?php

/**
 * Clase para manejar la lógica de las tarifas y el cálculo del costo.
 * Esto ayuda a organizar mejor el código y a que sea más reutilizable.
 */
class CalculadoraLlamadas
{
    // Usamos 'private' para que las tarifas solo se puedan acceder desde esta clase.
    private $tarifas;

    public function __construct()
    {
        // El constructor inicializa el array de tarifas.
        $this->tarifas = [
            12 => ['zona' => 'América del Norte', 'precio' => 2.1],
            15 => ['zona' => 'América Central',  'precio' => 2.6],
            18 => ['zona' => 'América del Sur',  'precio' => 4.5],
            19 => ['zona' => 'Europa',           'precio' => 3.6],
            23 => ['zona' => 'Asia',             'precio' => 6.5],
            25 => ['zona' => 'África',           'precio' => 7.8],
            29 => ['zona' => 'Oceanía',          'precio' => 3.9],
        ];
    }

    /**
     * Devuelve todas las tarifas disponibles.
     * Útil para mostrarlas en el formulario.
     */
    public function getTarifas(): array
    {
        return $this->tarifas;
    }

    /**
     * Valida si una clave de zona existe.
     */
    public function claveExiste(int $clave): bool
    {
        return isset($this->tarifas[$clave]);
    }

    /**
     * Calcula el costo total de la llamada.
     * Devuelve un array con los detalles del cálculo.
     */
    public function calcularCosto(int $clave, int $minutos): array
    {
        // Obtenemos los detalles de la tarifa para la clave dada.
        $tarifa = $this->tarifas[$clave];
        
        // Realizamos el cálculo.
        $costoTotal = $tarifa['precio'] * $minutos;

        // Devolvemos un array con toda la información relevante.
        return [
            'zona'          => $tarifa['zona'],
            'minutos'       => $minutos,
            'costo_minuto'  => $tarifa['precio'],
            'costo_total'   => $costoTotal
        ];
    }
}

// Inicializamos las variables que usaremos en la vista.
$calculadora = new CalculadoraLlamadas();
$resultado = null;
$mensaje_error = '';

// Verificamos si el formulario se envió.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenemos y "limpiamos" los datos del formulario.
    $clave_seleccionada = filter_input(INPUT_POST, 'clave', FILTER_VALIDATE_INT);
    $minutos_llamada    = filter_input(INPUT_POST, 'minutos', FILTER_VALIDATE_INT);

    // Validamos la entrada de datos.
    if ($clave_seleccionada && $minutos_llamada && $minutos_llamada > 0) {
        // Verificamos si la clave enviada es válida usando el método de la clase.
        if ($calculadora->claveExiste($clave_seleccionada)) {
            // Si todo es correcto, calculamos el costo.
            $resultado = $calculadora->calcularCosto($clave_seleccionada, $minutos_llamada);
        } else {
            $mensaje_error = 'La zona seleccionada no es válida.';
        }
    } else {
        $mensaje_error = 'Por favor, seleccione una zona e ingrese un número de minutos válido.';
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Costo de Llamadas Internacionales (Versión Mejorada)</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; max-width: 550px; margin: 40px auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        h1 { text-align: center; color: #333; }
        form { display: flex; flex-direction: column; gap: 1rem; }
        label { font-weight: bold; color: #555; }
        input, select { padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 1rem; }
        button { padding: 12px; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 5px; font-size: 1rem; font-weight: bold; transition: background-color 0.2s; }
        button:hover { background-color: #218838; }
        .resultado { margin-top: 1.5rem; padding: 1rem; background-color: #f0f8ff; border-left: 6px solid #17a2b8; border-radius: 5px; }
        .resultado p { margin: 0.5rem 0; }
        .error { margin-top: 1rem; padding: 1rem; color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; text-align: center;}
    </style>
</head>
<body>

    <h1>Calculadora de Llamadas Internacionales</h1>

    <form action="" method="POST">
        <div>
            <label for="clave">Seleccione la Zona de Destino:</label>
            <select id="clave" name="clave" required>
                <option value="">-- Elige una zona --</option>
                <?php foreach ($calculadora->getTarifas() as $clave => $datos): ?>
                    <option value="<?php echo $clave; ?>">
                        <?php echo htmlspecialchars($datos['zona']); ?> ($<?php echo number_format($datos['precio'], 2); ?>/min)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="minutos">Número de Minutos:</label>
            <input type="number" id="minutos" name="minutos" placeholder="Ej: 15" min="1" required>
        </div>
        <button type="submit">Calcular Costo</button>
    </form>

    <?php if ($mensaje_error): ?>
        <p class="error"><?php echo $mensaje_error; ?></p>
    <?php endif; ?>

    <?php if ($resultado): ?>
        <div class="resultado">
            <h3>Resumen del Costo</h3>
            <p><strong>Zona de Destino:</strong> <?php echo htmlspecialchars($resultado['zona']); ?></p>
            <p><strong>Minutos Hablados:</strong> <?php echo htmlspecialchars($resultado['minutos']); ?></p>
            <p><strong>Costo por Minuto:</strong> $<?php echo number_format($resultado['costo_minuto'], 2); ?></p>
            <hr>
            <p><strong>COSTO TOTAL: $<?php echo number_format($resultado['costo_total'], 2); ?></strong></p>
        </div>
    <?php endif; ?>

</body>
</html>