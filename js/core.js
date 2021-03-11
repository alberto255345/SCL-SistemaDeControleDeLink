$(".form-control").keyup(function(event) {
    if (event.keyCode === 13) {
        loginUser();
    }
});



function detectIE() {
    var ua = window.navigator.userAgent;

    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }

    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }

    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
       // Edge (IE 12+) => return version number
       return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    }

    // other browser
    return false;
}


function registerUser() {
    var process = "registerUser";
    //var data = $("fieldset").serializeArray();
    var data = $("fieldset").formToJson();
    //data[1].value = data[1].value; // data to ajax.php page 
    data = JSON.stringify(data);

    //$("#loginButton").html('Login');
    $.ajax({
        type: "POST",
        url: "login.php",
        dataType: 'text',
        data: {"process": process, "data": data},
        success: function(resultFIM) {
            if (resultFIM == "success") {
                // if ajax.php returns success, redirect to homepage or whatever
                $("#retornoalert").html("Cadastrado com <strong>sucesso</strong> usuário!");
                $(':input').val("");
                $("#retornoalert2").addClass("show");
                $('.heidi').animate({  height: "20%"}, {  duration: "slow"});
                $('#container2').animate({  height: "toggle", opacity: "toggle"}, {  duration: "slow"});
                $('#container1').animate({  height: "toggle",  opacity: "toggle"}, {  duration: "slow"});
        
            } else {
                // if ajax.php returns failure, display error
                $("#retornoalert").html("<strong>Error</strong> no cadastrado do usuário!<br>" + resultFIM);
                $("#retornoalert2").addClass("show");
            }  
        },
        error: function(jqXHR, textStatus, errorThrown, resultFIM) {
            // error handling
        },
    });
}

function loginUser() {
    var process = "loginUser";
    //var data = $("fieldset").serializeArray();
    var data = $("form").formToJson();
    //data[1].value = data[1].value; // data to ajax.php page 
    data = JSON.stringify(data);

    //$("#loginButton").html('Login');
    $.ajax({
        type: "POST",
        url: "login.php",
        dataType: 'text',
        data: {"process": process, "data": data},
        success: function(resultFIM) {
            if (resultFIM == "success") {
                // if ajax.php returns success, redirect to homepage or whatever
                location.href='http://10.5.90.139/SCL/home.php';
            } else {
                // if ajax.php returns failure, display error
                $("#retornoalert").html("<strong>Error</strong> no login!<br>" + resultFIM);
                $("#retornoalert2").addClass("show");
            }  
        },
        error: function(jqXHR, textStatus, errorThrown, resultFIM) {
            // error handling
        },
    });
}

$(document).ready(function() {



    function bin2hex(s){  
        // Converts the binary representation of data to hex    
        //   
        // version: 812.316  
        // discuss at: http://phpjs.org/functions/bin2hex  
        // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)  
        // +   bugfixed by: Onno Marsman  
        // +   bugfixed by: Linuxworld  
        // *     example 1: bin2hex('Kev');  
        // *     returns 1: '4b6576'  
        // *     example 2: bin2hex(String.fromCharCode(0x00));  
        // *     returns 2: '00'  
        var v,i, f = 0, a = [];  
        s += '';  
        f = s.length;  
          
        for (i = 0; i<f; i++) {  
            a[i] = s.charCodeAt(i).toString(16).replace(/^([\da-f])$/,"0$1");  
        }  
          
        return a.join('');  
    }  

    // $( "#btn122" ).click(function() {
    //     const $passpla = $("input[name='senha']").val();
    //     $("input[name='senha']").val(bin2hex(passpla));
    // });



    function validatePass(senhau) {
            if (senhau === "") {
            return true;
            } else {
        const re = /^(?=.{6,})(?=.*[a-z])(?=.*[0-9])/;
        return re.test(senhau);
            }
    }

    function validate2() {
        const $result = $("#resultpss");
        const $result2 = $("#btnpass");
        const senhau = $("#btnpass").val();
        //$result.text("");

        if (validatePass(senhau)) {
            $result2.removeClass("is-invalid");
            $result.css("display", "none");
            return true;
        } else {
            $result2.addClass("is-invalid");
            $result.css("display", "block");
            return false;
        }

    }


        

    function validateEmail(email) {
            if (email === "") {
            return true;
            } else {
        const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
            }
    }

    function validate() {
        const $result = $("#result");
        const $result2 = $("#validate");
        const email = $("#validate").val();
        //$result.text("");

        if (validateEmail(email)) {
            $result2.removeClass("is-invalid");
            $result.css("display", "none");
            return true;
        } else {
            $result2.addClass("is-invalid");
            $result.css("display", "block");
            return false;
        }
    
    }



    $("input.telefone").mask("(99) 99999-999?9").focusout(function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if(phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-999?9");
            }
    });



    $( "#bt34" ).click(function() {
        $('.heidi').animate({  height: "15%"}, {  duration: "slow"});
        $('#container2').animate({  height: "toggle",  opacity: "toggle"}, {  duration: "slow"});

        $('#container1').animate({  height: "toggle",  opacity: "toggle"}, {  duration: "slow"});

    });

    $( "#btn642" ).click(function() {
        $('.heidi').animate({  height: "20%"}, {  duration: "slow"});
        $('#container2').animate({  height: "toggle", opacity: "toggle"}, {  duration: "slow"});

        $('#container1').animate({  height: "toggle",  opacity: "toggle"}, {  duration: "slow"});

    });

    $( ".form-group" ).keypress(function() {
    
        var progresso = 0;

        //$("#validate").on("change", validate);

        if ($('#nomeform').val() != "") {
            progresso = progresso + 1 ;
        }

        if ($('#setorform').val() != "") {
            progresso = progresso + 1 ;
        }

        if ($('#telefoneform').val() != "") {
            progresso = progresso + 1 ;
        }

        if ($('#validate').val() != "") {
            if (validate() == true) {
                progresso = progresso + 1 ;
            }
        }

        if ($('#btnpass').val() != "") {
            if (validate2() == true) {
                progresso = progresso + 1 ;
            }
        } 

        if (progresso == 0) {
            $('.progress-bar').css('width', '0%');
            $('#btn122').prop('disabled', true);
        }
        if (progresso == 1) {
            $('.progress-bar').css('width', '20%');
            $('#btn122').prop('disabled', true);
        } 
        if (progresso == 2) {
            $('.progress-bar').css('width', '40%');
            $('#btn122').prop('disabled', true);
        } 
        if (progresso == 3) {
            $('.progress-bar').css('width', '60%');
            $('#btn122').prop('disabled', true);
        } 
        if (progresso == 4) {
            $('.progress-bar').css('width', '80%');
            $('#btn122').prop('disabled', true);
        } 
        if (progresso == 5) {
            $('.progress-bar').css('width', '100%');
            $('#btn122').prop('disabled', false);
        } 

    });


});

$("#btnpass").hover(
    function () {
       
        const arrow = document.querySelector('#arrow');
        const popcorn = document.querySelector('#btnpass');
        const tooltip = document.querySelector('#tooltip');
    
        $('#tooltip').show();
    
    Popper.createPopper(popcorn, tooltip, {
      placement: 'right',
      modifiers: [
        {
          name: 'arrow',
          options: {
            element: arrow,
          },
        },
      ],
    
    });

    },
    function () {
        $('#tooltip').hide();
    }



);

function para(valor) {
    window.location.href = valor;
};

$(window).resize(function() {
    var width = $(window).width();
      $("#separa").width(width * 0.8);
  });

function alterarpass() {
    var codnome = $("#codigo").val();
    var codemail = $("#InputEmail1").val();
    var codsenha = $("#senha1").val();
    var process = "changePass";

    $.ajax({
        type: "POST",
        url: "login.php",
        dataType: 'text',
        data: {"process": process, "codnome": codnome, "codemail": codemail, "codsenha": codsenha},
        success: function(resultFIM) {
            if (resultFIM == "success") {
                // if ajax.php returns success, redirect to homepage or whatever
                $("#retornoalert").html("Senha alterada com <strong>sucesso</strong>!");
                $(':input').val("");
                $("#retornoalert2").addClass("show");

            } else {
                // if ajax.php returns failure, display error
                $("#retornoalert").html("<strong>Error</strong> no login!<br>" + resultFIM);
                $("#retornoalert2").addClass("show");
            }   
        },
        error: function(jqXHR, textStatus, errorThrown, resultFIM) {
            // error handling
        },
    });


}