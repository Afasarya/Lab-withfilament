<div class="container px-4 px-lg-5 mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">
        @foreach($labs as $lab)
        <div class="col mb-5">
            <div class="card lab-card h-100">
                <!-- Lab status badge-->
                <div class="badge bg-success text-white status-badge">Available</div>
                
                <!-- Lab image-->
                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="{{ $lab->name }}" />
                
                <!-- Lab details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Lab name-->
                        <h5 class="fw-bolder">{{ $lab->name }}</h5>
                        <!-- Lab description-->
                        <p>{{ $lab->description }}</p>
                    </div>
                </div>
                
                <!-- Book actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                        <button type="button" class="btn btn-outline-dark mt-auto" 
                                data-bs-toggle="modal" data-bs-target="#bookingModal{{ $lab->id }}">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Modal -->
        <div class="modal fade" id="bookingModal{{ $lab->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Book {{ $lab->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="lab_id" value="{{ $lab->id }}">
                            <div class="mb-3">
                                <label for="start_time" class="form-label">Start Time</label>
                                <input type="datetime-local" class="form-control" id="start_time" 
                                       name="start_time" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Book Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>