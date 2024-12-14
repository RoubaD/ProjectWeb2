@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Wishlist</h1>

    @if($wishlists->isEmpty())
        <p>You have no items in your wishlist.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Destination</th>
                    <th>Landmark</th>
                    <th>Price</th>
                    <th>Property Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wishlists as $wishlist)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $wishlist->destination->name }}</td>
                        <td>{{ $wishlist->destination->landmark }}</td>
                        <td>${{ number_format($wishlist->destination->price, 2) }}</td>
                        <td>{{ $wishlist->destination->property_type }}</td>
                        <td>
                            <form action="{{ route('wishlist.destroy', $wishlist->destination->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
