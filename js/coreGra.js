
window.onload = function() {

    function GetTodayDate() {
        var tdate = new Date();
        var dd = ("0" + tdate.getDate().toString()).slice(-2); //yields day
        var MM = ("0" + (tdate.getMonth().toString() + 1)).slice(-2); //yields month
        var yyyy = tdate.getFullYear(); //yields year
        var hora = ("0" + tdate.getHours().toString()).slice(-2);
        var min = ("0" + tdate.getMinutes().toString()).slice(-2);
        var seg = ("0" + tdate.getSeconds().toString()).slice(-2); 
        var currentDate= "Atualizado em: " + dd + "/" + (MM) + "/" + yyyy + " " + hora + ":" + min + ":" + seg;
     
        return currentDate;
     }

    $("#valortempo").html(GetTodayDate());
    var width = $(window).width() * 0.4;
    var height = $(window).height() * 0.4;

    var setando = setInterval(atualize, 300000);
    // Padrão de tamanho, equivale a 100% do valor definido no Body
     
    var valorMaxWidth = 0;
    var bolaSize = 4;
    var fontSize = 100;

    // Valor de incremento ou decremento, equivale a 10% do valor do Body
    var increaseDecrease = 5;
    var increaseAjuste = 10;
    var increaseDecrease2 = 0.5;

    function atualize() {
        $("#load").css("top","40%");
        $("#load").css("left","40%");
        console.log("Atualizando");

        $("#load").fadeIn( "slow" );
        var url = new URL(window.location.href);
        var a = url.searchParams.get("UF");
        var b = url.searchParams.get("modalidade");
        var c = url.searchParams.get("separa");
        var d = url.searchParams.get("falha");
        $.ajax({
            type: "post",
            url: "dados1.php",
            data: {"UF":a,"modalidade":b, "separa":c, "falha":d},
            dataType: "text",
            success: function (response) {
                $("#pames").html(response);
                $("#valortempo").html(GetTodayDate());

                $(".textON").animate({
                    fontSize: fontSize + '%'
                },500);
        
                $(".circulo").animate({
                    width: bolaSize + 'rem',
                    height: bolaSize + 'rem'
                },500);
                if (valorMaxWidth != 0) {
                    $(".usu").animate({
                        width: valorMaxWidth + 'px',
                    },500); 
                }
                $("#load").css("display","none");
                
            }
        });

    };

    function ajustetamanho() {
        console.log("Ajuste de Tamanho");
        var elementUSU = document.getElementsByClassName("usu");
        valorMaxWidth = 0;
        for (var i = 0; i < elementUSU.length; i++) {
            poke = elementUSU[i].offsetWidth;
            if(elementUSU[i].offsetWidth > valorMaxWidth){
                valorMaxWidth = elementUSU[i].offsetWidth;
            }
        }
        $(".usu").animate({
            width: valorMaxWidth + 'px',
        },500);
    }


    $("#Check1").change(function() {
        clearTimeout(setando);
        console.log("Alterado Dados");
    });

    $("#atualizar").click(function() {
        atualize();
    });

    $("#ajustar-size").click(function() {
        ajustetamanho();
    });

    $("#increase-size").click(function() {
        valorMaxWidth = valorMaxWidth + increaseAjuste;
        Cookies.set('valorMaxWidth', valorMaxWidth);
        $(".usu").animate({
            width: valorMaxWidth + 'px',
        },500);
    });

    $("#decrease-size").click(function() {
        valorMaxWidth = valorMaxWidth - increaseAjuste;
        Cookies.set('valorMaxWidth', valorMaxWidth);
        $(".usu").animate({
            width: valorMaxWidth + 'px',
        },500);
    });

    // Evento de click para aumentar a fonte
    $("#increase-font").click(function() {
        fontSize = fontSize + increaseDecrease;
        bolaSize = bolaSize + increaseDecrease2;
        Cookies.set('fontSize', fontSize);
        Cookies.set('bolaSize', bolaSize);

        $(".textON").animate({
            fontSize: fontSize + '%'
        },500);

        $(".circulo").animate({
            width: bolaSize + 'rem',
            height: bolaSize + 'rem'
        },500);

    });

    // Evento de click para diminuir a fonte
    $("#decrease-font").click(function() {
        fontSize = fontSize - increaseDecrease;
        bolaSize = bolaSize - increaseDecrease2;
        Cookies.set('fontSize', fontSize);
        Cookies.set('bolaSize', bolaSize);

        $(".textON").animate({
            fontSize: fontSize + '%'
        },500);

        $(".circulo").animate({
            width: bolaSize + 'rem',
            height: bolaSize + 'rem'
        },500);
          
    });

    $( document ).ready(function() {
        var valor = parseInt(Cookies.get('valorMaxWidth')) || null;
        var bola = parseInt(Cookies.get('bolaSize')) || null;
        var font = parseInt(Cookies.get('fontSize')) || null;

        if(valor != null){
            valorMaxWidth = parseInt(Cookies.get('valorMaxWidth'));
        }
        if(bola != null){
            bolaSize = parseInt(Cookies.get('bolaSize'));
        }
        if(font != null){
            fontSize = parseInt(Cookies.get('fontSize'));
        }
    
        var url = new URL(window.location.href);
        var a = url.searchParams.get("UF");
        var b = url.searchParams.get("modalidade");
        var c = url.searchParams.get("separa");
        var d = url.searchParams.get("falha");

        $("#button4").mouseover(function() {
            $("#toolti3").show();
        }).mouseleave(function() {
            $("#toolti3").hide();
        });

            $.ajax({
                type: "post",
                url: "dados1.php",
                data: {"UF":a,"modalidade":b, "separa":c, "falha":d},
            dataType: "text",
            success: function (response) {
                $("#pames").html(response);
                
                if(valor != null){
                    $(".usu").css({
                        width: valorMaxWidth + 'px',
                    });
                }else{
                    ajustetamanho();
                }

                if(font != null){

                    $(".textON").css({
                        fontSize: fontSize + '%'
                    });
                }

                if(bola != null){
                    $(".circulo").css({
                        width: bolaSize + 'rem',
                        height: bolaSize + 'rem'
                    });
                }

            }
        });
    
    });

}

$("#button2").click(function() {;
    const tooltip = $('#tooltip');
    const tooltip1 = $('#tooltip2');
    tooltip.toggle();
    if ($('#tooltip2').is(":visible")) {
        tooltip1.toggle();    
    }    
    event.stopPropagation();
  });


  $("#button3").click(function() {
    const tooltip = $('#tooltip2');
    const tooltip1 = $('#tooltip');
    tooltip.toggle();
    if ($('#tooltip').is(":visible")) {
        tooltip1.toggle();    
    } 
    event.stopPropagation();
  });

  $(".prevenir").click(function(){
    event.stopPropagation();
  });

  $(window).click(function(){
    const tooltip = $('#tooltip2');
    const tooltip1 = $('#tooltip');
    if ($('#tooltip').is(":visible")) {
        tooltip1.toggle();    
    } 
    if ($('#tooltip2').is(":visible")) {
        tooltip.toggle();    
    } 
  });


//   $("#button2").focusout(function(){
//     const tooltip = $('#tooltip');
//     tooltip.toggle();
//   });

//   $("#button3").focusout(function(){
//     const tooltip = $('#tooltip2');
//     // if (!$(".btn").is(":focus")) {
//         tooltip.toggle();
//     //   }
//   });

$( "#primselec" ).change(function() {
    $( "#target" ).submit();
});

$(document).ready(function() {
    $('#primselec').multiselect();
    $('#primselec2').multiselect();
});

$('#target').click(function() {
    $saida = ['','','',''];
    var i = 0;
   
        if ($('#primselec').val() != '') {
            $saida[i] = "modalidade=" + $('#primselec').val();
            i = i + 1;
        }
        if ($('#primselec2').val() != '') {
            $saida[i] = "UF=" + $('#primselec2').val(); 
            i = i + 1;
        }
        if ($('#separaid').is(":checked")) {
            $saida[i] = "separa=" + $('#separaid').val(); 
            i = i + 1;
        }
        if ($('#falha').is(":checked")) {
            $saida[i] = "falha=" + $('#falha').val(); 
            i = i + 1;
        }
     
     if($saida[0] != ""){
        if($saida[1] != ""){
            $saida[0] =  $saida[0] + "&" + $saida[1];
        }
        if($saida[2] != ""){
            $saida[0] =  $saida[0] + "&" + $saida[2];
        }
        if($saida[3] != ""){
            $saida[0] =  $saida[0] + "&" + $saida[3];
        }
     }

    window.location.replace("/SCL/grafico/1.php?" + $saida[0].replaceAll(",","+"));
});