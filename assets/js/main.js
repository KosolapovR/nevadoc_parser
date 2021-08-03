function ready() {
    const form = document.forms['addPattern'];
    const notification = document.getElementById('notification');
    const fileInput = document.getElementById('fileUpload');
    const parsingButton = document.getElementById('parsingButton');
    const productName = document.getElementById('productName');
    const autocompleteList = document.querySelector('.autocomplete__list');


    function handleAddPattern(e) {
        e.preventDefault();

        const formData = new FormData(this);

        let pattern = formData.get('pattern');
        let productName = formData.get('productName');
        let seller = formData.get('seller');
        let size = formData.get('size');
        let color = formData.get('color');
        let material = formData.get('material');
        let sleeve = formData.get('sleeve');
        let print = formData.get('print');

        const data = JSON.stringify({pattern, productName, seller, size, color, material, sleeve, print});
        const uri = 'pattern/'

        sendData(uri, data)
            .then(response => {
                if (response.res) {
                    // form.reset();

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

    function handleParseFile(e) {
        e.preventDefault()


        const uri = 'parser/'

        const $table = document.getElementById('parsedDataTable');
        const $sum = document.getElementById('sum');
        const $parsed = document.getElementById('parsed');
        const $notParsed = document.getElementById('not_parsed');
        const seller = document.getElementById('seller').value;
        const stock = document.getElementById('stock').value;

        sendData(uri, JSON.stringify({seller, stock})
        )
            .then(res => {
                if (res.response !== 'Unknown seller') {
                    let tableHTML = '';
                    let sum = 0;
                    let parsed_quantity = 0;
                    let not_parsed_quantity = 0;

                    res.response.forEach((product, index) => {
                        tableHTML += "<tr>";
                        tableHTML += `<td>${index ? index : ''}</td>`;
                        tableHTML += product.name ? `<td>${product.name}</td>` : `<td style="background: yellow">${product.name}</td>`;
                        tableHTML += `<td>${product.size || ''}</td>`;
                        tableHTML += `<td>${product.color || ''}</td>`;
                        tableHTML += `<td>${product.material || ''}</td>`;
                        tableHTML += `<td>${product.sleeve || ''}</td>`;
                        tableHTML += `<td>${product.print || ''}</td>`;
                        tableHTML += `<td>${product.quantity}</td>`;
                        tableHTML += `<td>${product.price}</td>`;
                        tableHTML += `<td>${product.stock}</td>`;
                        tableHTML += "</tr>";

                        if(product.name){
                            parsed_quantity++
                        }else{
                            not_parsed_quantity++
                        }

                        if (index > 0)
                            sum += product.quantity * product.price;
                    })


                    $table.innerHTML = tableHTML;
                    $sum.innerText = sum.toFixed(2);
                    $parsed.innerText = parsed_quantity;
                    $notParsed.innerText = not_parsed_quantity.toString();
                } else {
                    $table.innerHTML = '';
                }

            })
    }

    async function sendData(uri, data = null,) {
        const response = await fetch('http://parser.loc/api/v1/' + uri, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: data
        });
        return response.json();
    }

    const handleImageUpload = event => {
        const files = event.target.files
        const formData = new FormData()
        formData.append('excelTable', files[0])

        fetch('http://parser.loc/api/v1/file/', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data)
            })
            .catch(error => {
                console.error(error)
            })
    }

    function handleAutocomplete(e) {
        let pattern = e.target.value;
        if (pattern.length < 3) {
            document.querySelector('.autocomplete__list').innerHTML = '';
            return;
        }

        let encoded = encodeURI(pattern);

        fetch(`http://parser.loc/api/v1/pattern?productName=${encoded}`)
            .then(response => {
                response.json()
                    .then(data => {
                        autocompleteList.innerHTML = '';

                        let $row = '';

                        if (data.success) {
                            data.products.forEach(product => {
                                $row += `<li class="autocomplete__item">${product.name}</li>`;
                            })

                            autocompleteList.innerHTML = $row;
                        }
                    })
            });
    }

    function handleSelectProductName(e) {
        const selectedProduct = e.target.innerText;

        autocompleteList.innerHTML = '';
        productName.value = selectedProduct;
    }

    if ('http://parser.loc/add-pattern/' === window.location.href) {
        form.addEventListener('submit', handleAddPattern)
        productName.addEventListener('keyup', handleAutocomplete)
        autocompleteList.addEventListener('click', handleSelectProductName)
    }


    if ('http://parser.loc/' === window.location.href) {
        fileInput.addEventListener('change', event => {
            handleImageUpload(event);
        });
        parsingButton.addEventListener('click', handleParseFile)
    }
}

document.addEventListener('DOMContentLoaded', ready);