(function(){
    let container = document.querySelector(".containerVideo")
    let video = document.querySelector(".video");
    let playPausebtn = document.querySelector(".playPausebtnVideo");
    let volumen_btn = document.querySelector(".volume_btnVideo");
    let slider = document.querySelector(".volume_rangeVideo");
    let bar = document.querySelector(".barVideo");
    let current_time = document.querySelector(".current_timeVideo");
    let full_duration = document.querySelector(".full_durationVideo");
    let progress =document.querySelector(".progressVideo");
    let controls = document.querySelector(".controlsVideo");
    let fullScreenBtn = document.querySelector(".full_screenVideo");
    
    let Menu = document.querySelector(".submenuVideo");

    function bindEventes()
    {
        playPausebtn.addEventListener("click",playpause);
        volumen_btn.addEventListener("click",toggleVolumen);
        slider.addEventListener("input", updateVolumen);
        video.addEventListener("timeupdate",updateTime);
        progress.addEventListener("click",shipVideo);
        container.addEventListener("mouseover", shipControler);
        container.addEventListener("mouseout", hideControler);
        fullScreenBtn.addEventListener("click",enterFullScreen);
        Menu.addEventListener("click",Detener);
    }
    bindEventes();

    function playpause()
    {
        if(video.paused)
        {
            playPausebtn.classList.remove("fa-play");
            playPausebtn.classList.add("fa-pause");
            video.play();
        }else
        {
            playPausebtn.classList.remove("fa-pause");
            playPausebtn.classList.add("fa-play");
            video.pause();
        }
    }
    
    function Detener()
    {
        playPausebtn.classList.remove("fa-pause");
        playPausebtn.classList.add("fa-play");
        video.pause();
    }

    function toggleVolumen()
    {
        slider.classList.toggle("active");
        volumen_btn.classList.toggle("active");
    }

    function updateVolumen()
    {
        video.volume = slider.value;
    }

    function updateTime()
    {
        let curTime = video.currentTime;
        let duration = video.duration;

        let percentage = (curTime * 100)/duration;

        bar.style.width = percentage + "%";


        let minutos = parseInt(duration / 60, 10);
        let seconds = parseInt(duration % 60);
        if(minutos < 10)
            minutos = "0" + minutos;

        if(seconds < 10)
            seconds = "0" + seconds;
            
        full_duration.innerHTML = minutos + ":" + seconds;


        let minutosCur = parseInt(curTime / 60, 10);
        let secondsCur = parseInt(curTime % 60);

        if(minutosCur < 10)
        minutosCur = "0" + minutosCur;

        if(secondsCur < 10)
        secondsCur = "0" + secondsCur;
            
        current_time.innerHTML = minutosCur + ":" + secondsCur;

    }

    function shipVideo(e) 
    {
        let coords = getRelativeCoordinates(e);
        let conWidth = container.offsetWidth;

        let porcentage = (coords.x * 100) / conWidth;
        bar.style.width = porcentage + "%";

        let time = video.duration * (porcentage / 100);
        video.currentTime = time;
    }


    function getRelativeCoordinates ( e ) {
        var pos = {}, offset = {}, ref;
  
        ref = container.offsetParent;
  
        pos.x = !! e.touches ? e.touches[ 0 ].pageX : e.pageX;
        pos.y = !! e.touches ? e.touches[ 0 ].pageY : e.pageY;
  
        offset.left = container.offsetLeft;
        offset.top = container.offsetTop;
  
        while ( ref ) {
  
            offset.left += ref.offsetLeft;
            offset.top += ref.offsetTop;
  
            ref = ref.offsetParent;
        }
  
        return {
            x : pos.x - offset.left,
            y : pos.y - offset.top,
          };
  
    }

    function shipControler()
    {
        controls.style.display = "inherit";
    }

    function hideControler()
    {
        controls.style.display = "none";
    }

    function enterFullScreen()
    {
        if(video.requestFullscreen)
        {
            video.requestFullscreen();
        }else if(video.mozRequesFullScreen)
        {
            video.mozRequesFullScreen();
        }else if(video.webkitRequesFullScreen)
        {
            video.webkitRequesFullScreen();
        }else if(video.msRequesFullScreen)
        {
            video.msRequesFullScreen();
        }
    }

})();