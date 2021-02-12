var symbolRU = "йцукенгшщзхъфывапролджэячсмитьбю";
var symbolEN = "qwertyuiopasdfghjklzxcvbnm";
var specialSymbol = "'.,'!?-_}{[]()";
var numbers = "1234567890";

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function translateRule(rule, minSize, maxSize) {
    if (rule == 1) return "Введите текст!";
    else if (rule == 2) return "Минимальное количество символов - " + minSize;
    else if (rule == 3) return "Максимальное количество символов - " + maxSize;
    else if (rule == 4) return "Недопустимые символы!";
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function checkString(text, minSize, maxSize, lang = "en", spec = false, num = false, multiText = false) {
    var newText = text.toLowerCase();
    var ruleText = "";

    if (lang == "en" || lang == "mix") ruleText = ruleText + symbolEN;
    if (lang == "ru" || lang == "mix") ruleText = ruleText + symbolRU;
    if (spec == true) ruleText = ruleText + specialSymbol;
    if (num == true) ruleText = ruleText + numbers;
    if (multiText == true) ruleText = ruleText + " ";

    if (newText == "") return translateRule(1, minSize, maxSize);
    if (newText.length < minSize) return translateRule(2, minSize, maxSize);
    if (newText.length > maxSize) return translateRule(3, minSize, maxSize);

    for (var i = 0; i < newText.length; i++) {
        if (ruleText.lastIndexOf(newText[i]) == -1) return translateRule(4, minSize, maxSize);
    }

    return "valid";

}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function validatePhone(phone) {
    const re = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
    return re.test(String(phone).toLowerCase());
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function addModule(fileName, parent) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', fileName, true);
    xhr.onreadystatechange = function() {
        if (this.readyState !== 4) return;
        if (this.status !== 200) return;
        var textTag = document.getElementById(parent).innerHTML;
        document.getElementById(parent).innerHTML = textTag + this.responseText;
    };
    xhr.send();
}

function openModule(fileName, parent) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', fileName, true);
    xhr.onreadystatechange = function() {
        if (this.readyState !== 4) return;
        if (this.status !== 200) return;
        document.getElementById(parent).innerHTML = this.responseText;
    };
    xhr.send();
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function onResizeWindow() {
    var header = document.getElementById("header") || document.getElementsByTagName("header")[0];
    var content = document.getElementById("content") || document.getElementsByTagName("main")[0];
    var footer = document.getElementById("footer") || document.getElementsByTagName("footer")[0];

    var screen_height = document.body.offsetHeight;
    var header_height, footer_height, content_height, new_height_content;

    if (footer && header && content) {
        header_height = header.offsetHeight;
        footer_height = footer.offsetHeight;
        content_height = content.offsetHeight;
        new_height_content = screen_height - (header_height + footer_height);
    } else if (header && content) {
        header_height = header.offsetHeight;
        content_height = content.offsetHeight;
        new_height_content = screen_height - header_height;
    }

    if (content) {
        if (content_height <= new_height_content && content) {
            content.style.height = new_height_content + "px";
        } else {
            content.style.height = "auto";
        }
    }
}

window.addEventListener('scroll', function() {
    var header = document.getElementById("header");
    var content = document.getElementById("content");
    var header_height = header.offsetHeight;

    var scrollTop = self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);

    if (document.getElementById("btn-goup")) {
        if (scrollTop >= (header_height) * 2)
            document.getElementById("btn-goup").classList.add("active");
        else
            document.getElementById("btn-goup").classList.remove("active");
    }
});

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function checkCookies() {
    console.log("Authorized: " + Cookies.get("Authorized"));
    console.log("ID: " + Cookies.get("ID"));
    console.log("Login: " + Cookies.get("Login"));
    console.log("Password: " + Cookies.get("Password"));
    console.log("Email: " + Cookies.get("Email"));
    console.log("Phone: " + Cookies.get("Phone"));
    console.log("AccountType: " + Cookies.get("AccountType"));
}

function setActiveLink() {
    var links = document.querySelectorAll("a.nav-link[href]");
    [].forEach.call(links, function(element) {
        var liveURL = document.location.href;
        if (liveURL == element.href) {
            element.classList.add("active");
        }
    })
}

function setGoUpButton() {
    if (document.getElementById("btn-goup")) {
        document.getElementById("btn-goup").addEventListener("click", function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        })
    }
}

function createHTML(htmlStr) {
    var frag = document.createDocumentFragment(),
        temp = document.createElement('div');
    temp.innerHTML = htmlStr;
    while (temp.firstChild) {
        frag.appendChild(temp.firstChild);
    }
    return frag;
}

//!-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function createMessage(title, text, time = 5, type = false) {
    if (!document.getElementById("popup-container")) return false;
    if (!document.querySelector('.popup-message.hide')) return false;

    var popup_container = document.getElementById("popup-container");
    var popup_body = document.getElementById("popup-body");

    var template_message = document.querySelector('.popup-message.hide');
    var popup_message = template_message.cloneNode(true);

    popup_body.append(popup_message);
    var popup_title = popup_message.querySelector(".popup-message__title");
    var popup_content = popup_message.querySelector(".popup-message__content");
    var popup_close = popup_message.querySelector(".popup-message__close-button");

    popup_title.innerHTML = title;
    popup_content.innerHTML = text;

    popup_message.classList.remove("hide");
    setTimeout(function() {
        popup_message.classList.add("show");
    }, 100);

    if (type == "danger") popup_message.classList.add("danger");
    if (type == "success") popup_message.classList.add("success");

    popup_close.onclick = function(e) {
        var popup_message = e.target.closest('.popup-message');
        popup_message.classList.remove("show");
        setTimeout(function() {
            popup_message.remove();
        }, 500);
    }

    if (time != "inf") {
        setTimeout(function() {
            popup_message.classList.remove("show");
            setTimeout(function() {
                popup_message.remove();
            }, 500);
        }, time * 1000);
    }

}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function loadData() {

    document.body.classList.add('loaded');
    onResizeWindow();

    setActiveLink();
    setGoUpButton();
    checkCookies();

    // if (document.getElementById("basket-bar")) {
    //     sendAJAXRequest("php/handler.php", toArray("FUNCTION", "createBasketList", "IdUser", Cookies.get("ID"))).then(function(result) {
    //         result["ARRAY"].forEach((elem) => {
    //             var basket_card = new BasketCard(elem);
    //         });
    //     }, function(error) {
    //         console.log(error);
    //     });
    // }

}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function checkValidInput(object) {
    var atr = elem.getAttribute("data-reg-type");
    var textInput, activeRegCheck = false;
    if (atr == "name") {
        if (checkString(object.value, 6, 255, "mix", false, false, true) != "valid") {
            object.classList.add("is-invalid");
            object.classList.replace("is-valid", "is-invalid");
            document.getElementById("feedback_login").innerHTML = checkString(object.value, 6, 255, "mix", false, false, true);
            activeRegCheck = false;
        }
    }

}

if (document.getElementById("reg-form")) {
    var regForm = document.getElementById("reg-form");

    var validInput = document.querySelectorAll("[validation]");

    validInput.forEach(function(elem) {
        elem.onblur = function() {
            var atr = elem.getAttribute("data-reg-type");
            if (atr == "name") {

            }
            if (checkString(form._login.value, 6, 255, "mix", false, false, true) != "valid") {
                form._login.classList.add("is-invalid");
                form._login.classList.replace("is-valid", "is-invalid");
                document.getElementById("feedback_login").innerHTML = checkString(form._login.value, 6, 255, "mix", false, false, true);
                activeRegCheck = false;
            } else {
                form._login.classList.replace("is-invalid", "is-valid");
                form._login.classList.add("is-valid");
            }
            console.log("Вышел из элемента:", elem);
        }
    });

}

function checkRegData(atr) {
    var activeRegCheck = true;
    var form = document.getElementById("register-form");

    if (atr == 0 || atr == 1) {
        if (checkString(form._login.value, 6, 255, "mix", false, false, true) != "valid") {
            form._login.classList.add("is-invalid");
            form._login.classList.replace("is-valid", "is-invalid");
            document.getElementById("feedback_login").innerHTML = checkString(form._login.value, 6, 255, "mix", false, false, true);
            activeRegCheck = false;
        } else {
            form._login.classList.replace("is-invalid", "is-valid");
            form._login.classList.add("is-valid");
        }
    }

    if (atr == 0 || atr == 2) {
        if (!validateEmail(form._email.value)) {
            form._email.classList.add("is-invalid");
            form._email.classList.replace("is-valid", "is-invalid");
            document.getElementById("feedback_email").innerHTML = "Неправильный формат почты";
            activeRegCheck = false;
        } else {
            form._email.classList.replace("is-invalid", "is-valid");
            form._email.classList.add("is-valid");
        }
    }

    if (atr == 0 || atr == 3) {
        if (!validatePhone(form._phone.value)) {
            form._phone.classList.add("is-invalid");
            form._phone.classList.replace("is-valid", "is-invalid");
            document.getElementById("feedback_phone").innerHTML = "Неправильный формат телефона";
            activeRegCheck = false;
        } else {
            form._phone.classList.replace("is-invalid", "is-valid");
            form._phone.classList.add("is-valid");
        }
    }

    if (atr == 0 || atr == 4) {
        if (checkString(form._password_1.value, 6, 255, "en", true, true, false) != "valid") {
            form._password_1.classList.add("is-invalid");
            form._password_1.classList.replace("is-valid", "is-invalid");
            document.getElementById("feedback_password_1").innerHTML = checkString(form._password_1.value, 6, 255, "en", true, true, false);
            activeRegCheck = false;
        } else {
            form._password_1.classList.replace("is-invalid", "is-valid");
            form._password_1.classList.add("is-valid");
        }
    }

    if (atr == 0 || atr == 5) {
        if (form._password_1.value != form._password_2.value) {
            form._password_2.classList.add("is-invalid");
            form._password_2.classList.replace("is-valid", "is-invalid");
            document.getElementById("feedback_password_2").innerHTML = "Пароли не совпадают!";
            activeRegCheck = false;
        } else {
            form._password_2.classList.replace("is-invalid", "is-valid");
            form._password_2.classList.add("is-valid");
        }
    }

    if (activeRegCheck && atr == 0) {
        sendAJAXRequest("php/validation_form/registration.php", false, "register-form").then(function(result) {
            if (result["reply"]) {
                createMessage("Регистрация", "Аккаунт успешно зарегистрирован", "inf");
            } else {
                createMessage("Регистрация", "Аккаунт не зарегистрирован", "inf", "danger");
            }
        }, function(error) {
            console.log(error);
        });
    }
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

function getRandomFloat(min, max) {
    return Math.random() * (max - min) + min;
}

function uniteJSON(target) {
    var sources = [].slice.call(arguments, 1);
    sources.forEach(function(source) {
        for (var prop in source) {
            target[prop] = source[prop];
        }
    });
    return target;
}

function toArray(...elements) {
    var mainArray = [];
    var lastElem;
    var elemV = true;
    elements.forEach(function(elem) {
        if (elemV) {
            mainArray[elem] = '';
            lastElem = elem;
            elemV = false;
        } else {
            mainArray[lastElem] = elem;
            elemV = true;
        }
    });
    return mainArray;
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function getMessageFromURL(url) {
    var arrayVar = [];
    var valueAndKey = [];
    var resultArray = [];
    if (url[0] == "?") url = url.substr(1);
    arrayVar = url.split('&');
    if (arrayVar[0] == "") return false;
    for (i = 0; i < arrayVar.length; i++) {
        valueAndKey = arrayVar[i].split('=');
        resultArray[valueAndKey[0]] = valueAndKey[1];
    }
    return resultArray;
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function getAJAXRequest(message = false) {
    if (message == false || message == "false") return 0;

    console.log(message);
}

function sendAJAXRequest(url = false, request = false, form = false) {
    return new Promise(function(succeed, fail) {
        if (url == false) return false;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        var bodyArray = {};
        var result = {};

        if (form != false) {
            var cssSelect = "#" + form + " *[name]";
            var elements = document.querySelectorAll(cssSelect);

            for (let elem of elements) {
                if (elem.tagName == "INPUT") {
                    if (elem.type == "checkbox") bodyArray[elem.name] = elem.checked;
                    else bodyArray[elem.name] = elem.value;
                } else if (elem.tagName == "SELECT") {
                    bodyArray[elem.name] = elem.options[elem.selectedIndex].value;
                } else bodyArray[elem.name] = elem.value;
            }
        }

        if (request !== null && typeof request === 'object') result = uniteJSON({}, bodyArray, request);
        else result = bodyArray;

        xhr.addEventListener("load", function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    succeed(JSON.parse(xhr.responseText));
                    getAJAXRequest(JSON.parse(xhr.responseText));
                } else {
                    fail(new Error("Request failed: " + request.statusText));
                }
            }
        });

        xhr.addEventListener("error", function() {
            fail(new Error("Network error"));
        });

        xhr.send(JSON.stringify(result));
    });
}