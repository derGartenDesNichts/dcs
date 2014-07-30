$('#Questions_expired_date').datetimepicker({
    stepMinute: 5,
    dateFormat:'yy-mm-dd',
    beforeShow: function (input, inst) {
        var offset = $(input).offset();
        var height = $(input).height();
        window.setTimeout(function () {
            inst.dpDiv.css({ top: (offset.top + height + 10) + 'px', left: offset.left + 'px' })
        }, 1);
    }
});