<?php

require_once 'config.php';
require_once 'functions.php';

//Список групп
$groups = get_groups();

//Список преподавателей
$teachers = get_techers();

?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Расписание</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</head>

<body>
  <style>
    .card {
      display: block;
      width: 100%;
      border-radius: 5px;
      box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
      padding: 15px;
      margin-block-end: 2.33em;
      margin-inline-start: 0px;
      margin-inline-end: 0px;
      margin-top: 20px;
    }

    .card__title {
      padding-bottom: .5rem !important;
      padding-top: .5rem !important;
    }

    .title {
      font-size: 1.4rem;
      display: block;
      margin: 0;
      margin-top: 10px;
      font-weight: 500;
      line-height: 1.2;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    .card__content {
      border-bottom: 1px solid #dee2e6 !important;
    }

    .content {
      font-size: 1.3rem;
      font-weight: 500;
      color: #6c757d !important;
      padding-top: 0.7rem !important;
      padding-bottom: 0.7rem !important;
      display: flex;
      align-self: flex-start;
      text-decoration: none;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
    }  
  </style>
  <div class="wrapper">
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand">Расписание</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Группы
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item btn" href="index.php">Все группы</a>
                <?php if( $groups ): ?>
                <?php foreach ($groups as $group): ?>
                <a class="dropdown-item btn" href="start.php?group=<?=$group['id_g']?>">
                  <?=$group['name_g']?></a>
                <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Преподаватели
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item btn" href="all_teachers.php">Все преподаватели</a>
                <?php if( $teachers ): ?>
                <?php foreach ($teachers as $teach): ?>
                <a class="dropdown-item btn" href="start.php?teach=<?=$teach['id_t']?>">
                  <?=$teach['name_t']?></a>
                <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="replacements.php">Замены</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="groups">
      <div class="container">
        <div class="card__title"><h6 class="title">Все преподаватели</h6></div>
        <div class="card">  
          <?php if( $teachers ): ?>
          <?php foreach ($teachers as $teach): ?>
          <div class="card__content"><a class="content" href="start.php?teach=<?=$teach['id_t']?>"><?=$teach['name_t']?></a></div>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div> <!-- Wrapper -->
</body>

</html>