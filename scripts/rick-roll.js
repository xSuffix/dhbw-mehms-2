document.addEventListener('DOMContentLoaded', function () {

  var gallery = document.getElementById("mehm-gallery");
  gallery.onclick = function () {
    if (localStorage.getItem("rick") != "rolled") {
      let imageCount = gallery.getElementsByTagName("img").length;
      let imageSize = [498, 337]
      new Audio('https://www.soundboard.com/mediafiles/mz/Mzg1ODMxNTIzMzg1ODM3_JzthsfvUY24.MP3').play();
      gallery.innerHTML = "";
      for (var i = 0; i < imageCount; i++) {
        gallery.innerHTML += '<a class="mehm-card" style="width:' + imageSize[0] * 300 / imageSize[1] +
          'px; flex-grow: ' + imageSize[0] * 300 / imageSize[1] + '"><div style="padding-top: ' +
          imageSize[1] / imageSize[0] * 100 + '%"></div><img src="./assets/mehms/rick.gif" /></a>';
      }
      localStorage.setItem("rick", "rolled");
    }
  }
});
