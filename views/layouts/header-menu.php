<!doctype html>
<html>
<head>
<title>Всегда нужно прописывать</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to=fit=no">
<meta charset="utf-8">
<link href="/template/css/style.css" rel="stylesheet">
<link href="/template/css/bootstrap.min.css" rel="stylesheet">
<script src="/template/js/jquery.min.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/script.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
</head>
<body>
 <nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="#">BARVIHA-2018</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/rent/page-1">Аренда</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="news.html">Новости</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="advertisement.html">Объявления</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#">О нас</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/contact/">Контакты</a>
      </li>
    </ul>
      <?php if(User::isGuest()):?>
      <div class="dropdown" style="padding-right:30px;">
        <a href="/user/cabinet" class="btn btn-outline-success my-2 my-sm-0 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">Пользователь</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/cabinet/">Личный кабинет</a>
          <a class="dropdown-item" href="#">Сообщения</a>
          <a class="dropdown-item" href="/user/logout/">Выйти</a>
        </div>
      </div>
      <?php else:?>
      <a href="/user/login" class="btn btn-outline-success my-2 my-sm-0 slide-toggle" role="button">Авторизация</a>
      <?php endif;?>
  </div>
</nav>