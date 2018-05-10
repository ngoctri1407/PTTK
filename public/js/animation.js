  var heightDisplay = $(window).height() - 250;
  var listAniArr = [{
    name: '.list-box',
    animation: 'fadeInUp'
  }, {
    name: '.side-bar',
    animation: 'slideInRight'
  }, {
    name: '.post',
    animation: 'fadeInUp'
  }, {
    name: '.detail-nav',
    animation: 'slideInRight'
  }, {
    name: '.main-title',
    animation: 'slideInLeft'
  }, {
    name: '.ani-main-content',
    animation: 'fadeIn'
  }];

  $(window).load(function() {
    animateElement(listAniArr);
  });
  $(window).scroll(function() {
    animateElement(listAniArr);
  });

  function animateElement(listAniArr) {
    listAniArr.forEach(function(item, index) {
      $(item.name).each(function() {
        var imagePos = $(this).offset().top;
        var topOfWindow = $(window).scrollTop();
        if (imagePos < topOfWindow + heightDisplay) {
          $(this).addClass("animated " + item.animation);
        }
      });
    });
  }
