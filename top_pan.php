<div id="top_pan">
    <nav id="top_nav">
        <ul>
            <li>
                <a <?php if($active == 'browse') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?> 
                    href="<?php echo $folder; ?>../browse"><img 
                    src="<?php echo $folder; ?>../media/database-symbol.png">
                        <span>Parcourir</span></a></li>
            <li>
                <a <?php if($active == 'search') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?> 
                    href="<?php echo $folder; ?>../search"><img 
                    src="<?php echo $folder; ?>../media/magni_glass-symbol.png"><span>Recherche</span></a></li>
            <li>
                <a <?php if($active == 'dressing') {echo "class=\"active\"";} else {echo "class=\"inactive\"";}?> 
                    href="<?php echo $folder; ?>../dressing"><span>Cabine d'essayage</span></a></li>
        </ul>
    </nav>
</div>