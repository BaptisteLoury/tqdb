<?php
    $co = pg_connect('host=localhost dbname=titanquest user=postgres password=tqdb')
    or die('Connexion impossible : '.prg_last_error());

    $allTypes = array('Anneau','Amulette','Jambes','Torse','Bras','Tête');
    echo "<div id='all_names'>";
    foreach($allTypes as &$type)
    {    
        $result = pg_query("SELECT * 
                            FROM MAIN.CLASSIFICATION NATURAL JOIN MAIN.ITEM NATURAL JOIN MAIN.ITEM_TYPE
                            WHERE ityp_name = '$type'
                            ORDER BY item_name");
        echo "<div id='$type'>";
        while($item = pg_fetch_array($result, null, PGSQL_ASSOC))
        {
            echo "<div class='item_infos' data-name=\"".$item['item_name']."\"></div>";
        }
        echo "</div>";
    }
    echo "</div>";
    pg_close($co);
?>