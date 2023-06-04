<div class="Add__scrollY" method="POST" id="Form">
    <div class="Identity">
        <div class="Identity__content">
            <div class="Name__group">
                <h3>Identité</h3>
            </div>
            <div class="First__group">
                <div class="Profil">
                    <img src="data:image;base64,<?=base64_encode($Avatar)?>"/>
                    <input type="file" name="Profil"/>
                </div>
                <!-- <div class="Login__button">
                    <button name="save_avatar" id="save_avatar">
                        <i class="fa-solid fa-save"></i>
                        <span>Modifier</span>
                    </button>
                </div> -->
            </div>

            <form id="Prof" class="Secondly__group">
                <div class="Input__box">

                    <div class="Input__box">
                        <label for="Profession">Profession : </label>
                        <input type="text" id="Profession" name="Profession" value="<?php echo $data['PROFESSION']; ?>" />
                    </div>

                    <div class="Login__button">
                        <button name="save_prof" id="save_prof">
                            <i class="fa-solid fa-save"></i>
                            <span>Modifier</span>
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <form id="Contact" method="POST" class="Contact__info">
            <div class="Info__first Name__group">
                <h3>Informations de contact</h3>
            </div>

            <div class="Info__secondly">
                <div class="Input__box">
                    <label for="Ville">Ville : </label>
                    <input type="text" id="Ville" name="Ville" maxlength="15" autocomplete="none" value="<?php echo $data['VILLE']; ?>" />
                    <!-- <small class="Message_err"></small> -->
                </div>
                <div class="Input__box">
                    <label for="Qtier">Quartier : </label>
                    <input type="text" id="Qtier" name="Qtier" maxlength="15" autocomplete="none" value="<?php echo $data['QUARTIER']; ?>" />
                    <!-- <small class="Message_err"></small> -->
                </div>
                <div class="Input__box">
                    <label for="Phone">Téléphone : </label>
                    <input type="text" id="Phone" name="Phone" maxlength="13" autocomplete="none" value="<?php echo $data['TEL']; ?>" />
                </div>
                <div class="Input__box">
                    <label for="Email">Email : </label>
                    <input type="text" id="Email" name="Email" maxlength="30" autocomplete="none" value="<?php echo $data['EMAIL']; ?>" />
                    <!-- <small class="Message_err"></small> -->
                </div>
            </div>
            <div class="Login__button">
                <button name="save_contact" id="save_contact">
                    <i class="fa-solid fa-save"></i>
                    <span>Modifier</span>
                </button>
            </div>
        </form>

        <div class="Confidence">
            <div class="Confidence__first Name__group">
                <h3>Modifier votre mot de passe</h3>
            </div>

            <form id="Security" method="POST" class="Confidence__secondly">
                <div class="Input__box">
                    <label for="Last_pass">Ancien mot de passe : </label>
                    <input type="password" name="Last_pass" id="Last_pass" />
                </div>
                <div class="Input__box">
                    <label for="New_Pass">Nouveau Mot de passe : </label>
                    <input type="password" name="New_Pass" id="New_Pass" />
                </div>
                <div class="Config_pass pass">
                    <label for="">Confirmer mot de passe : </label>
                    <input type="password" name="Config_pass" id="Config_pass" />
                </div>
                <div class="Login__button">
                    <button name="save_pass" id="save_pass">
                        <i class="fa-solid fa-save"></i>
                        <span>Modifier</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>