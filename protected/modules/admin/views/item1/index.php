<?php$this->breadcrumbs=array(	'商品中心',);$this->menu=array(	array('label'=>'创建商品', 'url'=>array('create')),	array('label'=>'管理商品', 'url'=>array('admin')),);?><h1>商品中心</h1><?php $this->widget('zii.widgets.CListView', array(	'dataProvider'=>$dataProvider,	'itemView'=>'_view',)); ?>