<?php

require_once 'include/pdo.php';

$newsId = isset($_GET['id']) ? $_GET['id']: 1;

// 
function parseNewsView($table) {
    global $pdo;
    global $newsId;
    $sth = $pdo->prepare("SELECT * FROM news WHERE id = $newsId");
    $sth->execute();
    return $sth->fetchAll();
}
// 

$newsView = parseNewsView('news');

?>
<?php foreach ($newsView as $topic): ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?= $topic['title'] ?></title>
</head>
<body>
    <header class="header">
        <div class="header__logo">
            <img src="sourse/images/logo.svg" alt="logo" class="header__logo_image">    
        </div>
    </header>
    <hr color="#6C6E7B" size="1px">
<main class="main">
    <section class="main__content">
        <!-- Заголовок -->
        <div class="news__view">
            <p class="header__nav_text"><a href="/mysite/index.php" class="header__nav">Главная</a> / <?= $topic['title'] ?></p>
            <h1 class="view__title_text text-h1"><?= $topic['title'] ?></h1>
        </div>
        <!--  -->
        <div class="view__content_inner">
            <!-- Описание-->
            <div class="view__content">
                <p class="view__item_title_date text-date"><?= date("d.m.Y", strtotime($topic['date'])) ?></p>
                <h2 class="view__contant_title text-h2"><?= $topic['announce'] ?></h2>
                <span class="view__contant_span text-p"><?= $topic['content'] ?></span>
                <a href="/mysite/index.php" class="btn text-button">&larr;Назад к новостям</a>
            </div>
            <!-- Картинка-->
            <div class="view__image">
                <img class="view__contant_image" src="sourse/images/<?= $topic['image'] ?>">
            </div>    
        </div>
    </section>
</main>
<footer class="footer">
    <hr color="#6C6E7B" size="1px">
    <p class="text-p">© 2023 — 2412 «Галактический вестник»</p>
</footer>
</body>
</html>
<?php endforeach; ?>