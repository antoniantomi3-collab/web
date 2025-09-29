<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Calculadora de Sueldo</title>
    <link rel="stylesheet" href="consulta4.css">

    <!-- Fuente futurista -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet" />

    <!-- Archivo CSS -->
    <link rel="stylesheet" href="consulta4.css" />
</head>

<body>

    <div class="container">
        <h1>Calculadora de sueldo</h1>

        <label for="horas">Horas trabajadas:</label>
        <input type="number" id="horas" placeholder="Ej: 100" />

        <label for="pago">Pago por hora ($):</label>
        <input type="number" id="pago" placeholder="Ej: 16" />

        <button onclick="calcularSueldo()">Calcular</button>

        <div class="resultado">
            <p id="bruto"></p>
            <p id="retencion"></p>
            <hr />
            <p id="neto"></p>
        </div>
    </div>

    <!-- Script para calcular -->
    <script>
        function calcularSueldo() {
            const horas = parseFloat(document.getElementById("horas").value);
            const pago = parseFloat(document.getElementById("pago").value);

            if (isNaN(horas) || isNaN(pago)) {
                alert("Por favor ingresa valores válidos.");
                return;
            }

            const bruto = horas * pago;
            const retencion = bruto * 0.10;
            const neto = bruto - retencion;

            document.getElementById("bruto").textContent = `Sueldo bruto: $${bruto.toFixed(2)}`;
            document.getElementById("retencion").textContent = `Retención: $${retencion.toFixed(2)}`;
            document.getElementById("neto").textContent = `Sueldo neto: $${neto.toFixed(2)}`;
        }
    </script>

</body>

</html>