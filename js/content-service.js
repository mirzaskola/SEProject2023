var ContentService = {

    init: function () {
        ContentService.get_highest_rated();
    },

    get_highest_rated: function () {
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
                            <img src="client/`+ data[i].cover_image + `" alt="img" class="rounded mx-auto d-block" style = "width: 250px; height: 250px;">
                            <div class="start">
                                <div class="star_inner">
                                    <img src="client/images/star.png" alt="img" class="img-fluid">
                                    <span class="d-inline-block">`+ parseInt(5/*data[i].total_rating*/) + `%</span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary view-game-details" onclick="ContentService.get_content_details_by_id(`+ data[i].id + `)">
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
    },
    get_content_details_by_id: function (id) {
        $(".view-game-details").attr('disabled', true);

        $.ajax({
            url: 'api/content/'+id,
            type: "GET",
            success: function (data) {
                $("#game_title").html("");
                $("#game_title").html(`
                <p class=" modal-title fs-4"> Details about ` + data.title + ` </p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              `);

                $('#viewGameDetailsForm input[name="id"]').val(data.id);
                $('#viewGameDetailsForm input[name="name"]').val(data.name);
                $('#viewGameDetailsForm input[name="category_name"]').val(data.category_name);
                $('#viewGameDetailsForm textarea[name="description"]').val(data.description);


                $("#review-modal").html("");
                $("#review-modal").html(`<p class="fs-4"> Leave a review for ` + data.name + ` </p>`);
                $('#reviewGameForm input[name="game_id"]').val(data.id);
                GameService.get_reviews_for_game(id);
                $(".view-game-details").attr('disabled', false);
                $('#viewGameDetailsModal').modal("show");
                
            }
        });
    },
}