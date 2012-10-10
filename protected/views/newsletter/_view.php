<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IdGrupo')); ?>:</b>
	<?php echo CHtml::encode($data->IdGrupo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assuntoInteresse')); ?>:</b>
	<?php echo CHtml::encode($data->assuntoInteresse); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uf')); ?>:</b>
	<?php echo CHtml::encode($data->uf); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cidade')); ?>:</b>
	<?php echo CHtml::encode($data->cidade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jahFezDoacoes')); ?>:</b>
	<?php echo CHtml::encode($data->jahFezDoacoes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('validado')); ?>:</b>
	<?php echo CHtml::encode($data->validado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dataCadastro')); ?>:</b>
	<?php echo CHtml::encode($data->dataCadastro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grupo')); ?>:</b>
	<?php echo CHtml::encode($data->grupo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exportado')); ?>:</b>
	<?php echo CHtml::encode($data->exportado); ?>
	<br />

	*/ ?>

</div>