<div class="container">
	<h2><?php echo $data['title']?></h2>
	<img src="/public/user_img/<?php echo $data['image']?>" />
	
	<p><?php echo $data['content']?></p>
	<h6>автор: <?php echo $data['f']. " " . $data['name']; ?></h6>
</div>

 <?php if ($editMenu==1) : ?> 
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">УДАЛЕНИЕ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Удалить посто: " <?php echo $data['title']?> "
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary" onclick='window.location.href="/posts/<?php echo $data['id'];?>/delete"'>Удалить</button>
      </div>
    </div>
  </div>
</div>
 <?php endif ?>