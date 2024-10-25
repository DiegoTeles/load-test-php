<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stress Test via PHP</title>
</head>
<body>
        <center>
           <h2>Controle de Estresse de CPU</h2>
        <img src="images/AWS_Logo_Web_200px.png" />
   <center>

    <form method="GET">
        <button type="submit" name="action" value="start">Iniciar Estresse</button>
        <button type="submit" name="action" value="stop">Parar Estresse</button>
    </form>

    <?php
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        if ($action === 'start') {
            echo "<p>Iniciando estresse de CPU...</p>";
            // Executa o script de estresse em segundo plano
            exec('bash cpu_stress.sh > /dev/null 2>&1 &');
        } elseif ($action === 'stop') {
            // Lê o PID do arquivo e encerra o processo
            if (file_exists('/tmp/cpu_stress.pid')) {
                $pid = file_get_contents('/tmp/cpu_stress.pid');
                exec("kill -9 $pid");
                unlink('/tmp/cpu_stress.pid');  // Remove o arquivo PID
                echo "<p>Estresse de CPU parado.</p>";
            } else {
                echo "<p>Nenhum processo de estresse em execução.</p>";
            }
        }
    }
    ?>
</body>
</html>
 