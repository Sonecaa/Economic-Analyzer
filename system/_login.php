<?php
/**
 * Created by PhpStorm.
 * User: Marcelo
 * Date: 31/05/2018
 * Time: 23:33
 *
 *
 */

?>
<script>
    $(function () {

        $('form').on('submit', function (e) {

            e.preventDefault();

            $.ajax({
                type: 'post',
                url: '/economic-analyzer/system/CONTROLLER/loginController.php',
                data: $('form').serialize(),
                success: function () {
                    alert('form was submitted');
                    $('#myModal').modal('toggle');
                }
            });

        });

    });
</script>

<?php if(!isset($_SESSION['usuario'])): ?>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
<?php endif; ?>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Entrar no sistema
          </h4>
        </div>
        <div class="modal-body" style="background-color: #f3f3f3;">
            <form>
                <div class="form-group">
                    <input type="text" style="border:1px solid #c3c3c3;" class="form-control" placeholder="Login" name="username" required>
                    <br>

                <input type="password" style="border:1px solid #c3c3c3;" class="form-control" placeholder="Senha" name="password" required>
                </div>
                <input name="submit" class="btn btn-success" type="submit" value="Submit">

            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>