<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materie</title>
    <link rel="stylesheet" href="css/materie.css">
</head>
<body>
    <h2>Elenco materie</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
            </tr>
        </thead>
        <!-- Qui verranno visualizzati i corsi e le relative materie -->
        <tbody class='righe-materie'>
        </tbody>
    </table>
    <br>
    <a href="corsi.html" class="btn">Vai ai Corsi</a>
    <button class="btn" onclick="creaMateria()">Crea Materia</button>
    <script src='script/materie.js'></script>
</body>
</html>