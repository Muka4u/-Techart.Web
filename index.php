<?php

require_once 'include/pdo.php';

$page = isset($_GET['page']) ? $_GET['page']: 1;
//* 
function countRows($table){
    global $pdo;
    $rows = $pdo->prepare("SELECT COUNT(*) FROM news");
    $rows->execute();
    return $rows->fetchColumn(); 
}
//
$limit = 4;
$offset = $limit * ($page - 1);
$totalPages = ceil(countRows('news')/$limit);
// 
function parseNews($table) {
    global $pdo;
    global $limit;
    global $offset;
    $sth = $pdo->prepare("SELECT * FROM news ORDER BY date DESC LIMIT $limit OFFSET $offset");
    $sth->execute();
    return $sth->fetchAll();
}
// 
$news = parseNews('news');
// 
function parseBanner($table) {
    global $pdo;
    $sql = $pdo->prepare("SELECT * FROM news ORDER BY date DESC LIMIT 1");
    $sql->execute();
    return $sql->fetchAll();
}
// 
$banner = parseBanner('news');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галактический вестник</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <!-- -->
        <div class="header__logo">
            <img src="sourse/images/logo.svg" alt="logo" class="header__logo_image">    
         </div>
        
        <?php foreach ($banner as $top): ?>
        <div class="header__banner">
            <div class="img__banner">
                <img class="photo" src="sourse/images/<?= $top['image'] ?>">
            </div>
            <h1 class="header__banner_text_h1 text-h1"><?= $top['title'] ?></h1>
            <h2 class="header__banner_text_h2 text-h2"><?= $top['announce'] ?></h2>
            <?php endforeach; ?>    
        </div>
         <!-- -->
    </header>
    <main class="main">
        <section class="main__content">     
            <h1 class="news__head text-h1">Новости</h1>    
            <!--  -->
            <div class="news">
                <!--  -->
                <?php foreach ($news as $topic): ?>
                <div class="news__item">
                    <p class="news__item_title_date text-date">
                    <?= date("d.m.Y", strtotime($topic['date'])) ?>
                    </p>
                    <a href="view.php?id=<?= $topic['id'] ?>" class="news__a">
                    <h2 class="news__item_title-text text-h2"><?= $topic['title'] ?></h2>
                    </a>
                    <span class="news__item_text text-p">
                    <?= $topic['announce'] ?>
                    </span>
                    <a href="view.php?id=<?= $topic['id'] ?>" class="btn text-button">Подробнее &rarr;</a>
                </div>
                <?php endforeach; ?>
            </div>        
            <!-- Подключение пагинации -->
            <?php include("include/pagination.php");?>
            <!-- Конец пагинации -->
        </section>
    </main>
    <footer class="footer">
        <hr color="#6C6E7B" size="1px">
        <p class="text-p">© 2023 — 2412 «Галактический вестник»</p>
    </footer>
</body>
</html>