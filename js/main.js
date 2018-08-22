/**
 * Created by Administrator on 2018-08-22.
 */
function sendQuestion() {
    var que = $("#question").val();
    if(que != ''){
        $(".contnet-a").text(null);
        $(".contnet-a").text(que);
    }
    $.post("request.php", { question: $("#question").val()},
        function(data){
            if(data.code ===1){
                $(".contnet-q").text(null);
                $(".contnet-q").text(data.data);
            }
        },'json');
}
function reset() {
    $("#question").val(null);
}
$(document).keydown(function(event){
    if(event.keyCode === 13){
        sendQuestion();
    }
});