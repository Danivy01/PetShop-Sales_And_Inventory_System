<div class="col-lg-12">
            <?php
              $fn = $_POST['first_name'];
              $ln = $_POST['last_name'];
              $pn = $_POST['phone_num'];
        
              switch($_GET['action']){
                case 'add':     
                    $query = "INSERT INTO customer
                    (customer_id, first_name, last_name, phone_num)
                    VALUES (Null,'{$fn}','{$ln}','{$pn}')";
                    mysqli_query($db,$query)or die ('Error in updating Database');
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "customer.php";
              </script>
          </div>

