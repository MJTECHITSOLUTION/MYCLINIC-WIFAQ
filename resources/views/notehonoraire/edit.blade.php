@extends('layouts.master')
@section('title')
    Edit Note d'honoraire
@endsection
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note d'honoraire</title>
</head>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body>
<form method="post" action="{{ route('notehonoraire.update', $note->id) }}">
    @csrf
    @method('PUT')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow mb-4" style="position: fixed;">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-10">
                            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Patient informations') }}</h6>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="PatientID">{{ __('sentence.Patient') }} :</label>
                        <select
                            class="form-control rounded-0 shadow-none multiselect-doctorino"
                            name="patient_id" id="PatientID" required
                            oninvalid="this.setCustomValidity('Selectionner le patient SVP!')" disabled>
                            {{-- <option value="">{{ __('sentence.Select Patient') }}</option> --}}
                                <option value="{{ $patient->id }}"
                                        data-birthday="{{ $patient->Patient->birthday ?? '' }}"
                                        data-gender="{{ $patient->Patient->gender ?? '' }}"
                                        data-phone="{{ $patient->Patient->phone ?? '' }}"
                                        data-address="{{ $patient->Patient->address ?? '' }}"
                                        data-weight="{{ $patient->Patient->weight ?? '' }}"
                                        data-height="{{ $patient->Patient->height ?? '' }}"
                                        data-blood="{{ $patient->Patient->blood ?? '' }}"
                                        data-cin="{{ $patient->Patient->cin ?? '' }}"
                                        data-assurance="{{ $patient->Patient->assurance ?? '' }}"
                                        @if ($note->patient_id == $patient->id) selected @endif>
                                    {{ $patient->name }}
                                </option>
                        </select>
                    </div>
                    <div id="selected-patient-info">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Note d'honoraire</h6>
                    <input type="submit" value="Update" class="btn btn-success" align="right" style="position: absolute; right: 30px; top: 8px;">
                    <button onclick="addRow(event)" class="btn btn-primary" style="position: absolute; right: 150px; top: 8px;">Ajoute</button>
                </div>
                <div class="card-body">
                    <table id="rapportTable" class="table">
                        <thead>
                        <tr>
                            <th>Nom Act</th>
                            <th>Code</th>
                            <th>Lettre Clé</th>
                            <th>Date</th>
                            <th>Dents</th>
                            <th>Montant</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($notes as $act)
                            <tr>
                                <td><input type="text" name="old_act_name[]" class="form-control" value="{{ $act->act_name }}"></td>
                                <td><input type="text" name="old_code[]" class="form-control" value="{{ $act->code }}"></td>
                                <td><input type="text" name="old_lettrecle[]" class="form-control" value="{{ $act->lettrecle }}"></td>
                                <td><input type="date" name="old_date[]" class="form-control" value="{{ \Carbon\Carbon::parse($act->date)->format('Y-m-d') }}"></td>
                                <td><input type="text" name="old_dents[]" class="form-control" value="{{ $act->dent }}"></td>
                                <td><input type="number" name="old_montant[]" class="form-control" value="{{ $act->montant }}">
                                <input type="hidden" name="old_id[]" value="{{$act->honorire_id}}"></td>
                                <td class="text-center">
                                    <form action="{{ route('notedelete.destroy', $act->honorire_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?');">
                                        @method('PUT')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-circle btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#PatientID').on('change', function () {
                var selectedOption = $(this).find(':selected');
                var birthday = selectedOption.data('birthday');
                var phone = selectedOption.data('phone');
                var address = selectedOption.data('address');
                var assurance = selectedOption.data('assurance');
                var height = selectedOption.data('height');
                var blood = selectedOption.data('blood');
                var cin = selectedOption.data('cin');

                var patientInfo = '';
                if (birthday) {
                    var age = calculateAgeWithMonths(birthday);
                    patientInfo += '<p><b>{{ __('sentence.Birthday') }} :</b> ' + birthday + ' (' + age.years + ' A et  ' + age.months + ' M)</p>';
                }
                if (phone) {
                    patientInfo += '<p><b>{{ __('sentence.Phone') }} :</b> ' + phone + '</p>';
                }
                if (address) {
                    patientInfo += '<p><b>{{ __('sentence.Address') }} :</b> ' + address + '</p>';
                }
                if (assurance) {
                    patientInfo += '<p><b>{{ __('sentence.assurance') }} :</b> ' + assurance + ' </p>';
                }
                if (height) {
                    patientInfo += '<p><b>{{ __('sentence.Height') }} :</b> ' + height + ' cm</p>';
                }
                if (blood) {
                    patientInfo += '<p><b>{{ __('sentence.Blood Group') }} :</b> ' + blood + '</p>';
                }
                if (cin) {
                    patientInfo += '<p><b>CIN : </b> ' + cin + '</p>';
                }
                $('#selected-patient-info').html(patientInfo);
            });

            $('#PatientID').trigger('change');

            function calculateAgeWithMonths(birthday) {
                var today = new Date();
                var birthDate = new Date(birthday);
                var ageYears = today.getFullYear() - birthDate.getFullYear();
                var monthDifference = today.getMonth() - birthDate.getMonth();
                var dayDifference = today.getDate() - birthDate.getDate();

                if (dayDifference < 0) {
                    monthDifference--;
                }

                if (monthDifference < 0) {
                    ageYears--;
                    monthDifference = 12 + monthDifference;
                }

                return {
                    years: ageYears,
                    months: monthDifference
                };
            }
        });
    </script>

    <script>
        function addRow(event) {
            event.preventDefault();

            var table = document.getElementById("rapportTable");
            var rowCount = table.rows.length;

            // Check if the number of rows is greater than or equal to 20
            if (rowCount >= 20) {
                alert("Vous ne pouvez pas ajouter plus de 20 lignes.");
                return;
            }

            var row = table.insertRow(rowCount);

            // Get acts data from a hidden field or a JavaScript variable
            var acts = @json($acts);

            var cell1 = row.insertCell(0);
            var element1 = document.createElement("select");
            element1.name = "act_name[]";
            element1.className = "form-control";
            element1.onchange = function() {
                var selectedAct = acts.find(act => act.id == this.value);
                if (selectedAct) {
                    element2.value = selectedAct.ref;
                    element3.value = selectedAct.lettre;
                    element6.value = selectedAct.cout;
                }
            };

            acts.forEach(function(act) {
                var option = document.createElement("option");
                option.value = act.id;
                option.text = act.name;
                element1.appendChild(option);
            });
            cell1.appendChild(element1);

            var cell2 = row.insertCell(1);
            var element2 = document.createElement("input");
            element2.type = "text";
            element2.name = "code[]";
            element2.className = "form-control";
            element2.placeholder = "Code";
            cell2.appendChild(element2);

            var cell3 = row.insertCell(2);
            var element3 = document.createElement("input");
            element3.type = "text";
            element3.name = "lettrecle[]";
            element3.className = "form-control";
            element3.placeholder = "Lettre Clé";
            cell3.appendChild(element3);

            var cell4 = row.insertCell(3);
            var element4 = document.createElement("input");
            element4.type = "date";
            element4.name = "date[]";
            element4.className = "form-control";
            cell4.appendChild(element4);

            var cell5 = row.insertCell(4);
            var element5 = document.createElement("input");
            element5.type = "text";
            element5.name = "dents[]";
            element5.className = "form-control";
            element5.placeholder = "Dents";
            cell5.appendChild(element5);

            var cell6 = row.insertCell(5);
            var element6 = document.createElement("input");
            element6.type = "number";
            element6.name = "montant[]";
            element6.className = "form-control";
            element6.placeholder = "Montant";
            cell6.appendChild(element6);

            // Create delete icon
            var cell7 = row.insertCell(6);
            var deleteIcon = document.createElement("i");
            deleteIcon.className = "fa fa-trash text-danger";
            deleteIcon.style.cursor = "pointer";
            deleteIcon.onclick = function() {
                table.deleteRow(row.rowIndex);
            };
            cell7.appendChild(deleteIcon);
        }
    </script>
    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.multiselect-doctorino').select2();
        });
        $(document).ready(function() {
            $('#type').select2();
        });
    </script>
@endsection
@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection