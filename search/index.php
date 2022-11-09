<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title> 
        <link rel="stylesheet" href="../style/global.css">
        <link rel="stylesheet" href="../style/item_box.css">
        <link rel="stylesheet" href="../style/search.css">
        <script type="text/javascript" src="../jquery-3.6.0.js"></script>
        <script type="text/javascript" src="../search.js"></script>
    </head>
    <body>
            <?php
                $active = 'search';
                $folder = '';
                require_once("../top_pan.php");
            ?>
            <main>
                <div id="filter_pan">
                    <div class="filter_pan">
                        <h1>Nom</h1>
                        <div id="filter_pan_by_name">
                            <input type="text" id="name">
                        </div>
                    </div>
                    <div class="filter_pan">
                        <h1>Rareté</h1>
                        <div class="filter_pan_checkbox">
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="rare" id="rare">
                                <label for="rare">Rare</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="epique" id="epique">
                                <label for="epique">Épique</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="légendaire" id="légendaire">
                                <label for="légendaire">Légendaire</label>
                            </div>
                        </div>
                    </div>
                    <div class="filter_pan">
                        <h1>Type</h1>
                        <div class="filter_pan_checkbox">
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="anneaux" id="anneaux">
                                <label for="anneaux">Anneaux</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="amulettes" id="amulettes">
                                <label for="amulettes">Amulettes</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="arcs" id="arcs">
                                <label for="arcs">Arcs</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="batons" id="batons">
                                <label for="batons">Bâtons</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="bouclier" id="bouclier">
                                <label for="bouclier">Boucliers</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="epees" id="epees">
                                <label for="epees">Épées</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="gourdins" id="gourdins">
                                <label for="gourdins">Gourdins</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="haches" id="haches">
                                <label for="haches">Haches</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="javelots" id="javelots">
                                <label for="javelots">Javelots</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="jets" id="jets">
                                <label for="jets">Jets</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="tete" id="tete">
                                <label for="tete">Tête</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="bras" id="bras">
                                <label for="bras">Bras</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="torse" id="torse">
                                <label for="torse">Torse</label>
                            </div>
                            <div class="filter_pan_checkbox_group">
                                <input type="checkbox" name="jambes" id="jambes">
                                <label for="jambes">Jambes</label>
                            </div>
                        </div>
                        <div class="filter_pan">
                            <h1>Niveau requis</h1>
                            <label>Min :</label>
                            <input type="number" min="1" max="85" id="filter_min_lvl">
                            <label>Max</label>
                            <input type="number" min="1" max="85" id="filter_max_lvl">
                        </div>
                    </div>
                    <div class="filter_pan">
                        <h1>Propriétés</h1>
                        <div id="filter_pan_prop"> 
                            <input type="text" id="filter_by_prop_name">
                        </div>
                    </div>
                </div>
                <div id="item_list">
                    <?php
                        require_once("../sql/all_items.php");
                    ?>
                </div>
            </main>
            <script type="text/javascript">
                checkDefault();
                changeBehaviour();
            </script>
    </body>
</html>
