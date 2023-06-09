
<?php

use App\Models\PollAnswers;

/** @var Poll $poll */

?>

@extends('layouts.main')

@section('title', "Data")

@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      let variants = [['Variants','Votes']];
      window.onload=function(){
        let xhr = new XMLHttpRequest();
        let url = '{{route("poll.get-answers",[$poll])}}'
        xhr.open("GET",url,true)
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xhr.onload = function() {
          let response =JSON.parse(xhr.responseText);
          for(res of response)
          {
            variants.push(res);
          }

          google.charts.load('current', {'packages':['bar']});
          google.charts.setOnLoadCallback(drawStuff);
          google.charts
          function drawStuff() {
            var data = new google.visualization.arrayToDataTable(variants);

            var options = {
              title: 'Poll results',
              width: 900,
              legend: { position: 'none' },
              chart: { title: 'Poll results',
                      subtitle: '' },
                      bars: 'horizontal', // Required for Material Bar Charts.
                      axes: {
                        x: {
                            0: { side: 'top', label: 'Answers'} // Top x-axis.
                            }
                          },
                        bar: { groupWidth: "90%" }
            };
            var chart = new google.charts.Bar(document.getElementById('top_answers'));
            chart.draw(data, options);
          };
          for(let i=1; variants.length; i++)
          {
            let tr = document.createElement('tr')
            let varsTd = document.createElement('td')
            let votesTd = document.createElement('td')
            console.log(variants[i][0])
            varsTd.innerHTML = variants[i][0]
            votesTd.innerHTML = variants[i][1]
            tr.append(varsTd,votesTd);
            document.querySelector('#tbl').append(tr)
          }
        }
        xhr.send();
      }
      
    </script>
    <table class='table table-hover' >
      <thead>
        <th>Variant</th>
        <th>Votes</th>
      </thead>
      <tbody id='tbl'>

      </tbody>
    </table>
    <div id="top_answers" style="width: 900px; height: 500px;"></div>
    <a class='btn btn-lg btn-outline-primary' href="{{
      Auth::check()?route('poll.index'):route('poll.public-index')
    }}"><i class='fa fa-reply'></i></a>
@endsection


