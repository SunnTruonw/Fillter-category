function activeFilter (type, text)
{
    $('.filter-comments').removeClass('active')
    $('#'+type).addClass('active');
    $('#'+type+'Mb').addClass('active');
    $('.label-filter-comments').text(text);
    $('#typeFilterComment').val(type);
}
function filterComments ()
{
    $('.filter-comments').click(function(){
        var type = $(this).data('type');
        var text = $(this).data('text');

        console.log($('#pageName').val());
        $('.dropdown-menu').removeClass('open');
        activeFilter(type, text);

        $.ajax({
            url : "/filter/comments",
            type : "GET",
            data : {
                productId : $('#productId').val(),
                pageName : $('#pageName').val(),
                type : type,
                page : 1
            },
            success : function(response)
            {
                ga('send', 'event', 'Product Detail Page', 'Click BĂ¬nh luáº­n', 'Sort : '+text, {'nonInteraction': 1});
                $('#commentList').html(response.data);
                $('#newPageComments').html('');

                $('#countLoadMoreCm').val(response.totalItems);
                var countLoadMoreCm = $('#countLoadMoreCm').val();
                var countLoadMoreHtml = parseInt(countLoadMoreCm) - 5;
                $('#countLoadMoreCm').val(countLoadMoreHtml);
                if(countLoadMoreHtml >= 5){
                    var countLoadMoreHtml = 5;
                }
                $('.count-load-more-cm').text(countLoadMoreHtml);

                $('#pageComment').val(2);
                if(response.totalPage > 1){
                    $('#lcViewMoreCm').show();
                }else{
                    $('#lcViewMoreCm').hide();
                }
            }
        });
    });
}
function loadMoreComments ()
{
    $('.loadMoreComments').click(function(){
        var page = $('#pageComment').val();
        var type = $('#typeFilterComment').val();
        if(type == '' || typeof type == 'undefined'){
            var type = 'desc';
        }
        if(page == '' || typeof page == 'undefined'){
            var page = 2;
        }

        $.ajax({
            url : "/filter/comments",
            type : "GET",
            data : {
                productId : $('#productId').val(),
                pageName : $('#pageName').val(),
                type : type,
                page : page
            },
            success : function(response)
            {
                ga('send', 'event', 'Product Detail Page', 'Click BĂ¬nh luáº­n', 'Xem thĂªm : Page '+page, {'nonInteraction': 1});
                $('#newPageComments').append(response.data);
                $('#pageComment').val(parseInt(page) + 1);

                var countLoadMoreCm = $('#countLoadMoreCm').val();//10
                var countLoadMore = parseInt(countLoadMoreCm) - 5;
                $('#countLoadMoreCm').val(countLoadMore);
                if(countLoadMore >= 5){
                    var countLoadMore = 5;
                }
                $('.count-load-more-cm').text(countLoadMore);

                if(parseInt(page) == response.totalPage){
                    $('#lcViewMoreCm').hide();
                }
            }
        });
    });
}
function loadMoreReply ()
{
    $(document).on('click', '#btnLoadMoreReply', function(){
        var id = $(this).data('id');
        var page = $('#pageComment'+id).val();
        var type = $(this).data('type');
        console.log(type);
        $.ajax({
            url : "/load-more-reply",
            type : "GET",
            data : {
                id : id,
                type : type,
                page : page
            },
            success : function(response)
            {
                console.log(response);
                $('.feedback-'+response.commentId+ ' .item-feed:last').before(response.data);
                $('#pageComment'+id).val(response.nextPage);
                if(parseInt(response.nextPage) - 1 == response.lastPage){
                    $('.btn-load-more-'+response.commentId).hide();
                }
            }
        });
    });
}
$(document).ready(function(){
    filterComments();
    loadMoreComments();
    loadMoreReply();
});