<?php
function Privilege($privilege){
    $visible["is_read"]=($privilege=="read"? true : false);
    $visible["is_write"]=($privilege=="write"? true : false);
    $visible["is_admin"]=($privilege=="admin"? true : false);
    $visible["is_superuser"]=($privilege=="superuser"? true : false);
    return $visible;
}
?>