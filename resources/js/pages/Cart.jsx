import { useSelector, useDispatch } from 'react-redux';
import { clearCart } from '../store/cartSlice';
import api from '../api/axios';

function Cart() {
    const { items, totalPrice, totalCalories } = useSelector(s => s.cart);
    const dispatch = useDispatch();

    const placeOrder = async () => {
        try {
            await api.post('/orders', {
                items,
                total: totalPrice,
                total_calories: totalCalories,
                delivery_address: 'DHA Phase 5, Lahore'
            });
            dispatch(clearCart());
            alert('Order placed successfully!');
        } catch(err) {
            alert('Please login first');
        }
    };

    // DELETE an item from orders history
    const cancelOrder = async (orderId) => {
        await api.delete(`/orders/${orderId}`);
        alert('Order cancelled');
    };

    return (
        <div className='container py-4'>
            <h3>Your Cart ({items.length} items)</h3>
            {items.map(item => (
                <div key={item.id} className='d-flex justify-content-between border-bottom py-2'>
                    <span>{item.name}</span>
                    <span>Rs.{item.price} ({item.calories} kcal)</span>
                </div>
            ))}
            <div className='mt-3'>
                <strong>Total: Rs.{totalPrice.toFixed(0)}</strong> |
                <span className='ms-2 text-muted'>{totalCalories} kcal</span>
            </div>
            <button className='btn btn-danger mt-3 w-100' onClick={placeOrder}>
                Place Order
            </button>
        </div>
    );
}
export default Cart;
