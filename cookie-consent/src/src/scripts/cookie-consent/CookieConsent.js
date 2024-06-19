import Cookies from "js-cookie";
import Dictionnary from "./helpers/Dictionnary";
import Labels from "./helpers/Labels";
import Content from "./helpers/Content";
export default class CookieConsent {
    constructor(props = null) {
        this.cookieConsentName = "CookieConsent";
        this.alreadyConfigured = false;
        this.showDetailsOnly = false;
        this.onClickClassName = ".on-click";
        this.showBannerBoolean = true;
        this.functions = {
            "showPopup": this.togglePopup,
            "acceptAll": this.acceptAll,
            "refuseAll": this.refuseAll,
            "hidePopup": this.togglePopup,
            "toggleDetails": this.toggleDetails,
            "showDetails": this.showDetails,
            "toggleNext": this.toggleNext,
            "submitConsent": this.submitConsent,
        };
        this.data = {
            type: "popup",
            documentNode: "#inline-cookie-consent-banner",
            language: "en",
            content: Content,
            labels: Labels,
            cookies: {}
        };
        this.DOMelements = {
            node: null,
            wrapper: {
                bg: null,
                content: null
            },
            content: {
                overview: null,
                detailed: null
            }
        };
        if (props !== null) {
            if (props.locale !== void 0)
                this.setLocale(props.locale);
            this.prepareDictionnary();
            if (props.content !== void 0)
                this.setContent(props.content);
            if (props.cookies !== void 0)
                this.setCookieTypes(props.cookies);
            if (props.type !== void 0)
                this.data.type = props.type;
            if (props.labels !== void 0)
                this.data.labels = props.labels;
            if (props.documentNode !== void 0)
                this.data.documentNode = props.documentNode;
        }
    }
    prepareDictionnary() {
        const dic = new Dictionnary(this.data.language);
        const registry = dic.getRegistry();
        this.setContent(registry.content);
        this.setLabels(registry.labels);
    }
    setCookieConsentName(name) {
        this.cookieConsentName = name;
        return this;
    }
    displayInlineContent() {
        let cookies = "";
        Object.values(this.data.cookies).forEach((elm, index) => {
            cookies += this.createBlock(elm, index + 1, true);
        });
        var div = document.createElement('div');
        div.classList.add("inline-cookies-block");
        div.innerHTML = `
            ${cookies}
            <p><a href="#show-pop-up" class="show-details-pop-up btn--dark">${this.data.labels.actions.modifyDetails}</a></p>
        `;
        document.querySelector(this.data.documentNode).appendChild(div);
        document.querySelector('.show-details-pop-up').addEventListener("click", (e) => {
            e.preventDefault();
            this.showDetails();
        });
    }
    setContent(content) {
        this.data.content = content;
        return this;
    }
    setLabels(labels) {
        this.data.labels = labels;
        return this;
    }
    setLocale(locale) {
        this.data.language = locale;
        return this;
    }
    setCookieTypes(cookieTypes) {
        this.data.cookies = cookieTypes;
        return this;
    }
    addCookieType(cookieData) {
        this.data.cookies[cookieData.name] = cookieData;
        return this;
    }
    addCallBack(cookieName, callback) {
        if (this.data.cookies[cookieName] !== void 0) {
            this.data.cookies[cookieName].function = callback;
        }
        return this;
    }
    create() {
        this.createNode();
        this.defineDOMElements();
        this.defineEventListeners();
    }
    defineCookie(value) {
        Cookies.set(this.cookieConsentName, value, { expires: 365 });
        return this;
    }
    getCookie(useJSON = true) {
        if (useJSON === true)
            return Cookies.getJSON(this.cookieConsentName);
        return Cookies.get(this.cookieConsentName);
    }
    dropCookie() {
        Cookies.remove(this.cookieConsentName);
        return this;
    }
    init() {
        if (Cookies.get(this.cookieConsentName) !== void 0) {
            const cookies = this.getCookie();
            for (const key in cookies) {
                if (this.data.cookies[key] !== void 0) {
                    this.data.cookies[key].value = cookies[key];
                    if (cookies[key] === true && this.data.cookies[key].function !== void 0) {
                        let fn = Function(this.data.cookies[key].function);
                        fn.call(this);
                    }
                }
            }
            this.showBannerBoolean = false;
        }
        this.create();
        return this;
    }
    defineDOMElements() {
        this.DOMelements = {
            node: document.getElementById("cookieblock"),
            wrapper: {
                bg: document.getElementById("cookieblock__popup-bg"),
                content: document.getElementById("cookieblock__popup")
            },
            content: {
                overview: document.getElementById("cookieblock__popup__overview"),
                detailed: document.getElementById("cookieblock__popup__detailed")
            }
        };
    }
    capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
    toggleDisplay(elm) {
        elm.style.display = elm.style.display == "none" ? "inline-block" : "none";
        return this;
    }
    hideElement(elm) {
        elm.style.display = "none";
        return this;
    }
    defineEventListeners() {
        const buttons = Array.from(document.querySelectorAll(this.onClickClassName));
        for (const button of buttons) {
            button.addEventListener('click', (event) => {
                this.functions[event.currentTarget["dataset"].fn].call(this, event.currentTarget);
            });
        }
    }
    toggleNext(elm) {
        this.toggleDisplay(document.querySelector("." + elm.dataset.table));
    }
    createNode() {
        const popup = this.createPopup();
        var div = document.createElement('div');
        div.innerHTML = popup.trim();
        if (this.data.type === "popup")
            document.body.appendChild(div.firstChild);
        else if (this.data.type === "inline")
            document.querySelector(this.data.documentNode).appendChild(div.firstChild);
    }
    createWrapper() {
        let cookies = "";
        Object.values(this.data.cookies).forEach((elm, index) => {
            cookies += this.createBlock(elm, index + 1);
        });
        return `
            <div id="cookieblock__popup__wrapper">
                <div id="cookieblock__popup__overview" style="display: inline-block;">
                    <h2 class="popup__title" lang="${this.data.language}">${this.data.content.popup.title}</h2>
                    <div class="popup__descr" lang="${this.data.language}">${this.data.content.popup.description}</div>
                    <div class="popup__ctas">
                        <div class="popup__ctas__main">
                            <a href="#event" 
                                data-fn="acceptAll"
                                class="btn btn--dark on-click" 
                                style="margin-right: .5rem">${this.data.labels.actions.allow.all}</a>
                            <a href="#event"  class="on-click" data-fn="hidePopup" class="btn btn--light">${this.data.labels.actions.cancel}</a>
                        </div>
                        <div class="popup__ctas__extra">
                            <a href="#event" 
                                data-fn="toggleDetails"
                                class="btn-simple btn-simple--popup on-click"> ▼ ${this.data.labels.actions.view.advanced}</a>        
                        </div>
                    </div>
                </div>
                <div id="cookieblock__popup__detailed" style="display: none;">
                    ${cookies}
                    <div class="popup__ctas">
                        <div class="popup__ctas__main">
                            <a href="#event"
                                id="acceptButton" 
                                class="btn btn--dark on-click"
                                style="margin-right: .5rem" tabindex="1" 
                                data-fn="submitConsent" 
                                lang="${this.data.language}">${this.data.labels.actions.allow.selected}</a>
                            <a href="#event" data-fn="hidePopup" class="btn btn--light on-click">${this.data.labels.actions.cancel}</a>
                        </div>
                        <div class="popup__ctas__extra">
                            <a href="#event" 
                            data-fn="toggleDetails" 
                            class="btn-simple btn-simple--popup on-click">▲ ${this.data.labels.actions.view.simple}</a>
                        </div>
                    </div>
                </div>
			</div>`;
    }
    createPopup() {
        let wrapper = this.createWrapper();
        return `
            <div id="cookieblock" style="display: ${this.showBannerBoolean === true ? "inline-block" : "none"};" class="${this.data.type}" name="cookieblock">
                <div id="cookieblock__banner" dir="ltr" lang="${this.data.language}">
                    <div id="cookieblock__banner__wrapper">
                        <div>
                            <p style="display: inline-block">${this.data.content.banner.title}<a
                                href="${this.data.content.link}" target="_blank" class="btn-text">${this.data.labels.actions.read.policy}</a>. </p>
                        </div>
                        <div>
                            <a href="#event" data-fn="acceptAll" class="on-click btn btn--dark btn--accept btn--small">${this.data.labels.actions.allow.all}</a>
                            <a href="#event" data-fn="showPopup" class="on-click btn btn--dark btn--show btn--small">${this.data.labels.actions.more}</a>
                            <a href="#event" data-fn="refuseAll" class="on-click btn btn--refuse btn--small">${this.data.labels.actions.refuse.all}</a>
                        </div>
                    </div>
                </div>
                <span id="cookieblock__popup-bg" class="on-click" data-fn="hidePopup" style="display: none;"></span>
                <div id="cookieblock__popup" dir="ltr" style="display: none;" lang="${this.data.language}">
                    ${wrapper}
                </div>
            </div>`;
    }
    createBlock(data, index, hideNextToggleButton = false) {
        let rows = "";
        if (data.cookies.length === 0) {
            return "";
        }
        data.cookies.forEach((cookie) => {
            rows += `
                <tr>
                    <td title="${cookie.name}">${cookie.name}</td>
                    <td title="${cookie.provider}">${cookie.provider}</td>
                    <td title="${cookie.purpose}">${cookie.purpose}</td>
                    <td title="${cookie.expiry}">${cookie.expiry}</td>
                    <td title="${cookie.type}">${cookie.type}</td>
                </tr>
            `;
        });
        let useToggle = data.hideToggle !== void 0 && data.hideToggle === true;
        let toggleSection = "";
        if (hideNextToggleButton == false) {
            if (!useToggle) {
                toggleSection = `
                    <div class="can-toggle">
                        <input type="checkbox" class="cookie-checkbox ${data.disabled !== void 0 && data.disabled === true ? '' : "cookie-available"}" name="${data.name}" id="cookie${this.capitalize(data.name)}" ${data.disabled !== void 0 && data.disabled === true ? 'disabled="disabled"' : ""} ${data.value === true ? 'checked="checked"' : ""} tabindex="${index}">
                        <label for="cookie${this.capitalize(data.name)}">
                            <div class="can-toggle__switch" data-checked="${this.data.labels.switch.on}" data-unchecked="${this.data.labels.switch.off}"></div>
                        </label>
                    </div>
                `;
            }
        }
        return `<div class="cookie-details-section">
            <div class="cookie-details-section-title">
                <p class="cookie-details-title">${data.title}</p>
                ${toggleSection}
            </div>
            <p class="cookie-details-paragraph">${data.description}</p>
            ${hideNextToggleButton ? "" : '<a href="#event" data-fn="toggleNext" data-table="table-' + data.name + '" class="cookie-details-expanse on-click">' + this.data.labels.showCookie + '</a>'}
            <div class="cookie-details-table ${hideNextToggleButton ? "" : "table-" + data.name}" style="${hideNextToggleButton ? "" : "display: none"}">
                <table cellspacing="0"
                    cellpadding="0">
                    <thead>
                        <tr>
                            <th scope="col">${this.data.labels.table.name}</th>
                            <th scope="col">${this.data.labels.table.provider}</th>
                            <th scope="col">${this.data.labels.table.purpose}</th>
                            <th scope="col">${this.data.labels.table.expiry}</th>
                            <th scope="col">${this.data.labels.table.type}</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${rows}
                    </tbody>
                </table>
            </div>
        </div>`;
    }
    showDetails() {
        if (this.showBannerBoolean === false) {
            this.showBanner();
        }
        document.getElementById("cookieblock__banner").style.display = "none";
        Object.entries(this.DOMelements.wrapper).forEach(([key, elm]) => elm.style.display = "inline-block");
        return this;
    }
    togglePopup() {
        // if (document.querySelector(this.data.documentNode)) {
        //     let bounce = document.querySelector(this.data.documentNode).getBoundingClientRect();
        //     window.scrollTo(0, bounce.top - 150);
        //     this.toggleDisplay(document.querySelector("#cookieblock.popup"));
        // } else {
        Object.entries(this.DOMelements.wrapper).forEach(([key, elm]) => this.toggleDisplay(elm));
        // }
        return this;
    }
    acceptAll() {
        let cookies = {};
        for (const input of Array.from("input[type='checkbox'].cookie-checkbox")) {
            cookies[input["name"]] = true;
            if (this.data.cookies[input["name"]] !== void 0) {
                let fn = Function(this.data.cookies[input["name"]].function);
                fn.call(this);
            }
        }
        this.defineCookie(cookies);
        this.hideElement(this.DOMelements.node);
    }
    refuseAll() {
        let cookies = {};
        for (const input of Array.from("input[type='checkbox'].cookie-available")) {
            cookies[input["name"]] = false;
        }
        this.defineCookie(cookies);
        this.hideElement(this.DOMelements.node);
    }
    toggleDetails() {
        Object.entries(this.DOMelements.content).forEach(([key, elm]) => this.toggleDisplay(elm));
        return this;
    }
    showBanner() {
        this.toggleDisplay(this.DOMelements.node);
        return this;
    }
    submitConsent() {
        let cookies = {};
        for (const input of Array.from("input[type='checkbox'].cookie-checkbox")) {
            cookies[input["name"]] = input["checked"];
            if (this.data.cookies[input["name"]] !== void 0 && input["checked"] === true) {
                let fn = Function(this.data.cookies[input["name"]].function);
                fn.call(this);
            }
        }
        this.defineCookie(cookies);
        this.hideElement(this.DOMelements.node);
    }
}
