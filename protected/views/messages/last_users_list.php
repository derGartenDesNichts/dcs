<?php
/**
 *
 * @var MessagesController $this
 */
if (!empty($users)) {
    $provider = new CArrayDataProvider($users,array(
        'pagination'=>array(
            'pageSize'=>10,
        ),
    ));

    $this->widget('zii.widgets.CListView', array(
        'id' => 'user-list',
        'dataProvider' => $provider,
        'template' => '{items}',
        'itemView' => '_last_user_item',
        'enableSorting' => false,
        'enablePagination' => false,
        'emptyText' => '',
        'cssFile' => false,
    ));
} else {
    echo '<p class="no-messages">You have no messages</p>';
}
