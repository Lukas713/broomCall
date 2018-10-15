<div class="modal fade" id="exampleModal_<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="zoom_08" src='<?php echo '../img/agreementImages/'.$row->id.'.jpg'; ?>'  width="100%" height="auto" alt="image" data-zoom-image="<?php echo '../img/agreementImages/'.$row->id.'.jpg'; ?>"/>
      </div>
    </div>
  </div>
</div>
