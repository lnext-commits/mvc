<div class="container">
<form action="/registration" method="post">
	<div class="form-group">
	    <label for="exampleInputEmail1">Email</label>
	    <input type="email" class="form-control" id="exampleInputEmail1"  name="email" value="<?php echo $email?$email:'' ?>" >
	    <small id="emailHelp" class="form-text text-muted"><?php echo $errorEmail?$errorEmail:"" ?></small>
	</div>
	<div class="form-group">
	    <label for="exampleInputEmail1">Пароль</label>
	    <input type="password" class="form-control" id="exampleInputEmail1"  name="pass" value="<?php echo $pass?$pass:'' ?>">
	    <small id="emailHelp" class="form-text text-muted"><?php echo $errorPass?$errorPass:""; ?></small>
	</div>
	<div class="form-group">
	    <label for="exampleInputEmail1">Фамилия</label>
	    <input type="text" class="form-control" id="exampleInputEmail1"  name="first_name" value="<?php echo $first_name?$first_name:'' ?>">
	    <small id="emailHelp" class="form-text text-muted"><?php echo $errorFirst?$errorFirst:""; ?></small>
	</div>
	<div class="form-group">
	    <label for="exampleInputEmail1">Имя</label>
	    <input type="text" class="form-control" id="exampleInputEmail1"  name="last_name" value="<?php echo $last_name?$last_name:'' ?>">
	    <small id="emailHelp" class="form-text text-muted"><?php echo $errorLast?$errorLast:""; ?></small>
	</div>
	<div class="form-group">
	    <label for="exampleInputEmail1">Дата рождения</label>
	    <input type="date" class="form-control" id="exampleInputEmail1"  name="birthday" value="<?php echo $birthday?$birthday:'' ?>">
	</div>
    <input type="hidden"  name="reg" value="1" />
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>