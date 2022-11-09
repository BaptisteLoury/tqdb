<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title> 
        <link rel="stylesheet" href="../../style/global.css">
        <link rel="stylesheet" href="../../style/item_box.css">
        <link rel="stylesheet" href="../../style/dressing.css">
        <script type="text/javascript" src="../../jquery-3.6.0.js"></script>
        <script type="text/javascript" src="../../browse.js"></script>
    </head>
    <body>
            <?php
                $active = 'dressing';
                $folder = '../';
                require_once("../../top_pan.php");
            ?>
            <main>
                <div id="my_equipment">
                <?php
                    require_once("../../sql/item_from_equipment.php");
                ?>
                </div>
            </main>
    </body>
</html>
