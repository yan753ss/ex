<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'):
    $data = form_handling($_POST);
    if($data['id']):
        update_data($data);
        header('Location: /');
        exit;
    endif;
else:
    $id = clear_id($_GET['edit']);
    if(!$id) return;
    $data = read_data_by_id($id);
    $title = $data['title'];
    $msg = $data['msg'];
endif;