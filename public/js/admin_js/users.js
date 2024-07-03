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

function addUsersEventListeners() {
    let sortSelector = document.getElementById('sort_by');
    if (sortSelector) {
        sortSelector.removeEventListener('change', sendSortRequest);
        sortSelector.addEventListener('change', sendSortRequest);
    }

    let searchForm = document.getElementById('search');
    if (searchForm) {
        searchForm.removeEventListener('submit', function (e) {
            e.preventDefault();
            sendSearchRequest();
        });
        searchForm.addEventListener('submit', function (e) {
            e.preventDefault();
            sendSearchRequest();
        });
    }
}

function addResetListener(){
    let resetForm = document.getElementById('reset');
    if (resetForm) {
        resetForm.removeEventListener('submit', function (e) {
            e.preventDefault();
            sendResetRequest();
        });
        resetForm.addEventListener('submit', function (e) {
            e.preventDefault();
            sendResetRequest();
        });
    }
}

function sendSortRequest() {
    let sortValue = document.getElementById('sort_by').value;
    sendAjaxRequest('GET', '/admin/users' + '?sort_by=' + sortValue, null, updateUsers);
}

function sendSearchRequest(){
    console.log('here');
    let search = document.getElementById('search_field').value;
    let searchField = document.getElementById('search_by_field').value;
    let searchInput = document.getElementById('search_field');
    sendAjaxRequest('GET', '/admin/users' + '?search=' + search + '&search_by=' + searchField, null, updateUsers);
    if(searchInput) searchInput.value = '';
}

function sendResetRequest(){
    let searchInput = document.getElementById('search_field');
    sendAjaxRequest('GET', '/admin/users', null, updateUsers);
    if(searchInput) searchInput.value = '';
}

function updateUsers(){
    if(this.status != 200) return;

    let newDocument = new DOMParser().parseFromString(this.responseText, 'text/html');
    let newTableBody = newDocument.getElementById('table-body');
    let oldTableBody = document.getElementById('table-body');

    if(newTableBody == null || oldTableBody == null) return;

    oldTableBody.innerHTML = newTableBody.innerHTML;

    addUsersEventListeners();
}

addUsersEventListeners();
addResetListener();