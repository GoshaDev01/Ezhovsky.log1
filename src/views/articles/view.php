<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../src/assets/css/main.css"> -->
    <title>НОВОСТИ | Информация статьи</title>
</head>
<body>
    <h1><?= $article->getName() ?></h1>
    <?= $article->getText() ?>
    <!-- <?php // $article->getAuthor()->getNickname() ?>  -->
</body>
</html>