document.addEventListener('DOMContentLoaded', function () {

    let theater = document.getElementById("theater");

    function closePopup() {
        theater.classList.remove("open");
        let selected = document.getElementById("selected-container");
        selected.parentElement.removeChild(selected);
    }

    theater.addEventListener('click', closePopup);

    for (let mehm of document.getElementsByClassName("mehm-card")) {
        const image = mehm.getElementsByTagName("img")[0];

        image.addEventListener('click', function (e) {
            if (!document.getElementById("selected-container") && e.target.id != "close-btn") {
                theater.classList.add("open");
                const newImage = image.cloneNode(true);
                newImage.classList.add("selected");
                const div = document.createElement("div");
                div.id = "selected-container";
                div.classList.add("selected-container");
                div.appendChild(newImage);
                div.setAttribute("name", newImage.getAttribute("name"));
                mehm.appendChild(div);
                div.innerHTML += '<div id="close-btn"><svg height="24px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16"><path fill="#fff" d="M4 4h8v8H4z"/><path fill="currentColor" fill-rule="evenodd" d="M8 16a8 8 0 008-8 8 8 0 00-8-8 8 8 0 00-5.657 2.343 8 8 0 000 11.314A8 8 0 008 16zM6.707 5.293a1 1 0 00-1.402.012 1 1 0 00-.012 1.402L6.586 8 5.293 9.293a1 1 0 00-.305.711 1 1 0 00.293.716 1 1 0 00.716.293 1 1 0 00.711-.305L8 9.414l1.293 1.293a1 1 0 001.402-.012 1 1 0 00.012-1.402L9.414 8l1.293-1.293a1 1 0 00-.012-1.402 1 1 0 00-1.402-.012L8 6.586 6.707 5.293z"/></svg></div>'
                const closebtn = document.getElementById("close-btn")
                closebtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    closePopup();
                });
            }
        });
    }

});