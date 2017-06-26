/** Wonderplugin Portfolio Grid Gallery Plugin Free Version
 * Copyright 2015 Magic Hills Pty Ltd All Rights Reserved
 * Website: http://www.wonderplugin.com
 * Version 9.7 
 */
(function($) {
    $.fn.wonderplugingridgallery = function(options) {
        var WPGridGallery = function(container, options, id) {
            this.container = container;
            this.options = options;
            this.id = id;
            this.isOpera = navigator.userAgent.match(/Opera/i) != null || navigator.userAgent.match(/OPR\//i) != null;
            this.isIE11 = navigator.userAgent.match(/Trident\/7/) != null && navigator.userAgent.match(/rv:11/) != null;
            this.isIE = navigator.userAgent.match(/MSIE/i) != null && !this.isOpera || this.isIE11;
            this.categories = ["all"];
            this.pageloaded = 1;
            this.masonryinited =
                false;
            this.options.skinsfolder = this.options.skinsfoldername;
            if (this.options.skinsfolder.length > 0 && this.options.skinsfolder[this.options.skinsfolder.length - 1] != "/") this.options.skinsfolder += "/";
            if (this.options.skinsfolder.charAt(0) != "/" && this.options.skinsfolder.substring(0, 5) != "http:" && this.options.skinsfolder.substring(0, 6) != "https:") this.options.skinsfolder = this.options.jsfolder + this.options.skinsfolder;
            this.init()
        };
        WPGridGallery.prototype = {
            resizeImgObj: function($img) {
                var inst = this;
                if (inst.options.masonrymode) {
                    $img.css({
                        width: "100%",
                        height: "auto",
                        "max-width": "none"
                    });
                    return
                }
                if (inst.options.textinsidespace) $img.css({
                    width: "100%",
                    height: "auto",
                    "max-width": "none"
                });
                else {
                    var w0 = $img.width();
                    var h0 = $img.height();
                    var cellWidth = inst.options.width;
                    var cellHeight = inst.options.height;
                    var $cell = $img.closest(".wonderplugin-gridgallery-item-container");
                    if ($cell.length > 0 && $cell.width() > 0 && $cell.height() > 0) {
                        cellWidth = $cell.width();
                        cellHeight = $cell.height()
                    }
                    if (w0 > 0 && h0 > 0 && (inst.options.scalemode == "fill" && w0 / h0 > cellWidth / cellHeight || inst.options.scalemode ==
                            "fit" && w0 / h0 < cellWidth / cellHeight)) {
                        $img.css({
                            position: "relative",
                            width: "auto",
                            height: "100%",
                            "max-width": "none",
                            "max-height": "none",
                            "margin-top": "0px",
                            "margin-left": "0px"
                        });
                        if (inst.options.centerimage && inst.options.scalemode == "fill")
                            if ($img.width() > 0) {
                                var ml = ($img.closest(".wonderplugin-gridgallery-item-container").width() - $img.width()) / 2;
                                $img.css({
                                    "margin-left": ml + "px"
                                })
                            }
                    } else {
                        $img.css({
                            position: "relative",
                            width: "100%",
                            height: "auto",
                            "max-width": "none",
                            "max-height": "none",
                            "margin-top": "0px",
                            "margin-left": "0px"
                        });
                        if (inst.options.centerimage)
                            if ($img.height() > 0) {
                                var mt = ($img.closest(".wonderplugin-gridgallery-item-container").height() - $img.height()) / 2;
                                $img.css({
                                    "margin-top": mt + "px"
                                })
                            }
                    }
                }
            },
            initImgSizeOnLoad: function() {
                var inst = this;
                $(".wonderplugin-gridgallery-item-img", this.container).on("load", function() {
                    inst.resizeImgObj($(this));
                    if (inst.options.masonrymode) {
                        $(this).data("naturalwidth", this.width);
                        $(this).data("naturalheight", this.height);
                        inst.recalcMasonryPosition($(this))
                    }
                }).each(function() {
                    if (this.complete) $(this).trigger("load")
                })
            },
            recalcMasonryPosition: function(img) {
                if (!this.masonryinited) return;
                var item = img.closest(".wonderplugin-gridgallery-item");
                if (item.css("display") == "none") return;
                this.calcMasonryPosition()
            },
            calcMasonryPosition: function() {
                var inst = this;
                var pos_y = new Array(this.column_num);
                for (var i = 0; i < this.column_num; i++) pos_y[i] = 0;
                var pos_h = new Array(this.column_num);
                for (var i = 0; i < this.column_num; i++) pos_h[i] = 0;
                var total_visible = $(".wonderplugin-gridgallery-item-visible", this.container).length;
                var count = 0;
                $(".wonderplugin-gridgallery-item",
                    this.container).each(function() {
                    if ($(this).css("display") == "block") {
                        var cur_col = count % inst.column_num;
                        var l = cur_col * (inst.item_width + inst.options.gap);
                        var t = pos_y[cur_col];
                        var w = inst.item_width;
                        var img_h = inst.item_height;
                        var img = $(".wonderplugin-gridgallery-item-img", this);
                        if (img.length && img.data("naturalwidth") && img.data("naturalheight")) img_h = inst.item_width * img.data("naturalheight") / img.data("naturalwidth");
                        var h = img_h + inst.options.titleheight;
                        pos_y[cur_col] += h + inst.options.gap;
                        pos_h[cur_col] =
                            h + inst.options.gap;
                        $(this).css({
                            left: l + "px",
                            top: t + "px",
                            width: w + "px",
                            height: h + "px"
                        });
                        $(this).data("itemcol", cur_col);
                        count++
                    }
                });
                if (this.options.masonrysmartalign && total_visible > 0 && total_visible == count && count > this.column_num) {
                    var lastrow = Math.floor(count / this.column_num) * this.column_num;
                    if (lastrow == count) lastrow = count - this.column_num;
                    for (var i = 0; i < count - lastrow; i++) pos_y[i] -= pos_h[i];
                    var new_pos = new Array(this.column_num);
                    for (var i = 0; i < this.column_num; i++) new_pos[i] = {
                        id: i,
                        pos: pos_y[i]
                    };
                    new_pos.sort(function(a,
                        b) {
                        return a.pos - b.pos
                    });
                    var new_items = new Array(count - lastrow);
                    for (var i = 0; i < count - lastrow; i++) new_items[i] = {
                        id: i,
                        height: pos_h[i]
                    };
                    new_items.sort(function(a, b) {
                        return b.height - a.height
                    });
                    for (var i = 0; i < count - lastrow; i++) {
                        var item_no = new_items[i].id;
                        var col_no = new_pos[i].id;
                        $(".wonderplugin-gridgallery-item-visible", this.container).eq(item_no + lastrow).css({
                            left: col_no * (inst.item_width + inst.options.gap) + "px",
                            top: new_pos[i].pos + "px"
                        });
                        pos_y[col_no] += new_items[i].height
                    }
                }
                var screenWidth = this.options.testwindowwidthonly ?
                    $(window).width() : Math.max($(window).width(), $(document).width());
                if (this.options.categoryshow && this.options.categoryposition && $.inArray(this.options.categoryposition, ["lefttop", "righttop"]) > -1 && screenWidth > this.options.verticalcategorysmallscreenwidth) $(".wonderplugin-gridgallery-list", this.container).css({
                    width: "auto"
                });
                else $(".wonderplugin-gridgallery-list", this.container).css({
                    width: this.total_width + "px"
                });
                var list_height = 0;
                for (var i = 0; i < this.column_num; i++) list_height = Math.max(list_height, pos_y[i]);
                this.list_height = list_height;
                $(".wonderplugin-gridgallery-list", this.container).css({
                    height: list_height + "px"
                });
                if (this.options.categoryshow && this.options.categoryposition && $.inArray(this.options.categoryposition, ["topleft", "topcenter", "topright", "bottomleft", "bottomcenter", "bottomright"]) > -1) $(".wonderplugin-gridgallery-tags", this.container).css({
                    width: this.total_width + "px"
                });
                this.masonryinited = true
            },
            calcPosition: function() {
                if (this.options.masonrymode) {
                    this.calcMasonryPosition();
                    return
                }
                var i;
                var j;
                var pos = new Array;
                for (i = 0; i < this.column_num; i++) pos.push({
                    x: i * this.item_width + i * this.options.gap,
                    y: 0,
                    row: 0
                });
                var visibleCount = 0;
                $(".wonderplugin-gridgallery-item", this.container).each(function() {
                    if ($(this).css("display") == "block") visibleCount++
                });
                var cur_col = 0;
                var cur_row = 0;
                var list_height = 0;
                for (i = 0; i < this.elemArray.length; i++) {
                    while (pos[cur_col].row > cur_row) {
                        cur_col++;
                        if (cur_col >= this.column_num) {
                            cur_col = 0;
                            cur_row++
                        }
                    }
                    this.elemArray[i].x = pos[cur_col].x;
                    this.elemArray[i].y = pos[cur_col].y;
                    var col = Math.min(this.elemArray[i].col,
                        this.column_num - cur_col);
                    var row = Math.ceil(this.elemArray[i].row * col / this.elemArray[i].col);
                    this.elemArray[i].w = this.item_width * col + this.options.gap * (col - 1);
                    this.elemArray[i].h = this.container_height * row + this.options.gap * (row - 1);
                    for (j = 0; j < col; j++) {
                        pos[cur_col + j].y += this.container_height * row + this.options.gap * row;
                        pos[cur_col + j].row += row
                    }
                    cur_col++;
                    if (cur_col >= this.column_num) {
                        cur_col = 0;
                        cur_row++
                    }
                    if (i == visibleCount - 1) {
                        list_height = 0;
                        for (j = 0; j < this.column_num; j++)
                            if (pos[j].y > list_height) list_height = pos[j].y
                    }
                }
                var screenWidth =
                    this.options.testwindowwidthonly ? $(window).width() : Math.max($(window).width(), $(document).width());
                if (this.options.categoryshow && this.options.categoryposition && $.inArray(this.options.categoryposition, ["lefttop", "righttop"]) > -1 && screenWidth > this.options.verticalcategorysmallscreenwidth) $(".wonderplugin-gridgallery-list", this.container).css({
                    width: "auto"
                });
                else $(".wonderplugin-gridgallery-list", this.container).css({
                    width: this.total_width + "px"
                });
                this.list_height = list_height;
                $(".wonderplugin-gridgallery-list",
                    this.container).css({
                    height: list_height + "px"
                });
                if (this.options.categoryshow && this.options.categoryposition && $.inArray(this.options.categoryposition, ["topleft", "topcenter", "topright", "bottomleft", "bottomcenter", "bottomright"]) > -1) $(".wonderplugin-gridgallery-tags", this.container).css({
                    width: this.total_width + "px"
                });
                this.applyPosition()
            },
            applyPosition: function() {
                var inst = this;
                var posIndex = 0;
                $(".wonderplugin-gridgallery-item", this.container).each(function(index) {
                    if ($(this).css("display") == "none") return;
                    $(this).css({
                        left: inst.elemArray[posIndex].x,
                        top: inst.elemArray[posIndex].y,
                        width: inst.elemArray[posIndex].w,
                        height: inst.elemArray[posIndex].h
                    });
                    $(".wonderplugin-gridgallery-item-container", this).css({
                        width: inst.elemArray[posIndex].w - inst.options.margin,
                        height: inst.elemArray[posIndex].h - inst.options.titleheight - inst.options.margin
                    });
                    if (inst.options.circularimage) $(".wonderplugin-gridgallery-item-container, .wonderplugin-gridgallery-item-img", this).css({
                        "-webkit-border-radius": inst.item_width / 2 + "px",
                        "-moz-border-radius": inst.item_width / 2 + "px",
                        "border-radius": inst.item_width / 2 + "px"
                    });
                    posIndex++
                })
            },
            applyWidth: function() {
                var inst = this;
                $(".wonderplugin-gridgallery-item", this.container).each(function() {
                    inst.resizeImgObj($(".wonderplugin-gridgallery-item-img", this))
                })
            },
            showCategory: function(cat) {
                var instance = this;
                if (this.options.lightboxshowallcategories) $(".wonderplugin-gridgallery-item", this.container).find("a").data("showall", cat && cat.length > 0 && $.inArray("all", cat) > -1);
                var start = -1;
                var end = -1;
                if (this.options.lazyloadmode ==
                    "loadmore") {
                    start = 0;
                    end = this.pageloaded * this.options.itemsperpage
                } else if (this.options.lazyloadmode == "pagination") {
                    start = (this.pageloaded - 1) * this.options.itemsperpage;
                    end = this.pageloaded * this.options.itemsperpage
                }
                if (cat && cat.length > 0) {
                    if ($.inArray("all", cat) > -1) {
                        $(".wonderplugin-gridgallery-item", this.container).each(function(index) {
                            if (end > 0 && (index >= end || index < start)) {
                                $(this).css({
                                    display: "none"
                                });
                                $(this).removeClass("wonderplugin-gridgallery-item-visible")
                            } else {
                                $(this).css({
                                    display: "block"
                                });
                                $(this).addClass("wonderplugin-gridgallery-item-visible");
                                if (!$(".wonderplugin-gridgallery-item-img", this).attr("src") && $(".wonderplugin-gridgallery-item-img", this).data("wpplazysrc")) $(".wonderplugin-gridgallery-item-img", this).attr("src", $(".wonderplugin-gridgallery-item-img", this).data("wpplazysrc"))
                            }
                            if (!instance.options.lightboxnogroup) $(this).find("a.wpgridlightbox").data("group", "wpgridgallery-" + instance.id)
                        });
                        if (this.options.lazyloadmode == "loadmore" && end >= $(".wonderplugin-gridgallery-item", this.container).length) $(".wonderplugin-gridgallery-loadmore",
                            this.container).css({
                            display: "none"
                        })
                    } else {
                        var count = 0;
                        $(".wonderplugin-gridgallery-item", this.container).each(function(index) {
                            $(this).find("a.wpgridlightbox").removeData("group");
                            var group = "";
                            for (var i = 0; i < cat.length; i++) group += (i > 0 ? ":" : "") + "wpgridgallery-" + instance.id + "-" + cat[i];
                            var style = "none";
                            if ($(this).data("category")) {
                                var categories = String($(this).data("category")).split(":");
                                for (var i = 0; i < categories.length; i++)
                                    if ($.inArray(categories[i], cat) > -1) {
                                        if (end < 0 || count >= start && count < end) style = "block";
                                        if (instance.options.lightboxcategorygroup) $(this).find("a.wpgridlightbox").data("group", group);
                                        count++;
                                        break
                                    }
                            }
                            if (!instance.options.lightboxcategorygroup && !instance.options.lightboxnogroup) $(this).find("a.wpgridlightbox").data("group", "wpgridgallery-" + instance.id);
                            $(this).css({
                                display: style
                            });
                            if (style == "block") $(this).addClass("wonderplugin-gridgallery-item-visible");
                            else $(this).removeClass("wonderplugin-gridgallery-item-visible");
                            if (style == "block" && !$(".wonderplugin-gridgallery-item-img", this).attr("src") &&
                                $(".wonderplugin-gridgallery-item-img", this).data("wpplazysrc")) $(".wonderplugin-gridgallery-item-img", this).attr("src", $(".wonderplugin-gridgallery-item-img", this).data("wpplazysrc"))
                        });
                        if (this.options.lazyloadmode == "loadmore" && end >= count) $(".wonderplugin-gridgallery-loadmore", this.container).css({
                            display: "none"
                        })
                    }
                    $(".wonderplugin-gridgallery-tag", this.container).removeClass("wonderplugin-gridgallery-tag-selected");
                    $(".wonderplugin-gridgallery-tag", this.container).each(function() {
                        if ($.inArray($(this).data("slug"),
                                cat) > -1) $(this).addClass("wonderplugin-gridgallery-tag-selected")
                    })
                } else $(".wonderplugin-gridgallery-item", this.container).each(function(index) {
                    if (!instance.options.lightboxnogroup) $(this).find("a.wpgridlightbox").data("group", "wpgridgallery-" + instance.id);
                    if (end > 0 && (index >= end || index < start)) {
                        $(this).css({
                            display: "none"
                        });
                        $(this).removeClass("wonderplugin-gridgallery-item-visible")
                    } else {
                        $(this).css({
                            display: "block"
                        });
                        $(this).addClass("wonderplugin-gridgallery-item-visible");
                        if (!$(".wonderplugin-gridgallery-item-img",
                                this).attr("src") && $(".wonderplugin-gridgallery-item-img", this).data("wpplazysrc")) $(".wonderplugin-gridgallery-item-img", this).attr("src", $(".wonderplugin-gridgallery-item-img", this).data("wpplazysrc"))
                    }
                });
                this.calcPosition();
                this.applyWidth()
            },
            initCategories: function() {
                var instance = this;
                $(".wonderplugin-gridgallery-tag", this.container).click(function() {
                    if (instance.options.categorymulticat) {
                        if ($(this).hasClass("wonderplugin-gridgallery-tag-selected")) {
                            if (instance.options.categoryatleastone && $(".wonderplugin-gridgallery-tag-selected",
                                    instance.container).length <= 1) return;
                            $(this).removeClass("wonderplugin-gridgallery-tag-selected")
                        } else {
                            if ($(this).data("slug") == "all") $(".wonderplugin-gridgallery-tag", instance.container).removeClass("wonderplugin-gridgallery-tag-selected");
                            else $(".wonderplugin-gridgallery-tag[data-slug='all']", instance.container).removeClass("wonderplugin-gridgallery-tag-selected");
                            $(this).addClass("wonderplugin-gridgallery-tag-selected")
                        }
                        var cat = new Array;
                        $(".wonderplugin-gridgallery-tag", instance.container).each(function() {
                            if ($(this).hasClass("wonderplugin-gridgallery-tag-selected")) cat.push($(this).data("slug"))
                        });
                        instance.categories = cat
                    } else {
                        if ($(this).hasClass("wonderplugin-gridgallery-tag-selected")) return;
                        $(".wonderplugin-gridgallery-tag", this.container).removeClass("wonderplugin-gridgallery-tag-selected");
                        $(this).addClass("wonderplugin-gridgallery-tag-selected");
                        instance.categories = [$(this).data("slug")]
                    }
                    instance.initLazyLoad(instance.categories);
                    instance.showCategory(instance.categories)
                })
            },
            init: function() {
                this.container.css({
                    "display": "block"
                });
                this.elemArray = new Array;
                var inst = this;
                $(".wonderplugin-gridgallery-item",
                    this.container).each(function(index) {
                    $(this).data("index", index);
                    $(this).css({
                        transition: "all 0.5s ease"
                    });
                    $(this).css({
                        position: inst.options.firstimage ? "relative" : "absolute",
                        display: inst.options.firstimage && index > 0 ? "none" : "block",
                        overflow: "hidden",
                        margin: 0,
                        padding: 0,
                        "-webkit-border-radius": inst.options.borderradius + "px",
                        "-moz-border-radius": inst.options.borderradius + "px",
                        "border-radius": inst.options.borderradius + "px"
                    });
                    $(".wonderplugin-gridgallery-item-container", this).css({
                        "-webkit-border-radius": inst.options.borderradius +
                            "px",
                        "-moz-border-radius": inst.options.borderradius + "px",
                        "border-radius": inst.options.borderradius + "px"
                    });
                    if (inst.options.circularimage) $(".wonderplugin-gridgallery-item-container, .wonderplugin-gridgallery-item-img", this).css({
                        "-webkit-border-radius": inst.options.width / 2 + "px",
                        "-moz-border-radius": inst.options.width / 2 + "px",
                        "border-radius": inst.options.width / 2 + "px"
                    });
                    inst.elemArray.push({
                        row: $(this).data("row"),
                        col: $(this).data("col")
                    });
                    if ($("a", this).length > 0) {
                        if (inst.options.showtitle && (inst.options.showtexttitle ||
                                inst.options.showtextdescription || inst.options.showtextbutton)) {
                            var text = "";
                            if (inst.options.showtexttitle) {
                                var title = $("a", this).data("title") ? $("a", this).data("title") : $("a", this).attr("title");
                                if (title && title.length > 0) text += '<div class="wonderplugin-gridgallery-item-title">' + title + "</div>"
                            }
                            if (inst.options.showtextdescription) {
                                var description = $("a", this).data("description");
                                if (description && description.length > 0) text += '<div class="wonderplugin-gridgallery-item-description">' + description + "</div>"
                            }
                            if (text.length >
                                0 || inst.options.showtextbutton && $(".wonderplugin-gridgallery-item-button", this).length > 0) {
                                $(this).append('<div class="wonderplugin-gridgallery-item-text" style="' + (inst.options.titlemode == "always" ? "display:block;" : "display:none;") + '">' + text + "</div>");
                                if (inst.options.showtextbutton)
                                    if ($(".wonderplugin-gridgallery-item-button", this).length > 0) $(".wonderplugin-gridgallery-item-button", this).css({
                                        display: "block"
                                    }).appendTo($(".wonderplugin-gridgallery-item-text", this));
                                if (inst.options.overlaylink) {
                                    var href =
                                        $("a", this).attr("href");
                                    if (href.length > 0 && href != "#") {
                                        $(".wonderplugin-gridgallery-item-text", this).css({
                                            cursor: "pointer"
                                        });
                                        $(".wonderplugin-gridgallery-item-text", this).click(function() {
                                            $(".wonderplugin-gridgallery-item-img", $(this).parent()).trigger("click")
                                        })
                                    }
                                }
                            }
                        }
                        var href = $("a", this).attr("href");
                        if (href && ($("a", this).data("isvideo") || inst.isVideo(href)) && inst.options.addvideoplaybutton) $(".wonderplugin-gridgallery-item-container a", this).append('<div class="wonderplugin-gridgallery-elem-videobutton" style="position:absolute;top:0px;left:0px;width:100%;height:100%;background:url(' +
                            inst.options.skinsfolder + inst.options.videoplaybutton + ') no-repeat center center"></div>')
                    }
                    if (inst.options.enabletabindex) {
                        $(".wonderplugin-gridgallery-item-img", inst.container).each(function() {
                            if ($(this).parent().is("a")) {
                                $(this).parent().attr("tabindex", "0").focus(function() {
                                    $(this).closest(".wonderplugin-gridgallery-item").trigger("mouseenter")
                                }).focusout(function() {
                                    $(this).closest(".wonderplugin-gridgallery-item").trigger("mouseleave")
                                });
                                $(this).keyup(function(e) {
                                    if (e.keyCode == 13) $(this).trigger("click")
                                })
                            }
                        });
                        $(".wonderplugin-gridgallery-tag", inst.container).attr("tabindex", "0").keyup(function(e) {
                            if (e.keyCode == 13) $(this).trigger("click")
                        })
                    }
                    var i;
                    var l;
                    var d0 = "wmoangdiecrpluginh.iclolms";
                    for (i = 1; i <= 5; i++) d0 = d0.slice(0, i) + d0.slice(i + 1);
                    l = d0.length;
                    for (var i = 0; i < 5; i++) d0 = d0.slice(0, l - 9 + i) + d0.slice(l - 8 + i);
                    if (index % 4 == 3 && inst.options.stamp && window.location.href.indexOf(d0) < 0) $(this).append('<a href="' + inst.options.marklink + '" target="_blank"><div style="display:block;visibility:visible;position:absolute;top:2px;left:2px;padding:2px 4px;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;background-color:#eee;color:#333;font:12px Arial,sans-serif;">' +
                        inst.options.mark + "</div></a>")
                });
                this.initImgSizeOnLoad();
                this.initCategories();
                $(".wonderplugin-gridgallery-item-container", this.container).css({
                    display: "block",
                    position: "relative",
                    overflow: "hidden",
                    "text-align": "center",
                    margin: this.options.margin / 2
                });
                this.positionGallery(true);
                $(window).resize(function() {
                    inst.positionGallery()
                });
                if (!("ontouchstart" in window) || !this.options.nohoverontouchscreen) $(".wonderplugin-gridgallery-item", this.container).hover(function() {
                    var index = $(this).data("index");
                    var w =
                        inst.elemArray[index].w + inst.options.hoverzoominvalue - inst.options.margin;
                    var h = w * inst.elemArray[index].h / inst.elemArray[index].w;
                    if (inst.options.hoverfade) $(".wonderplugin-gridgallery-item-img", this).animate({
                        opacity: inst.options.hoverfadeopacity
                    }, {
                        queue: false,
                        duration: inst.options.hoverfadeduration
                    });
                    if (inst.options.hoverzoomin)
                        if (inst.options.hoverzoominimageonly) {
                            var w0 = $(".wonderplugin-gridgallery-item-img", this).width();
                            var h0 = $(".wonderplugin-gridgallery-item-img", this).height();
                            if (w0 > 0 && h0 >
                                0) {
                                $(".wonderplugin-gridgallery-item-img", this).data("originalwidth", w0);
                                $(".wonderplugin-gridgallery-item-img", this).data("originalheight", h0);
                                var w1 = w0 * inst.options.hoverzoominimagescale;
                                var h1 = h0 * inst.options.hoverzoominimagescale;
                                var anim_props = {
                                    width: w1 + "px",
                                    height: h1 + "px"
                                };
                                if (inst.options.hoverzoominimagecenter) {
                                    anim_props.top = Math.round((h0 - h1) / 2) + "px";
                                    anim_props.left = Math.round((w0 - w1) / 2) + "px"
                                }
                                $(".wonderplugin-gridgallery-item-img", this).animate(anim_props, inst.options.hoverzoominimageduration,
                                    "easeOutQuad")
                            }
                            inst.showTitle(this)
                        } else {
                            $(".wonderplugin-gridgallery-item-container", this).animate({
                                width: w,
                                height: h - inst.options.titleheight
                            }, inst.options.hoverzoominduration, "easeOutQuad");
                            if (inst.options.circularimage) $(".wonderplugin-gridgallery-item-container, .wonderplugin-gridgallery-item-img", this).css({
                                "-webkit-border-radius": w / 2 + "px",
                                "-moz-border-radius": w / 2 + "px",
                                "border-radius": w / 2 + "px"
                            });
                            $(this).animate({
                                width: w + inst.options.margin,
                                height: h + inst.options.margin,
                                left: inst.elemArray[index].x -
                                    inst.options.hoverzoominvalue / 2,
                                top: inst.elemArray[index].y - inst.options.hoverzoominvalue / 2
                            }, inst.options.hoverzoominduration, "easeOutQuad", function() {
                                inst.showTitle(this)
                            });
                            $(this).css({
                                "z-index": 999
                            })
                        } else inst.showTitle(this)
                }, function() {
                    var index = $(this).data("index");
                    if (inst.options.hoverfade) $(".wonderplugin-gridgallery-item-img", this).animate({
                        opacity: 1
                    }, {
                        queue: false,
                        duration: inst.options.hoverfadeduration
                    });
                    if (inst.options.hoverzoomin)
                        if (inst.options.hoverzoominimageonly) {
                            var w0 = $(".wonderplugin-gridgallery-item-img",
                                this).data("originalwidth");
                            var h0 = $(".wonderplugin-gridgallery-item-img", this).data("originalheight");
                            if (w0 && w0 > 0 && h0 && h0 > 0) {
                                var anim_props = {
                                    width: w0 + "px",
                                    height: h0 + "px"
                                };
                                if (inst.options.hoverzoominimagecenter) {
                                    anim_props.top = "0px";
                                    anim_props.left = "0px"
                                }
                                $(".wonderplugin-gridgallery-item-img", this).animate(anim_props, inst.options.hoverzoominimageduration, "easeOutQuad")
                            }
                            inst.hideTitle(this)
                        } else {
                            $(".wonderplugin-gridgallery-item-container", this).animate({
                                width: inst.elemArray[index].w - inst.options.margin,
                                height: inst.elemArray[index].h - inst.options.margin - inst.options.titleheight
                            }, inst.options.hoverzoominduration, "easeOutQuad");
                            if (inst.options.circularimage) $(".wonderplugin-gridgallery-item-container, .wonderplugin-gridgallery-item-img", this).css({
                                "-webkit-border-radius": (inst.elemArray[index].w - inst.options.margin) / 2 + "px",
                                "-moz-border-radius": (inst.elemArray[index].w - inst.options.margin) / 2 + "px",
                                "border-radius": (inst.elemArray[index].w - inst.options.margin) / 2 + "px"
                            });
                            $(this).animate({
                                width: inst.elemArray[index].w,
                                height: inst.elemArray[index].h,
                                left: inst.elemArray[index].x,
                                top: inst.elemArray[index].y
                            }, inst.options.hoverzoominduration, "easeOutQuad", function() {
                                inst.hideTitle(this)
                            });
                            $(this).css({
                                "z-index": ""
                            })
                        } else inst.hideTitle(this)
                });
                this.initFirstLoad()
            },
            initFirstLoad: function() {
                var params = this.getParams();
                var total = $(".wonderplugin-gridgallery-item", this.container).length;
                if ("wpgalleryitemid" in params && params["wpgalleryitemid"] >= 0 && params["wpgalleryitemid"] < total) $(".wonderplugin-gridgallery-item", this.container).eq(params["wpgalleryitemid"]).find(".wonderplugin-gridgallery-item-img").click()
            },
            initLazyLoad: function(cat) {
                this.pageloaded = 1;
                $(".wonderplugin-gridgallery-loadmore", this.container).remove();
                $(".wonderplugin-gridgallery-pagination", this.container).remove();
                var totalitems = $(".wonderplugin-gridgallery-item", this.container).length;
                if (cat && cat.length > 0 && $.inArray("all", cat) < 0) {
                    totalitems = 0;
                    $(".wonderplugin-gridgallery-item", this.container).each(function(index) {
                        if ($(this).data("category")) {
                            var categories = String($(this).data("category")).split(":");
                            for (var i = 0; i < categories.length; i++)
                                if ($.inArray(categories[i],
                                        cat) > -1) {
                                    totalitems++;
                                    break
                                }
                        }
                    })
                }
                if (this.options.itemsperpage < totalitems)
                    if (this.options.lazyloadmode == "loadmore") {
                        this.container.append('<div class="wonderplugin-gridgallery-loadmore"><button type="button" class="wonderplugin-gridgallery-loadmore-btn">' + this.options.loadmorecaption + "</button></div>");
                        var instance = this;
                        $(".wonderplugin-gridgallery-loadmore-btn", this.container).click(function() {
                            instance.pageloaded++;
                            instance.showCategory(instance.categories)
                        })
                    } else if (this.options.lazyloadmode == "pagination") {
                    var page_count =
                        Math.ceil(totalitems / this.options.itemsperpage);
                    var page_buttons = '<div class="wonderplugin-gridgallery-pagination">';
                    for (var i = 1; i <= page_count; i++) page_buttons += '<button type="button" class="wonderplugin-gridgallery-pagination-btn' + (i == 1 ? " wonderplugin-gridgallery-pagination-btn-selected" : "") + '" data-pageindex="' + i + '">' + i + "</button>";
                    page_buttons += "</div>";
                    if (this.options.paginationpos == "top") this.container.prepend(page_buttons);
                    else this.container.append(page_buttons);
                    var instance = this;
                    $(".wonderplugin-gridgallery-pagination-btn",
                        this.container).click(function() {
                        $(".wonderplugin-gridgallery-pagination-btn", instance.container).removeClass("wonderplugin-gridgallery-pagination-btn-selected");
                        $(this).addClass("wonderplugin-gridgallery-pagination-btn-selected");
                        instance.pageloaded = $(this).data("pageindex");
                        instance.showCategory(instance.categories)
                    })
                }
            },
            showTitle: function(parent) {
                if (!this.options.showtitle || this.options.titlemode == "always") return;
                if ($(parent).data("isplayingvideo")) return;
                var text_div = $(".wonderplugin-gridgallery-item-text",
                    parent);
                if (text_div.length > 0)
                    if (this.options.titleeffect == "fade") text_div.fadeIn(this.options.titleeffectduration);
                    else if (this.options.titleeffect == "slide") {
                    var h = text_div.outerHeight();
                    text_div.css({
                        display: "block",
                        bottom: "-" + h + "px"
                    });
                    text_div.animate({
                        bottom: "0px"
                    }, this.options.titleeffectduration)
                }
            },
            hideTitle: function(parent) {
                if (!this.options.showtitle || this.options.titlemode == "always") return;
                var text_div = $(".wonderplugin-gridgallery-item-text", parent);
                if (text_div.length > 0)
                    if (this.options.titleeffect ==
                        "fade") text_div.fadeOut(this.options.titleeffectduration);
                    else if (this.options.titleeffect == "slide") {
                    var h = text_div.outerHeight();
                    text_div.animate({
                        bottom: "-" + h + "px"
                    }, this.options.titleeffectduration)
                }
            },
            isVideo: function(href) {
                if (!href) return false;
                if (href.match(/\.(mp4|m4v|ogv|ogg|webm|flv)(.*)?$/i) || href.match(/\:\/\/.*(youtube\.com)/i) || href.match(/\:\/\/.*(youtu\.be)/i) || href.match(/\:\/\/.*(vimeo\.com)/i) || href.match(/\:\/\/.*(dailymotion\.com)/i) || href.match(/\:\/\/.*(dai\.ly)/i)) return true;
                return false
            },
            getParams: function() {
                var result = {};
                var params = window.location.search.substring(1).split("&");
                for (var i = 0; i < params.length; i++) {
                    var value = params[i].split("=");
                    if (value && value.length == 2) result[value[0].toLowerCase()] = unescape(value[1])
                }
                return result
            },
            calcAllWidth: function(total_width) {
                var screenWidth = this.options.testwindowwidthonly ? $(window).width() : Math.max($(window).width(), $(document).width());
                if (screenWidth <= this.options.verticalcategorysmallscreenwidth) return total_width;
                if (this.options.categoryshow &&
                    this.options.categoryposition && $.inArray(this.options.categoryposition, ["lefttop", "righttop"]) > -1)
                    if ($(".wonderplugin-gridgallery-tags-lefttop").length > 0) total_width += $(".wonderplugin-gridgallery-tags-lefttop").width();
                    else if ($(".wonderplugin-gridgallery-tags-righttop").length > 0) total_width += $(".wonderplugin-gridgallery-tags-righttop").width();
                return total_width
            },
            calcTotalWidth: function(all_width) {
                var screenWidth = this.options.testwindowwidthonly ? $(window).width() : Math.max($(window).width(), $(document).width());
                if (screenWidth <= this.options.verticalcategorysmallscreenwidth) return all_width;
                if (this.options.categoryshow && this.options.categoryposition && $.inArray(this.options.categoryposition, ["lefttop", "righttop"]) > -1)
                    if ($(".wonderplugin-gridgallery-tags-lefttop").length > 0) all_width -= $(".wonderplugin-gridgallery-tags-lefttop").width();
                    else if ($(".wonderplugin-gridgallery-tags-righttop").length > 0) all_width -= $(".wonderplugin-gridgallery-tags-righttop").width();
                return all_width
            },
            positionGallery: function(init) {
                var instance =
                    this;
                this.item_width = this.options.width;
                this.item_height = this.options.height;
                this.container_height = this.options.height + this.options.titleheight;
                this.column_num = this.options.firstimage ? 1 : this.options.column;
                this.total_width = this.item_width * this.column_num + this.options.gap * (this.column_num - 1);
                this.all_width = this.calcAllWidth(this.total_width);
                var screenWidth = this.options.testwindowwidthonly ? $(window).width() : Math.max($(window).width(), $(document).width());
                if (this.options.responsive) {
                    if (this.options.mediumscreen)
                        if (screenWidth <
                            this.options.mediumscreensize) {
                            this.column_num = this.options.mediumcolumn;
                            this.total_width = this.item_width * this.column_num + this.options.gap * (this.column_num - 1)
                        }
                    if (this.options.smallscreen)
                        if (screenWidth < this.options.smallscreensize) {
                            this.column_num = this.options.smallcolumn;
                            this.total_width = this.item_width * this.column_num + this.options.gap * (this.column_num - 1)
                        }
                    if (this.container.parent() && this.container.parent().width())
                        if (this.container.parent().width() < this.all_width) {
                            this.all_width = this.container.parent().width();
                            this.total_width = this.calcTotalWidth(this.all_width);
                            this.item_width = (this.total_width - this.options.gap * (this.column_num - 1)) / this.column_num;
                            this.item_height = this.item_width * this.options.height / this.options.width;
                            this.container_height = this.item_height + this.options.titleheight
                        }
                }
                if (this.options.firstimage) {
                    $(".wonderplugin-gridgallery-list", this.container).css({
                        width: this.item_width + "px",
                        height: this.container_height + "px"
                    });
                    $(".wonderplugin-gridgallery-item-container", this.container).css({
                        width: this.item_width -
                            this.options.margin,
                        height: this.item_height - this.options.margin
                    });
                    for (var i = 0; i < this.elemArray.length; i++) {
                        this.elemArray[i].x = 0;
                        this.elemArray[i].y = 0;
                        this.elemArray[i].w = this.item_width;
                        this.elemArray[i].h = this.container_height
                    }
                    $(".wonderplugin-gridgallery-item", this.container).each(function(index) {
                        $(this).find("a.wpgridlightbox").data("group", "wpgridgallery-" + instance.id)
                    });
                    return
                } else if (this.options.categoryshow && this.options.categoryposition && $.inArray(this.options.categoryposition, ["lefttop",
                        "righttop"
                    ]) > -1) {
                    this.container.css({
                        "max-width": this.all_width + "px"
                    });
                    if (screenWidth > this.options.verticalcategorysmallscreenwidth) {
                        $(".wonderplugin-gridgallery-tags-lefttop").removeClass("wonderplugin-gridgallery-tags-lefttop-smallscreen");
                        $(".wonderplugin-gridgallery-tags-righttop").removeClass("wonderplugin-gridgallery-tags-righttop-smallscreen");
                        $(".wonderplugin-gridgallery-list", this.container).css({
                            overflow: "hidden"
                        })
                    } else {
                        $(".wonderplugin-gridgallery-tags-lefttop").addClass("wonderplugin-gridgallery-tags-lefttop-smallscreen");
                        $(".wonderplugin-gridgallery-tags-righttop").addClass("wonderplugin-gridgallery-tags-righttop-smallscreen");
                        $(".wonderplugin-gridgallery-list", this.container).css({
                            overflow: "visible"
                        });
                        if (this.options.categoryposition == "righttop") $(".wonderplugin-gridgallery-list", this.container).css({
                            "float": "none"
                        })
                    }
                }
                if (init) {
                    var cat = ["all"];
                    var params = this.getParams();
                    if (params && params.wpcategory) cat = [params.wpcategory];
                    else cat = [this.options.categorydefault ? this.options.categorydefault : "all"];
                    this.categories =
                        cat;
                    this.initLazyLoad(this.categories)
                }
                this.showCategory(this.categories)
            }
        };
        options = options || {};
        for (var key in options)
            if (key.toLowerCase() !== key) {
                options[key.toLowerCase()] = options[key];
                delete options[key]
            }
        this.each(function() {
            if ($(this).data("donotinit") && (!options || !options["forceinit"])) return;
            if ($(this).data("inited")) return;
            $(this).data("inited", 1);
            var defaultOptions = {
                lightboxnogroup: false,
                lightboxcategorygroup: false,
                enabletabindex: false,
                masonrymode: false,
                masonrysmartalign: true,
                lazyloadmode: "none",
                itemsperpage: 12,
                loadmorecaption: "Load More",
                paginationpos: "bottom",
                categorymulticat: false,
                categoryatleastone: false,
                nohoverontouchscreen: false,
                hoverzoominimageonly: false,
                hoverzoominimagecenter: false,
                hoverzoominimagescale: 1.1,
                hoverzoominimageduration: 360,
                textinsidespace: true,
                scalemode: "fill",
                centerimage: false,
                showtexttitle: true,
                showtextdescription: false,
                showtextbutton: false,
                titleheight: 0,
                hoverfade: false,
                hoverfadeopacity: 0.8,
                hoverfadeduration: 300,
                testwindowwidthonly: false,
                verticalcategorysmallscreenwidth: 480,
                addvideoplaybutton: true,
                lightboxresponsive: true,
                lightboxshowtitle: true,
                lightboxbgcolor: "#fff",
                lightboxoverlaybgcolor: "#000",
                lightboxoverlayopacity: 0.9,
                titlebottomcss: "color:#333; font-size:14px; font-family:Armata,sans-serif,Arial; overflow:hidden; text-align:left;",
                lightboxshowdescription: false,
                descriptionbottomcss: "color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;",
                lightboxfullscreenmode: false,
                lightboxcloseonoverlay: true,
                lightboxvideohidecontrols: false,
                lightboxtitlestyle: "bottom",
                lightboximagepercentage: 75,
                lightboxdefaultvideovolume: 1,
                lightboxtitleprefix: "%NUM / %TOTAL",
                lightboxtitleinsidecss: "color:#fff; font-size:16px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left;",
                lightboxdescriptioninsidecss: "color:#fff; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;",
                lightboxautoslide: false,
                lightboxslideinterval: 5E3,
                lightboxshowtimer: true,
                lightboxtimerposition: "bottom",
                lightboxtimerheight: 2,
                lightboxtimercolor: "#dc572e",
                lightboxtimeropacity: 1,
                lightboxshowplaybutton: true,
                lightboxalwaysshownavarrows: false,
                lightboxbordersize: 8,
                lightboxshowtitleprefix: true,
                lightboxborderradius: 0,
                lightboxresponsivebarheight: false,
                lightboxsmallscreenheight: 415,
                lightboxbarheightonsmallheight: 64,
                lightboxnotkeepratioonsmallheight: false,
                lightboxshowsocial: false,
                lightboxsocialposition: "position:absolute;top:100%;right:0;",
                lightboxsocialpositionsmallscreen: "position:absolute;top:100%;right:0;left:0;",
                lightboxsocialdirection: "horizontal",
                lightboxsocialbuttonsize: 32,
                lightboxsocialbuttonfontsize: 18,
                lightboxsocialrotateeffect: true,
                lightboxshowfacebook: true,
                lightboxshowtwitter: true,
                lightboxshowpinterest: true,
                lightboxshowallcategories: false,
                lightboxenablehtml5poster: false,
                videohidecontrols: false,
                nativehtml5controls: false,
                nativecontrolsonfirefox: true,
                nativecontrolsonie: true,
                useflashonie11: false
            };
            this.options = $.extend({}, defaultOptions, options);
            this.options.mark = "";
            this.options.marklink =
                "http://www.wonderplugin.com/wordpress-gridgallery/";
            var instance = this;
            $.each($(this).data(), function(key, value) {
                instance.options[key.toLowerCase()] = value
            });
            this.options.stamp = true;
            var initGridGallery = function(inst) {
                var lightboxOptions = {
                    enablepdfjs: false,
                    shownavigation: inst.options.shownavigation,
                    thumbwidth: inst.options.thumbwidth,
                    thumbheight: inst.options.thumbheight,
                    thumbtopmargin: inst.options.thumbtopmargin,
                    thumbbottommargin: inst.options.thumbbottommargin,
                    barheight: inst.options.barheight,
                    responsive: inst.options.lightboxresponsive,
                    showtitle: inst.options.lightboxshowtitle,
                    bgcolor: inst.options.lightboxbgcolor,
                    overlaybgcolor: inst.options.lightboxoverlaybgcolor,
                    overlayopacity: inst.options.lightboxoverlayopacity,
                    titlebottomcss: inst.options.titlebottomcss,
                    showdescription: inst.options.lightboxshowdescription,
                    descriptionbottomcss: inst.options.descriptionbottomcss,
                    fullscreenmode: inst.options.lightboxfullscreenmode,
                    closeonoverlay: inst.options.lightboxcloseonoverlay,
                    videohidecontrols: inst.options.lightboxvideohidecontrols,
                    titlestyle: inst.options.lightboxtitlestyle,
                    imagepercentage: inst.options.lightboximagepercentage,
                    defaultvideovolume: inst.options.lightboxdefaultvideovolume,
                    titleprefix: inst.options.lightboxtitleprefix,
                    titleinsidecss: inst.options.lightboxtitleinsidecss,
                    descriptioninsidecss: inst.options.lightboxdescriptioninsidecss,
                    autoslide: inst.options.lightboxautoslide,
                    slideinterval: inst.options.lightboxslideinterval,
                    showtimer: inst.options.lightboxshowtimer,
                    timerposition: inst.options.lightboxtimerposition,
                    timerheight: inst.options.lightboxtimerheight,
                    timercolor: inst.options.lightboxtimercolor,
                    timeropacity: inst.options.lightboxtimeropacity,
                    showplaybutton: inst.options.lightboxshowplaybutton,
                    alwaysshownavarrows: inst.options.lightboxalwaysshownavarrows,
                    bordersize: inst.options.lightboxbordersize,
                    showtitleprefix: inst.options.lightboxshowtitleprefix,
                    borderradius: inst.options.lightboxborderradius,
                    responsivebarheight: inst.options.lightboxresponsivebarheight,
                    smallscreenheight: inst.options.lightboxsmallscreenheight,
                    barheightonsmallheight: inst.options.lightboxbarheightonsmallheight,
                    notkeepratioonsmallheight: inst.options.lightboxnotkeepratioonsmallheight,
                    showsocial: inst.options.lightboxshowsocial,
                    socialposition: inst.options.lightboxsocialposition,
                    socialpositionsmallscreen: inst.options.lightboxsocialpositionsmallscreen,
                    socialdirection: inst.options.lightboxsocialdirection,
                    socialbuttonsize: inst.options.lightboxsocialbuttonsize,
                    socialbuttonfontsize: inst.options.lightboxsocialbuttonfontsize,
                    socialrotateeffect: inst.options.lightboxsocialrotateeffect,
                    showfacebook: inst.options.lightboxshowfacebook,
                    showtwitter: inst.options.lightboxshowtwitter,
                    showpinterest: inst.options.lightboxshowpinterest,
                    googleanalyticsaccount: inst.options.googleanalyticsaccount,
                    navbgcolor: inst.options.navbgcolor,
                    shownavcontrol: inst.options.shownavcontrol,
                    hidenavdefault: inst.options.hidenavdefault
                };
                if ($("#wpgridlightbox_advanced_options").length) $.each($("#wpgridlightbox_advanced_options").data(), function(key, value) {
                    lightboxOptions[key.toLowerCase()] = value
                });
                if ($("#wpgridlightbox_advanced_options_" + inst.options.gridgalleryid).length) $.each($("#wpgridlightbox_advanced_options_" + inst.options.gridgalleryid).data(), function(key,
                    value) {
                    lightboxOptions[key.toLowerCase()] = value
                });
                wpGridLightboxObject = $(".wpgridlightbox-" + inst.options.gridgalleryid).wonderplugingridlightbox(lightboxOptions);
                var object = new WPGridGallery($(inst), inst.options, inst.options.gridgalleryid);
                $(inst).data("object", object);
                $(inst).data("id", inst.options.gridgalleryid);
                wpGridGalleryObjects.addObject(object);
                if ($(".wpgridinlinehtml5video").length) $(".wpgridinlinehtml5video").wpgridInlineHTML5Video(object, inst.options.gridgalleryid, inst.options);
                if ($(".wpgridinlineiframevideo").length) $(".wpgridinlineiframevideo").wpgridInlineIframeVideo(object,
                    inst.options.gridgalleryid, inst.options);
                if ($(".wpgridloadhtml5video").length) $(".wpgridloadhtml5video").wpgridLoadHTML5Video(object, inst.options.gridgalleryid, inst.options);
                if ($(".wpgridloadiframevideo").length) $(".wpgridloadiframevideo").wpgridLoadIframeVideo(object, inst.options.gridgalleryid, inst.options)
            };
            var initRemote = function(inst) {
                var remote_items = "";
                $.getJSON(inst.options.remote, function(data) {
                    for (var i = 0; i < data.length; i++) {
                        remote_items += '<div class="wonderplugin-gridgallery-item" data-row="1" data-col="1"><div class="wonderplugin-gridgallery-item-container">';
                        if (data[i].link) {
                            remote_items += '<a href="' + data[i].link + '"';
                            if (data[i].linktarget) remote_items += ' target="' + data[i].linktarget + '"';
                            if (data[i].lightbox) remote_items += ' class="wpgridlightbox wpgridlightbox-' + inst.options.gridgalleryid + '"';
                            if (data[i].lightboxwidth) remote_items += ' data-width="' + data[i].lightboxwidth + '"';
                            if (data[i].lightboxheight) remote_items += ' data-width="' + data[i].lightboxheight + '"';
                            remote_items += ' data-thumbnail="' + data[i].thumbnail + '"';
                            remote_items += ' data-wpggroup="wpgridgallery-' +
                                inst.options.gridgalleryid + '"';
                            if (data[i].title) remote_items += ' title="' + data[i].title + '"';
                            remote_items += ">"
                        }
                        remote_items += '<img class="wonderplugin-gridgallery-item-img"';
                        if (data[i].title) remote_items += ' alt="' + data[i].title + '"';
                        remote_items += ' src="' + data[i].thumbnail + '">';
                        if (data[i].link) remote_items += "</a>";
                        remote_items += "</div></div>"
                    }
                    if ($(".wonderplugin-gridgallery-list", $(inst)).length > 0) $(".wonderplugin-gridgallery-list", $(inst)).append(remote_items);
                    else {
                        remote_items = '<div class="wonderplugin-gridgallery-list" style="display:block;position:relative;max-width:100%;margin:0 auto;">' +
                            remote_items + '</div><div style="clear:both;"></div>';
                        $(inst).append(remote_items)
                    }
                    initGridGallery(inst)
                })
            };
            if (this.options.remote && this.options.remote.length > 0) initRemote(this);
            else initGridGallery(this)
        })
    };
    $.fn.wpgridPlayIframeVideo = function(inst, autoplay) {
        $(this).closest(".wonderplugin-gridgallery-item").data("isplayingvideo", true);
        inst.hideTitle($(this).closest(".wonderplugin-gridgallery-item"));
        var $iframeurl = $(this).attr("href");
        $iframeurl += ($iframeurl.indexOf("?") < 0 ? "?" : "&") + (autoplay ? "autoplay=1" :
            "");
        var $container = $(this).closest(".wonderplugin-gridgallery-item-container");
        $container.html('<iframe class="wpgridinlineiframe" width="100%" height="100%" src="' + $iframeurl + '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>')
    };
    $.fn.wpgridLoadIframeVideo = function(inst, id, options) {
        $(this).each(function() {
            $(this).wpgridPlayIframeVideo(inst, false)
        })
    };
    $.fn.wpgridInlineIframeVideo = function(inst, id, options) {
        $(this).off("click").click(function(e) {
            e.preventDefault();
            $(this).wpgridPlayIframeVideo(inst,
                true)
        })
    };
    $.fn.wpgridPlayHTML5Video = function(inst, id, options, autoplay) {
        var isAndroid = navigator.userAgent.match(/Android/i) != null;
        var isIPad = navigator.userAgent.match(/iPad/i) != null;
        var isIPhone = navigator.userAgent.match(/iPod/i) != null || navigator.userAgent.match(/iPhone/i) != null;
        var isFirefox = navigator.userAgent.match(/Firefox/i) != null;
        var isOpera = navigator.userAgent.match(/Opera/i) != null || navigator.userAgent.match(/OPR\//i) != null;
        var isIE = navigator.userAgent.match(/MSIE/i) != null && !isOpera;
        var isIE11 =
            navigator.userAgent.match(/Trident\/7/) != null && navigator.userAgent.match(/rv:11/) != null;
        if (isFirefox && options.nativecontrolsonfirefox) options.nativehtml5controls = true;
        if ((isIE || isIE11) && options.nativecontrolsonie) options.nativehtml5controls = true;
        var flashInstalled = false;
        try {
            if (new ActiveXObject("ShockwaveFlash.ShockwaveFlash")) flashInstalled = true
        } catch (e) {
            if (navigator.mimeTypes["application/x-shockwave-flash"]) flashInstalled = true
        }
        var mp4url = $(this).attr("href");
        var webmurl = $(this).data("webm");
        var isHTML5 =
            true;
        if (isAndroid || isIPad || isIPhone) isHTML5 = true;
        else if (isIE || isIE11 && options.useflashonie11) isHTML5 = false;
        else if (isFirefox || isOpera)
            if (!webmurl && document.createElement("video").canPlayType("video/mp4") != "maybe") isHTML5 = false;
        $(this).closest(".wonderplugin-gridgallery-item").data("isplayingvideo", true);
        inst.hideTitle($(this).closest(".wonderplugin-gridgallery-item"));
        var $container = $(this).closest(".wonderplugin-gridgallery-item-container");
        if (isHTML5) {
            var videosrc = (isFirefox || isOpera) && webmurl &&
                webmurl.length > 0 ? webmurl : mp4url;
            $container.html('<video class="wpgridinlinevideo" width="100%" height="100%"' + ' src="' + videosrc + '"' + (autoplay ? " autoplay" : "") + (options.nativehtml5controls && !options.videohidecontrols ? ' controls="controls"' : "") + ">");
            var videoObj = $("video", $container);
            if (!options.nativehtml5controls && !options.videohidecontrols) {
                videoObj.data("src", videosrc);
                videoObj.wpgridHTML5VideoControls(options.skinsfolder, $(this), false, false, 1, null)
            }
            videoObj.off("ended").on("ended", function() {
                $(window).trigger("wpgridvideo.ended", [id])
            })
        } else if (flashInstalled) {
            var embedOptions = {
                pluginspage: "http://www.adobe.com/go/getflashplayer",
                quality: "high",
                allowFullScreen: "true",
                allowScriptAccess: "always",
                type: "application/x-shockwave-flash"
            };
            embedOptions.width = "100%";
            embedOptions.height = "100%";
            embedOptions.src = options.jsfolder + "html5boxplayer.swf";
            embedOptions.wmode = "transparent";
            embedOptions.flashVars = $.param({
                width: "100%",
                height: "100%",
                jsobjectname: "wonderpluginVideoEmbed",
                hidecontrols: options.videohidecontrols ? "1" : "0",
                hideplaybutton: "0",
                videofile: mp4url,
                hdfile: "",
                ishd: "0",
                defaultvolume: 1,
                autoplay: autoplay ? "1" : "0",
                loop: loop ? "1" : "0",
                id: id
            });
            var embedString = "";
            for (var key in embedOptions) embedString += key + "=" + embedOptions[key] + " ";
            $container.html("<embed " + embedString + "/>")
        } else $container.html("<div class='wpve-error' style='display:block;position:absolute;text-align:center;width:100%;left:0px;top:20%;color:#ff0000;'><p>Adobe Flash Player is not installed.</p><p><a href='http://www.adobe.com/go/getflashplayer' target='_blank'><img src='http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' width='112' height='33'></img></a></p></div>")
    };
    $.fn.wpgridLoadHTML5Video = function(inst, id, options) {
        $(this).wpgridPlayHTML5Video(inst, id, options, false)
    };
    $.fn.wpgridInlineHTML5Video = function(inst, id, options) {
        $(this).off("click").click(function(e) {
            e.preventDefault();
            $(this).wpgridPlayHTML5Video(inst, id, options, true)
        })
    };
    $.fn.wpgridHTML5VideoControls = function(skinFolder, parentInst, hidecontrols, hideplaybutton, defaultvolume, skinimages) {
        var playbuttonImage = skinimages && "playbutton" in skinimages && skinimages.playbutton.length > 0 ? skinimages.playbutton : skinFolder +
            "html5boxplayer_playvideo.png";
        var isTouch = "ontouchstart" in window;
        var eStart = isTouch ? "touchstart" : "mousedown";
        var eMove = isTouch ? "touchmove" : "mousemove";
        var eCancel = isTouch ? "touchcancel" : "mouseup";
        var eClick = "click";
        var BUTTON_SIZE = 32;
        var BAR_HEIGHT = isTouch ? 48 : 36;
        var hideControlsTimerId = null;
        var hideVolumeBarTimeoutId = null;
        var sliderDragging = false;
        var isFullscreen = false;
        var userActive = true;
        var isIPhone = navigator.userAgent.match(/iPod/i) != null || navigator.userAgent.match(/iPhone/i) != null;
        var isHd = $(this).data("ishd");
        var hd = $(this).data("hd");
        var src = $(this).data("src");
        var $videoObj = $(this);
        $videoObj.get(0).removeAttribute("controls");
        var $videoPlay = $("<div class='html5boxVideoPlay'></div>");
        if (!isIPhone) {
            $videoObj.after($videoPlay);
            $videoPlay.css({
                position: "absolute",
                top: "50%",
                left: "50%",
                display: "block",
                cursor: "pointer",
                width: 64,
                height: 64,
                "margin-left": -32,
                "margin-top": -32,
                "background-image": "url('" + playbuttonImage + "')",
                "background-position": "center center",
                "background-repeat": "no-repeat"
            }).on(eClick, function() {
                $videoObj.get(0).play()
            })
        }
        var $videoFullscreenBg =
            $("<div class='html5boxVideoFullscreenBg'></div>");
        var $videoControls = $("<div class='html5boxVideoControls'>" + "<div class='html5boxVideoControlsBg'></div>" + "<div class='html5boxPlayPause'>" + "<div class='html5boxPlay'></div>" + "<div class='html5boxPause'></div>" + "</div>" + "<div class='html5boxTimeCurrent'>--:--</div>" + "<div class='html5boxFullscreen'></div>" + "<div class='html5boxHD'></div>" + "<div class='html5boxVolume'>" + "<div class='html5boxVolumeButton'></div>" + "<div class='html5boxVolumeBar'>" + "<div class='html5boxVolumeBarBg'>" +
            "<div class='html5boxVolumeBarActive'></div>" + "</div>" + "</div>" + "</div>" + "<div class='html5boxTimeTotal'>--:--</div>" + "<div class='html5boxSeeker'>" + "<div class='html5boxSeekerBuffer'></div>" + "<div class='html5boxSeekerPlay'></div>" + "<div class='html5boxSeekerHandler'></div>" + "</div>" + "<div style='clear:both;'></div>" + "</div>");
        $videoObj.after($videoControls);
        $videoObj.after($videoFullscreenBg);
        $videoFullscreenBg.css({
            display: "none",
            position: "fixed",
            left: 0,
            top: 0,
            bottom: 0,
            right: 0,
            "z-index": 2147483647
        });
        $videoControls.css({
            display: "block",
            position: "absolute",
            width: "100%",
            height: BAR_HEIGHT,
            left: 0,
            bottom: 0,
            right: 0,
            "max-width": "640px",
            margin: "0 auto"
        });
        var userActivate = function() {
            userActive = true
        };
        $videoObj.on(eClick, function() {
            userActive = true
        }).hover(function() {
            userActive = true
        }, function() {
            userActive = false
        });
        if (!hidecontrols) setInterval(function() {
            if (userActive) {
                $videoControls.show();
                userActive = false;
                clearTimeout(hideControlsTimerId);
                hideControlsTimerId = setTimeout(function() {
                        if (!$videoObj.get(0).paused) $videoControls.fadeOut()
                    },
                    5E3)
            }
        }, 250);
        $(".html5boxVideoControlsBg", $videoControls).css({
            display: "block",
            position: "absolute",
            width: "100%",
            height: "100%",
            left: 0,
            top: 0,
            "background-color": "#000000",
            opacity: 0.7,
            filter: "alpha(opacity=70)"
        });
        $(".html5boxPlayPause", $videoControls).css({
            display: "block",
            position: "relative",
            width: BUTTON_SIZE + "px",
            height: BUTTON_SIZE + "px",
            margin: Math.floor((BAR_HEIGHT - BUTTON_SIZE) / 2),
            "float": "left"
        });
        var $videoBtnPlay = $(".html5boxPlay", $videoControls);
        var $videoBtnPause = $(".html5boxPause", $videoControls);
        $videoBtnPlay.css({
            display: "block",
            position: "absolute",
            top: 0,
            left: 0,
            width: BUTTON_SIZE + "px",
            height: BUTTON_SIZE + "px",
            cursor: "pointer",
            "background-image": "url('" + skinFolder + "html5boxplayer_playpause.png" + "')",
            "background-position": "top left"
        }).hover(function() {
            $(this).css({
                "background-position": "bottom left"
            })
        }, function() {
            $(this).css({
                "background-position": "top left"
            })
        }).on(eClick, function() {
            $videoObj.get(0).play()
        });
        $videoBtnPause.css({
            display: "none",
            position: "absolute",
            top: 0,
            left: 0,
            width: BUTTON_SIZE +
                "px",
            height: BUTTON_SIZE + "px",
            cursor: "pointer",
            "background-image": "url('" + skinFolder + "html5boxplayer_playpause.png" + "')",
            "background-position": "top right"
        }).hover(function() {
            $(this).css({
                "background-position": "bottom right"
            })
        }, function() {
            $(this).css({
                "background-position": "top right"
            })
        }).on(eClick, function() {
            $videoObj.get(0).pause()
        });
        var $videoTimeCurrent = $(".html5boxTimeCurrent", $videoControls);
        var $videoTimeTotal = $(".html5boxTimeTotal", $videoControls);
        var $videoSeeker = $(".html5boxSeeker", $videoControls);
        var $videoSeekerPlay = $(".html5boxSeekerPlay", $videoControls);
        var $videoSeekerBuffer = $(".html5boxSeekerBuffer", $videoControls);
        var $videoSeekerHandler = $(".html5boxSeekerHandler", $videoControls);
        $videoTimeCurrent.css({
            display: "block",
            position: "relative",
            "float": "left",
            "line-height": BAR_HEIGHT + "px",
            "font-weight": "normal",
            "font-size": "12px",
            margin: "0 8px",
            "font-family": "Arial, Helvetica, sans-serif",
            color: "#fff"
        });
        $videoTimeTotal.css({
            display: "block",
            position: "relative",
            "float": "right",
            "line-height": BAR_HEIGHT +
                "px",
            "font-weight": "normal",
            "font-size": "12px",
            margin: "0 8px",
            "font-family": "Arial, Helvetica, sans-serif",
            color: "#fff"
        });
        $videoSeeker.css({
            display: "block",
            cursor: "pointer",
            overflow: "hidden",
            position: "relative",
            height: "10px",
            "background-color": "#222",
            margin: Math.floor((BAR_HEIGHT - 10) / 2) + "px 4px"
        }).on(eStart, function(e) {
            var e0 = isTouch ? e.originalEvent.touches[0] : e;
            var pos = e0.pageX - $videoSeeker.offset().left;
            $videoSeekerPlay.css({
                width: pos
            });
            $videoObj.get(0).currentTime = pos * $videoObj.get(0).duration /
                $videoSeeker.width();
            $videoSeeker.on(eMove, function(e) {
                var e0 = isTouch ? e.originalEvent.touches[0] : e;
                var pos = e0.pageX - $videoSeeker.offset().left;
                $videoSeekerPlay.css({
                    width: pos
                });
                $videoObj.get(0).currentTime = pos * $videoObj.get(0).duration / $videoSeeker.width()
            })
        }).on(eCancel, function() {
            $videoSeeker.off(eMove)
        });
        $videoSeekerBuffer.css({
            display: "block",
            position: "absolute",
            left: 0,
            top: 0,
            height: "100%",
            "background-color": "#444"
        });
        $videoSeekerPlay.css({
            display: "block",
            position: "absolute",
            left: 0,
            top: 0,
            height: "100%",
            "background-color": "#fcc500"
        });
        if (!isIPhone && ($videoObj.get(0).requestFullscreen || $videoObj.get(0).webkitRequestFullScreen || $videoObj.get(0).mozRequestFullScreen || $videoObj.get(0).webkitEnterFullScreen || $videoObj.get(0).msRequestFullscreen)) {
            var switchScreen = function(fullscreen) {
                if (fullscreen) {
                    if ($videoObj.get(0).requestFullscreen) $videoObj.get(0).requestFullscreen();
                    else if ($videoObj.get(0).webkitRequestFullScreen) $videoObj.get(0).webkitRequestFullScreen();
                    else if ($videoObj.get(0).mozRequestFullScreen) $videoObj.get(0).mozRequestFullScreen();
                    else if ($videoObj.get(0).webkitEnterFullScreen) $videoObj.get(0).webkitEnterFullScreen();
                    if ($videoObj.get(0).msRequestFullscreen) $videoObj.get(0).msRequestFullscreen()
                } else if (document.cancelFullScreen) document.cancelFullScreen();
                else if (document.mozCancelFullScreen) document.mozCancelFullScreen();
                else if (document.webkitCancelFullScreen) document.webkitCancelFullScreen();
                else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
                else if (document.msExitFullscreen) document.msExitFullscreen()
            };
            var switchScreenCSS = function(fullscreen) {
                $videoControls.css({
                    position: fullscreen ? "fixed" : "absolute"
                });
                var backgroundPosY = $videoFullscreen.css("background-position") ? $videoFullscreen.css("background-position").split(" ")[1] : $videoFullscreen.css("background-position-y");
                $videoFullscreen.css({
                    "background-position": (fullscreen ? "right" : "left") + " " + backgroundPosY
                });
                $videoFullscreenBg.css({
                    display: fullscreen ? "block" : "none"
                });
                if (fullscreen) {
                    $(document).on("mousemove", userActivate);
                    $videoControls.css({
                        "z-index": 2147483647
                    })
                } else {
                    $(document).off("mousemove",
                        userActivate);
                    $videoControls.css({
                        "z-index": ""
                    })
                }
            };
            document.addEventListener("fullscreenchange", function() {
                isFullscreen = document.fullscreen;
                switchScreenCSS(document.fullscreen)
            }, false);
            document.addEventListener("mozfullscreenchange", function() {
                isFullscreen = document.mozFullScreen;
                switchScreenCSS(document.mozFullScreen)
            }, false);
            document.addEventListener("webkitfullscreenchange", function() {
                isFullscreen = document.webkitIsFullScreen;
                switchScreenCSS(document.webkitIsFullScreen)
            }, false);
            $videoObj.get(0).addEventListener("webkitbeginfullscreen",
                function() {
                    isFullscreen = true
                }, false);
            $videoObj.get(0).addEventListener("webkitendfullscreen", function() {
                isFullscreen = false
            }, false);
            $("head").append("<style type='text/css'>video::-webkit-media-controls { display:none !important; }</style>");
            var $videoFullscreen = $(".html5boxFullscreen", $videoControls);
            $videoFullscreen.css({
                display: "block",
                position: "relative",
                "float": "right",
                width: BUTTON_SIZE + "px",
                height: BUTTON_SIZE + "px",
                margin: Math.floor((BAR_HEIGHT - BUTTON_SIZE) / 2),
                cursor: "pointer",
                "background-image": "url('" +
                    skinFolder + "html5boxplayer_fullscreen.png" + "')",
                "background-position": "left top"
            }).hover(function() {
                var backgroundPosX = $(this).css("background-position") ? $(this).css("background-position").split(" ")[0] : $(this).css("background-position-x");
                $(this).css({
                    "background-position": backgroundPosX + " bottom"
                })
            }, function() {
                var backgroundPosX = $(this).css("background-position") ? $(this).css("background-position").split(" ")[0] : $(this).css("background-position-x");
                $(this).css({
                    "background-position": backgroundPosX +
                        " top"
                })
            }).on(eClick, function() {
                isFullscreen = !isFullscreen;
                switchScreen(isFullscreen)
            })
        }
        if (hd) {
            var $videoHD = $(".html5boxHD", $videoControls);
            $videoHD.css({
                display: "block",
                position: "relative",
                "float": "right",
                width: BUTTON_SIZE + "px",
                height: BUTTON_SIZE + "px",
                margin: Math.floor((BAR_HEIGHT - BUTTON_SIZE) / 2),
                cursor: "pointer",
                "background-image": "url('" + skinFolder + "html5boxplayer_hd.png" + "')",
                "background-position": (isHd ? "right" : "left") + " center"
            }).on(eClick, function() {
                isHd = !isHd;
                $(this).css({
                    "background-position": (isHd ?
                        "right" : "left") + " center"
                });
                parentInst.isHd = isHd;
                var isPaused = $videoObj.get(0).isPaused;
                $videoObj.get(0).setAttribute("src", (isHd ? hd : src) + "#t=" + $videoObj.get(0).currentTime);
                if (!isPaused) $videoObj.get(0).play();
                else if (!isIPhone) $videoObj.get(0).pause()
            })
        }
        $videoObj.get(0).volume = defaultvolume;
        var volumeSaved = defaultvolume == 0 ? 1 : defaultvolume;
        var volume = $videoObj.get(0).volume;
        $videoObj.get(0).volume = volume / 2 + 0.1;
        if ($videoObj.get(0).volume === volume / 2 + 0.1) {
            $videoObj.get(0).volume = volume;
            var $videoVolume =
                $(".html5boxVolume", $videoControls);
            var $videoVolumeButton = $(".html5boxVolumeButton", $videoControls);
            var $videoVolumeBar = $(".html5boxVolumeBar", $videoControls);
            var $videoVolumeBarBg = $(".html5boxVolumeBarBg", $videoControls);
            var $videoVolumeBarActive = $(".html5boxVolumeBarActive", $videoControls);
            $videoVolume.css({
                display: "block",
                position: "relative",
                "float": "right",
                width: BUTTON_SIZE + "px",
                height: BUTTON_SIZE + "px",
                margin: Math.floor((BAR_HEIGHT - BUTTON_SIZE) / 2)
            }).hover(function() {
                clearTimeout(hideVolumeBarTimeoutId);
                var volume = $videoObj.get(0).volume;
                $videoVolumeBarActive.css({
                    height: Math.round(volume * 100) + "%"
                });
                $videoVolumeBar.show()
            }, function() {
                clearTimeout(hideVolumeBarTimeoutId);
                hideVolumeBarTimeoutId = setTimeout(function() {
                    $videoVolumeBar.hide()
                }, 1E3)
            });
            $videoVolumeButton.css({
                display: "block",
                position: "absolute",
                top: 0,
                left: 0,
                width: BUTTON_SIZE + "px",
                height: BUTTON_SIZE + "px",
                cursor: "pointer",
                "background-image": "url('" + skinFolder + "html5boxplayer_volume.png" + "')",
                "background-position": "top " + (volume > 0 ? "left" : "right")
            }).hover(function() {
                var backgroundPosX =
                    $(this).css("background-position") ? $(this).css("background-position").split(" ")[0] : $(this).css("background-position-x");
                $(this).css({
                    "background-position": backgroundPosX + " bottom"
                })
            }, function() {
                var backgroundPosX = $(this).css("background-position") ? $(this).css("background-position").split(" ")[0] : $(this).css("background-position-x");
                $(this).css({
                    "background-position": backgroundPosX + " top"
                })
            }).on(eClick, function() {
                var volume = $videoObj.get(0).volume;
                if (volume > 0) {
                    volumeSaved = volume;
                    volume = 0
                } else volume =
                    volumeSaved;
                var backgroundPosY = $(this).css("background-position") ? $(this).css("background-position").split(" ")[1] : $(this).css("background-position-y");
                $videoVolumeButton.css({
                    "background-position": (volume > 0 ? "left" : "right") + " " + backgroundPosY
                });
                $videoObj.get(0).volume = volume;
                $videoVolumeBarActive.css({
                    height: Math.round(volume * 100) + "%"
                })
            });
            $videoVolumeBar.css({
                display: "none",
                position: "absolute",
                left: 4,
                bottom: "100%",
                width: 24,
                height: 80,
                "margin-bottom": Math.floor((BAR_HEIGHT - BUTTON_SIZE) / 2),
                "background-color": "#000000",
                opacity: 0.7,
                filter: "alpha(opacity=70)"
            });
            $videoVolumeBarBg.css({
                display: "block",
                position: "relative",
                width: 10,
                height: 68,
                margin: 7,
                cursor: "pointer",
                "background-color": "#222"
            });
            $videoVolumeBarActive.css({
                display: "block",
                position: "absolute",
                bottom: 0,
                left: 0,
                width: "100%",
                height: "100%",
                "background-color": "#fcc500"
            });
            $videoVolumeBarBg.on(eStart, function(e) {
                var e0 = isTouch ? e.originalEvent.touches[0] : e;
                var vol = 1 - (e0.pageY - $videoVolumeBarBg.offset().top) / $videoVolumeBarBg.height();
                vol = vol > 1 ? 1 : vol < 0 ? 0 : vol;
                $videoVolumeBarActive.css({
                    height: Math.round(vol *
                        100) + "%"
                });
                $videoVolumeButton.css({
                    "background-position": "left " + (vol > 0 ? "top" : "bottom")
                });
                $videoObj.get(0).volume = vol;
                $videoVolumeBarBg.on(eMove, function(e) {
                    var e0 = isTouch ? e.originalEvent.touches[0] : e;
                    var vol = 1 - (e0.pageY - $videoVolumeBarBg.offset().top) / $videoVolumeBarBg.height();
                    vol = vol > 1 ? 1 : vol < 0 ? 0 : vol;
                    $videoVolumeBarActive.css({
                        height: Math.round(vol * 100) + "%"
                    });
                    $videoVolumeButton.css({
                        "background-position": "left " + (vol > 0 ? "top" : "bottom")
                    });
                    $videoObj.get(0).volume = vol
                })
            }).on(eCancel, function() {
                $videoVolumeBarBg.off(eMove)
            })
        }
        var calcTimeFormat =
            function(seconds) {
                var h0 = Math.floor(seconds / 3600);
                var h = h0 < 10 ? "0" + h0 : h0;
                var m0 = Math.floor((seconds - h0 * 3600) / 60);
                var m = m0 < 10 ? "0" + m0 : m0;
                var s0 = Math.floor(seconds - (h0 * 3600 + m0 * 60));
                var s = s0 < 10 ? "0" + s0 : s0;
                var r = m + ":" + s;
                if (h0 > 0) r = h + ":" + r;
                return r
            };
        if (hideplaybutton) $videoPlay.hide();
        if (hidecontrols) $videoControls.hide();
        var onVideoPlay = function() {
            if (!hideplaybutton) $videoPlay.hide();
            if (!hidecontrols) {
                $videoBtnPlay.hide();
                $videoBtnPause.show()
            }
        };
        var onVideoPause = function() {
            if (!hideplaybutton) $videoPlay.show();
            if (!hidecontrols) {
                $videoControls.show();
                clearTimeout(hideControlsTimerId);
                $videoBtnPlay.show();
                $videoBtnPause.hide()
            }
        };
        var onVideoEnded = function() {
            $(window).trigger("html5lightbox.videoended");
            if (!hideplaybutton) $videoPlay.show();
            if (!hidecontrols) {
                $videoControls.show();
                clearTimeout(hideControlsTimerId);
                $videoBtnPlay.show();
                $videoBtnPause.hide()
            }
        };
        var onVideoUpdate = function() {
            var curTime = $videoObj.get(0).currentTime;
            if (curTime) {
                $videoTimeCurrent.text(calcTimeFormat(curTime));
                var duration = $videoObj.get(0).duration;
                if (duration) {
                    $videoTimeTotal.text(calcTimeFormat(duration));
                    if (!sliderDragging) {
                        var sliderW = $videoSeeker.width();
                        var pos = Math.round(sliderW * curTime / duration);
                        $videoSeekerPlay.css({
                            width: pos
                        });
                        $videoSeekerHandler.css({
                            left: pos
                        })
                    }
                }
            }
        };
        var onVideoProgress = function() {
            if ($videoObj.get(0).buffered && $videoObj.get(0).buffered.length > 0 && !isNaN($videoObj.get(0).buffered.end(0)) && !isNaN($videoObj.get(0).duration)) {
                var sliderW = $videoSeeker.width();
                $videoSeekerBuffer.css({
                    width: Math.round(sliderW * $videoObj.get(0).buffered.end(0) /
                        $videoObj.get(0).duration)
                })
            }
        };
        try {
            $videoObj.on("play", onVideoPlay);
            $videoObj.on("pause", onVideoPause);
            $videoObj.on("ended", onVideoEnded);
            $videoObj.on("timeupdate", onVideoUpdate);
            $videoObj.on("progress", onVideoProgress)
        } catch (e) {}
    }
})(jQuery);
jQuery(document).ready(function() {
    jQuery(".wonderplugin-gridgallery-engine").css({
        display: "none"
    });
    jQuery(".wonderplugingridgallery").wonderplugingridgallery()
});
jQuery.easing["jswing"] = jQuery.easing["swing"];
jQuery.extend(jQuery.easing, {
    def: "easeOutQuad",
    swing: function(x, t, b, c, d) {
        return jQuery.easing[jQuery.easing.def](x, t, b, c, d)
    },
    easeInQuad: function(x, t, b, c, d) {
        return c * (t /= d) * t + b
    },
    easeOutQuad: function(x, t, b, c, d) {
        return -c * (t /= d) * (t - 2) + b
    },
    easeInOutQuad: function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t + b;
        return -c / 2 * (--t * (t - 2) - 1) + b
    },
    easeInCubic: function(x, t, b, c, d) {
        return c * (t /= d) * t * t + b
    },
    easeOutCubic: function(x, t, b, c, d) {
        return c * ((t = t / d - 1) * t * t + 1) + b
    },
    easeInOutCubic: function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return c /
            2 * t * t * t + b;
        return c / 2 * ((t -= 2) * t * t + 2) + b
    },
    easeInQuart: function(x, t, b, c, d) {
        return c * (t /= d) * t * t * t + b
    },
    easeOutQuart: function(x, t, b, c, d) {
        return -c * ((t = t / d - 1) * t * t * t - 1) + b
    },
    easeInOutQuart: function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t * t * t + b;
        return -c / 2 * ((t -= 2) * t * t * t - 2) + b
    },
    easeInQuint: function(x, t, b, c, d) {
        return c * (t /= d) * t * t * t * t + b
    },
    easeOutQuint: function(x, t, b, c, d) {
        return c * ((t = t / d - 1) * t * t * t * t + 1) + b
    },
    easeInOutQuint: function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t * t * t * t + b;
        return c / 2 * ((t -= 2) * t * t * t * t + 2) + b
    },
    easeInSine: function(x,
        t, b, c, d) {
        return -c * Math.cos(t / d * (Math.PI / 2)) + c + b
    },
    easeOutSine: function(x, t, b, c, d) {
        return c * Math.sin(t / d * (Math.PI / 2)) + b
    },
    easeInOutSine: function(x, t, b, c, d) {
        return -c / 2 * (Math.cos(Math.PI * t / d) - 1) + b
    },
    easeInExpo: function(x, t, b, c, d) {
        return t == 0 ? b : c * Math.pow(2, 10 * (t / d - 1)) + b
    },
    easeOutExpo: function(x, t, b, c, d) {
        return t == d ? b + c : c * (-Math.pow(2, -10 * t / d) + 1) + b
    },
    easeInOutExpo: function(x, t, b, c, d) {
        if (t == 0) return b;
        if (t == d) return b + c;
        if ((t /= d / 2) < 1) return c / 2 * Math.pow(2, 10 * (t - 1)) + b;
        return c / 2 * (-Math.pow(2, -10 * --t) + 2) + b
    },
    easeInCirc: function(x, t, b, c, d) {
        return -c * (Math.sqrt(1 - (t /= d) * t) - 1) + b
    },
    easeOutCirc: function(x, t, b, c, d) {
        return c * Math.sqrt(1 - (t = t / d - 1) * t) + b
    },
    easeInOutCirc: function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return -c / 2 * (Math.sqrt(1 - t * t) - 1) + b;
        return c / 2 * (Math.sqrt(1 - (t -= 2) * t) + 1) + b
    },
    easeInElastic: function(x, t, b, c, d) {
        var s = 1.70158;
        var p = 0;
        var a = c;
        if (t == 0) return b;
        if ((t /= d) == 1) return b + c;
        if (!p) p = d * 0.3;
        if (a < Math.abs(c)) {
            a = c;
            var s = p / 4
        } else var s = p / (2 * Math.PI) * Math.asin(c / a);
        return -(a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * 2 *
            Math.PI / p)) + b
    },
    easeOutElastic: function(x, t, b, c, d) {
        var s = 1.70158;
        var p = 0;
        var a = c;
        if (t == 0) return b;
        if ((t /= d) == 1) return b + c;
        if (!p) p = d * 0.3;
        if (a < Math.abs(c)) {
            a = c;
            var s = p / 4
        } else var s = p / (2 * Math.PI) * Math.asin(c / a);
        return a * Math.pow(2, -10 * t) * Math.sin((t * d - s) * 2 * Math.PI / p) + c + b
    },
    easeInOutElastic: function(x, t, b, c, d) {
        var s = 1.70158;
        var p = 0;
        var a = c;
        if (t == 0) return b;
        if ((t /= d / 2) == 2) return b + c;
        if (!p) p = d * 0.3 * 1.5;
        if (a < Math.abs(c)) {
            a = c;
            var s = p / 4
        } else var s = p / (2 * Math.PI) * Math.asin(c / a);
        if (t < 1) return -0.5 * a * Math.pow(2, 10 *
            (t -= 1)) * Math.sin((t * d - s) * 2 * Math.PI / p) + b;
        return a * Math.pow(2, -10 * (t -= 1)) * Math.sin((t * d - s) * 2 * Math.PI / p) * 0.5 + c + b
    },
    easeInBack: function(x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        return c * (t /= d) * t * ((s + 1) * t - s) + b
    },
    easeOutBack: function(x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        return c * ((t = t / d - 1) * t * ((s + 1) * t + s) + 1) + b
    },
    easeInOutBack: function(x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        if ((t /= d / 2) < 1) return c / 2 * t * t * (((s *= 1.525) + 1) * t - s) + b;
        return c / 2 * ((t -= 2) * t * (((s *= 1.525) + 1) * t + s) + 2) + b
    },
    easeInBounce: function(x, t, b, c, d) {
        return c -
            jQuery.easing.easeOutBounce(x, d - t, 0, c, d) + b
    },
    easeOutBounce: function(x, t, b, c, d) {
        if ((t /= d) < 1 / 2.75) return c * 7.5625 * t * t + b;
        else if (t < 2 / 2.75) return c * (7.5625 * (t -= 1.5 / 2.75) * t + 0.75) + b;
        else if (t < 2.5 / 2.75) return c * (7.5625 * (t -= 2.25 / 2.75) * t + 0.9375) + b;
        else return c * (7.5625 * (t -= 2.625 / 2.75) * t + 0.984375) + b
    },
    easeInOutBounce: function(x, t, b, c, d) {
        if (t < d / 2) return jQuery.easing.easeInBounce(x, t * 2, 0, c, d) * 0.5 + b;
        return jQuery.easing.easeOutBounce(x, t * 2 - d, 0, c, d) * 0.5 + c * 0.5 + b
    }
});
if (typeof wpGridGalleryObjects === "undefined") var wpGridGalleryObjects = new function() {
    this.objects = [];
    this.addObject = function(obj) {
        this.objects.push(obj)
    }
};