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

function validateString(text, minSize, maxSize, lang = "en", spec = false, num = false, multiText = false) {
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

function validatePhone(phone) {
    const re = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
    return re.test(String(phone).toLowerCase());
}

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

    var popup_message_str = `
        <div class="popup-message show">
            <div class="popup-message__header">
                <strong class="popup-message__title">${title}</strong>
                <button class="popup-message__close-button" data-popup="button">X</button>
            </div>
            <div class="popup-message__content">${text}</div>
        </div>
    `;

    var popup_message = createHTML(popup_message_str);
    var popup_message_body = popup_message.querySelector(".popup-message");
    var popup_close = popup_message.querySelector(".popup-message__close-button");
    var popup_body = document.getElementById("popup-body");
    popup_body.append(popup_message);

    if (type == "danger") popup_message_body.classList.add("danger");
    if (type == "success") popup_message_body.classList.add("success");

    popup_close.onclick = function(e) {
        popup_message_body.classList.remove("show");
        setTimeout(function() {
            popup_message_body.remove();
        }, 500);
    }

    if (time != "inf") {
        setTimeout(function() {
            popup_message_body.classList.remove("show");
            setTimeout(function() {
                popup_message_body.remove();
            }, 500);
        }, time * 1000);
    }

}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function addNewUser() {
    var form = document.getElementById("add-user-form");

    sendAJAXRequest("../php/handler.php", toArray("FUNCTION", "addNewUser", "ID", Cookies.get("ID")), "add-user-form").then(function(result) {
        if (result.reply) {
            createMessage("Учетные записи", "Аккаунт успешно добавлен", 10);
        } else {
            createMessage("Учетные записи", "Аккаутн не был добавлен", 10, "danger");
        }
    });

    console.log("addNewUser");
}

function loadData() {
    document.body.classList.add('loaded');
    onResizeWindow();

    setActiveLink();
    setGoUpButton();
    checkCookies();
}

if (document.getElementById("timurButton")) {
    var button = document.getElementById("timurButton");
    console.log(button);
    button.onclick = function() {
        Cookies.set("Authorized", "true");
        Cookies.set("ID", "1");
        Cookies.set("Login", "Timur");
        Cookies.set("Password", "1211");
        Cookies.set("Email", "timur@soba4ka.ru");
        Cookies.set("Phone", "88005553535");
        Cookies.set("AccountType", "admin");
        document.location.reload();
    }
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function checkValidInput(object, form) {
    var atr = object.getAttribute("data-reg-type");
    var textInput, validInput = true;
    if (atr == "name" && validateString(object.value, 6, 255, "mix", false, true, true) != "valid") {
        validInput = false;
        textInput = validateString(object.value, 6, 255, "mix", false, false, true);
    } else if (atr == "login" && validateString(object.value, 6, 255, "en", false, true, false) != "valid") {
        validInput = false;
        textInput = validateString(object.value, 6, 255, "en", false, true, false);
    } else if (atr == "email" && !validateEmail(object.value)) {
        validInput = false;
        textInput = "Неправильный формат почты";
    } else if (atr == "phone" && !validatePhone(object.value)) {
        validInput = false;
        textInput = "Неправильный формат телефона";
    } else if (atr == "password" && validateString(object.value, 6, 255, "en", true, true, false) != "valid") {
        validInput = false;
        textInput = validateString(object.value, 6, 255, "en", true, true, false);
    } else if (atr == "password_confirm") {
        var password = document.querySelector('[data-reg-type="password"]');
        if (password.value != object.value) {
            validInput = false;
            textInput = "Пароли не совпадают";
        }
    }
    return { textInput: textInput, validInput: validInput };
}

if (document.getElementById("reg-form")) {
    var regForm = document.getElementById("reg-form");
    var validInput = document.querySelectorAll("[validation]");

    validInput.forEach(function(elem) {
        var atr = elem.getAttribute("data-reg-type");
        if (atr != "submit") {
            elem.onblur = function() {
                var result = checkValidInput(elem, regForm);
                var feedback = elem.parentNode.querySelector(".invalid-feedback");
                if (!result.validInput) {
                    elem.classList.add("is-invalid");
                    elem.classList.remove("is-valid");
                    if (feedback) {
                        feedback.innerHTML = result.textInput;
                    }
                } else {
                    elem.classList.add("is-valid");
                    elem.classList.remove("is-invalid");
                }
            }
        } else {
            elem.onclick = function() {
                sendToServerRegData(regForm);
            }
        }
    });
}

function sendToServerRegData(regForm) {
    var activeRegCheck = true;
    var validInput = document.querySelectorAll("[validation]");

    validInput.forEach(function(elem) {
        var atr = elem.getAttribute("data-reg-type");
        if (atr != "submit") {
            var result = checkValidInput(elem, regForm);
            var feedback = elem.parentNode.querySelector(".invalid-feedback");
            if (!result.validInput) {
                activeRegCheck = false;
                elem.classList.add("is-invalid");
                elem.classList.remove("is-valid");
                if (feedback) {
                    feedback.innerHTML = result.textInput;
                }
            } else {
                elem.classList.add("is-valid");
                elem.classList.remove("is-invalid");
            }
        }
    });

    if (activeRegCheck) {
        sendAJAXRequest("../php/validation_form/reg.php", false, "reg-form").then(function(result) {
            if (result.reply) {
                createMessage("Регистрация", "Аккаунт успешно зарегистрирован", 10);
                regForm.reset();
            } else {
                createMessage("Регистрация", "Аккаунт не зарегистрирован", 10, "danger");
            }
        });
    } else {
        createMessage("Регистрация", "Неверный формат данных", 5, "danger");
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
                    console.log(xhr.responseText);
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