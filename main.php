<?php include "BS.php" ?>
<!doctype html>
<html lang="en">
<head>

    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
</head>
<body>

    <canvas id="viewport" width=1050" height="600"></canvas>
    <div class="container-fuild">
        <div class="row">
            <div class="col-md-3" id="data">
                <h3>Поле для ввода данных:</h3>
                <form method="post">
                    <div class="form-group">
                        <label for="" id="Number">Введите требуемое колличество узлов:</label>
                        <input type="text"  name="number_node" class="form-control" id="Number_Node"  placeholder="Колличество узлов">
                    </div>
                    <div class="form-group">
                        <label for="" id="Name">Введите название узлов</label>
                        <input type="text" name="name_node" class="form-control" id="Name_Node"  placeholder="Название узлов">
                    </div>
                    <div class="form-group">
                        <label for="" id="dalay_l">Укажите задержку в канале</label>
                        <input type="text" name="delay_link" class="form-control" id="delay_link"  placeholder="Задержка в канале">
                    </div>
                    <div class="form-group">
                        <label for="" id="delay_n">Укажите задержку в узле</label>
                        <input type="text"  name="delay_node" class="form-control" id="delay_node"  placeholder="Задержка в узле">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="Rez">Расчет</button>
                    </div>
                </form>
            </div>
            <?php if (isset($_POST['Rez'])){ ?>
            <div class="col-md-7" id="data">
                <?php
                $number_node = $_POST['number_node'];
                $name_node = $_POST['name_node'];
                $delay_node = $_POST['delay_node'];
                $delay_link = $_POST['delay_link'];

                ?>
            </div>
            <?php } ?>

        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script src="lib/arbor.js"></script>
    <script src="lib/arbor-tween.js"></script>
    <script src="main.js"></script>


</body>
</html>