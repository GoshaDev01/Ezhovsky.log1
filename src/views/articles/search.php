<title>Постики</title>
<style>
    .card {
        height: 580px !important;
        display: flex;
        flex-direction: column;
    }

    .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card-content {
        flex: 1;
        overflow-y: auto;
        margin-bottom: 15px;
    }

    .card-text {
        overflow-y: auto;
        max-height: 200px;
        padding-right: 5px;
    }

    /* Стили для скроллбара */
    .card-content::-webkit-scrollbar,
    .card-text::-webkit-scrollbar {
        width: 5px;
    }

    .card-content::-webkit-scrollbar-track,
    .card-text::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .card-content::-webkit-scrollbar-thumb,
    .card-text::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .card-content::-webkit-scrollbar-thumb:hover,
    .card-text::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .card-body img {
        border: 1px solid #D3D3D3 !important;
        border-radius: 20px;
        width: 100%;
        height: 180px;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .card-title {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .card-buttons {
        margin-top: auto;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .card-button {
        margin-top: 0 !important;
        width: 100%;
    }








    * {
        box-sizing: border-box;
    }

    form {
        position: relative;
        width: 300px;
        margin: 0 auto;
        background: #00000;
        border-top-left-radius:; 
        border: 1px solid #d3d3d3;
        
    }

    input,
    button {
        border: none;
        outline: none;
        background: transparent;
    }

    input {
        width: 100%;
        height: 42px;
        padding-left: 15px;
    }

    button {
        height: 42px;
        width: 42px;
        position: absolute;
        top: 0;
        right: 0;
        cursor: pointer;
    }

    button:before {
        content: "\f002";
        font-family: FontAwesome;
        font-size: 16px;
        color: #F9F0DA;
    }
</style>

<?php if(empty($_GET['q'])):?>
    <form>
    <input class="form-control" type="text" name="q" placeholder="Искать здесь...">
    <input type="submit"></input>
</form><br>
<?php else: ?>
    <h1>Результаты поиска</h1>
<section id="blogList" class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4 g-2">

    <?php foreach ($articles as $article): ?>
        <article class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($article->getName()) ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($article->getAuthor()->getNickname()) ?>
                    </h6>

                    <?php if ($article->getImg() !== null): ?>
                        <img src="<?= $article->getImg() ?>" alt="">
                    <?php endif; ?>

                    <div class="card-content">
                        <p class="card-text"><?= htmlspecialchars($article->getText()) ?></p>
                    </div>

                    <div class="card-buttons">
                        <a href="/article/<?= $article->getId() ?>" class="btn btn-dark card-button">Подробнее</a>
                        <?php // if (isset($user) && $user && $user->getId() === $article->getAuthor_id()): ?>
                        <!--   <a href="/article/<?= $article->getId() ?>/delete" style="border-radius: 20px;"
                             class="btn btn-danger card-button"
                                onclick="return confirm('Вы уверены, что хотите удалить эту статью?')">
                                Удалить
                            </a>
                        <? php// endif; ?> -->
                    </div>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</section>

<?php if (isset($user) && $user): ?>
    <br>
    <p><a class="btn btn-dark card-button" href="/articles/add">Добавить статью</a></p>
<?php endif; ?>
<?php endif;?>