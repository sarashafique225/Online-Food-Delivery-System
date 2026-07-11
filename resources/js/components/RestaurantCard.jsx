import React from 'react';

function RestaurantCard({ restaurant }) {
    return (
        <div className="card h-100 shadow-sm">
            {/* This is the line that fixes your images! */}
            <img 
    src={`http://127.0.0.1:8000/storage/${restaurant.image}`} 
    className="card-img-top" 
    alt={restaurant.name} 
    style={{ height: '200px', width: '100%', objectFit: 'cover' }}
    onError={(e) => { 
        console.log("Image failed to load at: " + e.target.src);
        e.target.src = 'https://placehold.co/400x200?text=Food+Image'; 
    }}
/>
            <div className="card-body">
                <h5 className="card-title">{restaurant.name}</h5>
                <p className="card-text text-muted">{restaurant.address}</p>
                <div className="d-flex justify-content-between align-items-center">
                    <span className="badge bg-danger">Open</span>
                    <span className="text-warning">⭐ {restaurant.rating}</span>
                </div>
            </div>
        </div>
    );
}

export default RestaurantCard;