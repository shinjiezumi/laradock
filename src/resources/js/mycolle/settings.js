/**
 * Created by User on 2017/01/08.
 */
var MYCOLLE = MYCOLLE || {};
MYCOLLE.SETTINGS = {};

MYCOLLE.SETTINGS.DATA_CONTROLLER = {
  timer: undefined,
  timerWeight: 1000 + 1.5, /* 1.5sec */

  init: function () {
    this.setParameters();
    this.bindEvents();

    this.initialize();
  },
  setParameters: function () {
    this.$settingTypeSelectTabItems = $('.jsc-setting-type-select-tab-item');
    this.$settingTypeSelectTabContentsItems = $('.jsc-setting-type-select-tab-contents-item');
    this.$mysitesLists = $('#jsc-mysites-list');
    this.$mycolleLists = $('#jsc-mycolle-list');
    this.$addMySitesBtn = $('#jsc-add-mysites-btn');
    this.$mysitesTypeSelectTabContainer = $('#jsc-mysites-type-select-tab-container');
    this.$searchFeedBox = $('#jsc-search-feed-box');

    this.$addMycolleBtn = $('#jsc-add-mycolle-btn');
    this.$mycolleTypeSelectTabItems = $('.mycolle-type-select-tab-item');
    this.$mycolleTypeSelectTabContentsItems = $('.mycolle-type-select-tab-contents-item');
    this.$mycolleTypeSelectTabContainer = $('#jsc-mycolle-type-select-tab-container');

    this.$mysitesListLoader = $('.mysites-list-container > .loader-bg, .mysites-list-container > .loader');
    this.$mycolleListLoader = $('.mycolle-list-container > .loader-bg, .mycolle-list-container > .loader');

    this.$searchFeedLoader = $('.search-feed.loader-bg, .search-feed.loader');
    this.$searchSlideLoader = $('.search-slide.loader-bg, .search-slide.loader');
    this.$searchYoutubeLoader = $('.search-youtube.loader-bg, .search-youtube.loader');
    this.$searchHtmlLoader = $('.search-html.loader-bg, .search-html.loader');

    this.$searchFeedEntriesBox = $('#jsc-search-feed-entries-box');
    this.$searchSlideBox = $('#jsc-search-slide-box');
    this.$searchYoutubeBox = $('#jsc-search-youtube-box');
    this.$searchHtmlBox = $('#jsc-search-html-box');

    this.$searchFeedResults = $('#jsc-search-feed-results');
    this.$searchSlideResults = $('#jsc-search-slide-results');
    this.$searchYoutubeResults = $('#jsc-search-youtube-results');
    this.$searchHtmlResults = $('#jsc-search-html-results');

  },
  bindEvents: function () {
    this.$settingTypeSelectTabItems.on('click', $.proxy(this.handleSelectSettingTypeTabItem, null, this));
    this.$addMySitesBtn.on('click', $.proxy(this.handleAddMysitesBtn, this));
    this.$searchFeedBox.on('keyup', $.proxy(this.handleChangeSearchFeedBox, this));

    this.$mycolleTypeSelectTabItems.on('click', $.proxy(this.handleSelectMycollectTabItem, null, this));
    this.$addMycolleBtn.on('click', $.proxy(this.handleAddMycolleBtn, this));
    this.$searchFeedEntriesBox.on('keyup', $.proxy(this.handleChangeSearchFeedEntriesBox, this));
    this.$searchSlideBox.on('keyup', $.proxy(this.handleChangeSearchSlideBox, this));
    this.$searchYoutubeBox.on('keyup', $.proxy(this.handleChangeSearchYoutubeBox, this));
    this.$searchHtmlBox.on('keyup', $.proxy(this.handleChangeSearchHtmlBox, this));


    $(document).on('click', '.jsc-register-mysites-btn', $.proxy(this.handleRegisterMysitesBtn, null, this));
    $(document).on('click', '.jsc-register-mycolle-btn', $.proxy(this.handleRegisterMycolleBtn, null, this));
    $(document).on('click', '.jsc-delete-mysites-btn', $.proxy(this.handleDeleteMysitesBtn, null, this));
    $(document).on('click', '.jsc-delete-mycolle-btn', $.proxy(this.handleDeleteMycolleBtn, null, this));
  },
  initialize: function () {
    this.getMysites();
    this.getMycolle();
  },
  getMysites: function () {
    this.$mysitesListLoader.css('display', 'block');

    var url = window.COMMON.APIS.GET_MYSITES_API_URL;
    url = url.replace(window.COMMON.APIS.ALIASES.MYCOLLE_ID, '');

    window.COMMON.REQUEST.sendToServer(url, window.COMMON.REQUEST.METHOD_GET, {}, $.proxy(this.handleGetMysites, null, this));
  },
  handleGetMysites: function (parent, response) {
    if (response.error_flag) {
      // TODO エラー
      $(parent.$mysitesListLoader).fadeOut();
    }

    var details = response.details;
    if (details.length === 0) {
      $(parent.$mysitesListLoader).fadeOut();
      return;
    }

    var mysitesHtml = '';
    $(details).each(function (idx, mysite) {
      var html =
        '<article class="mysites-list-item open-animation">' +
        '<div class="mysites-list-item-title">' +
        '<h2 class="mysites-title">' + window.COMMON.UTILS.roundString(mysite.title, 10) + '</h2>' +
        '<button class="jsc-delete-mysites-btn" data-mysite-id="' + mysite.mysite_id + '" data-site-type="' + mysite.site_type + '" ><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></button>' +
        '</div>' +
        '<div class="mysites-list-item-image" style="background-image: url(' + mysite.thumbnail + ')"></div>' +
        '<div class="mysites-list-item-detail">' +
        '<div class="mysites-list-item-description">' + window.COMMON.UTILS.roundString(mysite.description) + '</div>' +
        '</div>' +
        '</article>';
      mysitesHtml += html;
    });

    $(parent.$mysitesListLoader).fadeOut().queue(function () {
      parent.$mysitesLists.append(mysitesHtml);
      $(this).stop();
    });

  },
  getMycolle: function () {
    this.$mycolleListLoader.css('display', 'block');

    var url = window.COMMON.APIS.GET_MYCOLLE_API_URL;
    url = url.replace(window.COMMON.APIS.ALIASES.MYCOLLE_ID, '');

    window.COMMON.REQUEST.sendToServer(url, window.COMMON.REQUEST.METHOD_GET, {}, $.proxy(this.handleGetMycolle, null, this));
  },
  handleGetMycolle: function (parent, response) {
    if (response.error_flag) {
      // TODO エラー
      $(parent.$mycolleListLoader).fadeOut();
    }

    var details = response.details;
    if (details.length === 0) {
      $(parent.$mycolleListLoader).fadeOut();
      return;
    }

    var mycolleHtml = '';
    $(details).each(function (idx, mycolle) {
      var html =
        '<article class="mycolle-list-item open-animation">' +
        '<div class="mycolle-list-item-title">' +
        '<h2 class="mycolle-title">' + window.COMMON.UTILS.roundString(mycolle.title, 10) + '</h2>' +
        '<button class="jsc-delete-mycolle-btn" data-mycolle-id="' + mycolle.mycolle_id + '" data-collection-type="' + mycolle.collection_type + '" ><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></button>' +
        '</div>' +
        '<div class="mycolle-list-item-image" style="background-image: url(' + mycolle.thumbnail + ')"></div>' +
        '<div class="mycolle-list-item-detail">' +
        '<div class="mycolle-list-item-description">' + window.COMMON.UTILS.roundString(mycolle.description) + '</div>' +
        '</div>' +
        '</article>';
      mycolleHtml += html;
    });

    $(parent.$mycolleListLoader).fadeOut().queue(function () {
      parent.$mycolleLists.append(mycolleHtml);
      $(this).stop();
    });

  },
  handleAddMysitesBtn: function () {
    this.$mysitesTypeSelectTabContainer.css('display', 'block');
  },
  handleAddMycolleBtn: function () {
    this.$mycolleTypeSelectTabContainer.css('display', 'block');
  },
  handleSelectSettingTypeTabItem: function (parent, event) {
    parent.$mysitesTypeSelectTabContainer.css('display', 'none');
    parent.$mycolleTypeSelectTabContainer.css('display', 'none');
    parent.$searchFeedBox.val('');
    parent.$searchSlideBox.val('');
    parent.$searchYoutubeBox.val('');
    parent.$searchHtmlBox.val('');

    var index = parent.$settingTypeSelectTabItems.index(this);
    parent.$settingTypeSelectTabContentsItems.css('display', 'none');
    parent.$settingTypeSelectTabContentsItems.eq(index).css('display', 'block');
    parent.$settingTypeSelectTabItems.removeClass('select');
    $(this).addClass('select');
  },
  handleSelectMycollectTabItem: function (parent, event) {
    var index = parent.$mycolleTypeSelectTabItems.index(this);
    parent.$mycolleTypeSelectTabContentsItems.css('display', 'none');
    parent.$mycolleTypeSelectTabContentsItems.eq(index).css('display', 'block');
    parent.$mycolleTypeSelectTabItems.removeClass('select');
    $(this).addClass('select');
  },
  handleChangeSearchFeedBox: function () {
    this.$searchFeedResults.empty();
    clearTimeout(this.timer);

    this.timer = setTimeout($.proxy(this.searchFeed, this), this.timerWeight);
  },
  handleChangeSearchSlideBox: function () {
    this.$searchSlideResults.empty();
    clearTimeout(this.timer);

    this.timer = setTimeout($.proxy(this.searchSlide, this), this.timerWeight);
  },
  handleChangeSearchYoutubeBox: function () {
    this.$searchYoutubeResults.empty();
    clearTimeout(this.timer);

    this.timer = setTimeout($.proxy(this.searchYoutubeMovie, this), this.timerWeight);
  },
  handleChangeSearchHtmlBox: function () {
    this.$searchHtmlResults.empty();
    clearTimeout(this.timer);

    this.timer = setTimeout($.proxy(this.searchHtml, this), this.timerWeight);
  },
  searchFeed: function () {
    if (this.$searchFeedBox.val().trim() === '') {
      return;
    }

    this.$searchFeedLoader.css('display', 'block');

    var url = window.COMMON.APIS.SEARCH_MYSITES_API_URL;
    url = url.replace(window.COMMON.APIS.ALIASES.SITE_TYPE, window.COMMON.SITE_TYPES.FEEDLY).replace(window.COMMON.APIS.ALIASES.SEARCH_KEYWORDS, this.$searchFeedBox.val());

    window.COMMON.REQUEST.sendToServer(url, window.COMMON.REQUEST.METHOD_GET, {}, $.proxy(this.handleSearchFeedResponse, null, this));
  },
  handleSearchFeedResponse: function (parent, response) {
    if (response.error_flag) {
      $(parent.$searchFeedLoader).fadeOut().queue(function () {
        parent.$searchFeedResults.append(window.COMMON.HTML.SEARCH_ERROR);
        $(this).stop();
      });
      return;
    }

    if (response.details.length === 0) {
      $(parent.$searchFeedLoader).fadeOut().queue(function () {
        parent.$searchFeedResults.append(window.COMMON.HTML.SEARCH_NOT_FOUND);
        $(this).stop();
      });
      return;
    }

    var searchResults = response.details;
    var searchResultsHtml = '';
    $(searchResults).each(function (idx, searchResult) {
      var tagHtml = '';
      $(searchResult['tags']).each(function (idx, tag) {
        tagHtml += '<span class="content-tag">' + '#' + tag + '</span>';
      });
      var html =
        '<article class="search-result-item">' +
        '<div class="search-result-item-image" style="background-image: url(' + searchResult.thumbnail + ')"></div>' +
        '<div class="search-result-item-detail">' +
        '<h3 class="search-result-item-title">' + searchResult.title +
        '<span class="content-followers"><i class="fa fa-user-o fa-lg" aria-hidden="true"></i> ' + searchResult.followers + '</span>' +
        '</h3>' +
        '<div class="search-result-item-tags">' + tagHtml + '</div>' +
        '<div class="search-result-item-description">' + searchResult.description + '</div>' +
        '</div>' +
        '<div class="search-result-item-btns">' +
        '<button class="jsc-register-mysites-btn" data-content-id="' + searchResult.content_id + '" data-site-type="' + searchResult.site_type + '" ><i class="fa fa-paperclip" aria-hidden="true"></i></button>' +
        '<a class="link-btn" href="' + searchResult.site_url + '" target="_blank"><i class="fa fa-window-restore fa-lg" aria-hidden="true"></i></a>' +
        '</div>' +
        '</article>';
      searchResultsHtml += html;

      var storeParam = {
        "title": searchResult.title,
        "description": searchResult.description,
        "thumbnail": searchResult.thumbnail,
        "site_type": searchResult.site_type
      };
      sessionStorage[searchResult.content_id] = JSON.stringify(storeParam);

    });

    $(parent.$searchFeedLoader).fadeOut().queue(function () {
      parent.$searchFeedResults.append(searchResultsHtml);
      $(this).stop();
    });

  },
  searchSlide: function () {
    if (this.$searchSlideBox.val().trim() === '') {
      return;
    }

    this.$searchSlideLoader.css('display', 'block');

    var url = window.COMMON.APIS.SEARCH_MYCOLLE_API_URL;
    url = url.replace(window.COMMON.APIS.ALIASES.COLLECTION_TYPE, window.COMMON.COLLECTION_TYPES.SLIDE_SHARE).replace(window.COMMON.APIS.ALIASES.SEARCH_KEYWORDS, this.$searchSlideBox.val());

    window.COMMON.REQUEST.sendToServer(url, window.COMMON.REQUEST.METHOD_GET, {}, $.proxy(this.handleSearchSlideResponse, null, this));
  },
  handleSearchSlideResponse: function (parent, response) {
    if (response.error_flag) {
      $(parent.$searchSlideLoader).fadeOut().queue(function () {
        parent.$searchSlideResults.append(window.COMMON.HTML.SEARCH_ERROR);
        $(this).stop();
      });
      return;
    }

    if (response.details.length === 0) {
      $(parent.$searchSlideLoader).fadeOut().queue(function () {
        parent.$searchSlideResults.append(window.COMMON.HTML.SEARCH_NOT_FOUND);
        $(this).stop();
      });
      return;
    }

    var searchResults = response.details;
    var searchResultsHtml = '';
    $(searchResults).each(function (idx, searchResult) {
      var html =
        '<article class="search-result-item">' +
        '<div class="search-result-item-image" style="background-image: url(' + searchResult.thumbnail + ')"></div>' +
        '<div class="search-result-item-detail">' +
        '<h3 class="search-result-item-title">' + searchResult.title + '</h3>' +
        '<div class="search-result-item-description">' + searchResult.description + '</div>' +
        '</div>' +
        '<div class="search-result-item-btns">' +
        '<button class="jsc-register-mycolle-btn" data-content-id="' + searchResult.content_id + '" data-collection-type="' + searchResult.collection_type + '" ><i class="fa fa-paperclip fa-lg" aria-hidden="true"></i></button>' +
        '<a class="link-btn" href="' + searchResult.content_url + '" target="_blank"><i class="fa fa-window-restore fa-lg" aria-hidden="true"></i></a>' +
        '</div>' +
        '</article>';
      searchResultsHtml += html;

      var storeParam = {
        "title": searchResult.title,
        "description": searchResult.description,
        "thumbnail": searchResult.thumbnail,
        "site_type": searchResult.collection_type
      };
      sessionStorage[searchResult.content_id] = JSON.stringify(storeParam);
    });
    $(parent.$searchSlideLoader).fadeOut().queue(function () {
      parent.$searchSlideResults.append(searchResultsHtml);
      $(this).stop();
    });

  },
  searchYoutubeMovie: function () {
    if (this.$searchYoutubeBox.val().trim() === '') {
      return;
    }

    this.$searchYoutubeLoader.css('display', 'block');

    var url = window.COMMON.APIS.SEARCH_MYCOLLE_API_URL;
    url = url.replace(window.COMMON.APIS.ALIASES.COLLECTION_TYPE, window.COMMON.COLLECTION_TYPES.YOUTUBE).replace(window.COMMON.APIS.ALIASES.SEARCH_KEYWORDS, this.$searchYoutubeBox.val());

    window.COMMON.REQUEST.sendToServer(url, window.COMMON.REQUEST.METHOD_GET, {}, $.proxy(this.handleSearchYoutubeResponse, null, this));
  },
  handleSearchYoutubeResponse: function (parent, response) {
    if (response.error_flag) {
      $(parent.$searchYoutubeLoader).fadeOut().queue(function () {
        parent.$searchYoutubeResults.append(window.COMMON.HTML.SEARCH_ERROR);
        $(this).stop();
      });
      return;
    }

    if (response.details.length === 0) {
      $(parent.$searchYoutubeLoader).fadeOut().queue(function () {
        parent.$searchYoutubeResults.append(window.COMMON.HTML.SEARCH_NOT_FOUND);
        $(this).stop();
      });
      return;
    }

    var searchResults = response.details;
    var searchResultsHtml = '';
    $(searchResults).each(function (idx, searchResult) {
      var html =
        '<article class="search-result-item">' +
        '<div class="search-result-item-image" style="background-image: url(' + searchResult.thumbnail + ')"></div>' +
        '<div class="search-result-item-detail">' +
        '<h3 class="search-result-item-title">' + searchResult.title + '</h3>' +
        '<div class="search-result-item-description">' + searchResult.description + '</div>' +
        '</div>' +
        '<div class="search-result-item-btns">' +
        '<button class="jsc-register-mycolle-btn" data-content-id="' + searchResult.content_id + '" data-collection-type="' + searchResult.collection_type + '" ><i class="fa fa-paperclip fa-lg" aria-hidden="true"></i></button>' +
        '<a class="link-btn" href="' + searchResult.content_url + '" target="_blank"><i class="fa fa-window-restore fa-lg" aria-hidden="true"></i></a>' +
        '</div>' +
        '</article>';
      searchResultsHtml += html;

      var storeParam = {
        "title": searchResult.title,
        "description": searchResult.description,
        "thumbnail": searchResult.thumbnail,
        "site_type": searchResult.collection_type
      };
      sessionStorage[searchResult.content_id] = JSON.stringify(storeParam);
    });

    $(parent.$searchYoutubeLoader).fadeOut().queue(function () {
      parent.$searchYoutubeResults.append(searchResultsHtml);
      $(this).stop();
    });

  },
  searchHtml: function () {
    if (this.$searchHtmlBox.val().trim() === '') {
      return;
    }

    this.$searchHtmlLoader.css('display', 'block');

    var url = window.COMMON.APIS.SEARCH_MYCOLLE_API_URL;
    url = url.replace(window.COMMON.APIS.ALIASES.COLLECTION_TYPE, window.COMMON.COLLECTION_TYPES.HTML).replace(window.COMMON.APIS.ALIASES.SEARCH_KEYWORDS, encodeURIComponent(encodeURIComponent(this.$searchHtmlBox.val())));

    window.COMMON.REQUEST.sendToServer(url, window.COMMON.REQUEST.METHOD_GET, {}, $.proxy(this.handleSearchHtmlResponse, null, this));
  },
  handleSearchHtmlResponse: function (parent, response) {
    if (response.error_flag) {
      $(parent.$searchHtmlLoader).fadeOut().queue(function () {
        parent.$searchHtmlResults.append(window.COMMON.HTML.SEARCH_NOT_FOUND);
        $(this).stop();
      });
      return;
    }

    if (response.details.length === 0) {
      $(parent.$searchHtmlLoader).fadeOut().queue(function () {
        parent.$searchHtmlResults.append(window.COMMON.HTML.SEARCH_NOT_FOUND);
        $(this).stop();
      });
      return;
    }

    var searchResults = response.details;
    var searchResultsHtml = '';
    $(searchResults).each(function (idx, searchResult) {
      var html =
        '<article class="search-result-item">' +
        '<div class="search-result-item-image" style="background-image: url(' + searchResult.thumbnail + ')"></div>' +
        '<div class="search-result-item-detail">' +
        '<h3 class="search-result-item-title">' + searchResult.title + '</h3>' +
        '<div class="search-result-item-description">' + searchResult.description + '</div>' +
        '</div>' +
        '<div class="search-result-item-btns">' +
        '<button class="jsc-register-mycolle-btn" data-content-id="' + searchResult.content_id + '" data-collection-type="' + searchResult.collection_type + '" ><i class="fa fa-paperclip fa-lg" aria-hidden="true"></i></button>' +
        '<a class="link-btn" href="' + searchResult.content_url + '" target="_blank"><i class="fa fa-window-restore fa-lg" aria-hidden="true"></i></a>' +
        '</div>' +
        '</article>';
      searchResultsHtml += html;

      var storeParam = {
        "title": searchResult.title,
        "description": searchResult.description,
        "thumbnail": searchResult.thumbnail,
        "site_type": searchResult.collection_type
      };
      sessionStorage[searchResult.content_id] = JSON.stringify(storeParam);
    });

    $(parent.$searchHtmlLoader).fadeOut().queue(function () {
      parent.$searchHtmlResults.append(searchResultsHtml);
      $(this).stop();
    });
  },
  handleRegisterMysitesBtn: function (parent, event) {
    var url = window.COMMON.APIS.EDIT_MYSITES_API_URL;
    url = url.replace(window.COMMON.APIS.ALIASES.MYSITES_ID, 0);

    var siteType = $(event.target).attr('data-site-type');
    var contentId = $(event.target).attr('data-content-id');
    if (siteType === undefined) {
      siteType = $(event.target).closest('.jsc-register-mysites-btn').attr('data-site-type');
      contentId = $(event.target).closest('.jsc-register-mysites-btn').attr('data-content-id');
    }
    var data = {
      "site_type": siteType,
      "content_id": contentId,
      "delete_flag": false
    };

    var registerTarget = $(this).find('.fa');
    registerTarget.addClass('rotate');

    window.COMMON.REQUEST.sendToServer(url, window.COMMON.REQUEST.METHOD_POST, data, $.proxy(parent.handleRegisterMysitesResponse, null, parent, registerTarget, contentId));
  },
  handleRegisterMysitesResponse: function (parent, registerTarget, contentId, response) {
    if (response.error_flag) {
      // TODO エラー
    }

    $(registerTarget).removeClass('rotate').removeClass('fa-paperclip').addClass('fa-check').closest('.jsc-register-mysites-btn').addClass('registered-content');

    var storeParam = JSON.parse(sessionStorage[contentId]);

    var mysiteHtml =
      '<article class="mysites-list-item open-animation">' +
      '<div class="mysites-list-item-title">' +
      '<h2 class="mysites-title">' + window.COMMON.UTILS.roundString(storeParam.title, 10) + '</h2>' +
      '<button class="jsc-delete-mysites-btn" data-mysite-id="' + response.details.mysite_id + '" data-site-type="' + storeParam.site_type + '" ><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></button>' +
      '</div>' +
      '<div class="mysites-list-item-image" style="background-image: url(' + storeParam.thumbnail + ')"></div>' +
      '<div class="mysites-list-item-detail">' +
      '<div class="mysites-list-item-description">' + window.COMMON.UTILS.roundString(storeParam.description) + '</div>' +
      '</div>' +
      '</article>';

    parent.$mysitesLists.append(mysiteHtml);

    sessionStorage.removeItem(contentId);

  },
  handleRegisterMycolleBtn: function (parent, event) {
    var url = window.COMMON.APIS.EDIT_MYCOLLE_API_URL;
    url = url.replace(window.COMMON.APIS.ALIASES.MYCOLLE_ID, 0);

    var collectionType = $(event.target).attr('data-collection-type');
    var contentId = $(event.target).attr('data-content-id');
    if (collectionType === undefined) {
      collectionType = $(event.target).closest('.jsc-register-mycolle-btn').attr('data-collection-type');
      contentId = $(event.target).closest('.jsc-register-mycolle-btn').attr('data-content-id');
    }

    var data = {
      "collection_type": collectionType,
      "content_id": contentId,
      "delete_flag": false
    };

    var registerTarget = $(this).find('.fa');
    registerTarget.addClass('rotate');

    window.COMMON.REQUEST.sendToServer(url, window.COMMON.REQUEST.METHOD_POST, data, $.proxy(parent.handleRegisterMycolleResponse, null, parent, registerTarget, contentId));
  },
  handleRegisterMycolleResponse: function (parent, registerTarget, contentId, response) {
    if (response.error_flag) {
      // TODO エラー
    }
    $(registerTarget).removeClass('rotate').removeClass('fa-paperclip').addClass('fa-check').closest('.jsc-register-mycolle-btn').addClass('registered-content');

    var storeParam = JSON.parse(sessionStorage[contentId]);

    var mycolleHtml =
      '<article class="mycolle-list-item open-animation">' +
      '<div class="mycolle-list-item-title">' +
      '<h2 class="mycolle-title">' + window.COMMON.UTILS.roundString(storeParam.title, 10) + '</h2>' +
      '<button class="jsc-delete-mycolle-btn" data-mycolle-id="' + response.details.mycolle_id + '" data-collection-type="' + storeParam.collection_type + '" ><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></button>' +
      '</div>' +
      '<div class="mycolle-list-item-image" style="background-image: url(' + storeParam.thumbnail + ')"></div>' +
      '<div class="mycolle-list-item-detail">' +
      '<div class="mycolle-list-item-description">' + window.COMMON.UTILS.roundString(storeParam.description) + '</div>' +
      '</div>' +
      '</article>';

    parent.$mycolleLists.append(mycolleHtml);

    sessionStorage.removeItem(contentId);
  },
  handleDeleteMysitesBtn: function (parent, event) {
    var url = window.COMMON.APIS.EDIT_MYSITES_API_URL;
    url = url.replace(window.COMMON.APIS.ALIASES.MYSITES_ID, $(this).attr('data-mysite-id'));

    var data = {
      "delete_flag": true
    };

    $(this).find('.fa').removeClass('fa-trash-o').addClass('fa-hand-paper-o').addClass('repeat-rotate');
    var deleteTarget = $(this).closest('.mysites-list-item');

    window.COMMON.REQUEST.sendToServer(url, window.COMMON.REQUEST.METHOD_POST, data, $.proxy(parent.handleDeleteMysitesResponse, null, this, deleteTarget));
  },
  handleDeleteMysitesResponse: function (parent, deleteTarget, response) {
    if (response.error_flag) {
      // TODO エラー
    }

    $(deleteTarget).fadeOut().queue(function () {
      $(this).remove();
    });

  },
  handleDeleteMycolleBtn: function (parent, event) {
    var url = window.COMMON.APIS.EDIT_MYCOLLE_API_URL;
    url = url.replace(window.COMMON.APIS.ALIASES.MYCOLLE_ID, $(this).attr('data-mycolle-id'));

    var data = {
      "delete_flag": true
    };

    $(this).find('.fa').removeClass('fa-trash-o').addClass('fa-hand-paper-o').addClass('repeat-rotate');
    var deleteTarget = $(this).closest('.mycolle-list-item');

    window.COMMON.REQUEST.sendToServer(url, window.COMMON.REQUEST.METHOD_POST, data, $.proxy(parent.handleDeleteMycolleResponse, null, this, deleteTarget));
  },
  handleDeleteMycolleResponse: function (parent, deleteTarget, response) {
    if (response.error_flag) {
      // TODO エラー
    }

    $(deleteTarget).fadeOut().queue(function () {
      $(this).remove();
    });


  }

};

$(function () {
  MYCOLLE.SETTINGS.DATA_CONTROLLER.init();
});
