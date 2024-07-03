const productsListUrl = '/products';

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

function addProductEventListeners() {
    let sortSelector = document.getElementById('sort');
    if (sortSelector) {
        sortSelector.removeEventListener('change', sendSortRequest);
        sortSelector.addEventListener('change', sendSortRequest);
    }

    let paginationForm = document.getElementById('pagination-form');
    if (paginationForm) {
        paginationForm.removeEventListener('submit', function (e) {
            e.preventDefault();
        });
        paginationForm.addEventListener('submit', function (e) {
            e.preventDefault();
        });
    }

    let categoryFilterForm = document.getElementById('category_filter');
    if (categoryFilterForm) {
        categoryFilterForm.removeEventListener('submit', function (e) {
            e.preventDefault();
            sendCategoryFilterRequest();
        });
        categoryFilterForm.addEventListener('submit', function (e) {
            e.preventDefault();
            sendCategoryFilterRequest();
        });
    }

    let searchForm = document.getElementById('search_product');
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

function sendSortRequest() {
    let sortValue = document.getElementById('sort').value;
    sendAjaxRequest('GET', productsListUrl + '?sort=' + sortValue, null, updateProductList);
}

function sendPaginationRequest(e) {
    let perPageValue = document.getElementById('perPage').value;
    let params = {
        perPage: perPageValue
    };
    let pageUrl = productsListUrl + '?' + encodeForAjax(params);
    sendAjaxRequest('GET', pageUrl, null, updateProductList);
}

function sendCategoryFilterRequest() {
    let selectedCategories = Array.from(document.querySelectorAll('input[name="categories[]"]:checked'))
        .map(checkbox => checkbox.value);

    let params = new URLSearchParams();
    selectedCategories.forEach(categoryId => {
        params.append('categories[]', categoryId);
    });

    let url = productsListUrl + '?' + params.toString();
    console.log('Request URL:', url);

    sendAjaxRequest('GET', url, null, updateProductList);
}

function sendSearchRequest() {
    let formData = new FormData(document.getElementById('search_product'));
    sendAjaxRequest('GET', productsListUrl + '?' + new URLSearchParams(formData).toString(), formData, updateProductList);
}

function updateProductList() {
    if (this.status !== 200) {
        console.error('Failed to update product list.');
        return;
    }

    let productListContainer = document.getElementById('product-list-container');
    let listContainer = document.getElementById('products-container-right');
    let Document = new DOMParser().parseFromString(this.responseText, 'text/html');
    let ProductListContainer = Document.getElementById('product-list-container');
    let ListContainer = Document.getElementById('products-container-right');

    if (ProductListContainer) {
        productListContainer.innerHTML = ProductListContainer.innerHTML;
        listContainer.innerHTML = ListContainer.innerHTML;

        addProductEventListeners();
    } else {
        console.error('Error in the product list container.');
    }
}
function addNotificationEventListeners() {
    var notificationLinks = document.querySelectorAll('.notification-anchor');
    notificationLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            markNotificationAsRead(link.getAttribute('data-notification-id'));
            window.location.href = link.getAttribute('href');
        });
    });

    var markAsReadButtons = document.querySelectorAll('.mark-as-read');
    markAsReadButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            markNotificationAsRead(button.getAttribute('data-notification-id'));
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    addNotificationEventListeners();

    // Add event listener for pagination links
    document.addEventListener('click', function (event) {
        if (event.target.closest('.pagination a')) {
            event.preventDefault();
            const pageUrl = event.target.getAttribute('href');
            updateNotifications(pageUrl);
        }
    });
});

function markNotificationAsRead(notificationId) {
    sendAjaxRequest('post', '/notification/' + notificationId, null, function () {
        updateNotifications();
    });
}

function updateNotifications() {
    fetch('/notifications')
        .then(response => response.text())
        .then(data => {
            const tempElement = document.createElement('div');
            tempElement.innerHTML = data;

            const unreadNotificationsContainer = document.getElementById('unread-notifications');
            const readNotificationsContainer = document.getElementById('read-notifications');

            const updatedUnreadNotifications = tempElement.querySelector('#unread-notifications').innerHTML;
            const updatedReadNotifications = tempElement.querySelector('#read-notifications').innerHTML;

            unreadNotificationsContainer.innerHTML = updatedUnreadNotifications;
            readNotificationsContainer.innerHTML = updatedReadNotifications;

            addNotificationEventListeners();
        })
        .catch(error => console.error('Error fetching notifications:', error));
}

function toggleEditReviewForm() {
    var editForm = document.getElementById('editForm');
    editForm.style.display = (editForm.style.display === 'none') ? 'block' : 'none';
}

function toggleAddReviewForm() {
    var addForm = document.getElementById('review-form');
    addForm.style.display = (addForm.style.display === 'none') ? 'block' : 'none';
}

function toggleAddReviewButton() {
    var addForm = document.getElementById('showReviewForm');
    addForm.style.display = (addForm.style.display === 'none') ? 'block' : 'none';
}

function switchNoReviews() {
    var yes = document.getElementById('yes_reviews');
    yes.style.display = (yes.style.display === 'none') ? 'block' : 'none';
    var no = document.getElementById('no_reviews');
    no.style.display = (no.style.display === 'none') ? 'block' : 'none';
}

function handleDeleteReview() {
    let form = document.getElementById('delete-form');
    let productId = form.getAttribute('data-product-id');
    let reviewId = form.getAttribute('data-review-id');

    let url = `/products/${productId}/reviews/${reviewId}`;

    sendAjaxRequest('DELETE', url, null, function () {
        let response = JSON.parse(this.responseText);
        if (response.success) {
            let reviewElement = document.querySelector(`.review[data-review-id="${reviewId}"]`);
            if (reviewElement) {
                reviewElement.remove();
            }

            let addReviewButton = document.getElementById('showReviewForm');
            if (addReviewButton) {
                addReviewButton.style.display = 'block';
            }

            if (response.reviews_left == 0) {
                switchNoReviews();
            }

            let url2 = `/products/${productId}/get-average-rating`;

            sendAjaxRequest('GET', url2, null, function () {
                if (this.status === 200) {
                    let averageRatingElement = document.getElementById('averageRating');
                    if (averageRatingElement) {
                        let responseData = JSON.parse(this.responseText);
                        if (responseData) {
                            if (responseData.average_rating == null) responseData.average_rating = 0.0;
                            averageRatingElement.innerHTML = '<strong>Average Rating:</strong> ' + responseData.average_rating;
                        }
                    }
                }
            });
        }
    });
}

function handleEditFormSubmit() {
    let form = document.getElementById('editForm');
    let productId = form.getAttribute('data-product-id');
    let reviewId = form.getAttribute('data-review-id');

    let data = {
        edit_title: form.querySelector('input[name="edit_title"]').value,
        edit_body: form.querySelector('textarea[name="edit_body"]').value,
        edit_rating: form.querySelector('input[name="edit_rating"]').value,
    };

    let url = `/products/${productId}/reviews/${reviewId}`;

    sendAjaxRequest('PUT', url, data, function () {
        let response = JSON.parse(this.responseText);
        if (response.success) {
            let reviewElement = document.querySelector(`.review[data-review-id="${reviewId}"]`);

            if (reviewElement) {
                let reviewTitle = reviewElement.querySelector('#reviewTitle');
                let reviewBody = reviewElement.querySelector('#reviewBody');
                let reviewRating = reviewElement.querySelector('#reviewRating');

                if (reviewTitle) {
                    reviewTitle.innerHTML = "<strong>Title:</strong> " + data.edit_title;
                }
                if (reviewBody) {
                    reviewBody.innerHTML = "<strong>Description:</strong> " + data.edit_body;
                }
                if (reviewRating) {
                    reviewRating.innerHTML = "<strong>Rating:</strong> " + data.edit_rating;
                }
            }

            let url2 = `/products/${productId}/get-average-rating`;

            sendAjaxRequest('GET', url2, null, function () {
                if (this.status === 200) {
                    let averageRatingElement = document.getElementById('averageRating');
                    if (averageRatingElement) {
                        let responseData = JSON.parse(this.responseText);
                        if (responseData) {
                            if (responseData.average_rating == null) responseData.average_rating = 0.0;
                            averageRatingElement.innerHTML = '<strong>Average Rating:</strong> ' + responseData.average_rating;
                        }
                    }
                }
                toggleEditReviewForm();
            });
        } else {
            console.error(response.message);
        }
    });
}

function reviewEventListeners() {
    let editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', function (event) {
            event.preventDefault();
            handleEditFormSubmit();
        });
    }

    let deleteForm = document.getElementById('delete-form');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function (event) {
            event.preventDefault();
            handleDeleteReview();
        });
    }
}

function toggleFaq(id) {
    const faq = document.getElementById("faq" + id +"answer");

    faq.classList.toggle("hidden");
}

reviewEventListeners();
addProductEventListeners();
addNotificationEventListeners();
