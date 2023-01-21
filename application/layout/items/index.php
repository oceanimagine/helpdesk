<?php 

if(!defined("base_url")){
    exit("
        <html>
        <head>
        <meta charset='utf-8' />
        <title>DIRECT ACCESS.</title>
        </head>
        <body style='font-family: consolas, monospace; cursor: dewfault;'>
        DIRECT ACCESS NOT ALLOWED.
        </body>
        </html>
    ");
}

?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <base href="<?php echo base_url; ?>layout/items/" />
        <title>{title}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="image/LOGOYKKBI.png">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="assets/css/main.css">
    </head>
    <body>
        <?php 
        include_once 'part_body.php'; 
        echo "\n";
        ?>
    </body>
</html>