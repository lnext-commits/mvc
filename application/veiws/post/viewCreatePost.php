<div class="container">
<form  method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="exampleFormControlInput1">
			Заглавие поста
		</label>
		<input type="text" name="titlePost" class="form-control" id="exampleFormControlInput1" value="<?php echo $titlePost?$titlePost:'' ?>">
		 <small id="emailHelp" class="form-text text-muted"><?php echo $errorTitle?$errorTitle:"" ?></small>
	</div>
	<div class="form-group">
		<label for="exampleFormControlFile1">
			Изображение для поста
		</label>
		<input type="file" name="imgPost" class="form-control-file" id="exampleFormControlFile1">
		 <small id="emailHelp" class="form-text text-muted"><?php echo $errorFile?$errorFile:"" ?></small>
	</div>
	<div class="form-group">
		<label for="exampleFormControlTextarea1">
			ПОСТ
		</label>
		<textarea name="textPost" class="form-control" id="exampleFormControlTextarea1" rows="5"><?php echo $content?$content:'' ?></textarea>
		 <small id="emailHelp" class="form-text text-muted"><?php echo $errorContent?$errorContent:"" ?></small>
	</div>
	<input type="hidden" name="addpost" value="save" />
	<button type="submit" class="btn btn-primary">
		Сохранить
	</button>
</form>
</div>