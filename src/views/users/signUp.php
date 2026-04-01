<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h1 class="card-title text-center mb-4 h2">Регистрация</h1>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $error ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nickname" class="form-label">Nickname</label>
                            <input type="text" class="form-control" id="nickname" name="nickname"
                                value="<?= $_POST['nickname'] ?? '' ?>" placeholder="Введите никнейм">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= $_POST['email'] ?? '' ?>" placeholder="example@mail.com">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                value="<?= $_POST['email'] ?? '' ?>" placeholder="Введите пароль">
                        </div>

                        <button type="submit" class="btn btn-dark card-button w-100 py-2">Зарегистрироваться</button>
                        <div class="text-center mt-3 pt-2 border-top">
                            <p class="mb-0">Нет аккаунта? <a href="../users/logIn"
                                    class="text-decoration-none">Войти</a></p>
                        </div>
                    </form>

                    <!-- <div class="text-center mt-3 pt-2 border-top"> -->


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (опционально, для работы alert) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>