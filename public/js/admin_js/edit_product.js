function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();

    request.open(method, url, true);
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
}

function addEventListeners(){
    const actionButtons = document.querySelectorAll('.action_button');

    actionButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const productID = button.parentElement.querySelector('.product_id').textContent;
            const categoryID = button.parentElement.querySelector('.category_id').textContent;
            const action = button.textContent;
            sendProductActionRequest(productID, categoryID, action);
        });
    });
}

function sendProductActionRequest(productID, categoryID, action){
    sendAjaxRequest('GET', '/admin/products/' + productID + '/edit/category?categoryID=' + categoryID + '&action=' + action, null, updateProduct);
}

function updateProduct(){
    if(this.status != 200){
        console.log(this.responseText);
        return;
    }

    const newDocument = new DOMParser().parseFromString(this.responseText, 'text/html');
    let oldTableBody = document.querySelector('.table_body');
    let newTableBody = newDocument.querySelector('.table_body');

    oldTableBody.innerHTML = newTableBody.innerHTML;

    addEventListeners();
}

addEventListeners();