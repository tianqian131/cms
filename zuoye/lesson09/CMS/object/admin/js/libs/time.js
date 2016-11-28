    t = setTimeout(time, 10);      //设置定时器

    function time() {
        clearTimeout(t);           //清空定时器
        var dt = new Date();       //获取当前时间
        var y = dt.getFullYear();  //获取4位数的年份
        var M = dt.getMonth()+1;     //获取月份
        var d = dt.getDate();      //获取多少号
        var D = dt.getDay()%8 + 1;     //获取星期几
        var h = dt.getHours();     //获取小时
        var m = dt.getMinutes();   //获取分钟
        var s = dt.getSeconds();   //获取秒

        document.getElementById("time").innerText = y + "年" + M + "月" + d + "日" + "  星期" + D + " " + h + "时" + m + "分" + s + "秒";
        t = setTimeout(time, 1000);
    }