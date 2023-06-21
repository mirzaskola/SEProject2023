const ReviewService = {
    leaveReview: function (review) {
        $.ajax({
            url: 'api/rating',
            type: 'POST',
            data: JSON.stringify(review),
            dataType: 'json',
            contentType: 'application/json',
            success: function () {
                location.reload(); 
            }
        });
    }
}