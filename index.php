<?php include "link.php";?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Document</title>
</head>
<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <form action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Источник</label>
                <input type="text" name="src[]" class="form-control" id="number_node" placeholder="Узел начала" required>
            </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Обработчик</label>
                    <input type="text" name="dest[]" class="form-control" id="number_node" placeholder="Узел конца" required>
                </div>
            <button type="submit" class="btn btn-success" name="OK">Подтвердить</button>
            </form>
        </div>
        <div class="col-lg-5">
            <?php
            $src = $_POST['src'];
            $dest = $_POST['dest'];
            if ($scr == $dest){?>
                <div class="alert alert-danger" role="alert">
                    <strong>Внимание!</strong> Источником и обработчиком не может быть один узел!
                </div>
            <?php } else {
//                $array['src'] = $src;
//                $array_dest['dest'] = $dest;
//                $i=0;
//                foreach ($arr as $k)
//                $array = array_slice($array_dest,$i,true);
//                print_r($array);
//                print_r(json_encode($array));
//                $js_write = fopen('1.json', 'a');
//                $js_write_2 = fwrite($js_write,$array_json);?>
            <?php } ?>
            <canvas id="viewport" width=600" height="500">
        </div>
    </div>
</div>



</body>
</html>