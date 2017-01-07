/**
 * Created by straysh / <jobhancao@gmail.com> on 16-11-4.
 */
require(['jquery', 'UI', 'libs/jquery/jquery.flot.min'
],
function($, UI) {
    function ChartDataproce(ddd)
    {
        var data = [], dat = [];
        var price=ddd[0][1];
        var i=0;
        var m=new Date().getTime();
        var day=1000*3600*24;
        for(var n=0;n<ddd.length;n++)
        {
            if(m>=ddd[n][0]){
                if(price!=ddd[n][1])
                {
                    dat=[];
                    if(ddd[n-1][0]!=ddd[n][0])
                        dat[0]=ddd[n][0]-day;
                    else
                        dat[0]=ddd[n][0];
                    dat[1]=price;
                    data[i]=dat;
                    i++;
                }
                dat=[];
                dat[0]=ddd[n][0];
                dat[1]=ddd[n][1];
                data[i]=dat;
                price=ddd[n][1]
                i++;
            }

        }
        i=data.length-1;
        if(i>0 && data[i][0]<m){
            dat=[];
            dat[0]=m;
            dat[1]=data[i][1];
            data.push(dat);
        }
        return data;
    }

    function Datachart(ddd,ij) {
        //var ddd= eval("(["+usdeur+"])")
        var dat1;
        var data=[];
        var dat2;
        var m=new Date().getTime()-120*24*60*60*1000;
        var i=0,mind,maxd,v,mm=[],vDate, date;
        mind=ddd[0][0];
        maxd=new Date().getTime();
        v=(maxd-mind)/ij ;
        for(var n=0;n<ij;n++)
        {
            vDate =new Date(v*n+mind);
            date = (vDate.getMonth() + 1) + "-" + vDate.getDate();
            mm.push([v*n+mind,date]);
        }
        vDate=new Date(maxd);
        date = (vDate.getMonth() + 1) + "-" + vDate.getDate();
        mm[0][1]="";
        mm.push([v*n+mind,date]);
        return mm;
    }
    function chart(usdeur){
        var data= eval("(["+usdeur+"])");
        var mm = Datachart(data, 6);
        data=ChartDataproce(data);
        popchart(data,"chart-container",0,mm,20,12);
        //$("#container .flot-base").css("left",5);
        //$("#container .flot-base").css("top",8);
        //$("#container .flot-text ).css("top",8);
        $("#container .flot-text ").css("left",-10);
        $("#container .flot-text .flot-x-axis").css("top",8);
        $("#container .flot-text .flot-x-axis").css("left",-5);
//	popchart(data,"container1",0,mm,20,10);
        //$("#container1 .flot-base").css("left",5);
//	$("#container1 .flot-base").css("top",8);
//	$("#container1 .flot-text ").css("left",-8);
//	$("#container1 .flot-text .flot-x-axis").css("top",12);
//	$("#container1 .flot-text .flot-x-axis").css("left",-10);

    }


    function popchart(data,idtxt,jg,mm,fx,fy)//placeholder,x调整，y调整
    {
        var dom, mid,i=data.length-1,xx,yy;
        if(typeof mm==="undefined" && mm==null)
            mm={ mode: "time", timezone: "browser", timeformat: "%m-%d", tickLength: 0};
        else
            mm= {ticks: mm,labelWidth:90};
        if(typeof fx==="undefined")
            fx=0;
        if(typeof fy==="undefined")
            fy=0;
        plot = $.plot("#"+idtxt, [{ data: data }],
            {
                series: {
                    lines: {  show: true ,lineWidth:2 }

                },
                crosshair: {
                    mode: "x"
                },
                colors: ["#ed5700", "#0022FF"],
                grid: {
                    hoverable: true,
                    autoHighlight: true,
                    borderWidth: 0,
                    clickable: true,
                    margin: 15,
                    labelMargin: 2
                },
                yaxis: {

                },
                xaxis: mm,
                legend: {
                    margin:0
                }

            });
        mid=idtxt+"tooltip";
        var legends = $("#"+idtxt+" .legendLabel");
        $("#"+idtxt+" .legend table").css("top",-12);
        $("#"+idtxt+" .legend div").css("top",-13);
        legends.each(function () {
            // fix the widths so they don't jump around
            $(this).css('width', 90);
        });

        $("#"+idtxt).bind("plothover", function (event, pos, item) {
            var i, j, dataset,x,y ,w,h,w1,h1;
            var x1,y1;
            var series
            if (item) {
                dataset = plot.getData();
                series = item.series;
                var vDate =new Date(item.datapoint[0]);
                var date = vDate.getFullYear() + "-" + (vDate.getMonth() + 1) + "-" + vDate.getDate();
                var hw= plot.pointOffset({ x: item.series.data[item.dataIndex][0], y: item.series.data[item.dataIndex][1] })
                w=plot.width()+50;
                h=plot.height()+10;
                $("#"+mid).html(""+date+"<br>价格："+ parseFloat(item.datapoint[1].toFixed(2)));
                w1=$("#"+mid).width();
                h1=$("#"+mid).height();
                y1=hw.top+3;
                x1=hw.left+3;
                if(x1+w1>w)
                    x1-=w1+6;
                if(y1+h1>h)
                    y1-=h1+6;


                /*w=$(document.body).width()-120;
                 y = item.pageY-$("#"+idtxt).offset().top+fy;
                 x = item.pageX-$("#"+idtxt).offset().left+fx;
                 x1=
                 if(item.pageX>w)
                 x=w-$("#"+idtxt).offset().left+fx;*/
                $("#"+mid).css({top:y1, left: x1}).fadeIn(200);

            }	else {
                $("#"+mid).hide();
            }
        });

        $("<div id='"+mid+"'></div>").css({
            "width":"100px",
            position: "absolute",
            display: "none",
            border: "1px solid #FFCC66",
            padding: "2px",
            "background-color": " #FFEBBF",
            opacity: 0.80,
            "z-index":"999999"
        }).appendTo($("#"+idtxt).parent());


        $("<div id='A"+mid+"'></div>").css({
            position: "absolute",
            padding: "2px",
            opacity: 0.80,
            "z-index":"999999"
        }).appendTo($("#"+idtxt).parent());
        var dd=plot.pointOffset({ x: data[i][0], y: data[i][1] });
        $("#A" + mid).html(data[i][1]).css({ top: dd.top - 10, left: dd.left })

        var minprice = data[0][1];
        var minj = 0;
        for (j = 0; j <= i; j++) {
            if (minprice > parseFloat(data[j][1])) {
                minprice = parseFloat(data[j][1]);
                minj = j;
            }
        }
        if (minprice < parseFloat(data[i][1])) {
            $("<div id='L" + mid + "'></div>").css({
                position: "absolute",
                padding: "2px",
                opacity: 0.80,
                "z-index": "999999"
            }).appendTo($("#" + idtxt).parent());
            var dd2 = plot.pointOffset({ x: data[minj][0], y: data[minj][1] });
            var dd1 = plot.pointOffset({ x: data[0][0], y: minprice });
            var dd3 = plot.pointOffset({ x: data[i - 1][0], y: minprice });
            $("#L" + mid).html(data[minj][1]).css({ top: dd2.top, left: dd3.left })
            var context = plot.getCanvas();
            var ctx = context.getContext('2d');
            ctx.save();
            ctx.translate(0.5, 0.5);
            ctx.lineWidth = 1;
            ctx.strokeStyle = '#AAAAAA';
            ctx.beginPath();
            var xpos = dd3.left - dd1.left;  //得到横向的宽度;
            var ypos = dd3.top - dd1.top;  //得到纵向的高度;
            numDashes = Math.floor(Math.sqrt(xpos * xpos + ypos * ypos) / 5);

            for (var ii = 0; ii <= numDashes; ii++) {
                if (ii % 2 === 0) {
                    ctx.moveTo(dd1.left + (xpos / numDashes) * ii, dd1.top + (ypos / numDashes) * ii);
                    //有了横向宽度和多少段，得出每一段是多长，起点 + 每段长度 * i = 要绘制的起点；
                } else {
                    ctx.lineTo(dd1.left + (xpos / numDashes) * ii, dd1.top + (ypos / numDashes) * ii);
                }
            }
            ctx.stroke();
            ctx.restore();

        }

    }
    $().ready(function(){
        if(UI.$CONFIG.chart_data)
            chart(UI.$CONFIG.chart_data);
    });
});

