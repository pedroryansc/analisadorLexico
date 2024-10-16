<!DOCTYPE html>
<?php
    $codigo = isset($_POST["codigo"]) ? $_POST["codigo"] : "";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisador Léxico</title>
    <style>
        body{
            font-family: Arial;
            margin: 20px;
        }

        textarea{
            width: 100%;
            height: 200px;
        }

        p{
            font-size: 20px;
        }

        #tokens{
            background-color: #f4f4f4;
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h1>Analisador Léxico</h1>
    <br>
    <form method="post">
        <textarea name="codigo"></textarea>
        <br>
        <button type="submit">Analisar</button>
    </form>
    <br>
    <?php
        if(isset($_POST["codigo"]) && $codigo != ""){
            echo "<pre><p>".$codigo."</p></pre>";
    ?>
    <h3>Tokens:</h3>
    <pre id="tokens">
        
    </pre>
    <?php
        }
    ?>
</body>
</html>