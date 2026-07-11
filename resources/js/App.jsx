import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { Provider } from 'react-redux';
import { store } from './store';
import Home from './pages/Home';
import RestaurantsList from './pages/RestaurantsList';
import RestaurantDetail from './pages/RestaurantDetail';
import Dashboard from './pages/Dashboard';
import Login from './pages/Login';
import Navbar from './components/Navbar';

function App() {
    return (
        <Provider store={store}>
            <Router>
                <Navbar />
                <Routes>
                    <Route path='/'                    element={<Home />} />
                    <Route path='/restaurants'         element={<RestaurantsList />} />
                    <Route path='/restaurants/:id'     element={<RestaurantDetail />} />
                    <Route path='/dashboard'           element={<Dashboard />} />
                    <Route path='/login'               element={<Login />} />
                </Routes>
            </Router>
        </Provider>
    );
}
export default App;
