<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title ?? 'Mon site' ?> </title>

<!-- CSS bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body class="d-flex flex-column h-100 ">
    <nav class="navbar navbar-expend-lg navbar-dark bg-primary" style="padding-left:20px">
        <a href="#" class="navbar-brand"> Mon site </a>
    </nav>

    <!-- Insertion de la page demandée -->
    <div class="container mt-4">
        <?= $content ?>
    </div>

    <!-- Temps de chargement de la page -->
    <footer class="bg-light py-4 footer mt-auto" >
        <div class="container">
            <?php if(defined('DEBUG_TIME')) : ?>
            Page générée en <?= round(1000*(microtime(true) - DEBUG_TIME)) ?> ms
            <?php endif ?>
        </div>
    </footer>


    
</body>
</html>