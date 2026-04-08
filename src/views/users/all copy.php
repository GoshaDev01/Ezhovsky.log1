<h1 class="card-title">Список пользователей</h1><br>
 <?php if (empty($users)): ?>
        <div class="alert alert-info text-center">
            Пользователи не найдены
        </div>
    <?php else: ?>
    <div class="table-responsive">
     
            <?php foreach ($users as $user): ?>
                <article class="col">
            <div class="card">
                <div class="card-body">
                    <div class="firstStroke">
                    <h2 class="card-text"><?=  $user->getId();?> - </h2>
                    <p class="card-title"> <?= htmlspecialchars($user->getNickname())?>: </p>
                    </div>
                   
                    <p class="card-text"><?= htmlspecialchars($user->getEmail()) ?></p>
                    <p class="card-text"><?= $user->getRole(); ?></p>
                    <p class="card-text"><?= $user->getCreated_at()?></p>
                </div>
            </div>
            <style>
                .firstStroke{
                    display: flex;
                    align-items: center;
                }
                h2{
                    margin-top: -10px !important;
                    margin-bottom: -10px !important;
                }
                p{

                }
                .card{
                    /* width: 70%; */
                    width: 250px !important;
                    height: 250px !important;
                    display: flex !important;
                    /* align-items: center; */
                    /* justify-content: center; */
                    margin-bottom: 20px;
                }
                .table-responsive{
                    display: flex;
                    /* align-items: center; */
                    /* justify-content: center !important; */
                    flex-wrap: wrap;
                    gap: 20px;
                }
            </style>
        </article>
                <?php endforeach; ?>
    </div>
    <?php endif; ?>
