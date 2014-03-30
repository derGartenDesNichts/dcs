<?php
/* @var $newQuestions Questions */

$this->widget('bootstrap.widgets.TbListView', array(
    'id'=>'new-questions-qrid',
    'template'=>"{items}{pager}",
    'dataProvider'=> Questions::model()->getNewQuestions(),
    'itemView'=>'/questions/_list_item',
    'summaryText'=>false,
    'ajaxUpdate' => false,
    'htmlOptions' => array(
        'class' => 'topic-list'
    ),
));
