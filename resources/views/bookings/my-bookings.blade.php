
<div class="container px-4 px-lg-5 mt-5">
    <h2 class="fw-bolder mb-4">My Bookings</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Lab</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->lab->name }}</td>
                    <td>{{ $booking->start_time->format('Y-m-d H:i') }}</td>
                    <td>{{ $booking->end_time ? $booking->end_time->format('Y-m-d H:i') : '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $booking->status === 'active' ? 'warning' : 'success' }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td>
                        @if($booking->status === 'active')
                        <form action="{{ route('bookings.checkout', $booking) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-success" 
                                    onclick="return confirm('Are you sure you want to checkout?')">
                                Checkout
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
