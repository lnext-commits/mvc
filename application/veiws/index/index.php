<?php  foreach ($dataPost as $id => $r): ?>
<div class="card" style="width: 18rem; margin: 25px; float: left;">
  <img src="/public/user_img/<?=$r['image']?>" class="card-img-top" alt="<?=$r['image']?>">
  <div class="card-body">
    <h5 class="card-title"><?=$r['title']?></h5>
    <p class="card-text"><?php echo substr ($r['content'],0,82)?></p>
    <a href="/posts/<?=$id?>" class="btn btn-primary">Детальнее</a>
     <small  class="form-text text-muted"><?=$r['f']?> <?=$r['name']?></small>
  </div>
</div>
<?php endforeach ?>