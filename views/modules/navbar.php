 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-navy">

    <!-- Left navbar links -->
    <ul class="navbar-nav">

      <li class="nav-item">

        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>

      </li>

    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item mt-1">
          <span class="dateday" id="dateday"></span>
          <span class="dateday" id="datedays"></span>
      </li>
      <li class="nav-item ml-2">
          <span class="datetime" id="datetime"></span>
      </li>
      
      <li class="nav-item ml-5">

        <a class="nav-link" href="salir"><i
            class="fas fa-power-off"></i> Salir</a>

      </li>

    </ul>

  </nav>
  <!-- /.navbar -->

  <script type="text/javascript">
    
    var datetime = null;
    var dateday = null;
    var datedays = null;
    date = null;

    var update = function () {
        date = moment(new Date());
        dateday.html(date.format('dddd'));
        datedays.html(date.format('Do MMM'));
        datetime.html(date.format('h:mm A'));
    };

    moment.locale('es');

    datetime = $('#datetime');
    dateday = $('#dateday');
    datedays = $('#datedays');
    update();
    setInterval(update, 1000);

  </script>