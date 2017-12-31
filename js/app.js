new List('listCalls', {
    valueNames: ['table'],
    page: 6,
    pagination: false
});

$('.topCallsClickable').click(function(){
    getHidden('topCalls', 'dropMenuMobile', 'listCalls');
    getHidden('topCalls', 'dropMenuMobileIndex', 'listCalls');
});

$('.listCallsClickable').click(function(){
    getHidden('listCalls', 'dropMenuMobile', 'topCalls');
    getHidden('listCalls', 'dropMenuMobileIndex', 'topCalls');
});

$('#dropdownMenuMobile').click(function(){
    $('#dropMenuMobile').toggleClass('hidden');
    $('#dropMenuMobileIndex').toggleClass('hidden');
});

function getHidden(id1, id2, id3){
    $('#'+id1).removeClass('hidden');
    $('#'+id2).addClass('hidden');
    $('#'+id3).addClass('hidden');
}

disabledSubmitEdit($('#newPwd'));
disabledSubmitEdit($('#newPwd2'));

function disabledSubmitEdit(arg1){
    arg1.change(function(){
        $('#submitEdit').prop('disabled', true);
        if($('#newPwd').val() === $('#newPwd2').val()){
            $('#submitEdit').prop('disabled', false);
        }
    });
}
