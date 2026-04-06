 <h1 class="card-title">Список пользователей</h1>
 <?php if (empty($users)): ?>
        <div class="alert alert-info text-center">
            Пользователи не найдены
        </div>
    <?php else: ?>
    <!-- <div class="table-responsive"> -->
        <!-- <table class="table table-striped table-hover"> -->
            <!-- <thead>
                <tr>
                <th>ID</th>
                        <th>Nickname</th>
                        <th>Email</th>
                        <th>Роль</th>
                        <th>Подтверждён</th>
                        <th>Дата регистрации</th> 
                </tr>
            </thead> -->
            <!-- <tbody> -->
            <!-- <tbody> -->
            <?php foreach ($users as $user): ?>
                <!-- <tr> -->
                    <td><?= $user->getId();?></td>
                    <td><?= htmlspecialchars($user->getNickname()) ?></td>
                    <td><?= htmlspecialchars($user->getEmail()) ?></td>
                    <td><?= $user->getRole();?></td>
                    <td><?= $user->getIs_confirmed() ? 'Да' : 'Нет'?></td>
                    <td><?= $user->getCreated_at()?></td>
                <!-- </tr> -->
                <?php endforeach; ?>
            <!-- </tbody> -->
        <!-- </table> -->
    <!-- </div> -->
    <?php endif; ?>
    <a href="../articles/" class="btn btn-dark card-button">Назад</a>

