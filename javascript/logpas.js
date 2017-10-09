
$(document).ready()
{
    function Aj1() {
        $.ajax({
            url: "ajax_json/capcha.php",
            type: "POST",
            data: {rend: 1},
            dataType: "json",
            success: funA
        });
    }

    function funA(data) {
        var q=JSON.parse(data);
        $('#cp').attr({value: q});
        var atrImg = "background: url(picture/"+q+".jpg)" +
            " no-repeat; background-size: 100% 50px;";
        $('#img').attr({style: atrImg});
    }

    Aj1();
    cpEn();

    $('.sm').bind('click',cpClose);
    $('#capcha').keyup(cpw);

    function cpw() {
        // cpEn();
        if( $('#capcha').val()===$('#cpen').val() ){
            $('#capcha').attr({style: "-webkit-box-shadow: 0px 0px 5px 2px rgba(34,205,4,1); " +
            "box-shadow: 0px 0px 5px 2px rgba(34,205,4,1);"});
            $('#but').attr({type: "submit"});}
        else {
            $('#capcha').attr({style: "-webkit-box-shadow: 0px 0px 0px -200px rgba(34,205,4,1); " +
            "box-shadow: 0px 0px 0px -200px rgba(34,205,4,1);"});
            $('#but').attr({type: "button"});
        }
    }

    function cpClose() {
        $('#capcha').attr({style: "-webkit-box-shadow: 0px 0px 7px 0px rgba(255,0,0,1); " +
        "box-shadow: 0px 0px 7px 0px rgba(255,0,0,1);"});
    }

    function cpEn() {
        $.ajax({
            url: "ajax_json/capcha.php",
            type: "POST",
            data: {name: 3},
            dataType: "json",
            success: funSuccess
        });
    }

    function funSuccess(data) {
        var ss = ($('#cp').val());
        $('#cpen').attr({value: data[ss]});
    }
}
/**
 * Created by CoolerBy on 22.06.2017.
 */
