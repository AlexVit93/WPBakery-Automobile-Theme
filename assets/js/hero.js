document.addEventListener("DOMContentLoaded", function () {
    const videoWrapper = document.getElementById("GrnnF7OOaHA");
    const playButton = videoWrapper.querySelector(".hero__play");

    playButton.addEventListener("click", function () {
        videoWrapper.innerHTML = `
            <div class="hero__video-frame">
                <iframe src="https://www.youtube.com/embed/GrnnF7OOaHA?autoplay=1&mute=0" 
                allow="autoplay; encrypted-media" 
                allowfullscreen>
            </iframe>
        </div>
    `;
  });
});