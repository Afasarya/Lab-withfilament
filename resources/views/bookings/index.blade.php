<x-layouts.app>
    <!-- Tambahkan link CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <section class="ftco-section ftco-no-pb ftco-room">
        <div class="container-fluid px-0">
            <div class="row no-gutters justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Available Labs</span>
                    <h2 class="mb-4">Book Your Lab</h2>
                </div>
            </div>
            <div class="row no-gutters">
                @foreach($labs as $lab)
                    <div class="col-lg-6">
                        <div class="room-wrap d-md-flex ftco-animate">
                            <!-- Image Section -->
                            <a href="#" 
                               class="img" 
                               style="background-image: url({{ $lab->image ? asset('storage/' . $lab->image) : 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg' }});">
                            </a>
                            <div class="half left-arrow d-flex align-items-center">
                                <div class="text p-4 text-center">
                                    <!-- Lab Status -->
                                    <p class="badge {{ $lab->status == 'available' ? 'bg-success' : 'bg-danger' }} text-white mb-2">
                                        {{ ucfirst($lab->status) }}
                                    </p>
                                    <!-- Lab Details -->
                                    <h3 class="mb-3"><a href="#">{{ $lab->name }}</a></h3>
                                    <p class="mb-3">{{ $lab->description }}</p>
                                    <!-- Booking Button -->
                                    @if($lab->status == 'available')
                                        <p class="pt-1">
                                            <button type="button" class="btn-custom px-3 py-2 rounded" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#bookingModal{{ $lab->id }}">
                                                Book Now <span class="icon-long-arrow-right"></span>
                                            </button>
                                        </p>
                                    @else
                                        <p class="pt-1">
                                            <button type="button" class="btn-custom px-3 py-2 rounded" disabled>
                                                Not Available
                                            </button>
                                        </p>
                                    @endif
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
                                            <label for="start_time_{{ $lab->id }}" class="form-label">Start Time</label>
                                            <input type="datetime-local" 
                                                   class="form-control" 
                                                   id="start_time_{{ $lab->id }}" 
                                                   name="start_time" 
                                                   required>
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
    </section>

    <!-- Tambahkan link JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Debugging untuk tombol -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.btn-custom').forEach(button => {
                button.addEventListener('click', () => {
                    console.log('Button clicked: ', button);
                });
            });
        });
    </script>
</x-layouts.app>
