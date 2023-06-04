<div class="Topbar">
    <div class="Topbar__left">
        <div class="Taskbar__icon">
            <i class="fa-solid fa-bars Menu"></i>
        </div>
    </div>
    <div class="Topbar__right">
        <div class="Bar__color">
            <div class="color color1"></div>
            <div class="color color2"></div>
            <div class="color color3"></div>
        </div>
        <div class="Taskbar__icon">
            <i class="fa-solid fa-sun" id="Icon_click"></i>
            <!-- <a href=""><i class="fa-solid fa-envelope"></i></a> -->
        </div>
        <div class="Taskbar__user">
            <span class="Username"><?=$NomUser?></span>
            <div class="Profil">
                <img src="data:image;base64,<?=base64_encode($Avatar)?>">
            </div>
        </div>
    </div>
</div>