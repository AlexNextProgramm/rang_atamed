var s = 0;
const stars = document.querySelectorAll("star");
const button = document.querySelector("button");

stars.forEach((star) => {
    star.onclick = clickstar;
    // star.onmouseover = clickstar
});

function clickstar(evt) {
    let n = evt.target.parentElement.getAttribute("data");
    s = n;
    stars.forEach((el, i) => {
        if (i <= n) {
            el.children[0].src = "/view/static/images/" + imageStarActive + "?" + hash;
        } else {
            el.children[0].src = "/view/static/images/" + imageStarDeactive+"?"+hash;
        }
    });
    button.className = "";
}

button.onclick = function () {
    POST(window.location.href, {
        star: Number(s) + 1,
    }).then((response) => {
        response.text().then((data) => {
            window.location.reload();
        });
    });

    // window.location.href = '/otzyv/test?star=' + s;
};
