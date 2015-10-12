<?php
$user_detail = function ($user_id) use ($db){
    $select = $db->prepare("select * from users where user_id=:user_id");
    $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $select->execute();
    return $select->fetch(PDO::FETCH_ASSOC);
};
    
$groups_detail = function ($user_id) use ($db){
    $select = $db->prepare("select g.group_name, g.group_id from groups g, users_groups ug where g.group_id=ug.group_id and ug.user_id=:user_id");
    $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $select->execute();
    return $select->fetchAll(PDO::FETCH_ASSOC);
};
?>