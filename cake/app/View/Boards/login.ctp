<div class="hero-unit">
    <!-- <?php echo $this->Session->flash('Auth'); ?> -->
    <?php echo $this->Form->create('User', array('url' => 'login')); ?>
    <?php echo $this->Form->input('User.name', array('label' => '名前')); ?>
    <?php echo $this->Form->input('User.password', array('label' => 'パスワード')); ?>
    <?php echo $this->Form->end('ログイン'); ?>
    <!-- twitterでログインする場合 -->
    <?php if(empty($user)): /* 未ログインの場合はFormヘルパーを使って認証ボタンを表示 */ ?>
     <a href="twitter_login">Twitter でlogin</a>
    <?php else: /* ログイン済みの場合はログアウトアクションへのリンクを表示 */ ?>
        ログイン済みです。
        <?php echo $user['NewUser']['username']; ?>
        <strong><?php echo $this->Html->link(__('Logout'), array('action' => 'logout')); ?> </strong>
    <?php endif ; ?>
    <a href="facebook">facebook でlogin</a>
    <?php echo '<br >' ?>
    <a href="useradd" id="switch" class="label btn-primary">新規登録</a>
</div>