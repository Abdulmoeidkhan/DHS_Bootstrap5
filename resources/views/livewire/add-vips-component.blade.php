<form wire:submit="save">
    <div class="modal-body">
        <div class="mb-3">
            <label for="vipName" class="col-form-label">VIP's Name :</label>
            <input type="text" class="form-control" wire:model="name">
        </div>
        <div class="mb-3">
            <label for="message-text" class="col-form-label">Designation:</label>
            <input type="text" class="form-control" wire:model="designation">
        </div>
        <div class="mb-3">
            <label for="message-text" class="col-form-label">Rank:</label>
            <input type="text" class="form-control" wire:model="rank">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
    </div>
</form>