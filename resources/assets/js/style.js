
(function($){

    var original_title = document.title;
    var nCount = 0;

    var iKBCity = {
        init: function(){
            var self = this;

            self.siteBootUp();
        },

        siteBootUp: function(){
            var self = this;
            // self.initExternalLink();
            // self.initEmoji();
            self.initSematicUI();
            // self.initAutocompleteAtUser();
            // self.initScrollToTop();
            // self.initLocalStorage();
            // self.initEditorPreview();
            self.initReplyOnPressKey();
            self.initDeleteForm();
            // self.initInlineAttach();
            self.initAjax();
            self.initLogin();
            self.replyBtnShow();
            // self.initFollow();
            self.initLoginRequired();
        },

        initSematicUI: function(){
            $('.ui.dropdown').dropdown();
            $('.ui.checkbox').checkbox();
            $('.ui.sticky').sticky();
        },

        initFollow: function(){

            var changeFollowingState = function(that) {
                if (that.data('act') == 'follow') {
                    that.data('act', 'unfollow');
                    that.find('.state').text('已关注');
                } else {
                    that.data('act', 'follow');
                    that.find('.state').text('关注');
                }
                that.toggleClass('teal');
            }

            $('.follow.button').api({
                method : 'POST',
                url: Config.url + '/users/{id}/{act}',
                data: {
                    '_token': Config.token
                },
                onSuccess: function(response) {
                    // $('a.follower_count').text(response.count);
                }
            }).state({
                onActivate: function() {
                    changeFollowingState($(this));
                },
                onDeactivate: function() {
                    changeFollowingState($(this));
                }
            });

        },

        /**
         * Open External Links In New Window
         */
        initExternalLink: function(){
            $('.topics-show a[href^="http://"], .topics-show a[href^="https://"]').each(function() {
                var a = new RegExp('/' + window.location.host + '/');
                if(!a.test(this.href) ) {
                    $(this).click(function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                        window.open(this.href, '_blank');
                    });
                }
            });
        },

        replyBtnShow: function(){
            $('.comments-feed .comment').each(function() {
                $(this).hover(function(event) {
                    $(this).find('.reply-btn').show();
                });
                $(this).mouseleave(function(event) {
                    $(this).find('.reply-btn').hide();
                });

            });
        },

        initEmoji: function(){
            emojify.setConfig({
                img_dir : Config.cdnDomain + 'build/img/emoji',
                ignored_tags : {
                    'SCRIPT'  : 1,
                    'TEXTAREA': 1,
                    'A'       : 1,
                    'PRE'     : 1,
                    'CODE'    : 1
                }
            });
            emojify.run();

            $('#comment-composing-box').textcomplete([
                { // emoji strategy
                    match: /\B:([\-+\w]*)$/,
                    search: function (term, callback) {
                        callback($.map(emojies, function (emoji) {
                            return emoji.indexOf(term) === 0 ? emoji : null;
                        }));
                    },
                    template: function (value) {
                        return '<img src="' + Config.cdnDomain + 'build/img/emoji/' + value + '.png"></img>' + value;
                    },
                    replace: function (value) {
                        return ':' + value + ': ';
                    },
                    index: 1,
                    maxCount: 5
                }
            ]);
        },

        /**
         * Autocomplete @user
         */
        initAutocompleteAtUser: function() {
            var at_users = Config.following_users,
                user;
            $users = $('.ui.comments .comment a.author');
            for (var i = 0; i < $users.length; i++) {
                user = $users.eq(i).text().trim();
                if ($.inArray(user, at_users) == -1) {
                    at_users.push(user);
                };
            };

            $('textarea').textcomplete([{
                mentions: at_users,
                match: /\B@(\S*)$/,
                search: function(term, callback) {
                    callback($.map(this.mentions, function(mention) {
                        console.log(term + ' -> '+ mention.indexOf(term) + ' -> ' + mention);
                        return (mention.indexOf(term) >= 0 // 中文
                            || mention.indexOf(term.toUpperCase()) >= 0 // 大写
                            || mention.indexOf(term.toLowerCase()) >= 0 // 小写
                        ) ? mention : null;
                    }));
                },
                index: 1,
                replace: function(mention) {
                    return '@' + mention + ' ';
                }
            }], {
                appendTo: 'body',
                onKeydown: function(e, commands){
                    console.log(commands);
                }
            });

        },

        /**
         * Scroll to top in one click.
         */
        initScrollToTop: function(){
            $.scrollUp.init();
        },

        /**
         * lightbox
         */
        initLightBox: function(){
            $(document).delegate('.content-body img:not(.emoji)', 'click', function(event) {
                event.preventDefault();
                return $(this).ekkoLightbox({
                    onShown: function() {
                        if (window.console) {
                            // return console.log('Checking our the events huh?');
                        }
                    }
                });
            });
            $(document).delegate('.appends-container img:not(.emoji)', 'click', function(event) {
                event.preventDefault();
                return $(this).ekkoLightbox({
                    onShown: function() {
                        if (window.console) {
                            // return console.log('Checking our the events huh?');
                        }
                    }
                });
            });
        },

        /**
         * do content preview
         */
        runPreview: function() {
            var replyContent = $("#comment-composing-box");
            var oldContent = replyContent.val();

            if (oldContent) {
                marked(oldContent, function (err, content) {
                    $('#preview-box').html(content);
                    emojify.run(document.getElementById('preview-box'));
                });
            }
        },

        /**
         * Init post content preview
         */
        initEditorPreview: function() {
            var self = this;
            $("#comment-composing-box").focus(function(event) {
                // $("#reply_notice").addClass('animated pulse');
                $("#preview-box").fadeIn(1500);
                $("#preview-lable").fadeIn(1500);
            });
            $('#comment-composing-box').keyup(function(){
                //
            });
        },

        /*
         * Use Ctrl + Enter for reply
         */
        initReplyOnPressKey: function() {
            $(document).on("keydown", "#comment-composing-box", function(e)
            {
                var submitBtn = $('#comment-composing-submit');
                if ((e.keyCode == 10 || e.keyCode == 13) && e.ctrlKey && submitBtn.is(':enabled')) {
                    submitBtn.addClass('loading').prop('disabled', true);
                    $(this).parents("form").submit();
                    localforage.removeItem('comment-composing-box');
                    return true;
                }
            });
        },

        /*
         * Construct a form when using the following code, makes more clean code.
         *   {{ link_to_route('tasks.destroy', 'D', $task->id, ['data-method'=>'delete']) }}
         * See this answer: http://stackoverflow.com/a/23082278/689832
         */
        initDeleteForm: function() {
            $('[data-method]').append(function(){
                return "\n"+
                    "<form action='"+$(this).attr('data-url')+"' method='POST' style='display:none'>\n"+
                    "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
                    "   <input type='hidden' name='_token' value='"+Config.token+"'>\n"+
                    "</form>\n"
            })
                .attr('style','cursor:pointer;')
                .click(function() {
                    var that = $(this);
                    if ($(this).attr('data-method') == 'delete') {
                        swal({
                            title: "",
                            html: $(this).attr('data-hint') ?  $(this).attr('data-hint') : "你确定要删除此内容吗？",
                            type: "warning",
                            showCancelButton: true,
                            cancelButtonText: "取消",
                            confirmButtonText: "删除"
                        }).then(function () {
                            that.find("form").submit();
                        });
                    }
                    if ($(this).attr('data-method') == 'post') {
                        $(this).find("form").submit();
                    }
                });
            // attr('onclick',' if (confirm("Are you sure want to proceed?")) { $(this).find("form").submit(); };');
        },

        /**
         * Local Storage
         */
        initLocalStorage: function() {
            var self = this;

            // Reply Content ON Topic Detail View
            localforage.getItem('comment-composing-box', function(err, value) {
                if ($('#comment-composing-box').val() == '' && !err) {
                    $('#comment-composing-box').val(value);
                }
            });
            $('#comment-composing-box').keyup(function(){
                localforage.setItem('comment-composing-box', $(this).val());
            });

            $("#comment-composing-form").submit(function(event){
                localforage.removeItem('comment-composing-box');
            });
        },

        /**
         * Upload image
         */
        initInlineAttach: function() {
            var self = this;
            $('#comment-composing-box').inlineattach({
                uploadUrl: Config.routes.upload_image,
                extraParams: {
                    '_token': Config.token,
                },
                // onUploadedFile: function(response) {
                //     setTimeout(self.runPreview, 200);
                // },
            });
        },

        initComment: function() {
            var self = this;
            var form = $('#comment-composing-form');
            var submitBtn = form.find('input[type=submit]');
            var submitBtnVal = submitBtn.val();
            var replies = $('.replies .list-group');
            var preview = $('#preview-box');
            var emptyBlock = $('#replies-empty-block');
            var count = 0;

            form.on('submit', function() {
                var tpl = '';
                var delTpl = '';
                var voteTpl = '';
                var introTpl = '';
                var badgeTpl = '';
                var total = $('.replies .total b');

                count = replies.find('li').length + 1;
                comment = $(this).find('textarea');
                commentText = comment.val();

                if ($.trim(commentText) !== '') {
                    submitBtn.val('提交中...').addClass('disabled').prop('disabled', true);
                    $.ajax({
                        method: 'POST',
                        url: $(this).attr('action'),
                        data: {
                            body: commentText,
                            topic_id: $('[name=topic_id]').val()
                        },
                    }).done(function(data) {
                        if (data.status === 200) {
                            if (data.manage_topics === 'yes') {
                                delTpl = '<a class="" id="reply-delete-' + data.reply.id + '" data-ajax="delete" href="javascript:void(0);" data-url="/replies/delete/' + data.reply.id + '" title="删除"><i class="fa fa-trash-o"></i></a><span> •  </span>';
                            }

                            if (data.reply.user.introduction) {
                                introTpl = '，' + data.reply.user.introduction;
                            }
                            if (Config.user_badge) {
                                badgeTpl = '<div>\
                                    <a class="label label-success role" href="' + Config.user_badge_link + '">' + Config.user_badge +'</a>\
                                </div>';
                            }

                            tpl = '<li class="list-group-item media" style="margin-top: 0px;">\
                                <div class="avatar avatar-container pull-left">\
                                    <a href="/users/' + data.reply.user_id + '"><img class="media-object img-thumbnail avatar" alt="' + data.reply.user.name + '" src="' + data.reply.user.image_url + '" style="width:55px;height:55px;"></a>\
                                ' + badgeTpl +'</div>\
                                <div class="infos">\
                                    <div class="media-heading">\
                                        <a href="/users/' + data.reply.user_id + '" title="' + data.reply.user.name + '" class="remove-padding-left author">' + data.reply.user.name + '</a>\
                                        <span class="introduction">' + introTpl + '</span>\
                                        <span class="operate pull-right">' + delTpl + '<a class="fa fa-reply" href="javascript:void(0)" onclick="replyOne(\'' + data.reply.user.name + '\');" title="回复 ' + data.reply.user.name + '"></a>\
                                        </span>\
                                        <div class="meta">\
                                            <a name="reply' + count + '" class="anchor" href="#reply' + count + '" aria-hidden="true">#' + count + '</a>\
                                            <span> •  </span>\
                                            <abbr class="timeago" title="' + data.reply.created_at + '">' + data.reply.created_at + '</abbr>\
                                        </div>\
                                    </div>\
                                    <div class="media-body markdown-reply content-body">' + data.reply.body + '</div>\
                                </div>\
                            </li>';
                        }

                        $(tpl).hide().appendTo(replies).slideDown();
                        total.html(parseInt(total.html()) + 1);
                        emptyBlock.addClass('hide');
                        comment.val('');
                        localforage.removeItem('comment-composing-box');
                        preview.html('');
                        location.href = location.href.split('#')[0] + '#reply' + count;
                        self.initTimeAgo();
                        self.showPluginDownload();
                        emojify.run();
                    }).always(function() {
                        submitBtn.val(submitBtnVal).removeClass('disabled').prop('disabled', false);
                    });
                }

                return false;
            });
        },

        initAjax: function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            // this.initDataAjax();
            // this.initComment();
        },

        initDataAjax: function() {
            var self = this;
            $(document).on('click', '[data-ajax]', function() {
                var that = $(this);
                var method = that.data('ajax');
                var url = that.data('url');
                var active = that.is('.active');
                var cancelText = that.data('lang-cancel');
                var isRecomend = that.is('#topic-recomend-button');
                var isWiki = that.is('#topic-wiki-button');
                var ribbonContainer = $('.topic .ribbon-container');
                var ribbon = $('.topic .ribbon');
                var excellent = $('.topic .ribbon-excellent');
                var wiki = $('.topic .ribbon-wiki');
                var total = $('.replies .total b');
                var voteCount = $('#vote-count');
                var upVote = $('#up-vote');
                var isVote = that.is('.vote');
                var isUpVote = that.is('#up-vote');
                var isCommentVote= that.is('.comment-vote');
                var commenVoteCount= that.find('.vote-count');
                var emptyBlock = $('#replies-empty-block');
                var originUpVoteActive = upVote.is('.active');

                if (Config.user_id === 0) {
                    swal({
                        title: "",
                        text: '需要登录以后才能执行此操作。',
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "取消",
                        confirmButtonText: "前往登录"
                    }, function() {
                        location.href = '/login-required';
                    });
                }

                if (method === 'delete') {
                    swal({
                        title: "",
                        text: "Are you sure want to proceed?",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "取消",
                        confirmButtonText: "删除"
                    }, function() {
                        that.closest('.list-group-item').slideUp();
                        $.ajax({
                            method: method,
                            url: url
                        }).done(function(data) {
                            if (data.status === 200) {
                                that.closest('.list-group-item').remove();
                                total.html(parseInt(total.html()) - 1);
                                if (parseInt(total.html()) === 0) {
                                    emptyBlock.removeClass('hide');
                                }
                            }
                        }).fail(function() {
                            that.closest('.list-group-item').show();
                        });
                    });

                    return;
                }

                if (that.is('.ajax-loading')) return;
                that.addClass('ajax-loading');

                if (active) {
                    that.removeClass('active');
                    that.removeClass('animated rubberBand');

                    if (isRecomend) {
                        excellent.hide();
                    } else if (isWiki) {
                        wiki.hide();
                    }

                    if (isVote) {
                        // @CJ 如果是点赞，并且是已经点过赞的点赞，那就是去除点赞
                        $('.user-lists').find("a[data-userId='"+Config.user_id+"']").fadeOut('slow/400/fast', function() {
                            $(this).remove();
                        });
                    }
                } else {
                    that.addClass('active');
                    that.addClass('animated rubberBand');

                    if (cancelText) {
                        that.find('span').html(cancelText);
                        self.showPluginDownload();
                    }

                    if (isRecomend) {
                        var excellentText = ribbonContainer.data('lang-excellent');
                        if (excellent.length) {
                            excellent.show();
                        } else {
                            if (ribbon.length) {
                                ribbon.prepend('<div class="ribbon-excellent"><i class="fa fa-trophy"></i> ' + excellentText + ' </div>');
                            } else {
                                ribbonContainer.prepend('<div class="ribbon"><div class="ribbon-excellent"><i class="fa fa-trophy"></i> ' + excellentText + ' </div></div>');
                            }
                        }
                    } else if (isWiki) {
                        var wikiText = ribbonContainer.data('lang-wiki');
                        if (wiki.length) {
                            wiki.show();
                        } else {
                            if (ribbon.length) {
                                ribbon.append('<div class="ribbon-wiki"><i class="fa fa-graduation-cap"></i> ' + wikiText + ' </div>');
                            } else {
                                ribbonContainer.append('<div class="ribbon"><div class="ribbon-wiki"><i class="fa fa-graduation-cap"></i> ' + wikiText + ' </div></div>');
                            }
                        }
                    }

                    if (isVote && Config.user_id > 0) {
                        // @CJ 如果是点赞，并且是没有点过赞的
                        var newContent = $('.voted-template').clone();
                        newContent.attr('data-userId', Config.user_id);
                        newContent.attr('href', Config.user_link);
                        newContent.find('img').attr('src', Config.user_avatar);

                        newContent.prependTo('.user-lists').show('fast', function() {
                            $(this).addClass('animated swing');
                        });

                        $('.vote-hint').hide();
                    }
                }

                $.ajax({
                    method: method,
                    url: url
                }).done(function(data) {
                    if (data.status === 200) {
                        if (isCommentVote) {
                            var num = parseInt(commenVoteCount.html());
                            num = isNaN(num) ? 0 : num;

                            if (data.type === 'sub') {
                                commenVoteCount.html(num - 1 < 1 ? '' : num - 1);
                            } else if (data.type === 'add') {
                                commenVoteCount.html(num + 1);
                            }
                        }
                    }
                }).fail(function() {
                    if (!active) {
                        that.removeClass('active');

                        if (isRecomend) {
                            excellent.hide();
                        } else if (isWiki) {
                            wiki.hide();
                        }
                    } else {
                        that.addClass('active');

                        if (cancelText) {
                            that.find('span').html(cancelText);
                        }

                        if (isRecomend) {
                            excellent.show();
                        } else if (isWiki) {
                            wiki.show();
                        }
                    }

                    if (isVote) {
                        if (originUpVoteActive) {
                            upVote.addClass('active');
                        } else {
                            upVote.removeClass('active');
                        }
                    }
                })
                    .always(function() {
                        that.removeClass('ajax-loading');
                    });
            });
        },

        showMsg: function(msg, myobj) {
            if (!msg) return;
            Messenger().post(msg);
        },

        showPluginDownload: function() {
            this.showMsg('操作成功', {
                type: 'success',
                timer: 8000
            });
        },

        initLogin: function() {
            $('#login-out').on('click', function(e) {
                swal({
                    title: "",
                    text: "将要退出登录？",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "取消",
                    confirmButtonText: "退出"
                }).then(function () {
                    e.preventDefault();
                    $('#logout-form').submit();
                });

                return false;
            });
        },

        initLoginRequired: function() {
            $('.login-required').on('click', function(e) {
                swal({
                    title: "",
                    text: "您需要登录以后才能操作！",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "知道了",
                    confirmButtonText: "前往登录"
                }).then(function () {
                    location.href = '/login';
                });

                return false;
            });
        },
    };
    window.iKBCity = iKBCity;
})(jQuery);

$(document).ready(function()
{
    iKBCity.init();
});

// reply a reply
function replyOne(username){
    replyContent = $("#comment-composing-box");
    oldContent = replyContent.val();
    prefix = "@" + username + " ";
    newContent = ''
    if(oldContent.length > 0){
        if (oldContent != prefix) {
            newContent = oldContent + "\n" + prefix;
        }
    } else {
        newContent = prefix
    }
    replyContent.focus();
    replyContent.val(newContent);
    moveEnd($("#comment-composing-box"));
}

var moveEnd = function(obj){
    obj.focus();

    var len = obj.value === undefined ? 0 : obj.value.length;

    if (document.selection) {
        var sel = obj.createTextRange();
        sel.moveStart('character',len);
        sel.collapse();
        sel.select();
    } else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
        obj.selectionStart = obj.selectionEnd = len;
    }
}
