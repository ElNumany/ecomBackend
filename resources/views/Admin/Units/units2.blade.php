
<div class="span">

<form action="{{route('units')}}" method="POST">
  @csrf
  <div class="form-group">
    <label for="unit_name">Unit Name</label>
    <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit Name" required>
  </div>
  <div class="form-group">
    <label for="unit_code">Unit Code</label>
    <input type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Unit Code" required>
  </div>
  <button type="submit" class="btn btn-primary">Add Unit</button>
</form>
</div>

<span>
  <form action="{{route('units')}}" method="POST" style="position: relative">
          @csrf
          <input type="hidden" name="_method" value="delete" />
  <input type="hidden" name="unit_id" value="{{$unit->id}}">
  <button type="submit" style=".delete-btn"><i class="fas fa-trash"></i></button>
      </form>
  </span>



<div class="modal delete-window" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal edit-window" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>