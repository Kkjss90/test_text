let isAutoCheck = false;

async function checkText() {
    const text = document.getElementById('input').value;
    if (!text) {
        alert("Введите текст для проверки");
        return;
    }

    try {
        const response = await fetch('check.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ text, isAutoCheck }),
        });

        if (!response.ok) {
            throw new Error("Ошибка сервера: " + response.status);
        }

        const data = await response.json();
        if (!data.highlightedText) {
            throw new Error("Некорректный ответ от сервера");
        }

        document.getElementById('result').innerHTML = data.highlightedText;

        if (!isAutoCheck) {
            loadHistory();
        }
    } catch (error) {
        console.error("Ошибка:", error);
        alert("Произошла ошибка при проверке текста");
    }
}

async function loadHistory() {
    const response = await fetch('history.php');
    const history = await response.json();
    const historyDiv = document.getElementById('history');
    historyDiv.innerHTML = history.map(item => `
        <p>
            <strong>${item.language === 'ru' ? 'Русский' : 'Английский'}</strong><br>
            ${item.text}<br>
            <small>${new Date(item.created_at).toLocaleString()}</small>
        </p>
    `).join('');
}

document.getElementById('input').addEventListener('input', () => {
    isAutoCheck = true;
    checkText();
});

document.querySelector('button').addEventListener('click', () => {
    isAutoCheck = false;
    checkText();
});

loadHistory();