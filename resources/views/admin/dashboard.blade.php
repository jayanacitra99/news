@extends('admin/template')
@section('title')
    Dashboard
@endsection
@section('script-head')
    
@endsection
@section('content')
    <!-- AREA CHART -->
    <div class="card-header">
        <h3 class="card-title">Graph Visited Categories</h3>
    </div>
    <div class="card-body">
        <?php $jumlah = 0?>
        @foreach ($category as $cat)
            <?php 
                $jan = 0;
                $feb = 0;
                $mar = 0;
                $apr = 0;
                $may = 0;
                $jun = 0;
                $jul = 0;
                $aug = 0;
                $sep = 0;
                $oct = 0;
                $nov = 0;
                $dec = 0;
            ?>
            @foreach ($catLog as $cl)
                @if (($cat->category == $cl->category) && (date('m', strtotime($cl->time)) == '01'))
                    <?php $jan += 1?>
                @endif
                @if (($cat->category == $cl->category) && (date('m', strtotime($cl->time)) == '02'))
                    <?php $feb += 1?>
                @endif
                @if (($cat->category == $cl->category) && (date('m', strtotime($cl->time)) == '03'))
                    <?php $mar += 1?>
                @endif
                @if (($cat->category == $cl->category) && (date('m', strtotime($cl->time)) == '04'))
                    <?php $apr += 1?>
                @endif
                @if (($cat->category == $cl->category) && (date('m', strtotime($cl->time)) == '05'))
                    <?php $may += 1?>
                @endif
                @if (($cat->category == $cl->category) && (date('m', strtotime($cl->time)) == '06'))
                    <?php $jun += 1?>
                @endif
                @if (($cat->category == $cl->category) && (date('m', strtotime($cl->time)) == '07'))
                    <?php $jul += 1?>
                @endif
                @if (($cat->category == $cl->category) && (date('m', strtotime($cl->time)) == '08'))
                    <?php $aug += 1?>
                @endif
                @if (($cat->category == $cl->category) && (date('m', strtotime($cl->time)) == '09'))
                    <?php $sep += 1?>
                @endif
                @if (($cat->category == $cl->category) && (date('m', strtotime($cl->time)) == '10'))
                    <?php $oct += 1?>
                @endif
                @if (($cat->category == $cl->category) && (date('m', strtotime($cl->time)) == '11'))
                    <?php $nov += 1?>
                @endif
                @if (($cat->category == $cl->category) && (date('m', strtotime($cl->time)) == '12'))
                    <?php $dec += 1?>
                @endif
            @endforeach
            <div id="dataCat{{$jumlah++}}" catName="{{$cat->category}}" janData="{{$jan}}" febData="{{$feb}}" marData="{{$mar}}" aprData="{{$apr}}" mayData="{{$may}}" junData="{{$jun}}" julData="{{$jul}}" augData="{{$aug}}" sepData="{{$sep}}" octData="{{$oct}}" novData="{{$nov}}" decData="{{$dec}}"></div>
        @endforeach
        <div id="dataCat" jumlahCat="{{$jumlah}}"></div>
        <div class="chart">
        <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
    <!-- /.card-body -->
@endsection
@section('script-body')
<!-- ChartJS -->
<script src="{{asset('')}}adminlte/plugins/chart.js/Chart.min.js"></script>
<script>
    $(function () {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */
  
      //--------------
      //- AREA CHART -
      //--------------
  
      // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
        var totalJu = $('#dataCat').attr('jumlahCat');
        var datasetArray = new Array();

        for (let index = 0; index < totalJu; index++) {
            var temp = {};
            var cat = new Array();
            var color ="#"+Math.floor(Math.random()*16777215).toString(16);
            var colorPoint ="#"+Math.floor(Math.random()*16777215).toString(16);
            cat.push(parseInt($('#dataCat'+index).attr('janData')));
            cat.push(parseInt($('#dataCat'+index).attr('febData')));
            cat.push(parseInt($('#dataCat'+index).attr('marData')));
            cat.push(parseInt($('#dataCat'+index).attr('aprData')));
            cat.push(parseInt($('#dataCat'+index).attr('mayData')));
            cat.push(parseInt($('#dataCat'+index).attr('junData')));
            cat.push(parseInt($('#dataCat'+index).attr('julData')));
            cat.push(parseInt($('#dataCat'+index).attr('augData')));
            cat.push(parseInt($('#dataCat'+index).attr('sepData')));
            cat.push(parseInt($('#dataCat'+index).attr('octData')));
            cat.push(parseInt($('#dataCat'+index).attr('novData')));
            cat.push(parseInt($('#dataCat'+index).attr('decData')));
            temp['label']               = $('#dataCat'+index).attr('catName');
            temp['backgroundColor']     = color;
            temp['borderColor']         = color;
            temp['pointRadius']         = true;
            temp['pointColor']          = colorPoint;
            temp['pointStrokeColor']    = colorPoint;
            temp['pointHighlightFill']  = '#fff';
            temp['pointHighlightStroke']= color;
            temp['data']                = cat;
            datasetArray.push(temp);
        }

        var areaChartData = {
            labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sept','Oct','Nov','Dec'],
            datasets: datasetArray
        }
    
        var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
            display: true
            },
            scales: {
            xAxes: [{
                gridLines : {
                display : true,
                }
            }],
            yAxes: [{
                gridLines : {
                display : true,
                }
            }]
            }
        }
    
        // This will get the first returned node in the jQuery collection.
        new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        })
    })
</script>
@endsection