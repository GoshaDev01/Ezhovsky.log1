<!DOCTYPE html>
<html lang="en">
<title>Просмотр</title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../src/assets/css/main.css"> -->
</head>

<body>
    <h1><?= $article->getName() ?></h1>
    <?php if ($article->getImg() !== null): ?>
        <img src="<?= $article->getImg() ?>" width="400px" alt=""><br>
    <?php endif; ?>
    <p><?= $article->getAuthor()->getNickname();?></p>
    <style>p{font-weight: bold;}</style>
    <?= $article->getText() ?><br><br>
    <a href="../articles/" class="btn btn-dark card-button">Назад</a>

    <?php if (isset($user) && $user && $user->getId() == $article->getAuthor_id()): ?>
        <a href="../article/<?= $article->getId() ?>/edit" class="btn btn-dark card-button">Изменить</a>
    <?php endif; ?>

    <!-- <?php // $article->getAuthor()->getNickname() ?>  -->
</body>

</html>