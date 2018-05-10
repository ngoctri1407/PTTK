$(window).on("scroll", function(e) {
    var scrollTop = $(window).scrollTop();
    if (scrollTop <= 51) {
        $('.navbar-top').css("height", (50 - scrollTop));
    } else {
        $('.navbar-top').css("height", 0);
    }
    // With JQuery
    $("#search-range").slider({});
});

$('ul.second-list').hover(function() {
    $(this).parent("li").addClass("menu-active");
});

$('ul.second-list').mouseleave(function() {
    $(this).parent("li").removeClass("menu-active");
});

$('#viLanguage').click(function() {
    changeLang('vi');
});

$('#enLanguage').click(function() {
    changeLang('en');
});

function changeLang(langStr) {
  if (langStr) {
    var x = langStr;
    var url = window.location.href;
    var index = url.indexOf('lang');
    var newUrl = '';
    if (index >= 0) {
        newUrl = url.substr(0, index + 5) + x + url.substr(index + 7, url.length - 1);
    } else if (url.indexOf('?') >= 0) {
        newUrl = url + '&lang=' + x;
    } else {
        newUrl = url + '?lang=' + x;
    }
    location.href = newUrl;
  }
}

$(function() {
  $('#dl-menu').dlmenu();
});

Number.prototype.formatMoney = function(fractionDigits, decimal, separator) {
    fractionDigits = isNaN(fractionDigits = Math.abs(fractionDigits)) ? 2 : fractionDigits;
    decimal = typeof(decimal) === "undefined" ? "." : decimal;
    separator = typeof(separator) === "undefined" ? "," : separator;
    var number = this;
    var neg = number < 0 ? "-" : "";
    var wholePart = parseInt(number = Math.abs(+number || 0).toFixed(fractionDigits)) + "";
    var separtorIndex = (separtorIndex = wholePart.length) > 3 ? separtorIndex % 3 : 0;
    return neg +
        (separtorIndex ? wholePart.substr(0, separtorIndex) + separator : "") +
        wholePart.substr(separtorIndex).replace(/(\d{3})(?=\d)/g, "$1" + separator) +
        (fractionDigits ? decimal + Math.abs(number - wholePart).toFixed(fractionDigits).slice(2) : "");
};
$('#search-type').change(function(){
  let priceArr = [];
  let priceStr = '';
  $('#min-price').empty();
  $('#max-price').empty();
  if($('#search-type').val() == 'R'){
    priceArr = [100,200,300,400,500,600,700,800,900,1000,1500,2000,2500,3000,3500,4000,4500,5000,6000,7000,8000,9000,10000];
    
    priceArr.forEach(function (value,index) {
      priceStr += "<option value=" + value + "> $" +   value.formatMoney(0, '.', ',') + "</option>";
    });
    priceStr += '<option value=">10000"> >$10,000</option>';
    priceStrMin = '<option value=""> Min price pm </option>'+priceStr;
    $("#min-price").append(priceStrMin);
    priceStrMax = '<option value=""> Max price pm </option>'+priceStr;
    $("#max-price").append(priceStrMax);
  }
  if($('#search-type').val() == 'S'){
    priceArr = [50000,100000,150000,200000,250000,300000,350000,400000,450000,500000,600000,700000,800000,900000,1000000,1500000,2000000];
    
    priceArr.forEach(function (value,index) {
      priceStr += "<option value=" + value + "> $" +   value.formatMoney(0, '.', ',') + "</option>";
    });
    priceStr += '<option value=">2000000"> >$2,000,000</option>';
    priceStrMin = '<option value=""> Min price pm </option>'+priceStr;
    $("#min-price").append(priceStrMin);
    priceStrMax = '<option value=""> Max price pm </option>'+priceStr;
    $("#max-price").append(priceStrMax);
  }
});