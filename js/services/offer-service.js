var OfferService = {
  init: function () {
    OfferService.get_all_offers()
  },

  get_all_offers: function () {
    $.ajax({
      url: 'api/offer',
      type: 'GET',
      success: function (data) {
        $('#offerBody').html('')
        let offerBodyHtml = ''
        for (let i = 0; i < data.length; i++) {
          if (data[i].is_active === 1) {
            offerBodyHtml += `
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-2">
                                <div class="item">
                                    <h4>` + data[i].game_name + `</h4>
                                    <p>For our members only ` + data[i].price + `</p>
                                    <a href="">Buy on ` + data[i].link + `</a>
                                </div>
                            </div>
                        `
          }
        }
        $('#offerHeader').html('<h2>Special Offers From Our Partners</h2>')
        $('#offerBody').html(offerBodyHtml)

        if (data.length === 0) {
          $('#offerHeader').html('<h2>Currently there are no special offers from our partners</h2>')
        }
      }
    })
  }

}
