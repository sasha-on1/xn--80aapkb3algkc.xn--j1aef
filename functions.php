<?php

$week_num = 2;

/**
 * Распечатка массива
 **/
function print_arr($arr){
  echo '<pre>' . print_r($arr, true) . '</pre>';
}

/**
 * Получение списка групп
 **/
function get_groups() {
  global $db;
  $query = "SELECT * FROM groups";
  $res = mysqli_query($db, $query);
  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    $data[] = $row;
  }
  return $data;
}

/**
 * Получение списка преподавателей
 **/
function get_techers() {
  global $db;
  $query = "SELECT * FROM teachers";
  $res = mysqli_query($db, $query);
  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    $data[] = $row;
  }
  return $data;
}

/**
 * Получение расписания группы 
 **/
function get_group_data($group_id) {
  if( !$group_id ) return;
  global $db;
  global $week_num;
  $query = "SELECT l.name_l, s.les_num, d.name_day FROM (schedule as s INNER JOIN lessons l ON s.lesson = l.id_l) INNER JOIN days as d ON s.les_day = d.id_day WHERE s.group = $group_id AND (s.week = $week_num OR s.week = 0)";
  $res = mysqli_query($db, $query);
  $data = null;
  while($row = mysqli_fetch_assoc($res)){
    $data[$row['name_day']][$row['les_num']] = $row['name_l'];
  }
  return $data;
}

/**
 * Получение аудиторий группы
 **/
function get_group_auditory($group_id) {
  if( !$group_id ) return;
  global $db;
  global $week_num;
  $query = "SELECT s.auditory, s.les_num, d.name_day FROM (schedule as s INNER JOIN days as d ON s.les_day = d.id_day) INNER JOIN groups as g ON s.group = g.id_g WHERE g.id_g = $group_id AND (s.week = $week_num OR s.week = 0)";
  $res = mysqli_query($db, $query);
  $data = null;
  while($row = mysqli_fetch_assoc($res)){
    $data[$row['name_day']][$row['les_num']] = $row['auditory'];
  }
  return $data;
}

/**
 * Получение преподов группы
 **/
function get_group_teach($group_id) {
  if( !$group_id ) return;
  global $db;
  global $week_num;
  $query = "SELECT t.name_t, s.les_num, d.name_day FROM ((schedule as s INNER JOIN days as d ON s.les_day = d.id_day) INNER JOIN groups as g ON s.group = g.id_g) INNER JOIN teachers as t ON s.teacher = t.id_t WHERE g.id_g = $group_id AND (s.week = $week_num OR s.week = 0)";
  $res = mysqli_query($db, $query);
  $data = null;
  while($row = mysqli_fetch_assoc($res)){
    $data[$row['name_day']][$row['les_num']] = $row['name_t'];
  }
  return $data;
}

/**
 * Получение расписания преподавателя 
 **/
function get_teach_data($teach_id) {
  if( !$teach_id ) return;
  global $db;
  global $week_num;
  $query = "SELECT s.id_s, l.name_l, t.name_t, s.auditory, s.les_num, d.name_day, g.name_g FROM (((schedule as s INNER JOIN lessons l ON s.lesson = l.id_l) INNER JOIN teachers t ON s.teacher = t.id_t) INNER JOIN days as d ON s.les_day = d.id_day) INNER JOIN groups as g ON s.group = g.id_g WHERE t.id_t = $teach_id AND (s.week = $week_num OR s.week = 0)";
  $res = mysqli_query($db, $query);
  $data = null;
  while($row = mysqli_fetch_assoc($res)){
    $data[$row['name_day']][$row['les_num']] = $row['name_l'];
  }
  return $data;
}

/**
 * Получение групп преподавателя 
 **/
function get_teach_group($teach_id) {
  if( !$teach_id ) return;
  global $db;
  global $week_num;
  $query = "SELECT s.id_s, l.name_l, t.name_t, s.auditory, s.les_num, d.name_day, g.name_g FROM (((schedule as s INNER JOIN lessons l ON s.lesson = l.id_l) INNER JOIN teachers t ON s.teacher = t.id_t) INNER JOIN days as d ON s.les_day = d.id_day) INNER JOIN groups as g ON s.group = g.id_g WHERE t.id_t = $teach_id AND (s.week = $week_num OR s.week = 0)";
  $res = mysqli_query($db, $query);
  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    $data[$row['name_day']][$row['les_num']] = $row['name_g'];
  }
  return $data;
}

// function get_repl() {
//   global $db;
//   $query = "SELECT g.name_g, r.les_num, l.name_l from (replacements as r INNER JOIN groups as g ON r.group_r = g.id_g) INNER JOIN lessons as l ON r.les_name = l.id_l;";
//   $res = mysqli_query($db, $query);
//   $data = array();
//   while($row = mysqli_fetch_assoc($res)){
//     $data[] = $row;
//   }
//   return $data;
// }

function get_repl() {
  global $db;
  $query = "SELECT g.name_g, r.les_num, l.name_l from (replacements as r INNER JOIN groups as g ON r.group_r = g.id_g) INNER JOIN lessons as l ON r.les_name = l.id_l;";
  $res = mysqli_query($db, $query);
  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    $data[] = $row;
  }
  return $data;
}

  function get_grepl() {
    global $db;
    $query = "SELECT distinct g.name_g from replacements as r INNER JOIN groups as g ON r.group_r = g.id_g;";
    $res = mysqli_query($db, $query);
    $data = array();
    while($row = mysqli_fetch_assoc($res)){
      $data[] = $row;
    }
    return $data;
  }

  function get_group_name($group_id) {
    if( !$group_id ) return;
    global $db;
    $query = "SELECT g.name_g FROM groups as g WHERE g.id_g = $group_id";
    $res = mysqli_query($db, $query);
    $data = null;
    while($row = mysqli_fetch_assoc($res)){
      $data = $row['name_g'];
    }
    return $data;
  }

  function get_teach_name($teach_id) {
    if( !$teach_id ) return;
    global $db;
    $query = "SELECT t.name_t FROM teachers as t WHERE t.id_t = $teach_id";
    $res = mysqli_query($db, $query);
    $data = null;
    while($row = mysqli_fetch_assoc($res)){
      $data = $row['name_t'];
    }
    return $data;
  }