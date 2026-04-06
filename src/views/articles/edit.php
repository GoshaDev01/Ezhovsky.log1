<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../src/assets/css/main.css"> -->
    <title>Меняй, меняй</title>
</head>
<body>
    <h1>Редактирование статьи: <br><?= $article->getName() ?></h1>

    <form action="" method="POST" >

    <div class="mb-3">
            <label for="inputName" class="form-label">Название статьи</label>
            <input type="text" class="form-control" id="inputName" name="name" value="<?= $article->getName()?>" placeholder="Название">
        </div>
        <div class="mb-3">
            <label for="inputName" class="form-label">Тексе статьи</label>
            <input type="text" class="form-control" id="inputText" name="text" <?= $article->getText()?> placeholder="Текс">
        </div>
        <input type="submit" value="Обновить" class="btn btn-dark card-button">
        <a href="../article/<?= $article->getId();?>" class="btn btn-dark card-button">Назад</a>
    </form>
</body>
</html>
