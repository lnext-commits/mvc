<?php if ($_SESSION['alertPass']['eror']== 1) :?>
		<div class="alert alert-success" role="alert" style="text-align: center;">
		  <?php echo $_SESSION['alertPass']['message'];?>
		</div>
<?php elseif ($_SESSION['alertPass']['eror']== 2) : ?>
		<div class="alert alert-warning" role="alert" style="text-align: center;">
		  <?php echo $_SESSION['alertPass']['message'];?>
		</div>
<?php elseif ($_SESSION['alertPass']['eror']== 3) : ?>
		<div class="alert alert-danger" role="alert" style="text-align: center;">
		  <?php echo $_SESSION['alertPass']['message'];?>
		</div>
<?php  endif; ?>
<?php 
	unset ($_SESSION['alertPass']['eror']); 
	unset ($_SESSION['alertPass']['message']); 
?>
<div class="container">
	<form method="post">
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" <?php echo $editActive?"":"readonly"; ?> class="form-control" name="email" value="<?php echo $data['email']?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Фамилия</label>
    <div class="col-sm-10">
      <input type="text" <?php echo $editActive?"":"readonly"; ?> class="form-control" name="first_name" value="<?php echo $data['first_name']?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Имя</label>
    <div class="col-sm-10">
      <input type="text" <?php echo $editActive?"":"readonly"; ?> class="form-control" name="last_name" value="<?php echo $data['last_name']?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Дата рождения</label>
    <div class="col-sm-10">
      <input type="date" <?php echo $editActive?"":"readonly"; ?> class="form-control" name="birthday" value="<?php echo $data['birthday']?>">
    </div>
  </div>
  
  <?php if ($editActive):?>
  	<input type="hidden" name="saveProf" value="1"/>
  	<button type="submit" class="btn btn-success btn-lg btn-block">Сохранить</button>
  <?php else:?>
  	<input type="hidden" name="editProf" value="1"/>
 	<button type="submit" class="btn btn-primary btn-lg btn-block">Редактировасть</button>
 	<a class="btn btn-danger btn-lg btn-block" href="/user//pass" role="button">изменить пароль</a>
 <?php endif;?>
</form>
</div>