<form wire:submit="save">
    <div class="modal-body">
        <div class="mb-3">
            <label for="message-text" class="col-form-label">Rank:</label>
            <input type="text" id="message-text" class="form-control {{$errorStatus == true ? 'is-invalid':''}}" wire:model="rank" required>
            @if($errorStatus == true)
            <div class="invalid-feedback">
                {{$errorMsg}}
            </div>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </br>
        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
    </div>
</form>