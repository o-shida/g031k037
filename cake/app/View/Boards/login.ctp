<div class="hero-unit">
    <?php echo $this->Session->flash('Auth'); ?>
    <?php echo $this->Form->create('User', array('url' => 'login')); ?>
    <?php echo $this->Form->input('User.name', array('label' => '名前')); ?>
    <?php echo $this->Form->input('User.password', array('label' => 'パスワード')); ?>
    <?php echo $this->Form->end('ログイン'); ?>
    <a href="useradd" id="switch" class="label btn-primary">新規登録</a>
</div>