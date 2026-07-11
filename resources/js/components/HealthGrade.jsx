import { useEffect, useState } from 'react';
import api from '../api/axios';

function HealthGrade() {
    const [stats, setStats] = useState(null);

    useEffect(() => {
        api.get('/dashboard/health').then(res => setStats(res.data));
    }, []);

    if(!stats) return <div>Loading health stats...</div>;

    const gradeColor = {A:'#28a745',B:'#17a2b8',C:'#ffc107',D:'#dc3545'}[stats.grade];

    return (
        <div className='health-grade-card p-4 rounded shadow-sm text-center' style={{background:'#fff'}}>
            <h5>Your Weekly Health Grade</h5>
            <div className='grade-circle' style={{
                width:'100px', height:'100px', borderRadius:'50%',
                background:gradeColor, color:'white',
                display:'flex', alignItems:'center', justifyContent:'center',
                fontSize:'3rem', fontWeight:'bold', margin:'20px auto'
            }}>
                {stats.grade}
            </div>
            <div className='row text-center mt-3'>
                <div className='col'>
                    <h4>{stats.weeklyCalories}</h4><small>Calories This Week</small>
                </div>
                <div className='col'>
                    <h4 className='text-success'>{stats.healthyCount}</h4><small>Healthy Meals</small>
                </div>
                <div className='col'>
                    <h4 className='text-danger'>{stats.junkCount}</h4><small>Junk Meals</small>
                </div>
            </div>
            {stats.grade === 'D' && (
                <div className='alert alert-danger mt-3'>
                    🚨 Too much junk this week! Try some salads to balance your score.
                </div>
            )}
        </div>
    );
}
export default HealthGrade;
