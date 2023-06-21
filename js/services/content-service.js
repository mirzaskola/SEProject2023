var ContentService = {
    init: function(){
        ContentService.get_all_content();
    },
    get_all_content: function () {
        $.ajax({
            url: "api/content/toprated",
            type: "GET",
            success: function (data) {
                $("#top-rated").html("");
                var html = "";
                for (let i = 0; i < 6; i++) {
                    html += `
                        <div class="col-lg-4 mt-4">
                        <div class="box text-start shadow">
                            <h4 class="text-center">`+ data[i].title + `</h4>
                            <div class="img-box">
                                <img src="./`+ data[i].cover_image + `" alt="img" class="img-fluid">
                                <div class="start">
                                    <div class="star_inner">
                                        <img src="images/star.png" alt="img" class="img-fluid">
                                        <span class="d-inline-block">`+ parseInt(data[i].total_rating) + `%</span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary view-game-details" onclick="GameService.get(`+ data[i].id + `)">
                                    View details
                                </button>
                            </div>
                        </div>
                    </div>
                        `;

                }
                $("#top-rated").html(html);
            }
        });
    }
}