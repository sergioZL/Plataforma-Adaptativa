    <div class="container_Audio" id="Audio" style="display:none;">
        <div class="containerAudio">    
            <audio class="audio">
                <source src="<?php echo  base_url(); ?>Material/audio/Alan Walker - Faded (Instrumental Version).mp3"> 
            </audio>
            
            <div class="loading">
                <div class="obj"></div>
                <div class="obj"></div>
                <div class="obj"></div>
                <div class="obj"></div>
                <div class="obj"></div>
                <div class="obj"></div>
                <div class="obj"></div>
                <div class="obj"></div>
            </div>
            
            <div class="submenu">
                <div class="menu pointer col-md-1 pt-5 icon_white submenuAudio">
                    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
                </div>         
            </div>

            <div class="controlsAudio">
                <div class="progressAudio pointer">
                    <div class="barAudio">

                    </div>
                </div>
                
                <i class="fa fa-play playPausebtnAudio med_icon icon_white pointer"></i>
                <div class="timeAudio">
                    <span class="current_timeAudio">00:00</span> /
                    <span class="full_durationAudio">00:00</span>
                </div>


                <div class="pull-right">
                    <input type="range" class="volume_rangeAudio" min="0" max="1" step="00.1" value="1">

                    <i class="fa fa-volume-up volume_btnAudio icon_white pointer"></i> &nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
    
    <script src="<?php echo base_url();?>app-assets/js/audio.js"></script>