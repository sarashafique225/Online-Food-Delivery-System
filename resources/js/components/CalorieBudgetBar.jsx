import { useSelector } from 'react-redux';

function CalorieBudgetBar({ dailyGoal = 2000 }) {
    const { totalCalories } = useSelector(s => s.cart);
    const percentage = Math.min((totalCalories / dailyGoal) * 100, 100);

    const getColor = () => {
        if(percentage < 50) return '#28a745';  // green
        if(percentage < 80) return '#ffc107';  // yellow
        return '#dc3545';                       // red
    };

    return (
        <div className='calorie-bar p-3 bg-light rounded'>
            <div className='d-flex justify-content-between mb-1'>
                <small><b>Calorie Budget</b></small>
                <small>{totalCalories} / {dailyGoal} kcal</small>
            </div>
            <div className='progress' style={{height:'12px'}}>
                <div className='progress-bar'
                     style={{width:`${percentage}%`, background:getColor(), transition:'width 0.5s'}}>
                </div>
            </div>
            {percentage > 90 &&
                <small className='text-danger mt-1 d-block'>
                    ⚠️ You're near your daily calorie limit!
                </small>
            }
        </div>
    );
}
export default CalorieBudgetBar;
