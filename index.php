<?php
  $id = '';
  require_once 'core/lib.php';
  require_once 'config.php';

  if(isset($_GET['create'])) require_once 'core/create.php';
  if(isset($_GET['edit']) or isset($_GET['update'])) require_once 'core/update.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Блог: обо всём понемногу</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <main>
    <header>
      <h1>Мой блог</h1>
      <p>новости обо всём понемногу</p>
    </header>
    <nav>
      <a href='?admin' id='login'>Добавить</a>
    </nav>
    <?php
      if(isset($_GET['admin']) or $id) require_once 'core/admin.php';
      else require_once 'core/read.php';
    ?>
    <!-- Список новостей -->
    <footer>
      <h3>Все права защищены &copy; Я 2015-<?= date('Y')?></h3>
      <p>Всё крутится под PHP сервером на PHP-<?=PHP_VERSION?></p>
    </footer>
  </main>
</body>
</html>