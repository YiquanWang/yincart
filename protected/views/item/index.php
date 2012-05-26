<?phpYii::app()->clientScript->registerCoreScript('jquery');Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/css/jquery.highlight-3.js');?><script type="text/javascript"><?php if ($keyword) { ?>            $(document).ready(function(){                $(".item_name").removeHighlight().highlight("<?php echo $keyword ?>");            })<?php } ?></script><style type="text/css">    .highlight { background-color: yellow }</style><?php$this->pageTitle = $category ? $category->category_name .' - '. Yii::app()->name . ' - 商品列表' : '全部商品' .' - '. Yii::app()->name . ' - 商品列表';$this->breadcrumbs = array(    '商品列表'=>array('/item/list'),    $category ? $category->category_name : '全部商品');?><div class="box">    <div class="box-title">商品列表</div>    <div class="box-content item-list">        <ul><?phpif ($items) {    foreach ($items as $i) {        ?>                    <li>                        <div class="image"><?php echo $i->getListThumb() ?></div>                        <div class="name"><?php echo CHtml::link($i->item_name, array('/item/view', 'id'=>$i->item_id)) ?></div>                        <div class="price">零售价：<span class="currency"><?php echo $i->currency ?></span><em><?php echo $i->market_price ?></em></div>                        <div class="price">批发价：<span class="currency"><?php echo $i->currency ?></span><em><?php echo $i->shop_price ?></em></div>                    </li>    <?php }} else {    ?>                <p style="text-align:center">没有找到商品!</p>            <?php } ?>        </ul>    </div>    <div class="clear"></div>    <div align="center" class="p-page"><?php            $this->widget('CLinkPager', array(                'pages' => $pages,            ))            ?>    </div></div>