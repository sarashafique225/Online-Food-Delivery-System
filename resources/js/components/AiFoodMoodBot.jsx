import { useState } from 'react';

function AiFoodMoodBot() {
    const [mood, setMood] = useState('');
    const [results, setResults] = useState([]);
    const [loading, setLoading] = useState(false);
    const [chat, setChat] = useState([
        { from: 'bot', text: 'Hi! Tell me how you feel and I will suggest the perfect food for you.' }
    ]);

    const askBot = async () => {
        if (!mood.trim()) return;
        setChat(prev => [...prev, { from: 'user', text: mood }]);
        setLoading(true);

        try {
            // Using fetch directly to window.location.origin (Port 8000)
            const response = await fetch(`${window.location.origin}/ai/recommend`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ mood: mood })
            });

            if (!response.ok) throw new Error('Server responded with an error');

            const res = await response.json();
            // Checking if your controller returns 'data' or the array directly
            const foods = res.data || res || []; 
            setResults(foods);

            const names = foods.length > 0 ? foods.map(f => f.name).join(', ') : '';
            
            setChat(prev => [...prev, {
                from: 'bot',
                text: foods.length > 0
                    ? `Based on how you feel, I suggest: ${names}`
                    : 'Hmm, I could not find something specific. Try being more descriptive!'
            }]);
        } catch (error) {
            console.error("Connection Failed:", error);
            setChat(prev => [...prev, { from: 'bot', text: 'Connection error. Check your console (F12)!' }]);
        }

        setMood('');
        setLoading(false);
    };

    return (
        <div className='ai-bot-container p-3 border rounded bg-white shadow-sm'>
            <h5>🤖 Food Mood Bot</h5>
            <div className='chat-window' style={{height:'200px',overflowY:'auto',background:'#f8f9fa',padding:'10px',borderRadius:'8px'}}>
                {chat.map((msg, i) => (
                    <div key={i} className={`mb-2 ${msg.from === 'bot' ? 'text-start' : 'text-end'}`}>
                        <span className={`p-2 rounded d-inline-block ${msg.from === 'bot' ? 'bg-primary text-white' : 'bg-light border'}`}
                              style={{maxWidth:'80%',fontSize:'0.9rem'}}>
                            {msg.text}
                        </span>
                    </div>
                ))}
            </div>
            <div className='d-flex gap-2 mt-2'>
                <input className='form-control' value={mood} onChange={e=>setMood(e.target.value)}
                       placeholder='I am feeling bloated but want spicy...'
                       onKeyDown={e=>e.key==='Enter'&&askBot()} />
                <button className='btn btn-primary' onClick={askBot} disabled={loading}>
                    {loading ? '...' : 'Ask'}
                </button>
            </div>
        </div>
    );
}

export default AiFoodMoodBot;