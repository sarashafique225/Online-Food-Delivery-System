import React, { useState, useEffect } from 'react';
import api from '../api/axios';
import RestaurantCard from '../components/RestaurantCard';

function RestaurantsList() {
    const [restaurants, setRestaurants] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        api.get('/restaurants')
            .then(res => {
                setRestaurants(res.data.data);
                setLoading(false);
            })
            .catch(err => console.error(err));
    }, []);

    if(loading) return <div className='text-center p-5'><h3>Loading...</h3></div>;

    return (
        <div className='container py-5'>
            <h2>Restaurants Near You</h2>
            <div className='row g-4'>
                {restaurants.map(r => (
                    <div key={r.id} className='col-md-4'>
                        <RestaurantCard restaurant={r} />
                    </div>
                ))}
            </div>
        </div>
    );
}
export default RestaurantsList;
