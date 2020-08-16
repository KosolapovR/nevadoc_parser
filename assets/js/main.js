function ready(){
    const form = document.forms['addPattern'];

    function handleAddPattern(e){
        e.preventDefault();

        const formData = new FormData(this);

        let pattern = formData.get('pattern');
        let productName = formData.get('productName');
        let seller = formData.get('seller');

        const data = JSON.stringify({pattern, productName, seller});

        sendData(data)
            .then(res => {
                if(res){
                    form.reset();
                }
            })
    }


    async function sendData(data){
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