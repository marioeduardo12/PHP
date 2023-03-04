<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action="somar.php" method="post"> <!-- o action é para linkar o php e o method post os dados são enviados na página, não na url, ja o get seria incorporado na URL, iria ser mostrado -->
        <p>Numero 1</p>
        <input type="text" name="numero1">
        <p>Numero 2</p>
        <input type="text" name="numero2">
        <button>Enviar</button>
    </form>

</body>
</html>