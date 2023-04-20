/**
 * Created by User on 2017/01/08.
 */
const MYCOLLE = MYCOLLE || {};
MYCOLLE.HOME = {};

MYCOLLE.HOME.DATA_CONTROLLER = {
  timerWeightSec: 0.5 * 1000, mysiteCnt: 0, init() {
    this.setParameters();
    this.bindEvents();
    this.initialize();
  },
  setParameters() {
    this.$mysiteContentsListLoader = $('.mysite-contents-list-container > .loader-bg, .mysite-contents-list-container > .loader');
    this.$mycolleListLoader = $('.mycolle-list-container > .loader-bg, .mycolle-list-container > .loader');
    this.$mysiteContentsLists = $('#jsc-mysite-contents-list');
    this.$mycolleLists = $('#jsc-mycolle-list');
    this.$lastAd = $('#last-ad');
  },
  bindEvents() {
    $(document).on('click', '.mysite-contents-list-item, .mycolle-list-item', $.proxy(this.handleSiteLinkClick, null, this));
  },
  initialize() {
    this.getMysiteIds();
    this.getMycolle();
  },
  getMysiteIds() {
    const url = window.COMMON.APIS.GET_MYSITE_IDS_API_URL;

    window.COMMON.REQUEST.sendToServer(url, window.COMMON.REQUEST.METHOD_GET, {}, $.proxy(this.handleGetMysiteIds, null, this));
  },
  handleGetMysiteIds(parent, response) {
    if (response.error_flag) {
      // TODO エラー
      $(parent.$mysiteContentsListLoader).fadeOut();
    }

    const details = response.details;
    if (details.length === 0) {
      $(parent.$mysiteContentsListLoader).fadeOut();
      return;
    }

    parent.mysiteCnt = details.length;
    $(details).each((idx, mysiteId) => {
      setTimeout($.proxy(parent.getMysiteContents(mysiteId), parent), parent.timerWeightSec)
    });
  },
  getMysiteContents(mysiteId) {
    let url = window.COMMON.APIS.GET_MYSITE_CONTENTS_API_URL;
    url = url.replace(window.COMMON.APIS.ALIASES.MYSITES_ID, mysiteId);

    window.COMMON.REQUEST.sendToServer(url, window.COMMON.REQUEST.METHOD_GET, {}, $.proxy(this.handleGetMysiteContents, null, this));
  },
  handleGetMysiteContents(parent, response) {
    if (response.error_flag) {
      // TODO エラー
      $(parent.$mysiteContentsListLoader).fadeOut();
    }

    const {details} = response;
    if (details.length === 0) {
      $(parent.$mysiteContentsListLoader).fadeOut();
      return;
    }

    let mysiteContentsHtml = '';
    $(details).each(function (i, mysiteContent) {
      let sectionHtml =
        `<section class="mysite-contents-list">` +
        '<h3>' +
        '<i class="fa fa-check-square fa-lg" aria-hidden="true"></i>' +
        `<span class="site-title">${mysiteContent.site_title}</span>` +
        '</h3>' +
        '<div class="mysite-contents-site-list">';

      $(mysiteContent['items']).each(function (j, item) {
        const itemHtml =
          `<article class="mysite-contents-list-item open-animation" data-url="${item.url}">` +
          `<div class="mysite-contents-list-item-title">` +
          `<h4 class="mysite-contents-title">${window.COMMON.UTILS.roundString(item.title, 20)}</h4>` +
          `</div>` +
          `<div class="mysite-contents-list-item-image" style="background-image: url(${item.thumbnail})"></div>` +
          `<div class="mysite-contents-list-item-detail">` +
          `<div class="mysite-contents-list-item-description">${window.COMMON.UTILS.roundString(item.summary)}</div>` +
          `</div>` +
          `</article>`;

        sectionHtml += itemHtml;
      });

      sectionHtml += '</div>' + '</section>';

      mysiteContentsHtml += sectionHtml;
    });

    parent.mysiteCnt--;

    if (parent.mysiteCnt === 0) {
      $(parent.$mysiteContentsListLoader).fadeOut().queue(function () {
        parent.$mysiteContentsLists.append(mysiteContentsHtml);
        $(this).stop();
      });
    } else {
      if (parent.mysiteCnt === 2) {
        mysiteContentsHtml += window.COMMON.AD.getResponsiveAdCd();
      }
      parent.$mysiteContentsLists.append(mysiteContentsHtml);
    }
  },
  getMycolle() {
    this.$mycolleListLoader.css('display', 'block');

    let url = window.COMMON.APIS.GET_MYCOLLE_API_URL;
    url = url.replace(window.COMMON.APIS.ALIASES.MYCOLLE_ID, '');

    window.COMMON.REQUEST.sendToServer(url, window.COMMON.REQUEST.METHOD_GET, {}, $.proxy(this.handleGetMycolle, null, this));
  },
  handleGetMycolle(parent, response) {
    if (response.error_flag) {
      // TODO エラー
      $(parent.$mycolleListLoader).fadeOut();
    }

    const {details} = response;
    if (details.length === 0) {
      $(parent.$mycolleListLoader).fadeOut();
      return;
    }

    let mycolleHtml = '';
    $(details).each((i, mycolle) => {
      const html =
        `<article class="mycolle-list-item open-animation" data-url="${mycolle.content_url}">` +
        `<div class="mycolle-list-item-title">` +
        `<h2 class="mycolle-title">${window.COMMON.UTILS.roundString(mycolle.title, 20)}</h2>` +
        `</div>` +
        `<div class="mycolle-list-item-image" style="background-image: url(${mycolle.thumbnail})"></div>` +
        `<div class="mycolle-list-item-detail">` +
        `<div class="mycolle-list-item-description">${window.COMMON.UTILS.roundString(mycolle.description)}</div>` +
        `</div>` +
        `</article>`;
      mycolleHtml += html;
    });

    $(parent.$mycolleListLoader).fadeOut().queue(function () {
      parent.$mycolleLists.append(mycolleHtml);

      $(this).stop();
    });

    parent.$lastAd.append(window.COMMON.AD.getResponsiveAdCd());
  },
  handleSiteLinkClick(parent, event) {
    window.open($(event.target).closest('.mysite-contents-list-item, .mycolle-list-item').attr('data-url'));
  },
};

$(() => {
  MYCOLLE.HOME.DATA_CONTROLLER.init();
});
