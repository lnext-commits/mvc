<div class="container">
	<form action="/user//pass" method="post">
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Старый пароль</label>
    <div class="col-sm-10">
      <input type="password"  class="form-control" name="oldPass">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Новый пароль</label>
    <div class="col-sm-10">
      <input type="password"  class="form-control" name="newPass" >
    </div>
  </div>
  	<input type="hidden" name="savePass" value="1"/>
 	<button type="submit" class="btn btn-danger btn-lg btn-block">Изменить</button>
</form>
</div>