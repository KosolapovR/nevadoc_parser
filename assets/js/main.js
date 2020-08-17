function ready() {
    const form = document.forms['addPattern'];
    const notification = document.getElementById('notification');

    function handleAddPattern(e) {
        e.preventDefault();

        const formData = new FormData(this);

        let pattern = formData.get('pattern');
        let productName = formData.get('productName');
        let seller = formData.get('seller');

        const data = JSON.stringify({pattern, productName, seller});

        sendData(data)
            .then(res => {
                if (res) {
                    form.reset();

                    notification.innerText = 'Паттерн сохранен';

                    if (notification.classList.contains('notification_error'))
                        notification.classList.remove('notification_error');
                    notification.classList.add('notification_success');
                } else {
                    if (notification.classList.contains('notification_success'))
                        notification.classList.remove('notification_success');
                    notification.classList.add('notification_error');

                    notification.innerText = 'Произошла ошибка';
                }

                notification.style.display = 'block';

                setTimeout(function () {
                    notification.style.display = 'none';
                }, 2000);
            })
    }


    async function sendData(data) {
        const response = await fetch('http://parser.loc/api/v1/pattern/', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: data
        });

        return response.json();
    }

    form.addEventListener('submit', handleAddPattern)

}

document.addEventListener('DOMContentLoaded', ready);