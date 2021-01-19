@include('backend.templates.head-tag-links',['page_title'=>'Leads Summary Page'])
@include('backend.templates.left-menu-view')
<!--<link rel="stylesheet" type="text/css"
   href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">-->
<style>
    .abc-checkbox {
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .test {
        height: 100px;
        overflow: scroll;
        white-space: nowrap;
        width: 200px;
    }
    .logo
    {
        font-size: 17px;
        padding-left: 5px;
        font-weight: bold;
    }
    .sub_d
    {
        font-size: 10px;
    }
    .agent-style
    {
        word-spacing: -5px;
        margin-left: 2px;
        color: black;
    }
    table tr:hover {
        background-color: #1885c433 !important;
    }

    .glyphicon-search, .glyphicon-user {
        color: #868686 !important;
    }
    .glyphicon {
        color: #cccccc;
    }
    .sea {
        color: white !important;
    }
    /*table th {
    font-weight: normal;
    }*/
    .btn-lg {
        border: 2px solid white;
    }

    .btn-default {
        border: 1px solid #0f3861;
    }
    .btn-default:hover {
        background-color: #0f3861; /* Green */
        color: white;
        border: 1px solid white;
    }
    small {
        font-size: 10px;
    }

    .table td  ul {
        list-style: none;
        margin: 10px;
    }
    .dropdown-item:nth-child(even) {
        background-color: transparent;
    }
    .dropdown-item:hover{
        background-color: #1885c433 !important;
    }
    .btn_list{
        border: 5px solid white;
        margin-right: 4px;
    }
    input:focus{
        border-color: #1790d8 !important;
    }
    .modal-footer {
        justify-content: flex-end;
    }
    @media (min-width: 1024px){
        .col-form-label {
            text-align: left;
        }
    }
    /*Added By Pranv sir - 05|11|2020*/
    div.dataTables_wrapper div.dataTables_processing {
        position: absolute;
        top: 40%;
        left: 50%;
        width: 300px;
        margin-left: -100px;
        margin-top: -26px;
        text-align: center;
        padding: 3em 0;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading" >
    <div class="col-sm-10 pb-2">
        <h2 style="color: #168ed7;">Lead Summary</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a >Leads</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Lead Summary</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-2">
        <!-- <button class="btn btn-sm btn-primary btn-xs" value="Take a tour!" style="color:white;float:right;background-color:#70BB2E;package:0;">TAKE A TOUR!
           </button> -->
    </div>
</div>
<br/>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12" style="color:white;">
            <center>
            <span>
            <a class="btn btn-w-m btn-success btn_list" href="{{ route('crm-add-new-leads') }}">
            <i class="glyphicon glyphicon-plus sea"></i> Add Lead
            </a>
            <button class="btn btn-w-m btn-success btn_list" id="delete-all">
            <i class="glyphicon glyphicon-export sea"></i> Delete All Leads
            </button>
            <a class="btn btn-w-m btn-success btn_list" href="{{ route('crmbulkimportview') }}">
            <i class="glyphicon glyphicon-import sea"></i> Import Lead
            </a>
            <button class="btn btn-w-m btn-success btn_list" data-toggle="modal" data-target="#myModal2">
            <i class="glyphicon glyphicon-search sea"></i> Advance Search
            </button>
{{--             Button added by Shital Maam - on 4|11|2020   --}}
            <button class="btn btn-w-m btn-success btn_list" onclick="window.open('{{ route('export_csv') }}');">
            <i class="glyphicon glyphicon-export sea"></i> Export CSV
            </button>
{{--            Button added by Shital Maam - on 4|11|2020  end   --}}
            </span>
            </center>
        </div>
    </div>
</div>
<!---table start here-->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="table_data" width="100%">
                            <thead>
                            <tr style="background-color:#e6e6e6;font-weight:normal;">
                                <th>
                                     <input type="checkbox" class="select_all" name="select_all" id="select_all">
                               </th>
{{--                                Edited by  Zaid on 30-10-2020--}}
                                <th>
                                    <label>All</label>
                                    <br>
                                    <input type="checkbox" id="selectAll" class="main">
                                </th>
{{--                                For searching email and for number  Added on- 31|10|2020 start --}}
                                <th style="display: none">
                                  Phone
                                </th>
                                <th style="display: none">
                                  Email
                                </th>
{{--                                For searching email and for number  Added on- 31|10|2020 end --}}
                                <th style="width:170px">
                                    NAME<br/><small>Phone<br>Email</br>Assigned To</small>
                                </th>
                                <th>FUNNEL</th>
                                <th>FUNNEL LIST</th>
                                <th>LEAD ADDED</th>
                                <th>FOLLOW UP
                                    <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="Follow Up shows the next action due and recent successful interactions."></i>
                                    <br/>
                                    <small>Due<br/>Last Interaction</small>
                                </th>
                                <th>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 text-center">CONVERSATIONS</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><small>Calls<br/>Last</small></div>
                                            <div class="col-md-4"><small>Emails<br/>Last</small></div>
                                            <div class="col-md-4"><small>Notes<br/>Last</small></div>
                                        </div>
                                    </div>
                                </th>
                                <!--  <th>Emails<br/><small>Last</small></th>
                                   <th>Notes<br/><small>Last</small></th> -->
                                <th>Activity<br/><small>Alerts Opened</small></th>
                                <th class="campagin_running">Campaign Running</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group row">
                <div class="col-sm-5">
                    <label class="col-form-label">Bulk Action</label>
                    <select class="select2 form-control" name="act_available" id="act_available">
                        <option value="" disabled selected hidden>Action Available</option>
                        <option value="1">Delete Lead</option>
                        <option value="2">Attach campaign</option>
                        <option value="3">Assign Agent</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Chapter Modal -->
<div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header" style="background-color: #168ed7;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Advance Search</h4>
            </div>
            <form id="apply_filter">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Lead Search</label>
                        <div class="col-sm-4">
                            <input type="text" name="lead_search" id="lead_search" placeholder="Lead Search"
                                   class="form-control">
                        </div>
                        <label class="col-sm-2 col-form-label ">Lead Source</label>
                        <div class="col-sm-4">
                            <select class="select2 form-control" name="lead_source" id="lead_source">
                                <option value="" disabled selected hidden>Select Lead Source</option>
                                <option value="1">Manual Entry</option>
                                <option value="2">Webhook</option>
                                <option value="3">CSV Import</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label ">First Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="first_name" id="first_name" required
                                   data-msg-required="Frist Name Required" placeholder="First Name"
                                   class="form-control">
                        </div>
                        <label class="col-sm-2 col-form-label ">Last Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="last_name" id="last_name" required
                                   data-msg-required="Last Name Required" placeholder="Last Name"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label ">Tags</label>
                        <div class="col-sm-4">
                            <input type="text" name="tags" id="tags" data-msg-required="Tags Required"
                                   placeholder="Tags" class="form-control" multiple>
                        </div>
                        <label class="col-sm-2 col-form-label ">Email</label>
                        <div class="col-sm-4">
                            <input type="text" name="email_data" id="email_data" placeholder="Email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label ">Registered in last</label>
                        <div class="col-sm-4">
                            <input type="text" name="reg_last" id="reg_last" data-msg-required="Tags Required"
                                   placeholder="Number Of days" class="form-control">
                        </div>
                        <label class="col-sm-2 col-form-label ">Email Validity</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="email_validity" id="email_validity"
                                    data-msg-required="Please select Option">
                                <option value="" disabled selected hidden>Email Validity</option>
                                <option value="1">VALID Email Address Only</option>
                                <option value="2">INVALID Email Address Only</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" style="display: none">
                        <label class="col-sm-2 col-form-label ">Source Code (mbsource)</label>
                        <div class="col-sm-4">
                            <input type="text" name="mbsource" id="mbsource" data-msg-required="Tags Required"
                                   placeholder="mbsource" class="form-control">
                        </div>
                        <label class="col-sm-2 col-form-label ">Interest</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="interest" id="interest"
                                    data-msg-required="Please select Option">
                                <option value="" disabled selected hidden>Interest</option>
                                <option value="1">Buyer</option>
                                <option value="2">Seller</option>
                                <option value="2">Investor</option>
                            </select>
                        </div>
                    </div>
{{--                    New code for phone number 29|10--}}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label ">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone_numbers" id="phone_numbers" data-msg-required="Phone Number
                            Required" placeholder="Phone Number" class="form-control">
                        </div>
                    </div>
{{--                    end--}}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label ">Select Campaign</label>
                        <div class="col-sm-10">
                            <select class="select2 form-control" name="campaign_id" id="campaign_id" required>
                                <option></option>
                                @foreach( $campaign as $c)
                                    <option value="{{ $c['_id']}}">{{ $c['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <h3 style="font-weight: bold;">Purchase Profile</h3>
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label ">TimeFrame</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="time_frame" id="time_frame">
                                <option value="" disabled selected hidden>Select Timeframe</option>
                                <option value="0">Unknown</option>
                                <option value="1">Now</option>
                                <option value="2">Within 3 Months</option>
                                <option value="3">3 to 6 Months</option>
                                <option value="4">6 to 12 Months</option>
                                <option value="5">1+ Year(s)</option>
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label ">Working with an Agent?</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="buyer_agency_agreement" id="buyer_agency_agreement"
                                    data-msg-required="Please Select Option">
                                <option value="" disabled selected hidden>Working with an Agent?</option>
                                <option value="0">Unknown, Not Sure</option>
                                <option value="1">No, Does Not Have Agent Agreement</option>
                                <option value="2">Yes, Has Agent Agreement</option>
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label ">Mortgage Status</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="mortgage_status" id="mortgage_status">
                                <option value="" disabled selected hidden>Select Mortgage Status</option>
                                <option value="1">Need One</option>
                                <option value="2">Prequalified</option>
                                <option value="3">None</option>
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label ">City</label>
                        <div class="col-sm-4">
                            <input type="text" name="city" id="city" data-msg-required="Tags Required"
                                   placeholder="City" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <h3 style="font-weight: bold;">ASSIGNMENTS</h3>
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label ">Agent Assigned</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="agent_assigned" id="agent_assigned" required
                                    data-msg-required="Please Select Option">
                                <option value="" disabled selected hidden>Agent Assigned</option>
                                @foreach( $users as $user)
                                    <option
                                        value="{{ $user['_id']}}">{{ $user['first_name'] }} {{ $user['last_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label ">Loan Officer Assigned</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="loan_officer_assigned" id="loan_officer_assigned"
                                    required data-msg-required="Please Select Option">
                                <option value="" disabled selected hidden>Loan Officer</option>
                                @foreach( $users as $user)
                                    <option
                                        value="{{ $user['_id']}}">{{ $user['first_name'] }} {{ $user['last_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label ">Assistant Assigned</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="assistant_assigned" id="assistant_assigned" required
                                    data-msg-required="Please Select Option">
                                <option value="" disabled selected hidden>Assistant Assigned</option>
                                @foreach( $users as $user)
                                    <option
                                        value="{{ $user['_id']}}">{{ $user['first_name'] }} {{ $user['last_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label ">Other Assigned</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="other_assigned" id="other_assigned" required
                                    data-msg-required="Please Select Option">
                                <option value="" disabled selected hidden>Other Assigned</option>
                                @foreach( $users as $user)
                                    <option
                                        value="{{ $user['_id']}}">{{ $user['first_name'] }} {{ $user['last_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="lead_data()" class="btn btn-w-m btn-success">Apply filter</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal -->
<!--user assign Modal -->
<div class="modal inmodal" id="act_user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header" style="background-color: #168ed7;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Advance Search</h4>
            </div>
            <form id="apply_filter">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label ">Agent Assigned</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="agent_assigned" id="act_agent_assigned" required
                                    data-msg-required="Please Select Option">
                                <option value="" disabled selected hidden>Agent Assigned</option>
                                @foreach( $users as $user)
                                    <option
                                        value="{{ $user['_id']}}">{{ $user['first_name'] }} {{ $user['last_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label ">Loan Officer Assigned</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="loan_officer_assigned" id="act_loan_officer_assigned"
                                    required data-msg-required="Please Select Option">
                                <option value="" disabled selected hidden>Loan Officer</option>
                                @foreach( $users as $user)
                                    <option
                                        value="{{ $user['_id']}}">{{ $user['first_name'] }} {{ $user['last_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label ">Assistant Assigned</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="assistant_assigned" id="act_assistant_assigned" required
                                    data-msg-required="Please Select Option">
                                <option value="" disabled selected hidden>Assistant Assigned</option>
                                @foreach( $users as $user)
                                    <option
                                        value="{{ $user['_id']}}">{{ $user['first_name'] }} {{ $user['last_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Other Assigned</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="other_assigned" id="act_other_assigned" required
                                    data-msg-required="Please Select Option">
                                <option value="" disabled selected hidden>Other Assigned</option>
                                @foreach( $users as $user)
                                    <option
                                        value="{{ $user['_id']}}">{{ $user['first_name'] }} {{ $user['last_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="assign_user()" class="btn btn-w-m btn-success">Assign</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal -->
<!--user assign Modal -->
<div class="modal inmodal" id="act_campaign" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header"  style="background-color: #168ed7;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Advance Search</h4>
            </div>
            <form id="attach_campaign_form">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Select Campaign</label>
                        <div class="col-sm-10">
                            <select class="select2 form-control" name="campaign_id" id="act_campaign_id">
                                <option></option>
                                @foreach( $campaign as $c)
                                    <option value="{{ $c['_id']}}">{{ $c['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Start Date </label>
                        <div class="col-lg-10">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control datepicker valid" name="date" required=""
                                       data-msg-required="Please provide exam Date" data-rule-date="date"
                                       data-msg-date="Invalid date format. Allowed mm/dd/YYYY" value="{{date('m/d/Y')}}"
                                       aria-required="true" aria-invalid="false" id="act_date">
                            </div>
                            <small>Select the date you want the campaign to start</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label ">Message Send Time</label>
                        <div class="col-sm-10">
                            <select class="select2 form-control" name="message_time" id="act_message_time">
                                <option value="5 AM">Early Morning (5 AM)</option>
                                <option value="8 AM">Morning (8 AM)</option>
                                <option value="11 AM">Noon</option>
                                <option value="3 PM">After Noon (3 PM)</option>
                                <option value="8 PM">Evening (8 PM)</option>
                                <option value="11 PM">Midnight</option>
                            </select>
                            <small>Select the time of day you would like emails / SMS to be sent to this lead.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label ">How To Apply</label>
                        <div class="col-sm-10">
                            <fieldset>
                                <div class="i-checks">
                                    <label><input type="radio" value="1" name="how_to_apply"> <i></i> This should be the
                                        ONLY campaign - remove any other campaigns applied to this lead</label>
                                </div>
                                <div class="i-checks">
                                    <label> <input type="radio" value="2" name="how_to_apply"><i></i> Keep existing
                                        campaigns and apply this campaign in addition</label>
                                </div>
                                <small>Select how you want to apply the campaign</small>
                            </fieldset>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label ">Start at beginning?</label>
                        <div class="col-sm-10">
                            <select class="select2 form-control" name="start_at" id="start_at">
                                <option value="1">YES, start campaign from beginning (Step 1)</option>
                                <option value="2">NO, I would like to choose which step to begin on</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="activity">
                        <label class="col-sm-2 col-form-label ">Which Step to Begin On?</label>
                        <div class="col-sm-10">
                            <select class="select2 form-control" name="step" id="step">
                            </select>
                            <small>Select the step you wish to start on</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-w-m btn-success">Assign</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal -->
@include('backend.templates.footer-view')
@include('backend.templates.script-links')
@include('backend.templates.dialpad-with-merge')
<script>
    var editor;
    var leads = [];
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });


        $('[data-toggle="tooltip"]').tooltip();

        $("#delete-all").click(function () {
            var did = $(this).attr("data-id");
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover the leads!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "{{ route('ql_crm_delete_all_leads')}}",
                    type: "POST",
                    data: {id: did, "_token": "{{ csrf_token() }}"},
                    success: function (result) {
                        if (result.status == 1) {
                            swal("Deleted!", "Leads are deleted.", "success");
                            window.location.reload();
                        } else {
                            swal("Failed!", "Deletion Failed.", "error");
                        }

                    }
                });

            });
        });

        lead_data();

        $('#myModal2').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        });


        $('#table_data').on('change', 'input.editor-active', function () {
            if (leads.includes($(this).val())) {
                var index = leads.indexOf($(this).val());
                if (index > -1) {
                    leads.splice(index, 1);
                }
            } else {
                leads.push($(this).val());
            }
            ch();
        });


        // $('#select_all').click( function () {
        //     $('.editor-active').each(function(i, obj) {
        //         console.log(obj);
        //         $(this).trigger('click');
        //     });
        // });

        $('#act_available').on('select2:select', function (e) {
            if (leads.length > 0) {
                var cat = $('#act_available').val();
                if (cat == 1) {
                    var lead_array = JSON.stringify(leads);
                    swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover the leads!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    }, function () {
                        $.ajax({
                            url: "{{ route('ql_crm_delete_selected_leads')}}",
                            type: "POST",
                            data: {lead_array: lead_array, "_token": "{{ csrf_token() }}"},
                            success: function (result) {
                                if (result.status == 1) {
                                    swal("Deleted!", "Leads are deleted.", "success");
                                    //window.location.reload();
                                } else {
                                    swal("Failed!", "Deletion Failed.", "error");
                                }
                                editor.ajax.reload(null, false);
                            }
                        });
                    });
                }
                if (cat == 2) {
                    $('#act_campaign').modal('show');
                }
                if (cat == 3) {
                    $('#act_user').modal('show');
                }
            } else {
                toastr.error("Please select leads");
            }

        });

        $("#act_message_time,#act_campaign_id").select2({
            theme: 'bootstrap4',
            placeholder: "Please Select Data",
            allowClear: true,
            width: '100%',
        });

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        $('#activity').hide();

        $('#start_at,#act_campaign_id').on('select2:select', function (e) {
            var start_at = $('#start_at').val();
            var campaign_id = $('#campaign_id').val();

            if (start_at == 2 && campaign_id != "") {

                $.ajax({
                    url: "{{ route('step') }}",
                    data: {"_token": "{{ csrf_token() }}", "campaign_id": campaign_id},
                    type: "POST",
                    success: function (result) {
                        var html = "";
                        html += "<option></option>";
                        result.forEach(myFunction);

                        function myFunction(value, index, array) {
                            html += "<option value='" + value['_id'] + "'>" + value['subject'] + "</option>";
                        }

                        $('#step').html(html);
                    }
                });
                $('#step').select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select Data",
                    allowClear: true,
                    width: '100%',
                });
                $('#activity').show();
            } else {
                $('#activity').hide();
            }

        });
    });

    function ch() {
        $.each(leads, function (i, val) {
            $("input[value='" + val + "']").prop('checked', true);


        });

        $('#select_all').click( function () {
            $('.editor-active').each(function(i, obj) {
                $(this).trigger('click');
            });
        });
    }

    function assign_user() {
        var agent_assigned = $("#act_agent_assigned").val();
        var loan_officer_assigned = $("#act_loan_officer_assigned").val();
        var assistant_assigned = $("#act_assistant_assigned").val();
        var other_assigned = $("#act_other_assigned").val();
        var lead_array = JSON.stringify(leads);
        $('#act_user').modal('hide');
        $.ajax({
            url: "{{ route('user_to_select_leads')}}",
            type: "POST",
            data: {
                lead_array: lead_array,
                "agent_assigned": agent_assigned,
                "loan_officer_assigned": loan_officer_assigned,
                "assistant_assigned": assistant_assigned,
                "other_assigned": other_assigned,
                "_token": "{{ csrf_token() }}"
            },
            success: function (result) {
                if (result.status == 1) {
                    swal("Success!", "User Assigned to leads.", "success");
                    //window.location.reload();
                } else {
                    swal("Failed!", "Deletion Failed.", "error");
                }
                editor.ajax.reload(null, false);
            }
        });
    }

    var validobj = $("#attach_campaign_form").validate({
        ignore: [],
        errorPlacement: function (error, element) {
            if (element.attr("type") == "radio") {
                error.insertAfter($(element).closest('fieldset'));
            } else if (element.hasClass('select2')) {
                error.insertAfter(element.next('span'));
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            campaign_id: {
                required: true
            },
            how_to_apply: {
                required: true
            },
        },
        messages: {
            campaign_id: {
                required: 'Please select Campaign',
            },
            how_to_apply: {
                required: 'Please select any Option',
            },

        },
        submitHandler: function (form) {
            showmodal('Please wait, Attaching campaign to lead');
            var data = new FormData(document.getElementById("attach_campaign_form"));
            var lead_array = JSON.stringify(leads);
            data.append('lead_array', lead_array);

            $.ajax({
                type: "POST",
                url: "{{route('camp_to_select_leads') }}",
                data: data,
                processData: false,
                dataType: 'json',
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    hidemodal();
                    if (data.status == 1) {
                        toastr.success(data.message);
                    }
                    if (data.status == 0) {
                        toastr.error(data.message);
                    }
                    editor.ajax.reload(null, false);
                }
            });
        },
    });


    function lead_data() {

        var lead_search = $("#lead_search").val();
        var lead_source = $("#lead_source").val();
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var star_rating = $("#star_rating").val();
        var tags = $("#tags").val();
        var reg_last = $("#reg_last").val();
        var email_data = $("#email_data").val(); // Added on 2|11|20 issue email solved
        var email = $("#email_data").val();

        var email_validity = $("#email_validity").val();
        var mbsource = $("#mbsource").val();
        var interest = $("#interest").val();
        var campaign_id = $("#campaign_id").val();
        var time_frame = $("#time_frame").val();
        var buyer_agency_agreement = $("#buyer_agency_agreement").val();
        var mortgage_status = $("#mortgage_status").val();

        var agent_assigned = $("#agent_assigned").val();
        var city = $("#city").val();
        var loan_officer_assigned = $("#loan_officer_assigned").val();
        var assistant_assigned = $("#assistant_assigned").val();
        var other_assigned = $("#other_assigned").val();
        var phone_numbers = $("#phone_numbers").val();
        var reg_last = $("#reg_last").val();


        $('#myModal2').modal('hide');
        $("#table_data").dataTable().fnDestroy();
        editor = $('#table_data').DataTable({
            // for number
            // old code changed because not working
            // "aLengthMenu": [[10, 100, 500, 1000 , 5000 , 10000 ], [10, 100, 500, 1000 , 5000 , 10000]],
            "aLengthMenu": [[10, 20, 30, 40, 50], [10, 20, 30, 40, 50]],
            "iDisplayLength": 10,
            "processing": true,
            "serverSide": true,
            "responsive":true,
            "fnDrawCallback":function(oSettings, json) {
                ch();
            },
            "ajax": {
                url: "{{ route('ajaxdata.getdata2_arvind') }}",
                data: {
                    "lead_search": lead_search,
                    "lead_source": lead_source,
                    "first_name": first_name,
                    "last_name": last_name,
                    "star_rating": star_rating,
                    "tags": tags,
                    "reg_last": reg_last,
                    "email_validity": email_validity,

                    "mbsource": mbsource,
                    "interest": interest,
                    "campaign_id": campaign_id,
                    "time_frame": time_frame,
                    "buyer_agency_agreement": buyer_agency_agreement,
                    "mortgage_status": mortgage_status,
                    "email": email,
                    "email_data": email_data,// Added on 2|11|20 issue email solved

                    "agent_assigned": agent_assigned,
                    "city": city,
                    "loan_officer_assigned": loan_officer_assigned,
                    "assistant_assigned": assistant_assigned,
                    "other_assigned": other_assigned,
                    "phone_numbers" : phone_numbers,
                }
            },
            dom: "<'html5buttons'B>lftr<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ],
            "columns": [
                {
                    data: "_id",
                    'searchable': true,
                    'orderable': false,
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return '<input type="checkbox" class="editor-active" value="' + row['_id'] + '">';
                        }
                        return data;
                    },
                    className: "dt-body-center"
                },
                // For searching email and phone number added on - 31|10|2020
                {"data": "primary", "render": function (data, type, full, meta){
                        if(full['is_valid'] == 0) {
                            var url = '<p class="text-info" style="display: none">' +
                                      full['primary'] +
                                      '</p>'
                        }else{
                            var url = '<p class="text-danger" style="display: none">' +
                                      full['primary'] +
                                      '</p>'
                        }
                        return url;
                    },
                    className: "hidden"
                },
                {"data": "lead_email", "render": function (data, type, full, meta){
                        var url = '<p class="text-danger" style="display: none">' +
                                  full['lead_email'] +
                                  '</p>'
                        return url;
                    },
                    className: "hidden"
                },
                // For searching email and phone number added on - 31|10|2020
                {
                    "data": "lead_name" ,"render": function (data, type, full, meta) {

                        var newlead = "";
                        if (full['is_valid'] == 0 && full["count_of_lead"]==0){
                            var url = '<p><a href="{{ URL::to("/") }}/crm/lead_profile/' + full['_id'] + '" ' +
                                      'target="_blank">' + full['lead_name'] + '</a>'+newlead+'<small></p><p><a ' +
                                      'href="#" onclick="toggle_dialer(\''+full['primary'] +'\',\''+full['_id'] +'\',' +
                                      '\''+full['dailer_email'] +'\',\''+full['dailer_send_email'] +'\');return ' +
                                      'false;" style="color:red;"><i class="fa fa-times-circle-o"></i>&nbsp; ' + full['primary'] + ' <span class="label label-danger float-right label-xs" style="font-size:8px;">Invalid</span></p></a><p><small style="color:red;"><a style="color:green;" href="{{ URL::to("/") }}/crm/email/' + full['_id'] + '"><i class="fa fa-check-circle-o"></i>&nbsp; '+full['lead_email']+' </small></a></p>';
                            if(full['agent_name'])
                            {
                                url+='<p><i title="'+full['agent_name']['role']+'" class="glyphicon glyphicon-user"><span class="agent-style">' + full['agent_name']['first_name'] + ' ' + full['agent_name']['last_name'] + '</span></i></p>';
                            }
                            if(full['loan_name'])
                            {
                                url+='<p><i title="'+full['loan_name']['role']+'" class="glyphicon glyphicon-user"><span class="agent-style">' + full['loan_name']['first_name'] + ' ' + full['loan_name']['last_name'] + '</span></i></p>';
                            }
                            if(full['assistant_name'])
                            {
                                url+='<p><i title="'+full['assistant_name']['role']+'" class="glyphicon glyphicon-user"><span class="agent-style">' + full['assistant_name']['first_name'] + ' ' + full['assistant_name']['last_name'] + '</span></i></p>';
                            }
                            if(full['other_name'])
                            {
                                url+='<p><i title="'+full['other_name']['role']+'" class="glyphicon glyphicon-user"><span class="agent-style">' + full['other_name']['first_name'] + ' ' + full['other_name']['last_name'] + '</span></i></p>';
                            }
                        }

                        else{
                            if(full["count_of_lead"]==0 && !("list_id" in full)){
                                newlead = '<span class="label label-danger float-right label-xs" style="font-size:8px;">NEW</span>';
                            }
                            var url = '<p><a href="{{ URL::to("/") }}/crm/lead_profile/' + full['_id'] + '" ' +
                                      'target="_blank">' + full['lead_name'] + '</a>'+newlead+'<small></p><p><a ' +
                                      'href="#" onclick="toggle_dialer(\''+full['primary'] +'\',\''+full['_id'] +'\',' +
                                      '\''+full['dailer_email'] +'\',\''+full['dailer_send_email'] +'\');return ' +
                                      'false;" style="color:green;"><i class="fa fa-check-circle-o"></i>&nbsp; ' + full['primary'] + ' </p></a><p><small style="color:green;"><a style="color:green;" href="{{ URL::to("/") }}/crm/email/' + full['_id'] + '"><i class="fa fa-check-circle-o"></i>&nbsp; '+full['lead_email']+' </small></a></p>';
                            if(full['agent_name'])
                            {
                                url+='<p><i title="'+full['agent_name']['role']+'" class="glyphicon glyphicon-user"><span class="agent-style">' + full['agent_name']['first_name'] + ' ' + full['agent_name']['last_name'] + '</span></i></p>';
                            }
                            if(full['loan_name'])
                            {
                                url+='<p><i title="'+full['loan_name']['role']+'" class="glyphicon glyphicon-user"><span class="agent-style">' + full['loan_name']['first_name'] + ' ' + full['loan_name']['last_name'] + '<span></i></p>';
                            }
                            if(full['assistant_name'])
                            {
                                url+='<p><i title="'+full['assistant_name']['role']+'" class="glyphicon glyphicon-user"><span class="agent-style">' + full['assistant_name']['first_name'] + ' ' + full['assistant_name']['last_name'] + '</span></i></p>';
                            }
                            if(full['other_name'])
                            {
                                url+='<p><i title="'+full['other_name']['role']+'" class="glyphicon glyphicon-user"><span class="agent-style">' + full['other_name']['first_name'] + ' ' + full['other_name']['last_name'] + '</span></i></p>';
                            }
                        }

                        return url;
                        // For Checking Invalid and Valid number
                    }
                },
                {"data": "funnel_data", "render": function (data, type, full, meta) {
                        var url = '<div class="dropdown position-relative">';
                        if(full['funnel_name']!=""){
                            url+='<button type="button" class="btn text-white dropdown-toggle" ' +
                                'data-toggle="dropdown" id="'+full['_id']+'" style="background-color: '+
                                full['funnel_color']
                                +'">'
                                +full['funnel_name']+'</button>';
                        }else{
                            if(full['funnel_data'].length==0){
                                url+='<button type="button" class="btn btn-primary dropdown-toggle" ' +
                                    'data-toggle="dropdown" id="'+full['_id']+'" disabled>' +
                                    'Funnel List</button>';
                            }else{
                                url+='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" ' +
                                    'id="'+full['_id']+'" >' +
                                    'Funnel List</button>';
                            }


                        }
                        url+=' <div class="dropdown-menu">';
                        $.each( full['funnel_data'], function( key, value ) {
                            url += '<a class="dropdown-item" ' +
                                'onclick="funnel_ajax(\'' + value._id + '\',\'' + value.id + '\',\'' +
                                value.data + '\',\''+full['_id']+'\',\''+value.color+'\')">'+value.data+'</a>';
                        });
                        url+='</div>' +
                            '</div>';
                        return url;
                    }
                },
                // Updated for further use - Bala sir & chetan on 20|11|2020
                {"data": "funnel_list", "render": function (data, type, full, meta) {
{{--                            @php  explode(",","funnel_list");@endphp--}}

                        // var url = '<div class=" position-relative">';
                        // url+='<span class="badge text-white " ' +
                        //     'id="'+full['_id']+'" style="background-color: '+
                        //     full['funnel_color']
                        //     +'">'
                        //     + full['funnel_na']+'</span>';
                        // url+='</div>' +
                        //      '</div>';
                        // var url = '<div class=" position-relative">';
                        // $.each( full['funnel_list'], function( data, type, full, meta) {
                        //     url += '<span class="badge text-white " ' +
                        //         'id="' + full['_id'] + '" style="background-color: ' +
                        //         full['funnel_color']
                        //         + '">'
                        //         + full['funnel_na'][i][0] + '</span>';
                        // });
                        var data ="";
                        if(full['funnel_na'].length!=0){
                            //console.log(full['camp_name'].length)
                            // data += "<div class='test'><ul>"
                            data += "<ul>"
                            for (var i = 0; i < full['funnel_na'].length; i++) {
                                data += '<li class="badge text-white mr-1" ' +
                                    'id="' + full['_id'] + '" style="background-color: ' +
                                    full['funnel_color']
                                    + '">'
                                    + full['funnel_na'][i][0] + '</li>';

                            }
                            data += "</ul>";
                        }
                        else{
                            data = "No Funnel List";
                        }
                        var url = data;
                        return url;

                    }
                },
                // {"data": "funnel_list", "render": function (data, type, full, meta) {
                //         $.each(full['funnel_list'],function (data, type, full, meta) {
                //             var url = '<div class=" position-relative">';
                //             url+='<span class="badge text-white " style="background-color:blue;">'
                //                 +full['funnel_name'] +'</span>';
                //             url+='</div>' +
                //                 '</div>';
                //             // var url = '<div class=" position-relative">';
                //             // $.each( full['funnel_list'], function( data, type, full, meta) {
                //             //     url += '<span class="badge text-white " ' +
                //             //         'id="' + full['_id'] + '" style="background-color: ' +
                //             //         full['funnel_color']
                //             //         + '">'
                //             //         + full['funnel_name'][0] + '</span>';
                //             // });
                //             return url;
                //         });
                //     }
                // },
                {"data": "created_at", "render": function (data, type, full, meta) {
                        var url = '<p>'+full['created_at_diff_human']+'</p><p style="font-size:10px;">'+full['created_at']+'</p>';
                        return url;
                    }
                },
                {
                    "data": "icon", "render": function (data, type, full, meta) {
                        var url = "";
                        if (full['task_count'] != "") {
                            url += '<i style="color: #E74955;" class="glyphicon glyphicon-flag" title="' + full['task_count'] + ' Task Due';
                            if (full['call_count_task'] != "") {
                                url += '(' + full['call_count_task'] + ' call )"></i>';
                            } else {
                                url += '"></i>';
                            }
                            url += '<a href="{{ url("crm/lead_profile")}}/' + full['_id'] + '?tab3"> Task Due(' + full['task_count'] + ')</a>';
                        } else {
                            url += '<i style="color:lightgrey" data-toggle="tooltip" data-placement="bottom" title="No Follow Up Tasks">nothing due</i>';
                        }
                        if (full['call_type'] != "") {
                            url += '<p class="sub_d"><i style="color:green;padding-right: 2px;font-size: 8px;" class="fa fa-circle"></i>' + full['call_type'] + ' ' + full['call_count_carbon_task'] + '</p> ';
                        } else {
                            url += '<p class="sub_d" style="color:lightgrey">no interaction</p>';
                        }

                        return url;
                    }
                },
                {
                    "data": "icon", "render": function (data, type, full, meta) {
                        var url = "";
                        url+='<div class="container-fluid"><div class="row">';
                        if (full['call_count'] != "" ) {
                            url += '<div class="col-md-4"><i class="glyphicon glyphicon-earphone" title="'+full['get_call_status_text']+' '+ full['call_count'] + ' Call Count In Total" style="color: green"><span class="logo">' + full['call_count'] + '<span></i><p class="sub_d">' + full['call_count_carbon_task'] + '</p></div>';
                        } else{ url += '<div class="col-md-4"><i class="glyphicon glyphicon-earphone" title="No Call.No Message.No Count">No Calls</i></div>';}

                        if (full['email_count'] != "") {
                            url += '<div class="col-md-4"><i title="Email Sent"class="glyphicon glyphicon-envelope" style="color: green"><span class="logo">' + full['email_count'] + '</span></i><p class="sub_d">' + full['email_count_time'] + '</p></div>';
                        }
                        if (full['email_count'] == "") {
                            url += '<div class="col-md-4"><i title="Email Sent" class="glyphicon glyphicon-envelope">---</i></div>';
                        }

                        if (full['call_note_count'] != "") {
                            url += '<div class="col-md-4"><i title="Written Note" class="glyphicon glyphicon-question-sign" style="color: green"><span class="logo">' + full['call_note_count'] + '<span></i><p class="sub_d">' + full['call_note_time'] + '</p></div>';
                        }
                        if (full['call_note_count'] == "") {
                            url += '<div class="col-md-4"><i title="Written Note" class="glyphicon glyphicon-question-sign">----</i></div>';
                        }

                        url +='</div></div>';
                        // if (full['call_count'] != "" && full['call_type'] == 'w_Lead') {
                        //     url += '<i class="glyphicon glyphicon-earphone" title="Spoke To Client.' + full['call_count_carbon_task'] + ' Ago.' + full['call_count'] + ' Call Count In Total" style="color: green">' + full['call_count'] + '</i><br/><i>' + full['call_count_carbon_task'] + '</i>';
                        // }
                        // if (full['call_count'] != "" && full['call_type'] == 'left_message') {
                        //     url += '<i class="glyphicon glyphicon-comment" title="Attempeted Call.Left Voce Message.' + full['call_count'] + ' Call Count In Total" style="color: orange">' + full['call_count'] + '</i><br/><i>' + full['call_count_carbon_task'] + '</i>';
                        // }
                        // if (full['call_count'] != "" && full['call_type'] == 'bad_number') {
                        //     url += '<i class="glyphicon glyphicon-earphone" title="Non Working Number Or Some Error.' + full['call_count_carbon_task'] + ' Ago.' + full['call_count'] + ' Call Count In Total" style="color: black">' + full['call_count'] + '</i><br/><i>' + full['call_count_carbon_task'] + '</i>';
                        // }
                        // if (full['call_count'] == "" && full['call_type'] == '') {
                        //     url += '<i class="glyphicon glyphicon-earphone" title="No Call.No Message.No Count">No Calls</i>';
                        // }

                        return url;
                    }
                },
                /* {
                     "data": "icon", "render": function (data, type, full, meta) {
                         var url = "";
                         if (full['email_count'] != "") {
                             url += '<i title="Email Sent"class="glyphicon glyphicon-envelope" style="color: green">' + full['email_count'] + '</i><br><i>' + full['email_count_time'] + '</i>';
                         }
                         if (full['email_count'] == "") {
                             url += '<i title="Email Sent" class="glyphicon glyphicon-envelope">---</i>';
                         }
                         return url;
                     }
                 },
                 {
                     "data": "sign", "render": function (data, type, full, meta) {
                         var url = "";
                         if (full['call_note_count'] != "") {
                             url += '<i title="Written Note" class="glyphicon glyphicon-question-sign" style="color: green">' + full['call_note_count'] + '</i><br><i>' + full['call_note_time'] + '</i>';
                         }
                         if (full['call_note_count'] == "") {
                             url += '<i title="Written Note" class="glyphicon glyphicon-question-sign">----</i>';
                         }
                         return url;
                     }
                 },*/
                {
                    "data": "email", "render": function (data, type, full, meta) {
                        if (full['email_open_count'] == 0) {
                            var url = '<i class="glyphicon glyphicon-bell" style="color:#cccccc;"></i>';
                        }
                        if (full['email_open_count'] != 0) {
                            var url = '<i class="glyphicon glyphicon-bell" style="color:#E74955;"><span class="logo">' + full['email_open_count'] + '</span></i>';
                        }
                        return url;
                    }
                },
                {
                    "data": "email", "render": function (data, type, full, meta) {
                        var data = "";
                        if(full['camp_name'].length!=0){
                            //console.log(full['camp_name'].length)
                            // data += "<div class='test'><ul>"
                            data += "<ul style='list-style: circle;color:#ed5565;'>"
                            for (var i = 0; i < full['camp_name'].length; i++) {
                                data += "<li>" + full['camp_name'][i] + "</li>";

                            }
                            data += "</ul>";
                        }
                        else{
                            data = "No campaign Names";
                        }


                        var url = data;
                        // if(full['camp_count']==0){
                        //     var url = '<i class="glyphicon glyphicon-tint" style="color:#cccccc;"></i>';
                        // }
                        // if(full['camp_count']!=0){
                        //     var url = '<i class="glyphicon glyphicon-tint" style="color:#E74955;">'+full['camp_count']+'</i>';
                        // }
                        return url;
                    }
                },

            ],
            select: {
                style: 'os',
                selector: 'td:not(:last-child)' // no row selection on last column
            },
            rowCallback: function (row, data) {
                // Set the checked state of the checkbox in the table
                $('input.editor-active', row).prop('checked', data.active == 1);
            }
        });

    }

    function funnel_ajax(_id,id,data,lead_id,color) {
        var text = data;
        var color = color;
        var update_btn = lead_id;
        var formdata = new FormData();
        formdata.append('lead_id', lead_id);
        formdata.append('_id', _id);
        formdata.append('data', data);
        formdata.append('id', id);
        formdata.append('color', color);
        formdata.append('_token', "{{csrf_token()}}");
        ajax_post('{{ route('save_funnel_ajax')}}', formdata, function (response) {
                var data = showResponse(response);
                $('#'+update_btn).text(text);
                      $('#'+update_btn).css({backgroundColor: color});
            },
            function (response) {
                showError(response);
            });
    }
</script>

