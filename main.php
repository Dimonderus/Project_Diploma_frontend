<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Введите колличество узлов</label>
                        <input type="text" name="number_node" class="form-control" id="number_node" placeholder="Колличество узлов" required>
                    </div>
                    <button type="submit" class="btn btn-success" name="OK">Подтвердить</button>
                </form>
                <br>
                <form action="" method="post">
                    <?php
                    if (isset($_POST['OK'])){
                        $number_node = $_POST['number_node'];
                        $name_node = "name";
                        for ($i = 0; $i<$number_node;$i++){?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название <?php echo $i; ?> узла</label>
                            <input type="text" name="name_node[]" class="form-control input-sm" value="<?php echo $name_node.$i?>" required>
                        </div>
                    <?php } ?>
                        <button type="submit" class="btn btn-success">Подтвердить</button>
                    <?php } ?>
                </form>
                <?php

                if (isset($_POST['name_node'])) {
                    $array["names"] = $_POST['name_node'];
                    print_r($array);
                    $array_json = json_encode($array);
                    $js_write = fopen('1.json', 'w');
                    $js_write_2 = fwrite($js_write,$array_json);
                } else {
                    print 'пусто';
                }
                ?>
            </div>
            <div class="col-md-5">
                <div class="form-group">

                </div>
        </div>
    </div>
</body>
</html>