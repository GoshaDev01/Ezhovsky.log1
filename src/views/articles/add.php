<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../src/assets/css/main.css"> -->
    <title>Ну попробуй</title>
</head>
<body>
    <h1>Создание статьи: <br></h1>
    <form action="" method="POST" enctype="multipart/form-data" >
        <div class="mb-3">
            <label for="inputName" class="form-label">Название статьи</label>
            <input type="text" class="form-control" id="inputName" name="name" value="<?= $_POST['name'] ?? ''?>" placeholder="Название">
        </div>
        <div class="mb-3">
            <label for="inputName" class="form-label">Тексе статьи</label>
            <input type="text" class="form-control" id="inputText" name="text" value="<?= $_POST['text'] ?? ''?>" placeholder="Текс">
        </div>
        <div class="mb-3">
            <label for="inputImg" class="form-label">Файл</label>
            <input type="file" class="form-control" id="inputImg" name="img">
        </div>
       
        <input type="submit" value="Создать статью" class="btn btn-dark card-button">
        <a href="../articles/" class="btn btn-dark card-button">Назад</a>
        
    </form>
</body>
</html>
