export function getTimeTheme() {
    const hour = new Date().getHours();

    if(hour >= 6 && hour < 11) return {
        label: '🌅 Breakfast Fuel',
        subtitle: 'Start your day right!',
        mealTime: 'breakfast',
        bgGradient: 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
        emoji: '☕'
    };
    if(hour >= 11 && hour < 16) return {
        label: '☀️ Lunch Break',
        subtitle: 'Fuel up for the afternoon!',
        mealTime: 'lunch',
        bgGradient: 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
        emoji: '🍱'
    };
    if(hour >= 16 && hour < 21) return {
        label: '🌆 Dinner Time',
        subtitle: 'End your day deliciously!',
        mealTime: 'dinner',
        bgGradient: 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)',
        emoji: '🍽️'
    };
    return {
        label: '🌙 Midnight Cravings',
        subtitle: 'We never close. Eat up!',
        mealTime: 'all',
        bgGradient: 'linear-gradient(135deg, #1a1a2e 0%, #16213e 100%)',
        emoji: '🌙'
    };
}
