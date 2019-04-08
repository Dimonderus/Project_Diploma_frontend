<?php include 'BS.php';?>
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

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <?php
            $name = "name:";
            if (isset($_POST['name_node']))
            {
                $array = array ($name => $_POST['name_node']);

                foreach ( $array as $k=>$m)
                {
                    if (!empty($m))
                    { $mass[$k] = $m; }
                }
            }
            else
            {
                print 'null';
            }
            $a = json_encode($mass);
            echo $a;

//            $js = fopen('1.json', 'w');
//            $js_open = fopen('1.json', 'a');
//            $js_write = fwrite($js_open,$a);
            ?>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>

</body>
</html>