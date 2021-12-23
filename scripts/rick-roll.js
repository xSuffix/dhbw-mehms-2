document.addEventListener('DOMContentLoaded', function () {

    var gallery = document.getElementById("mehm-gallery");
    gallery.onclick = function (e) {
        if (localStorage.getItem("rick") != "rolled") {
            e.preventDefault();

            const imageSize = {
                "width": 498,
                "height": 337
            }
            const width = imageSize.width * 300 / imageSize.height
            const height = imageSize.height / imageSize.width
            const mehmCards = gallery.getElementsByClassName("mehm-card")

            for (let card of mehmCards) {
                const div = card.getElementsByTagName("div")[0]
                const img = card.getElementsByTagName("img")[0]
                div.style.paddingTop = height * 100 + "%"
                img.src = "./assets/mehms/rick.gif"
                card.style.width = width + "px"
                card.style.flexGrow = width
            }

            new Audio('https://www.soundboard.com/mediafiles/mz/Mzg1ODMxNTIzMzg1ODM3_JzthsfvUY24.MP3').play();
            localStorage.setItem("rick", "rolled");
        }
    }
});