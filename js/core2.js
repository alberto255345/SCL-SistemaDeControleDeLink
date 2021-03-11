


$(document).ready(function(){

    $('select').formSelect();

  $("#buttonv2").click(function() {
    cadastroOS();
  });

$('.meucampo').change(function () { 
    this.value = this.value.replace(/[^0-9]/,'');
});

    function cadastroOS() {
      
        var data = $("#form1").formToJson();
        data = JSON.stringify(data);
        var data1 = $("#form2").formToJson();
        data1 = JSON.stringify(data1);
        var data2 = $("#form3").formToJson();
        data2 = JSON.stringify(data2);

        //$("#loginButton").html('Login');
        $.ajax({
              type: "POST",
              url: "dadoscadastro.php",
              dataType: 'text',
              data: {"data": data, "data1": data1, "data2": data2},
              success: function(resultFIM) {
                if (resultFIM == "success") {


                } else {
                
                }
            },
            error: function(jqXHR, textStatus, errorThrown, resultFIM) {
                // error handling
            },
        });

    }
});

