<?php

//ini_set("display_errors", 1);
//error_reporting(-1);
require_once 'config.php';
require_once 'functions.php';


//Список групп
$groups = get_groups();

//Список преподавателей
$teachers = get_techers();

$replacemants = get_repl();
//print_arr($replacemants);


//Пары у группы + аудитории + преподааватели
if(isset($_GET['group'])) {
  $group_id = (int)$_GET['group'];
  $group_data = get_group_data($group_id);
  $group_aud = get_group_auditory($group_id);
  $group_teach = get_group_teach($group_id);
  $group_name = get_group_name($group_id);
  print_arr($group_name);
}

//Пары у преподавателя
if(isset($_GET['teach'])) {
  $teach_id = (int)$_GET['teach'];
  $teach_data = get_teach_data($teach_id);
  $teach_group = get_teach_group($teach_id);
  $teach_name = get_teach_name($teach_id);
  print_arr($teach_name);
}

$time = array('8:30 - 9:50', '10:00 - 11:20', '11:50 - 13:10', '13:20 - 14:40', '14:15 - 15:35');



?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Расписание</title>
  <!-- <link rel="stylesheet" href="style.css"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
  <style>
    * {
          margin: 0;
          padding: 0;
        }

        ul.nav li a, ul.nav li a:visited {
          color: gray !important;
        }

        ul.nav li a:hover, ul.nav li a:active {
          color: darkgray !important;
        }

        ul.nav li.active a {
          color: gray !important;
        }
        /* .hidden {
          display: none;
        } */
        .card {
          display: block;
          width: 30%;
          border-radius: 5px;
          box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
          padding: 15px;
          margin-block-end: 2.33em;
          margin-inline-start: 0px;
          margin-inline-end: 0px;
        }

        .card__title {
          border-bottom: 1px solid #dee2e6 !important;
          padding-bottom: .5rem !important;
        }

        .title {
          font-size: 1rem;
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
          color: #6c757d !important;
          padding-top: 1rem !important;
          display: flex;
          align-self: flex-start;
          text-decoration: none;
          font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
        }

        .cards {
          padding-right: 15px;
          padding-left: 15px;
          margin-right: auto;
          margin-left: auto;
        }
    </style>
</head>

<body>
  <div class="wrapper">

    <!--Navbar-->
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
                <a class="dropdown-item btn" href="?group=<?=$group['id_g']?>">
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
                <a class="dropdown-item btn" href="?teach=<?=$teach['id_t']?>">
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

    <!--Cards-->
    <div class="container">
    <?php if( $group_name ): ?>
    <div class="card__title"><h6 class="title"><?php $group_name; ?></h6></div>
      <?php else: ?>
    <?php if( $teach_name ): ?>
    <div class="card__title"><h6 class="title"><?php $teach_name; ?></h6></div>
    <?php endif; ?>
      <?php endif; ?>
      <div class="row">
        <div class="col">
          <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">Понедельник</h6>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Понедельник][1]?>"
                  data-content="<?=$time[0]?>" data-placement="top"><strong class="d-block text-grey-dark">
                    <?=$group_data['Понедельник'][1]?></strong></a>
                <?=$group_aud['Понедельник'][1]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Понедельник'][1]?></strong>
                <?=$teach_group['Понедельник'][1]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Понедельник][2]?>"
                  data-content="<?=$time[1]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Понедельник'][2]?></strong></a>
                <?=$group_aud['Понедельник'][2]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Понедельник'][2]?></strong>
                <?=$teach_group['Понедельник'][2]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Понедельник][3]?>"
                  data-content="<?=$time[2]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Понедельник'][3]?></strong></a>
                <?=$group_aud['Понедельник'][3]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Понедельник'][3]?></strong>
                <?=$teach_group['Понедельник'][3]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" class="text-secondary" data-trigger="focus" title="<?=$group_teach[Понедельник][4]?>"
                  data-content="<?=$time[3]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Понедельник'][4]?></strong></a>
                <?=$group_aud['Понедельник'][4]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Понедельник'][4]?></strong>
                <?=$teach_group['Понедельник'][4]?>
                <?php endif ?>
              </p>
            </div>
          </div>
        </div>
        <!--Col-->
        <div class="col">
          <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">Вторник</h6>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Вторник][1]?>"
                  data-content="<?=$time[1]?>" data-placement="top"><strong class="d-block text-grey-dark">
                    <?=$group_data['Вторник'][1]?></strong></a>
                <?=$group_aud['Вторник'][1]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Вторник'][1]?></strong>
                <?=$teach_group['Вторник'][1]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Вторник][2]?>"
                  data-content="<?=$time[1]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Вторник'][2]?></strong></a>
                <?=$group_aud['Вторник'][2]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Вторник'][2]?></strong>
                <?=$teach_group['Вторник'][2]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Вторник][3]?>"
                  data-content="<?=$time[2]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Вторник'][3]?></strong></a>
                <?=$group_aud['Вторник'][3]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Вторник'][3]?></strong>
                <?=$teach_group['Вторник'][3]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" class="text-secondary" data-trigger="focus" title="<?=$group_teach[Вторник][4]?>"
                  data-content="<?=$time[4]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Вторник'][4]?></strong></a>
                <?=$group_aud['Вторник'][4]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Вторник'][4]?></strong>
                <?=$teach_group['Вторник'][4]?>
                <?php endif ?>
              </p>
            </div>
          </div>
        </div>
        <!--Col-->
        <div class="col">
          <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">Среда</h6>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Среда][1]?>"
                  data-content="<?=$time[0]?>" data-placement="top"><strong class="d-block text-grey-dark">
                    <?=$group_data['Среда'][1]?></strong></a>
                <?=$group_aud['Среда'][1]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Среда'][1]?></strong>
                <?=$teach_group['Среда'][1]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Среда][2]?>"
                  data-content="<?=$time[1]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Среда'][2]?></strong></a>
                <?=$group_aud['Среда'][2]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Среда'][2]?></strong>
                <?=$teach_group['Среда'][2]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Среда][3]?>"
                  data-content="<?=$time[2]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Среда'][3]?></strong></a>
                <?=$group_aud['Среда'][3]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Среда'][3]?></strong>
                <?=$teach_group['Среда'][3]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" class="text-secondary" data-trigger="focus" title="<?=$group_teach[Среда][4]?>"
                  data-content="<?=$time[3]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Среда'][4]?></strong></a>
                <?=$group_aud['Среда'][4]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Среда'][4]?></strong>
                <?=$teach_group['Среда'][4]?>
                <?php endif ?>
              </p>
            </div>
          </div>
        </div>
        <!--Col-->
      </div>
      <!--Row-->
      <div class="row">
        <div class="col">
          <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">Четверг</h6>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Четверг][1]?>"
                  data-content="<?=$time[0]?>" data-placement="top"><strong class="d-block text-grey-dark">
                    <?=$group_data['Четверг'][1]?></strong></a>
                <?=$group_aud['Четверг'][1]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Четверг'][1]?></strong>
                <?=$teach_group['Четверг'][1]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Четверг][2]?>"
                  data-content="<?=$time[1]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Четверг'][2]?></strong></a>
                <?=$group_aud['Четверг'][2]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Четверг'][2]?></strong>
                <?=$teach_group['Четверг'][2]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Четверг][3]?>"
                  data-content="<?=$time[2]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Четверг'][3]?></strong></a>
                <?=$group_aud['Четверг'][3]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Четверг'][3]?></strong>
                <?=$teach_group['Четверг'][3]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" class="text-secondary" data-trigger="focus" title="<?=$group_teach[Четверг][4]?>"
                  data-content="<?=$time[4]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Четверг'][4]?></strong></a>
                <?=$group_aud['Четверг'][4]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Четверг'][4]?></strong>
                <?=$teach_group['Четверг'][4]?>
                <?php endif ?>
              </p>
            </div>
          </div>
        </div>
        <!--Col-->
        <div class="col">
          <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">Пятница</h6>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Пятница][1]?>"
                  data-content="<?=$time[0]?>" data-placement="top"><strong class="d-block text-grey-dark">
                    <?=$group_data['Пятница'][1]?></strong></a>
                <?=$group_aud['Пятница'][1]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Пятница'][1]?></strong>
                <?=$teach_group['Пятница'][1]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Пятница][2]?>"
                  data-content="<?=$time[1]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Пятница'][2]?></strong></a>
                <?=$group_aud['Пятница'][2]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Пятница'][2]?></strong>
                <?=$teach_group['Пятница'][2]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" data-trigger="focus" class="text-secondary" title="<?=$group_teach[Пятница][3]?>"
                  data-content="<?=$time[2]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Пятница'][3]?></strong></a>
                <?=$group_aud['Четверг'][3]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Пятница'][3]?></strong>
                <?=$teach_group['Пятница'][3]?>
                <?php endif ?>
              </p>
            </div>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <?php if( $group_data ): ?>
                <a href="#" data-toggle="popover" class="text-secondary" data-trigger="focus" title="<?=$group_teach[Пятница][4]?>"
                  data-content="<?=$time[3]?>" data-placement="top"><strong class="d-block text-gray-dark">
                    <?=$group_data['Пятница'][4]?></strong></a>
                <?=$group_aud['Пятница'][4]?>
                <?php endif ?>
                <?php if( $teach_data ): ?>
                <strong class="d-block text-gray-dark">
                  <?=$teach_data['Пятница'][4]?></strong>
                <?=$teach_group['Пятница'][4]?>
                <?php endif ?>
              </p>
            </div>
          </div>
        </div>
        <!--Col---->
        <div class="col"></div>
        <!--Col-->
      </div>
      <!--Row-->
    </div>
    <!--Container-->
  </div>
  <!--Wrapper-->

  <!-- <script src="main.js"></script> -->
  <script>
    $(document).ready(function () {
      $('[data-toggle="popover"]').popover();
    });
    $('.popover-dismiss').popover({
      trigger: 'focus'
    });
  </script>

</body>

</html>