<div id="hero-unit">
    新規ユーザー登録
    <?php echo $this->Session->flash('Auth'); ?>
    <?php echo $this->Form->create('User', array('url' => 'useradd')); ?>
    <?php echo $this->Form->input('User.name',array('label'=>'ユーザ名')); ?>
    <?php echo $this->Form->input('User.password',array('label'=>'パスワード')); ?>
    <?php echo $this->Form->input('User.pass_check',array('label'=>'パスワード確認','type'=>"password")); ?>
    <?php echo $this->Form->input('User.email',array('label'=>'メールアドレス'));?>
    <?php $option = array(0 => '男', 1 => '女'); ?>
	<?php $option2 = array('legend' => false, 'value' => 1);?>	
	<?php echo $this->Form->label('User.sex','性別'); ?>
	<?php echo $this->Form->radio('User.sex',$option,$option2); ?>
    <?php echo $this->Form->end('新規ユーザを作成する'); ?>
    <a href="login" id="switch2" class="label btn-primary">ログインへ</a>
</div>