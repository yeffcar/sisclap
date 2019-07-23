<style type="text/css">
    body{
    background: url('<?php echo base_url('/img/profile/parallax-2.jpg'); ?>') center no-repeat;
    background-size: cover;
}
.logo{
    width: 80px;
    display: block;
    margin: 0 auto;
    position: relative;
}
</style>
<div class="cont">
    <div class="container ">
    <div class="row ">
        <div class="col s12 m3 l4 login">
            
            <form class="card hoverable" role="form" action="<?php echo $base_url ?>index.php/Login/validar/" method="post">
                <div class="card-panel red darken-4 center-align">
                <img src="/img/login.png" class="logo">
                    <span class="card-title white-text ">Iniciar Sesión</span>
                </div>
                <div class="card-content">
                    <p>
                        <div class="input-field">
                            <i class="material-icons prefix">perm_identity</i>
                            <input id="username" type="text" name="username" required="required">
                            <label for="username" class="">Usuario</label>
                        </div>
                        <div class="input-field">
                            <i class="material-icons prefix">lock_outline</i>
                            <input id="password" name="password" type="password" required="required">
                            <label for="password" class="">Contraseña</label>
                        </div>
                        <br>
                        <input type="checkbox" id="test5" />
                        <label for="test5">Recordarme</label>
                        <br>
                       
                       
                        
                    </p>
                    <?php if (isset($error)): ?>
                             <p class="red-text"><?php echo $error; ?></p>
                    <?php endif ?>
                </div>
                <div class="card-action">
                    <button class="btn red darken-2 waves-effect waves-light" type="submit">Ingresar</button>
                </div>
                <?php if (isset($continue)): ?>
                    <input type="hidden" value="<?php echo $continue ?>" name="continue" id="continue">
                <?php endif ?>
                
            </form>
        </div>
    </div>
</div>
</div>
