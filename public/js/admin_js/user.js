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

function addPurchaseDataListeners(){
    const userPurchases = document.querySelectorAll('.purchase');

    userPurchases.forEach(purchase => {
        const pruchaseData = purchase.querySelector('.purchase_data');
        const purchaseID = purchase.querySelector('.id_hidden').textContent;
        const button = purchase.querySelector('.purchase_details_' + purchaseID + '_button');
        const purchaseDetails = purchase.querySelector('.purchase_details_' + purchaseID);

        button.addEventListener('click', () => {
            if(purchaseDetails.classList.contains('hidden')){
                purchaseDetails.classList.remove('hidden');
                pruchaseData.style.borderRadius = '0.5em 0.5em 0em 0em'
            } else {
                purchaseDetails.classList.add('hidden');
                pruchaseData.style.borderRadius = '0.5em 0.5em 0.5em 0.5em'
            }
        });
    });
}

function addTrackingEditListeners(){
    const trackingSelects = document.querySelectorAll('.tracking_select');

    trackingSelects.forEach(select => {
        select.addEventListener('change', function (e) {
            e.preventDefault();
            const purchaseID = select.parentElement.parentElement.querySelector('.id_hidden').textContent;
            const userID = select.parentElement.parentElement.querySelector('.user_id_hidden').textContent;
            const newTrackingStatus = select.value;
            sendTrackingEditRequest(userID, purchaseID, newTrackingStatus);
        });
    });
}

function sendTrackingEditRequest(userID, purchaseID, newTrackingStatus){
    sendAjaxRequest('GET', '/admin/users/' + userID + '/' + purchaseID + '/tracking?tracking=' + newTrackingStatus, null, updateReviews);
}

function addReviewsDataListeners(){
    const userReviews = document.querySelectorAll('.review');

    userReviews.forEach(review => {
        const reviewData = review.querySelector('.review_data');
        const reviewID = review.querySelector('.id_hidden').textContent;
        const button = review.querySelector('.review_details_' + reviewID + '_button');
        const reviewDetails = review.querySelector('.review_details_' + reviewID);

        button.addEventListener('click', () => {
            if(reviewDetails.classList.contains('hidden')){
                reviewDetails.classList.remove('hidden');
                reviewData.style.borderRadius = '0.5em 0.5em 0em 0em'
            } else {
                reviewDetails.classList.add('hidden');
                reviewData.style.borderRadius = '0.5em 0.5em 0.5em 0.5em'
            }
        });
    });
}

function deleteReviewAddListeners(){
    const deleteForms = document.querySelectorAll('.delete_review_form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const reviewID = form.querySelector('.id_hidden').textContent;
            const userID = form.querySelector('.user_id_hidden').textContent;
            sendReviewDeleteRequest(userID, reviewID);
        });
    });
}

function sendReviewDeleteRequest(userID, reviewID){
    sendAjaxRequest('GET', '/admin/users/' + userID + '/' + reviewID, null, updateReviews);
}

function addBanListener(){
    const banForm = document.getElementById('ban_form');

    banForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const userID = banForm.querySelector('.user_id').textContent;
        const action = banForm.querySelector('.action').textContent;
        sendBanRequest(userID, action);
    });
}

function sendBanRequest(userID, action){
    console.log(action);
    console.log(userID);
    sendAjaxRequest('GET', '/admin/users/' + userID + '/manage?action=' + action, null, updateBanForm);
}

function updateReviews(){
    if(this.status != 200){
        console.log(this.responseText);
        return;
    }

    const newDocument = new DOMParser().parseFromString(this.responseText, 'text/html');
    const userReviews = newDocument.querySelector('.user_reviews');
    let oldReviews = document.querySelector('.user_reviews');

    oldReviews.innerHTML = userReviews.innerHTML;

    deleteReviewAddListeners();
}

function updateBanForm(){
    if(this.status != 200){
        console.log(this.responseText);
        return;
    }

    const newDocument = new DOMParser().parseFromString(this.responseText, 'text/html');
    const banForm = newDocument.getElementById('ban_form');
    let oldBanForm = document.getElementById('ban_form');

    oldBanForm.innerHTML = banForm.innerHTML;

    addBanListener();
}

addPurchaseDataListeners();
addReviewsDataListeners();
addTrackingEditListeners();
deleteReviewAddListeners();
addBanListener();