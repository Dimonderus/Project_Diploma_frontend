<?php

if (isset($_POST['clear_file'])){
    file_put_contents('1.json', '');
    file_put_contents('2.json', '');
    header("Location: main.php");
}

?>