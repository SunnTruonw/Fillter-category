const PRODUCT_ID = $('#productId').val();
const MODAL_CLASS = 'modal--is-visible';
const DISABLE_SCROLL = 'disable-scroll';
const TOKEN = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

var previousScrollY = 0;
function disableScroll ()
{
    previousScrollY = window.scrollY;
    $('html').css({
        marginTop: -previousScrollY,
    }).addClass('disable-scroll-safari');
}
function enableScroll ()
{
    $('html').css({
        marginTop: 0,
    }).removeClass('disable-scroll-safari');
    window.scrollTo(0, previousScrollY);
    // $(document).click(function (e) {
    //     if ($('.modal').is(e.target) && $('.modal').has(e.target).length === 0) {
    //         $('html').css({
    //             marginTop: 0,
    //         }).removeClass('disable-scroll-safari');
    //       window.scrollTo(0, previousScrollY);
    //     }
    // });
}
var removeChar = function (strInput) {
    return strInput.replace(/(<([^>]+)>)/ig, "").replace(/!|@|\$|%|\^|\*|\(|\#|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'||\"|\&|\#|\[|\]|~/g, "");
}

function checkedRadioComment ()
{
    $(document).on('click', '.xung-ho', function(){
        $(this).find('input').prop('checked', true);
    });
    $(document).on('click', '.danh-xung-reply-comment', function(){
        $(this).find('input').prop('checked', true);
        var danhXung = $("input[name='danhXungReplyComment']:checked").val();
    });
}
function openModal (mode = false)
{
    if(mode == 'create'){
        $(document).on('click', '#openModalCreateComment', function(){

            var totalComments = parseInt($('#totalComments').val());
            if($(window).width() < 992 && totalComments < 1){
                $('.area-comment-mobile').show();
            }else{
                $('.area-comment-mobile').hide();
            }

            var content = removeChar($("textarea[name='contentComment']").val());
            $('#errorContentComment').hide();
            $('#modalCreateComment').parent().removeClass('is-invalid');
            if(content == '' || content.length < 3 || content.replace(/\s/g, '').length < 3){
                $('#modalCreateComment').removeClass(MODAL_CLASS);
                $('#contentComment').parent().addClass('is-invalid');
                $('#errorContentComment').css('display','inline-flex');
                return false;
            }
            $('#modalCreateComment').addClass(MODAL_CLASS);
            // $('html').addClass(DISABLE_SCROLL);
            disableScroll();
        });
        $(document).on('click', '#openModalCreateCommentBlockNone', function(){
            var content = $("textarea[name='contentComment']").val();
            $('#errorContentComment').hide();
            // if(content == '' || content.length < 3){
            //     $('#errorContentComment').css('display','inline-flex')
            //     return false;
            // }
            $('#modalCreateComment').addClass(MODAL_CLASS);
            // $('html').addClass(DISABLE_SCROLL);
            disableScroll();
        });
        $(document).on('click', '#openModalCreateReviewBlockNone', function(){
            // $('html').addClass(DISABLE_SCROLL);
            disableScroll();
        });
    }
    if(mode == 'success'){
        $('#commentSuccess').addClass(MODAL_CLASS);
        // $('html').addClass(DISABLE_SCROLL);
        // disableScroll();
        // enableScroll();
    }
}
function openModalReplyComment ()
{
    $(document).on('click', '.open-modal-reply-comment', function(){
        $('#modalReplyComment').addClass(MODAL_CLASS);
        // $('html').addClass(DISABLE_SCROLL);
        disableScroll();
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#replyNameComment').text(name);
        $('#replyIdComment').val(id);
    });
}
// function closeModal ()
// {
//     $(document).on('click', '.close-modal-create-comment', function(){
//         $('#modalCreateComment').removeClass(MODAL_CLASS);
//         // $('html').removeClass(DISABLE_SCROLL);
//         enableScroll();
//     });
//     $(document).on('click', '.close-modal-success-comment', function(){
//         $('#commentSuccess').removeClass(MODAL_CLASS);
//         // $('html').removeClass(DISABLE_SCROLL);
//         enableScroll();
//     });
//     $(document).on('click', '.close-modal-reply-comment', function(){
//         $('#modalReplyComment').removeClass(MODAL_CLASS);
//         // $('html').removeClass(DISABLE_SCROLL);
//         enableScroll();
//     });
// }
function clearInputComment ()
{
    $('#replyIdComment').val('');
    $("input[name='danhXungReplyComment']:checked").prop('checked', false);
    $('.danh-xung-reply-comment').removeClass('checked');
    $("input[name='nameReplyComment']").val('');
    $("input[name='phoneReplyComment']").val('');
    $("input[name='emailReplyComment']").val('');
    $("textarea[name='contentReplyComment']").val('');
    $("textarea[name='contentCreateCommentMb']").val('');

    $("input[name='danhXungComment']:checked").prop('checked', false);
    $('.danh-xung-comment').removeClass('checked');
    $("input[name='nameComment']").val('');
    $("input[name='phoneComment']").val('');
    $("input[name='emailComment']").val('');
    $("textarea[name='contentComment']").val('');
}
function validateCreateComment (danhXung, name, phone, email)
{
    if(typeof danhXung == 'undefined'){
        $('#errorDanhXungComment').show();
        $('.check-form-create-comment').addClass('is-invalid');
        var errorDanhXungComment = false;
    }else{
        $('#errorDanhXungComment').hide();
        $('.check-form-create-comment').removeClass('is-invalid');
    }

    if(name == '' || name.replace(/\s/g, '').length < 1 || removeChar(name) == ''){
        $('#errorNameComment').show();
        $('#nameComment').parent().addClass('is-invalid');
        var errorNameComment = false;
    }else{
        $('#errorNameComment').hide();
    }

    if(phone == '' || phone.replace(/\s/g, '').length < 1){
        $('#errorPhoneComment').show();
        $('#phoneComment').parent().addClass('is-invalid');
        var errorPhoneComment = false;
    }else{
        if(phone.length < 10 || phone.length > 11 || !$.isNumeric(phone) || phonenumber(phone) == false){
            $('.text-phone-error-comment').text('Sá»‘ Ä‘iá»‡n thoáº¡i khĂ´ng há»£p lá»‡');
            $('#errorPhoneComment').show();
            $('#phoneComment').parent().addClass('is-invalid');
            var errorPhoneComment = false;
        }else{
            $('#errorPhoneComment').hide();
        }
    }

    if(email != '' || email.length > 0 || email.replace(/\s/g, '').length > 0 || removeChar(email) != ''){
        if(isEmail(email) == false){
            $('#errorEmailComment').show();
            return false;
        }else{
            $('#errorEmailComment').hide();
        }
    }else{
        $('#errorEmailComment').hide();
    }

    //validate textarea mobile
    var totalComments = parseInt($('#totalComments').val());
    if($(window).width() < 992 && totalComments < 1){
        var contentMb = removeChar($('#contentCreateCommentMb').val());
        if(contentMb == '' || contentMb.replace(/\s/g, '').length < 3){
            $('#errorContentCreateCommentMb').show();
            $('#contentCreateCommentMb').parent().addClass('is-invalid');
            return false;
        }else{
            $('#errorContentCreateCommentMb').hide();
            $('#contentCreateCommentMb').parent().removeClass('is-invalid');
        }
    }

    if(errorDanhXungComment == false || errorNameComment == false || errorPhoneComment == false){
        return false;
    }
}
function validateReplyComment (danhXung, name, phone, email, content)
{
    if(typeof danhXung == 'undefined'){
        $('#errorDanhXungReplyComment').show();
        $('.check-form-reply-comment').addClass('is-invalid');
        var errorDanhXungReplyComment = false;
    }else{
        $('#errorDanhXungReplyComment').hide();
        $('.check-form-create-comment').removeClass('is-invalid');
    }

    if(name == '' || name.replace(/\s/g, '').length < 1 || removeChar(name) == ''){
        $('#errorNameReplyComment').show();
        $('#nameReplyComment').parent().addClass('is-invalid');
        var errorNameReplyComment = false;
    }else{
        $('#errorNameReplyComment').hide();
    }

    if(phone == '' || phone.replace(/\s/g, '').length < 1){
        $('#errorPhoneReplyComment').show();
        $('#phoneReplyComment').parent().addClass('is-invalid');
        var errorPhoneReplyComment = false;
    }else{
        if(phone.length < 10 || phone.length > 11 || !$.isNumeric(phone) || phonenumber(phone) == false){
            $('.phone-error-reply-comment-text').text('Sá»‘ Ä‘iá»‡n thoáº¡i khĂ´ng há»£p lá»‡');
            $('#errorPhoneReplyComment').show();
            $('#phoneReplyComment').parent().addClass('is-invalid');
            var errorPhoneReplyComment = false;
        }else{
            $('#errorPhoneReplyComment').hide();
        }
    }

    if(email != '' || email.length > 0 || email.replace(/\s/g, '').length > 0 || removeChar(email) != ''){
        if(isEmail(email) == false){
            $('#errorEmailReplyComment').show();
            return false;
        }else{
            $('#errorEmailReplyComment').hide();
        }
    }else{
        $('#errorEmailReplyComment').hide();
    }

    if(content == '' || content.length < 3 || content.replace(/\s/g, '').length < 3 || removeChar(content) == ''){
        $('#errorContentReplyComment').show();
        $('#contentReplyComment').parent().addClass('is-invalid');
        var errorContentReplyComment = false;
    }else{
        $('#errorContentReplyComment').hide();
    }

    if(errorDanhXungReplyComment == false || errorNameReplyComment == false || errorPhoneReplyComment == false || errorContentReplyComment == false){
        return false;
    }
}

function sendComment ()
{
    $(document).on('click', '#sendComment', function(){
        var danhXung = $("input[name='danhXungComment']:checked").val();
        var name = $("input[name='nameComment']").val();
        var phone = $("input[name='phoneComment']").val();
        var email = $("input[name='emailComment']").val();
        var content = removeChar($("textarea[name='contentComment']").val());

        var totalComments = parseInt($('#totalComments').val());
        if($(window).width() < 992 && totalComments < 1){
            var content = removeChar($("textarea[name='contentCreateCommentMb']").val());
        }
        var validate = validateCreateComment(danhXung, name, phone, email);
        $('#commentSuccess').removeClass(MODAL_CLASS);
        if(validate == false){
            return false;
        }

        $(this).prop('disabled', true);

        $.ajax({
            url : "/create/comment",
            headers : TOKEN,
            type : "POST",
            data : {
                product_id : PRODUCT_ID,
                username   : removeChar(name),
                phone      : removeChar(phone),
                pageName : $('#pageName').val(),
                email      : email,
                content    : content,
                danh_xung  : removeChar(danhXung)
            },
            success : function(response)
            {
                ga('send', 'event', 'Product Detail Page', 'Click BĂ¬nh luáº­n', 'Gá»­i bĂ¬nh luáº­n', {'nonInteraction': 1});
                $('#sendComment').prop('disabled', false);

                $('#modalCreateComment').removeClass(MODAL_CLASS);
                openModal('success');

                //active filter
                $('#lcBoxComments').show();
                $('#lcBoxComments').removeClass('none-comment');
                $('.section-comments').show();
                $('menu-filter-comments').show();
                $('#noneComments').hide();
                $('#commentList').html(response.data);
                $('.total-comments').html(response.totalItems);
                $('#totalComments').val(response.totalItems);
                $('#newPageComments').html('');
                $('#pageComment').val(2);
                $('#typeFilterComment').val('desc');
                $('.label-filter-comments').text('Má»›i nháº¥t');
                $('.filter-comments').removeClass('active')
                $('#desc').addClass('active');
                $('#loadMoreComments').hide();
                $('#noneComments').attr('style', 'display:none !important;');
                $('.menu-filter-comments').removeAttr('style');

                //loadmore
                $('#countLoadMoreCm').val(response.totalItems);
                var countLoadMoreCm = $('#countLoadMoreCm').val();
                var countLoadMore = parseInt(countLoadMoreCm) - 5;
                $('#countLoadMoreCm').val(countLoadMore);
                if(countLoadMore >= 5){
                    var countLoadMore = 5;
                }
                $('.count-load-more-cm').text(countLoadMore);
                if(response.totalPage > 1){
                    $('#lcViewMoreCm').show();
                }

                clearInputComment();
            }
        });
    });
}
function sendReplyComment ()
{
    $(document).on('click', '#sendReplyComment', function(){
        var id = $('#replyIdComment').val();
        var danhXung = $("input[name='danhXungReplyComment']:checked").val();
        var name = $("input[name='nameReplyComment']").val();
        var phone = $("input[name='phoneReplyComment']").val();
        var email = $("input[name='emailReplyComment']").val();
        var content = removeChar($("textarea[name='contentReplyComment']").val());

        $('#commentSuccess').removeClass(MODAL_CLASS);
        var validate = validateReplyComment(danhXung, name, phone, email, content);
        if(validate == false){
            return false;
        }

        $(this).prop('disabled', true);

        $.ajax({
            url : "/create/comment",
            headers : TOKEN,
            type : "POST",
            data : {
                id         : removeChar(id),
                product_id : PRODUCT_ID,
                username   : removeChar(name),
                phone      : removeChar(phone),
                email      : email,
                content    : content,
                danh_xung  : removeChar(danhXung)
            },
            success : function(response)
            {
                ga('send', 'event', 'Product Detail Page', 'Click BĂ¬nh luáº­n', 'Tráº£ lá»i', {'nonInteraction': 1});
                $('#sendReplyComment').prop('disabled', false);
                $('.text-success-comment').text('Gá»­i CĂ¢u Tráº£ Lá»i ThĂ nh CĂ´ng');
                $('.text-success-comment-sub').text('CĂ¢u tráº£ lá»i Ä‘Ă£ Ä‘Æ°á»£c ghi nháº­n vĂ  sáº½ cáº­p nháº­t trong thá»i gian sá»›m nháº¥t.');
                $('#modalReplyComment').removeClass(MODAL_CLASS);
                openModal('success');
                // $('.comment-reply-box-'+id).show();
                // $('.comment-reply-box-'+id).append(response.data);
                $('.feedback-'+response.commentId).html(response.data);
                $('#pageComment'+response.commentId).val(2);
                clearInputComment();
            }
        });
    });
}


//{ ======= REVIEW ====== }
    function checkedRadioReview ()
    {
        $(document).on('click', '.danh-xung-review', function(){
            $(this).find('input').prop('checked', true);
        });
        $(document).on('click', '.danh-xung-reply-review', function(){
            $(this).find('input').prop('checked', true);
        });
    }
    
    function validateForm (danhXung, name, phone, email, content, star)
    {
        if(danhXung == '' || typeof danhXung == 'undefined'){
            $('#errorDanhXungReview').show();
            $('.check-form-review').addClass('is-invalid');
            var errorDanhXungReview = false;
        }else{
            $('#errorDanhXungReview').hide();
            $('.check-form-review').removeClass('is-invalid');
        }

        if(name == '' || name.replace(/\s/g, '').length < 1 || removeChar(name) == ''){
            $('#errorNameReview').show();
            $('#nameReview').parent().addClass('is-invalid');
            var errorNameReview = false;
        }else{
            $('#errorNameReview').hide();
        }

        if(phone == '' || phone.replace(/\s/g, '').length < 1){
            $('#errorPhoneReview').show();
            $('#phoneReview').parent().addClass('is-invalid');
            var errorPhoneReview = false;
        }else{
            if(phone.length < 10 || phone.length > 10 || !$.isNumeric(phone) || phonenumber(phone) == false){
                $('#errorPhoneReview').show();
                $('#phoneReview').parent().addClass('is-invalid');
                $('.error-phone-review-text').text('Sá»‘ Ä‘iá»‡n thoáº¡i khĂ´ng há»£p lá»‡');
                var errorPhoneReview = false;
            }else{
                $('#errorPhoneReview').hide();
            }
        }

        if(email != '' || email.length > 0 || email.replace(/\s/g, '').length > 0 || removeChar(email) != ''){
            if(isEmail(email) == false){
                $('#errorEmailReview').show();
                return false;
            }else{
                $('#errorEmailReview').hide();
            }
        }else{
            $('#errorEmailReview').hide();
        }

        if(content == '' || content.length < 3 || content.replace(/\s/g, '').length < 3){
            $('#errorContentReview').show();
            $('#contentReview').parent().addClass('is-invalid');
            var errorContentReview = false;
        }else{
            $('#errorContentReview').hide();
        }

        if(star == 0){
            $('.error-star').show();
            var errorStar = false;
        }else{
            $('.error-star').hide();
        }

        if(errorDanhXungReview == false || errorNameReview == false || errorPhoneReview == false || errorContentReview == false || errorStar == false){
            return false;
        }
    }
    function validateReply (danhXung, name, phone, email, content, id)
    {
        if(danhXung == '' || typeof danhXung == 'undefined'){
            $('#errorDanhXungReplyReview').show();
            $('.check-form-reply-review').addClass('is-invalid');
            var errorDanhXungReplyReview = false;
        }else{
            $('#errorDanhXungReplyReview').hide();
            $('.check-form-reply-review').removeClass('is-invalid');
        }

        if(name == '' || name.replace(/\s/g, '').length < 1 || removeChar(name) == ''){
            $('#errorNameReplyReview').show();
            $('#nameReplyReview').parent().addClass('is-invalid');
            var errorNameReplyReview = false;
        }else{
            $('#errorNameReplyReview').hide();
        }

        if(phone == '' || phone.replace(/\s/g, '').length < 1){
            $('#errorPhoneReplyReview').show();
            $('#phoneReplyReview').parent().addClass('is-invalid');
            var errorPhoneReplyReview = false;
        }else{
            if(phone.length < 10 || phone.length > 10 || !$.isNumeric(phone) || phonenumber(phone) == false){
                $('#errorPhoneReplyReview').show();
                $('#phoneReplyReview').parent().addClass('is-invalid');
                $('.error-phone-reply-review-text').text('Sá»‘ Ä‘iá»‡n thoáº¡i khĂ´ng há»£p lá»‡');
                var errorPhoneReplyReview = false;
            }else{
                $('#errorPhoneReplyReview').hide();
            }
        }

        if(email != '' || email.length > 0 || email.replace(/\s/g, '').length > 0 || removeChar(email) != ''){
            if(isEmail(email) == false){
                $('#errorEmailReplyReview').show();
                return false;
            }else{
                $('#errorEmailReplyReview').hide();
            }
        }else{
            $('#errorEmailReplyReview').hide();
        }

        if(content == '' || content.length < 3 || content.replace(/\s/g, '').length < 3){
            $('#errorContentReplyReview').show();
            $('#contentReplyReview').parent().addClass('is-invalid');
            var errorContentReplyReview = false;
        }else{
            $('#errorContentReplyReview').hide();
        }

        if(id == '' || typeof id == 'undefined'){
            return false;
        }

        if(errorDanhXungReplyReview == false || errorNameReplyReview == false || errorPhoneReplyReview == false || errorContentReplyReview == false){
            return false;
        }
    }
    function clearInputReview ()
    {
        //clear create review
        $("input[name='danhXungReview']:checked").prop('checked', false);
        $('.danh-xung-review').removeClass('checked');
        $("input[name='nameReview']").val('');
        $("input[name='phoneReview']").val('');
        $("input[name='emailReview']").val('');
        $("textarea[name='contentReview']").val('');
        $('.lc__rating-star').find('li.m-r-8').removeClass('selected');
        $('#messrating').html('');
        //clear reply review
        $("input[name='danhXungReplyReview']:checked").prop('checked', false);
        $('.danh-xung-reply-review').removeClass('checked');
        $("input[name='nameReplyReview']").val('');
        $("input[name='phoneReplyReview']").val('');
        $("input[name='emailReplyReview']").val('');
        $("textarea[name='contentReplyReview']").val('');
        $('#replyName').val('');
        $('#replyId').val('');
    }
    function openModalSuccess (reply = false)
    {
        $('.review-success').addClass('modal--is-visible');
        // $('html').addClass(DISABLE_SCROLL);
        // disableScroll();
        // enableScroll();
        if(reply != false){
            $('#traloithanhcong').addClass('modal--is-visible');
            // $('html').addClass(DISABLE_SCROLL);
            // disableScroll();
            // enableScroll();
        }
    }
    function closeModalSuccessReview ()
    {
        $('.review-success').removeClass('modal--is-visible');
        $('#traloithanhcong').removeClass('modal--is-visible');
        // $('html').removeClass(DISABLE_SCROLL);
        enableScroll();
    }
    function closeModalFormReview ()
    {
        $('.form-review').removeClass('modal--is-visible');
        // $('html').removeClass(DISABLE_SCROLL);
        enableScroll();
    }

    function view (viewId, data, totalItems, totalPage)
    {
        $('#noneReviews').hide();
        $('#'+viewId).html(data);
        $('.total-reviews').text(totalItems);
        if(totalPage > 1){
            $('#loadMoreReview').show();
        }else{
            $('#loadMoreReview').hide();
        }
    }
    
    function replyInfo ()
    {
        $(document).on('click', '.reply-review', function(){
            clearInputReview();
            var id = $(this).data('id');
            var name = $(this).data('name');
            $('#replyFor').text(name);
            $('#replyName').val(name);
            $('#replyId').val(id);
            $('#replyReview').addClass('modal--is-visible');
            // $('html').addClass(DISABLE_SCROLL);
            disableScroll();
        });
    }
    function ratingReview (star, averageRating,percentFiveStar,percentFourStar,percentThreeStar,percentTwoStar,percentOneStar)
    {
        $('#average-rating').html(averageRating);
        $('.progress-bar-5').attr('style', 'width:'+percentFiveStar+'%;');
        $('.progress-bar-4').attr('style', 'width:'+percentFourStar+'%;');
        $('.progress-bar-3').attr('style', 'width:'+percentThreeStar+'%;');
        $('.progress-bar-2').attr('style', 'width:'+percentTwoStar+'%;');
        $('.progress-bar-1').attr('style', 'width:'+percentOneStar+'%;');

        var oldStar = $('#'+star+'star').text();
        $('#'+star+'star').text(parseInt(oldStar) + 1);
    } 

    function sendReview ()
    {
        $(document).on('click', '.send-review', function(){
            var danhXung = $("input[name='danhXungReview']:checked").val();
            var name = $("input[name='nameReview']").val();
            var phone = $("input[name='phoneReview']").val();
            var email = $("input[name='emailReview']").val();
            var content = removeChar($("textarea[name='contentReview']").val());
            var star = $('.lc__rating-star').find('li.m-r-8.selected').length;

            $('#danhgiathanhcong').removeClass(MODAL_CLASS);
            var validate = validateForm(danhXung, name, phone, email, content, star);
            if(validate == false){
                return false;
            }

            $(this).prop('disabled', true);

            $.ajax({
                url : "/review/create",
                type : "POST",
                headers : TOKEN,
                data : {
                    product_id : PRODUCT_ID,
                    username   : removeChar(name),
                    phone      : removeChar(phone),
                    email      : email,
                    content    : content,
                    danh_xung  : removeChar(danhXung),
                    star       : star
                },
                success : function (response)
                {
                    var tracking = 'Gá»­i Ä‘Ă¡nh giĂ¡ : '+star;
                    ga('send', 'event', 'Product Detail Page', 'Click ÄĂ¡nh giĂ¡', tracking, {'nonInteraction': 1});
                    $('.send-review').prop('disabled', false);
                    //reset filter
                    $('#lcBoxReviews').show();
                    $('.new-page-reviews').html('');
                    $('#pageReview').val(2);
                    $('#sortTypeReviews').val('moi-nhat');
                    $('.filter-reviews').removeClass('active');
                    $('#descReview').addClass('active');
                    $('.label-filter-review').text('Má»›i nháº¥t');
                    $('.menu-filter-review').removeAttr('style');
                    $('#sectionReviews').show();
                    $('#noneReviews').attr('style','display:none !important;');

                    //loadmore
                    $('#countLoadMoreRv').val(response.totalItems);
                    var countLoadMoreRv = $('#countLoadMoreRv').val();
                    var countLoadMore = parseInt(countLoadMoreRv) - 5;
                    $('#countLoadMoreRv').val(countLoadMore);
                    if(countLoadMore >= 5){
                        var countLoadMore = 5;
                    }
                    $('.count-load-more-rv').text(countLoadMore);
                    // if(response.totalPage > 1){
                    //     $('#lcViewMoreCm').show();
                    // }

                    //rating
                    var averageRating = response.averageRating;
                    ratingReview(star, averageRating, 
                                response.percentFiveStar, 
                                response.percentFourStar, 
                                response.percentThreeStar, 
                                response.percentTwoStar, 
                                response.percentOneStar);

                    $('.average-rating-star').html('');
                    $('#starRatingTop').html('');
                    $('.star-rating-top').remove();
                    response.starAcive.forEach(function(value, index){
                        $('.average-rating-star').append('<li class="m-r-8 m-r-md-4"><span class="ic-star fill fs-p-20 fs-p-md-14"></span></li>');
                        $('#starRatingTop').append('<li><i class="ic-star"></i></li>');
                    });
                    if(averageRating < 5){
                        response.starNotActive.forEach(function(value, index){
                            $('.average-rating-star').append('<li class="m-r-8 m-r-md-4"><span class="ic-star fs-p-20 fs-p-md-14"></span></li>');
                            $('#starRatingTop').append('<li><i class="ic-star-o"></i></li>');
                        });
                    }
                    $('#starRatingTop').append('<li></li>');

                    //render
                    view('listReview', response.data, response.totalItems, response.totalPage);
                    clearInputReview();
                    $('.form-review').removeClass(MODAL_CLASS);
                    openModalSuccess();
                }
            });
        });
    }
    function sendReplyReview ()
    {
        $(document).on('click', '.send-reply-review', function(){
            var danhXung = $("input[name='danhXungReplyReview']:checked").val();
            var name = $("input[name='nameReplyReview']").val();
            var phone = $("input[name='phoneReplyReview']").val();
            var email = $("input[name='emailReplyReview']").val();
            var content = removeChar($("textarea[name='contentReplyReview']").val());
            var star = $('.lc__rating-star').find('li.m-r-8.selected').length;
            var id = $('#replyId').val();

            $('#danhgiathanhcong').removeClass(MODAL_CLASS);
            var validate = validateReply(danhXung, name, phone, email, content, id);

            if(validate == false){
                return false;
            }

            $(this).prop('disabled', true);

            $.ajax({
                url : "/review/create",
                headers : TOKEN,
                type : "POST",
                data : {
                    id         : removeChar(id),
                    product_id : PRODUCT_ID,
                    username   : removeChar(name),
                    phone      : removeChar(phone),
                    email      : removeChar(email),
                    content    : content,
                    danh_xung  : removeChar(danhXung),
                    star : star
                },
                success : function (response)
                {
                    ga('send', 'event', 'Product Detail Page', 'Click ÄĂ¡nh giĂ¡', 'Tráº£ lá»i', {'nonInteraction': 1});
                    $('.send-reply-review').prop('disabled', false);
                    $('.text-success-review').text('Gá»­i CĂ¢u Tráº£ Lá»i ThĂ nh CĂ´ng');
                    $('.text-success-review-sub').text('CĂ¢u tráº£ lá»i Ä‘Ă£ Ä‘Æ°á»£c ghi nháº­n vĂ  sáº½ cáº­p nháº­t trong thá»i gian sá»›m nháº¥t.');
                    // $('#replied'+id).show();
                    // $('#replied'+id).append(response.data);
                    $('.feedback-'+response.reviewId).html(response.data);
                    $('#pageComment'+response.reviewId).val(2);
                    clearInputReview();
                    $('#replyReview').removeClass(MODAL_CLASS);
                    openModalSuccess('reply');
                }
            });
        });
    }
//{ ======= END REVIEW ====== }
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function phonenumber(mobile) {
    var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    // var mobile = $('#mobile').val();
    if(mobile !==''){
        if (vnf_regex.test(mobile) == false) 
        {
            return false;
        }else{
            return true;
        }
    }else{
        return false;
    }
}
function keyUpValidate (elementKeyup, elementHide, elementName = false, extend = false, errorText, star = false, textareaMobile = false, invaliEmail = false)
{
    //validate textarea mobile
    if(textareaMobile != false){
        var totalComments = parseInt($('#totalComments').val());
        if($(window).width() < 992 && totalComments < 1){
            $(document).on('keyup', '#'+textareaMobile, function(){
                if($(this).val() == '' || removeChar($(this).val()).length < 3 || $(this).val().replace(/\s/g, '').length < 3){
                    $('#'+textareaMobile).parent().addClass('is-invalid');
                    $('#errorContentCreateCommentMb').show();
                    return false;
                }else{
                    $('#errorContentCreateCommentMb').hide();
                    $('#'+textareaMobile).parent().removeClass('is-invalid');
                }
            });
        }
    }

    $(document).on('keyup', '#'+elementKeyup, function(){
        if($(this).val() != '' && $(this).val().replace(/\s/g, '').length > 0 && removeChar($(this).val()) != ''){
            $('#'+elementHide).hide();
            $('#'+elementHide).parent().children().removeClass('is-invalid');
        }else{
            $('#'+elementHide).show();
            $('#'+elementHide).parent().children().addClass('is-invalid');
        }
        //check phone
        if(extend == 'phone'){
            if($(this).val().length > 0){
                if($(this).val().length < 10 || $(this).val().length > 10 || phonenumber($(this).val()) == false){
                    $('.'+errorText).text('Sá»‘ Ä‘iá»‡n thoáº¡i khĂ´ng há»£p lá»‡');
                    $('#'+elementHide).show();
                    $('#'+elementHide).parent().children().addClass('is-invalid');
                }else{
                    $('#'+elementHide).hide();
                    $('#'+elementHide).parent().children().removeClass('is-invalid');
                }
            }else{
                $('.'+errorText).text('ThĂ´ng tin báº¯t buá»™c');
                $('#'+elementHide).show();
                $('#'+elementHide).parent().children().addClass('is-invalid');
            }
        }
        //check content
        if(extend == 'content'){
            if(removeChar($(this).val()).length < 3 || $(this).val().replace(/\s/g, '').length < 3){
                $('#'+elementHide).show();
                $('#'+elementHide).parent().addClass('is-invalid');
            }else{
                $('#'+elementHide).hide();
                $('#'+elementHide).parent().removeClass('is-invalid');
            }
        }
    });
    //check email
    if(invaliEmail != false){
        $(document).on('keyup', '#'+elementKeyup, function(){
            var email = $(this).val();
            if(email != '' && email.length > 5 && email.replace(/\s/g, '').length > 0){
                if(isEmail(email) == false){
                    $('#'+elementHide).show();
                    $('#'+elementHide).parent().children().addClass('is-invalid');
                    return false;
                }else{
                    $('#'+elementHide).hide();
                    $('#'+elementHide).parent().children().removeClass('is-invalid');
                }
            }else{
                $('#'+elementHide).hide();
                $('#'+elementHide).parent().children().removeClass('is-invalid');
            }
        });
    }
    $(document).on('click', '.'+elementKeyup, function(){
        var danhXung = $("input[name="+elementName+"]:checked").val();
        if(typeof danhXung != 'undefined'){
            $('#'+elementHide).hide();
            if(elementKeyup == 'danh-xung-comment'){
                $('.check-form-create-comment').removeClass('is-invalid');
            }
            if(elementKeyup == 'danh-xung-reply-comment'){
                $('.check-form-reply-comment').removeClass('is-invalid');
            }
            if(elementKeyup == 'danh-xung-review'){
                $('.check-form-review').removeClass('is-invalid');
            }
            if(elementKeyup == 'danh-xung-reply-review'){
                $('.check-form-reply-review').removeClass('is-invalid');
            }
        }else{
            $('#'+elementHide).show();
            if(elementKeyup == 'danh-xung-comment'){
                $('.check-form-create-comment').addClass('is-invalid');
            }
            if(elementKeyup == 'danh-xung-reply-comment'){
                $('.check-form-reply-comment').addClass('is-invalid');
            }
            if(elementKeyup == 'danh-xung-review'){
                $('.check-form-review').addClass('is-invalid');
            }
            if(elementKeyup == 'danh-xung-reply-review'){
                $('.check-form-reply-review').addClass('is-invalid');
            }
        }
    });
    //rating review
    $('create-rating').click(function(){
        var rating = $('.lc__rating-star').find('li.m-r-8.selected').length;
        if(rating > 0){
            $('.error-star').hide();
        }else{
            $('.error-star').show();
        }
    });
}
function callKeyUpValidate ()
{
    //validate create comment
    keyUpValidate('danh-xung-comment', 'errorDanhXungComment', 'danhXungComment');
    keyUpValidate('nameComment', 'errorNameComment');
    keyUpValidate('phoneComment', 'errorPhoneComment', 'none', 'phone', 'text-phone-error-comment');
    keyUpValidate('emailComment', 'errorEmailComment', 'none', 'none', 'none','none','none', 'is-email');
    keyUpValidate('contentComment', 'errorContentComment', 'none', 'content');
    //mobile
    keyUpValidate('none', 'none', 'none', 'none', 'none', 'star', 'contentCreateCommentMb');


    //valiate reply comment
    keyUpValidate('danh-xung-reply-comment', 'errorDanhXungReplyComment', 'danhXungReplyComment');
    keyUpValidate('nameReplyComment', 'errorNameReplyComment');
    keyUpValidate('phoneReplyComment', 'errorPhoneReplyComment', 'none', 'phone', 'phone-error-reply-comment-text');
    keyUpValidate('emailReplyComment', 'errorEmailReplyComment', 'none', 'none', 'none','none','none', 'is-email');
    keyUpValidate('contentReplyComment', 'errorContentReplyComment', 'none', 'content');

    //validate create review
    keyUpValidate('danh-xung-review', 'errorDanhXungReview', 'danhXungReview');
    keyUpValidate('nameReview', 'errorNameReview');
    keyUpValidate('phoneReview', 'errorPhoneReview', 'none', 'phone', 'error-phone-review-text');
    keyUpValidate('emailReview', 'errorEmailReview', 'none', 'none', 'none','none','none', 'is-email');
    keyUpValidate('contentReview', 'errorContentReview', 'none', 'content');
    keyUpValidate('none', 'none', 'none', 'none', 'none', 'star');

    //validate reply review
    keyUpValidate('danh-xung-reply-review', 'errorDanhXungReplyReview', 'danhXungReplyReview');
    keyUpValidate('nameReplyReview', 'errorNameReplyReview');
    keyUpValidate('phoneReplyReview', 'errorPhoneReplyReview', 'none', 'phone', 'error-phone-reply-review-text');
    keyUpValidate('emailReplyReview', 'errorEmailReplyReview', 'none', 'none', 'none','none','none', 'is-email');
    keyUpValidate('contentReplyReview', 'errorContentReplyReview', 'none', 'content');
}
function getVerticalScrollPercentage( elm ){
    var p = elm.parentNode
    return (elm.scrollTop || p.scrollTop) / (p.scrollHeight - p.clientHeight ) * 100
}

$(document).ready(function(){
    //comment
    openModal('create');
    openModalReplyComment();
    // closeModal();
    //close modal comment
    $(document).on('click', '.close-modal-create-comment', function(){
        $('#modalCreateComment').removeClass(MODAL_CLASS);
        // $('html').removeClass(DISABLE_SCROLL);
        enableScroll();
    });
    $(document).on('click', '.close-modal-success-comment', function(){
        $('#commentSuccess').removeClass(MODAL_CLASS);
        // $('html').removeClass(DISABLE_SCROLL);
        enableScroll();
    });
    $(document).on('click', '.close-modal-reply-comment', function(){
        $('#modalReplyComment').removeClass(MODAL_CLASS);
        // $('html').removeClass(DISABLE_SCROLL);
        enableScroll();
    });
    // ====
    checkedRadioComment();
    sendComment();
    sendReplyComment();

    //review
    $(document).on('click', '.close-review-success', function(){
        closeModalSuccessReview();
        closeModalFormReview();
    });
    $('#btnCreateReview').click(function(){
        disableScroll();
    });
    checkedRadioReview();
    sendReview();
    replyInfo();
    sendReplyReview();

    //keyup validate
    callKeyUpValidate();

    $(document).on('click', '.modal-form', function (e) {
        if ($('.modal.modal-form').is(e.target) && $('.modal.modal-form').has(e.target).length === 0) {
            $('#replyReview').removeClass(MODAL_CLASS);
            $('#modalReplyComment').removeClass(MODAL_CLASS);
            $('html').css({
                marginTop: 0,
            }).removeClass('disable-scroll-safari');
            window.scrollTo(0, previousScrollY);
        }
    });

    //tracking scroll
    // document.onscroll = function(){
    //     var pos = getVerticalScrollPercentage(document.body);
    //     percent = Math.round(pos);
    //     if(percent > 25){
    //         ga('send', 'event', 'Product Detail Page', 'Scroll Depth', '25%', {'nonInteraction': 1});
    //     }
    //     if(percent > 50){
    //         ga('send', 'event', 'Product Detail Page', 'Scroll Depth', '50%', {'nonInteraction': 1});
    //     }
    //     if(percent > 75){
    //         ga('send', 'event', 'Product Detail Page', 'Scroll Depth', '75%', {'nonInteraction': 1});
    //     }
    // }
    $('html').addClass('cart-html');
    $('body').addClass('cart-body');
});