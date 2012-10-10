<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'newsletter-newsletter-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Id'); ?>
		<?php echo $form->textField($model,'Id'); ?>
		<?php echo $form->error($model,'Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IdGrupo'); ?>
		<?php echo $form->textField($model,'IdGrupo'); ?>
		<?php echo $form->error($model,'IdGrupo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'assuntoInteresse'); ?>
		<?php echo $form->textField($model,'assuntoInteresse'); ?>
		<?php echo $form->error($model,'assuntoInteresse'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php echo $form->textField($model,'tipo'); ?>
		<?php echo $form->error($model,'tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uf'); ?>
		<?php echo $form->textField($model,'uf'); ?>
		<?php echo $form->error($model,'uf'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cidade'); ?>
		<?php echo $form->textField($model,'cidade'); ?>
		<?php echo $form->error($model,'cidade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jahFezDoacoes'); ?>
		<?php echo $form->textField($model,'jahFezDoacoes'); ?>
		<?php echo $form->error($model,'jahFezDoacoes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'validado'); ?>
		<?php echo $form->textField($model,'validado'); ?>
		<?php echo $form->error($model,'validado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dataCadastro'); ?>
		<?php echo $form->textField($model,'dataCadastro'); ?>
		<?php echo $form->error($model,'dataCadastro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'grupo'); ?>
		<?php echo $form->textField($model,'grupo'); ?>
		<?php echo $form->error($model,'grupo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exportado'); ?>
		<?php echo $form->textField($model,'exportado'); ?>
		<?php echo $form->error($model,'exportado'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->