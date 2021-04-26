var d = new Date();

var month = d.getMonth()+1;
var day = d.getDate();
var hour = d.getHours();

var output = d.getFullYear() + '/' +
    (month<10 ? '0' : '') + month + '/' +
    (day<10 ? '0' : '') + day;

var gantt = $("#ganttescala").this;
var comeco = '<table class="tg">';
var colum = '<th class="tg-0pky">';
var fimcolum = '</th>';
var linh = '<tr>';
var fimlin = '<tr>';
var fim = '</table>';
var cabe = '<thead>';
var fimcabe = '</thead>';
var corpo = '<tbody>';
var fimcorpo = '</tbody>';

for (var index = day; index < day + 10; index++){
    const element = arvar[index];
}

gantt.html();