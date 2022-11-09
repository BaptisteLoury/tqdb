<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>TQDB</title> 
        <link rel="stylesheet" href="../../style/global.css">
        <link rel="stylesheet" href="../../style/browse.css">
        <link rel="stylesheet" href="../../style/item_box.css">
        <script type="text/javascript" src="../../jquery-3.6.0.js"></script>
        <script type="text/javascript" src="../../browse.js"></script>
    </head>
    <body>
            <?php
                $active = 'browse';
                $folder = '../';
                require_once("../../top_pan.php");
            ?>
            <main>
                <div id="submenu_pan">
                    <div class="item_type_group">
                        <h1>Bijoux</h1>
                        <ul>
                            <a href="../rings"><li 
                            <?php if($type == 'Anneau') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Anneaux</li></a>
                            <a href="../amulets"><li 
                            <?php if($type == 'Amulette') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Amulettes</li></a>
                        </ul>
                    </div>
                    <div class="item_type_group">
                        <h1>Armes</h1>
                        <ul>
                            <a href="../bows"><li 
                            <?php if($type == 'Arc') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Arcs</li></a>
                            <a href="../staffs"><li 
                            <?php if($type == 'Bâton') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Bâtons</li></a>
                            <a href="../shields"><li 
                            <?php if($type == 'Bouclier') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Boucliers</li></a>
                            <a href="../swords"><li 
                            <?php if($type == 'Épée') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Épées</li></a>
                            <a href="../maces"><li 
                            <?php if($type == 'Gourdin') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Gourdins</li></a>
                            <a href="../axes"><li 
                            <?php if($type == 'Hache') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Haches</li></a>
                            <a href="../spears"><li 
                            <?php if($type == 'Javelot') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Javelots</li></a>
                            <a href="../throwing"><li 
                            <?php if($type == 'Jet') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                >Jets</li></a>
                        </ul>
                    </div>
                    <div class="item_type_group">
                        <h1>Armures</h1>
                        <ul>
                            <a href="../head"><li 
                                <?php if($type == 'Tête') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                    >Tête</li></a>
                            <a href="../arm"><li 
                                <?php if($type == 'Bras') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                    >Bras</li></a>
                            <a href="../torso"><li 
                                <?php if($type == 'Torse') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                    >Torse</li></a>
                            <a href="../leg"><li 
                                <?php if($type == 'Jambes') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?>
                                    >Jambes</li></a>
                        </ul>
                    </div>
                </div>
                <div id="core_pan">
                    <div id="top_submenu">
                        <div id="top_submenu_order">
                            <div class="top_submenu_group">
                                <span>Trier par </span>
                                <select id="order-combo">
                                    <option value="name">Nom</option>
                                    <option value="level">Niveau Req.</option>
                                    <option value="class">Rareté</option>
                                    <option value="type">Type</option>
                                </select>
                            </div>
                        </div>
                        <div id="top_submenu_class">
                            <div class="top_submenu_group">
                                <label for="rare">Rare</label>
                                <input type="checkbox" name="rare" id="check_type_rare">
                            </div>
                            <div class="top_submenu_group">
                                <label for="epique">Épique</label>
                                <input type="checkbox" name="epique" id="check_type_epique">
                            </div>
                            <div class="top_submenu_group">
                                <label for="legendaire">Légendaire</label>
                                <input type="checkbox" name="legendaire" id="check_type_legendaire">
                            </div>
                        </div>
                    </div>
                    <div id="items_pan">
                        <?php
                            require_once("../../sql/browse_by_type.php");
                        ?>
                    </div>
                    
                </div>
            </main>
            <script type="text/javascript">
                $('#check_type_rare').change(function() {
                    keepOnlySelected();
                });
                $('#check_type_epique').change(function() {
                    keepOnlySelected();
                });
                $('#check_type_legendaire').change(function() {
                    keepOnlySelected();
                });
                $('#check_type_rare').prop('checked',false);
                $('#check_type_epique').prop('checked',true);
                $('#check_type_legendaire').prop('checked',true);
                keepOnlySelected();

                selectSort();
                $('#order-combo').change(function() {
                    selectSort();
                });
            </script>
    </body>
</html>
