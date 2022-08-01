function LoadJsComment() {
    var n = $("#comment").attr("data-js"),
        t = parseInt($("#comment").attr("siteid"));
    gl_getJsCmt ||
        (typeof cmtaddcommentclick == "undefined" &&
            ((gl_getJsCmt = !0),
            $.getScript(n).done(function () {
                console.log("get script cmt: " + n);
                setTimeout(function () {
                    t === 1 && cmtInitEvent();
                    reInitCmt2021();
                    reConfigCmtParam(t);
                    console.log(oParams);
                }, 200);
            })),
        $("#hdFileRatingUpload").length > 0);
}
function reConfigCmtParam(n) {
    typeof oParams != "undefined" &&
        window.location.origin.includes("staging") &&
        (n == 1
            ? ((oParams = {
                  sJsHome: "https://www.thegioididong.com/commentnew",
                  sJsHomeU: "https://staging.thegioididong.com/commentmwg",
                  sSiteName: "tgdd",
                  sJsAjax: "https://www.thegioididong.com/commentnew/cmt/index",
                  sStaticVersion: "977ce5003566dfb5058d954b0ea87d35",
                  sGlobalTokenName: "core",
                  bJsIsMobile: !1,
                  "notification.notify_ajax_refresh": 2,
              }),
              (domainName = "http://www.thegioididong.com/commentnew"),
              (hostName = ".thegioididong.com"))
            : n == 2 && ((oParams.sJsAjax = window.location.origin + "/commentmwg/ajax/index"), (oParams.sJsHome = window.location.origin + "/commentmwg")),
        console.log("reConfig_cmt_: " + n));
}
function initUploadRatingImg() {
    console.log("initUploadRatingImg_mwg");
    var n = "",
        t = parseInt($("#hdfSiteID").val());
    t == 1 ? (n = getParam("sJsHomeU") + "/aj/Cmt/PostRatingImage") : t == 2 && (n = getParam("sJsHome") + "/aj/Home/PostImage");
    setTimeout(function () {
        $(".send-img").unbind();
        $(".send-img").on("click", function () {
            if ((console.log("up Img Cmt"), $(".resRtImg li").length > 2)) return alert("ÄĂ£ up load quĂ¡ sá»‘ áº£nh quy Ä‘á»‹nh. "), !1;
            $("#hdFileRatingUpload").click();
        });
        $("#hdFileRatingUpload").unbind();
        $("#hdFileRatingUpload").html5Uploader({
            postUrl: n,
            onClientLoadStart: function () {
                console.log("onClientLoadStart - upload rating img_mwg_");
            },
            onServerLoadStart: function () {
                var n = "<li class='loading-img'>";
                n += "<img src='//cdn.tgdd.vn/mwgcart/mwg-site/ContentMwg/images/loading.gif' />";
                n += "<span class='fbDelImg disabled'>XĂ³a</span>";
                n += "</li>";
                $(".resRtImg").append(n);
                $(".resRtImg").removeClass("hide");
            },
            onServerProgress: function () {},
            onServerLoad: function () {},
            onSuccess: function (n) {
                var i = $.parseJSON(n.currentTarget.response),
                    t;
                if (i.status == -1) {
                    console.log(i);
                    alert("Xáº£y ra lá»—i, vui lĂ²ng thá»­ láº¡i sau. ");
                    return;
                }
                console.log("onSuccess - upload RatingCmtIMG");
                t = "<li data-imgName='" + i.imageName + "'  >";
                typeof gl_rt_siteID != "undefined" && gl_rt_siteID == 2 && (t = "<li data-imgName='" + i.ImageName + "'  >");
                t += "<img src='" + i.imageUrl + "' />";
                t += "<span class='fbDelImg' onclick='rtDelImg(this)'>XĂ³a</span>";
                t += "</li>";
                $(".resRtImg .loading-img").first().replaceWith(t);
                getRtImg();
                uploadedFile++;
            },
        });
    }, 1e3);
}
function getRtImg() {
    if ((console.log("getRtImg_mwg"), $(".resRtImg li").length > 0)) {
        var n = "";
        $(".resRtImg li").each(function () {
            var t = $(this).attr("data-imgname");
            t != null && t != "" && (n += t + "â•¬");
        });
        $(".hdfRtImg").val(n);
    } else $(".resRtImg li").length == 0 && $(".hdfRtImg").val("");
}
function rtDelImg(n) {
    $(n).parent().remove();
    getRtImg();
    $(".resRtImg li").length == 0 && $(".resRtImg").addClass("hide");
    uploadedFile--;
}
function rtMoveFile(n, t) {
    var i, r, u;
    console.log("rtMoveFile_mwg");
    i = "";
    r = parseInt($("#hdfSiteID").val());
    r == 1 ? (i = getParam("sJsHomeU") + "/aj/Cmt/MoveFileRatingImage") : r == 2 && (i = getParam("sJsHome") + "/aj/Home/MoveFileRatingImage");
    n != null &&
        n != "" &&
        ((u = { attachFile: $("#hdfRtImg").val(), commentID: t }),
        $.ajax({
            url: i,
            type: "POST",
            data: u,
            cache: !1,
            beforeSend: function () {},
            success: function (n) {
                (n != null || n != "") && console.log(n);
                hideloading();
            },
            error: function () {
                hideloading();
            },
        }));
}
function lazyImgCmt() {
    $("#comment img.lazy").each(function () {
        var n = $(this).attr("data-src");
        $(this).attr("src", n);
    });
}
function reInitCmt2021() {
    if (!gl_getJsCmtDmx) {
        var n = parseInt($("#comment").attr("siteid")),
            t = $("#comment").attr("data-ismobile") === "True" ? !0 : !1;
        n == 2 && ($(".midcmt .s_comment i").removeClass("icondmx-search").addClass("icon-search"), console.log("reInitCmt2021_"), (gl_getJsCmtDmx = !0));
        $("#comment").attr("data-jsOvrCmt") != null &&
            $("#comment").attr("data-jsOvrCmt") != "" &&
            $.getScript($("#comment").attr("data-jsOvrCmt")).done(function () {
                console.log("getOverrideScript jsOverride-CMT");
                gl_getJsCmtDmx = !0;
            });
    }
}
var gl_getJsCmt = !1,
    gl_getJsCmtDmx = !1,
    gl_siteID = 1,
    comment_cdn = "https://www.thegioididong.com/commentnew",
    tgddc_urlroot = "//www.thegioididong.com/commentnew",
    comment_detailmobile = "commentMWG_21",
    uploadedFile = 0;
$(document).ready(function () {
    var n = parseInt($("#comment").attr("siteid"));
    n == 2 && ((gl_siteID = 2), (comment_cdn = "https://cdn.tgdd.vn/dienmay2015/comment"), (tgddc_urlroot = "//www.dienmayxanh.com/comment"));
    $(window).scroll(function () {
        LoadJsComment();
        lazyImgCmt();
    });
});
