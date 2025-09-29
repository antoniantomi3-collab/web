<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pago de Examen de Admisión</title>
    <link rel="stylesheet" href="consulta5.css" />
</head>

<body>
    <div class="container">
        <h1>Pago de Examen de Admisión</h1>
        </ul>

        <form id="payment-form">
            <label for="importe">Importe base: S/.</label>
            <input type="number" id="importe" name="importe" min="0" step="0.01" value="0" />

            <label for="opciones">Seleccione opción:</label>
            <select id="opciones" name="opciones">
                <option value="normal" selected>Pago normal</option>
                <option value="colegio_nacional">Colegio Nacional (10% descuento)</option>
                <option value="colegio_particular">Colegio Particular (3% descuento)</option>
                <option value="otro">Otro (sin descuento)</option>
            </select>

            <div class="resultado">
                <p>Descuento aplicado: <span id="descuento">S/. 0.00</span></p>
                <p>Total a pagar: <span id="total">S/. 0.00</span></p>
            </div>
        </form>
    </div>

    <script>
        const importeInput = document.getElementById('importe');
        const opcionesSelect = document.getElementById('opciones');
        const descuentoSpan = document.getElementById('descuento');
        const totalSpan = document.getElementById('total');

        function calcular() {
            const importe = parseFloat(importeInput.value) || 0;
            const opcion = opcionesSelect.value;

            let descuento = 0;

            if (opcion === 'colegio_nacional') {
                descuento = importe * 0.10; // 10% descuento
            } else if (opcion === 'colegio_particular') {
                descuento = importe * 0.03; // 3% descuento
            } else {
                descuento = 0;
            }

            const total = importe - descuento;

            descuentoSpan.textContent = `S/. ${descuento.toFixed(2)}`;
            totalSpan.textContent = `S/. ${total.toFixed(2)}`;
        }

        importeInput.addEventListener('input', calcular);
        opcionesSelect.addEventListener('change', calcular);

        // Calcular al cargar
        calcular();
    </script>
</body>

</html>