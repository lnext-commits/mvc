<div class="container">
<form action="/login" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1"  name="email">
    <small id="emailHelp" class="form-text text-muted"><?php echo $errorPass?$errorPass:""; ?></small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1"  name="pass">
  </div>
	<input type="hidden"  name="log" value="1" />
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>