<?php 

$this->pageTitle = "Обратная связь";

?>
<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
    <div class="alert alert-success" role="alert">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>	
</div>

<?php else: ?>

<p>Если у вас есть деловое предложение или другие вопросы, пожалуйста, заполните следующую форму, чтобы связаться с нами. Спасибо.</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'htmlOptions'=>array('class'=>'form-horizontal'),
	'id'=>'feedback_form',
	'enableClientValidation'=>true,
        'htmlOptions'=>array(
            'class'=>'top20',
        ),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    
    
    <?php echo $form->errorSummary($model); ?>
    
    <div class="row">
        <div class="col-md-2">Ваше имя*</div>
        <div class="col-md-10">
            <?php echo $form->textField($model,'name', array('class'=>'form-control','placeholder'=>'имя')); ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">Ваша почта*</div>
        <div class="col-md-10">
            <?php echo $form->emailField($model,'email', array('class'=>'form-control','placeholder'=>'электронная почта')); ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">Заголовок*</div>
        <div class="col-md-10">
            <?php echo $form->textField($model,'subject', array('class'=>'form-control','placeholder'=>'тема письма')); ?>
        </div>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-2">Сообщение*</div>
        <div class="col-md-10">
            <?php echo $form->textArea($model,'body',array('rows'=>'6','class'=>'form-control','placeholder'=>'текст')); ?>
        </div>
    </div> 
    <br>
    <div class="row">
        <div class="col-md-2">Проверка*</div>
        <div class="col-md-10">
            <div class="captcha" style="float: left; margin-right: 10px;">
                <?php $this->widget('CCaptcha'); ?>
            </div>
            <div style="float: left; margin-right: 10px;">
                <?php echo $form->textField($model,'verifyCode',array('size'=>'10')); ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <?php echo CHtml::submitButton('Отправить'); ?>
        </div>
    </div>
    <br>
    
<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>        