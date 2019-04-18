<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
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
                <div class="form-group">
                    <label for="exampleInputPassword1">Источнки:</label>
                <input type="text" name="src[]" id="" placeholder="Укажите узел">
                </div>
                <div class="form-group">
                    <label for="Example">Конечный:</label>
                    <input type="text" name="dest[]" id="" placeholder="Укажите узел">
                </div>
                <div class="form-group">
                    <label for="Example">Задержка:</label>
                    <input type="text" name="delay[]" id="" placeholder="Укажите задержку">
                </div>
                <button type="submit" class="btn btn-success" name="OK">Подтвердить</button>
            </form>
            <?php
            if (isset($_POST['src'])){
                if (isset($_POST['dest'])){
                    $js_read = file_get_contents('2.json', true);
                    $array = $_POST['src'];
                    $array2  = $_POST['dest'];
                    $array_delay = $_POST['delay'];
                    if (json_decode($js_read,true) == NULL){
                        $js_write = fopen('2.json', 'a');
                        $new['edges'][] = array('src' => $array[0],'dest'=>$array2[0],'delay'=>$array_delay[0]);
                        $array_json = json_encode($new);
                        $js_write_2 = fwrite($js_write,$array_json);
                    }else{
                        $js_decode = json_decode($js_read,true);
                        $js = fopen('2.json', 'a');
                        $new_1 = array('src' => $array[0],'dest'=>$array2[0],'delay'=>$array_delay[0]);
                        $array_push = array_push($js_decode,$new_1);
                        
                    }
                }
            }
            ?>
        </div>
        <div class="col-lg-6"><canvas id="viewport" width=600" height="500"></canvas></div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="lib/arbor.js"></script>
<script src="lib/arbor-tween.js"></script>
<script src="main.js"></script>
</body>
</html>