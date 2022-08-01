$(document).ready(function(){
    like();
});

function like ()
{
    $(document).on('click', '.lc__cmt-like', function(){
        var id = $(this).data('id');
        var likeStatus = localStorage.getItem(id);

        if(likeStatus != 'liked'){
            $('.total-like-'+id).show();
            var totalLike = $('.total-like-'+id).data('like');
            var increaseLike = parseInt(totalLike) + 1;
            var likeHtml = increaseLike.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            $('.total-like-'+id).text('('+ likeHtml +')');
            $('.icon-like-'+id).show();

            $.ajax({
                url : "/like/comment",
                type : "POST",
                data : {
                    id : id
                },
                success : function(response)
                {
                    localStorage.setItem(id, 'liked');
                }
            });
        }
    });
}