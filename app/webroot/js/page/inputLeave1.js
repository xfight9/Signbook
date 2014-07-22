signbook.inputLeave1 = (function (sk) {

    sk.init = function () {

        var monthText = false;
        var month = false;

        $('#datetimepicker').datetimepicker({
            format: 'yyyy-MM',
            startView: 'year',
            language: 'zh-CN',
            minView: 4,
            autoclose: 1
        });

        $('.the-file').html5Uploader({
            name: 'leave',
            postUrl: '/excelAjax/parseLeave',
            onSuccess : function (e, xhr, text){
                var result = JSON.parse(text);
                if(result.code == 0) {
                    $('.leave-alert').text(result.info + '， 然后刷新重试').slideDown();
                }
                else {//导入请假数据文件成功
                    $('.leave-alert').text('成功导入数据，可以导出Excel文件了').slideDown();
                    $('.input-file').slideUp();
                    $('.btn-output-leave').text('导出' + monthText + '月份请假Excel表格').show();
                }
            }
        });


        $('.btn-month').click(function(){
            month = $('#the-month').val(); //2014-07-01 00:00:00
            monthText = month.substr(0, 7);
            if(month.length == 0) {
                $('.modal-title').text('请选择');
                $('.modal-body').text('请选择月份');
                $('#leave-modal-box').modal();
                return;
            }
            $.post('/excelAjax/hasLeaveData', {
                'time' : month
            }, function(result) {
                if(result == 0) {//此月数据已存在, 提示错误
                    $('.modal-title').text('已有数据');
                    $('.modal-body').text('您选择的月份已有数据存在, 请重新选择');
                    $('#leave-modal-box').modal();
                }
                else {
                    $('.step').text('第二步:上传Excel文件');
                    $('.input-file').slideDown();
                    $('.input-month').hide();
                    $('.input-file .box-header').text('上传' + monthText + '月份的Excel请假文件');
                }
            });
        });

        $('.btn-output-leave').click(function (event) {
            event.preventDefault();
            var href = '/excelAjax/outputLeave/' + month.substr(0, 7);
            console.log(href);
            window.location.replace(href);
        });

    };//end sk.init

    return sk;
}(signbook.inputLeave1 || {}));