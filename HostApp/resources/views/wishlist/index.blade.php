@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #91766e;
        --background-gradient: linear-gradient(135deg, #fcece3, #ffffff);
        --card-background: #ffffff;
        --soft-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        --hover-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
    }

    body {
        background: var(--background-gradient);
        font-family: 'Inter', 'Poppins', sans-serif;
        color: var(--primary-color);
        line-height: 1.6;
    }

    .wishlist-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .wishlist-title {
        font-size: 2.75rem;
        text-align: center;
        margin-bottom: 40px;
        color: var(--primary-color);
        font-weight: 600;
        letter-spacing: -0.5px;
    }

    .wishlist-table {
        width: 100%;
        background: var(--card-background);
        border-radius: 16px;
        box-shadow: var(--soft-shadow);
        overflow: hidden;
    }

    .wishlist-table thead {
        background-color: rgba(145, 118, 110, 0.05);
        border-bottom: 2px solid rgba(145, 118, 110, 0.1);
    }

    .wishlist-table th {
        padding: 15px 20px;
        text-align: left;
        font-weight: 600;
        color: var(--primary-color);
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .wishlist-table td {
        padding: 15px 20px;
        border-bottom: 1px solid rgba(145, 118, 110, 0.1);
        font-size: 0.95rem;
    }

    .wishlist-table tr:last-child td {
        border-bottom: none;
    }

    .wishlist-table tr:hover {
        background-color: rgba(145, 118, 110, 0.03);
        transition: background-color 0.3s ease;
    }

    .empty-wishlist {
        text-align: center;
        background-color: rgba(145, 118, 110, 0.05);
        padding: 25px;
        border-radius: 12px;
        font-size: 1.1rem;
        color: var(--primary-color);
        font-weight: 300;
    }

    .remove-btn {
        background-color: rgba(231, 76, 60, 0.1);
        color: #e74c3c;
        border: none;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .remove-btn:hover {
        background-color: rgba(231, 76, 60, 0.2);
        color: #c0392b;
    }

    @media (max-width: 768px) {
        .wishlist-table {
            font-size: 0.9rem;
        }

        .wishlist-table th, 
        .wishlist-table td {
            padding: 10px 15px;
        }
    }
</style>

<div class="wishlist-container">
    <h1 class="wishlist-title">Your Wishlist</h1>

    @if($wishlists->isEmpty())
        <div class="empty-wishlist">
            You have no items in your wishlist.
        </div>
    @else
        <table class="wishlist-table">
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
                                <button type="submit" class="remove-btn">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection