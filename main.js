var ex = {
    jsonp: function (object) {

        if (!object)return console.log('需要参数');
        if (!object.url)return console.log('需要url');
        if (!object.success)return console.log('需要回调');

        //Debug
        function debug(){
            if (object.debug) {

                console.log('\n===jsonp Debug===\n');
                console.log('===url===\n' + object.url);
                console.log('===data===\n');
                if (object.data)console.log(ex.params(object.data, 'log'));
                else console.log('null');
                console.log('============================');

            }
        }
        //===============================

        $.jsonp({
            url: object.url,
            callbackParameter: object.callbackParameter ? object.callbackParameter : "callback",
            data: object.data ? object.data : null,
            success: function (obj) {
                if (typeof obj == 'string')obj = $.parseJSON(obj);
                //Debug
                if (object.debug) {
                    debug();
                    console.log('===Callback===\n');
                    console.dir(obj);
                }
                //===============================
                object.success(obj);
            },
            beforeSend: object.beforeSend ? object.beforeSend : function () {
                layer.load(2);
            },
            complete: object.complete ? object.complete : function () {
                layer.closeAll('loading');
            },
            error: object.error ? object.error : function () {
                layer.msg('您的网络连接不太顺畅哦');
                //Debug
                if (object.debug) {
                    debug();
                    console.log('===Callback===\n');
                    console.log('===ERROE!===');
                }
                //===============================
            }
        });
    },
    params: function (obj, type) {
        var ws, br;
        switch (type) {
            case 'html':
                ws = '&nbsp;';
                br = '<br>';
                break;
            case 'log':
                ws = ' ';
                br = '\n';
                break;
        }

        function space(i) {
            if (i == 1)return ws;
            else {
                return ws + space(i - 1);
            }
        }

        var str = '';
        if (typeof obj != 'object') {
            str += obj + space(3) + '[TYPE:' + typeof obj + ']';
        } else {
            for (var i in obj) {
                str += space(1) + i + ': ' + obj[i] + br;

                if (typeof obj[i] == 'object') {
                    for (var j in obj[i]) {
                        str += space(5) + '└─' + space(1) + j + ': ' + obj[i][j] + br;

                        if (typeof obj[i][j] == 'object') {
                            for (var k in obj[i][j]) {
                                str += space(10) + '└─' + space(1) + k + ': ' + obj[i][j][k] + br;
                            }
                            str += br;
                        }
                    }
                    str += br;
                }
            }
            str += br;
        }
        return str;
    }
};