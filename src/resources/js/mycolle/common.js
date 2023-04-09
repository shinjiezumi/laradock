/**
 * Created by User on 2017/01/08.
 */
var MYCOLLE = MYCOLLE || {};
MYCOLLE.COMMON = {};

MYCOLLE.COMMON.REQUEST = {
  METHOD_GET: 'GET',
  METHOD_POST: 'POST',

  sendToServer: function (url, type, data, callback) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': window.Laravel.csrfToken
      }
    });

    return $.ajax({
      url: url,
      type: type,
      dataType: 'json',
      // contentType: 'application/json',
      data: data
    })
      .done(callback)
      .fail(callback);
  },
};

MYCOLLE.COMMON.APIS = {
  GET_MYCOLLE_API_URL: '/apis/v1/get-mycolle/#mycolleId#',
  EDIT_MYCOLLE_API_URL: '/apis/v1/edit-mycolle/#mycolleId#',
  SEARCH_MYCOLLE_API_URL: '/apis/v1/search-mycolle/#collectionType#/#searchKeywords#',

  GET_MYSITES_API_URL: '/apis/v1/get-mysites/#mysitesId#',
  EDIT_MYSITES_API_URL: '/apis/v1/edit-mysites/#mysitesId#',
  SEARCH_MYSITES_API_URL: '/apis/v1/search-mysites/#siteType#/#searchKeywords#',

  GET_MYSITE_CONTENTS_API_URL: '/apis/v1/get-mysite-contents/#mysitesId#',
  GET_MYSITE_IDS_API_URL: '/apis/v1/get-mysite-ids/',

  ALIASES: {
    MYCOLLE_ID: '#mycolleId#',
    MYSITES_ID: '#mysitesId#',
    COLLECTION_TYPE: '#collectionType#',
    SITE_TYPE: '#siteType#',
    SEARCH_KEYWORDS: '#searchKeywords#'
  }
};

MYCOLLE.COMMON.SITE_TYPES = {
  FEEDLY: 1
};

MYCOLLE.COMMON.COLLECTION_TYPES = {
  // FEEDLY: 1,
  SLIDE_SHARE: 2,
  YOUTUBE: 3,
  HTML: 4
};

MYCOLLE.COMMON.HTML = {
  SEARCH_NOT_FOUND: '<div class="search-result-item">検索しましたが見つかりませんでした。</div>',
  SEARCH_ERROR: '<div class="search-result-item">エラーが発生しました。</div>'
}

MYCOLLE.COMMON.DOMAIN = {
  PROD: 'mycolle.usefulservices.net',
  DEV: 'dev-mycolle.usefulservices.net'
}

MYCOLLE.COMMON.UTILS = {
  roundString: function (str, length, afterText) {
    if (str === undefined) {
      return '';
    }
    if (length === undefined) {
      length = 40;
    }
    if (afterText === undefined) {
      afterText = '...';
    }

    if (str.length > length) {
      str = str.substr(0, (length));
      str += afterText;
    }

    return str;
  }
};


MYCOLLE.COMMON.HEADEREVENTS = {
  init: function () {
    this.setParameters();
    this.bindEvents();
    this.initialize();
  },
  setParameters: function () {
    this.$headerToggle = $('#jsc-header-toggle');
    this.$headerNav = $('#jsc-header-nav');
  },
  bindEvents: function () {
    this.$headerToggle.on('click', $.proxy(this.toggleHeader, this));
  },
  initialize: function () {
    // this.$headerNav.hide();
  },
  toggleHeader: function () {
    this.$headerNav.slideToggle();
  }
};

$(function () {
  MYCOLLE.COMMON.HEADEREVENTS.init();
});

MYCOLLE.COMMON.AD = {
  getResponsiveAdCd: function () {
    var ad = '';
    if (document.domain === MYCOLLE.COMMON.DOMAIN.PROD) {
      ad =
        '<div class="ad responsive">' +
        '<p>スポンサードリンク</p>' +
        '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>' +
        '<!-- 【開発用】マイコレ -->' +
        '<ins class="adsbygoogle"' +
        'style="display:block"' +
        'data-ad-client="ca-pub-9817289486577371"' +
        'data-ad-slot="1310881447"' +
        'data-ad-format="auto"></ins>' +
        '<script>' +
        '(adsbygoogle = window.adsbygoogle || []).push({});' +
        '</script>' +
        '</div>';
    } else if (document.domain === MYCOLLE.COMMON.DOMAIN.DEV) {
      ad =
        '<div class="ad">' +
        '<p>スポンサードリンク</p>' +
        '<img src="http://placehold.jp/400x200.png?text=AD" style="width: 70%; height: 200px;">' +

        '</div>';
    }

    return ad;
  },
  getFixedAdCd: function () {
    var ad = '';
    if (document.domain === MYCOLLE.COMMON.DOMAIN.PROD) {
      ad =
        '<div class="ad responsive">' +
        '<div>スポンサードリンク</div>' +
        '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>' +
        '<!-- マイコレ（200x200） -->' +
        '<ins class="adsbygoogle"' +
        'style="display:inline-block;width:200px;height:200px"' +
        'data-ad-client="ca-pub-9817289486577371"' +
        'data-ad-slot="4763875442"></ins>' +
        '<script>' +
        '(adsbygoogle = window.adsbygoogle || []).push({});' +
        '</script> +' +
        '</div>';
    } else if (document.domain === MYCOLLE.COMMON.DOMAIN.DEV) {
      ad =
        '<div class="ad">' +
        '<div>スポンサードリンク</div>' +
        '<img src="http://placehold.jp/200x200.png?text=AD">' +
        '</div>';
    }
    return ad;
  }

};

window.COMMON = MYCOLLE.COMMON;
