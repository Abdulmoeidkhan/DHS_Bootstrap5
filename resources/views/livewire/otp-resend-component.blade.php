<div>

    @if($showformComponent)
    <form wire:submit="save">
        <div class="mb-3">
            <label for="otp-email" class="form-label" >Email Address</label>
            <input type="otp-email" class="form-control" id="otp-email" name="otp-email" wire:model='otpEmail'>
        </div>
        <input type="submit" name="otp-send" value="OTP resend" class="btn btn-badar w-100 py-8 fs-4 mb-4 rounded-2" />
    </form>
    @else
    <div class="d-flex align-items-center justify-content-center">
        <p class="fs-4 mb-0 fw-bold">OTP not recieved?</p>
        <a class="text-badar fw-bold ms-2" href="#" wire:click.prevent="showForm">{{$compName}}</a>
    </div>
    @endif
</div>