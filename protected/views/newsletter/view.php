<?php
$this->breadcrumbs=array(
	'Newsletters'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List Newsletter', 'url'=>array('index')),
	array('label'=>'Create Newsletter', 'url'=>array('create')),
	array('label'=>'Update Newsletter', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Newsletter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Newsletter', 'url'=>array('admin')),
);
?>

<h1>View Newsletter #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'IdGrupo',
		'nome',
		'email',
		'assuntoInteresse',
		'tipo',
		'uf',
		'cidade',
		'jahFezDoacoes',
		'validado',
		'dataCadastro',
		'grupo',
		'exportado',
	),
)); ?>
