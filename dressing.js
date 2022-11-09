function show_item_list(type) {
    var offset = $(type).offset();
    var height = $(type).height();
    var width = $(type).width();
    var top = offset.top + height + 4 + "px";
    var right = offset.left - 182 + "px";

    $('#submenu').css( {
        'position': 'absolute',
        'right': right,
        'top': top,
        'display': 'block'
    });
}

function hide_item_list()
{
    $('#submenu').css( {
        'display': 'none'
    });
    $('#submenu').empty();
}

function add_first_match(type,type_name)
{
    var regex = new RegExp($(type).val());
    $('#submenu').empty();
    var itemList = $(type_name).find('.item_infos');
    itemList = itemList.filter(function() {
        return regex.test( $(this).data('name') );
    });
    console.log(itemList.length,type_name,$());
    if(itemList.length > 0)
    {
        var first = itemList.first();
        $('#submenu').append(first.data('name'));
        console.log(first.data('name'));
    }
}

function setBehaviour(type,type_name)
{
    $(type).focusin(function(){
        show_item_list(type);
      });
    $(type).focusout(function(){
        hide_item_list();
    });
    $(type).keyup(function(){
        add_first_match(type,type_name);
    });
}

function setAllBehaviour()
{
    setBehaviour('#ring1','#Anneau');
    setBehaviour('#ring2','#Anneau');
    setBehaviour('#legs','#Jambes');
    setBehaviour('#torso','#Torse');
    setBehaviour('#amulet','#Amulette');
    setBehaviour('#arm','#Bras');
    setBehaviour('#head','#Tête');
    setBehaviour('#weapon1','#Armes');
    setBehaviour('#weapon2','#Armes');
}