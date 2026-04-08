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

    <p><?= $article->getAuthor()->getNickname(); ?></p>
    <?php if ($article->getImg() !== null): ?>
        <img style="border: 1px solid #D3D3D3 !important; border-radius: 20px;" src="<?= $article->getImg() ?>"
            width="400px" alt=""><br>
    <?php endif; ?>
    <style>
        p {
            font-weight: bold;
        }
    </style>
    <?= $article->getText() ?><br><br>
    <a href="../articles/" class="btn btn-dark card-button">Назад</a>

    <?php if (isset($user) && $user && $user->getId() == $article->getAuthor_id()): ?>
        <a href="../article/<?= $article->getId() ?>/edit" class="btn btn-dark card-button">Изменить</a>

        <a href="/article/<?= $article->getId() ?>/delete" style="border-radius: 20px;" class="btn btn-danger card-button"
            onclick="return confirm('Вы уверены, что хотите удалить эту статью?')">
            Удалить
        </a>
    <?php endif; ?>

    <!-- <?php // $article->getAuthor()->getNickname() ?>  -->
</body>

</html>