<form id="Form" class="Add__scrollY" method="POST" action="" enctype="multipart/form-data">
    <div class="Identity">

        <div class="Identity__header">
            <div class="Important">
                <span></span>
                <h4> NB : Les champs obligatoires apparaissent en <span class="Red">rouge</span>.
                </h4><br>
                <spa class="msg"><?=$msg?></span>
            </div>
        </div>

        <div class="Identity__content">
            <div class="Name__group">
                <h3>Identité</h3>
            </div>
            <div class="First__group">
                <div class="Profil">
                    <img src="../../img/profil/placeholder.png" alt="avatar" id="Avatar">
                </div>
                <div class="Caracteristic">
                    <div class="Input__box">
                        <input type="file" id="Profil" name="Profil" />
                    </div>
                    <div class="Input__box">
                        <!-- <small><?php echo ($msg); ?></small> -->
                    </div>
                </div>
            </div>

            <div class="Secondly__group">
                <div class="Input__box">
                    <label for="Nom">Nom : </label>
                    <input type="text" id="Nom" name="Nom" maxlength="30" autocomplete="off" />
                    <small class="Message_err"></small>
                </div>

                <div class="Input__box">
                    <label for="Prenom">Prenom : </label>
                    <input type="text" id="Prenom" name="Prenom" maxlength="20" autocomplete="off" />
                    <small class="Message_err"></small>
                </div>

                <div class="Input__box">
                    <label for="Genre">Genre : </label>
                    <select name="Genre" id="Genre">
                        <option value="">non spécifié</option>
                        <option value="F">Femme</option>
                        <option value="H">Homme</option>
                    </select>
                    <small class="Message_err"></small>

                </div>

                <div class="Input__box">
                    <label for="Date-Nais">Date de naissance : </label>
                    <input type="date" id="Date-Nais" name="Date-Nais" />
                    <small class="Message_err"></small>
                </div>

                <div class="Input__box">
                    <label for="Lieu-Nais">Lieu naissance : </label>
                    <input type="text" id="Lieu-Nais" name="Lieu-Nais" maxlength="20" autocomplete="off" />
                    <small class="Message_err"></small>
                </div>

                <div class="Input__box">
                    <label for="Profession">Profession : </label>
                    <input type="text" id="Profession" name="Profession" maxlength="20" autocomplete="off" />
                    <small class="Message_err"></small>
                </div>

                <div class="Input__box" style="display:none">
                    <label for="Id-clt">Id client : </label>
                    <input type="text" id="Id-clt" name="Id-clt" maxlength="9" desable autocomplete="off" />
                    <small class="Message_err"></small>
                </div>
            </div>
        </div>
    </div>

    <div class="Contact__info">
        <div class="Info__first Name__group">
            <h3>Informations Comptes</h3>
        </div>

        <div class="Info__compte">
            <div class="Input__box" id="Choose__cpte">
                <label for="Pays">Choisir compte : </label>
                <div class="Cpt">
                    <input type="checkbox" id="Chk1" name="Chk1" />
                    <label for="Chk1">Compte Epargne</label>
                </div>
                <div class="Cpt">
                    <input type="checkbox" id="Chk2" name="Chk2" />
                    <label for="Chk2">Compte Tontine</label>
                </div>
                <div class="Cpt">
                    <input type="checkbox" id="Chk3" name="Chk3" />
                    <label for="Chk3">Compte Annuel</label>
                </div>
                <small class="Message_err"></small>
            </div>
            <div class="Input__box">
                <label for="Pays">Solde : </label>
                <input type="text" id="SodeE" name="SodeE" autocomplete="off" />
                <input type="text" id="SodeT" name="SodeT" autocomplete="off" />
                <input type="text" id="SodeA" name="SodeA" autocomplete="off" />
                <small class="Message_err"></small>
            </div>
        </div>
    </div>

    <div class="Contact__info">
        <div class="Info__first Name__group">
            <h3>Informations de contact</h3>
        </div>

        <div class="Info__secondly">
            <div class="Input__box">
                <label for="Ville">Ville : </label>
                <input type="text" id="Ville" name="Ville" maxlength="15" autocomplete="off" />
                <small class="Message_err"></small>
            </div>
            <div class="Input__box">
                <label for="Qtier">Quartier : </label>
                <input type="text" id="Qtier" name="Qtier" maxlength="15" autocomplete="off" />
                <small class="Message_err"></small>
            </div>
            <div class="Input__box">
                <label for="Phone">Téléphone : </label>
                <input type="number" id="Phone" name="Phone" maxlength="13" autocomplete="off" />
                <small class="Message_err"></small>
            </div>
            <div class="Input__box">
                <label for="Email">Email : </label>
                <input type="text" id="Email" name="Email" maxlength="30" autocomplete="off" />
                <small class="Message_err"></small>
            </div>
        </div>
    </div>

    <div class="Confidence">
        <div class="Confidence__first Name__group">
            <h3>Confidentialité & Sécurité</h3>
        </div>

        <div class="Confidence__secondly">
            <div class="Input__box">
                <label for="Compte">Compte : </label>
                <select name="Etat-Cpte" id="Etat-Cpte">
                    <option value="Actif">Actif</option>
                    <option value="Inactif">Inactif</option>
                </select>
                <small class="Message_err"></small>
            </div>
            <div class="Input__box">
                <label for="Password">Mot de passe : </label>
                <input type="password" name="Pass" id="Password" />
                <small class="Message_err"></small>
            </div>
        </div>

        <div class="Save__and__Other">
            <div class="Before__Save">
                <label for="Directory">Après la création du client :</label>
                <select name="Directory" id="Directory">
                    <option value="1">Aller à la liste des clients [action par defaut]</option>
                    <option value="2">Ajouter un nouveau client</option>
                    <!-- <option value="3">Afficher le client</option> -->
                    <option value="4">Aller à la page principale</option>
                </select>
            </div>
            <div class="Login__button">
                <button type="submit" name="submit" id="start">
                    <i class="fa-solid fa-save"></i>
                    <span>Enregistrer</span>
                </button>
                <a href="liste_client.php">
                    <i class="fa-solid fa-list-1-2"></i>
                    <span>Liste des clients</span>
                </a>
            </div>
        </div>
    </div>
</form>