signbook.getLeave = (function (sk) {


    sk.init = function () {
        $('#datetimepicker').datetimepicker({
            format: 'yyyy-MM',
            startView: 'year',
            language: 'zh-CN',
            minView: 4,
            autoclose: 1
        });

        $('.btn-month').click(function(){
            var month = $('#the-month').val(); //2014-07-01 00:00:00
            var monthText = month.substr(0, 7);
            if(month.length == 0) {
                $('.modal-title').text('请选择');
                $('.modal-body').text('请选择月份');
                $('#leave-modal-box').modal();
                return;
            }
            $.post('/excelAjax/hasLeaveData', {
                'time' : month
            }, function(result) {
                if(result == 1) {//此月数据已存在, 请求生成Excel文件
                    window.location.href =  '/excelAjax/outputLeave/' + monthText;
                }
                else {//提示无数据
                    $('.modal-title').text('木有数据');
                    $('.modal-body').text('您选择的月份还木有数据, 请先上传请假数据Excel文件');
                    $('#leave-modal-box').modal();
                }
            });
        });
    };


    return sk;
}(signbook.getLeave || {}));