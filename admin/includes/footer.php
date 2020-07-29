  </div>
  <!-- /#wrapper -->

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script src="js/scripts.js"></script>
  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
       

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Views',     <?php echo $session->count?> ],
          ['Photos',      <?php echo count(Photo::find_all())?>],
          ['Users',   <?php echo count(User::find_all())?>],
          ['Comments',  <?php echo count(Comments::find_all())?>],
        ]);

        var options = {
          title: 'My Daily Activities',
          backgroundColor : 'transparent',
          colors:['#0275d8','green','orange','red'],
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </body>

  </html>