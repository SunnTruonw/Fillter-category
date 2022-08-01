function activeMenuFilter (type, text)
{
    $('.filter-reviews').removeClass('active');
    $('.label-filter-review').text(text);
    if(type == 'moi-nhat'){
        $('#descReview').addClass('active');
        $('#descReviewMb').addClass('active');
    }
    if(type == 'cu-nhat'){
        $('#ascReview').addClass('active');
        $('#ascReviewMb').addClass('active');
    }
    if(type == 'huu-ich-nhat'){
        $('#helpfulReview').addClass('active');
        $('#helpfulReviewMb').addClass('active');
    }
}

function filterReviews ()
{
    $('.filter-reviews').click(function(){
        var type = $(this).data('type');
        var text = $(this).data('text');

        $('.dropdown-menu').removeClass('open');
        activeMenuFilter(type, text);
        $('#sortTypeReviews').val(type);

        $.ajax({
            url : "/filter/reviews",
            type : "GET",
            data : {
                productId : $('#productId').val(),
                type : type,
                page : 1
            },
            success : function(response)
            {
                ga('send', 'event', 'Product Detail Page', 'Click ÄĂ¡nh giĂ¡', 'Sort : '+text, {'nonInteraction': 1});
                $('.new-page-reviews').html('');
                $('#pageReview').val(2);

                $('#countLoadMoreRv').val(response.totalItems);
                var countLoadMoreRv = $('#countLoadMoreRv').val();//-5
                var countLoadMore = parseInt(countLoadMoreRv) - 5;
                $('#countLoadMoreRv').val(countLoadMore);
                if(countLoadMore >= 5){
                    var countLoadMore = 5;
                }
                $('.count-load-more-rv').text(countLoadMore);

                $('#listReview').html(response.data);
                $('#loadMoreReview').show();
                if(response.totalItems < 6){
                    $('#loadMoreReview').hide();
                }
            }
        });
    });
}

function loadMoreReviews ()
{
    $('.load-more-reviews').click(function(){
        var page = $('#pageReview').val();
        var type = $('#sortTypeReviews').val();
        if(page == ''){
            var page = 2;
        }
        if(type == ''){
            var type = 'moi-nhat';
        }

        $.ajax({
            url : "/filter/reviews",
            type : "GET",
            data : {
                productId : $('#productId').val(),
                type : type,
                page : page
            },
            success : function(response)
            {
                ga('send', 'event', 'Product Detail Page', 'Click ÄĂ¡nh giĂ¡', 'Xem thĂªm : Page '+page, {'nonInteraction': 1});
                $('#pageReview').val(parseInt(page) + 1);

                var countLoadMoreRv = $('#countLoadMoreRv').val();
                var countLoadMore = parseInt(countLoadMoreRv) - 5;
                $('#countLoadMoreRv').val(countLoadMore);
                if(countLoadMore >= 5){
                    var countLoadMore = 5;
                }
                $('.count-load-more-rv').text(countLoadMore);

                $('.new-page-reviews').append(response.data);
                if(parseInt(page) == response.totalPage){
                    $('#loadMoreReview').hide();
                }
            }
        });
    });
}

$(document).ready(function(){
    filterReviews();
    loadMoreReviews();
});