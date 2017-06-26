/**
 * WonderPlugin Portfolio Grid Gallery Skin Options
 * Copyright 2015 Magic Hills Pty Ltd - http://www.wonderplugin.com
 */

var WONDERPLUGIN_GRIDGALLERY_CATEGORY_TEMPLATE = {
		'wpp-category-greybutton': {
			categorycss: '#wonderplugingridgallery-GRIDGALLERYID .wpp-category-greybutton .wonderplugin-gridgallery-tag {\r\n\tborder: none;\r\n\tbackground: #666;\r\n\tcolor: #fff;\r\n  \tpadding: 6px 12px;\r\n\tfont-size: 12px;\r\n\tfont-weight: normal; \t\r\n  \tfont-family: \"Lucida Sans Unicode\",\"Lucida Grande\",sans-serif,Arial;\r\n  \tbox-sizing: border-box; \r\n  \tcursor: pointer;\r\n  \ttext-align: center;\r\n  \ttext-decoration: none;\r\n  \ttext-shadow: none;\r\n  \ttext-transform: none;\r\n  \twhite-space: nowrap;\r\n  \t-webkit-font-smoothing: antialiased;\r\n  \tborder-radius: 2px;\r\n  \ttransition: background-color 0.3s ease;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-greybutton .wonderplugin-gridgallery-tag:hover,\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-greybutton .wonderplugin-gridgallery-tag:focus {\r\n\tborder: none;\r\n\tbackground: #999;\r\n\tcolor: #fff;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-greybutton .wonderplugin-gridgallery-tag-selected,\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-greybutton .wonderplugin-gridgallery-tag-selected:hover,\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-greybutton .wonderplugin-gridgallery-tag-selected:focus {\r\n\tborder: none;\r\n\tbackground: #f3b200;\r\n\tcolor: #fff;\r\n}'
		},
		'wpp-category-bluebutton-withtick': {
			categorycss: '#wonderplugingridgallery-GRIDGALLERYID .wpp-category-bluebutton-withtick .wonderplugin-gridgallery-tag {\r\n\tborder: none;\r\n\tbackground: #666;\r\n\tcolor: #fff;\r\n  \tpadding: 6px 12px;\r\n\tfont-size: 12px;\r\n\tfont-weight: normal; \t\r\n  \tfont-family: \"Lucida Sans Unicode\",\"Lucida Grande\",sans-serif,Arial;\r\n  \tbox-sizing: border-box; \r\n  \tcursor: pointer;\r\n  \ttext-align: center;\r\n  \ttext-decoration: none;\r\n  \ttext-shadow: none;\r\n  \ttext-transform: none;\r\n  \twhite-space: nowrap;\r\n  \t-webkit-font-smoothing: antialiased;\r\n  \tborder-radius: 2px;\r\n  \ttransition: background-color 0.3s ease;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-bluebutton-withtick .wonderplugin-gridgallery-tag:hover,\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-bluebutton-withtick .wonderplugin-gridgallery-tag:focus {\r\n\tborder: none;\r\n\tbackground: #999;\r\n\tcolor: #fff;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-bluebutton-withtick .wonderplugin-gridgallery-tag-selected:before {\r\n\tcontent: \"\\2713\";\r\n\tpadding-right: 4px;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-bluebutton-withtick .wonderplugin-gridgallery-tag-selected,\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-bluebutton-withtick .wonderplugin-gridgallery-tag-selected:hover,\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-bluebutton-withtick .wonderplugin-gridgallery-tag-selected:focus {\r\n\tborder: none;\r\n\tbackground: #009cde;\r\n\tcolor: #fff;\r\n}'
		},
		'wpp-category-textlink': {
			categorycss: '#wonderplugingridgallery-GRIDGALLERYID .wpp-category-textlink .wonderplugin-gridgallery-tag {\r\n\tborder: none;\r\n\tbackground: transparent;\r\n\tcolor: #777;\r\n  \tpadding: 6px;\r\n\tfont-size: 13px;\r\n\tfont-weight: normal; \t\r\n  \tfont-family: \"Lucida Sans Unicode\",\"Lucida Grande\",sans-serif,Arial;\r\n  \tbox-sizing: border-box; \r\n  \tcursor: pointer;\r\n  \ttext-align: center;\r\n  \ttext-decoration: none;\r\n  \ttext-shadow: none;\r\n  \ttext-transform: none;\r\n  \twhite-space: nowrap;\r\n  \t-webkit-font-smoothing: antialiased;\r\n  \tborder-radius: 2px;\r\n  \ttransition: background-color 0.3s ease;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-textlink .wonderplugin-gridgallery-tag:hover,\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-textlink .wonderplugin-gridgallery-tag:focus {\r\n\tcolor: #555;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-textlink .wonderplugin-gridgallery-tag-selected,\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-textlink .wonderplugin-gridgallery-tag-selected:hover,\r\n#wonderplugingridgallery-GRIDGALLERYID .wpp-category-textlink .wonderplugin-gridgallery-tag-selected:focus {\r\n\tcolor: #222;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-tags-topleft.wpp-category-textlink .wonderplugin-gridgallery-tag:first-child,\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-tags-topcenter.wpp-category-textlink .wonderplugin-gridgallery-tag:first-child,\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-tags-topright.wpp-category-textlink .wonderplugin-gridgallery-tag:first-child,\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-tags-bottomleft.wpp-category-textlink .wonderplugin-gridgallery-tag:first-child,\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-tags-bottomcenter.wpp-category-textlink .wonderplugin-gridgallery-tag:first-child,\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-tags-bottomright.wpp-category-textlink .wonderplugin-gridgallery-tag:first-child {\r\n\tpadding-left: 0px;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-tags-topleft.wpp-category-textlink .wonderplugin-gridgallery-tag:last-child,\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-tags-topcenter.wpp-category-textlink .wonderplugin-gridgallery-tag:last-child,\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-tags-topright.wpp-category-textlink .wonderplugin-gridgallery-tag:last-child,\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-tags-bottomleft.wpp-category-textlink .wonderplugin-gridgallery-tag:last-child,\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-tags-bottomcenter.wpp-category-textlink .wonderplugin-gridgallery-tag:last-child,\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-tags-bottomright.wpp-category-textlink .wonderplugin-gridgallery-tag:last-child {\r\n\tpadding-right: 0px;\r\n}'
		}
};

var WONDERPLUGIN_GRIDGALLERY_LOADMORE_STYLE = {
	'wpp-loadmore-greybutton': '#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-loadmore {\r\n  	display: block;\r\n  	text-align: center;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-loadmore-btn {\r\n  	display: inline-block;\r\n  	outline: 0;\r\n  	-webkit-box-sizing: border-box;\r\n  	-moz-box-sizing: border-box;\r\n  	box-sizing: border-box;\r\n  	cursor: pointer;\r\n  	text-align: center;\r\n  	text-decoration: none;\r\n  	text-shadow: 1px 1px 0px #fff;\r\n  	text-transform: none;\r\n  	white-space: nowrap;\r\n  	-webkit-font-smoothing: antialiased;\r\n	-moz-osx-font-smoothing: grayscale;\r\n	font-family: \"Lucida Sans Unicode\",\"Lucida Grande\",sans-serif,Arial;\r\n  	font-weight: normal;\r\n	font-size: 14px;\r\n	margin: 12px;\r\n	padding: 8px 36px;\r\n  	-webkit-border-radius: 2px;\r\n  	-moz-border-radius: 2px;\r\n  	border-radius: 2px;\r\n  	background: #ededed;\r\n  	background: linear-gradient(to bottom, #ededed 0%, #dfdfdf 100%);\r\n  	border: 1px solid #dcdcdc;\r\n  	color: #333;\r\n  	transition: background-color 0.5s ease;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-loadmore-btn:hover {\r\n  	color: #333;\r\n  	background: #dfdfdf;\r\n  	background: linear-gradient(to bottom, #fdfdfd 0%, #ededed 100%);\r\n}',
	'wpp-loadmore-bluebutton': '#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-loadmore {\r\n  	display: block;\r\n  	text-align: center;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-loadmore-btn {\r\n  	display: inline-block;\r\n  	outline: 0;\r\n  	-webkit-box-sizing: border-box;\r\n  	-moz-box-sizing: border-box;\r\n  	box-sizing: border-box;\r\n  	cursor: pointer;\r\n  	text-align: center;\r\n  	text-decoration: none;\r\n  	text-shadow: none;\r\n  	text-transform: none;\r\n  	white-space: nowrap;\r\n  	-webkit-font-smoothing: antialiased;\r\n	-moz-osx-font-smoothing: grayscale;\r\n	font-family: \"Lucida Sans Unicode\",\"Lucida Grande\",sans-serif,Arial;\r\n  	font-weight: normal;\r\n	font-size: 14px;\r\n	margin: 12px;\r\n	padding: 8px 36px;\r\n  	-webkit-border-radius: 2px;\r\n  	-moz-border-radius: 2px;\r\n  	border-radius: 2px;\r\n  	background: #00adf2;\r\n  	background: linear-gradient(to bottom, #00adf2 0%, #009df2 100%);\r\n  	border: none;\r\n  	border-bottom: 3px solid #2980b9;\r\n  	color: #fff;\r\n  	transition: background-color 0.5s ease;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-loadmore-btn:hover {\r\n  	color: #fff;\r\n  	background: #0088cc;\r\n  	background: linear-gradient(to bottom, #0088cc 0%, #1098dc 100%);\r\n}'
};

var WONDERPLUGIN_GRIDGALLERY_PAGINATION_STYLE = {
	'wpp-pagination-greybutton': '#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-pagination {\r\n  	display: block;\r\n  	text-align: center;\r\n  	margin: 8px;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-pagination-btn {\r\n  	display: inline-block;\r\n  	outline: 0;\r\n  	-webkit-box-sizing: border-box;\r\n  	-moz-box-sizing: border-box;\r\n  	box-sizing: border-box;\r\n  	cursor: pointer;\r\n  	text-align: center;\r\n  	text-decoration: none;\r\n  	text-shadow: 1px 1px 0px #fff;\r\n  	text-transform: none;\r\n  	white-space: nowrap;\r\n  	-webkit-font-smoothing: antialiased;\r\n	-moz-osx-font-smoothing: grayscale;\r\n	font-family: \"Lucida Sans Unicode\",\"Lucida Grande\",sans-serif,Arial;\r\n  	font-weight: normal;\r\n	font-size: 12px;\r\n	margin: 6px;\r\n	padding: 2px 8px;\r\n  	-webkit-border-radius: 2px;\r\n  	-moz-border-radius: 2px;\r\n  	border-radius: 2px;\r\n  	background: #ededed;\r\n  	background: linear-gradient(to bottom, #ededed 0%, #dfdfdf 100%);\r\n  	border: 1px solid #dcdcdc;\r\n  	color: #333;\r\n  	transition: background-color 0.5s ease;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-pagination-btn:hover {\r\n  	color: #333;\r\n  	background: #dfdfdf;\r\n  	background: linear-gradient(to bottom, #fdfdfd 0%, #ededed 100%);\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-pagination-btn-selected {\r\n  	color: #333;\r\n  	background: #dfdfdf;\r\n  	background: linear-gradient(to bottom, #fdfdfd 0%, #ededed 100%);\r\n}',
	'wpp-pagination-yellowbutton': '#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-pagination {\r\n  	display: block;\r\n  	text-align: center;\r\n  	margin: 8px;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-pagination-btn {\r\n  	display: inline-block;\r\n	border: none;\r\n	background: #666;\r\n	color: #fff;\r\n  	margin: 6px;\r\n  	padding: 4px 10px;\r\n	font-size: 12px;\r\n	font-weight: normal; 	\r\n  	font-family: \"Lucida Sans Unicode\",\"Lucida Grande\",sans-serif,Arial;\r\n  	box-sizing: border-box; \r\n  	cursor: pointer;\r\n  	text-align: center;\r\n  	text-decoration: none;\r\n  	text-shadow: none;\r\n  	text-transform: none;\r\n  	white-space: nowrap;\r\n  	-webkit-font-smoothing: antialiased;\r\n  	border-radius: 2px;\r\n  	transition: background-color 0.3s ease;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-pagination-btn:hover {\r\n	border: none;\r\n	background: #999;\r\n	color: #fff;\r\n}\r\n\r\n#wonderplugingridgallery-GRIDGALLERYID  .wonderplugin-gridgallery-pagination-btn-selected {\r\n	border: none;\r\n	background: #f3b200;\r\n	color: #fff;\r\n}'
};

var WONDERPLUGIN_GRIDGALLERY_STYLE_TEMPLATE = {
	classic: {
		width: 				200,
		height: 			150,
		random: 			false,
		circularimage:		false,
		firstimage:			false,
		showtitle: 			true,
		showtexttitle:		true,
		showtextdescription:false,
		showtextbutton:		false,
		titlemode: 			"mouseover",
		titleeffect: 		"slide",
		titleeffectduration: 300,
		titleheight:		0,
		gap: 				4,
		margin: 			0,
		borderradius: 		0,
		hoverzoomin: 		true,
		hoverzoominimageonly: true,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		hoverzoominimagescale: 1.1,
		hoverzoominimageduration: 360,
		hoverfade:			true,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(https://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    background-color: rgba(51, 51, 51, 0.5);\n    color: #fff;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    padding: 8px 0px;\n    position: absolute;\n    left: 0px;\n    bottom: 0px;\n    width: 100%;\n    box-sizing: border-box;\n    -webkit-box-sizing: border-box;\n    -moz-box-sizing: border-box;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-title {\n    font-size: 14px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-description {\n    font-size: 12px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-button {\n}'
	},
	
	masonry: {
		width: 				200,
		height: 			150,
		masonrymode:		true,
		random: 			false,
		circularimage:		false,
		firstimage:			false,
		showtitle: 			true,
		showtexttitle:		true,
		showtextdescription:false,
		showtextbutton:		false,
		titlemode: 			"mouseover",
		titleeffect: 		"slide",
		titleeffectduration: 300,
		titleheight:		0,
		gap: 				2,
		margin: 			0,
		borderradius: 		0,
		hoverzoomin: 		false,
		hoverzoominimageonly: false,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		hoverzoominimagescale: 1.1,
		hoverzoominimageduration: 360,
		hoverfade:			true,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(https://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    background-color: rgba(51, 51, 51, 0.5);\n    color: #fff;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    padding: 8px 0px;\n    position: absolute;\n    left: 0px;\n    bottom: 0px;\n    width: 100%;\n    box-sizing: border-box;\n    -webkit-box-sizing: border-box;\n    -moz-box-sizing: border-box;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-title {\n    font-size: 14px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-description {\n    font-size: 12px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-button {\n}'
	},
	
	hover: {
		width: 				200,
		height: 			150,
		random: 			false,
		circularimage:		false,
		firstimage:			false,
		showtitle: 			true,
		showtexttitle:		true,
		showtextdescription:true,
		showtextbutton:		true,
		overlaylink:		true,
		titlemode: 			"mouseover",
		titleeffect: 		"fade",
		titleeffectduration: 500,
		titleheight:		0,
		gap: 				4,
		margin: 			0,
		borderradius: 		0,
		hoverzoomin: 		false,
		hoverzoominimageonly: true,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		hoverzoominimagescale: 1.1,
		hoverzoominimageduration: 360,
		hoverfade:			false,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(https://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    background-color: rgba(51, 51, 51, 0.8);\n    color: #fff;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    padding: 8px 0px;\n    position: absolute;\n    left: 0px;\n    bottom: 0px;\n    width: 100%;\n    height: 100%;\n    box-sizing: border-box;\n    -webkit-box-sizing: border-box;\n    -moz-box-sizing: border-box;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-title {\n    font-size: 16px;\n    margin-top: 18px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-description {\n    font-size: 12px;\n    margin-top: 10px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-button {\n    margin-top: 10px;\n}'
	},
	
	circular: {
		width: 				160,
		height: 			160,
		random: 			false,
		circularimage:		true,
		firstimage:			false,
		showtitle: 			false,
		showtexttitle:		true,
		showtextdescription:false,
		showtextbutton:		false,
		titlemode: 			"always",
		titleeffect: 		"fade",
		titleeffectduration: 300,
		titleheight:		0,
		gap: 				24,
		margin: 			0,
		borderradius: 		0,
		hoverzoomin: 		true,
		hoverzoominimageonly: true,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		hoverzoominimagescale: 1.1,
		hoverzoominimageduration: 360,
		hoverfade:			true,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(https://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    color: #fff;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    padding: 8px 0px;\n    position: absolute;\n    left: 0px;\n    bottom: 0px;\n    width: 100%;\n    box-sizing: border-box;\n    -webkit-box-sizing: border-box;\n    -moz-box-sizing: border-box;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-title {\n    font-size: 14px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-description {\n    font-size: 12px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-button {\n}'
	},
	
	circularwithtext: {
		width: 				120,
		height: 			120,
		random: 			false,
		circularimage:		true,
		firstimage:			false,
		showtitle: 			true,
		showtexttitle:		true,
		showtextdescription:false,
		showtextbutton:		false,
		titlemode: 			"always",
		titleeffect: 		"fade",
		titleeffectduration: 300,
		titleheight:		24,
		gap: 				24,
		margin: 			0,
		borderradius: 		0,
		hoverzoomin: 		false,
		hoverzoominimageonly: true,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		hoverzoominimagescale: 1.1,
		hoverzoominimageduration: 360,
		hoverfade:			true,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(https://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container {\n    text-align: center;\n    box-sizing: border-box;\n    -moz-box-sizing: border-box;\n    -webkit-box-sizing: border-box;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container img {\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container img:hover {\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    color: #333;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    margin: 0px auto;\n    position: relative;\n    left: 0px;\n    top: 0px;\n    width: 100%;\n    height: 20px;\n    box-sizing: border-box;\n    -webkit-box-sizing: border-box;\n    -moz-box-sizing: border-box;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-title {\n    font-size: 14px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-description {\n    font-size: 12px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-button {\n}'		
	},
	
	bluetext: {
		width: 				200,
		height: 			150,
		random: 			false,
		circularimage:		false,
		firstimage:			false,
		showtitle: 			true,
		showtexttitle:		true,
		showtextdescription:false,
		showtextbutton:		false,
		titlemode: 			"always",
		titleeffect: 		"fade",
		titleeffectduration: 300,
		titleheight:		0,
		gap: 				4,
		margin: 			0,
		borderradius: 		0,
		hoverzoomin: 		false,
		hoverzoominimageonly: true,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		hoverzoominimagescale: 1.1,
		hoverzoominimageduration: 360,
		hoverfade:			true,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(https://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    background-color: #00ccff;\n    color: #fff;\n    text-align: left;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    padding: 8px;\n    position: absolute;\n    left: 8px;\n    bottom: 8px;\n    box-sizing: border-box;\n    -webkit-box-sizing: border-box;\n    -moz-box-sizing: border-box;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-title {\n    font-size: 14px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-description {\n    font-size: 12px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-button {\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container img:hover {\n}'
	},

	roundcorner: {
		width: 				200,
		height: 			150,
		random: 			false,
		circularimage:		false,
		firstimage:			false,
		showtitle: 			true,
		showtexttitle:		true,
		showtextdescription:false,
		showtextbutton:		false,
		titlemode: 			"mouseover",
		titleeffect: 		"slide",
		titleeffectduration: 300,
		titleheight:		0,
		gap: 				8,
		margin: 			0,
		borderradius: 		4,
		hoverzoomin: 		true,
		hoverzoominimageonly: true,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		hoverzoominimagescale: 1.1,
		hoverzoominimageduration: 360,
		hoverfade:			false,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(https://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    background-color: rgba(51, 51, 51, 0.5);\n    color: #fff;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    padding: 8px 0px;\n    position: absolute;\n    left: 0px;\n    bottom: 0px;\n    width: 100%;\n    box-sizing: border-box;\n    -webkit-box-sizing: border-box;\n    -moz-box-sizing: border-box;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-title {\n    font-size: 14px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-description {\n    font-size: 12px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-button {\n}'
	},

	border: {
		width: 				200,
		height: 			150,
		random: 			false,
		circularimage:		false,
		firstimage:			false,
		showtitle: 			false,
		showtexttitle:		true,
		showtextdescription:false,
		showtextbutton:		false,
		titlemode: 			"mouseover",
		titleeffect: 		"slide",
		titleeffectduration: 300,
		titleheight:		0,
		gap: 				12,
		margin: 			10,
		borderradius: 		0,
		hoverzoomin: 		false,
		hoverzoominimageonly: true,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		hoverzoominimagescale: 1.1,
		hoverzoominimageduration: 360,
		hoverfade:			true,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(https://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    color: #fff;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    padding: 14px 0px;\n    position: absolute;\n    left: 0px;\n    bottom: 0px;\n    width: 100%;\n    box-sizing: border-box;\n    -webkit-box-sizing: border-box;\n    -moz-box-sizing: border-box;\n} \n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item {\n    border: 1px solid #aaa;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-title {\n    font-size: 14px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-description {\n    font-size: 12px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-button {\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item:hover {\n    border: 1px solid #666;\n}'		
	},
	
	caption: {
		width: 				200,
		height: 			150,
		random: 			false,
		circularimage:		false,
		firstimage:			false,
		showtitle: 			true,
		showtexttitle:		true,
		showtextdescription:false,
		showtextbutton:		false,
		titlemode: 			"always",
		titleeffect: 		"fade",
		titleeffectduration: 300,
		titleheight:		24,
		gap: 				8,
		margin: 			0,
		borderradius: 		0,
		hoverzoomin: 		true,
		hoverzoominimageonly: true,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		hoverzoominimagescale: 1.1,
		hoverzoominimageduration: 360,
		hoverfade:			true,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(https://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container {\n    text-align: center;\n    box-sizing: border-box;\n    -moz-box-sizing: border-box;\n    -webkit-box-sizing: border-box;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container img {\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container img:hover {\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    color: #333;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    margin: 0px auto;\n    position: relative;\n    left: 0px;\n    top: 0px;\n    width: 100%;\n    box-sizing: border-box;\n    -webkit-box-sizing: border-box;\n    -moz-box-sizing: border-box;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-title {\n    font-size: 14px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-description {\n    font-size: 12px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-button {\n}'		
	}
};



var WONDERPLUGIN_GRIDGALLERY_SKIN_TEMPLATE = {
	tiles : {
		responsive: 		true,
		column:				4,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		3,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		2,
		smallscreensize: 	600
	},
	
	focus : {
		responsive: 		true,
		column:				4,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		3,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		2,
		smallscreensize: 	600
	},
	
	feature : {
		responsive: 		true,
		column:				4,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		3,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		2,
		smallscreensize: 	600
	},
	
	collage : {
		responsive: 		true,
		column:				4,
		gridtemplate: 		'<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		3,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		2,
		smallscreensize: 	600
	},
	
	threecolumns: {
		responsive: 		true,
		column:				3,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		2,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		1,
		smallscreensize: 	600
	},
	
	showcase : {
		responsive: 		true,
		column:				3,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		2,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		1,
		smallscreensize: 	600
	},
	
	highlight: {
		responsive: 		true,
		column:				3,
		gridtemplate: 		'<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		2,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		1,
		smallscreensize: 	600
	},
	
	wall : {
		responsive: 		true,
		column:				3,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="2"></div>\n<div data-row="1" data-col="2"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		2,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		1,
		smallscreensize: 	600
	},
	
	header : {
		responsive: 		true,
		column:				3,
		gridtemplate: 		'<div data-row="1" data-col="3"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		2,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		1,
		smallscreensize: 	600
	},
	
	fivecolumns : {
		responsive: 		true,
		column:				5,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		3,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		2,
		smallscreensize: 	600
	},
};