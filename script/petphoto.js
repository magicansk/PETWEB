// var file = $('#file'),
//     aim = $('#aim');
//第一組
$('#file').on('change', function (e) {
    // var file = e.currentTarget.files[0];
    var name = e.currentTarget.files[0].name;
    $('#aim').val(name);
    // $('#pp').attr('src', URL.createObjectURL(file));
    $('#cover').addClass('cover');
    $('#aim').addClass('cover');
    $('#cancel').addClass('cover');
});

$('#cancel').on('click', function () {
    $("#file").val('');
    $('#aim').val('檔名');
    $('#pp').attr('src', '');
    $('#cover').removeClass('cover');
    $('#aim').removeClass('cover');
    $('#cancel').removeClass('cover');
});

//第二組
$('#file1').on('change', function (e) {
    var name1 = e.currentTarget.files[0].name;
    $('#aim1').val(name1);
    $('#cover1').addClass('cover');
    $('#aim1').addClass('cover');
    $('#cancel1').addClass('cover');
});

$('#cancel1').on('click', function () {
    $("#file1").val('');
    $('#aim1').val('檔名');
    $('#cover1').removeClass('cover');
    $('#aim1').removeClass('cover');
    $('#cancel1').removeClass('cover');
});

//第三組
$('#file2').on('change', function (e) {
    var name1 = e.currentTarget.files[0].name;
    $('#aim2').val(name1);
    $('#cover2').addClass('cover');
    $('#aim2').addClass('cover');
    $('#cancel2').addClass('cover');
});

$('#cancel2').on('click', function () {
    $("#file2").val('');
    $('#aim2').val('檔名');
    $('#cover2').removeClass('cover');
    $('#aim2').removeClass('cover');
    $('#cancel2').removeClass('cover');
});

//第四組
$('#file3').on('change', function (e) {
    var name1 = e.currentTarget.files[0].name;
    $('#aim3').val(name1);
    $('#cover3').addClass('cover');
    $('#aim3').addClass('cover');
    $('#cancel3').addClass('cover');
});

$('#cancel3').on('click', function () {
    $('#file3').val('');
    $("#aim3").val('檔名');
    $('#cover3').removeClass('cover');
    $('#aim3').removeClass('cover');
    $('#cancel3').removeClass('cover');
});