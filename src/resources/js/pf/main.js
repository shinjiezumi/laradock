require('./vendor/jquery.circliful.min');

const PORTFOLIO = {};
PORTFOLIO.DATA_CONTROLLER = {};

PORTFOLIO.DATA_CONTROLLER = {
  windowHeight: $(window).height(),
  isPhpCircleRendered: false,
  isInfraCircleRendered: false,
  isHtmlCssCircleRendered: false,
  isJsCircleRendered: false,

  init() {
    this.setParameters();
    this.bindEvents();
    this.initialize();
  },
  setParameters() {
    this.$htmlBody = $('html, body');
    this.$siteLogoContainer = $('.site-logo-container');
    this.$globalNavi = $('.global-navi');
    this.$pageTop = $('.pagetop');
    this.$skillPhpCircle = $('#php-circle');
    this.$skillInfraCircle = $('#infra-circle');
    this.$skillHtmlcssCircle = $('#htmlcss-circle');
    this.$skillJsCircle = $('#js-circle');
  },
  bindEvents() {
    $(document).on('click', '.pagetop', $.proxy(this.handlePageTopClick, null, this));
    $(window).scroll($.proxy(this.handlePageScroll, null, this));
  },
  initialize() {
  },
  handlePageScroll(parent) {
    const scrollTop = $(this).scrollTop();
    const scrollBottom = scrollTop + parent.windowHeight;

    // トップメニュー
    if (scrollTop > parent.$siteLogoContainer.height()) {
      parent.$globalNavi.addClass('fixed-top');
    } else {
      parent.$globalNavi.removeClass('fixed-top');
    }

    // ページトップボタン
    if (scrollTop > 300) {
      parent.$pageTop.fadeIn();
    } else {
      parent.$pageTop.fadeOut();
    }

    // スキル円グラフ
    if (!parent.isPhpCircleRendered
      && scrollBottom > parent.$skillPhpCircle.offset().top) {
      parent.$skillPhpCircle.circliful({
        title: 'PHP',
        animationStep: 5,
        foregroundBorderWidth: 5,
        backgroundBorderWidth: 8,
        percent: PORTFOLIO.DEF.skillPhp,
      });
      // eslint-disable-next-line no-param-reassign
      parent.isPhpCircleRendered = true;
    }

    if (!parent.isInfraCircleRendered
      && scrollBottom > parent.$skillInfraCircle.offset().top) {
      parent.$skillInfraCircle.circliful({
        animationStep: 5,
        foregroundBorderWidth: 5,
        backgroundBorderWidth: 8,
        percent: PORTFOLIO.DEF.skillInfra,
      });
      // eslint-disable-next-line no-param-reassign
      parent.isInfraCircleRendered = true;
    }

    if (!parent.isHtmlCssCircleRendered
      && scrollBottom > parent.$skillHtmlcssCircle.offset().top) {
      parent.$skillHtmlcssCircle.circliful({
        animationStep: 5,
        foregroundBorderWidth: 5,
        backgroundBorderWidth: 8,
        percent: PORTFOLIO.DEF.skillHtmlcss,
      });
      // eslint-disable-next-line no-param-reassign
      parent.isHtmlCssCircleRendered = true;
    }

    if (!parent.isJsCircleRendered
      && scrollBottom > parent.$skillJsCircle.offset().top) {
      parent.$skillJsCircle.circliful({
        animationStep: 5,
        foregroundBorderWidth: 5,
        backgroundBorderWidth: 8,
        percent: PORTFOLIO.DEF.skillJs,
      });
      // eslint-disable-next-line no-param-reassign
      parent.isJsCircleRendered = true;
    }
  },
  handlePageTopClick(parent) {
    parent.$htmlBody.animate({scrollTop: 0}, 500, 'swing');
  },
};

$(() => {
  // eslint-disable-next-line no-restricted-globals
  const url = new URL(location);
  const path = url.pathname;
  if (!path.startsWith('/pf')) {
    return;
  }

  PORTFOLIO.DATA_CONTROLLER.init();
});

PORTFOLIO.DEF = {};
PORTFOLIO.DEF = {
  skillPhp: 70,
  skillInfra: 20,
  skillHtmlcss: 40,
  skillJs: 40,
};
