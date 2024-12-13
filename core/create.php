<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'):
    $data = form_handling($_POST);
    //print_r($_POST);
    if(create_data($data)):
        header('Location: /');
        exit;
    endif;
endif;