<?php
    if($type == 'leave') {
        $typeText = '请假';
        $resetUrl = '/sign/get/leave';
    }
    else {
        $typeText = '考勤';
        $resetUrl = '/sign/get/sign';
    }
?>
<input type="hidden" id="page-type" value="<?php echo $type; ?>">
<section class="content-header">
    <h1>
        <i class="glyphicon glyphicon-cloud-download"></i>
        <?php echo '导出'. $typeText. '数据'; ?>
        <small class="step">选择月份</small>
    </h1>
</section>

<div class="row input">
    <div class="input--left col-sm-5">
        <div class="sk-box box box-red input-month clearfix">
            <h4 class="box-header">
                <?php echo '您要导出几月份的'. $typeText. '数据'; ?>
            </h4>
            <div id="datetimepicker" class="input-group date form_date" data-link-field="the-month">
                <input class="form-control" size="16" type="text" value="" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" id="the-month" value="" />
            <button type="button" class="btn btn-primary btn-month">确定</button>
        </div>
    </div>

    <div class="page-right input-right col-sm-5">
        <div class="input-leave-tip">
            <div class="alert alert-info" role="alert">
                <?php echo '没有'. $typeText. '记录的月份请先导入数据'; ?>
                <a href="/sign/inputLeave" class="alert-link">导入</a>
            </div>
        </div>
    </div>

</div>
<!-- end .row -->


<div class="modal fade dn" id="leave-modal-box">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">已有数据</h4>
      </div>
      <div class="modal-body">
        <p>您选择的月份已有数据存在, 请重新选择</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div><!-- /.modal -->

<?php
    echo $this->Html->script('page/get', array('inline' => false));
    echo $this->Html->scriptStart(array('block' => 'script'));
?>
    $(document).ready(function(){
        signbook.get.init();
    });
<?php echo $this->Html->scriptEnd(); ?>