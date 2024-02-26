<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Càlcul de Volums i Superfícies</title>
</head>
<body>
    <h1>Càlcul de Volums i Superfícies</h1>

    <form method="post" action="">
        <label for="cuerpo">Selecciona el cos:</label>
        <select name="cuerpo" id="cuerpo">
            <option value="cilindre">Cilindre</option>
            <option value="esfera">Esfera</option>
            <option value="cub">Cub</option>
            <option value="piramide">Piràmide Rectangular</option>
            <option value="cono">Cone de Revolució</option>
        </select>

        <div id="dimensiones-container">
            <!-- Caselles per a les dimensions específiques de cada cos -->
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $cuerpo = $_POST['cuerpo'];

                switch ($cuerpo) {
                    case 'cilindre':
                    case 'cono':
                        echo '
                            <label for="radi">Radi:</label>
                            <input type="text" name="radi" id="radi">
                            <br>
                            <label for="altura">Alçada:</label>
                            <input type="text" name="altura" id="altura">
                        ';
                        break;

                    case 'esfera':
                        echo '
                            <label for="radi">Radi:</label>
                            <input type="text" name="radi" id="radi">
                        ';
                        break;

                    case 'cub':
                        echo '
                            <label for="costat">Costat:</label>
                            <input type="text" name="costat" id="costat">
                        ';
                        break;

                    case 'piramide':
                        echo '
                            <label for="base_larga">Base (llargada):</label>
                            <input type="text" name="base_larga" id="base_larga">
                            <br>
                            <label for="base_ample">Base (amplada):</label>
                            <input type="text" name="base_ample" id="base_ample">
                            <br>
                            <label for="altura">Alçada:</label>
                            <input type="text" name="altura" id="altura">
                        ';
                        break;

                    default:
                        break;
                }
            }
            ?>
        </div>

        <br>

        <input type="submit" value="Calcular">
    </form>

    <?php
    // PHP para calcular y mostrar los resultados
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cuerpo = $_POST['cuerpo'];
        $superficie_total = 0;
        $volum = 0;

        switch ($cuerpo) {
            case 'cilindre':
                $radi = $_POST['radi'];
                $altura = $_POST['altura'];
                $superficie_total = 2 * M_PI * $radi * ($radi + $altura);
                $volum = M_PI * pow($radi, 2) * $altura;
                break;

            case 'esfera':
                $radi = $_POST['radi'];
                $superficie_total = 4 * M_PI * pow($radi, 2);
                $volum = (4 / 3) * M_PI * pow($radi, 3);
                break;

            case 'cub':
                $costat = $_POST['costat'];
                $superficie_total = 6 * pow($costat, 2);
                $volum = pow($costat, 3);
                break;

            case 'piramide':
                $base_larga = $_POST['base_larga'];
                $base_ample = $_POST['base_ample'];
                $altura = $_POST['altura'];
                $superficie_total = $base_larga * $base_ample + 2 * $base_larga * sqrt(pow($base_ample / 2, 2) + pow($altura, 2)) + 2 * $base_ample * sqrt(pow($base_larga, 2) + pow($altura, 2));
                $volum = ($base_larga * $base_ample * $altura) / 3;
                break;

            case 'cono':
                $radi = $_POST['radi'];
                $altura = $_POST['altura'];
                $generatriu = sqrt(pow($radi, 2) + pow($altura, 2));
                $superficie_total = M_PI * $radi * ($radi + $generatriu);
                $volum = (M_PI * pow($radi, 2) * $altura) / 3;
                break;

            default:
                echo "Selecciona un cos vàlid.";
                break;
        }
        echo "<h2>Resultats:</h2>";
        echo "<p><strong>Cos seleccionat:</strong> $cuerpo</p>";
        echo "<p><strong>Superfície total:</strong> $superficie_total</p>";
        echo "<p><strong>Volum:</strong> $volum</p>";
    }
    ?>
</body>
</html>

