<?php 

$data = $_POST['expense_data'];

MonthlyExpenseGraph($data);


function MonthlyExpenseGraph($records)
    {
           
            $html = '<script>
                        var options={chart:{height:374,type:"line",dropShadow:{enabled:!0,top:10,left:0,bottom:0,right:0,blur:2,color:"#45404a2e",opacity:.35},toolbar:{show:!1}},stroke:{width:5,curve:"smooth"},series:[{name:"Likes",data:[';
                                            $i = 1;
                   foreach ($records as $k => $val)
                    {
                       if($i != count($records))
                       {
                          $html .= $val['amount'].','; 
                       }
                       else
                       {
                          $html .= $val['amount'];
                       }
                       $i++;
                    }
                        $html .=']}],xaxis:{categories:[';
                        $j = 1;
                        foreach ($records as $k => $val)
                        {
                            if($j != count($records))
                            {
                                $html .= "'".$val['dates']."',";
                            }
                            else{
                                $html .= "'".$val['dates']."'";
                            }
                            $j++;
                        }
                                $html .= '],axisBorder:{show:!0,color:"#bec7e0"},axisTicks:{show:!0,color:"#bec7e0"}},fill:{type:"gradient",gradient:{shade:"dark",gradientToColors:["#506ee4"],shadeIntensity:1,type:"horizontal",opacityFrom:1,opacityTo:1,stops:[0,100,100,100]}},markers:{size:4,opacity:.9,colors:["#ffb822"],strokeColor:"#fff",strokeWidth:2,style:"inverted",hover:{size:7}},yaxis:{title:{text:"EXPENSE AMOUNT"}},grid:{row:{colors:["transparent","transparent"],opacity:.2},strokeDashArray:4},responsive:[{breakpoint:600,options:{chart:{toolbar:{show:!1}},legend:{show:!1}}}]},chart=new ApexCharts(document.querySelector("#expense_monthly"),options);chart.render(),$("#datatable").DataTable(),$(".peity-bar").each(function(){$(this).peity("bar",$(this).data())}),$(".peity-donut").each(function(){$(this).peity("donut",$(this).data())}),$(".peity-line").each(function(){$(this).peity("line",$(this).data())});
                </script>';
            echo $html;
}