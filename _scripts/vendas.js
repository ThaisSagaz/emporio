$(function(){
    $("#button1").click(function(){
        $("#list1 > option:selected").each(function(){
            $(this).remove().appendTo("#list2");
        });
    });
        
    $("#button2").click(function(){
        $("#list2 > option:selected").each(function(){
            $(this).remove().appendTo("#list1");
        });
    });
});