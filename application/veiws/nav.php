<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/">BlogS</a>
 <?php if ($userId>0) : ?> 
  <div class="collapse navbar-collapse" id="navbarNav">
   <ul class="navbar-nav">
      <li class="nav-item <?php echo $activeMyPost?>">
        <a class="nav-link " href="/posts//mypost">Мои посты</a>
      </li>
       <li class="nav-item <?php echo $activeAdd?>">
        <a class="nav-link" href="/posts//create">Создать</a>
      </li>
    <?php if ($editMenu==1) : ?>    
      <li class="nav-item <?php echo $activeEdit?>">
        <a class="nav-link" href="/posts/<?php echo $data['id'];?>/edit">Редактировать</a>
      </li>
      <li class="nav-item <?php echo $activeDel?>">
        <a class="nav-link" href="" data-toggle="modal" data-target="#exampleModal">Удалить</a>
      </li>
     <?php endif ?>
      <li class="nav-item <?php echo $activeProf?>">
        <a class="nav-link" href="/user">Профиль</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="/logout">Выход</a>
      </li>
    </ul>
  </div>
 <?php else: ?>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item <?php echo $activeLogint?>">
        <a class="nav-link" href="/login">Вход</a>
      </li>
      <li class="nav-item <?php echo $activeRegi?>">
        <a class="nav-link" href="/login//register">Регистрация</a>
      </li>
    </ul>
  </div>
 <?php endif ?>
</nav>
<hr>