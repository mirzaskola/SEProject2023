const SecurityService = {
  
    redirectToLogin: function () {
        $("#ModalReview").modal("show");
        let reviewForm = document.getElementById("reviewContentForm");
        reviewForm.addEventListener("submit", (e) => {
            e.preventDefault();
            let review = {
                contentTitle: $('#contentTitle').val(),
                contentId: $('#contentId').val(),
                ratingValue: $('#ratingRange').val(),
                comment: $('#reviewComment').val()

            }
            ReviewService.leaveReview(review);
            
          });
        
        // var token = localStorage.getItem("token");
        // if (token == null || token == undefined) {
        //     window.location.replace("login.html");
        // }
        // else {
        //     $("#ModalReview").modal("show");
        // }
    }
  }
  