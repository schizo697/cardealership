@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Service') }}</div>
                <div class="card-body">
                    <form action="{{ route('services.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-4">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="user_type" id="new" value="new" checked>
                                <label for="new" class="form-check-label">New</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="user_type" id="existing" value="existing">
                                <label for="existing" class="form-check-label">Existing</label>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="user_id">Name:</label>
                    
                                {{-- For new customer --}}
                                <div id="newUserDiv">
                                    <input type="text" name="customer_name" class="form-control" placeholder="Customer Name">
                                </div>

                                {{-- For existing user --}}
                                <div id="existingUserDiv" style="display: none;">
                                    <select name="user_id" class="form-control">
                                        <option value="">-- Select Customer --</option>
                                        @foreach ($users as $user)
                                            @if (!$user->hasRole('mechanic'))
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                    
                                @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div class="col-md-6 mb-3">
                                <label for="car">Car:</label>
                                <input type="text" name="car" id="car" class="form-control">
                                @error('car')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div class="col-md-6 mb-3">
                                <label for="service">Service:</label>
                                <input type="text" name="service" id="service" class="form-control">
                                @error('service')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mechanic">Mechanic:</label>
                                <select id="mechanicSelect" class="form-control">
                                    <option value="" disabled selected>-- Select Mechanic --</option>
                                    @foreach ($users as $user)
                                        @if (!$user->hasRole('customer'))
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('service')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div id="selectedMechanics" style="margin-top: 10px;"></div>
                            <input type="hidden" name="mechanic_ids" id="mechanic_ids">
                        </div>
                    
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('services.index') }}" class="btn btn-secondary mt-2">Back</a>
                            <button type="submit" class="btn btn-success mt-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   const mechanicSelect = document.getElementById("mechanicSelect");
    const selectedMechanicsDiv = document.getElementById("selectedMechanics");
    const mechanicIdsInput = document.getElementById("mechanic_ids");

    let selectedMechanics = [];

    mechanicSelect.addEventListener("change", function () {
        const selectedOption = mechanicSelect.options[mechanicSelect.selectedIndex];

        const id = selectedOption.value;
        const name = selectedOption.text;

        if (!selectedMechanics.includes(id) && id) {
            selectedMechanics.push(id);
            updateSelectedMechanics();
        }

        mechanicSelect.selectedIndex = 0; // reset
    });

    function updateSelectedMechanics() {
        selectedMechanicsDiv.innerHTML = "";
        selectedMechanics.forEach(id => {
            const mechanicName = mechanicSelect.querySelector(`option[value="${id}"]`).text;

            const badge = document.createElement("span");
            badge.className = "badge bg-primary me-1";
            badge.textContent = mechanicName;

            const removeBtn = document.createElement("button");
            removeBtn.textContent = "x";
            removeBtn.className = "btn btn-sm btn-danger ms-2";
            removeBtn.onclick = () => {
                selectedMechanics = selectedMechanics.filter(mid => mid !== id);
                updateSelectedMechanics();
            };

            const wrapper = document.createElement("div");
            wrapper.className = "d-inline-block me-2 mb-2";
            wrapper.appendChild(badge);
            wrapper.appendChild(removeBtn);

            selectedMechanicsDiv.appendChild(wrapper);
        });

        mechanicIdsInput.value = selectedMechanics.join(',');
    }
    //
    document.getElementById('existing').addEventListener('change', function () {
        document.getElementById('newUserDiv').style.display = 'none';
        document.getElementById('existingUserDiv').style.display = 'block';
    });

    document.getElementById('new').addEventListener('change', function () {
        document.getElementById('newUserDiv').style.display = 'block';
        document.getElementById('existingUserDiv').style.display = 'none';
    });

    // Optional: run once to set initial state
    window.addEventListener('DOMContentLoaded', function () {
        if (document.getElementById('existing').checked) {
            document.getElementById('existingUserDiv').style.display = 'block';
            document.getElementById('newUserDiv').style.display = 'none';
        }
    });
</script>
@endsection
