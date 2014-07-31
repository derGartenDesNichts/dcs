<div class="well">
    <div class="row-fluid" id="<?=$data->comment_id ?>">

        <?php $this->renderPartial('_user_info',array('data'=>$data)) ?>

        <div class="span9">
            <div class="topic-heading">
                <span class="muted">
                    <i class="icon-time"></i> <?=DateFormatHelper::setCustomDate($data->date_added)?>
                </span>
            </div>
            <div class="content">
                <?=$data->text?>
            </div>
        </div>
    </div>
</div>
