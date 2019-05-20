    <div class="container_Video" id="Video">    
        <div id="main" class="containerVideo">
            
            <video id="video" class="video">
                <source src="<?php echo  base_url(); ?>Material/video/SpaceX Falcon Heavy.mp4"> 
            </video>
        
            <div class="submenu">
                <div class="menu pointer col-md-1 pt-5  icon_white  submenuVideo">
                    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
                </div>         
            </div>
            <div class="pull-right pt-5"><a href="Temario.php" style="text-decoration: none; color:rgba(255, 255, 255, 0.63);">ir al temario</a></div>
            <div class="controlsVideo">
                <div class="progressVideo pointer">
                    <div class="barVideo">

                    </div>
                </div>
                            
                <i class="fa fa-play playPausebtnVideo med_icon icon_white pointer"></i>
                <div class="timeVideo">
                    <span class="current_timeVideo">00:00</span> /
                    <span class="full_durationVideo">00:00</span>
                </div>


                <div class="pull-rightVideo">
                    <input type="range" class="volume_rangeVideo" min="0" max="1" step="00.1" value="1">

                    <i class="fa fa-volume-up volume_btnVideo icon_white pointer"></i> &nbsp;&nbsp;&nbsp;
                    <i id="expand_btnVideo" class="fa fa-step-forward expand_btnVideo icon_white pointer"></i>&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-arrows-alt full_screenVideo icon_white pointer"></i>&nbsp;&nbsp;&nbsp;
                </div>

            </div>
        </div>
    </div>

    <script src="<?php echo base_url();?>app-assets/js/video.js"></script>