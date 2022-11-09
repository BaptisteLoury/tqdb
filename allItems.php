<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
  </head>
  <body>
      <?php
        $co = pg_connect('host=localhost dbname=titanquest user=tqdb password=tqdb')
          or die('Connexion impossible : '.prg_last_error());

        $p = "/€€/";

        $result = pg_query("SELECT * FROM MAIN.CLASSIFICATION NATURAL JOIN MAIN.ITEM NATURAL JOIN MAIN.ITEM_TYPE"); //WHERE item_name LIKE '%Aani%'");
        while($item = pg_fetch_array($result, null, PGSQL_ASSOC))
        {
          $properties = pg_query("SELECT * FROM MAIN.ITEMPROPERTY NATURAL JOIN MAIN.PROPERTY WHERE item_id = ".$item['item_id']);

          $test = pg_fetch_all($properties);
          var_dump($test);

          echo $item['item_name'].' : '.$item['ityp_name'].' : '.$item['class_name'].'<br>';
          while($line = pg_fetch_array($properties, null, PGSQL_ASSOC))
          {
            echo preg_replace(array($p,$p,$p,$p),array($line['iprop_val1'],$line['iprop_val2'],$line['iprop_val3'],$line['iprop_val4']),$line['prop_name_fr']).'<br>';
          }
          echo '<br>';
        }
        pg_close($co);
      ?>
  </body>
</html>
