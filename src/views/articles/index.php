<title>Постики</title>
<section id="blogList" class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4 g-2">
    <?php foreach ($articles as $article): ?>
        <article class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($article->getName()) ?></h5>
                    <h5><?= htmlspecialchars($article->getAuthor()->getNickname()) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($article->getText()) ?></p>
                    <a href="/article/<?= $article->getId() ?>" class="btn btn-dark card-button">Подробнее</a>
                    <?php if (isset($user) && $user && $user->getId() === $article->getAuthor_id()): ?>
                        <a href="/article/<?= $article->getId() ?>/delete" class="btn btn-danger card-button"
                            onclick="return confirm('Вы уверены, что хотите удалить эту статью?')">
                            Удалить
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</section>

<?php if (isset($user) && $user): ?>
    <br><p><a class="btn btn-dark card-button" href="/articles/add">Добавить статью</a></p>
<?php endif; ?>