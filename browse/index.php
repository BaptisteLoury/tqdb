<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>TQDB</title> 
        <link rel="stylesheet" href="../style/global.css">
        <link rel="stylesheet" href="../style/browse.css">
        <script type="text/javascript" src="../jquery-3.6.0.js"></script>
        <script type="text/javascript" src="../browse.js"></script>
    </head>
    <body>
            <?php
                $active = 'browse';
                $type = 'none';
                $folder = '';
                require_once("../top_pan.php");
            ?>
            <main>
                <div id="submenu_pan">
                    <div class="item_type_group">
                        <h1>Bijoux</h1>
                        <ul>
                            <a href="rings"><li 
                            <?php if($type == 'Anneau') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Anneaux</li></a>
                            <a href="amulets"><li 
                            <?php if($type == 'Amulette') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Amulettes</li></a>
                        </ul>
                    </div>
                    <div class="item_type_group">
                        <h1>Armes</h1>
                        <ul>
                            <a href="bows"><li 
                            <?php if($type == 'Arc') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Arcs</li></a>
                            <a href="staffs"><li 
                            <?php if($type == 'Bâton') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Bâtons</li></a>
                            <a href="shields"><li 
                            <?php if($type == 'Bouclier') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Boucliers</li></a>
                            <a href="swords"><li 
                            <?php if($type == 'Épée') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Épées</li></a>
                            <a href="maces"><li 
                            <?php if($type == 'Gourdin') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Gourdins</li></a>
                            <a href="axes"><li 
                            <?php if($type == 'Hache') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Haches</li></a>
                            <a href="spears"><li 
                            <?php if($type == 'Javelot') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Javelots</li></a>
                            <a href="throwing"><li 
                            <?php if($type == 'Jet') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Jets</li></a>
                        </ul>
                    </div>
                    <div class="item_type_group">
                        <h1>Armures</h1>
                        <ul>
                            <a href="head"><li 
                                <?php if($type == 'Tête') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                    >Tête</li></a>
                            <a href="arm"><li 
                                <?php if($type == 'Bras') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                    >Bras</li></a>
                            <a href="torso"><li 
                                <?php if($type == 'Torse') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                    >Torse</li></a>
                            <a href="leg"><li 
                                <?php if($type == 'Jambes') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                    >Jambes</li></a>
                        </ul>
                    </div>
                </div>
                <div id="core_pan">
                    <div id="top_submenu">
                    </div>
                    <div id="welcome_pan">
                        <p id="welcome_pan_msg">Bienvenue à tous.</p><br>
                        <p>Ce site répertorie l'ensemble des objets disponibles dans le jeu Titan Quest.</p> 
                        <p>La base de données est mise à jour avec la dernière version du jeu</p>
                    </div>
                </div>
            </main>
    </body>
</html>
