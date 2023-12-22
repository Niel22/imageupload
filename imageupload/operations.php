<?php
function inputFields($placeholder, $name, $value, $type){
    $ele = "
    <div class='form-group my-4'>
        <input type='$type' name='$name' placeholder='$placeholder' value='$value' class='form-control' autocomplete='off'>
    </div>
    ";
    echo $ele;
}
?>