<?php
function error_handler($no, $msg, $file, $line){
  switch($no):
    case E_USER_NOTICE:
    case E_USER_WARNING:
      echo $msg; break;
    case E_USER_ERROR:
      echo $msg;
      exit;
    default: echo $msg, $file, $line;
  endswitch;
}
function clear_number($data){
  return (int) $data;
}
function clear_id($data){
  return abs(clear_number($data));
}
function clear_text($data){
  return trim(strip_tags($data));
}
function quote_text($data){
  global $db_conn;
  return $db_conn->quote(clear_text($data));
}
function form_handling($form){
  $data = [];
  $data['title'] = quote_text($form['title']);
  $data['msg'] = quote_text($form['msg']);
  $data['id'] = clear_id($form['id']);
  return $data;
}

function create_data($params){
  global $db_conn;
  $sql = "CALL spCreateData({$params['title']}, {$params['msg']})";
  //echo $sql;
  try{
    return (bool) $db_conn->exec($sql);
  }catch(PDOException $e){
    trigger_error('Не удалось создать запись', E_USER_WARINIG);
  }  
}

function update_data($params){
  global $db_conn;
  $sql = "CALL spUpdateData({$params['id']}, {$params['title']}, {$params['msg']})";
  try{
    return (bool) $db_conn->exec($sql);
  }catch(PDOException $e){
    trigger_error('Не удалось изменить запись', E_USER_WARINIG);
  }  
}

function delete_data($params){}

function read_data(){
  global $db_conn;
  $sql = "CALL spReadData()";
  $result = null;
  try{
    $result = $db_conn->query($sql, PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    trigger_error('Не удалось прочитать записи', E_USER_ERROR);
  }
  $data = [];
  foreach($result as $row){
    $data[] = build_data($row);
  }
  return $data;
}
function build_data($params){
  $tpl = file_get_contents(DATA_TEMPLATE);
  $tpl = str_replace('{{TITLE}}', $params['title'], $tpl);
  $tpl = str_replace('{{TEXT}}', $params['msg'], $tpl);
  $date = date('d-m-Y H:i:s', $params['created']);
  $tpl = str_replace('{{DATE_CREATED}}', $date, $tpl);
  $tpl = str_replace('{{CLASS_HIDDEN}}', '', $tpl);
  $tpl = str_replace('{{ID_EDIT}}', '/?edit='.$params['id'], $tpl);
  $tpl = str_replace('{{ID_DELETE}}', '/?remove='.$params['id'], $tpl);
  return $tpl;
}
function read_data_by_id($id){
  global $db_conn;
  $sql = "CALL spReadDataById($id)";
  $result = null;
  $data = [];
  try{
    $result = ($db_conn->query($sql))->fetch(PDO::FETCH_ASSOC);
    foreach($result as $key=>$val):
      $data[$key] = $val;
    endforeach;
  }catch(PDOException $e){
    trigger_error('Не удалось прочитать запись', E_USER_WARNING);
  }
  return $result;
}