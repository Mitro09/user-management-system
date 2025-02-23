<?php include __DIR__."/head.php"?>
<?php include __DIR__."/header.php"?>
    <div class="container">
        <form action="add_user_form.php" method="POST">
            <div class="form-group">
               <label for="">Nome</label>
               <!-- is-invalid  -->
               <input value="<?=$firstName?>" 
                      class="form-control <?=$firstNameClass?>"  
                      name="firstName"  
                      type="text"
                >
               <div class="<?=$firstNameClassMessage?>">
                   <?=$firstNameMessage?>
               </div> 
            </div>
            <div class="form-group">
                <label for="">Cognome</label>
                <input value="<?=$lastName?>"
                       class="form-control <?=$lastNameClass?>" 
                       name="lastName" 
                       type="text"
                >
                <div class="<?=$lastNameClassMessage?>">
                    <?=$lastNameMessage?>
                </div> 
             </div>
             <div class="form-group">
                <label for="">email</label>
                <input value="<?=$email?>"
                       class="form-control <?=$emailClass?>"  
                       name="email" 
                       type="text"
                > 
                <div class="<?=$emailClassMessage?>">
                    <?=$emailMessage?>
                </div>
             </div>
             <div class="form-group">
                <label for="">data di nascita</label>
                <input value="<?=$birthday?>"
                       class="form-control <?=$birthdayClass?>" 
                       name="birthday" 
                       type="date"
                >
                <div class="<?=$birthdayClassMessage?>">
                    <?=$birthdayMessage?>
                </div>
             </div>
             <button class="btn btn-primary mt-3" type="submit">Aggiungi</button>
             <a href="./list_users.php" class="btn btn-secondary">Utenti</a>
        </form>
    </div>
</body>
</html>