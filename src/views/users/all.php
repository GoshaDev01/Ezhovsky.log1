 <div class="container pt-3 pb-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title" style="font-size: 50px !important;">Список пользователей</h5>
        <!-- <a href="/articles/" class="btn btn-dark card-button" style="width: auto; padding: 8px 20px;">← На главную</a> -->
    </div>

    <?php if (empty($users)): ?>
        <div class="alert alert-info text-center">
            Пользователи не найдены
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4 g-4">
            <?php foreach ($users as $user): ?>
                <article class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <h5 class="card-title mb-0">#<?= htmlspecialchars($user->getId()) ?></h5>
                                <h5 class="card-title mb-0"><?= htmlspecialchars($user->getNickname()) ?></h5>
                            </div>
                            
                            <p class="card-text mb-2">
                                <strong>Email:</strong> <?= htmlspecialchars($user->getEmail()) ?>
                            </p>
                            
                            <p class="card-text mb-2">
                                <strong>Роль:</strong> 
                                <?php if ($user->getRole() === 'admin'): ?>
                                    <span >Администратор</span>
                                <?php else: ?>
                                    <span >Пользователь</span>
                                <?php endif; ?>
                            </p>
                            <p class="card-text mb-2" >
                                <strong>Авторизован:</strong> 
                                <?php if (isset($currentUser) && $currentUser && $currentUser->getId() === $user->getId()): ?>
                                    <span style="color: green; font-size: 20px"> Вы</span>
                                <?php else: ?>
                                    <span style="color: red; font-size: 20px"> Не вы</span>
                                <?php endif; ?>
                            </p>
                            
                            <p class="card-text mb-2">
                                <strong>Подтверждён:</strong> 
                                <?php if ($user->getIs_confirmed()): ?>
                                    <span>Да</span>
                                <?php else: ?>
                                    <span >Нет</span>
                                <?php endif; ?>
                            </p>
                            
                            <p class="card-text">
                                <strong>Дата регистрации:</strong><br>
                                <?=  $user->getCreated_at() ?>
                            </p>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="mt-4 text-muted">
            <small>Всего пользователей: <?= count($users) ?></small>
        </div>
    <?php endif; ?>
</div>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #D3D3D3;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: 100% !important;
        min-height: 280px;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    .card-body {
        display: flex;
        flex-direction: column;
    }
    
    .card-title {
        font-size: 1.25rem !important;
        font-weight: 600;
    }
    
    .badge {
        font-size: 0.75rem;
        padding: 5px 10px;
        border-radius: 20px;
    }
    
    /* .btn-dark.card-button {
        border-radius: 20px;
        transition: all 0.3s ease;
    }
    
    .btn-dark.card-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    } */
    
    .container {
        max-width: 1400px;
    }
</style>