$( document ).ready(function() {
    var tamanho = $(document).height();
    var tamanho1 = $(".pamens").width();
    var tamanho2 = $(".container2").width();
    var tamanho3 = tamanho1 - tamanho2 - 24;
    $("#separa").width(tamanho3);

    if ($("#test1").length) {
      var tamanho4 = $(".pamens").height();
      tamanho4 =  tamanho4 + $(".pamens2").height();
        $(".container2").height(tamanho - tamanho4);
      }
});

$(window).on('resize', function(){
    var tamanho = $(document).height();
    var tamanho1 = $(".pamens").width();
    var tamanho2 = $(".container2").width();
    var tamanho3 = tamanho1 - tamanho2  - 24;
    $("#separa").width(tamanho3);

    if ($("#test1").length) {
      var tamanho4 = $(".pamens").height();
      tamanho4 =  tamanho4 + $(".pamens2").height();
        $(".container2").height(tamanho - tamanho4);
      }
});

$(document).on('resize', function(){
  var tamanho = $(document).height();
  var tamanho1 = $(".pamens").width();
  var tamanho2 = $(".container2").width();
  var tamanho3 = tamanho1 - tamanho2  - 24;
  $("#separa").width(tamanho3);

  if ($("#test1").length) {
    var tamanho4 = $(".pamens").height();
    tamanho4 =  tamanho4 + $(".pamens2").height();
      $(".container2").height(tamanho - tamanho4);
    }
});