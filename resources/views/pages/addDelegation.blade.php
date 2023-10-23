@auth
@extends('layouts.layout')
@section("content")
<div class="container-fluid">
    @if(session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div>{{session('message')}}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div>{{session('error')}}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session()->get('user')->roles[0]->name === "admin")
        <livewire:add-vips/>
    @endif
    <div class="row">
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">New Delegation</h5>
                    <div class="table-responsive">
                        <form name="delegationBasicInfo" id="delegationBasicInfo" method="POST" action="{{route('request.addDelegationRequest')}}" enctype="multipart/form-data">
                            <fieldset>
                                <legend>Add Delegation Form</legend>
                                @csrf
                                <div class="mb-3">
                                    <label for="countryInput">Select Delegation Country</label>
                                    <input class="form-control" name="country" id="countryInput" placeholder="Select Country" list="countriesList" required>
                                    <datalist id="countriesList">
                                        <option value="Afghanistan"> Afghanistan </option>
                                        <option value="Albania"> Albania </option>
                                        <option value="Algeria"> Algeria </option>
                                        <option value="Andorra"> Andorra </option>
                                        <option value="Angola"> Angola </option>
                                        <option value="Antigua-and-Barbuda"> Antigua and Barbuda </option>
                                        <option value="Argentina"> Argentina </option>
                                        <option value="Armenia"> Armenia </option>
                                        <option value="Austria"> Austria </option>
                                        <option value="Azerbaijan"> Azerbaijan </option>
                                        <option value="Bahrain"> Bahrain </option>
                                        <option value="Bangladesh"> Bangladesh </option>
                                        <option value="Barbados"> Barbados </option>
                                        <option value="Belarus"> Belarus </option>
                                        <option value="Belgium"> Belgium </option>
                                        <option value="Belize"> Belize </option>
                                        <option value="Benin"> Benin </option>
                                        <option value="Bhutan"> Bhutan </option>
                                        <option value="Bolivia"> Bolivia </option>
                                        <option value="Bosnia-and-Herzegovina"> Bosnia and Herzegovina </option>
                                        <option value="Botswana"> Botswana </option>
                                        <option value="Brazil"> Brazil </option>
                                        <option value="Brunei"> Brunei </option>
                                        <option value="Bulgaria"> Bulgaria </option>
                                        <option value="Burkina-Faso"> Burkina Faso </option>
                                        <option value="Burundi"> Burundi </option>
                                        <option value="Cabo-Verde"> Cabo Verde </option>
                                        <option value="Cambodia"> Cambodia </option>
                                        <option value="Cameroon"> Cameroon </option>
                                        <option value="Canada"> Canada </option>
                                        <option value="Central-African-Republic"> Central African Republic </option>
                                        <option value="Chad"> Chad </option>
                                        <option value="Channel-Islands"> Channel Islands </option>
                                        <option value="Chile"> Chile </option>
                                        <option value="China"> China </option>
                                        <option value="Colombia"> Colombia </option>
                                        <option value="Comoros"> Comoros </option>
                                        <option value="Congo"> Congo </option>
                                        <option value="Costa-Rica"> Costa Rica </option>
                                        <option value="Côte-d-Ivoire"> Côte d Ivoire </option>
                                        <option value="Croatia"> Croatia </option>
                                        <option value="Cuba"> Cuba </option>
                                        <option value="Cyprus"> Cyprus </option>
                                        <option value="Czech-Republic"> Czech Republic </option>
                                        <option value="Denmark"> Denmark </option>
                                        <option value="Djibouti"> Djibouti </option>
                                        <option value="Dominica"> Dominica </option>
                                        <option value="Dominican-Republic"> Dominican Republic </option>
                                        <option value="DR-Congo"> DR Congo </option>
                                        <option value="Ecuador"> Ecuador </option>
                                        <option value="Egypt"> Egypt </option>
                                        <option value="El-Salvador"> El Salvador </option>
                                        <option value="Equatorial-Guinea"> Equatorial Guinea </option>
                                        <option value="Eritrea"> Eritrea </option>
                                        <option value="Estonia"> Estonia </option>
                                        <option value="Eswatini"> Eswatini </option>
                                        <option value="Ethiopia"> Ethiopia </option>
                                        <option value="Faeroe-Islands"> Faeroe Islands </option>
                                        <option value="Finland"> Finland </option>
                                        <option value="France"> France </option>
                                        <option value="French-Guiana"> French Guiana </option>
                                        <option value="Gabon"> Gabon </option>
                                        <option value="Gambia"> Gambia </option>
                                        <option value="Georgia"> Georgia </option>
                                        <option value="Germany"> Germany </option>
                                        <option value="Ghana"> Ghana </option>
                                        <option value="Gibraltar"> Gibraltar </option>
                                        <option value="Greece"> Greece </option>
                                        <option value="Grenada"> Grenada </option>
                                        <option value="Guatemala"> Guatemala </option>
                                        <option value="Guinea"> Guinea </option>
                                        <option value="Guinea-Bissau"> Guinea-Bissau </option>
                                        <option value="Guyana"> Guyana </option>
                                        <option value="Haiti"> Haiti </option>
                                        <option value="Holy-See"> Holy See </option>
                                        <option value="Honduras"> Honduras </option>
                                        <option value="Hong-Kong"> Hong Kong </option>
                                        <option value="Hungary"> Hungary </option>
                                        <option value="Iceland"> Iceland </option>
                                        <option value="India"> India </option>
                                        <option value="Indonesia"> Indonesia </option>
                                        <option value="Iran"> Iran </option>
                                        <option value="Iraq"> Iraq </option>
                                        <option value="Ireland"> Ireland </option>
                                        <option value="Isle-of-Man"> Isle of Man </option>
                                        <option value="Italy"> Italy </option>
                                        <option value="Jamaica"> Jamaica </option>
                                        <option value="Japan"> Japan </option>
                                        <option value="Jordan"> Jordan </option>
                                        <option value="Kazakhstan"> Kazakhstan </option>
                                        <option value="Kenya"> Kenya </option>
                                        <option value="Kuwait"> Kuwait </option>
                                        <option value="Kyrgyzstan"> Kyrgyzstan </option>
                                        <option value="Laos"> Laos </option>
                                        <option value="Latvia"> Latvia </option>
                                        <option value="Lebanon"> Lebanon </option>
                                        <option value="Lesotho"> Lesotho </option>
                                        <option value="Liberia"> Liberia </option>
                                        <option value="Libya"> Libya </option>
                                        <option value="Liechtenstein"> Liechtenstein </option>
                                        <option value="Lithuania"> Lithuania </option>
                                        <option value="Luxembourg"> Luxembourg </option>
                                        <option value="Macao"> Macao </option>
                                        <option value="Madagascar"> Madagascar </option>
                                        <option value="Malawi"> Malawi </option>
                                        <option value="Malaysia"> Malaysia </option>
                                        <option value="Maldives"> Maldives </option>
                                        <option value="Mali"> Mali </option>
                                        <option value="Malta"> Malta </option>
                                        <option value="Mauritania"> Mauritania </option>
                                        <option value="Mauritius"> Mauritius </option>
                                        <option value="Mayotte"> Mayotte </option>
                                        <option value="Mexico"> Mexico </option>
                                        <option value="Moldova"> Moldova </option>
                                        <option value="Monaco"> Monaco </option>
                                        <option value="Mongolia"> Mongolia </option>
                                        <option value="Montenegro"> Montenegro </option>
                                        <option value="Morocco"> Morocco </option>
                                        <option value="Mozambique"> Mozambique </option>
                                        <option value="Myanmar"> Myanmar </option>
                                        <option value="Namibia"> Namibia </option>
                                        <option value="Nepal"> Nepal </option>
                                        <option value="Netherlands"> Netherlands </option>
                                        <option value="Nicaragua"> Nicaragua </option>
                                        <option value="Niger"> Niger </option>
                                        <option value="Nigeria"> Nigeria </option>
                                        <option value="North-Korea"> North Korea </option>
                                        <option value="North-Macedonia"> North Macedonia </option>
                                        <option value="Norway"> Norway </option>
                                        <option value="Oman"> Oman </option>
                                        <option value="Pakistan"> Pakistan </option>
                                        <option value="Panama"> Panama </option>
                                        <option value="Paraguay"> Paraguay </option>
                                        <option value="Peru"> Peru </option>
                                        <option value="Philippines"> Philippines </option>
                                        <option value="Poland"> Poland </option>
                                        <option value="Portugal"> Portugal </option>
                                        <option value="Qatar"> Qatar </option>
                                        <option value="Réunion"> Réunion </option>
                                        <option value="Romania"> Romania </option>
                                        <option value="Russia"> Russia </option>
                                        <option value="Rwanda"> Rwanda </option>
                                        <option value="Saint-Helena"> Saint Helena </option>
                                        <option value="Saint-Kitts-and-Nevis"> Saint Kitts and Nevis </option>
                                        <option value="Saint-Lucia"> Saint Lucia </option>
                                        <option value="Saint-Vincent-and-the-Grenadines"> Saint Vincent and the Grenadines </option>
                                        <option value="San-Marino"> San Marino </option>
                                        <option value="Sao-Tome-&amp;-Principe"> Sao Tome &amp; Principe </option>
                                        <option value="Saudi-Arabia"> Saudi Arabia </option>
                                        <option value="Senegal"> Senegal </option>
                                        <option value="Serbia"> Serbia </option>
                                        <option value="Seychelles"> Seychelles </option>
                                        <option value="Sierra-Leone"> Sierra Leone </option>
                                        <option value="Singapore"> Singapore </option>
                                        <option value="Slovakia"> Slovakia </option>
                                        <option value="Slovenia"> Slovenia </option>
                                        <option value="Somalia"> Somalia </option>
                                        <option value="South-Africa"> South Africa </option>
                                        <option value="South-Korea"> South Korea </option>
                                        <option value="South-Sudan"> South Sudan </option>
                                        <option value="Spain"> Spain </option>
                                        <option value="Sri-Lanka"> Sri Lanka </option>
                                        <option value="State-of-Palestine"> State of Palestine </option>
                                        <option value="Sudan"> Sudan </option>
                                        <option value="Suriname"> Suriname </option>
                                        <option value="Sweden"> Sweden </option>
                                        <option value="Switzerland"> Switzerland </option>
                                        <option value="Syria"> Syria </option>
                                        <option value="Taiwan"> Taiwan </option>
                                        <option value="Tajikistan"> Tajikistan </option>
                                        <option value="Tanzania"> Tanzania </option>
                                        <option value="Thailand"> Thailand </option>
                                        <option value="The-Bahamas"> The Bahamas </option>
                                        <option value="Timor-Leste"> Timor-Leste </option>
                                        <option value="Togo"> Togo </option>
                                        <option value="Trinidad-and-Tobago"> Trinidad and Tobago </option>
                                        <option value="Tunisia"> Tunisia </option>
                                        <option value="Turkey"> Turkey </option>
                                        <option value="Turkmenistan"> Turkmenistan </option>
                                        <option value="Uganda"> Uganda </option>
                                        <option value="Ukraine"> Ukraine </option>
                                        <option value="United-Arab-Emirates"> United Arab Emirates </option>
                                        <option value="United-Kingdom"> United Kingdom </option>
                                        <option value="United-States"> United States </option>
                                        <option value="Uruguay"> Uruguay </option>
                                        <option value="Uzbekistan"> Uzbekistan </option>
                                        <option value="Venezuela"> Venezuela </option>
                                        <option value="Vietnam"> Vietnam </option>
                                        <option value="Western-Sahara"> Western Sahara </option>
                                        <option value="Yemen"> Yemen </option>
                                        <option value="Zambia"> Zambia </option>
                                        <option value="Zimbabwe"> Zimbabwe </option>
                                    </datalist>
                                </div>
                                <div class="mb-3">
                                    <label for="invitedBy" class="form-label">Invited By</label>
                                    <input name="invitedBy" list="invitedByList"class="form-control" id="invitedBy" placeholder="Select Invited By" required>
                                    <datalist id="invitedByList">

                                        <option value="Afghanistan"> Afghanistan </option>
                                    </datalist>
                                </div>
                                <div class="mb-3">
                                    <label for="startDate" class="form-label">Event Start Date</label>
                                    <input name="startDate" type="date" class="form-control" id="startDate" placeholder="delegation Start Date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="endDate" class="form-label">Event End Date</label>
                                    <input name="endDate" type="date" class="form-control" id="endDate" placeholder="delegation End Date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="days" class="form-label">Number Of Days</label>
                                    <input name="days" type="number" class="form-control" id="days" placeholder="delegation Number Of Days" required>
                                </div>
                                <div class="mb-3">
                                    <label for="delegationVenue" class="form-label">Event Venue</label>
                                    <input name="delegationVenue" type="text" class="form-control" id="delegationVenue" placeholder="delegation Venure" required>
                                </div>
                                <div class="mb-3">
                                    <label for="delegationDescription" class="form-label">Event Description</label>
                                    <input name="delegationDescription" type="text" class="form-control" id="delegationDescription" placeholder="delegation Description">
                                </div>
                                <div class="mb-3">
                                    <label for="delegationBanner" class="form-label">Event Banner</label>
                                    <input type="file" class="form-control" id="delegationBanner" name="delegationBanner" accept="image/png, image/jpeg" required>
                                </div>
                                <input type="hidden" name="uid" value="{{session('user')->uid}}" />
                                <input type="submit" name="submit" class="btn btn-primary" value="Add Event" />
                            </fieldset>
                        </form>
                    </div>
                    <br />
                    <script async src="https://unpkg.com/axios/dist/axios.min.js"></script>
                    <script async src="{{asset('assets/js/formValidations.js')}}"></script>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@endauth