function getTotalDeposits() {
    let url = $("#get-deposits-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total-deposits').text(res.total);
            $('.completed-deposits').text(res.completed);
            $('.pending-deposits').text(res.pending);
            $('.rejected-deposits').text(res.rejected);
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalProducts() {
    let url = $("#get-products-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total').text(res.total);
            $('.quantity').text(res.quantity);
            $('#loading').addClass('d-none');
        },
    })
}

function getTotalProducts() {
    let url = $("#get-products-url").val();
    $.ajax({
        type: 'GET',
        url: url,
        success: function(res){
            $('.total').text(res.total);
            $('.amount').text(res.quantity);
            $('#loading').addClass('d-none');
        },
    })
}
