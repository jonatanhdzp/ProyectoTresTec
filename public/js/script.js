$(document).ready(function () {
    setTimeout(function () { // Desaparecer alertas con esta clase
        $(".auto-dismiss").fadeOut("slow", function () {
            $(this).remove();
        });
    }, 7500); // 7.5 segundos
});