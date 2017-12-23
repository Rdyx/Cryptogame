$(window).ready(function(){
    // $('#topCalls').addClass('hidden');
});

$('.topCallsClickable').click(function(){
    getHidden('topCalls', 'dropMenuMobile', 'listCalls');
});

$('.listCallsClickable').click(function(){
    getHidden('listCalls', 'dropMenuMobile', 'topCalls');
});

$('#dropdownMenuMobile').click(function(){
    $('#dropMenuMobile').removeClass('hidden');
});

function getHidden(id1, id2, id3){
    $('#'+id1).removeClass('hidden');
    $('#'+id2).addClass('hidden');
    $('#'+id3).addClass('hidden');
}
