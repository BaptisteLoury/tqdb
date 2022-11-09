function checkDefault() {
    $('#rare').prop('checked',true);
    $('#epique').prop('checked',true);
    $('#légendaire').prop('checked',true);
    $('#anneaux').prop('checked',false);
    $('#amulettes').prop('checked',false);
    $('#arcs').prop('checked',false);
    $('#batons').prop('checked',false);
    $('#bouclier').prop('checked',false);
    $('#epees').prop('checked',false);
    $('#gourdins').prop('checked',false);
    $('#haches').prop('checked',false);
    $('#javelots').prop('checked',false);
    $('#jets').prop('checked',false);
    $('#tete').prop('checked',false);
    $('#bras').prop('checked',false);
    $('#torse').prop('checked',false);
    $('#jambes').prop('checked',false);
    $('#filter_min_lvl').val(1);
    $('#filter_max_lvl').val(85);
}

function changeBehaviour()
{
    $('#name').change(
        function() {keepMatchingName();}
    );
    $('#filter_by_prop_name').change(
        function() {keepMatchingName();}
    );
    $('#filter_min_lvl').change(
        function() {keepMatchingName();}
    );
    $('#filter_max_lvl').change(
        function() {keepMatchingName();}
    );
    $('#rare').change(
        function() {keepMatchingName();}
    );
    $('#epique').change(
        function() {keepMatchingName();}
    );
    $('#légendaire').change(
        function() {keepMatchingName();}
    );
    $('#anneaux').change(
        function() {keepMatchingName();}
    );
    $('#amulettes').change(
        function() {keepMatchingName();}
    );
    $('#arcs').change(
        function() {keepMatchingName();}
    );
    $('#batons').change(
        function() {keepMatchingName();}
    );
    $('#bouclier').change(
        function() {keepMatchingName();}
    );
    $('#epees').change(
        function() {keepMatchingName();}
    );
    $('#gourdins').change(
        function() {keepMatchingName();}
    );
    $('#haches').change(
        function() {keepMatchingName();}
    );
    $('#javelots').change(
        function() {keepMatchingName();}
    );
    $('#jets').change(
        function() {keepMatchingName();}
    );
    $('#tete').change(
        function() {keepMatchingName();}
    );
    $('#bras').change(
        function() {keepMatchingName();}
    );
    $('#torse').change(
        function() {keepMatchingName();}
    );
    $('#jambes').change(
        function() {keepMatchingName();}
    );
}

function filterList(itemList,that,data,name)
{
    if ( $(that).is(":checked") )
    {
        itemList
        .filter(function() { return $(this).data(data) == name;})
        .each(function() { $(this).css('display','flex'); });
    }
    else
    {
        itemList
        .filter(function() { return $(this).data(data) == name;})
        .each(function() { $(this).css('display','none'); });
    }
}

function hideItemsByRarety(itemList,that,classification)
{
    if( $(that).is(":checked") )
    {
        items = itemList
        .filter(function() { return $(this).data('type') == type; });
        filterList(items,'#rare','class','Rare');
        filterList(items,'#epique','class','Épique');
        filterList(items,'#légendaire','class','Légendaire');
    }
    else
    {
        items = itemList
        .filter(function() { return $(this).data('type') == type; })
        .each(function() {$(this).css('display','none');});
    }
}

function hideItemsByType(itemList,that,type)
{
    if( $(that).is(":checked") )
    {
        items = itemList
        .filter(function() { return $(this).data('type') == type; });
        filterList(items,'#rare','class','Rare');
        filterList(items,'#epique','class','Épique');
        filterList(items,'#légendaire','class','Légendaire');
    }
    else
    {
        items = itemList
        .filter(function() { return $(this).data('type') == type; })
        .each(function() {$(this).css('display','none');});
    }
}

function keepOnlySelected()
{
    var itemList = $(".item_box");
    hideItemsByType(itemList,"#anneaux","Anneau");
    hideItemsByType(itemList,"#amulettes","Amulette");
    hideItemsByType(itemList,"#arcs","Arc");
    hideItemsByType(itemList,"#batons","Bâton");
    hideItemsByType(itemList,"#bouclier","Bouclier");
    hideItemsByType(itemList,"#epees","Épée");
    hideItemsByType(itemList,"#gourdins","Gourdin");
    hideItemsByType(itemList,"#haches","Hache");
    hideItemsByType(itemList,"#javelots","Javelot");
    hideItemsByType(itemList,"#jets","Jet");
    hideItemsByType(itemList,"#tete","Tête");
    hideItemsByType(itemList,"#bras","Bras");
    hideItemsByType(itemList,"#torse","Torse");
    hideItemsByType(itemList,"#jambes","Jambes");
}

function keepUncorrectLevels(that)
{
    var lvl = parseInt($(that).data('lvl'),10);
    if(lvl < $('#filter_min_lvl').val()
    || lvl > $('#filter_max_lvl').val())
    {
        return true;
    }
    else
    {
        return false;
    }
}

function keepMatchingProp(that,match)
{
    var propList = $(that).find('.a_prop');
    // console.log(propList.length);
    var isMatch = false;
    propList.each(function() {
        if(match.test( $(this).text().toLowerCase() ))
        {
            isMatch = true;
        }
    });
    return isMatch;
}

function keepMatchingName()
{
    keepOnlySelected();
    var itemList = $(".item_box");
    itemList = itemList.filter(function(){return this.style.display == 'flex';});
    var nameContain = new RegExp($('#name').val().toLowerCase());
    var propContain = new RegExp($('#filter_by_prop_name').val().toLowerCase());
    itemNotMatchingName = itemList.filter(function() {
        return !nameContain.test($(this).data('name').toLowerCase());
    });
    itemNotMatchingProp = itemList.filter(function() {
        return !keepMatchingProp(this,propContain);
    });
    itemNotMatchingLvl = itemList.filter(function() {
        return keepUncorrectLevels(this);
    });
    itemNotMatchingName.each(function() {
        $(this).css('display','none');
    });
    itemNotMatchingLvl.each(function() {
        $(this).css('display','none');
    });
    itemNotMatchingProp.each(function() {
        $(this).css('display','none');
    });
}