<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/Ezhovsky.log1/">
    <title>Постики</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"
        defer></script>
    <link rel="shortcut icon" href="../src/assets/css/favicon.png" type="image/png">
    <link rel="stylesheet" href="../src/assets/css/main.css">
</head>
<body> 
<header>
    <h1>Мой Блог</h1>
    <nav>
        <a href="../articles/">Главная</a>
        <a href="#about">О нас</a>
        <a href="../users/logIn">Вход</a>
        <a href="../users/signUp">Регистраци</a>
    </nav>
</header>

    <main class="container pt-3 pb-3">
         <?= $content ?><br>
         <br>
         
    </main>

   
<footer>
    <p>© 2024 Мой Блог | Связаться: info@myblog.ru</p>
</footer>
</body>

</html>