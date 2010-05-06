


<div class="span-12 last center prepend-6 prepend-top login">
    <? echo $this->Session->flash('auth'); ?>
    <h1>Ingresar al Sistema</h1>
    <?php
    if($session->check('Message.auth')) $session->flash('auth');

    echo $form->create('User', array('action'=>'login'));
    echo $form->input('username',array('label'=>'Usuario'));
    echo $form->input('password', array('type'=>'password','label'=>'Contraseña'));
    echo $form->end('Entrar');
    ?>

</div>