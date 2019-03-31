<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Решение задач по математике</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen"/>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <div class="navbar-brand-content-wrapper d-flex align-items-center">
                <div class="d-inline-block navbar-brand-photo-wrapper">
                    <img src="img/foto.jpg" alt="">
                </div>
                <div class="d-flex flex-column ml-3 navbar-name">
                    <h5><strong>Прочухан</strong></h5>
                    <h5><strong>Дмитрий</strong></h5>
                    <h5><strong>Владимирович</strong></h5>
                </div>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-flex align-items-center justify-content-center text-center">
                    <a class="nav-link" href="index.html">Главная</a>
                </li>
                <li class="nav-item d-flex align-items-center justify-content-center text-center">
                    <a class="nav-link" href="schedule.html">Расписание</a>
                </li>
                <li class="nav-item d-flex align-items-center justify-content-center text-center">
                    <a class="nav-link" href="news.html">Новости</a>
                </li>
                <li class="nav-item d-flex align-items-center justify-content-center text-center">
                    <a class="nav-link" href="resume.html">Резюме</a>
                </li>
                <li class="nav-item d-flex align-items-center justify-content-center text-center">
                    <a class="nav-link" href="blog.html">Обучение</a>
                </li>
                <li class="nav-item d-flex align-items-center justify-content-center text-center">
                    <a class="nav-link" href="gallery.html">Фото</a>
                </li>
                <li class="nav-item d-flex align-items-center justify-content-center text-center">
                    <a class="nav-link" href="math-home.php">Каталог примеров</a>
                </li>
                <li class="nav-item d-flex align-items-center justify-content-center text-center">
                    <a class="nav-link" href="contacts.html">Контакты</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php
$link = mysqli_connect('localhost', 'id6663167_wp_9c206ba245a6c66c4d4fa0db58cf48a9', 'aB386958', 'id6663167_wp_da747b6e85d4512dc9c93f7e95cd0d6b');
if (mysqli_connect_errno()) {
    printf("Невозможно подключиться к базе данных");
    exit;
}
mysqli_set_charset($link, "utf8");
?>
<div class="container">
    <div class="jumbotron p-3 p-md-5 text-white rounded bg-schedule">
        <div class="col-md-6 px-0">
            <h2>Решение задач по математике</h2>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-8 math-content">
            <?php
            $name = isset($_GET['cat']) ? $_GET['cat'] : 'Прогрессии';

            $links = mysqli_query($link, "SELECT p.post_name FROM wp_terms t JOIN wp_term_taxonomy tt ON (t.term_id=tt.term_id) JOIN wp_term_relationships tr ON (tt.term_taxonomy_id=tr.term_taxonomy_id) JOIN wp_posts p ON (p.ID=tr.object_id) WHERE tt.taxonomy='category' AND p.post_status='publish' AND t.name='$name' ORDER BY p.post_title;");
            $linksList = array();
            while ($r = mysqli_fetch_array($links)) {
                $linksList[] = $r['post_name'];
            }
            $postName = isset($_GET['post']) ? $_GET['post'] : $linksList[0];

            $index = array_search($postName, $linksList);

            $prev = count($linksList) - 1;
            $next = 0;
            $prev = $index <= 0 ? $linksList[count($linksList) - 1] : $linksList[$index - 1];
            $next = $index >= count($linksList) - 1 ? $linksList[0] : $linksList[$index + 1];

            $result = mysqli_query($link, "SELECT p.post_content, p.post_title FROM wp_terms t JOIN wp_term_taxonomy tt ON (t.term_id=tt.term_id) JOIN wp_term_relationships tr ON (tt.term_taxonomy_id=tr.term_taxonomy_id) JOIN wp_posts p ON (p.ID=tr.object_id) WHERE tt.taxonomy='category' AND p.post_status='publish' AND t.name='$name' AND p.post_name='$postName' ORDER BY p.post_title;");

            while ($row = mysqli_fetch_array($result)) {
                echo "<h3>" . $row['post_title'] . "</h3>";
                echo "<p>" . $row['post_content'] . "</p>";
            }
            ?>
            <div class="pagination">
                <a class="btn btn-dark mr-3" href="/math.php?cat=<?php echo $name ?>&post=<?php echo $prev; ?>">Назад</a>
                <a class="btn btn-dark"
                   href="/math.php?cat=<?php echo $name ?>&post=<?php echo $next; ?>">Далее</a>
            </div>
        </div>
        <div class="col-4">
            <table class="table">
                <tbody>
                <?php
                $category = mysqli_query($link, 'SELECT t.name FROM wp_terms t JOIN wp_term_taxonomy tt ON (t.term_id=tt.term_id) JOIN wp_term_relationships tr ON (tt.term_taxonomy_id=tr.term_taxonomy_id) JOIN wp_posts p ON (p.ID=tr.object_id) WHERE tt.taxonomy=\'category\' AND p.post_status=\'publish\' GROUP BY t.name ORDER BY t.name;');

                while ($row = mysqli_fetch_array($category)) {
                    echo "<tr><td><a class='links " . ($name == $row['name'] ? 'active' : '') . "' href='/math.php?cat=" . $row['name'] . "'>" . $row['name'] . "</a></td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="page-footer font-small teal pt-4">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2019 Copyright:
        <a href="index.html">Прочухан Д.В</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
</body>
</html>