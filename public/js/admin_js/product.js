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
            const productIDID = form.querySelector('.product_id_hidden').textContent;
            sendReviewDeleteRequest(productIDID, reviewID);
        });
    });
}

function sendReviewDeleteRequest(productID, reviewID){
    console.log('/admin/products' + productID + '/' + reviewID);
    sendAjaxRequest('GET', '/admin/products/' + productID + '/' + reviewID, null, updateReviews);
}

function updateReviews(){
    if(this.status != 200){
        console.log(this.responseText);
        return;
    }

    const newDocument = new DOMParser().parseFromString(this.responseText, 'text/html');
    const userReviews = newDocument.querySelector('.product_reviews');
    let oldReviews = document.querySelector('.product_reviews');

    oldReviews.innerHTML = userReviews.innerHTML;

    deleteReviewAddListeners();
}

addReviewsDataListeners();
deleteReviewAddListeners();