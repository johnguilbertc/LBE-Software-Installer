(function($, cs){

    $("div.option input:checkbox").on("click", function(e){
        $(this).parent().find(".option_sub").toggle("medium");
    });

    $("div.options input#__clean_slate_submit").on("click", function(e){
        if(!validateSubOptions()){
            e.preventDefault();
            return false;
        }
        $("#loading").show();
        return true;
    });

    function validateSubOptions(){
        var allGood = true;
        if($("input[type=checkbox]:checked").length == 0){
            alert(cs.i18n.selectOneMsg);
            return false;
        }

        $(".option_sub:visible").each(function(){
            $(this).find("input, textarea").each(function(){
                if($(this).val().length == 0){
                    var name    = $(this).parent().find("label").length > 0 ? $(this).parent().find("label").html() : $(this).attr("placeholder");
                    alert(cs.i18n.noSubOptionsMsg + (name.length > 0 ? (" : " + name) : ""));
                    $(this).focus();
                    allGood = false;
                    return false;
                }
            });
            if(!allGood) return false;
        });
        return allGood;
    }

    $(window).load(function(){
        $("#loading").hide();
    });

})(jQuery, cs);
