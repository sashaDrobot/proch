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
$link = mysqli_connect('localhost', 'root', 'root', 'math');
if (mysqli_connect_errno()) {
    printf("Невозможно подключиться к базе данных");
    exit;
}
mysqli_set_charset($link, "utf8");
?>
<div class="container">
    <div class="jumbotron p-3 p-md-5 text-white rounded bg-schedule">
        <div class="col-md-6 px-0">
            <h2>Каталог примеров</h2>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Каталог примеров</h2
            <ul>
                <?php
                $category = mysqli_query($link, 'SELECT t.name FROM wp_terms t JOIN wp_term_taxonomy tt ON (t.term_id=tt.term_id) JOIN wp_term_relationships tr ON (tt.term_taxonomy_id=tr.term_taxonomy_id) JOIN wp_posts p ON (p.ID=tr.object_id) WHERE tt.taxonomy=\'category\' AND p.post_status=\'publish\' GROUP BY t.name ORDER BY t.name;');

                while ($row = mysqli_fetch_array($category))
                {
                    $first = mysqli_query($link, "SELECT p.post_content, p.post_title, p.post_name FROM wp_terms t JOIN wp_term_taxonomy tt ON (t.term_id=tt.term_id) JOIN wp_term_relationships tr ON (tt.term_taxonomy_id=tr.term_taxonomy_id) JOIN wp_posts p ON (p.ID=tr.object_id) WHERE tt.taxonomy='category' AND p.post_status='publish' AND t.name='" . $row['name'] . "' ORDER BY p.post_title;");
                    $firstItem = mysqli_fetch_array($first);

                    echo "<li><strong>Категория:</strong> <a title='" . $row['name'] . "' href='/math.php?cat=" . $row['name'] . "&post=" . $firstItem['post_name'] . "'>" . $row['name'] . "</a>";
                    echo "<ul>";

                    $result = mysqli_query($link, "SELECT p.post_content, p.post_title, p.post_name FROM wp_terms t JOIN wp_term_taxonomy tt ON (t.term_id=tt.term_id) JOIN wp_term_relationships tr ON (tt.term_taxonomy_id=tr.term_taxonomy_id) JOIN wp_posts p ON (p.ID=tr.object_id) WHERE tt.taxonomy='category' AND p.post_status='publish' AND t.name='" . $row['name'] . "' ORDER BY p.post_title;");

                    while ($item = mysqli_fetch_array($result))
                    {
                        echo "<li><a title='" . $item['post_title'] . "' href='/math.php?cat=" . $row['name'] . "&post=" . $item['post_name'] . "'>" . $item['post_title'] . "</a></li>";
                    }
                    echo "</ul>";
                    echo "</li>";
                }
                ?>
            </ul>
            <p style="text-align: justify;">Каждый год выпускники стараются успешно завершить обучение и успешно сдать
                вступительные экзамены, чтобы поступить в высшие учебные заведения и стать студентами.</p>
            <p style="text-align: justify;" mce_style="text-align: justify;">Многие ищут решение задач по математике,
                чтобы к этому подготовиться. </p>
            <p style="text-align: justify;">В данный момент аттестация проводится в форме внешнего независимого
                оценивания (ЗНО). Результат тестов по математике засчитывается как балл государственной итоговой
                аттестации (ДПА) . Выпускникам, которые прошли ЕГЭ по математике, алгебре, геометрии выдается сертификат
                с его результатами, в соответствии с которым вносится соответствующая запись в дополнение к аттестату.
                Чтобы набрать необходимое количество баллов недостаточно формально овладеть школьным материалом –
                необходимы углубленные знания, практика в решении задач, умение правильно и четко изложить на бумаге
                решение задачи, сопровождая его необходимыми схемами, рисунками, формулами.</p>

            <p style="text-align: justify;" mce_style="text-align: justify;">Этот сайт с решениями задач по математике
                поможет в комплексной подготовке абитуриента к независимому внешнему тестированию по математике. Он
                решит с вами задачи, которые в разное время предлагались для решения школьникам и абитуриентам при
                поступлении в высшие учебные заведения.
            </p>
            <p style="text-align: justify;">Разбор задач , уроки позволят вам успешно сдать непростые экзамены и легко
                овладеть такими науками, как алгебра и геометрия. Вы научитесь выполнять алгебраические преобразования,
                сможете упростить любое выражение, изучите алгебраические формулы. Вы успешно освоите решение уравнений,
                систем уравнений, неравенств, систем неравенств (квадратные, иррациональные, показательные,
                логарифмические, тригонометрические).</p>
            <p style="text-align: justify;">Сложности в решение задач на составление уравнений? На сайте приведены
                решения задач с полным описанием. Геометрия дается сложнее, чем алгебра? На сайте приведены решения
                задач из разделов планиметрия и стереометрия, разобраны примеры решения на нахождение неизвестных
                геометрических элементов, площадей фигур, методики доказательств утверждений.</p>
            <p style="text-align: justify;">Сайт- хороший помощник при подготовке домашних заданий и подготовке к
                тестам</p>
            <p style="text-align: justify;">Сайт нужен для получения и лучшего усвоения большего количества информации,
                более глубоких знаний, а также приобретения навыков по реализации полученных знаний на практике.
                Специалиста можно найти, обратившись в специальные агентства, поместив объявление в средствах массовой
                информации. Однако , попав на этот сайт, вы уже нашли то, что искали. У автора - большой опыт подготовки
                к ЗНО по математике, ДПА по математике, ЗНО по физике, ДПА по физике. Вы можете посмотреть отзывы на
                соответствующей странице. Все мои ученики успешно сдавали ЗНО с результатом от 180 баллов, а результат
                ДПА всегда был не ниже 9. Поэтому вы можете быть уверены в результативности занятий.</p>
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