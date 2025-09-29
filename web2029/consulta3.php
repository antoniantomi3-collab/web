<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta 3: Promedio Final</title>
    <link rel="stylesheet" href="consulta3.css">
</head>

<body>
    <div class="container">
        <h1>Consulta 3: Promedio Final</h1>

        <label for="genero">Género del alumno:</label>
        <select id="genero">
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>

        <label for="nota1">Nota 1:</label>
        <input type="number" id="nota1" placeholder="Ejemplo: 15" min="0" max="20">

        <label for="nota2">Nota 2:</label>
        <input type="number" id="nota2" placeholder="Ejemplo: 14" min="0" max="20">

        <label for="nota3">Nota 3:</label>
        <input type="number" id="nota3" placeholder="Ejemplo: 13" min="0" max="20">

        <label for="nota4">Nota 4:</label>
        <input type="number" id="nota4" placeholder="Ejemplo: 16" min="0" max="20">

        <button id="btnCalcular">Calcular</button>

        <div id="resultado"></div>
    </div>

    <script>
        const genero = document.getElementById("genero");
        const notas = [
            document.getElementById("nota1"),
            document.getElementById("nota2"),
            document.getElementById("nota3"),
            document.getElementById("nota4")
        ];
        const resultado = document.getElementById("resultado");
        const btn = document.getElementById("btnCalcular");

        btn.addEventListener("click", () => {
            let suma = 0;
            let count = 0;

            notas.forEach(n => {
                let val = parseFloat(n.value);
                if (!isNaN(val)) {
                    suma += val;
                    count++;
                }
            });

            if (count === 0) {
            resultado.innerHTML = '<p style="color:red;">⚠️ Ingresa al menos una nota</p>';
            return;
            }

            let promedio = (suma / count).toFixed(2);
            let aumento = (genero.value === "M") ? 3 : 5;
            let nuevoPromedio = (parseFloat(promedio) + aumento).toFixed(2);

            resultado.innerHTML = `
                <p>Género: <b>${genero.value === "M" ? "MASCULINO" : "FEMENINO"}</b></p>
                <p>Promedio original: <b>${promedio}</b></p>
                <p>Aumento aplicado: <b>${aumento}</b></p>
                <p>Nuevo promedio final: <b style="color:#00ffaa; font-size:1.3rem;">${nuevoPromedio}</b></p>
            `;
        });
    </script>
</body>

</html>