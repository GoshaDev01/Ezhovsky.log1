<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../src/assets/css/main.css"> -->
    <title>НОВОСТИ | Информация статьи</title>
</head>
<body>
    <h1>Редактирование статьи: <br><?= $article->getName() ?></h1>
    <!-- <p><?php// $article->getText() ?></p> -->
    <!-- <?php // $article->getAuthor()->getNickname() ?>  -->

    <form action="" method="POST" >

        <label> Название статьи : <input type="text" name="name" value="<?= $article->getName()?>"></label><br>
        <label> Текст статьи :<textarea class="fff"name="text" id=""><?= $article->getText()?></textarea></label><br><br>
        <!-- <label> Текст статьи : <input type="text" name="text" value="<?php// $article->getText()?>"></label><br> -->
        <input type="submit" value="Обновить" class="btn btn-dark card-button">
        <a href="../article/<?= $article->getId();?>" class="btn btn-dark card-button">Назад</a>
    </form>
</body>
</html>
