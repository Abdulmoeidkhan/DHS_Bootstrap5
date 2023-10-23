<div class="row">
    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#VIPModal">Add VIP'S</button>
        <div class="modal fade" id="VIPModal" tabindex="-1" aria-labelledby="VIPModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">VIP's Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($savedvip)
    <script>
        let myModal = document.getElementById('VIPModal');
        myModal.hide()
        console.log("workings")
    </script>
    @endif
</div>