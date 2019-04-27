<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Моделирование</title>
</head>
<body id="body">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <?php
            if (isset($_POST['name_node'])) {
                $array = $_POST['name_node'];
                foreach ($array as $value){
                    $new['nodes'][]['name'] = $value;
                }
                $array_json = json_encode($new);
                $js_write = fopen('1.json', 'w');
                $js_write_2 = fwrite($js_write,$array_json);

                ?>
            <?php } ?>
            <form action="" method="post">
                <div class="alert alert-success" role="alert">
                    <strong>Инструкция!</strong><br>
                    1) Введите имена узлов требующие соединения;<br>
                    2) Введите задержку в канале;<br>
                    3) Нажмите кнопку "Подтвердить";<br>
                    4) Если грань не добавилась нажмите F5;
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" id="text_label">Укажите исходный узел</label>
                    <input type="text"  class="form-control" name="src[]" id="" placeholder="Например: name0" required>
                </div>
                <div class="form-group">
                    <label for="Example" id="text_label">Укажите конечный узел</label>
                    <input type="text" class="form-control" name="dest[]" id="" placeholder="Например: name1" required>
                </div>
                <div class="form-group">
                    <label for="Example" id="text_label">Задержка(от A до B)</label>
                    <input type="text"  class="form-control" name="delay[]" id="" placeholder="Например: 0,037" required>
                </div>
                <button type="submit" class="btn btn-success" name="OK">Подтвердить</button>
            </form>
            <br>
            <form action="script_clear_file.php" method="post">
                <div id="my-alert" class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Внимание!</strong><br>
                    Если требуется полностью обновить данные нажмите желтую кнопку!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning" name="clear_file" >Очитстить файл</button>
                </div>
            </form>
            <?php
            if (isset($_POST['src'])){
                if (isset($_POST['dest'])){
                    $js_read = file_get_contents('2.json', true);
                    $array = $_POST['src'];
                    $array2  = $_POST['dest'];
                    $array_delay = $_POST['delay'];
                    if (json_decode($js_read,true) == NULL){
                        $js_write = fopen('2.json', 'w');
                        $new['edges'][] = array('src' => $array[0],'dest'=>$array2[0],'delay'=>$array_delay[0]);
                        $array_json = json_encode($new);
                        $js_write_2 = fwrite($js_write,$array_json);
                    }else{
                        $js_decode = json_decode($js_read,true);
                        $json['edges'][] = array('src' => $array[0],'dest'=>$array2[0],'delay'=>$array_delay[0]);
                        $res_array = array_merge_recursive($js_decode, $json);
                        file_put_contents('2.json', json_encode($res_array));
                        unset($js_decode);
                         }
                }
          }?>
        </div>
        <div class="col-lg-6"><canvas id="viewport" width="800" height="500"></canvas></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-6">
                    <form action="test2.php" method="post">
                        <div class="form-group">
                            <label for="Example" id="text_label">Источник прерывания</label>
                            <input type="text"  class="form-control" name="input" id="" placeholder="name0" required>
                            <label for="Example" id="text_label">Обработчик прерывания</label>
                            <input type="text"  class="form-control" name="output" id="" placeholder="name1" required>
                        </div>
                        <button type="submit" class="btn btn-success" name="answer" >Произвести расчеты</button>
                    </form>
                </div>
            </div>
        </div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="lib/arbor.js"></script>
<script src="lib/arbor-tween.js"></script>
<script src="main.js"></script>

<script>
    $(function(){
        window.setTimeout(function(){
            $('#my-alert').alert('close');
        },5000);
    });
</script>
</body>
</html>