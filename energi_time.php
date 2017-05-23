 <script>
    var energi = <?php
          include "connect.php";
          $query = "SELECT fn_EN(energi_s0,energi_t0) AS energi FROM statistiks WHERE user_id='$_SESSION[id]';";
          $sql = mysqli_query($db, $query) or die("Query fail : ".mysqli_error($db));
          $stats = mysqli_fetch_assoc($sql);
          echo "$stats[energi]";
          mysqli_close($db);
        ?>;
    var myTime = setInterval(myDate, 1000);
    var ctr=0;
    function myDate() {
        var d = new Date();
        document.getElementById("date").innerHTML = d.toLocaleTimeString();
        ctr=ctr+1;
        if (ctr%5==0){
          ctr=0;
          if (energi <100){
          energi=energi+1;
          }
          document.getElementById("energi").innerHTML = energi;
        }
    }
  </script>