<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title> 
        <link rel="stylesheet" href="../style/global.css">
        <link rel="stylesheet" href="../style/item_box.css">
        <link rel="stylesheet" href="../style/dressing.css">
        <script type="text/javascript" src="../jquery-3.6.0.js"></script>
        <script type="text/javascript" src="../dressing.js"></script>
    </head>
    <body>
            <?php
                $active = 'dressing';
                $folder = '';
                require_once("../top_pan.php");
            ?>
            <main>
                <form action="equipement/index.php" method="post">
                    <div class="item_search_box">
                        <label for="ring1">Premier anneau</label>
                        <input type="text" name="ring1" id="ring1">
                    </div>
                    <div class="item_search_box">
                        <label for="ring2">Deuxième anneau</label>
                        <input type="text" name="ring2" id="ring2">
                    </div>
                    <div class="item_search_box">
                        <label for="amulet">Amulette</label>
                        <input type="text" name="amulet" id="amulet">
                    </div>
                    <div class="item_search_box">
                        <label for="legs">Jambes</label>
                        <input type="text" name="legs" id="legs">
                    </div>
                    <div class="item_search_box">
                        <label for="torso">Torse</label>
                        <input type="text" name="torso" id="torso">
                    </div>
                    <div class="item_search_box">
                        <label for="arm">Bras</label>
                        <input type="text" name="arm" id="arm">
                    </div>
                    <div class="item_search_box">
                        <label for="head">Tête</label>
                        <input type="text" name="head" id="head">
                    </div>
                    <div class="item_search_box">
                        <label for="weapon1">Première arme</label>
                        <input type="text" name="weapon1" id="weapon1">
                    </div>
                    <div class="item_search_box">
                        <label for="weapon2">Deuxième arme</label>
                        <input type="text" name="weapon2" id="weapon2">
                    </div>
                    <input type='submit'>
                </form>
            </main>
            <div id="submenu"></div>
            <?php
                require_once("../sql/all_items_name.php");
            ?>
            <script type="text/javascript">
                setAllBehaviour();
            </script>
    </body>
</html>
