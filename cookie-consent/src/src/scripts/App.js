// import "./../styles/main.scss";
import "jquery";
import CookieConsent from "./cookie-consent";
(function ($) {
    let locale = $("body").attr("data-locale");
    $.getJSON("/cookie-consent-data?locale=" + locale, (data) => {
        const CookieConsentNode = new CookieConsent(data);
        CookieConsentNode.init();
    });
})(jQuery);
