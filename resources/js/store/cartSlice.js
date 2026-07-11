import { createSlice } from '@reduxjs/toolkit';

const cartSlice = createSlice({
    name: 'cart',
    initialState: {
        items: [],
        totalCalories: 0,
        totalPrice: 0,
    },
    reducers: {
        addToCart: (state, action) => {
            const item = action.payload;
            const existing = state.items.find(i => i.id === item.id);
            if(existing) {
                existing.quantity += 1;
            } else {
                state.items.push({ ...item, quantity: 1 });
            }
            state.totalCalories += item.calories;
            state.totalPrice    += parseFloat(item.price);
        },
        removeFromCart: (state, action) => {
            const id = action.payload;
            const item = state.items.find(i => i.id === id);
            if(item) {
                state.totalCalories -= item.calories * item.quantity;
                state.totalPrice    -= item.price * item.quantity;
                state.items = state.items.filter(i => i.id !== id);
            }
        },
        clearCart: state => {
            state.items = [];
            state.totalCalories = 0;
            state.totalPrice = 0;
        }
    }
});
export const { addToCart, removeFromCart, clearCart } = cartSlice.actions;
export default cartSlice.reducer;
