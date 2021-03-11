var estadomenu = false;

function myFunctionMenu(x) {
    x.classList.toggle("change");
    if(estadomenu == false){
        $(".container2").show("fast");
        estadomenu = true;
    }else{
        $(".container2").hide("fast");
        estadomenu = false;
    }
}

$( ".pamens" ).append( '<div class="containerMenu" onclick="myFunctionMenu(this)"><div class="bar1"></div><div class="bar2"></div><div class="bar3"></div></div>' );

$(document).ready(function(){

   
    
    if(window.matchMedia("(max-width: 767px)").matches){
        // The viewport is less than 768 pixels wide
        // alert("This is a mobile device.");
        $(".container2").css("display","none");
        $(".containerMenu").css("display","inline");
        $("#separa").css("margin","5px");
        $("#separa").css("display","contents");
    } else{
        // The viewport is at least 768 pixels wide
        // alert("This is a tablet or desktop.");
        $(".container2").css("display","inline");
        $(".containerMenu").css("display","none");
        $("#separa").css("margin","5px");
    }


});