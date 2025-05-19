function validateReview() {
    const rating = document.getElementById('rating').value;
    const comment = document.getElementById('comment').value.trim();
    const travelerType = document.getElementById('traveler-type').value;
    let isValid = true;

    document.getElementById('rating-error').style.display = 'none';
    document.getElementById('comment-error').style.display = 'none';
    document.getElementById('traveler-type-error').style.display = 'none';
    document.getElementById('review-success').style.display = 'none';

    if (!rating) {
        document.getElementById('rating-error').style.display = 'block';
        isValid = false;
    }

    if (!comment || comment.length < 5 || comment.length > 500) {
        document.getElementById('comment-error').style.display = 'block';
        isValid = false;
    }

    if (!travelerType) {
        document.getElementById('traveler-type-error').style.display = 'block';
        isValid = false;
    }

    if (isValid) {
        document.getElementById('review-success').style.display = 'block';
        document.querySelectorAll('select, textarea').forEach(el => el.value = '');
    }
}