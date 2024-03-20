@auth
@extends('layouts.layout')
@section("content")
<div class="modal fade" id="invitationNumberModal" tabindex="-1" aria-labelledby="invitationNumberModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Invitation Number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action='{{route("request.invitaionNumberUpdate")}}'>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="delegationUid" value="" id="delegationUid" />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="number" placeholder="Invitation Number" name="invitaionNumber" value="" id="invitaionNumber" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Badges</h5>
            <div class="table-responsive">
                <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getDelegates',1)}}">
                    <thead>
                        <tr>
                            <th data-formatter="operateSerial" data-filter-control="input">S.No.</th>
                            <th data-field="country" data-filter-control="input" data-sortable="true">Country</th>
                            <th data-field="delegationCode" data-filter-control="input" data-sortable="true">Delegation Code</th>
                            <th data-field="rankName.ranks_name" data-filter-control="input" data-sortable="true">Rank</th>
                            <th data-field="first_Name" data-filter-control="input" data-sortable="true">First Name</th>
                            <th data-field="last_Name" data-filter-control="input" data-sortable="true">Last Name</th>
                            <th data-field="vips_designation" data-filter-control="input" data-sortable="true">Invited By</th>
                            <th data-field="delegation_type" data-filter-control="input" data-formatter="operateText" data-sortable="true">Self/Rep</th>
                            <th data-field="delegation_status" data-filter-control="input" data-sortable="true" data-formatter="statusFormatter">Delegation Active</th>
                            <th data-field="isHead" data-filter-control="input" data-sortable="true">Delegation Head</th>
                            <th data-field="invitation_number" data-filter-control="input" data-sortable="true">Invitation Number</th>
                            <th data-field="img_blob" data-width="150" data-sortable="true" data-formatter="operatePicture" data-force-hide="true">Image</th>
                            <th data-field="delegates_uid" data-width="200" data-sortable="true" data-formatter="operatePlans">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function operatePlans(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-invitation="' + row.invitation_number + '" data-bs-delegation="' + value + '" data-bs-target="#invitationNumberModal">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dialpad" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 3h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /><path d="M18 3h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /><path d="M11 3h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /><path d="M4 10h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /><path d="M18 10h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /><path d="M11 10h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /><path d="M11 17h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1z" /></svg>',
                '</button>',
                '&nbsp;&nbsp;&nbsp;',
                '<a class="btn btn-outline-primary" target="_blank" href="printDelegationBadge/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id-badge-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 12h3v4h-3z" /><path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6" /><path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M14 16h2" /><path d="M14 12h4" /></svg>',
                '</a>',
                '&nbsp;&nbsp;&nbsp;',
                '<a class="btn btn-outline-success" target="_blank"  href="printDelegationEnvelope/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-opened" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l9 6l9 -6l-9 -6l-9 6" /><path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" /><path d="M3 19l6 -6" /><path d="M15 13l6 6" /></svg>',
                '</a>',
                '</div>'
            ].join('')
        }
    }

    function operateSerial(value, row, index) {
        return index + 1;
    }

    function operateText(value, row, index) {
        return value ? value : "-"
    }

    function operateSelf(value, row, index) {
        console.log(row)
        return !value ? 'Rep' : 'Self';
    }

    function statusFormatter(value, row, index) {
        return value ? ['<div class="left">', 'Yes', '</div>'].join('') : ['<div class="left">', 'No', '</div>'].join('');
    }

    const invitationNumberModal = document.getElementById('invitationNumberModal')
    invitationNumberModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const delegation = button.getAttribute('data-bs-delegation')
        const invitation = button.getAttribute('data-bs-invitation')
        const modalBodyInput = invitationNumberModal.querySelector('.modal-body #delegationUid')
        modalBodyInput.value = delegation
        const modalBodyInputInvitation = invitationNumberModal.querySelector('.modal-body #invitaionNumber')
        modalBodyInputInvitation.value = invitation
    })

    function operatePicture(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<img src="' + value + '" width="80px" height="80px"/>',
                '</div>'
            ].join('')
        }
    }
</script>
@include("layouts.tableFoot")
@endsection
@endauth