var OfferService = {
    init: function(){
        OfferService.get_all_content();
    },
    get_all_content: function () {
        $.ajax({
            url: "rest-api/content",
            type: "GET",            
            success: function (data) {
                $("#content-rows").html("");
                var tableBodyHtml = "";
                for (let i = 0; i < data.length; i++) {
                    tableBodyHtml += `
                        <tr>
                            <td>`+ data[i].title + `</td>
                            <td>`+ data[i].genre + `</td>
                            <td>`+ data[i].average_rating + `</td>
                            <td>`+ data[i].release_date + `</td>
                        </tr>`;
                }
                $("#content-rows").html(tableBodyHtml);
            }
        });
    },
}