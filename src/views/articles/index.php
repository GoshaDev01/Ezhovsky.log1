<head>
<link rel="stylesheet" href="../src/assets/css/main.css">
</head>
<section id="blogList" class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4 g-2">
    <?php foreach ($articles as $article):  ?>
    <article class="col">
        <div class="card">
                <!-- <img src="../src/assets/articles/spring.jpg" class="card-img-top" alt="Фото статьи"> -->
                <div class="card-body">
                    <h5 class="card-title"><?= $article->getName(); ?></h5>
                    <p class="card-text"><?= $article->getText() ?></p>
                    <?= $article->getAuthor()->getNickname()?>
              


                    <a   href="../article/<?= $article->getId()?>" class="btn btn-dark card-button">Подробнее</a> <!-- добавил ../ чтобы возвращаться на главную страницу-->
                </div>
            </div>
        </article>
    <?php endforeach ?>
</section>