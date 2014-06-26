
<?php
/* @var $question Questions */

$this->widget('bootstrap.widgets.TbListView', array(
    'id'=>'new-questions-qrid',
    'template'=>"{items}{pager}",
    'dataProvider'=> $questions,
    'itemView'=>'/questions/_list_item',
    'summaryText'=>false,
    'ajaxUpdate' => false,
    'htmlOptions' => array(
        'class' => 'topic-list'
    ),
));
?>
