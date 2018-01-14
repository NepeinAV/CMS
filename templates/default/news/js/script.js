'use strict';

var h, down, up, a, els, tg, i, ap,
    arr = [];

function Events() {
    this.addSortBut = function () {
        h = document.getElementsByClassName("sort");
        for (var i = 0; i < h.length; i++) {
            h[i].appendChild(createEl('div', 'angle angleUp', ['title', 'Сортировать по-возрастанию'], false));
            h[i].appendChild(createEl('div', 'angle angleDown', ['title', 'Сортировать по-убыванию'], false));
        }
    }

    this.redirectA = function () {
        if (document.getElementById("searchformmob").value.toUpperCase() == "А") document.location.href = "letter.html";
    }

    this.sortNodes = function (e) {
        tg = e.target;
        if (/angle/.test(tg.className)) {
            els = tg.parentNode.nextElementSibling;
            if (els.tagName !== 'P') return 0;

            for (i = 0; i < els.children.length; i++)
                arr.push(els.children[i]);

            if (/angleDown/.test(tg.className))
                arr.sort(function (a, b) {
                    if (a.innerHTML > b.innerHTML) return 1;
                    if (a.innerHTML < b.innerHTML) return -1;
                });
            else if (/angleUp/.test(tg.className))
                arr.sort(function (a, b) {
                    if (a.innerHTML > b.innerHTML) return -1;
                    if (a.innerHTML < b.innerHTML) return 1;
                });

            i = 0;
            while (arr.length > 0) {
                ap = arr.pop();
                els.replaceChild(createEl('a', false, ['href', ap.getAttribute('href')], ap.innerHTML), els.children[i++]);
            }
        }
    }

    function createEl(elname, classes, attr, innerhtml) {
        let el, at, av;
        el = document.createElement(elname);
        if (classes) el.className = classes;
        if (innerhtml) el.innerHTML = innerhtml;
        if (attr) {
            while (attr.length > 0) {
                av = attr.pop();
                at = attr.pop();
                el.setAttribute(at, av);
            }
        }
        return el;
    }
}

var Events = new Events();

document.addEventListener('DOMContentLoaded', function () {
    Events.addSortBut();
    document.getElementById("searchbutmob").addEventListener("click", Events.redirectA);
    document.getElementById("right").addEventListener("click", Events.sortNodes);
});
