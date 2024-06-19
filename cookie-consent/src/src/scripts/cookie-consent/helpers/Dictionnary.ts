export default class Dictionnary {
    protected locale = "en";
    protected authorizedLocales = ["en","fr"];
    constructor(locale="en") {
        if (this.authorizedLocales.includes(locale)) {
            this.locale = locale;
        } 
    }

    getRegistry() {
        switch (this.locale) {
            case "fr":
                return {
                    content: {
                        link: "https://cookieconsent.extension/legal/cookie-policy",
                        banner: {
                            title: "En utilisant ce site, vous acceptez l'utilisation des cookies."
                        },
                        popup: {
                            title: "Ce site utilise des cookies.",
                            description: "Ce site utilise des cookies. Nous utilisons des cookies pour que notre site web fonctionne au mieux, améliorant ainsi votre expérience en ligne. Afin d’en savoir plus sur l’utilisation des cookies, les plug-ins pour les réseaux sociaux ainsi que le web tracking, n’hésitez pas à consulter notre page d’informations sur les Cookies ainsi que notre Déclaration de Protection des Données."
                        }
                    },
                    labels: {
                        showCookie: "Afficher les cookies",
                        table: {
                            name : "Nom",
                            provider : "Fournisseur",
                            purpose : "Objectif",
                            expiry : "Expire",
                            type : "Type",
                        },
                        switch: {
                            on: "Oui",
                            off: "Non"
                        },
                        actions: {
                            more: "En savoir plus ?",
                            allow: {
                                all: "Accepter tous les cookies",
                                selected: "Accepter tous les cookies sélectionnés"
                            },
                            refuse: {
                                all: "Refuser tous les cookies"
                            },
                            read: {
                                policy: "Lire notre politique de cookie"
                            },
                            cancel: "Annuler",
                            view: {
                                advanced: "Choix avancé",
                                simple: "Choix simple"
                            }
                        }
                    }
                };
            case "en":
            default:
                return {
                    content: {
                        link: "https://cookieconsent.extension/legal/cookie-policy",
                        banner: {
                            title: "By using this site, you agree with our use of cookies."
                        },
                        popup: {
                            title: "This website uses cookies",
                            description: "We use cookies to personalise content and ads, to provide social\
                            media features and to analyse our traffic. We also share information about your use of our site with\
                            our social media, advertising and analytics partners who may combine it with other information that\
                            you’ve provided to them or that they’ve collected from your use of their services. You consent to\
                            our cookies if you continue to use our website."
                        }
                    },
                    labels: {
                        showCookie: "Show cookies",
                        table: {
                            name : "Name",
                            provider : "Provider",
                            purpose : "Purpose",
                            expiry : "Expiry",
                            type : "Type",
                        },
                        switch: {
                            on: "On",
                            off: "Off"
                        },
                        actions: {
                            more: "Want to know more?",
                            allow: {
                                all: "Allow all cookies",
                                selected: "Allow selected cookies"
                            },
                            refuse: {
                                all: "Refuse all cookies"
                            },
                            read: {
                                policy: "Read our Cookie Policy"
                            },
                            cancel: "Cancel",
                            view: {
                                advanced: "Advanced cookie choices",
                                simple: "Simple cookie choices"
                            }
                        }
                    },
                };
        }
    }
}