(function(){
    let container = document.querySelector(".containerAudio")
    let audio = document.querySelector(".audio");
    let playPausebtn = document.querySelector(".playPausebtnAudio");
    let volumen_btn = document.querySelector(".volume_btnAudio");
    let slider = document.querySelector(".volume_rangeAudio");
    let bar = document.querySelector(".barAudio");
    let current_time = document.querySelector(".current_timeAudio");
    let full_duration = document.querySelector(".full_durationAudio");
    let progress =document.querySelector(".progressAudio");
    let controls = document.querySelector(".controlsAudio");
    
    let Menu = document.querySelector(".submenuAudio");

    function bindEventes()
    {
        playPausebtn.addEventListener("click",playpause);
        volumen_btn.addEventListener("click",toggleVolumen);
        slider.addEventListener("input", updateVolumen);
        audio.addEventListener("timeupdate",updateTime);
        progress.addEventListener("click",shipAudio);
        container.addEventListener("mouseover", shipControler);
        container.addEventListener("mouseout", hideControler);
        Menu.addEventListener("click",Detener);
    }
    bindEventes();

    function playpause()
    {
        if(audio.paused)
        {
            playPausebtn.classList.remove("fa-play");
            playPausebtn.classList.add("fa-pause");
            audio.play();
        }else
        {
            playPausebtn.classList.remove("fa-pause");
            playPausebtn.classList.add("fa-play");
            audio.pause();
        }
    }
    
    function Detener()
    {
        playPausebtn.classList.remove("fa-pause");
        playPausebtn.classList.add("fa-play");
        audio.pause();
    }

    function toggleVolumen()
    {
        slider.classList.toggle("active");
        volumen_btn.classList.toggle("active");
    }

    function updateVolumen()
    {
        audio.volume = slider.value;
    }

    function updateTime()
    {
        let curTime = audio.currentTime;
        let duration = audio.duration;

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

    function shipAudio(e) 
    {
        let coords = getRelativeCoordinates(e);
        let conWidth = container.offsetWidth;

        let porcentage = (coords.x * 100) / conWidth;
        bar.style.width = porcentage + "%";

        let time = audio.duration * (porcentage / 100);
        audio.currentTime = time;
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

})();