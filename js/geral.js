$( document ).ready(function() {
    var tamanho1 = $(".pamens").width();
    var tamanho2 = $(".container2").width();
    var tamanho3 = tamanho1 - tamanho2 - 24;
    $("#separa").width(tamanho3);

    if ($("#test1").length) {
        var tamanho4 = $("#test1").height();
        $(".container2").height(tamanho4 + 20);
      }
});

$(window).on('resize', function(){
    var tamanho1 = $(".pamens").width();
    var tamanho2 = $(".container2").width();
    var tamanho3 = tamanho1 - tamanho2  - 24;
    $("#separa").width(tamanho3);

    if ($("#test1").length) {
        var tamanho4 = $("#test1").height();
        $(".container2").height(tamanho4 + 20);
      }
});

