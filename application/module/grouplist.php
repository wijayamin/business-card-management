<?php
$app->get('/grouplist', function () use ($use) {
    $use->template->prepare('grouplist.html');
    $use->template->param("users", $use->users);
    $data_group = (object) ["result"=>[]];
    $use->app->applyHook('grouplist', $data_group);
    $use->template->param("grouplist", $data_group->result);
    $use->template->execute();
})->name("grouplist");

$app->hook('grouplist', function ($param) use ($use){
    $select = $use->db->query("select * from groups");
    $result=array();
    foreach($select as $row){
        $inner_result=array();
        $inner_result["data"]=$row;
        $inner_result["count_users"]=$use->db->query("select count(user_id) from users_groups where group_id='".$row["group_id"]."'")->fetchColumn();
        $inner_result["count_cards"]=$use->db->query("select count(card_id) from cards_groups where group_id='".$row["group_id"]."'")->fetchColumn();
        array_push($result, $inner_result);
    }
    $param->result=$result;
});
?>
