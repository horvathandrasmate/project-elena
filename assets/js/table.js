$(document).ready(function () {
    $("#search").keyup(function () {
        var value = this.value;

        $('#table').find('tr').each(function () {
            $(this).find("td").each(function (i, item) {
                //do your task here
                console.log(item.innerText);
                if(){

                }
            });
        });
    });
});