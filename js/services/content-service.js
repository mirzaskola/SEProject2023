const ContentService = {
    init: function () {
        $('#search-form').validate({
            submitHandler: function (form) {
                var searchInput = Object.fromEntries((new FormData(form)).entries());
                console.log(searchInput.search);
                ContentService.getMovieBySearch(searchInput.search);
            }
        });
        $('#search-form-shows').validate({
            submitHandler: function (form) {
                var searchInput = Object.fromEntries((new FormData(form)).entries());
                console.log(searchInput.search);
                ContentService.getTvShowBySearch(searchInput.search);
            }
        });
    },
    getAllContent: function () {
        $.ajax({
            url: 'api/content/toprated',
            type: 'GET',
            success: function (data) {
                $('#top-rated').html('')
                let html = ''
                for (let i = 0; i < 6; i++) {
                    html += `
                        <div class="col-lg-4 mt-4">
                        <div class="box text-start shadow">
                            <h4 class="text-center">` + data[i].title + `</h4>
                            <div class="img-box">
                                <img src="./` + data[i].cover_image + `" alt="img" class="img-fluid">
                                <div class="start">
                                    <div class="star_inner">
                                        <img src="images/star.png" alt="img" class="img-fluid">
                                        <span class="d-inline-block">` + parseInt(data[i].rating) + `</span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary view-game-details" onclick="ContentService.getContentById(` + data[i].id + `)">
                                    View details
                                </button>
                            </div>
                        </div>
                    </div>
                        `
                }
                $('#top-rated').html(html)
            }
        })
    },
    getContentById: function (id) {
        $('.view-game-details').attr('disabled', true)

        $.ajax({
            url: 'api/content/' + id,
            type: 'GET',
            success: function (data) {
                console.log(data);
                $('#contentModalTitleHeader').html('')
                $('#contentModalTitleHeader').html(`
                <p class=" modal-title fs-4"> Details about ` + data.title + ` </p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              `)

                $('#viewContentDetailsForm input[name="id"]').val(data.id)
                $('#viewContentDetailsForm textarea[name="description"]').val(data.description)
                $('#contentGenres').html('')
                let html = ''
                for (let i = 0; i < data.genres.length; i++) {
                    html += `<span class="badge bg-secondary-subtle border border-secondary-subtle text-secondary-emphasis rounded-pill">` + data.genres[i] + `</span>`
                }
                $('#contentGenres').html(html)
                $('#viewContentDetailsForm input[name="release-date"]').val(data.release_date)
                $('#viewContentDetailsForm input[name="duration"]').val(data.duration)
                if (data.content_type_id === '1') {
                    $('#tvshow-seasons').removeAttr("hidden")
                    $('#viewContentDetailsForm input[name="seasons"]').val(5)
                }
                if (data.content_type_id === '0') $('#tvshow-seasons').attr("hidden", true)
                ContentService.getReviewsForGame(data.comments);
                $('#review-modal').html('')
                $('#review-modal').html('<p class="fs-4"> Leave a review for ' + data.title + ' </p>')

                $('#contentTitle').val(data.title)
                $('#contentId').val(data.id)

                $('.view-game-details').attr('disabled', false)
                $('#viewContentDetailsModal').modal('show')
            }
        })
    },
    getAllMovies: function () {
        $.ajax({
            url: 'api/content/type/0',
            type: 'GET',
            success: function (data) {
                $('#movie-list').html('')
                let html = ''
                for (let i = 0; i < data.length; i++) {
                    html += `
                    <!-- single item start -->
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 mb-3">
                        <div class="box text-start shadow">
                            <h4 class="text-center">` + data[i].title + `</h4>
                            <div class="text-center">
                                <img src="./` + data[i].cover_image + `" alt="img" class="img-fluid rounded"> 
                            </div>
                            <br>
                            <div class="row justify-content-center">                                        
                                <div class="col-md">
                                    <div class="text-center">
                                        <p class="text-sm-center">
                                        </p>
                                    </div>                                            
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <!-- Button trigger modal -->
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary view-game-details" onclick="ContentService.getContentById(` + data[i].id + `)">
                                            View details
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- single item end -->
                        `
                }
                $('#movie-list').html(html)
            }
        })
    },
    getAllTvShows: function () {
        $.ajax({
            url: 'api/content/type/1',
            type: 'GET',
            success: function (data) {
                $('#tvshow-list').html('')
                let html = ''
                for (let i = 0; i < data.length; i++) {
                    html += `
                    <!-- single item start -->
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 mb-3">
                        <div class="box text-start shadow">
                            <h4 class="text-center">` + data[i].title + `</h4>
                            <div class="text-center">
                                <img src="./` + data[i].cover_image + `" alt="img" class="img-fluid rounded"> 
                            </div>
                            <br>
                            <div class="row justify-content-center">                                        
                                <div class="col-md">
                                    <div class="text-center">
                                        <p class="text-sm-center">
                                        </p>
                                    </div>                                            
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <!-- Button trigger modal -->
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary view-game-details" onclick="ContentService.getContentById(` + data[i].id + `)">
                                            View details
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- single item end -->
                        `
                }
                $('#tvshow-list').html(html)
            }
        })
    },
    getMovieBySearch: function (input) {
        let data = {
            searchInput: input,
            contentType: 0
        };
        $.ajax({
            url: 'api/content/search',
            type: 'POST',
            data: JSON.stringify(data),
            dataType: 'json',
            contentType: 'application/json',
            success: function (data) {
                console.log('Result' + JSON.stringify(data));
                $("#movie-list").html("");
                var html = "";
                if (data.length < 1) {
                    html += `<h2 class="text-center">Movie not found</h2>`;
                }
                for (let i = 0; i < data.length; i++) {
                    html += `
                <!-- single item start -->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 mb-3">
                    <div class="box text-start shadow">
                        <h4 class="text-center">`+ data[i].title + `</h4>
                        <div class="text-center">
                            <img src="./`+ data[i].cover_image + `" alt="img" class="img-fluid rounded"> 
                        </div>
                        <br>
                        <div class="row justify-content-center">                                        
                            <div class="col-md">
                                <div class="text-center">
                                    <p class="text-sm-center">
                                        
                                    </p>
                                </div>                                            
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary view-game-details" onclick="ContentService.getContentById(`+ data[i].id + `)">
                                        View details
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- single item end -->
                    `;

                }
                $("#movie-list").html(html);

            }
        });
    },
    getTvShowBySearch: function (input) {
        let data = {
            searchInput: input,
            contentType: 1
        };
        $.ajax({
            url: 'api/content/search',
            type: 'POST',
            data: JSON.stringify(data),
            dataType: 'json',
            contentType: 'application/json',
            success: function (data) {
                $("#tvshow-list").html("");
                var html = "";
                if (data.length < 1) {
                    html += `<h2 class="text-center">Show not found</h2>`;
                }
                for (let i = 0; i < data.length; i++) {
                    html += `
                <!-- single item start -->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 mb-3">
                    <div class="box text-start shadow">
                        <h4 class="text-center">`+ data[i].title + `</h4>
                        <div class="text-center">
                            <img src="./`+ data[i].cover_image + `" alt="img" class="img-fluid rounded"> 
                        </div>
                        <br>
                        <div class="row justify-content-center">                                        
                            <div class="col-md">
                                <div class="text-center">
                                    <p class="text-sm-center">
                                        
                                    </p>
                                </div>                                            
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary view-game-details" onclick="ContentService.getContentById(`+ data[i].id + `)">
                                        View details
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- single item end -->
                    `;

                }
                $("#tvshow-list").html(html);

            }
        });
    },
    getReviewsForGame: function (data) {
        $("#review-list").html("");
        var html = `<h5 class="border-bottom pb-2 mb-0">Reviews</h5> `;
        if (data.length < 1) {
            html = ``;
            html += `<h2 class="text-center">No reviews for this title</h2>`;
        }
        for (let i = 0; i < data.length; i++) {
            html += `
                    <!-- single review start -->
                    <div class="d-flex text-muted pt-3">
                        <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
                
                        <p class="pb-3 mb-0 small lh-sm border-bottom">
                            <span class="d-block"><strong class="text-gray-dark">@`+ data[i].username + `</strong> ` + parseInt(data[i].rating) + `</i></span></span>
                            
                            `+ data[i].comment + `
                        </p>
                    </div>
                    <!-- single review end -->
                    `;

        }
        $("#review-list").html(html);
    },
    
}
