<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Promotions Crud</title>
  </head>
  <body>
  <div class="container-fluid" style="margin-top:100px; padding-right:50px; padding-left:50px;">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div>
                    <a href="/promotions/create" class="btn btn-primary">Create</a>
                </div>
                <div style="margin-left:auto">
                    <a href="/logout" class="btn btn-light">Logout</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Author</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Max Amount</th>
                        <th scope="col">Publish Start</th>
                        <th scope="col">Publish End</th>
                        <th scope="col">Booking Start</th>
                        <th scope="col">Booking End</th>
                        <th scope="col">Stay Start</th>
                        <th scope="col">Stay End</th>
                        <th scope="col">Is All</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($promotions as $key => $row) : ?>
                        <tr>
                            <th scope="row"><?= $key+1 ?>.</th>
                            <td><?= $row['author_id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['type'] ?></td>
                            <td><?= $row['amount'] ?></td>
                            <td><?= $row['max_amount'] ?></td>
                            <td><?= $row['publish_start'] ?></td>
                            <td><?= $row['publish_end'] ?></td>
                            <td><?= $row['booking_start'] ?></td>
                            <td><?= $row['booking_end'] ?></td>
                            <td><?= $row['stay_start'] ?></td>
                            <td><?= $row['stay_end'] ?></td>
                            <td><?php if($row['is_all_properties'] == 0) { 
                                
                                ?> 

                            <?php } ?></td>
                            <td>
                                <a href="/promotions/edit/<?= $row['id'] ?>" class="btn btn-info">Edit</a>
                                <a href="/promotions/delete/<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin Akan Menghapus Data ?');">Delete</a>
                                <!-- Delete -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>