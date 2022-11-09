
function sortByString(a,b)
{
    return String.prototype.localeCompare.call(a.toLowerCase(), b.toLowerCase());
}
function sortByInt(a,b)
{
    return parseInt(a.substring(4)) - parseInt(b.substring(4));
}
function sortByRarety(a,b)
{
    if(a == 'Rare' && (b== 'Épique' || b== 'Légendaire')) {
        return -1;
    }
    else if (a == 'Épique' && b== 'Légendaire') {
        return -1;
    }
    else if (a == b) {
        return 0;
    }
    return 1;
}
function selectSort()
{
    var itemList = $(".item_box");
    switch ($('#order-combo').find('option:selected').val()) {
        case 'name':
            itemList.sort(function(a,b) { 
                return sortByString($(a).find('.item_box_name').text(),$(b).find('.item_box_name').text()); });
            break;
        case 'level':
            itemList.sort(function(a,b) {
                return sortByInt($(a).find('.item_box_lvl_req').text(),$(b).find('.item_box_lvl_req').text()); });
            break;
        case 'class':
            itemList.sort(function(a,b) {
                return sortByRarety($(a).find('.item_box_class').text(),$(b).find('.item_box_class').text()); });
            break;
        case 'type':
            itemList.sort(function(a,b) { 
                return sortByString($(a).find('.item_box_type').text(),$(b).find('.item_box_type').text()); });
            break;
        default:
    }
    $('#items_pan').html(itemList);
}
function keepOnlySelected()
{
    var itemList = $(".item_box");
    if( $('#check_type_rare').is(":checked") )
    {
        itemList
        .filter( 
            function() { return $(this).data('class') == 'Rare'; })
        .each(
            function() { $(this).css('display','flex'); });
    }
    else
    {
        itemList
        .filter( 
            function() { return $(this).data('class') == 'Rare'; })
        .each(
            function() { $(this).css('display','none'); });
    }
    if( $('#check_type_epique').is(":checked") )
    {
        itemList
        .filter( 
            function() { return $(this).data('class') == 'Épique'; })
        .each(
            function() { $(this).css('display','flex'); });
    }
    else
    {
        itemList
        .filter( 
            function() { return $(this).data('class') == 'Épique'; })
        .each(
            function() { $(this).css('display','none'); });
    }
    if( $('#check_type_legendaire').is(":checked") )
    {
        itemList
        .filter( 
            function() { return $(this).data('class') == 'Légendaire'; })
        .each(
            function() { $(this).css('display','flex'); });
    }
    else
    {
        itemList
        .filter( 
            function() { return $(this).data('class') == 'Légendaire'; })
        .each(
            function() { $(this).css('display','none'); });
    }
    selectSort();

}