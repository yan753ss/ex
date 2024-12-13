<?php
$action = '#';
$h2 = 'Добавить|Изменить';
if(isset($_GET['admin'])):
  $action = '/?create';
  $h2 = 'Добавить';
elseif(isset($_GET['edit'])):
  $action = '/?update';
  $h2 = 'Изменить';
endif;
?>
<section>
  <h2><?=$h2?></h2>
  <form action='<?=$action?>' method='post'>
    <input type='hidden' name='id' value='<?=$id?>'>
    <div>
      <input name='title' type='text' size='50' placeholder='Заголовок'  value='<?=$title?>'>
    </div>
    <div>
      <textarea name='msg' rows='10' placeholder='Ваш текст'><?=$msg?></textarea>
    </div>
    <div>
      <input type='submit' value='Отправить' />
    </div>
  </form>
</section>