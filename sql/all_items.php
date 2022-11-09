<?php
    $co = pg_connect('host=localhost dbname=titanquest user=tqdb password=tqdb')
    or die('Connexion impossible : '.prg_last_error());

    $p = "/€€/";

    $result = pg_query("SELECT * 
                        FROM MAIN.CLASSIFICATION NATURAL JOIN MAIN.ITEM NATURAL JOIN MAIN.ITEM_TYPE
                        WHERE class_name = 'Rare'
                        OR class_name = 'Épique'
                        OR class_name = 'Légendaire'");
    while($item = pg_fetch_array($result, null, PGSQL_ASSOC))
    {
        $properties = pg_query("SELECT * FROM MAIN.ITEMPROPERTY NATURAL JOIN MAIN.PROPERTY WHERE item_id = ".$item['item_id']);

        $allProperties = pg_fetch_all($properties);

        echo "  <div class='item_box'
                     data-class='".$item['class_name']."'
                     data-type='".$item['ityp_name']."'
                     data-name='".$item['item_name']."'
                     data-lvl='".$item['item_req_lvl']."'>
                    <div class='item_box_header'>
                        <div class='item_box_header_band'>
                            <div> 

                            </div>
                            <div>
                                <span class='item_box_class'>".$item['class_name']."</span>
                                <span class='item_box_type'>".$item['ityp_name']."</span>
                            </div>
                        </div>
                        <div class='item_box_header_core'>
                            <div class='item_box_header_carac'>
                                <span class='item_box_name'>".$item['item_name']."</span>";
                            if(gettype($allProperties) == "array")
                            {
                                for($i = 0; $i<count($allProperties); $i++)
                                {
                                    $line = $allProperties[$i];
                                    if ($item['ityp_name'] != 'Anneau'
                                        && $item['ityp_name'] != 'Amulette')
                                        if ($line['prop_tag'] == 'offensivePhysical'
                                            || $line['prop_tag'] == 'characterAttackSpeed'
                                            || $line['prop_tag'] == 'offensivePierceRatio'
                                            || $line['prop_tag'] == 'offensiveBaseFire'
                                            || $line['prop_tag'] == 'offensiveBaseCold'
                                            || $line['prop_tag'] == 'offensiveBaseLightning'
                                            || $line['prop_tag'] == 'offensiveBaseLife'
                                            || $line['prop_tag'] == 'defensiveBlock'
                                            || $line['prop_tag'] == 'offensiveBasePoison'
                                            || $line['prop_name_fr'] == "€€ d'armure")
                                        {
                                            echo '<span class="item_box_stats">'.preg_replace(array($p,$p,$p,$p),
                                                array(
                                                    intval($line['iprop_val1']),
                                                    intval($line['iprop_val2']),
                                                    intval($line['iprop_val3']),
                                                    intval($line['iprop_val4'])),
                                                $line['prop_name_fr']).'</span>';
                                        }
                                }
                            }

        echo            "</div>
                            <div class='item_box_header_img'>
                                <img src='../graphics/".$item['item_tag']."' alt='sprite'>
                            </div>
                        </div>
                    </div>
                    <div class='item_box_main'>
                        <div class='item_box_main_prop'>";

        while($line = pg_fetch_array($properties, null, PGSQL_ASSOC))
        {
            if ($line['prop_tag'] != 'offensivePhysical'
            && $line['prop_tag'] != 'characterAttackSpeed'
            && $line['prop_tag'] != 'offensivePierceRatio'
            && $line['prop_tag'] != 'offensiveBaseFire'
            && $line['prop_tag'] != 'offensiveBaseCold'
            && $line['prop_tag'] != 'offensiveBaseLightning'
            && $line['prop_tag'] != 'offensiveBaseLife'
            && $line['prop_tag'] != 'defensiveBlock'
            && $line['prop_tag'] != 'offensiveBasePoison'
            && $line['prop_name_fr'] != "€€ d'armure")
            {
                echo '<span class="a_prop">'.preg_replace(array($p,$p,$p,$p),
                array(
                    intval($line['iprop_val1']),
                    intval($line['iprop_val2']),
                    intval($line['iprop_val3']),
                    intval($line['iprop_val4'])),
                $line['prop_name_fr']).'</span>';
            }
        }
        echo "          </div>
                        <div class='item_box_main_req'>
                            <span>Prérequis</span>
                            <div class='requirements'>";
                                if($item['item_req_lvl'] != 0) { echo "<span class='item_box_lvl_req'>LVL ".$item['item_req_lvl']."</span>"; }
                                if($item['item_req_str'] != 0) { echo "<span>FOR ".$item['item_req_str']."</span>"; }
                                if($item['item_req_dex'] != 0) { echo "<span>DEX ".$item['item_req_dex']."</span>"; }
                                if($item['item_req_int'] != 0) { echo "<span>INT ".$item['item_req_int']."</span>"; }
        echo "              </div>
                        </div>
                    </div>
                </div>";
    }
    pg_close($co);
?>