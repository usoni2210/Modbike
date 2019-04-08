$(".alert").fadeTo(1000, 500).slideUp(500, function(){
    $("#success-alert").alert('close');
});

$('input[type="file"]').change(function (e) {
    let fileName = e.target.files[0].name;
    $('.custom-file-label').html(fileName);
});