<?php include_once "config.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once "template/head.php"; ?>
        <style>

        </style>
    </head>

    <body>
        <?php include_once "template/navigation.php"; ?>
        <br> <hr>
        <div class="grid-container">
            <div class="row justify-content-center">
                <div class="col col-md-3">
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Order cleaning service
                        </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderAgreement">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                               
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Create order</button>
                                </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <?php include_once "template/footer.php"; ?>
        <?php include_once "template/scripts.php"; ?>
    </body>
</html>