<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <title>Promotions Edit</title>
    </head>
        <body>
        <?php $request = \Config\Services::request();  ?>
        <div class="container-fluid" style="margin-top:100px; padding-right:50px; padding-left:50px;">
            <div class="card">
                <div class="card-header">
                    <div class="pull-right">
                        <h4>Promotions Edit</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/promotions/update/<?= $request->uri->getSegments()[2] ?>" method="post">
                    <?= csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="<?= $promotion['name'] ?>" placeholder="Enter Promotions Name">
                            </div>
                            <div class="form-group col-6">
                                <label>Type</label>
                                <select class="form-control" name="type">
                                    <option selected="true" disabled="disabled">Silahkan Pilih</option>
                                    <option value="DISCOUNT" <?php if($promotion['type'] == 'DISCOUNT') { ?>  selected <?php } ?>>Discount</option>
                                    <option value="CASHBACK" <?php if($promotion['type'] == 'CASHBACK') { ?>  selected <?php } ?>>Cashback</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Amount</label>
                                <input type="number" class="form-control" name="amount" value="<?= $promotion['amount'] ?>" placeholder="Amount">
                            </div>
                            <div class="form-group col-6">
                                <label>Max Amount</label>
                                <input type="number" class="form-control" name="max_amount" value="<?= $promotion['max_amount'] ?>" placeholder="Amount">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Publish Start</label>
                                <input type="date" class="form-control" value="<?= date('Y-m-d', strtotime($promotion['publish_start'])) ?>" name="publish_start">
                            </div>
                            <div class="form-group col-6">
                                <label>Publish End</label>
                                <input type="date" class="form-control" value="<?= date('Y-m-d', strtotime($promotion['publish_end'])) ?>" name="publish_end">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Booking Start</label>
                                <input type="date" class="form-control" value="<?= date('Y-m-d', strtotime($promotion['booking_start'])) ?>" name="booking_start">
                            </div>
                            <div class="form-group col-6">
                                <label>Booking End</label>
                                <input type="date" class="form-control" value="<?= date('Y-m-d', strtotime($promotion['booking_end'])) ?>" name="booking_end">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Stay Start</label>
                                <input type="date" class="form-control" value="<?= date('Y-m-d', strtotime($promotion['stay_start'])) ?>" name="stay_start">
                            </div>
                            <div class="form-group col-6">
                                <label>Stay End</label>
                                <input type="date" class="form-control" value="<?= date('Y-m-d', strtotime($promotion['stay_end'])) ?>"  name="stay_end">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Filter Hotel</label>
                                <select class="form-control" name="is_all_properties" id="is_all_properties">
                                    <option selected="true" disabled="disabled">Silahkan Pilih</option>
                                    <option value="0" <?php if($promotion['is_all_properties'] == '0') { ?>  selected <?php } ?>>Include</option>
                                    <option value="1" <?php if($promotion['is_all_properties'] == '1') { ?>  selected <?php } ?>>All</option>
                                </select>
                            </div>
                            <div class="form-group col-6" id="properties1" style="display:none;">
                                <label>Hotel</label>
                                <select class="form-control" name="properties" id="properties">
                                    <option selected="true" disabled="disabled">Silahkan Pilih</option>
                                    <?php foreach($properties as $row) { ?>
                                        <option value="<?= $row['id'] ?>" <?php if($promotion['property_id'] == $row['id']) { ?>  selected <?php } ?>><?= $row['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6" id="properties2" style="display:none;">
                                <label>Filter Room</label>
                                <select class="form-control" name="is_all_room" id="is_all_room">
                                    <option selected="true" disabled="disabled">Silahkan Pilih</option>
                                    <option value="0" <?php if($promotion['is_all_rooms'] == '0') { ?>  selected <?php } ?>>Include</option>
                                    <option value="1" <?php if($promotion['is_all_rooms'] == '1') { ?>  selected <?php } ?>>All</option>
                                </select>
                            </div>
                            <div class="form-group col-6" id="rooms" style="display:none;">
                                <label>Room</label>
                                <select class="form-control" name="room" id="room">
                                    <option selected="true" disabled="disabled">Silahkan Pilih</option>
                                    <?php foreach($rooms as $row) { ?>
                                        <option value="<?= $row['id'] ?>" <?php if($promotion['room_id'] == $row['id']) { ?>  selected <?php } ?>><?= $row['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>  

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                var is_all_props    = $('#is_all_properties').val();
                var is_all_room     = $('#is_all_room').val();
                if(is_all_props === '0') {
                    $('#properties1').show();
                    $('#properties2').show();
                } else {
                    $('#properties1').hide();
                    $('#properties2').hide();
                }

                if(is_all_room === '0') {
                    $('#rooms').show();
                } else {
                    $('#rooms').hide();
                }

                $(document).on('change', '#is_all_properties', function(event){
                    var is_all_props    = $('#is_all_properties').val();
                    if(is_all_props === '0') {
                        $('#properties1').show();
                        $('#properties2').show();
                    } else {
                        $('#properties1').hide();
                        $('#properties2').hide();
                    }
                });

                $(document).on('change', '#is_all_room', function(event){
                    var is_all_room     = $('#is_all_room').val();
                    if(is_all_room === '0') {
                        $('#rooms').show();
                    } else {
                        $('#rooms').hide();
                    }
                });
            });
        </script>
    </body>
</html>