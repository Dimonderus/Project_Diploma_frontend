<?php include "BS.php" ?>
<!doctype html>
<html lang="en">
<head>

    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <label for=""></label>
    <title>Document</title>
</head>
<body>
    <div class="container-fuild">
        <div class="row">
            <div class="col-md-4" id="data">
                <h3 style="font-weight: bold;text-align: center">Поле для ввода данных</h3>
                <form method="post">
                    <div class="form-group">
                        <label for="" id="Help">Введите требуемое колличество узлов:</label>
                        <input type="text"  name="number_node" class="form-control" id="Number_Node"  placeholder="Колличество узлов">
                    </div>
                    <div class="form-group">
                        <label for="" id="Help">Укажите задержку в канале</label>
                        <input type="text" name="delay_link" class="form-control" id="delay_link"  placeholder="Задержка в канале">
                    </div>
                    <div class="form-group">
                        <label for="" id="Help">Укажите задержку в узле</label>
                        <input type="text"  name="delay_node" class="form-control" id="delay_node"  placeholder="Задержка в узле">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success" name="Rez">Ввести дополнительные данные</button>
                    </div>
                </form>
                <?php if (isset($_POST['Rez'])){ ?>
                        <form action="main_2.php" method="post">
                            <?php
                            $number_node = $_POST['number_node'];
                            $delay_node = $_POST['delay_node'];
                            $delay_link = $_POST['delay_link'];
                            $name_node = "node";
                            ?>
                            <h3 style="font-weight: bold;text-align: center">Дополнительные данные</h3>
                            <?php for ($i = 0; $i < $number_node; $i++){ ?>
                                <div class="form-group row">

                                    <div class="col-md-4" style="text-align: center">
                                        <label for="" id="Help">Название узла <?php echo $i;?></label>
                                        <input type="text" name="name_node[]" class="form-control" id="Name_Node"  value="<?php echo $name_node.$i?>">
                                    </div>

                                    <div class="col-md-8">

                                    </div>
                                </div>

                            <?php } ?>

                            <button type="submit">Отправить</button>
                        </form>
                <?php } ?>

            </div>

            <div class="col-md-6">
                <canvas id="viewport" width=800" height="600">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
                <script src="lib/arbor.js"></script>
                <script src="lib/arbor-tween.js"></script>
                <script src="main.js"></script>
            </div>
        </div>
    </div>
</body>
</html>